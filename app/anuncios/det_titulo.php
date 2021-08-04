<div class="anuncio-det-titulo">
  <h1><?=$anuncio['titulo']?><br><span>Cod: <?=$anuncio['codigo']?></span></h1>
  <h2>
    <?=$anuncio['logradouro']?>, <?=$anuncio['bairro']?>, <?=$anuncio['cidade']?>
    <div class="btn-container-maps">
      <button class="btn btn-sm scroll-map"><i class="las la-map"></i> Mapa</button>
      <button class="btn btn-sm scroll-street"><i class="las la-street-view"></i> Rua</button>
    </div>
  </h2>
  <? if ($anuncio['tag_destaque'] != "0") { ?>
    <div class="anuncio-det-tag">
      <span><?=$tagsDestaque[$anuncio['tag_destaque']]?></span>
    </div>
  <? } ?>
</div>
