<?php
if (!isset($_SESSION)) {
  session_start();
}
include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . CLASS_PATH . "/uploads.php");
Tools::debug(false);
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
include("" . ACOES_APP_PATH . "/corretor/restrito.php");
include("" . CLASS_PATH . "/email/email.class.php");

if (!empty($_POST)) {
  $mensagens = new Crud('corretores_mensagens');
  $idUser = (int) $user['id'];
  // Corretor
  $resultCorretor = $conexao->prepare("SELECT * FROM corretores WHERE id=:id LIMIT 1");
  $resultCorretor->bindValue(':id', $idUser, PDO::PARAM_INT);
  $resultCorretor->execute();
  $numCorretor = $resultCorretor->rowCount();
  $corretor = $resultCorretor->fetch(PDO::FETCH_ASSOC);
  $tabela = 'corretores_mensagens';
  // Grava a mensagem
  $dados = array(
    "id_usuario" => $idUser,
    "remetente" => "usuario",
    "mensagem" => Tools::protege($_POST['mensagem']),
    "lida" => 0,
    "data" => Tools::getDateTime()
  );
  $insert = $mensagens->Insert($dados);
  if ($insert) {
    $ultimoId = $mensagens->getId();
    // Grava arquivo
    $path = ARQ_PATH . "/".$tabela."/" . $ultimoId;
    $upload = new Uploads($tabela);
    $upload->uploadArquivos($_FILES['arquivos'], $path, $ultimoId, true, true);
    // Envia e-mail
    $dados_email = array(
      'titulo' => 'Nova Mensagem',
      'texto' => "Você recebeu uma nova mensagem do corretor <b>" . $corretor['nome'] . "</b> Clique no botão abaixo para acessar sua conta e visualizar a mensagem.",
      'botao' => array(
        'texto' => 'Acessar Administração',
        'url' => URL . "admin"
      )
    );
    $assunto = "Nova mensagem - Corretor";
    $destinatarios = array(EMAIL_CONTATO);
    $responderParaNome = $corretor['nome'];
    $responderParaEmail = $corretor['email'];
    $anexos = array();
    $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
    //echo $email->getPrev();		
    $email->enviar();
    echo "ok";
  } else {
    echo "erro";
  }
}
