<?
if (!isset($_SESSION)) { session_start(); }
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".CLASS_PATH."/uploads.php");
Tools::debug(false);
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include(ACOES_APP_PATH."/corretor/restrito.php");

$conn=new Init();
$conexao = $conn->conectar();

if (isset($_POST['ordem'])) {
	$ordem = $_POST['ordem'];
	$acoes = new Crud("anuncios_fotos");
	$errosCount = 0;
	foreach ($ordem as $key => $value) {
		$update = $acoes->Update(
			array(			
				"ordem" => $key + 1
			),
			"WHERE id=$value"
		);
		if (!$update) {
			$errosCount++;
		}
	}
	if ($errosCount == 0) {
    echo "ok";
    die();
	} else {
    echo "erro";
    die();
	}
}
