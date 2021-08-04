<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/email/email.class.php");
include ("".CLASS_PATH."/Usuarios.class.php");
include ("".CLASS_PATH."/Recaptcha.class.php");

Tools::debug(false);

if (!empty($_POST)) {

  // RECAPTCHA
  $reCaptcha = new ReCaptcha();
  $reCaptchaIsValid = false;
  $reCaptchaRespPost = $_POST["g-recaptcha-response"];
  if ($reCaptchaRespPost != "") {
    $reCaptchaResp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $reCaptchaRespPost);
    $reCaptchaIsValid = $reCaptchaResp->success;
  }
  if ($reCaptchaIsValid) {
    $tabela = "clientes";
    $ambiente = "cliente";
    $usuario = new Usuarios($tabela, $ambiente);
    
    if ($usuario->cadastrar($_POST)) {
      echo "ok";
    } else {
      echo "erro";
    }
  } else {
    echo "erro recaptcha";
  }
} 
