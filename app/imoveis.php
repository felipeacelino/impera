<? include(ACOES_APP_PATH."/gerais/busca.php"); ?>
<? include(ACOES_APP_PATH."/anuncios/anuncios.php"); ?>
<?php
$titulo_pagina = strip_tags($titulo.$tituloLocal)." - " . TITULO_PAGS;
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pag-anuncios">

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- CONTEÚDO -->
  <section class="secao-anuncios">

    <!-- TOPO -->
    <div class="anuncios-topo">
      <div class="row">

        <!-- TÍTULO -->
        <div class="grid-8 grid-m-7 grid-s-12 anuncios-topo-titulo">
          <h1><?=$titulo.$tituloLocal?></h1>
          <h2><b><?=$numAnuncios?></b> <?=$subtitulo.$subtituloLocal?>.</h2>
        </div>

        <!-- BOTÕES -->
        <div class="grid-4 grid-m-5 grid-s-12 anuncios-topo-btns">
          <button class="btn btn-default btn-toggle-filtros"><i class="fas fa-sliders-h"></i> Filtrar</button>
          <form id="form-ordem" action="#" method="get" class="campo-container">
            <select name="ordena" id="ordena" class="campo">
              <option value="" hidden>Ordenar</option>
              <option value="relevancia" <?= Tools::selected($_GET['ordena'], 'relevancia') ?>>Relevância</option>
              <option value="menor-preco" <?= Tools::selected($_GET['ordena'], 'menor-preco') ?>>Menor preço</option>
              <option value="maior-preco" <?= Tools::selected($_GET['ordena'], 'maior-preco') ?>>Maior preço</option>
            </select>
            <i class="arrow"></i>
          </form>
        </div>

      </div>
    </div>
    <!-- //TOPO -->

    <!-- ANÚNCIOS -->
    <div class="pag-anuncios-lista">

      <? if ($numAnuncios > 0) { ?>
        
        <!-- LISTA ANÚNCIOS -->
        <div class="anuncios-lista">
          <div class="row">
          <? foreach ($resultado as $anuncio) { ?>

            <!-- Repete -->
            <div class="grid-4 grid-s-12 bloco-anuncio"
            data-id="<?=$anuncio['id']?>" 
            data-url="<?=URL?><?=$anuncio['slug']?>" 
            data-lat="<?=$anuncio['lat']?>" 
            data-lng="<?=$anuncio['lng']?>" 
            data-img="<?=URL?>uploads/img/anuncios/<?=$anuncio['id']?>/anuncios_fotos/thumb-600-440/<?=$anuncio['fotos'][0]['foto']?>" 
            data-titulo="<?=$anuncio['logradouro']?>" 
            data-local="<?=$anuncio['bairro']?>, <?=$anuncio['cidade']?>" 
            data-preco="R$ <?=Tools::formataMoeda($anuncio['valor'])?>"
            <? if ($anuncio['valor_add'] > 0) { ?>
              data-preco-add="(Cond. + IPTU: R$ <?=Tools::formataMoeda($anuncio['valor_add'])?>)"
            <? } ?>
            >
              <div class="bloco-anuncio-fotos">
                <ul class="swipe">
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
        </div>
        <!-- //LISTA ANÚNCIOS -->

        <!-- PAGINAÇÃO -->
        <div class="pag-anuncios-pagination">
          <? $anuncios->Pagination($url_paginacao); ?>
        </div>

      <? } else { ?>
        
        <!-- SEM REGISTROS -->
        <div class="pag-anuncios-empty-wrp">
          <div class="pag-anuncios-empty">
            <div class="pag-anuncios-empty-icon"><i class="fas fa-exclamation-circle"></i></div>
            <div class="pag-anuncios-empty-infos">
              <h2>Nenhum imóvel encontrado =(</h2>
              <p>Tente remover algum filtro ou realize uma nova busca.</p>
            </div>
          </div>
        </div>

      <? } ?>
      
      <button class="btn btn-sm btn-default btn-fl-map bottom left btn-fl-show-map"><i class="fas fa-map-marker-alt"></i>Mapa</button>
      <button class="btn btn-sm btn-default btn-fl-map bottom left btn-fl-show-list" style="display: none;"><i class="fas fa-list-ul"></i>Lista</button>
      <button class="btn btn-sm btn-default btn-fl-map bottom left btn-fl-show-filter btn-toggle-filtros" style="display: none;"><i class="fas fa-sliders-h"></i>Filtrar</button>

      <!-- FOOTER -->
      <? include(APP_PATH.'/estrutura/footer-imoveis.php'); ?>

    </div>
    <!-- //ANÚNCIOS -->
             
  </section>
  <!-- //CONTEÚDO -->

  <!-- FILTROS -->
  <? include(APP_PATH.'/anuncios/filtros.php'); ?>

  <!-- MAPA -->
  <div class="anuncios-mapa">
    <div id="mapa-anuncios"></div>
  </div>
  <!-- //MAPA -->
  
  <!-- GERAIS E SCRIPTS -->
  <? include(APP_PATH.'/estrutura/gerais_footer.php'); ?>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=MAPS_API?>"></script>

</body>

</html>
