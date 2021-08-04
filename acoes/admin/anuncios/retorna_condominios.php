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

	$result_anuncios = $conexao->prepare("SELECT * FROM anuncios_condominios WHERE cidade=:cidade ORDER BY id DESC");
	$result_anuncios->bindValue(":cidade", $_GET['cidade'], PDO::PARAM_STR);
	$result_anuncios->execute();

	if ($result_anuncios->rowCount() > 0) {

    $condominios = $result_anuncios->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($condominios);

  }

}
