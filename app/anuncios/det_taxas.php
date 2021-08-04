<? if (($anuncio['finalidade'] == "venda" || $anuncio['finalidade'] == "venda-aluguel") && ($anuncio['valor_itbi'] > 0 || $anuncio['valor_escritura'] > 0 || $anuncio['valor_registro'] > 0)) { ?>
<div class="anuncio-det-bloco anuncio-det-descricao">
  <div class="anuncio-det-bloco-header">
    <h2 class="anuncio-det-bloco-titulo">Taxas cartoriais e impostos</h2>
  </div>
  <div class="anuncio-det-bloco-body">
    <div class="texto">
      <p>Mais transparência e sem surpresas futuras na sua compra.<br>
      Confira a estimativa das despesas necessárias para este imóvel.</p>
    </div>
    <ul class="anuncio-det-valores-list">
      <? if ($anuncio['valor_itbi'] > 0) { ?>
        <li><span>ITBI <a href="#" class="modal-open" data-modal="modal-itbi"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_itbi'])?></span></li>
      <? } ?>
      <? if ($anuncio['valor_escritura'] > 0) { ?>
        <li><span>Escritura <a href="#" class="modal-open" data-modal="modal-escritura"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_escritura'])?></span></li>
      <? } ?>
      <? if ($anuncio['valor_registro'] > 0) { ?>
        <li><span>Registro <a href="#" class="modal-open" data-modal="modal-registro"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_registro'])?></span></li>
      <? } ?>
    </ul>
  </div>
</div>
<? } ?>
