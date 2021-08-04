<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(true);

$tabela = "anuncios";

// Id
$id = $_GET['id'];

// Atualiza o termos
$updtTermos = $conexao->prepare("UPDATE anuncios SET aceitacao_contrato=1 WHERE id=:id");
$updtTermos->bindValue(":id", $id, PDO::PARAM_INT);
$updtTermos->execute();

if ($updtTermos) {
    echo "ok";
} else {
    echo "erro";
}
