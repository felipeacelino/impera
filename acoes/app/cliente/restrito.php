<?php

if (!isset($_SESSION)) { session_start(); } 
include ("".CLASS_PATH."/Usuarios.class.php");

$tabela = "clientes";
$ambiente = "cliente";
$usuario = new Usuarios($tabela, $ambiente);

// Verifica se o usuário está logado
if ($usuario->logado()) {
  $user = $usuario->getUserFromSession();
  //$msgPendentes = $usuario->getQtdMensagens();
} 
// Redireciona para a página de login
else {
  Tools::redireciona(URL."cliente/entrar");
}
