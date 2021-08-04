<?
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

session_start();

if(isset($_GET['retorno']) && isset($_GET['pagina'])){

	$pagina = $_GET['pagina'];
	$retorno = $_GET['retorno'];

	unset($_SESSION[$pagina]['filtros']);

	Tools::redireciona($retorno);

}else{
	Tools::redireciona(URL_ADMIN);
}

?> 
