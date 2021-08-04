<?php

if (!isset($_SESSION)) { session_start(); } 
include ("".CLASS_PATH."/Usuarios.class.php");

$tabela = "proprietarios";
$ambiente = "corretor";
$usuario = new Usuarios($tabela, $ambiente);

// Verifica se o usuário está logado
if ($usuario->logado()) {
  $user = $usuario->getUserFromSession();
  // Verifica se o cadastro está completo
  if (!$usuario->cadastroCompleto() && $param2 != "meus-dados") {
    Tools::redireciona(URL."corretor/meus-dados");
  }
} 
// Redireciona para a página de login
else {
  Tools::redireciona(URL."corretor/entrar");
}
