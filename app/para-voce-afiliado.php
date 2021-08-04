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
          <a href="<?=URL?>" class="btn btn-primario">Cadastrar Agora</a>
          <a href="<?=URL?>" class="btn btn-primario outline">Minha Conta</a>
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
        <h2 class="titulo"><?=$pagina['titulo2']?></h2>
        <h3 class="subtitulo-secao"><?=$pagina['subtitulo2']?></h3>
        <div class="texto center"><?=$pagina['texto2']?></div>
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
            <h2 class="titulo no-line"><span class="count"><?=$count+1?></span><?=$bloco['titulo']?></h2>
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

  <!-- COMISSÕES -->
  <section class="secao blocos-faq-sec">
    <div class="container">
      <div class="grid-12" data-aos="fade-up">
        <h2 class="titulo"><?=$pagina['titulo3']?></h2>
        <h3 class="subtitulo-secao"><?=$pagina['subtitulo3']?></h3>
        <ul class="blocos-faq">
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$afCom['id']?>/thumb-250-0/<?=$afCom['foto']?>" alt="<?=$afCom['titulo']?>"></figure>
                <h2><?=$afCom['titulo']?></h2>
              </div>
              <div class="texto"><?=$afCom['texto']?></div>
            </div>
          </li>
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$afCom['id']?>/thumb-250-0/<?=$afCom['foto2']?>" alt="<?=$afCom['titulo2']?>"></figure>
                <h2><?=$afCom['titulo2']?></h2>
              </div>
              <div class="texto"><?=$afCom['texto2']?></div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- //COMISSÕES -->

  <!-- AJUDA -->
  <section class="secao fale-conosco" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_contato.jpg');">
    <span class="mascara"></span>
    <div class="container">

      <div class="grid-7 grid-m-12 grid-s-12 fale-conosco-infos">
        <h2 class="titulo left"><?=$pagina['titulo4']?></h2>
        <h3 class="texto"><?=$pagina['subtitulo4']?></h3>
        <div class="btn-container">
          <a href="<?=URL?>" class="btn btn-white">Cadastrar Agora</a>
          <a href="<?=URL?>" class="btn btn-white outline">Minha Conta</a>
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
