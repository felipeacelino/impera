<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(false);

$newsletter = new Crud("newsletter");

if (!empty($_POST) && empty($_POST['cp'])) {

	$email = Tools::protege($_POST['email']);

	$dados = array(
		'email' => $email,
		'data_cad' => Tools::getDate(),
		'status' => 1
	);
	
	$cadastraEmail = $newsletter->Insert($dados);

	if ($cadastraEmail) {
		echo "ok";
	} else {
		echo "erro";
	}
	
} 
