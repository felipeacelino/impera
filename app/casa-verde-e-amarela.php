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
  <section class="banner-inst" style="background-image: url('<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-2000-0/<?=$pagina['banner']?>');">
    <span class="mascara"></span>
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto" data-aos="fade-up">
        <h1 class="titulo"><?=$pagina['titulo']?></h1>
        <h2 class="subtitulo"><?=$pagina['subtitulo']?></h2>
        <div class="btn-container">
          <a href="<?=URL?>imoveis" class="btn btn-white">Buscar Imóveis</a>
        </div>
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
  <section class="secao">
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto">
        <div class="row">
          <div class="grid-4 grid-s-8 segura-texto">
            <div class="inst-foto"><figure><img src="<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-800-0/<?=$pagina['foto2']?>" alt="<?=$pagina['titulo2']?>"></figure></div>
          </div>
        </div>
        <h2 class="titulo"><?=$pagina['titulo2']?></h2>
        <div class="texto"><?=$pagina['texto2']?></div>
      </div>
    </div>
  </section>
  <!-- //INSTITUCIONAL -->

  <!-- DESTAQUES (ÍCONES) -->
  <? if ($numPagIcons > 0) { ?>
  <section class="secao blocos-dest-pag" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_blocos.jpg');">
    <span class="mascara"></span>
    <div class="container">
      <div class="grid-12">
        <h2 class="titulo"><?=$pagina['titulo3']?></h2>
        <h3 class="subtitulo-secao"><?=$pagina['subtitulo3']?></h3>
      </div>

      <ul class="blocos-faq">
        <? foreach ($pagIcons as $icon) { ?>
          <li class="grid-4 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <? if ($icon['icone'] != "") { ?>
                  <span class="bloco-faq-icon"><i class="<?=$icon['icone']?>"></i></span>
                <? } else { ?>
                  <figure>
                    <img src="<?=URL?>uploads/img/paginas_icones/<?=$icon['id']?>/thumb-250-250/<?=$icon['foto']?>" alt="<?=$icon['titulo']?>">
                  </figure>
                <? } ?>
                <h2><?=$icon['titulo']?></h2>
              </div>
              <div class="texto"><?=$icon['texto']?></div>
            </div>
          </li>
        <? } ?>
      </ul>
    </div>
  </section>
  <? } ?>
  <!-- //DESTAQUES -->

  <!-- PERGUNTAS -->
  <? if ($numPagFaq > 0) { ?>
  <section id="pag-faq" class="secao inst-faq">
    <div class="container">
      <div class="grid-12"><h2 class="titulo">Perguntas Frequentes</h2></div>
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
