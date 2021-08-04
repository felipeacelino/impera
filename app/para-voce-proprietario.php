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
  <section class="banner-inst banner-inst-primx banner-prop" style="background-image: url('<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-2000-0/<?=$pagina['banner']?>');">
    <span class="mascara"></span>
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto" data-aos="fade-up">
        <h1 class="titulo"><?=$pagina['titulo']?></h1>
        <h2 class="subtitulo"><?=$pagina['subtitulo']?></h2>
        <div class="btn-container">
          <a href="<?=URL?>proprietario/criar-conta" class="btn btn-white">Cadastre-se Agora</a>
          <a href="<?=URL?>proprietario/inicio" class="btn btn-white outline">Minha Conta</a>
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

  <!-- //INSTITUCIONAL BLOCOS -->
  <? if ($numPagBlocos > 0) { ?>
    <section class="secao pag-blocos-intro" style="padding-top: 20px;" data-aos="fade-up" data-aos-offset="0">
      <div class="container">
        <div class="grid-12">
          <h2 class="titulo mb-0"><?=$pagina['titulo2']?></h2>
        </div>
      </div>
    </section>
    <div class="pag-blocos">
      <? $count=0; ?>
      <? foreach ($pagBlocos as $bloco) { ?>
        <? $aos1 = $count % 2 === 0 ? "fade-right" : "fade-left"; ?>
        <? $aos2 = $count % 2 === 0 ? "fade-left" : "fade-right"; ?>
        <!-- Repete -->
        <section class="secao pag-bloco">
          <div class="container">
            <div class="grid-5 grid-m-12 grid-s-12 pag-bloco-img" data-aos="<?=$aos1?>">
              <figure data-id-img="pag-bloco-<?=$bloco['id']?>">
                <img src="<?=URL?>uploads/img/paginas_blocos/<?=$bloco['id']?>/thumb-600-0/<?=$bloco['foto']?>" alt="<?=$bloco['titulo']?>">
              </figure>
            </div>
            <div class="grid-7 grid-m-12 grid-s-12 pag-bloco-infos" data-aos="<?=$aos2?>">
              <span class="load-img-mobile" data-img="pag-bloco-<?=$bloco['id']?>"></span>
              <h2 class="titulo"><?=$bloco['titulo']?></h2>
              <div class="texto"><?=$bloco['texto']?></div>
            </div>
          </div>
        </section>
        <!-- //Repete -->
        <? $count++; ?>
      <? } ?>
    </div>
  <? } ?>
  <!-- //INSTITUCIONAL BLOCOS -->

  <!-- VANTAGENS -->
  <section class="secao pt-0">
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto">
        <ul class="row blocos-faq" data-aos="fade-up">
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <h2><?=$propVants['titulo']?></h2>
              </div>
              <div class="texto"><?=$propVants['texto']?></div>
            </div>
          </li>
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <h2><?=$propVants['titulo2']?></h2>
              </div>
              <div class="texto"><?=$propVants['texto2']?></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- //VANTAGENS -->

  <!-- VALORES -->
  <section class="secao bg-fundo2">
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto">
        <h2 class="titulo"><?=$pagina['titulo3']?></h2>
        <h3 class="subtitulo-secao"><?=$pagina['subtitulo3']?></h3>
        <div class="texto"><?=$pagina['texto3']?></div>
      </div>
    </div>
  </section>
  <!-- //VALORES -->

  <!-- COMO FUNCIONA -->
  <section class="secao pag-bloco" style="padding-top: 40px;">
    <div class="container">
      <div class="grid-5 grid-m-12 grid-s-12 pag-bloco-img">
        <figure data-id-img="pag-bloco-2x">
          <img src="<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-800-0/<?=$pagina['foto4']?>" alt="<?=$bloco['titulo4']?>">
        </figure>
      </div>
      <div class="grid-7 grid-m-12 grid-s-12 pag-bloco-infos">
        <span class="load-img-mobile" data-img="pag-bloco-2x"></span>
        <h2 class="titulo"><?=$pagina['titulo4']?></h2>
        <div class="texto">
          <?=$pagina['texto4']?>
        </div>
      </div>
    </div>
  </section>
  <!-- //COMO FUNCIONA -->

  <!-- PERGUNTAS -->
  <? if ($numPagFaq > 0) { ?>
  <section id="pag-faq" class="secao inst-faq">
    <div class="container">
      <div class="grid-12"><h2 class="titulo">Perguntas frequentes dos proprietários</h2></div>
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
  
  <!-- AJUDA -->
  <section class="secao fale-conosco" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_contato.jpg');">
    <span class="mascara"></span>
    <div class="container">

      <div class="grid-7 grid-m-12 grid-s-12 fale-conosco-infos">
        <h2 class="titulo left"><?=$pagina['titulo5']?></h2>
        <h3 class="texto"><?=$pagina['subtitulo5']?></h3>
        <div class="btn-container">
          <a href="<?=URL?>proprietario/criar-conta" class="btn btn-white">Cadastre-se Agora</a>
          <a href="<?=URL?>proprietario/inicio" class="btn btn-white outline">Minha Conta</a>
        </div>
      </div>

      <div class="grid-5 fale-conosco-img">
        <figure><img src="<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-800-0/<?=$pagina['foto5']?>"></figure>
      </div>

    </div>
  </section>
  <!-- //AJUDA -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
