<? if (count(array_filter($comodos2Anuncio)) > 0) { ?>
<div class="anuncio-det-bloco anuncio-det-caracteristicas">
  <div class="anuncio-det-bloco-header">
    <h2 class="anuncio-det-bloco-titulo">Cômodos</h2>
  </div>
  <div class="anuncio-det-bloco-body">
    <ul class="anuncio-det-caracteristicas-lista">
      <? foreach ($comodos2Anuncio as $item) { ?>
        <li><i class="las la-check"></i> <?=$item['titulo']?></li>
      <? } ?>
    </ul>
  </div>
</div>
<? } ?>
