<? if (count(array_filter($mobiliasAnuncio)) > 0) { ?>
<div class="anuncio-det-bloco anuncio-det-caracteristicas">
  <div class="anuncio-det-bloco-header">
    <h2 class="anuncio-det-bloco-titulo">Mobílias e Eletros</h2>
  </div>
  <div class="anuncio-det-bloco-body">
    <ul class="anuncio-det-caracteristicas-lista">
      <? foreach ($mobiliasAnuncio as $item) { ?>
        <li><i class="las la-check"></i> <?=$item['titulo']?></li>
      <? } ?>
    </ul>
  </div>
</div>
<? } ?>
