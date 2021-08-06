<?php
header("Set-Cookie: name=value; httpOnly");
if(!isset($_SESSION)){session_start();} 
if(isset($_GET['rg-session'])){session_regenerate_id();}
include ("paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CONF_PATH."/whitelist.php");

Tools::debug(false);

// Partes da URL (Separadas por '/')
// Ex: $param1, $param2, $param3, etc...
$pagsPath = $_GET['path'];
$pagsArray = explode("/", $pagsPath);
$pagsTotal = count($pagsArray);
for ($i=0, $paramIndex=0; $i<$pagsTotal; $i++) {
  $paramIndex++;
  ${"param".$paramIndex} = Tools::protege($pagsArray[$i]);
}

$manutencao = false;

if (!$manutencao) {
  // Detalhe do imóvel
  if ($param1 != "" && !in_array($param1, $whitelistPags)) {
    include('app/imovel.php');
  }
  // Páginas proprietário
  else if ($param1 == "proprietario") { 
    if (file_exists('app/proprietario/'.$param2.'.php') && in_array($param2, $whitelistPags)) {
      include('app/proprietario/'.$param2.'.php');
    } else {
      include('app/nao-encontrado.php');
    }
  }
  // Páginas cliente
  else if ($param1 == "cliente") { 
    if (file_exists('app/cliente/'.$param2.'.php') && in_array($param2, $whitelistPags)) {
      include('app/cliente/'.$param2.'.php');
    } else {
      include('app/nao-encontrado.php');
    }
  }
  // Páginas corretor
  else if ($param1 == "corretor") { 
    if (file_exists('app/corretor/'.$param2.'.php') && in_array($param2, $whitelistPags)) {
      include('app/corretor/'.$param2.'.php');
    } else {
      include('app/nao-encontrado.php');
    }
  }
  // Páginas afiliado
  else if ($param1 == "afiliado") { 
    if (file_exists('app/afiliado/'.$param2.'.php') && in_array($param2, $whitelistPags)) {
      include('app/afiliado/'.$param2.'.php');
    } else {
      include('app/nao-encontrado.php');
    }
  }
  // Demais páginas
  else if (file_exists('app/'.$param1.'.php') && in_array($param1, $whitelistPags)) {
    include('app/'.$param1.'.php');
  } else if ($param1 != "") {
    include('app/nao-encontrado.php');
  } else {
    include('app/home.php');
  }
} else {
  include('app/manutencao.php');
}
