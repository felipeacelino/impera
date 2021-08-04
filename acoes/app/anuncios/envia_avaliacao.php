<?php
if (!isset($_SESSION)) { session_start(); } 
include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
//include ("".CLASS_PATH."/email/email.class.php");

Tools::debug(false);

$avaliacoes = new Crud("anuncios_avaliacoes");

if (!empty($_POST)) {

  $dados = array(
    'anuncio_id' => $_POST['anuncio_id'],
    'estrelas' => Tools::somenteNumeros($_POST['avaliacao']),
    'avaliacao' => Tools::protege($_POST['comentario']),
    'nome' => Tools::protege($_POST['nome']),
    'data_cad' => Tools::getDateTime(),
    'status' => 2
  );

  $cadastraAvaliacao = $avaliacoes->Insert($dados);

  if ($cadastraAvaliacao) {
    echo "ok";
  } else {
    echo "erro";
  }
}
