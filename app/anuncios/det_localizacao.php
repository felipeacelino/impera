<div id="imovel-localizacao" class="anuncio-det-bloco anuncio-det-localizacao">
  <div class="anuncio-det-bloco-header">
    <h2 class="anuncio-det-bloco-titulo">Localização</h2>
  </div>
  <div class="anuncio-det-bloco-body">
    <div class="texto"><?=$anuncio['logradouro']?>, <?=$anuncio['bairro']?>, <?=$anuncio['cidade']?> <!-- <small>(* Localização aproximada)</small> --></div>
    <div class="btn-container-maps">
      <button class="btn btn-sm btn-primario view-map"><i class="las la-map"></i> Mapa</button>
      <button class="btn btn-sm view-street"><i class="las la-street-view"></i> Rua</button>
    </div>
    <div id="anuncio-det-mapa" class="anuncio-det-mapa" 
    data-lat="<?=$anuncio['lat']?>" 
    data-lng="<?=$anuncio['lng']?>"
    data-icon="<?=URL_APP?>assets/dist/img/maps/prox.png"></div>
  </div>
</div>
