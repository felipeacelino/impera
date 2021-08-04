<?php 

if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".CONF_PATH."/conf.php");

if (isset($_POST['email_verifica']) && $_POST['email_verifica'] != "") {

	$emailVerifica = $_POST['email_verifica'];

	$tabela = $_POST['tabela'];
	$verificaEmail = new Crud($tabela);

	if (isset($_POST['id_verifica']) && $_POST['id_verifica'] != "" && $_POST['id_verifica'] != "null") {
		$idVerifica = $_POST['id_verifica'];
		$total = $verificaEmail->SelectTotalSQL("SELECT id FROM $tabela WHERE email = '$emailVerifica' AND id <> $idVerifica");
	} else {
		$total = $verificaEmail->SelectTotalSQL("SELECT id FROM $tabela WHERE email = '$emailVerifica'");
	}

	echo $total > 0 ? "false" : "true"; 

}
