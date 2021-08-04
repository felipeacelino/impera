<?
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".ACOES_ADMIN_PATH."/geral/restritos.php");
include ("".ACOES_ADMIN_PATH."/geral/user.php");

$conn=new Init();
$conexao = $conn->conectar();

if ( ! defined('PATH_ATUAL')) exit; 

if (isset($_POST['nova_ordem'], $_POST['tabela'])) {

	$nova_ordem = $_POST['nova_ordem'];
	$tabela = $_POST['tabela'];

	$acoes = new Crud($tabela);
	$errosCount = 0;

	foreach ($nova_ordem as $key => $value) {
		
		$update = $acoes->Update(
			array(			
				"ordem_exibicao" => $key+1
			),
			"WHERE id = $value"
		);

		if (!$update) {
			$errosCount++;
		}

	}

	if ($errosCount == 0) {
		echo "ok";
	} else {
		echo "erro";
	}

}

?> 
