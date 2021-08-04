<?php
if (!isset($_SESSION)) { session_start(); } 
include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
include("" . CLASS_PATH . "/email/email.class.php");
include("" . CLASS_PATH . "/Usuarios.class.php");

Tools::debug(false);

if (!empty($_POST)) {

  $tabela = "proprietarios";
  $ambiente = "proprietario";
  $usuario = new Usuarios($tabela, $ambiente);

  $idUser = $_POST['id_user'];
  $chaveUser = $_POST['chave_user'];
  $senha = $_POST['senha'];

  if ($usuario->cadastrarNovaSenha($idUser, $chaveUser, $senha)) {
    echo "ok";
  } else {
    echo "erro";
  }
}
