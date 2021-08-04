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
          <a href="<?=URL?>cliente/documentos" class="btn btn-white link-restrito" data-logado="<?=$_SESSION['user']['cliente']['id']?>" data-area="cliente">Enviar Documentos</a>
          <a href="<?=URL?>cliente/inicio" class="btn btn-white outline link-restrito" data-logado="<?=$_SESSION['user']['cliente']['id']?>" data-area="cliente">Minha Conta</a>
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

  <!-- BENEFÍCIOS -->
  <section class="secao blocos-faq-sec pb-0">
    <div class="container">
      <div class="grid-12" data-aos="fade-up">
        <h2 class="titulo"><?=$pagina['titulo2']?></h2>
        <ul class="blocos-faq">
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <h2><?=$docsBen['titulo']?></h2>
              </div>
              <div class="texto"><?=$docsBen['texto']?></div>
            </div>
          </li>
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <h2><?=$docsBen['titulo2']?></h2>
              </div>
              <div class="texto"><?=$docsBen['texto2']?></div>
            </div>
          </li>
        </ul>
        <div class="texto"><?=$pagina['texto2']?></div>
      </div>
    </div>
  </section>
  <!-- //BENEFÍCIOS -->

  <!-- DOCUMENTOS -->
  <section class="secao pag-bloco" style="padding-top: 40px;">
    <div class="container">
      <div class="grid-5 grid-m-12 grid-s-12 pag-bloco-img">
        <a href="<?=URL?>quais-documentos-enviar"><figure data-id-img="pag-bloco-2x">
          <img src="<?=URL?>uploads/img/paginas/<?=$pgDocs['id']?>/thumb-800-0/<?=$pgDocs['foto']?>" alt="<?=$pgDocs['titulo']?>">
        </figure></a>
      </div>
      <div class="grid-7 grid-m-12 grid-s-12 pag-bloco-infos">
        <span class="load-img-mobile" data-img="pag-bloco-2x"></span>
        <a href="<?=URL?>quais-documentos-enviar"><h2 class="titulo"><?=$pgDocs['titulo']?></h2></a>
        <div class="texto">
          <?=$pgDocs['texto']?>
        </div>
      </div>
    </div>
  </section>
  <!-- //DOCUMENTOS -->

  <!-- PERGUNTAS -->
  <? if ($numPagFaq > 0) { ?>
  <section id="pag-faq" class="secao inst-faq">
    <div class="container">
      <h2 class="titulo">Perguntas Frequentes</h2>
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
        <h2 class="titulo left"><?=$pagina['titulo3']?></h2>
        <h3 class="texto"><?=$pagina['subtitulo3']?></h3>
        <div class="btn-container">
          <a href="<?=URL?>cliente/documentos" class="btn btn-white link-restrito" data-logado="<?=$_SESSION['user']['cliente']['id']?>" data-area="cliente">Enviar Documentos</a>
          <a href="<?=URL?>cliente/inicio" class="btn btn-white outline link-restrito" data-logado="<?=$_SESSION['user']['cliente']['id']?>" data-area="cliente">Minha Conta</a>
        </div>
      </div>

      <div class="grid-5 fale-conosco-img">
        <figure><img src="<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-800-0/<?=$pagina['foto3']?>"></figure>
      </div>

    </div>
  </section>
  <!-- //AJUDA -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
