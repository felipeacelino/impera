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

if (isset($_POST['cpf']) && $_POST['cpf'] != "") {

	$cpf = $_POST['cpf'];
	$tipo = $_POST['tipo'];
	
	if (!isset($_POST['id_edit'])) {
		$totalCPF = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE cpf='".$cpf."' AND tipo='$tipo'");
	} else {
		$idEdit = (int)$_POST['id_edit'];
		$totalCPF = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE cpf='".$cpf."' AND tipo='$tipo' AND id <> $idEdit");
	}   

	if ($totalCPF > 0) {
		echo "erro";
	} else {
		echo "ok";
	}
	
} 
