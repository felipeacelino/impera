<?php

session_start();

include ("../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");

Tools::debug(false);

include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/uploads.php");
include ("".ACOES_ADMIN_PATH."/geral/restritos.php");
include ("".ACOES_ADMIN_PATH."/geral/user.php");

$title_site = TITULO_PAGS;
$descr_site = "";

include ('estrutura/head.php');
include ('estrutura/colors.php');

?>


<body class="nav-md">
	<div class="container body">
      	<div class="main_container">


<!--inicio do conteudo -->

<?

include ('estrutura/menu.php');
include ('estrutura/topo.php');

$pag_name = $_GET['path'];
$pag_name = explode('/', $pag_name);
			
$pasta_modulo = $pag_name[0];
$pag_include = $pag_name[1];
$token_enviado = $pag_name[2];
$acao_enviado = $pag_name[3];
$id_enviado = $pag_name[4];
$id_enviado2 = $pag_name[5];
$filtro_enviado = $pag_name[6];
$filtro_enviado2 = $pag_name[7]; 

if(isset($pag_include) && file_exists('modulos/'.$pasta_modulo.'/'.$pag_include.'.php') && TOKEN == $token_enviado){

	if (in_array($pag_include, $permissoes_usuarios_admin) || ID_USUARIO_ADMIN == 1) {

		require ('modulos/'.$pasta_modulo.'/'.$pag_include.'.php');

	} else {

		require ('modulos/geral/acesso-negado.php');

	}

}else{

	require ('modulos/geral/dashboard.php');		

}


?>
<!--fim conteudo -->
<!--rodape -->

<!--fim site -->

<?php include ("estrutura/footer.php");?>
