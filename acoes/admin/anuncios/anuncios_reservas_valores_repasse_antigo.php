<?
// CONFIGURAÇÕES
$tabela = "anuncios_reservas";
$order = "ORDER BY id DESC";
$paginacao = true;
$num_regs = 15;
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

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// Categoria
$reserva =  $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado2");
if ($reserva == "") {
	Tools::redireciona("".URL."admin/".$pasta_modulo."/".$tabela."/".TOKEN."/view");
}

$filtro = "WHERE id = ".$reserva['id'];
switch ($acao_enviado) { 
	case 'insert':
		$tit_pag_geral = "#".$reserva['codigo']." &rsaquo; Repasse";
		break;
	case 'edit':
		$tit_pag_geral = "#".$reserva['codigo']." &rsaquo; Repasse";
		break;
	default:
		$tit_pag_geral = "#".$reserva['codigo']." &rsaquo; Repasse";
		break;
}

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

// URL RETORNO GERAL
$retorno_geral = $_GET['p2'] != '' ?
"".URL."admin/".$pasta_modulo."/".$tabela."/".TOKEN."/view?p=".$_GET['p2'] :
"".URL."admin/".$pasta_modulo."/".$tabela."/".TOKEN."/view";

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$reserva['id'];
if (isset($_GET['p']) && $_GET['p'] != '') {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$reserva['id']."?p=".$_GET['p'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$reserva['id']."?p=".$_GET['p'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$reserva['id']."?p=".$_GET['p'];
} else {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$reserva['id'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$reserva['id'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$reserva['id'];
}	

// CONFIGURAÇÕES DE RETORNO
if($acao == "delete"){    
	$retorno_pag = $current_url_view;
}else{
	$retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {	

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
//                      UPDATE                      //
//==================================================//
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado2 LIMIT 1");	

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
					'taxa_repasse' => $_POST['taxa_repasse'] != "" ? Tools::formataMoedaBd($_POST['taxa_repasse']) : 0.00,
					'valor_repasse' => $_POST['valor_repasse'] != "" ? Tools::formataMoedaBd($_POST['valor_repasse']) : 0.00,
					'data_repasse' => Tools::formataDataBd($_POST['data_repasse']),
					'status_repasse' => $_POST['status_repasse'] != "" ? $_POST['status_repasse'] : 0
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
