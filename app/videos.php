<? include(ACOES_APP_PATH."/videos/videos.php"); ?>
<?php
$titulo_pagina = "Vídeos - ".TITULO_PAGS;
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
      <h1 class="titulo" data-aos="fade-up">Vídeos</h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PÁGINA -->
  <section class="secao last-secao">
    <div class="container">

      <!-- VÍDEOS -->
      <div class="lista-videos">

        <? if ($numVideos > 0) { ?>

          <? foreach ($videos_list as $video) { ?>

            <!-- Repete -->	
            <div class="grid-4 grid-m-6 grid-s-12 bloco-video <?=$video['url_amigavel']?>" data-aos="fade-up">
              <div class="bloco-video-wrapper">
                <iframe src="https://www.youtube.com/embed/<?=$video['video']?>?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
              </div>
              <h2 class="bloco-video-titulo"><?=$video['titulo']?></h2>
            </div>
            <!-- //Repete -->

          <? } ?>

          <!-- PAGINAÇÃO -->
          <? $videos->Pagination($url_paginacao); ?>

          <!-- SEM REGISTROS -->
        <? } else { ?>

          <div class="grid-12 empty">
            <span>Não há registros a serem exibidos.</span>
          </div>

        <? } ?>

      </div>
      <!-- //VÍDEOS -->

    </div>
  </section>
  <!-- //PÁGINA -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
