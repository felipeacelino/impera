<? if (count(array_filter($comodidadesAnuncio)) > 0) { ?>
<div class="anuncio-det-bloco anuncio-det-caracteristicas">
  <div class="anuncio-det-bloco-header">
    <h2 class="anuncio-det-bloco-titulo">Comodidades e serviços</h2>
  </div>
  <div class="anuncio-det-bloco-body">
    <ul class="anuncio-det-caracteristicas-lista">
      <? foreach ($comodidadesAnuncio as $item) { ?>
        <li><i class="las la-check"></i> <?=$item['titulo']?></li>
      <? } ?>
    </ul>
  </div>
</div>
<? } ?>
