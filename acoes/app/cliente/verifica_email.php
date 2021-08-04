<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(false);

$tabela = "clientes";
$usuarios = new Crud($tabela);

if (isset($_POST['email']) && $_POST['email'] != "") {

	$email = Tools::protege($_POST['email']);
	
	if (!isset($_POST['id_edit'])) {
		$totalEmail = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE email='".$email."'");
	} else {
		$idEdit = (int)$_POST['id_edit'];
		$totalEmail = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE email='".$email."' AND id <> $idEdit");
	}   

	if ($totalEmail > 0) {
		echo "erro";
	} else {
		echo "ok";
	}
	
} 
