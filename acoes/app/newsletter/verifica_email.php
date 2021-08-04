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

if (isset($_POST['email']) && $_POST['email'] != "") {

    $email = Tools::protege($_POST['email']);

    $totalEmail = $newsletter->SelectTotalSQL("SELECT id FROM newsletter WHERE email='".$email."'");

	if ($totalEmail > 0) {
		echo "erro";
	} else {
		echo "ok";
	}
	
} 
