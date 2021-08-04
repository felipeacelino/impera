<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(false);

$tabela = "proprietarios";
$usuarios = new Crud($tabela);

if (isset($_POST['email']) && $_POST['email'] != "") {

	$email = Tools::protege($_POST['email']);
	$tipo = Tools::protege($_POST['tipo']);
	
	if (!isset($_POST['id_edit'])) {
		$totalEmail = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE email='".$email."' AND tipo='$tipo'");
	} else {
		$idEdit = (int)$_POST['id_edit'];
		$totalEmail = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE email='".$email."' AND id <> $idEdit AND tipo='$tipo'");
	}   

	if ($totalEmail > 0) {
		echo "erro";
	} else {
		echo "ok";
	}
	
} 
