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
  $reCaptchaIsValid = true;
  if ($reCaptchaIsValid) {

    $visitas = new Crud("anuncios_visitas");

    $statusVisita = $_POST['residente'] == "1" ? 2 : 1;
    $dataVisita = Tools::protege($_POST['data'])." ".Tools::protege($_POST['horario']).":00";

    $dados = array(
      'anuncio_id' => Tools::protege($_POST['anuncio_id']),
      'tipo' => Tools::protege($_POST['tipo']),
      'origem' => "user",
      'nome' => Tools::protege($_POST['nome']),
      'email' => Tools::protege($_POST['email']),
      'telefone' => Tools::protege($_POST['telefone']),
      'data' => $dataVisita,
      'status' => $statusVisita,
      'data_cad' => Tools::getDateTime()
    );

    if (isset($_POST['corretor_id']) && $_POST['corretor_id'] != "") {
      $dados['id_corretor'] = Tools::protege($_POST['corretor_id']);
    }
    if (isset($_POST['cliente_id']) && $_POST['cliente_id'] != "") {
      $dados['id_cliente'] = Tools::protege($_POST['cliente_id']);
    }

    $gravaVisita = $visitas->Insert($dados);

    if ($gravaVisita) {

      // Envia e-mail
      $dados_email = array(
        'titulo' => 'Novo Agendamento',
        'infos' => array(
          'Nome' => Tools::protege($_POST['nome']),
          'E-mail' => Tools::protege($_POST['email']),
          'Telefone' => Tools::protege($_POST['telefone']),
          'Tipo de visita' => $tiposVisita[Tools::protege($_POST['tipo'])]['titulo'],
          'Data' => Tools::formataData($_POST['data']),
          'Horário' => Tools::protege($_POST['horario']),
        )
      );
      $assunto = "Novo Agendamento";
      $destinatarios = array(EMAIL_AGENDAMENTOS);
      $responderParaNome = $_POST['nome'];
      $responderParaEmail = $_POST['email'];
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
      //echo $email->getPrev();
      //echo $email->getErro();
      $email->enviar();

      echo "ok";

    } else {
      echo "erro ao gravar";
    }
  } else {
    echo "recaptcha";
  }
}
