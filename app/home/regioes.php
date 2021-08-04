<? include(ACOES_APP_PATH."/home/regioes.php"); ?>
<? if ($numRegioes > 0) { ?>
<section class="secao home-regioes" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_map.jpg');">
  <span class="mascara"></span>
  <div class="container">

    <h2 class="titulo"><?=$txtSec['titulo']?></h2>

    <h3 class="grid-12 subtitulo-secao"><?=$txtSec['subtitulo']?></h3>

    <!-- Carrosel -->
    <div class="carrosel noarrows carrosel-regioes">

      <? foreach ($listaRegioes as $regiao) { ?>

        <!-- Repete -->
        <a href="<?=URL?>imoveis?regiao=<?=$regiao['id']?>" class="regiao">
          <figure><img src="<?=URL?>uploads/img/anuncios_regioes/<?=$regiao['id']?>/thumb-500-400/<?=$regiao['foto']?>" alt="<?=$regiao['titulo']?>"></figure>
          <div class="regiao-inner">
            <div class="regiao-content">
              <h2><?=$regiao['titulo']?></h2>
              <span class="arrow-hvr">Ver Imóveis <img class="arrow right" src="<?=URL_APP?>assets/dist/img/arrow_right_white.svg"></span>
            </div>
          </div>
        </a>
        <!-- //Repete -->

      <? } ?>

    </div>
    <!-- //Carrosel -->

  </div>
</section>
<? } ?>
