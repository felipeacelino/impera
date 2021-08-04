<?
// CONFIGURAÇÕES
$tabela = "proprietarios";
$filtro = "WHERE id > 0";
$order = "ORDER BY id DESC";
$paginacao = true;
$num_regs = 30;
$ordemExibicao = false;
$uploadArquivo = true;
$removeDiretorio = true;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array(
	'email' => array(
		'name' => 'email_verifica',
		'mensagem' => 'O e-mail informado já está em uso'
	),
	'cpf' => array(
		'name' => 'cpf',
		'mensagem' => 'O CPF informado já está em uso'
	),
	'cnpj' => array(
		'name' => 'cnpj',
		'mensagem' => 'O CNPJ informado já está em uso'
	)
);
switch ($acao_enviado) {
	case 'insert':
		$tit_pag_geral = "Cadastrar proprietário";
		break;
	case 'edit':
		$tit_pag_geral = "Editar proprietário";
		break;
	default:
		$tit_pag_geral = "Proprietários";
		break;
}

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
  $path = ARQ_PATH . "/" . $tabela;
  $extensoes_permitidas = array("png", "gif", "svg", "jpg", "jpeg", "doc", "docx", "xlx", "xls", "pdf", "zip", "rar", "txt", "csv", "xlsx");
  $grava = true;
  $remove = false;
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

// URL FILTROS
$acao_filtros = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {	

	// FILTRO 'NOME'
	if (isset($_POST['filtro_nome'])) {
	    if ($_POST['filtro_nome'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_nome'] = addslashes($_POST['filtro_nome']);
	        $filtro_nome = " AND nome LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_nome']."%'";	
	        $filtro .= $filtro_nome;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_nome']);
	        $filtro_nome = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_nome'])) {
	    $filtro_nome = " AND nome LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_nome']."%'";
	    $filtro .= $filtro_nome;
	}

	// FILTRO 'EMAIL'
	if (isset($_POST['filtro_email'])) {
	    if ($_POST['filtro_email'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_email'] = addslashes($_POST['filtro_email']);
	        $filtro_email = " AND email = '".$_SESSION[$pag_include]['filtros']['filtro_email']."'";	
	        $filtro .= $filtro_email;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_email']);
	        $filtro_email = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_email'])) {
	    $filtro_email = " AND email = '".$_SESSION[$pag_include]['filtros']['filtro_email']."'";
	    $filtro .= $filtro_email;
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
	        $filtro_data = " AND (dta_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	        $filtro .= $filtro_data;     
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_data']);
	        $filtro_data = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
	    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
        $filtro_data = " AND (dta_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
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
					'tipo_cadastro' => $_POST['tipo_cadastro'],
					'nome' => $_POST['nome'],
					'cpf' => $_POST['cpf-'],
					'rg' => $_POST['rg'],
					'estado_civil' => $_POST['estado_civil'],
					'profissao' => $_POST['profissao'],
					'nacionalidade' => $_POST['nacionalidade'],
					'conta' => $_POST['conta'],
					'telefone' => $_POST['telefone'],
					'email' => $_POST['email_verifica'],
					'cep' => $_POST['cep'],
					'logradouro' => $_POST['logradouro'],
					'numero' => $_POST['numero'],
					'bairro' => $_POST['bairro'],
					'cidade' => $_POST['cidade'],
					'estado' => $_POST['estado'],
					'senha' => Tools::geraHash("password",$_POST['senha']),
					'chave' => Tools::geraHash("md5",Tools::getDateTime()),
					'dta_cad' => Tools::getDateTime(),					
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0
				);	
				
				if ($_POST['cnpj-'] != "") {
          $dados['cnpj'] = $_POST['cnpj-'];
        }
				if ($_POST['razao_social'] != "") {
          $dados['razao_social'] = $_POST['razao_social'];
        }

				$operacao = $acoes->Insert($dados);

				if ($operacao) {

					$ultimo_id = $acoes->getId();
					
					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$ultimo_id;
						$upload->uploadArquivos($_FILES['arq'], $path, $ultimo_id, $grava, $remove);				
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
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado");

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
					'tipo_cadastro' => $_POST['tipo_cadastro'],
          'nome' => $_POST['nome'],
          'cpf' => $_POST['cpf-'],
          'cnpj' => $_POST['cnpj-'],
          'razao_social' => $_POST['razao_social'],
					'rg' => $_POST['rg'],
					'estado_civil' => $_POST['estado_civil'],
					'profissao' => $_POST['profissao'],
					'nacionalidade' => $_POST['nacionalidade'],
					'conta' => $_POST['conta'],
          'telefone' => $_POST['telefone'],
          'email' => $_POST['email_verifica'],	
          'cep' => $_POST['cep'],
          'logradouro' => $_POST['logradouro'],
          'numero' => $_POST['numero'],
          'bairro' => $_POST['bairro'],
          'cidade' => $_POST['cidade'],
          'estado' => $_POST['estado'],
          'status' => $_POST['status'] != "" ? $_POST['status'] : 0
        );

				if ($_POST['senha'] != "") {
          $dados['senha'] = Tools::geraHash("password",$_POST['senha']);
				}

				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){					
			
					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$idEdit;
						$upload->uploadArquivos($_FILES['arq'], $path, $idEdit, $grava, $remove);	
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
    'proprietarios_arquivos' => 'id_usuario',
    'proprietarios_mensagens' => 'id_usuario'
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
      'proprietarios_arquivos' => 'id_usuario',
      'proprietarios_mensagens' => 'id_usuario'
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
