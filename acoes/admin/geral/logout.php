<?
if(!isset($_SESSION)){session_start();}
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud("admin");

if (isset($_SESSION['userLojaAdmin'])) {

	unset($_SESSION['chaveBanco_Admin']);
	unset($_SESSION['userLojaAdmin']);
	unset($_SESSION['chave_Admin']);
	unset($_SESSION['hora_Admin']);
	unset($_SESSION['id_Admin']);
	unset($_SESSION['ip_Admin']);
	unset($_SESSION['ultimoClick']);
  
	if(isset($_GET['motivo']) && $_GET['motivo'] == "inatividade"){

		$_SESSION['msg_retorna_login'] = Tools::alertReturn(0,"Sessão expirada","Sem atividade por mais de 1 hora","warning");	
		Tools::redireciona(URL.'admin/login.php');

	}else{

		$_SESSION['msg_retorna_login'] = Tools::alertReturn(0,"Sessão finalizada","Você saiu da área de gerenciamento","warning");	
		Tools::redireciona(URL.'admin/login.php');

	}

}

?>