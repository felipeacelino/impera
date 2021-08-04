<? include(ACOES_APP_PATH."/home/blocos.php"); ?>
<? if ($numBlocosHome > 0) { ?>
  <section class="secao blocos-home" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_blocos.jpg');">
    <span class="mascara"></span>
    <div class="container">

      <h2 class="titulo"><?=$txtSec['titulo']?></h2>

      <h3 class="grid-12 subtitulo-secao"><?=$txtSec['subtitulo']?></h3>

      <!-- CARROSSEL -->
      <div class="carrosel noarrows slick-white carrosel-blocos">
        <? $count = 1; ?>
        <? foreach ($listaBlocosHome as $bloco) { ?>
          <!-- Repete -->
          <div class="bloco-home">
            <figure class="bloco-home-icon"><img src="<?=URL?>uploads/img/blocos_home/<?=$bloco['id']?>/thumb-250-0/<?=$bloco['foto']?>" alt="<?=$bloco['titulo']?>"></figure>
            <div class="bloco-home-titulo"><div class="bloco-count"><?=$count?></div><?=$bloco['titulo']?></div>
            <div class="bloco-home-texto texto"><?=$bloco['texto']?></div>
          </div>
          <!-- //Repete -->
          <? $count++; ?>
        <? } ?>

      </div>
      <!-- //CARROSSEL -->
      
    </div>
  </section>
<? } ?>
