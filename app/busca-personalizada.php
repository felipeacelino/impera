<? include(ACOES_APP_PATH."/anuncios/anuncios_personalizados.php"); ?>
<?php
$titulo_pagina = "Imóveis - " . TITULO_PAGS;
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pag-anuncios">

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BUSCA BARRA -->
  <? include(APP_PATH.'/estrutura/busca.php'); ?>

  <!-- CONTEÚDO -->
  <section class="secao secao-anuncios">
    <div class="container secao-anuncios-content">

      <!-- TOPO -->
      <div class="grid-12 anuncios-topo">
        <div class="row">
          <? if ($numAnuncios > 1) {?>
          <h1 class="grid-7 grid-m-6 grid-s-12"><b><?= $numAnuncios ?></b> <?=$prefixoBusca?> encontrados <?= $complementoBusca ?></h1>
          <? } else if($numAnuncios == 1) { ?>
          <h1 class="grid-7 grid-m-6 grid-s-12"><b><?= $numAnuncios ?></b> <?=$prefixoBusca?> encontrado <?= $complementoBusca ?></h1>
          <? } else { ?>
          <h1 class="grid-7 grid-m-6 grid-s-12">Nenhum imóvel encontrado</h1>
          <? } ?>
          <!--
          <div class="grid-2 grid-m-3 grid-s-6 anuncios-btn-filtros"><button class="btn btn-sm btn-secundario btn-anuncios-filtros-toggle"><i class="fas fa-filter"></i>Filtros</button></div>
          <div class="grid-3 grid-s-6 anuncios-ordenar">
            <form id="form-ordem" method="get">
              <div class="campo-container">
                <select name="ordena" id="ordena" class="campo">
                  <option value="" hidden>Ordenar</option>
                  <option value="relevancia" <?= Tools::selected($_GET['ordena'], 'relevancia') ?>>Relevância</option>
                  <option value="menor-preco" <?= Tools::selected($_GET['ordena'], 'menor-preco') ?>>Menor preço</option>
                  <option value="maior-preco" <?= Tools::selected($_GET['ordena'], 'maior-preco') ?>>Maior preço</option>
                </select>
                <i class="arrow"></i>
              </div>
            </form>
          </div>-->
        </div>
      </div>
      <!-- //TOPO -->

      <!-- FILTROS ->
      <div class="grid-12 anuncios-fitlros">
        <h2>Filtros</h2>
        <form id="form-filtros">
          <div class="row">
            <div class="grid-4 grid-s-12">
              <div class="campo-container">
                <label for="filtro-preco">Faixa de preço</label>
                <select name="preco" id="filtro-preco" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($faixa_de_preco as $key => $filtro_row) { ?>
                  <option value="<?= $key ?>" <?= Tools::selected($_GET['preco'], $key) ?>><?= $filtro_row ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
              <div class="campo-container">
                <label for="filtro-quartos">Quartos</label>
                <select name="quartos" id="filtro-quartos" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($quartos as $key => $filtro_row) { ?>
                  <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_GET['quartos'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
            </div>
            <div class="grid-4 grid-s-12">
              <div class="campo-container">
                <label for="filtro-condominio">Condomínio</label>
                <select name="condominio" id="filtro-condominio" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($condominios as $key => $filtro_row) { ?>
                  <option value="<?= $filtro_row['id'] ?>" <?= Tools::selected($_GET['condominio'], $filtro_row['id']) ?>><?= $filtro_row['condominio'] ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
              <div class="campo-container">
                <label for="filtro-suites">Suítes</label>
                <select name="suites" id="filtro-suites" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($suites as $key => $filtro_row) { ?>
                  <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_GET['suites'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
            </div>
            <div class="grid-4 grid-s-12">
              <div class="campo-container">
                <label for="filtro-tipo">Tipo de imóvel</label>
                <select name="tipo" id="filtro-tipo" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($tipo_de_imovel as $key => $filtro_row) { ?>
                  <option value="<?= $key ?>" <?= Tools::selected($_GET['tipo'], $key) ?>><?= $filtro_row ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
              <div class="campo-container">
                <label for="filtro-banheiros">Banheiros</label>
                <select name="banheiros" id="filtro-banheiros" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($banheiros as $key => $filtro_row) { ?>
                  <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_GET['banheiros'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
            </div>
            <div class="grid-4 grid-s-12">
              <div class="campo-container">
                <label for="filtro-tipo">Vagas</label>
                <select name="vagas" id="filtro-vagas" class="campo">
                  <option value="" hidden>Selecione</option>
                  <? foreach ($vagas as $key => $filtro_row) { ?>
                  <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_GET['vagas'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
            </div>
            <div class="grid-12">
              <div class="campo-container cr-container">
                <label>Características</label>
                <? foreach ($caracteristicas as $key => $filtro_row) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="caracteristicas[]" value="<?= $filtro_row['id'] ?>" <? if (in_array($filtro_row['id'], $_GET["caracteristicas"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?= $filtro_row['caracteristica'] ?></span>
                </label>
                <? } ?>
              </div>
            </div>
          </div>
          <div class="anuncios-fitlros-btns">
            <button type="submit" class="btn btn-sm btn-primario"><i class="fas fa-filter"></i>Filtrar</button>
            <a href="<?= URL ?>imoveis" class="btn btn-sm btn-primario outline btn-anuncios-filtros-clear"><i class="fas fa-times"></i>Limpar</a>
          </div>
        </form>
      </div>
      <!-- //FILTROS -->

      <? if ($numAnuncios > 0) { ?>

      <!-- LISTA ANÚNCIOS -->
      <div class="grid-12 anuncios-lista">

        <? foreach ($anuncios as $anuncio) { ?>

        <!-- Repete -->
        <div class="anuncio-bloco" data-aos="fade-up" data-id="<?= $anuncio['id'] ?>" data-url="<?= URL ?>imovel/<?= $anuncio['url_amigavel'] ?>-im<?= $anuncio['id'] ?>" data-lat="<?= $anuncio['latitude'] ?>" data-lng="<?= $anuncio['longitude'] ?>" data-img="<?= URL_APP ?>thumbs.php?img=../uploads/img/anuncios/<?= $anuncio['id'] ?>/anuncios_fotos/<?= $anuncio['foto_destaque'] ?>&w=220&h=150" data-titulo="<?= $anuncio['titulo'] ?>" data-local="<?= $anuncio['local'] ?>" data-preco="<? if ($anuncio['tipo_anuncio'] == 'temporada' || $anuncio['tipo_anuncio'] == 'venda_e_temporada') { ?> <b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor']) ?></b> /por noite <? } else { ?> <b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor_venda']) ?></b> /à venda <? } ?>">
          <div class="anuncio-bloco-fotos">
            <? if ($anuncio['num_fotos'] > 0) { ?>
              <? foreach ($anuncio['fotos'] as $foto) { ?>
                <a href="<?= URL ?>imovel/<?= $anuncio['url_amigavel'] ?>-im<?= $anuncio['id'] ?>"><img src="<?= URL ?>uploads/img/anuncios/<?= $anuncio['id'] ?>/anuncios_fotos/thumb-300-250/<?= $foto['foto'] ?>" alt="<?= $anuncio['titulo'] ?>"></a>
              <? } ?>
            <? } ?>
          </div>
          <div class="anuncio-bloco-infos">
            <a href="<?= URL ?>imovel/<?= $anuncio['url_amigavel'] ?>-im<?= $anuncio['id'] ?>" class="anuncio-bloco-titulo"><?= $anuncio['titulo'] ?></a>
            <div class="anuncio-bloco-local"><i class="fas fa-map-marker-alt"></i> <?= $anuncio['local'] ?> <? if($anuncio['estado_nome'] != '') { echo ' - '; echo $anuncio['estado_nome']; } ?></div>
            <div class="star-rating anuncio-bloco-stars">
              <? for ($i=0; $i<5; $i++) { ?>
                <? if ($i < $anuncio['media_avaliacao']) { ?>
                  <i class="fas fa-star active"></i>
                <? } else { ?>
                  <i class="fas fa-star"></i>
                <? } ?>
              <? } ?>
            </div>
            <ul class="anuncio-bloco-caracs">
              <li><?=$tipo_de_imovel[$anuncio['tipo']]?></li>
              <? if ($anuncio['quartos'] > 0) { ?>
                <li><b><?= $anuncio['quartos'] ?></b> 
                <? if ($anuncio['quartos'] > 1) { echo "Quartos"; } else { echo "Quarto"; } ?>
                </li>
              <? } ?>
              <? if ($anuncio['suites'] > 0) { ?>
                <li><b><?= $anuncio['suites'] ?></b> 
                <? if ($anuncio['suites'] > 1) { echo "Suítes"; } else { echo "Suíte"; } ?>
                </li>
              <? } ?>
              <? if ($anuncio['banheiros'] > 0) { ?>
                <li><b><?= $anuncio['banheiros'] ?></b> 
                <? if ($anuncio['banheiros'] > 1) { echo "Banheiros"; } else { echo "Banheiro"; } ?>
                </li>
              <? } ?>
              <? if ($anuncio['vagas'] > 0) { ?>
                <li><b><?= $anuncio['vagas'] ?></b> 
                <? if ($anuncio['vagas'] > 1) { echo "Vagas"; } else { echo "Vaga"; } ?>
                </li>
              <? } ?>
              <? if ($anuncio['tipo_anuncio'] == 'temporada' || $anuncio['tipo_anuncio'] == 'venda_e_temporada') { ?>
                <li>Acomoda <b><?= $anuncio['hospedes'] ?></b></li>
              <? } ?>
            </ul>
            <? if ($anuncio['tipo_anuncio'] == 'temporada' || $anuncio['tipo_anuncio'] == 'venda_e_temporada') { ?>
            <div class="anuncio-bloco-preco">
              <? if ($anuncio['valor_total'] != '') { ?>
                <!--<b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor_total']) ?></b>-->
                <b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor']) ?></b> /por noite
              <? } else { ?>
                <b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor']) ?></b> /por noite
              <? } ?>
              <? if ($anuncio['tipo_anuncio'] == 'venda_e_temporada') { ?>
                <span class="right"><b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor_venda']) ?></b> /à venda</span>
              <? } ?>
            </div>
            <? } else { ?>
            <div class="anuncio-bloco-preco"><b><sup>R$</sup> <?= Tools::formataMoeda($anuncio['valor_venda']) ?></b> /à venda</div>
            <? } ?>
          </div>
        </div>
        <!-- //Repete -->

        <? } ?>

        <!-- PAGINAÇÃO -->
        <? $anuncios_crud->Pagination($url_paginacao); ?>

      </div>
      <!-- //LISTA ANÚNCIOS -->

      <? } else { ?>

      <!-- SEM REGISTROS -->
      <div class="grid-12 empty">
        <span>Nenhum imóvel encontrado.</span>
      </div>

      <? } ?>

    </div>
    <span class="load-img-mobile" data-img="mapa-mobile"></span>
    <!-- FOOTER -->
    <? include(APP_PATH.'/estrutura/footer-imoveis.php'); ?>
  </section>
  <!-- //CONTEÚDO -->

  <!-- MAPA -->
  <div class="anuncios-mapa" data-id-img="mapa-mobile">
    <div id="mapa-anuncios"></div>
  </div>
  <!-- //MAPA -->

  <!-- GERAIS -->
  <? include(APP_PATH.'/estrutura/gerais_footer.php'); ?>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= MAPS_API ?>"></script>

</body>

</html>
