<? include(ACOES_APP_PATH."/anuncios/condominios.php"); ?>
<?php
$titulo_pagina = "Condomínios - " . TITULO_PAGS;
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo" style="background-image: url('<?= URL ?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara default"></span>
    <div class="container">
      <h1 class="titulo" data-aos="fade-up">Condomínios</h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PÁGINA -->
  <section class="secao last-secao">
    <div class="container">

      <h2 class="grid-12 subtitulo-secao subtitulo-pag" data-aos="fade-up">Os melhores condomínios do litoral norte de São Paulo para você conhecer!</h2>

      <!-- LISTAGEM -->
      <? if ($numCondominios > 0) { ?>
      <div class="lista-condominios">

        <? foreach ($condominios as $condominio) { ?>

        <!-- Repete -->
        <a href="<?= URL ?>imoveis?condominio=<?= $condominio['id'] ?>" class="grid-4 grid-m-6 grid-s-12 condominio" data-aos="fade-up">
          <figure><img src="<?= URL ?>uploads/img/anuncios_condominios/<?= $condominio['id'] ?>/thumb-500-600/<?= $condominio['foto'] ?>" alt="<?= $condominio['condominio'] ?>"></figure>
          <div class="condominio-inner">
            <div class="condominio-lines">
              <span></span>
              <span></span>
              <span></span>
              <span></span>
            </div>
            <div class="condominio-content">
              <h2><?= $condominio['condominio'] ?></h2>
              <h3><?= $condominio['cidade'] ?></h3>
              <div class="condominio-btn">
                <button class="btn btn-sm btn-white outline btn-pulse">Ver Imóveis →</button>
              </div>
            </div>
          </div>
        </a>
        <!-- //Repete -->


        <? } ?>

        <!-- PAGINAÇÃO -->
        <? $condominios_crud->Pagination($url_paginacao); ?>

      </div>
      <!-- //LISTAGEM -->

      <? } else { ?>

      <!-- SEM REGISTROS -->
      <div class="grid-12 empty">
        <span>Nenhum condomínio encontrada.</span>
      </div>

      <? } ?>

    </div>
  </section>
  <!-- //PÁGINA -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>

</html>
