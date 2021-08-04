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

if (isset($_POST['cnpj']) && $_POST['cnpj'] != "") {

	$cnpj = $_POST['cnpj'];
	$tipo = $_POST['tipo'];
	
	if (!isset($_POST['id_edit'])) {
		$totalCNPJ = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE cnpj='".$cnpj."' AND tipo='$tipo'");
	} else {
		$idEdit = (int)$_POST['id_edit'];
		$totalCNPJ = $usuarios->SelectTotalSQL("SELECT id FROM $tabela WHERE cnpj='".$cnpj."' AND id <> $idEdit AND tipo='$tipo'");
	}   

	if ($totalCNPJ > 0) {
		echo "erro";
	} else {
		echo "ok";
	}
	
} 
