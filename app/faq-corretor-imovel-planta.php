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
  <section class="banner-titulo with-btn" style="background-image: url('<?=URL?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara"></span>
    <div class="container">
      <a href="<?=URL?>para-voce-corretor" class="btn btn-white pag-btn-back"><i class="fas fa-arrow-left"></i></a>
      <h1 class="titulo" data-aos="fade-up"><?=$pagina['titulo']?></h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PERGUNTAS -->
  <? if ($numPagFaq > 0) { ?>
  <section id="pag-faq" class="secao inst-faq">
    <div class="container">
      <div class="grid-8 grid-m-12 grid-s-12 segura-texto faq-lista">
        <? foreach ($pagFaq as $faq) { ?>
          <!-- Repete -->
          <div class="faq" data-aos="fade-up">
            <div class="faq-pergunta"><i></i> <?=$faq['titulo']?></div>
            <div class="faq-resposta">
              <div class="texto"><?=$faq['texto']?></div>
            </div>
          </div>
          <!-- //Repete -->
        <? } ?>
      </div>
    </div>
  </section>
  <? } ?>
  <!-- //PERGUNTAS -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
