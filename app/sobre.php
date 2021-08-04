<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = $pagina['titulo_pag']." - ".TITULO_PAGS;
$descr_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BANNER -->
  <section class="banner-inst min-height" style="background-image: url('<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-2000-0/<?=$pagina['banner']?>');">
    <span class="mascara"></span>
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto" data-aos="fade-up">
        <h2 class="subtitulo" style="margin-top: 0px;"><?=$pagina['subtitulo']?></h2>
        <h1 class="titulo"><?=$pagina['titulo']?></h1>
      </div>
    </div>
  </section>
  <div class="section-divider sd-m8">
    <div class="section-divider-inner">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
      </svg>
    </div>
  </div>
  <!-- //BANNER -->

  <!-- INSTITUCIONAL -->
  <section class="secao last-secao">
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto">
        <div class="texto"><?=$pagina['texto']?></div>
      </div>
    </div>
  </section>
  <!-- //INSTITUCIONAL -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
