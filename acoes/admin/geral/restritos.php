<?
if(!defined('PATH_ATUAL')) die();
if(!isset($_SESSION)){session_start();}

if (isset($_SESSION['userLojaAdmin'])) {
	
	$login = addslashes($_SESSION['userLojaAdmin']);
	$hora = addslashes($_SESSION['hora_Admin']);      
	$chave_banco = $_SESSION['chaveBanco_Admin']; 
	$chave = $_SESSION['chave_Admin']; 
	$ip = $_SESSION['ip_Admin']; 
	$id = $_SESSION['id_Admin'];
	define('TOKEN',$_SESSION['token_Admin']);

	if ($_SESSION['chave_Admin'] != md5($login . $chave_banco . $ip . $hora)) { 
		
		Tools::alert("Dados inválidos!");
		Tools::redireciona(URL."acoes/admin/geral/logout.php");
	
	}

	$hora = time();
	$chave = md5($login . $chave_banco . $ip . $hora);

	$_SESSION['chaveBanco_Admin'] = $chave_banco;
	$_SESSION['userLojaAdmin'] = $login; 
	$_SESSION['chave_Admin'] = $chave; 
	$_SESSION['hora_Admin'] = $hora;
	$_SESSION['id_Admin'] = $id;
	$_SESSION['ip_Admin'] = $ip;

	if ( isset($_SESSION['ultimoClick']) && !empty($_SESSION['ultimoClick']) ) {
	
		$tempoAtual = time();
	
		if (($tempoAtual - $_SESSION['ultimoClick']) > '3600' ) {
			Tools::redireciona(URL."acoes/admin/geral/logout.php?motivo=inatividade");			
		} else {
			$_SESSION['ultimoClick'] = time();
		}

	} else {
		$_SESSION['ultimoClick'] = time();
	}

} else {

	Tools::redireciona(URL."admin/login.php");
	
}

?>