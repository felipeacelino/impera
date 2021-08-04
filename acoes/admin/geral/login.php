<?
// Configurações
unset($_SESSION['msg_retorna']);
// Variáveis
$email_recebe = addslashes($_POST['email']);
$tit_pag_geral = "Acesso restrito";
$tabela = "admin";
$where = "WHERE email='$email_recebe' AND status=1";
$action_form = $_SERVER['REQUEST_URI'];
$acao = $_POST['acao'];
$token_confirma = $_POST['token'];
$msg_retorna = "";

// Instância das classes
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);

/* * * * * * * * * * * LOGAR * * * * * * * * * * */
if($acao == "loga"){	

	$resultado = $acoes->SelectSingle("SELECT * FROM $tabela $where LIMIT 1");

	$hash_banco = $resultado['senha'];

	$senha_recebe = Tools::protege($_POST['pass']);

	// Validação
	if($hash_banco != "" && password_verify(''.$senha_recebe.'', ''.$hash_banco.'')){
		
		$novo_token = $resultado['token'];
		$login = $resultado["email"];
		$chave_banco = htmlentities($resultado["chave"]);
		$id = (int)$resultado["id"]; 
		$ip = htmlentities($_SERVER["REMOTE_ADDR"]); 
		$hora = time(); 
		$chave = md5($login . $chave_banco . $ip . $hora);

		$_SESSION['token_Admin'] = $novo_token;
		$_SESSION['chaveBanco_Admin'] = $chave_banco;
		$_SESSION['userLojaAdmin'] = $login; 
		$_SESSION['chave_Admin'] = $chave; 
		$_SESSION['hora_Admin'] = $hora;
		$_SESSION['id_Admin'] = $id;
		$_SESSION['ip_Admin'] = $ip;

		// Dados Log
		$dados_log  = array(
			'id_admin' => $id,
			'data_acesso' => date("Y-m-d H:i:s"),
			'ip_acesso' => $ip,
			'user_agent' => $_SERVER['HTTP_USER_AGENT']
		);

		$log = new Crud("admin_acessos");	

		$verifica = $log->SelectSingle("SELECT * FROM admin_acessos WHERE id_admin = $id LIMIT 1");

		if ($verifica) {
			$id_log = $verifica['id']; 
			$log->Update($dados_log, " WHERE id = $id_log");
		} else {
			$log->Insert($dados_log);
		}

		// Log de acesso
		$msg = "user:".$login." - IP:".$ip." - Navegador:".$_SERVER['HTTP_USER_AGENT'];
		$path = ACESSOS_PATH."/admin";
		$nome_arquivo = "acessos_admin.txt";
		Tools::gravaLog($msg,$path,$nome_arquivo);

		$success_pag = URL."admin/index.php";
		Tools::redireciona($success_pag);

	}else{

		$_SESSION['msg_retorna_login'] = Tools::alertReturn(0,"Atenção","Os dados informados estão inválidos","error");
		$falha_pag = URL."admin/login.php";
		Tools::redireciona($falha_pag);

	}

}
/* * * * * * * * * * * FIM LOGAR * * * * * * * * * * */


?>