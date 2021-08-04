<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/email/email.class.php");
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

    $dados_email = array(
      'titulo' => 'Formulário de Contato',
      'infos' => array(
        'Nome' => Tools::protege($_POST['nome']),
        'E-mail' => Tools::protege($_POST['email']),
        'Telefone' => Tools::protege($_POST['telefone']),
        'Assunto' => Tools::protege($_POST['assunto']),
        'Mensagem' => Tools::protege($_POST['mensagem'])
      )
    );
    $assunto = "Novo Contato";
    $destinatarios = array(EMAIL_CONTATO);
    $responderParaNome = $_POST['nome'];
    $responderParaEmail = $_POST['email'];
    $anexos = array();
    $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
    //echo $email->getPrev();		
    if ($email->enviar()) {
      echo "ok";
    } else {
      echo $email->getErro();
    }

  } else {
    echo "erro";
  }
}
