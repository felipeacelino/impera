<? include(ACOES_APP_PATH . '/corretor/restrito.php'); ?>
<? include(ACOES_APP_PATH . '/corretor/anuncio_fotos_lista.php'); ?>
<?php
$titulo_pagina = $tituloFotos . ' - ' . TITULO_PAGS;
$descr_site = '';
$keywords_site = '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH . '/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="imoveis">

  <!-- HEADER -->
  <? include(APP_PATH . '/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH . '/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Imóvel (<?=$anuncio['codigo']?>) <i class="fas fa-chevron-right"></i> <?=$tituloFotos?>
        </h1>
        <? if ($acaoFotos == 'update') { ?>
        <div class="conta-topo-btns">
          <a href="<?=URL?>corretor/imoveis" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
        <? } ?>
      </div>

      <!-- Cadastrar -->
      <? if ($fotosRestantes > 0) { ?>
      <div class="conta-bloco">
        <div class="conta-bloco-header">
          <div class="conta-bloco-titulo">Cadastrar Fotos</div>
        </div>
        <div class="conta-bloco-content">
          <div class="texto">
            <p>Cadastre pelo menos <b>5 fotos</b> do seu imóvel e marque a melhor delas com o botão <b><i class="fas fa-star" style="color: #ffb84f;"></i> Destaque</b>. Ela será a capa do seu anúncio e a imagem que os visitantes verão nos resultados das buscas.</p>
          </div>
          <form id="form-fotos" action="<?=URL?>acoes/app/corretor/anuncio_fotos.php" method="post" class="form-validation" enctype="multipart/form-data">
            <? $required = $totalFotos > 0 ? 'nao' : 'sim'; ?>
            <div id="dzupload-fotos" class="dropzone" data-maxfile="<?=$fotosRestantes?>" data-maxsize="10" data-required="<?=$required?>"></div>
            <span class="dz-msg-error"></span>
            <div class="btn-container" style="float: none; margin: 0px; margin-bottom: 15px; display: none;">
              <input type="hidden" name="anuncio_id" value="<?=$anuncio['id']?>">
              <button type="submit" id="cad-fotos" class="btn btn-sm btn-primario">Cadastrar Fotos</button>
            </div>
          </form>
        </div>
      </div>
      <? } ?>
      <!-- //Cadastrar -->

      <!-- Galeria -->
      <? if ($totalFotos > 0) { ?>
      <div class="conta-bloco">
        <div class="conta-bloco-header">
          <div class="conta-bloco-titulo">Fotos do imóvel (<?=$totalFotos?> de <?=$limiteFotos?>)</div>
        </div>
        <div class="conta-bloco-content">
          <ul class="row form-fotos ordena-fotos-lista">
            <? foreach ($linhaFotos  as $fotosAn) { ?>
            <!-- Repete -->
            <li class="grid-3 grid-m-3 grid-s-12" data-id="<?=$fotosAn['id']?>">
              <figure><img src="<?=URL?>uploads/img/anuncios/<?=$fotosAn['item_id']?>/anuncios_fotos/thumb-600-440/<?=$fotosAn['foto']?>"></figure>
              <span>
                <? if ($fotosAn['destaque'] == '1') { ?>
                <a class="btn btn-warning" style="cursor: default" title="Destaque"><i class="fas fa-star"></i> &nbsp; Destaque</a>
                <? } else { ?>
                <a href="#" class="btn btn-warning outline btn-dest" data-id="<?=$fotosAn['id']?>" title="Destaque"><i class="fas fa-star"></i> &nbsp; Destaque</a>
                <? } ?>
                <a href="#" class="btn btn-rem btn-confirm" data-id="<?=$fotosAn['id']?>" title="Remover"><i class="fas fa-trash"></i> &nbsp; Remover</a>
              </span>
            </li>
            <!-- //Repete -->
            <? } ?>
          </ul>
          <div class="texto"><b><i class="fas fa-exclamation-circle"></i></b> Clique e arraste uma foto para alterar a ordem de exibição.</div>
        </div>
      </div>
      <? } ?>
      <!-- //Galeria -->

      <div class="conta-base-btns">
        <a href="<?=$btnConcluirLink?>" class="btn btn-sm btn-primario btn-concluir-fotos" data-acao="<?=$acaoFotos?>">Concluir</a>
      </div>

    </div>
    <!-- //CONTEÚDO -->

    <!-- Alerta confirmação -->
    <div class="modal warning" id="modal-confirm">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-confirm"></span>
        <div class="modal-header">
          <span class="modal-titulo">Remover</span>
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <p class="texto">Deseja realmente remover esta foto?</p>
          <div class="modal-btn left">
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm">Cancelar</button>
          </div>
          <div class="modal-btn right">
            <form id="form-remove-foto" action="<?=URL?>acoes/app/corretor/remove_foto_anuncio.php" method="post">
              <input type="hidden" name="acao" value="remover">
              <input type="hidden" name="path" value="<?=IMG_PATH?>/anuncios/<?=$anuncio['id']?>/anuncios_fotos">
              <input type="hidden" name="id_remove" id="id_remove" required>
              <button type="submit" class="btn btn-sm btn-rem">Remover</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação -->

    <!-- Alerta confirmação (Destaque) -->
    <div class="modal warning" id="modal-confirm2">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-confirm2"></span>
        <div class="modal-header">
          <span class="modal-titulo">Destaque</span>
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <p class="texto">Deseja realmente marcar essa foto como destaque?</p>
          <div class="modal-btn left">
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm2">Cancelar</button>
          </div>
          <div class="modal-btn right">
            <form id="form-update-foto" action="<?=URL?>acoes/app/corretor/update_foto_destaque.php" method="post">
              <input type="hidden" name="acao" value="update">
              <input type="hidden" name="path" value="<?=IMG_PATH?>/anuncios/<?=$anuncio['id']?>/anuncios_fotos">
              <input type="hidden" name="id_anuncio" value="<?=$anuncio['id']?>">
              <input type="hidden" name="id_destaque" id="id_destaque" required>
              <button type="submit" class="btn btn-sm btn-primario">Confirmar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação (Destaque) -->

    <!-- FOOTER -->
    <? include(APP_PATH . '/corretor/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
