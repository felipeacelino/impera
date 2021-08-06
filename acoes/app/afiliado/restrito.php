<?php

if (!isset($_SESSION)) { session_start(); } 
include ("".CLASS_PATH."/Usuarios.class.php");

$tabela = "afiliados";
$ambiente = "afiliado";
$usuario = new Usuarios($tabela, $ambiente);

// Verifica se o usuário está logado
if ($usuario->logado()) {
  $user = $usuario->getUserFromSession();
  //$msgPendentes = $usuario->getQtdMensagens();
  $user['link_afiliado'] = URL."?affiliate=".base64_encode($user['id'])."&type=c";
} 
// Redireciona para a página de login
else {
  Tools::redireciona(URL."afiliado/entrar");
}
