<?
// CONFIGURAÇÕES
$tabela = "anuncios";
$filtro = "WHERE a.id > 0";
$order = "ORDER BY a.id DESC";
$paginacao = true;
$num_regs = 15;
$ordemExibicao = false;
$uploadArquivo = true;
$removeDiretorio = true;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();
switch ($acao_enviado) {
	case 'insert':
		$tit_pag_geral = "Cadastrar anúncio";
		break;
	case 'edit':
		$tit_pag_geral = "Editar anúncio";
		break;
	default:
		$tit_pag_geral = "Anúncios";
		break;
}

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
	$path = IMG_PATH."/".$tabela;
	$extensoes_permitidas = array("png","gif","svg","jpg","jpeg");
	$redimensiona = false;
	$largura = 0;
	$altura = 0;
	$forma_redimensiona = ''; // '', 'crop', 'auto'
	$grava = true;
	$remove = true;	
	$thumbs = array();
}

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";
if (isset($_GET['p']) && $_GET['p'] != '') {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view?p=".$_GET['p'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert?p=".$_GET['p'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete?p=".$_GET['p'];
} else {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert";
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete";
}	

// PROPRIETÁRIO
$proprietarios = $acoes->SelectSQL("SELECT * FROM proprietarios WHERE status=1 ORDER BY nome ASC");

// CIDADES
$cidades = $acoes->SelectSQL("SELECT * FROM anuncios_destinos GROUP BY cidade ORDER BY id DESC");

// CONDOMÍNIOS
$condominios = $acoes->SelectSQL("SELECT * FROM anuncios_condominios ORDER BY id DESC");

// CARACTERISTICAS
$caracteristicas_anuncios = new Crud("anuncios_caracteristicas_n_n");

// CONFIGURAÇÕES DE RETORNO
if($acao == "delete"){    
	$retorno_pag = $current_url_view;
}else{
	$retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

// URL FILTROS
$acao_filtros = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {	

    // FILTRO 'PROPRIETÁRIO'
    if (isset($_POST['filtro_proprietario'])) {
      if ($_POST['filtro_proprietario'] != "") {
          $_SESSION[$pag_include]['filtros']['filtro_proprietario'] = addslashes($_POST['filtro_proprietario']);
          $filtro_proprietario = " AND a.id_proprietario = '".$_SESSION[$pag_include]['filtros']['filtro_proprietario']."'";	
          $filtro .= $filtro_proprietario;       
      }else{
          unset($_SESSION[$pag_include]['filtros']['filtro_proprietario']);
          $filtro_proprietario = "";
      }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_proprietario'])) {
      $filtro_proprietario = " AND a.id_proprietario = '".$_SESSION[$pag_include]['filtros']['filtro_proprietario']."'";
      $filtro .= $filtro_proprietario;
  }

	// FILTRO 'TÍTULO'
	if (isset($_POST['filtro_titulo'])) {
	    if ($_POST['filtro_titulo'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_titulo'] = addslashes($_POST['filtro_titulo']);
	        $filtro_titulo = " AND a.titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";	
	        $filtro .= $filtro_titulo;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_titulo']);
	        $filtro_titulo = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_titulo'])) {
	    $filtro_titulo = " AND a.titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";
	    $filtro .= $filtro_titulo;
	}

	// FILTRO 'ANÚNCIO'
	if (isset($_POST['filtro_codigo'])) {
	    if ($_POST['filtro_codigo'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_codigo'] = addslashes($_POST['filtro_codigo']);
	        $filtro_codigo = " AND a.codigo = '".$_SESSION[$pag_include]['filtros']['filtro_codigo']."'";	
	        $filtro .= $filtro_codigo;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_codigo']);
	        $filtro_codigo = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_codigo'])) {
	    $filtro_codigo = " AND a.codigo = '".$_SESSION[$pag_include]['filtros']['filtro_codigo']."'";
	    $filtro .= $filtro_codigo;
	}

	// FILTRO 'CIDADE'
	if (isset($_POST['filtro_cidade'])) {
    if ($_POST['filtro_cidade'] != "") {
        $_SESSION[$pag_include]['filtros']['filtro_cidade'] = addslashes($_POST['filtro_cidade']);
        $filtro_cidade = " AND a.cidade = '".$_SESSION[$pag_include]['filtros']['filtro_cidade']."'";	
        $filtro .= $filtro_cidade;       
    }else{
        unset($_SESSION[$pag_include]['filtros']['filtro_cidade']);
        $filtro_cidade = "";
    }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_cidade'])) {
    $filtro_cidade = " AND a.cidade = '".$_SESSION[$pag_include]['filtros']['filtro_cidade']."'";
    $filtro .= $filtro_cidade;
}

	// FILTRO 'STATUS'
	if (isset($_POST['filtro_status'])) {
	    if ($_POST['filtro_status'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
	        $filtro_status = " AND a.status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";	
	        $filtro .= $filtro_status;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_status']);
	        $filtro_status = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
	    $filtro_status = " AND a.status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";
	    $filtro .= $filtro_status;
	}


	// FILTRO 'TIPO'
	if (isset($_POST['filtro_tipo'])) {
    if ($_POST['filtro_tipo'] != "") {
        $_SESSION[$pag_include]['filtros']['filtro_tipo'] = addslashes($_POST['filtro_tipo']);
        $filtro_tipo = " AND a.tipo_anuncio = '".$_SESSION[$pag_include]['filtros']['filtro_tipo']."'";	
        $filtro .= $filtro_tipo;       
    }else{
        unset($_SESSION[$pag_include]['filtros']['filtro_tipo']);
        $filtro_tipo = "";
    }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_tipo'])) {
    $filtro_tipo = " AND a.tipo_anuncio = '".$_SESSION[$pag_include]['filtros']['filtro_tipo']."'";
    $filtro .= $filtro_tipo;
}

	// FILTRO 'DATA'
	if (isset($_POST['filtro_data'])) {
	    if ($_POST['filtro_data'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
	        $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
	        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
	        $filtro_data = " AND (a.data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	        $filtro .= $filtro_data;     
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_data']);
	        $filtro_data = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
	    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
        $filtro_data = " AND (a.data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	    $filtro .= $filtro_data;
	}

	// ORDERNAR
	if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
		$_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
		$order = $_SESSION[$pag_include]['ordem'];    
	} else if ($_SESSION[$pag_include]['ordem'] != "") {
		$order = $_SESSION[$pag_include]['ordem'];
	}

	$resultado = $acoes->SelectMultiple("SELECT a.* FROM $tabela AS a $join_categoria  $filtro $order", $paginacao, $num_regs);
	$total_registros = $acoes->totalRegistros();

	// Seleciona o proprietário
	foreach ($resultado as $key => $value) {
		
		// Proprietário
		$resultProprietario = $conexao->prepare("SELECT nome, cpf FROM proprietarios WHERE id = :id_proprietario");
		$resultProprietario->bindValue(":id_proprietario", $value['id_proprietario'], PDO::PARAM_INT);
		$resultProprietario->execute();
		$proprietario = $resultProprietario->fetch(PDO::FETCH_ASSOC);

		$resultado[$key]['proprietario'] = $proprietario['nome'] .' - '. $proprietario['cpf'];

	}
}


//==================================================//
//                      INSERT                      //
//==================================================//
if($acao == "insert"){

	if(isset($_POST['acao']) && $_POST['acao'] == "insert" && TOKEN == $token_confirma){

		// VERIFICA CAMPOS ÚNICOS
		$verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST);
		if ($verificaUnicos === true) {

			// VERIFICA IMAGENS
			$verificaImagens = $upload->validateImages($_FILES['img'], $extensoes_permitidas);
			if ($verificaImagens === true) {

				// DADOS
				$dados = array(
					'id_proprietario' => $_POST['id_proprietario'],
					'tipo_anuncio' => $_POST['tipo_anuncio'],
					'titulo' => $_POST['titulo'],
					'codigo' => $_POST['codigo'],
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0,
					'descricao' => $_POST['ckeditor'],
					'video' => $_POST['video'],
					'observacoes_contrato' => $_POST['observacoes_contrato'],
					'views' => 0,
					'valor' => $_POST['valor'] != "" ? Tools::formataMoedaBd($_POST['valor']) : 0.00,
					'valor_venda' => $_POST['valor_venda'] != "" ? Tools::formataMoedaBd($_POST['valor_venda']) : 0.00,
					'estadia_minima' => $_POST['estadia_minima'],
					'tipo' => $_POST['tipo'],
					'hospedes' => $_POST['hospedes'],
					'quartos' => $_POST['quartos'],
					'suites' => $_POST['suites'],
					'banheiros' => $_POST['banheiros'],
					'vagas' => $_POST['vagas'],
					'distancia_praia' => $_POST['distancia_praia'],
					'cidade' => $_POST['cidade'],
					'endereco' => $_POST['endereco'],
					'cep' => $_POST['cep'],
					'destino' => $_POST['destino'] != "" ? $_POST['destino'] : 0,
					'condominio' => $_POST['condominio'] != "" ? $_POST['condominio'] : 0,
					'latitude' => $_POST['latitude'],
					'longitude' => $_POST['longitude'],
					'url_amigavel' => Tools::geraSlug($_POST['titulo']),
					'aceitacao_contrato' => 0,
					'data_cad' => Tools::getDateTime()	
				);	
				
				if ($_POST['metragem'] != "") {
          $dados['metragem'] = $_POST['metragem'];
        }
				if ($_POST['area_construida'] != "") {
          $dados['area_construida'] = $_POST['area_construida'];
        }

				$operacao = $acoes->Insert($dados);

				if ($operacao) {

					$ultimo_id = $acoes->getId();

					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$ultimo_id;
						$upload->uploadImagens($_FILES['img'], $path, $ultimo_id, $grava, $remove, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);				
					}

					// Ordem de Exibição
					if ($ordemExibicao) {
						$prox_valor = $acoes->SelectSingle("SELECT MAX(ordem_exibicao) AS maior_valor FROM $tabela LIMIT 1")['maior_valor'];	
						$prox_valor = $prox_valor != "" ? ++$prox_valor : 1;	
						$updateOrdem = $acoes->Update(
							array(			
								"ordem_exibicao" => $prox_valor
							),
							"WHERE id = $ultimo_id"
						);
					}

					// Características
					foreach ($_POST['caracteristicas'] as $caracteristica) {
						$dados_carac = array(
							'caracteristica_id' => $caracteristica,
							'anuncio_id' => $ultimo_id
						);
						$insertCarac = $caracteristicas_anuncios->Insert($dados_carac);
					}

					$_SESSION['msg_retorna'] = Tools::alertReturn(1);
					Tools::redireciona("".URL_ADMIN."anuncios/anuncios_fotos/".TOKEN."/insert/0/".$ultimo_id);

				// ERRO OPERAÇÃO
				} else { 
					$_SESSION['msg_retorna'] = Tools::alertReturn(4);
					Tools::redireciona($retorno_pag);
				}
			
			// ERRO ARQUIVOS
			} else { 
				$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$verificaImagens,"error");
				Tools::redireciona($retorno_pag);
			}		

		// ERRO CAMPOS ÚNICOS
		} else { 
			$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$verificaUnicos,"error");
			Tools::redireciona($_SERVER['REQUEST_URI']);
		}
	}
}		


//==================================================//
//                      UPDATE                      //
//==================================================//
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado LIMIT 1");	

	// CARACTERISTICAS ATUAIS
	$resultCaracsAtuais = $conexao->prepare("SELECT caracteristica_id FROM anuncios_caracteristicas_n_n WHERE anuncio_id=:anuncio_id");
	$resultCaracsAtuais->bindValue(":anuncio_id", $linha_edit['id'], PDO::PARAM_INT);
	$resultCaracsAtuais->execute();
	$caracteristicas_atuais = $resultCaracsAtuais->fetchAll(PDO::FETCH_COLUMN);

	if ($linha_edit == "") {
		Tools::redireciona($current_url_view);
	}

	if(isset($_POST['acao']) && $_POST['acao'] == "edit" && TOKEN == $token_confirma){

		$idEdit = Tools::protege($_POST['id']);

		// VERIFICA CAMPOS ÚNICOS
		$verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST, $idEdit);
		if ($verificaUnicos === true) {

			// VERIFICA IMAGENS
			$verificaImagens = $upload->validateImages($_FILES['img'], $extensoes_permitidas);
			if ($verificaImagens === true) {

				// DADOS
				$dados = array(
					'id_proprietario' => $_POST['id_proprietario'],
					'tipo_anuncio' => $_POST['tipo_anuncio'],
					'titulo' => $_POST['titulo'],
					'codigo' => $_POST['codigo'],
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0,
					'descricao' => $_POST['ckeditor'],
					'video' => $_POST['video'],
					'observacoes_contrato' => $_POST['observacoes_contrato'],
					'valor' => $_POST['valor'] != "" ? Tools::formataMoedaBd($_POST['valor']) : 0.00,
					'valor_venda' => $_POST['valor_venda'] != "" ? Tools::formataMoedaBd($_POST['valor_venda']) : 0.00,
					'estadia_minima' => $_POST['estadia_minima'],
					'tipo' => $_POST['tipo'],
					'hospedes' => $_POST['hospedes'],
					'quartos' => $_POST['quartos'],
					'suites' => $_POST['suites'],
					'banheiros' => $_POST['banheiros'],
					'vagas' => $_POST['vagas'],
					'distancia_praia' => $_POST['distancia_praia'],
					'cidade' => $_POST['cidade'],
					'endereco' => $_POST['endereco'],
					'cep' => $_POST['cep'],
					'destino' => $_POST['destino'] != "" ? $_POST['destino'] : 0,
					'condominio' => $_POST['condominio'] != "" ? $_POST['condominio'] : 0,
					'latitude' => $_POST['latitude'],
					'longitude' => $_POST['longitude'],
					'url_amigavel' => Tools::geraSlug($_POST['titulo'])
				);
				
				if ($_POST['metragem'] != "") {
          $dados['metragem'] = $_POST['metragem'];
        }
				if ($_POST['area_construida'] != "") {
          $dados['area_construida'] = $_POST['area_construida'];
        }

				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){

					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$idEdit;
						$upload->uploadImagens($_FILES['img'], $path, $idEdit, $grava, $remove, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);				
					}

					// Características
					$deleteCaracs = $caracteristicas_anuncios->Delete($idEdit, "WHERE anuncio_id=$idEdit", array(), false, false, null);
					if ($deleteCaracs) {
						foreach ($_POST['caracteristicas'] as $caracteristica) {
							$dados_carac = array(
                'caracteristica_id' => $caracteristica,
                'anuncio_id' => $idEdit
							);
							$insertCarac = $caracteristicas_anuncios->Insert($dados_carac);
						}
					}				

					$_SESSION['msg_retorna'] = Tools::alertReturn(2);
					Tools::redireciona($retorno_pag);

				// ERRO OPERAÇÃO
				} else { 
					$_SESSION['msg_retorna'] = Tools::alertReturn(4);
					Tools::redireciona($retorno_pag);
				}
			
			// ERRO ARQUIVOS
			} else { 
				$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$verificaImagens,"error");
				Tools::redireciona($retorno_pag);
			}		

		// ERRO CAMPOS ÚNICOS
		} else { 
			$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$verificaUnicos,"error");
			Tools::redireciona($_SERVER['REQUEST_URI']);
		}		
	}   
}


