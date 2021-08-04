<? include(ACOES_APP_PATH."/institucionais/faq.php"); ?>
<?php
$titulo_pagina = "Perguntas Frequentes - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
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
      <h1 class="titulo" data-aos="fade-up">Perguntas Frequentes</h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PÁGINA -->
  <section class="secao last-secao">
    <div class="container">

      <div class="grid-8 grid-m-12 grid-s-12 segura-texto faq-lista">

        <? foreach ($faqLista as $faq) { ?>
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
  <!-- //PÁGINA -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
