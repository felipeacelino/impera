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

  <!-- APRESENTAÇÃO -->
  <section class="secao pag-apresentacao" data-aos="fade-up">
    <div class="container">
      <div class="grid-6 grid-m-12 grid-s-12 pag-apresentacao-infos">
        <span class="load-img-mobile" data-img="apresentacao1"></span>
        <h1 class="titulo"><?=$pagina['titulo']?></h1>
        <h2 class="subtitulo"><?=$pagina['subtitulo']?></h2>
        <h3 class="texto"><?=$pagina['texto']?></h3>
        <div class="btn-container">
          <a href="<?=URL?>corretor/criar-conta" class="btn btn-primario">Cadastrar Agora</a>
          <a href="<?=URL?>corretor/entrar" class="btn btn-primario outline">Minha Conta</a>
        </div>
      </div>
      <div class="grid-6 grid-m-12 grid-s-12 pag-apresentacao-img">
        <figure data-id-img="apresentacao1">
          <img src="<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-800-0/<?=$pagina['foto']?>">
        </figure>
      </div>
    </div>
  </section>
  <!-- //APRESENTAÇÃO -->

  <!-- //INSTITUCIONAL BLOCOS -->
  <? if ($numPagBlocos > 0) { ?>
    <section class="secao pag-blocos-intro pt-0" data-aos="fade-up">
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

  <!-- BLOCOS QUIZ -->
  <section class="secao blocos-faq-sec">
    <div class="container">
      <div class="grid-12" data-aos="fade-up">
        <h2 class="titulo"><?=$pagina['titulo3']?></h2>
        <h3 class="subtitulo-secao"><?=$pagina['subtitulo3']?></h3>
        <ul class="blocos-faq" data-aos="fade-up">
          <li class="grid-4 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$blCor1['id']?>/thumb-250-0/<?=$blCor1['foto']?>" alt="<?=$blCor1['titulo']?>"></figure>
                <h2><?=$blCor1['titulo']?></h2>
              </div>
              <div class="texto"><?=$blCor1['texto']?></div>
            </div>
            <div class="btn-container">
              <a href="<?=URL?>corretor/criar-conta" class="btn btn-sm btn-primario">Cadastrar Agora</a>
              <a href="<?=URL?>faq-corretor-imovel-pronto" class="btn btn-sm btn-primario outline">Dúvidas</a>
            </div>
          </li>
          <li class="grid-4 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$blCor2['id']?>/thumb-250-0/<?=$blCor2['foto']?>" alt="<?=$blCor2['titulo']?>"></figure>
                <h2><?=$blCor2['titulo']?></h2>
              </div>
              <div class="texto"><?=$blCor2['texto']?></div>
            </div>
            <div class="btn-container">
              <a href="<?=URL?>corretor/criar-conta" class="btn btn-sm btn-primario">Cadastrar Agora</a>
              <a href="<?=URL?>faq-corretor-imovel-planta" class="btn btn-sm btn-primario outline">Dúvidas</a>
            </div>
          </li>
          <li class="grid-4 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$blCor3['id']?>/thumb-250-0/<?=$blCor3['foto']?>" alt="<?=$blCor3['titulo']?>"></figure>
                <h2><?=$blCor3['titulo']?></h2>
              </div>
              <div class="texto"><?=$blCor3['texto']?></div>
            </div>
            <div class="btn-container">
              <a href="<?=URL?>corretor/criar-conta" class="btn btn-sm btn-primario">Cadastrar Agora</a>
              <a href="<?=URL?>faq-corretor-imovel-locacao" class="btn btn-sm btn-primario outline">Dúvidas</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- //BLOCOS QUIZ -->
  
  <!-- AJUDA -->
  <section class="secao fale-conosco" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_contato.jpg');">
    <span class="mascara"></span>
    <div class="container">

      <div class="grid-7 grid-m-12 grid-s-12 fale-conosco-infos">
        <h2 class="titulo left"><?=$pagina['titulo4']?></h2>
        <h3 class="texto"><?=$pagina['subtitulo4']?></h3>
        <div class="btn-container">
          <a href="<?=URL?>corretor/criar-conta" class="btn btn-white">Cadastrar Agora</a>
          <a href="<?=URL?>corretor/entrar" class="btn btn-white outline">Minha Conta</a>
        </div>
      </div>

      <div class="grid-5 fale-conosco-img">
        <figure><img src="<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-800-0/<?=$pagina['foto4']?>"></figure>
      </div>

    </div>
  </section>
  <!-- //AJUDA -->
  
  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
