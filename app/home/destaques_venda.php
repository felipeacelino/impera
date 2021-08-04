<? include(ACOES_APP_PATH."/home/destaques_venda.php"); ?>
<? include(ACOES_APP_PATH."/home/imoveis.php"); ?>
<? if ($numAnunciosVenda > 0) { ?>
<section class="secao home-anuncios">
  <div class="container">

    <h2 class="titulo"><?=$txtSec['titulo']?></h2>

    <h3 class="grid-12 subtitulo-secao"><?=$txtSec['subtitulo']?></h3>

    <h2 class="subtitulo subtitulo-line left"><span>Imóveis para venda</span></h2>

    <!-- Carrosel -->
    <div class="carrosel noarrows carrosel-anuncios">

    <? foreach ($destaquesVenda as $anuncio) { ?>

      <!-- Repete -->
      <div class="bloco-anuncio">
        <div class="bloco-anuncio-fotos">
          <ul>
            <? foreach ($anuncio['fotos'] as $foto) { ?>
              <li><a href="<?=URL?><?=$anuncio['slug']?>"><img src="<?=URL?>uploads/img/anuncios/<?=$anuncio['id']?>/anuncios_fotos/thumb-600-440/<?=$foto['foto']?>" alt="<?=$anuncio['titulo']?>"></a></li>
            <? } ?>
          </ul>
        </div>
        <a class="bloco-anuncio-infos" href="<?=URL?><?=$anuncio['slug']?>">
          <div class="bloco-anuncio-tag-wrp">
            <div class="bloco-anuncio-tipo"><?=$anuncio['tipo_item']?></div>
            <? if ($anuncio['tag_destaque'] != "0") { ?>
              <div class="bloco-anuncio-tag"><?=$tagsDestaque[$anuncio['tag_destaque']]?></div>
            <? } ?>
          </div>
          <div class="bloco-anuncio-titulo"><?=$anuncio['logradouro']?></div>
          <div class="bloco-anuncio-cidade"><?=$anuncio['bairro']?>, <?=$anuncio['cidade']?></div>
          <ul class="bloco-anuncio-caracs">
            <? if ($anuncio['area'] > 0) { ?>
              <li><i class="las la-expand"></i> <b><?=$anuncio['area']?></b> m²</li>
            <? } ?>
            <? if ($anuncio['quartos'] > 0) { ?>
              <li><i class="las la-bed"></i> <b><?=$anuncio['quartos']?></b> quarto(s)</li>
            <? } ?>
            <? if ($anuncio['vagas'] > 0) { ?>
            <li><i class="las la-car"></i> <b><?=$anuncio['vagas']?></b> vaga(s)</li>
            <? } ?>
          </ul>
          <? if ($anuncio['finalidade'] != "venda-aluguel") { ?>
            <div class="bloco-anuncio-valor"><b>R$ <?=Tools::formataMoeda($anuncio['valor'])?></b></div>
          <? } else { ?>
            <div class="bloco-anuncio-valor">Aluguel: <b>R$ <?=Tools::formataMoeda($anuncio['valor_aluguel'])?></b></div>
            <div class="bloco-anuncio-valor">Venda: <b>R$ <?=Tools::formataMoeda($anuncio['valor_venda'])?></b></div>
          <? } ?>
          <? if ($anuncio['valor_add'] > 0) { ?>
            <div class="bloco-anuncio-valor"><small>(Cond. + IPTU: R$ <?=Tools::formataMoeda($anuncio['valor_add'])?>)</small></div>
          <? } ?>
        </a>
      </div>
      <!-- //Repete -->

    <? } ?>

    </div>
    <!-- //Carrosel -->

    <div class="btn-container">
      <a href="<?=URL?>imoveis?finalidade=venda" class="btn">Ver todos<img class="arrow right" src="<?=URL_APP?>assets/dist/img/arrow_right.svg"></a>
    </div>

  </div>
</section>
<? } ?>
