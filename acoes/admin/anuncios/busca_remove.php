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
  $delete_busca = $acoes->SelectSQL("DELETE FROM buscas_anuncios WHERE busca_id = " . Tools::protege($_POST['id_busca']) . " AND anuncio_id = " . Tools::protege($_POST['id']));
  echo "ok";
}
