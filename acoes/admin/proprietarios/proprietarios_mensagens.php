<?
// CONFIGURAÇÕES
$tabela = "proprietarios_mensagens";
$tabelaOrigem = "proprietarios";
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
$origem =  $acoes->SelectSingle("SELECT * FROM $tabelaOrigem WHERE id = $id_enviado2");
if ($origem == "") {
	Tools::redireciona("".URL."admin/".$pasta_modulo."/".$tabelaOrigem."/".TOKEN."/view");
}

$filtro = "WHERE id_usuario = ".$origem['id'];
$idUser = $origem['id'];

$origem['foto'] = $origem['foto'] != "" ? URL."uploads/img/".$tabelaOrigem."/".$origem['id']."/thumb-150-150/".$origem['foto'] : URL."static/img/admin/user-profile.png";

switch ($acao_enviado) { 
	case 'insert':
		$tit_pag_geral = $origem['nome']." &rsaquo; Mensagens";
		break;
	case 'edit':
		$tit_pag_geral = $origem['nome']." &rsaquo; Mensagens";
		break;
	default:
		$tit_pag_geral = $origem['nome']." &rsaquo; Mensagens";
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
"".URL."admin/".$pasta_modulo."/".$tabelaOrigem."/".TOKEN."/view?p=".$_GET['p2'] :
"".URL."admin/".$pasta_modulo."/".$tabelaOrigem."/".TOKEN."/view";

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$origem['id'];
if (isset($_GET['p']) && $_GET['p'] != '') {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$origem['id']."?p=".$_GET['p'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$origem['id']."?p=".$_GET['p'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$origem['id']."?p=".$_GET['p'];
} else {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$origem['id'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$origem['id'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$origem['id'];
}	

// CONFIGURAÇÕES DE RETORNO
if($acao == "delete"){    
	$retorno_pag = $current_url_view;
}else{
	$retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

// Mensagens
$resultMensagens = $conexao->prepare("SELECT * FROM $tabela WHERE id_usuario=:id_usuario ORDER BY id ASC");
$resultMensagens->bindValue(':id_usuario', $idUser, PDO::PARAM_INT);
$resultMensagens->execute();
$numMensagens = $resultMensagens->rowCount();
$mensagens = $resultMensagens->fetchAll(PDO::FETCH_ASSOC);

foreach ($mensagens as $kMensagem => $vMensagem) {
  $mensagens[$kMensagem]['tipo'] = $vMensagem['remetente'] == "usuario" ? "recebida" : "enviada";
  $mensagens[$kMensagem]['foto'] = $vMensagem['remetente'] == "usuario" ? $origem['foto'] : LOGO_ADMIN;
  $mensagens[$kMensagem]['nome'] = $vMensagem['remetente'] == "usuario" ? $origem['nome'] : TITULO_PAGS;
  $mensagens[$kMensagem]['email'] = $vMensagem['remetente'] == "usuario" ? $origem['email'] : EMAIL_ATENDIMENTO;
  $mensagens[$kMensagem]['data'] = Tools::formataData($vMensagem['data']) == Tools::formataData(Tools::getDate()) ? substr(explode(" ",$vMensagem['data'])[1], 0, 5) : Tools::formataData($vMensagem['data']);
}

// Marca todas mensagens como lidas
$updateMensagens = $acoes->Update(array("lida" => 1), "WHERE id_usuario=$idUser AND lida=0 AND remetente='usuario'");

?>
