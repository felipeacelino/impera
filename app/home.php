<?php
/* $serv = $_SERVER['SCRIPT_NAME'];
$nomehost = $_SERVER['SERVER_NAME'];
if(!isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS'] != "on" ) {

$protocolo = 'https://';
echo '
<script>
location.href="'.$protocolo.$nomehost.'";
</script>
';
} */
$titulo_pagina = TITULO_PAGS;
$descr_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="home-full">

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- SLIDE -->
  <? include(APP_PATH.'/home/slide.php'); ?>

  <!-- BUSCA -->
  <? include(APP_PATH.'/estrutura/busca.php'); ?>

  <!-- ANÚNCIOS (VENDA) -->
  <? include(APP_PATH.'/home/destaques_venda.php'); ?>

  <!-- ANÚNCIOS (ALUGUEL) -->
  <? include(APP_PATH.'/home/destaques_aluguel.php'); ?>

  <!-- BLOCOS -->
  <? include(APP_PATH.'/home/blocos.php'); ?>

  <!-- PODEMOS AJUDAR -->
  <? include(APP_PATH.'/home/podemos_ajudar.php'); ?>

  <!-- REGIÕES -->
  <? include(APP_PATH.'/home/regioes.php'); ?>

  <!-- AJUDA -->
  <? include(APP_PATH.'/home/ajuda.php'); ?>
  
  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