//==================================================//
//                UPDATE MULTIPLE                   //
//==================================================//
if(isset($_POST['acao_exec'])  && $_POST['acao_exec'] == 5){

	$campo = $_POST['campo'];
	$valor = $_POST['status'];
	$ids = $_POST['id'];

	foreach ($ids as $idUpdate) {	

		// Dados
		$dados = array(			
			$campo => $valor
		);	

		$operacao = $acoes->Update($dados,"WHERE id = $idUpdate");

		// ERRO OPERAÇÃO
		if (!$operacao) {
			$_SESSION['msg_retorna'] = Tools::alertReturn(4);
			Tools::redireciona($retorno_pag);
			exit;
		}

	}

	// SUCESSO
	$_SESSION['msg_retorna'] = Tools::alertReturn(2);
	Tools::redireciona($retorno_pag);

}


//==================================================//
//                     DELETE                       //
//==================================================//
if($acao == "delete" && TOKEN == $token_confirma_del){

	$idDel = Tools::protege($_POST['id']);
	$pathRemove = $path."/".$idDel;

	$adicionais = array(
    'anuncios_caracteristicas_n_n' => "anuncio_id",
    'anuncios_fotos' => "item_id",
    'anuncios_precos' => "anuncio_id",
    'anuncios_taxas' => "anuncio_id",
    'anuncios_avaliacoes' => "anuncio_id",
    'anuncios_reservas' => "anuncio_id",
    'anuncios_reservas_valores' => "anuncio_id",
    'anuncios_datas_indisponiveis' => "anuncio_id",
    'buscas_anuncios' => "anuncio_id"
	);

	$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

	if ($operacao) {

		$_SESSION['msg_retorna'] = Tools::alertReturn(3);
		Tools::redireciona($retorno_pag);

	}else{

		$_SESSION['msg_retorna'] = Tools::alertReturn(4);
		Tools::redireciona($retorno_pag);

	}

}


//==================================================//
//                DELETE MULTIPLE                   //
//==================================================//
if(isset($_POST['acao_exec'])  && $_POST['acao_exec'] == 6){

	$ids = $_POST['id'];

	foreach ($ids as $idDel) {

		$adicionais = array(
      'anuncios_caracteristicas_n_n' => "anuncio_id",
      'anuncios_fotos' => "item_id",
      'anuncios_precos' => "anuncio_id",
      'anuncios_taxas' => "anuncio_id",
      'anuncios_avaliacoes' => "anuncio_id",
      'anuncios_reservas' => "anuncio_id",
      'anuncios_reservas_valores' => "anuncio_id",
      'anuncios_datas_indisponiveis' => "anuncio_id",
      'buscas_anuncios' => "anuncio_id"
		);

		$pathRemove = $path."/".$idDel;
		$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

		// ERRO OPERAÇÃO
		if (!$operacao) {
			$_SESSION['msg_retorna'] = Tools::alertReturn(4);
			Tools::redireciona($retorno_pag);
			exit;
		}

	}

	// SUCESSO
	$_SESSION['msg_retorna'] = Tools::alertReturn(3);
	Tools::redireciona($retorno_pag);

}
