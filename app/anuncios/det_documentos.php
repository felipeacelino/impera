<? if ($anuncio['finalidade'] == "aluguel" || $anuncio['finalidade'] == "venda-aluguel") { ?>
<div class="anuncio-det-bloco anuncio-det-documentos">
  <div class="anuncio-det-bloco-body">
    <div class="anuncio-det-doc">
      <figure>
        <img src="<?=URL?>app/assets/dist/img/bloco2.png" alt="Documentação">
      </figure>
      <div class="anuncio-det-doc-infos">
        <h2 class="titulo">Quais documentos preciso enviar para Alugar este imóvel?</h2>
        <div class="texto">Caso queira antecipar a sua avaliação siga a orientação dos documentos necessários.</div>
        <a href="<?=URL?>quais-documentos-enviar" class="btn btn-sm btn-primario">Ver lista de documentos</a>
      </div>
    </div>
  </div>
</div>
<? } ?>

<? if ($anuncio['finalidade'] == "venda" || $anuncio['finalidade'] == "venda-aluguel") { ?>
<div class="anuncio-det-bloco anuncio-det-documentos">
  <div class="anuncio-det-bloco-body">
    <div class="anuncio-det-doc">
      <figure>
        <img src="<?=URL?>app/assets/dist/img/bloco2.png" alt="Documentação">
      </figure>
      <div class="anuncio-det-doc-infos">
        <h2 class="titulo">Quais documentos preciso enviar para Comprar este imóvel?</h2>
        <div class="texto">Caso queira antecipar a sua avaliação siga a orientação dos documentos necessários.</div>
        <a href="<?=URL?>quais-documentos-enviar" class="btn btn-sm btn-primario">Ver lista de documentos</a>
      </div>
    </div>
  </div>
</div>
<? } ?>
