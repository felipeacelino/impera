<?php
$titulo_pagina = "Página não encontrada - ".TITULO_PAGS;
$descr_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo" style="background-image: url('<?=URL?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara default"></span>
    <div class="container">
      <h1 class="titulo" data-aos="fade-up">Página Não Encontrada!</h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PÁGINA -->
  <section class="secao last-secao">
    <div class="container">

      <h3 class="subtitulo center">A página que você está tentando acessar não foi encontrada.</h3>

      <div class="btn-container">
        <a href="<?=URL?>" class="btn btn-primario btn-pulse">Voltar para o início</a>
        <br><br>
      </div>

    </div>
  </section>
  <!-- //PÁGINA -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
