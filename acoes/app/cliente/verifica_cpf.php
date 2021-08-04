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

if (isset($_POST['cpf']) && $_POST['cpf'] != "") {

	$cpf = $_POST['cpf'];
	
	if (!isset($_POST['id_edit'])) {
		$totalCPF = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE cpf='".$cpf."'");
	} else {
		$idEdit = (int)$_POST['id_edit'];
		$totalCPF = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE cpf='".$cpf."' AND id <> $idEdit");
	}   

	if ($totalCPF > 0) {
		echo "erro";
	} else {
		echo "ok";
	}
	
} 
