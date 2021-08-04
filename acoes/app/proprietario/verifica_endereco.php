<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(false);

$tabela = "proprietarios";
$usuarios = new Crud($tabela);

$totalAn = 0;

$idUpdate = Tools::protege($_GET['id_update']);
$finalidade = Tools::protege($_GET['finalidade']);
$logradouro = Tools::protege($_GET['logradouro']);
$numero = Tools::protege($_GET['numero']);
$complemento = Tools::protege($_GET['complemento']);
$bairro_id = Tools::protege($_GET['bairro_id']);
$cidade_id = Tools::protege($_GET['cidade_id']);
$estado_id = Tools::protege($_GET['estado_id']);

if ($finalidade != "" && $logradouro != "" && $numero != "") {
  if ($idUpdate != "") {
    $totalAn = $usuarios->SelectTotalSQL("SELECT id FROM anuncios WHERE id<>$idUpdate AND finalidade='$finalidade' AND logradouro='$logradouro' AND numero='$numero' AND complemento='$complemento' AND bairro_id='$bairro_id' AND cidade_id='$cidade_id' AND estado_id='$estado_id'");
  } else {
    $totalAn = $usuarios->SelectTotalSQL("SELECT id FROM anuncios WHERE finalidade='$finalidade' AND logradouro='$logradouro' AND numero='$numero' AND complemento='$complemento' AND bairro_id='$bairro_id' AND cidade_id='$cidade_id' AND estado_id='$estado_id'");
  }
}

echo json_encode(array('total' => $totalAn));
