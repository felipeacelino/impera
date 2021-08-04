<? if (count(array_filter($condominioAnuncio)) > 0) { ?>
<div class="anuncio-det-bloco anuncio-det-caracteristicas">
  <div class="anuncio-det-bloco-header">
    <h2 class="anuncio-det-bloco-titulo">Detalhes do condomínio</h2>
  </div>
  <div class="anuncio-det-bloco-body">
    <ul class="anuncio-det-caracteristicas-lista">
      <? foreach ($condominioAnuncio as $item) { ?>
        <li><i class="las la-check"></i> <?=$item['titulo']?></li>
      <? } ?>
    </ul>
  </div>
</div>
<? } ?>
