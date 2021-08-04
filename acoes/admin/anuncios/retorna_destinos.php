<?
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(false);

if (!empty($_GET['cidade'])) {

	$result_destinos = $conexao->prepare("SELECT * FROM anuncios_destinos WHERE cidade=:cidade ORDER BY id DESC");
	$result_destinos->bindValue(":cidade", $_GET['cidade'], PDO::PARAM_STR);
	$result_destinos->execute();

	if ($result_destinos->rowCount() > 0) {

    $destinos = $result_destinos->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($destinos);

  }

}
