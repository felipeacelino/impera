<?php

session_start();

include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
include("" . ACOES_ADMIN_PATH . "/geral/restritos.php");
include("" . ACOES_ADMIN_PATH . "/geral/user.php");
include("" . ACOES_APP_PATH . "/gerais/filtros.php");

Tools::debug(false);

$db = new Init();
$conexao = $db->conectar();

$acoes = new Crud("buscas_anuncios");

if (!empty($_POST) && $_POST != "") {
  $dados = array(
    'anuncio_id' => Tools::protege($_POST['id']),
    'busca_id' => Tools::protege($_POST['id_busca'])
  );
  $insert_busca = $acoes->Insert($dados);
  if ($insert_busca) {
    echo "ok";
  }else{
    echo "erro";
  }
}
