<?
// CONFIGURAÇÕES
$tabela = "blog_posts_comentarios";
$filtro = "WHERE c.id > 0";
$order = "ORDER BY c.id DESC";
$paginacao = true;
$num_regs = 30;
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
		$tit_pag_geral = "Cadastrar comentário";
		break;
	case 'edit':
		$tit_pag_geral = "Editar comentário";
		break;
	default:
		$tit_pag_geral = "Comentários do Blog";
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

	// FILTRO 'TÍTULO'
	if (isset($_POST['filtro_titulo'])) {
	    if ($_POST['filtro_titulo'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_titulo'] = addslashes($_POST['filtro_titulo']);
	        $filtro_titulo = " AND p.titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";	
	        $filtro .= $filtro_titulo;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_titulo']);
	        $filtro_titulo = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_titulo'])) {
	    $filtro_titulo = " AND p.titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";
	    $filtro .= $filtro_titulo;
	}

	// FILTRO 'NOME'
	if (isset($_POST['filtro_nome'])) {
	    if ($_POST['filtro_nome'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_nome'] = addslashes($_POST['filtro_nome']);
	        $filtro_nome = " AND c.nome LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_nome']."%'";	
	        $filtro .= $filtro_nome;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_nome']);
	        $filtro_nome = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_nome'])) {
	    $filtro_nome = " AND c.nome LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_nome']."%'";
	    $filtro .= $filtro_nome;
	}

	// FILTRO 'STATUS'
	if (isset($_POST['filtro_status'])) {
	    if ($_POST['filtro_status'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
	        $filtro_status = " AND c.status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";	
	        $filtro .= $filtro_status;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_status']);
	        $filtro_status = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
	    $filtro_status = " AND c.status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";
	    $filtro .= $filtro_status;
	}

	// FILTRO 'DATA'
	if (isset($_POST['filtro_data'])) {
	    if ($_POST['filtro_data'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
	        $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
	        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
	        $filtro_data = " AND (c.data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	        $filtro .= $filtro_data;     
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_data']);
	        $filtro_data = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
	    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
        $filtro_data = " AND (c.data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	    $filtro .= $filtro_data;
	}

	// ORDERNAR
	if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
		$_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
		$order = $_SESSION[$pag_include]['ordem'];    
	} else if ($_SESSION[$pag_include]['ordem'] != "") {
		$order = $_SESSION[$pag_include]['ordem'];
	}

	$resultado = $acoes->SelectMultiple("SELECT c.*, p.titulo, p.foto FROM $tabela AS c INNER JOIN blog_posts AS p ON c.post_id=p.id $filtro $order", $paginacao, $num_regs);
	$total_registros = $acoes->totalRegistros();
}

//==================================================//
//                      UPDATE                      //
//==================================================//
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT c.*, p.titulo, p.foto FROM $tabela AS c INNER JOIN blog_posts AS p ON c.post_id=p.id WHERE c.id = $id_enviado LIMIT 1");	

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
					'nome' => $_POST['nome'],
					'email' => $_POST['email'],
					'comentario' => $_POST['comentario'],
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

	$adicionais = array();

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

		$adicionais = array();

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
