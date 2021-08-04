<?
// CONFIGURAÇÕES
$tabela = "cidades";
$filtro = "WHERE id>0";
$order = "ORDER BY titulo ASC";
$paginacao = true;
$num_regs = 50;
$ordemExibicao = false;
$uploadArquivo = false;
$removeDiretorio = false;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();
switch ($acao_enviado) {
	case 'insert':
		$tit_pag_geral = "Cadastrar cidade";
		break;
	case 'edit':
		$tit_pag_geral = "Editar cidade";
		break;
	default:
		$tit_pag_geral = "Cidades e bairros";
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
	$extensoes_permitidas = array("png","gif","svg","jpg","jpeg","webp");
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

// CONFIGURAÇÕES DE RETORNO
if($acao == "delete"){    
	$retorno_pag = $current_url_view;
}else{
	$retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

// ESTADOS
$estados = $acoes->SelectSQL("SELECT * FROM estados ORDER BY titulo ASC");

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {	

  // FILTRO 'TÍTULO'
	if (isset($_POST['filtro_titulo'])) {
      if ($_POST['filtro_titulo'] != "") {
          $_SESSION[$pag_include]['filtros']['filtro_titulo'] = addslashes($_POST['filtro_titulo']);
          $filtro_titulo = " AND titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";	
          $filtro .= $filtro_titulo;       
      }else{
          unset($_SESSION[$pag_include]['filtros']['filtro_titulo']);
          $filtro_titulo = "";
      }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_titulo'])) {
      $filtro_titulo = " AND titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";
      $filtro .= $filtro_titulo;
  }

  // FILTRO 'ESTADO'
  if (isset($_POST['filtro_estado'])) {
      if ($_POST['filtro_estado'] != "") {
          $_SESSION[$pag_include]['filtros']['filtro_estado'] = addslashes($_POST['filtro_estado']);
          $filtro_estado = " AND estado_id = '".$_SESSION[$pag_include]['filtros']['filtro_estado']."'";	
          $filtro .= $filtro_estado;       
      }else{
          unset($_SESSION[$pag_include]['filtros']['filtro_estado']);
          $filtro_estado = "";
      }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_estado'])) {
      $filtro_estado = " AND estado_id = '".$_SESSION[$pag_include]['filtros']['filtro_estado']."'";
      $filtro .= $filtro_estado;
  }

  // FILTRO 'STATUS'
  if (isset($_POST['filtro_status'])) {
      if ($_POST['filtro_status'] != "") {
          $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
          $filtro_status = " AND status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";	
          $filtro .= $filtro_status;       
      }else{
          unset($_SESSION[$pag_include]['filtros']['filtro_status']);
          $filtro_status = "";
      }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
      $filtro_status = " AND status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";
      $filtro .= $filtro_status;
  }

  // FILTRO 'DATA'
  if (isset($_POST['filtro_data'])) {
      if ($_POST['filtro_data'] != "") {
          $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
          $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
          $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
          $filtro_data = " AND (data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
          $filtro .= $filtro_data;     
      }else{
          unset($_SESSION[$pag_include]['filtros']['filtro_data']);
          $filtro_data = "";
      }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
      $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
        $filtro_data = " AND (data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
      $filtro .= $filtro_data;
  }

	// ORDERNAR
	if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
		$_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
		$order = $_SESSION[$pag_include]['ordem'];    
	} else if ($_SESSION[$pag_include]['ordem'] != "") {
		$order = $_SESSION[$pag_include]['ordem'];
	}

	$resultado = $acoes->SelectMultiple("SELECT * FROM $tabela $filtro $order", $paginacao, $num_regs);
	$total_registros = $acoes->totalRegistros();

  foreach ($resultado as $key => $value) {
    // Estado
    $resultado[$key]['estado'] = $acoes->SelectSingle("SELECT titulo FROM estados WHERE id=".$value['estado_id'])['titulo'];

    // Total bairros
    $totalBairros = $acoes->SelectTotalSQL("SELECT id FROM bairros WHERE cidade_id=".$value['id']);
    $resultado[$key]['total_bairros'] = $totalBairros;
  }

	// ORDENS DE EXIBIÇÃO
	if ($ordemExibicao) {
		$ordens = $acoes->SelectSQL("SELECT ordem_exibicao FROM $tabela ORDER BY ordem_exibicao ASC");
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
					'titulo' => $_POST['titulo'],
					'estado_id' => $_POST['estado_id'],
					"url_amigavel" => Tools::geraSlug($_POST['titulo']),
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0			
				);	
				
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

					$_SESSION['msg_retorna'] = Tools::alertReturn(1);
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
//                      UPDATE                      //
//==================================================//
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado LIMIT 1");	

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
					'titulo' => $_POST['titulo'],
					'estado_id' => $_POST['estado_id'],
					"url_amigavel" => Tools::geraSlug($_POST['titulo']),
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0			
				);

				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){

					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$idEdit;
						$upload->uploadImagens($_FILES['img'], $path, $idEdit, $grava, $remove, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);				
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
    'anuncios_bairros' => 'cidade_id'
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
      'anuncios_bairros' => 'cidade_id'
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


?>
