<?
include ("paginas_conf.php");

// CONFIGURAÇÕES
$tabela = "paginas";
$pagina = explode("_", $id_enviado)[1];
$filtro = "WHERE pagina = '".$pagina."' LIMIT 1";
$order = "";
$paginacao = false;
$num_regs = 1;
$ordemExibicao = false;
$uploadArquivo = true;
$removeDiretorio = false;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();

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
    $thumbs = array(
    array(
      "largura" => 2000,
      "altura" => 0,
      "forma" => 'auto'
    ),
		array(
			"largura" => 2000,
			"altura" => 400,
			"forma" => 'crop'
		),
		array(
			"largura" => 800,
			"altura" => 0,
			"forma" => 'auto'
    ),
    array(
			"largura" => 800,
			"altura" => 500,
			"forma" => 'crop'
		),
    array(
			"largura" => 250,
			"altura" => 0,
			"forma" => 'auto'
		)
	);
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

//==================================================//
//                      UPDATE                      //
//==================================================//
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela $filtro");	
	if ($linha_edit == "") {
		Tools::redireciona(URL_ADMIN);
	}

	//$tit_pag_geral = "Páginas &rsaquo; ".$linha_edit['titulo_pag'];
	$tit_pag_geral = "Editar página";

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
					'titulo_pag' => $_POST['titulo_pag'],
					'titulo' => $_POST['titulo'],
					'titulo2' => $_POST['titulo2'],
					'titulo3' => $_POST['titulo3'],
					'titulo4' => $_POST['titulo4'],
					'titulo5' => $_POST['titulo5'],
					'subtitulo' => $_POST['subtitulo'],
					'subtitulo2' => $_POST['subtitulo2'],
					'subtitulo3' => $_POST['subtitulo3'],
					'subtitulo4' => $_POST['subtitulo4'],
					'subtitulo5' => $_POST['subtitulo5'],
					'texto' => $_POST['ckeditor'],
					'texto2' => $_POST['ckeditor2'],		
					'texto3' => $_POST['ckeditor3'],		
					'texto4' => $_POST['ckeditor4'],		
					'texto5' => $_POST['ckeditor5']			
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


?>
