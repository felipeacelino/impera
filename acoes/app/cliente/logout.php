<?php
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/Usuarios.class.php");

Tools::debug(false);

$tabela = "clientes";
$ambiente = "cliente";
$usuario = new Usuarios($tabela, $ambiente);
$usuario->logout();

Tools::redireciona(URL."cliente/entrar");
