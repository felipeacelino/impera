<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
//include ("".CLASS_PATH."/email/email.class.php");
include ("".CLASS_PATH."/Recaptcha.class.php");

Tools::debug(false);

$comentarios = new Crud("blog_posts_comentarios");

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

    $dados = array(
      'post_id' => $_POST['post_id'],
      'nome' => $_POST['nome'],
      'email' => $_POST['email'],
      'comentario' => $_POST['comentario'],
      'data_cad' => Tools::getDateTime(),
      'status' => 2
    );
  
    $cadastraComentario = $comentarios->Insert($dados);
  
    if ($cadastraComentario) {
      echo "ok";
    } else {
      echo "erro";
    }
  } else {
    echo "erro";
  }
}
