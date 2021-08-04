<?php
if (!isset($_SESSION)) { session_start(); } 
include ("".CLASS_PATH."/Usuarios.class.php");
$tabela = "proprietarios";
$ambiente = "corretor";
$usuario = new Usuarios($tabela, $ambiente);

$idUser = $param3;
$chaveUser = $param4;

if ($idUser != "" && $chaveUser != "") {
  // Verifica se é um usuário válido
  if (!$usuario->validUserRec($idUser, $chaveUser)) {
    Tools::redireciona(URL."corretor/entrar");
  }
} else {
  Tools::redireciona(URL);
}
