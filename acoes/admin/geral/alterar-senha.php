<?
// Configurações
unset($_SESSION['msg_retorna_login']);
// Variáveis
$tit_pag_geral = "Cadastrar nova senha";
$tabela = "admin";
$where = "";
$action_form = $_SERVER['REQUEST_URI'];
$acao = $_POST['acao'];
$token_confirma = $_POST['token'];
$msg_retorna = "";

// Instância das classes
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);

Tools::debug(false);

// Verifica se veio ID e CHAVE e se são válidos
if($acao != 'update'){

	if(isset($_GET['id_user']) && $_GET['id_user']!="" && $_GET['key']!=""){

		$id_user = base64_decode($_GET['id_user']);
		$chave_user = $_GET['key'];
		
		$verifica_user = $conexao->prepare("SELECT * FROM admin WHERE id=:id AND chave =:chave");
		$verifica_user->bindValue(":id", $id_user, PDO::PARAM_INT);
		$verifica_user->bindValue(":chave", $chave_user, PDO::PARAM_INT);
		$verifica_user->execute();

		// Se foi encontrado algum usuário
		if ($verifica_user->rowCount() == 0) {
			$retorno_pag = URL."admin/login.php";;
			Tools::redireciona($retorno_pag);
		}
		
	} else {

		$retorno_pag = URL."admin/login.php";;
		$acoes->RetornoPag($retorno_pag);
		
	}

} 
// Altera a senha
else if($acao == "update"){	

	$id_user = base64_decode($_POST['id_user']);

	$senha_insere = Tools::geraHash("password", $_POST['senha']);
	$chave_insere = Tools::geraHash("md5",$hoje);

	$dados = array( 
		'senha' => $senha_insere,
		'chave' => $chave_insere
	);

	$operacao = $acoes->Update($dados, "WHERE id = $id_user");

	if ($operacao) {
		
		$_SESSION['msg_retorna_login'] = Tools::alertReturn(0,"Concluído","Senha alterada com sucesso","success");		
		$retorno_pag = URL."admin/login.php";
		Tools::redireciona($retorno_pag);

	}else{
	
		$_SESSION['msg_retorna_login'] = Tools::alertReturn(4);
		$retorno_pag = $_SERVER['REQUEST_URI'];
		Tools::redireciona($retorno_pag);

	}
}


?>