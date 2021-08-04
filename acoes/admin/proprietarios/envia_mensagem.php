<?php
if (!isset($_SESSION)) { session_start(); }
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".CLASS_PATH."/uploads.php");
Tools::debug(false);
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/email/email.class.php");

if (!empty($_POST)) {
  $mensagens = new Crud('proprietarios_mensagens');
  $idproprietario = Tools::protege($_POST['proprietario']);
  // proprietario
  $resultproprietario = $conexao->prepare("SELECT * FROM proprietarios WHERE id=:id LIMIT 1");
  $resultproprietario->bindValue(':id', $idproprietario, PDO::PARAM_INT);
  $resultproprietario->execute();
  $numproprietario = $resultproprietario->rowCount();
  if ($numproprietario > 0) {
    // Grava a mensagem
    $proprietario = $resultproprietario->fetch(PDO::FETCH_ASSOC);
    $dados = array(
      "id_usuario" => $idproprietario,
      "remetente" => "admin",
      "mensagem" => Tools::protege($_POST['mensagem']),
      "lida" => 0,
      "data" => Tools::getDateTime()
    );
    $insert = $mensagens->Insert($dados);
    if ($insert) {
      $ultimoId = $mensagens->getId();
      // Grava arquivo
      $path = ARQ_PATH."/proprietarios_mensagens/".$ultimoId;
			$upload = new Uploads("proprietarios_mensagens");
      $upload->uploadArquivos($_FILES['arquivos'], $path, $ultimoId, true, true);
      // Envia e-mail
      $dados_email = array(
        'titulo' => 'Nova Mensagem',
        'texto' => "Olá <b>".$proprietario['nome']."</b>! Você recebeu uma nova mensagem. Clique no botão abaixo para acessar sua conta e visualizar a mensagem.",
        'botao' => array(
          'texto' => 'Acessar Conta',
          'url' => URL."proprietario/entrar"
        )
      );
      $assunto = "Nova mensagem";
      $destinatarios = array($proprietario['email']);
      $responderParaNome = SMTP_USER;
      $responderParaEmail = SMTP_USER;
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
      //echo $email->getPrev();		
      $email->enviar();
      echo "ok";
    } else {
      echo "erro";
    }
  }
}
