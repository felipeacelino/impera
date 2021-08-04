<? if ($numAnunciosRel > 0) { ?>
<div class="grid-12 anuncio-det-relacionados">
  <h2 class="titulo">Imóveis Relacionados</h2>

  <!-- Carrosel -->
  <div class="carrosel noarrows carrosel-anuncios">

  <? foreach ($anunciosRel as $anuncioRel) { ?>

    <!-- Repete -->
    <div class="bloco-anuncio">
      <div class="bloco-anuncio-fotos">
        <ul>
          <? foreach ($anuncioRel['fotos'] as $fotoRel) { ?>
            <li><a href="<?=URL?><?=$anuncioRel['slug']?>"><img src="<?=URL?>uploads/img/anuncios/<?=$anuncioRel['id']?>/anuncios_fotos/thumb-600-440/<?=$fotoRel['foto']?>" alt="<?=$anuncioRel['titulo']?>"></a></li>
          <? } ?>
        </ul>
      </div>
      <a class="bloco-anuncio-infos" href="<?=URL?><?=$anuncioRel['slug']?>">
        <div class="bloco-anuncio-tag-wrp">
          <div class="bloco-anuncio-tipo"><?=$anuncioRel['tipo_item']?></div>
          <? if ($anuncioRel['tag_destaque'] != "0") { ?>
            <div class="bloco-anuncio-tag"><?=$tagsDestaque[$anuncioRel['tag_destaque']]?></div>
          <? } ?>
        </div>
        <div class="bloco-anuncio-titulo"><?=$anuncioRel['logradouro']?></div>
        <div class="bloco-anuncio-cidade"><?=$anuncioRel['bairro']?>, <?=$anuncioRel['cidade']?></div>
        <ul class="bloco-anuncio-caracs">
          <? if ($anuncioRel['area'] > 0) { ?>
            <li><i class="las la-expand"></i> <b><?=$anuncioRel['area']?></b> m²</li>
          <? } ?>
          <? if ($anuncioRel['quartos'] > 0) { ?>
            <li><i class="las la-bed"></i> <b><?=$anuncioRel['quartos']?></b> quarto(s)</li>
          <? } ?>
          <? if ($anuncioRel['vagas'] > 0) { ?>
          <li><i class="las la-car"></i> <b><?=$anuncioRel['vagas']?></b> vaga(s)</li>
          <? } ?>
        </ul>
        <? if ($anuncioRel['finalidade'] != "venda-aluguel") { ?>
          <div class="bloco-anuncio-valor"><b>R$ <?=Tools::formataMoeda($anuncioRel['valor'])?></b></div>
        <? } else { ?>
          <div class="bloco-anuncio-valor">Aluguel: <b>R$ <?=Tools::formataMoeda($anuncioRel['valor_aluguel'])?></b></div>
          <div class="bloco-anuncio-valor">Venda: <b>R$ <?=Tools::formataMoeda($anuncioRel['valor_venda'])?></b></div>
        <? } ?>
        <? if ($anuncioRel['valor_add'] > 0) { ?>
          <div class="bloco-anuncio-valor"><small>(Cond. + IPTU: R$ <?=Tools::formataMoeda($anuncioRel['valor_add'])?>)</small></div>
        <? } ?>
      </a>
    </div>
    <!-- //Repete -->

  <? } ?>

  </div>
  <!-- //Carrosel -->

  <div class="btn-container">
    <a href="<?=$linkRelacionados?>" class="btn">Ver todos<img class="arrow right" src="<?=URL_APP?>assets/dist/img/arrow_right.svg"></a>
  </div>

</div>
<? } ?>
