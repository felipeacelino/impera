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

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo" style="background-image: url('<?=URL?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara"></span>
    <div class="container">
      <h1 class="titulo" data-aos="fade-up"><?=$pagina['titulo']?></h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

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
