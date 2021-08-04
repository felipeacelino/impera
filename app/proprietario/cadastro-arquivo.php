<? include(ACOES_APP_PATH."/proprietario/restrito.php"); ?>
<? include(ACOES_APP_PATH."/proprietario/documentos.php"); ?>
<?php
$titulo_pagina = "Arquivos - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="documentos">

  <!-- HEADER -->
  <? include(APP_PATH.'/proprietario/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/proprietario/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo"><?=$titulo?></h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>proprietario/documentos" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      </div>

      <form id="form-arquivo" action="<?=URL?>acoes/app/proprietario/documentos.php" method="post" class="form-validation" enctype="multipart/form-data">

        <div class="conta-bloco">
          <div class="conta-bloco-content">

            <div class="texto">
              <p>(*) Campos obrigatórios.</p>
            </div>

            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="imovel_cod">Código do imóvel *</label>
                <select name="imovel_cod" id="imovel_cod" class="campo" data-parsley-trigger="change" required>
                  <option value="" hidden>Selecione</option>
                  <? foreach ($imoveisUser as $imovelUser) { ?>
                    <option value="<?=$imovelUser['id']?>">(<?=$imovelUser['codigo']?>) <?=$imovelUser['titulo']?></option>
                  <? } ?>
                </select>
                <div class="arrow"></div>
              </div>
            </div>
            
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="titulo">Descrição do documento *</label>
                <input type="text" name="titulo" id="titulo" maxlength="255" class="campo" placeholder="Informe a descrição do documento" value="<?=$arquivo['titulo']?>" data-parsley-trigger="change" required />
              </div>
            </div>

            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container" style="margin-bottom: 0px;">
                <label for="arquivo">Arquivo (Máx. 10Mb)*</label>
                <input type="file" name="arquivos[arquivo]" id="arquivo" class="campo file" data-parsley-maxfilesize="10" data-parsley-trigger="change" <? if ($acao == 'insert') { ?> required <? } ?>/>
              </div>
            </div>

          </div>
        </div>

        <div class="conta-base-btns">
          <input type="hidden" id="acao-arquivo" name="acao" value="<?=$acao?>">
          <input type="hidden" name="id_arquivo" value="<?=$arquivo['id']?>">
          <button type="submit" id="btn-form-arquivo" class="btn btn-sm btn-primario"><?=$botao?></button>
        </div>

      </form>

    </div>
    <!-- //CONTEÚDO -->

    <!-- MODAIS TIPOS -->
    <? foreach ($tiposDocumentos as $tipoK => $tipoV) { ?>
      <div class="modal" id="modal-tipo-doc-<?=$tipoK?>">
        <div class="modal-wrap modal-sm">
          <span class="modal-btn-close modal-close" data-modal="modal-tipo-doc-<?=$tipoK?>"></span>
          <div class="modal-header">
            <span class="modal-titulo"><?=$tipoV['titulo']?></span>                
          </div>
          <div class="modal-body">
            <div class="texto">
              <?=$tipoV['texto']?>
            </div>
            <div style="text-align: center;">
              <button type="button" class="btn btn-sm btn-primario modal-close" data-modal="modal-tipo-doc-<?=$tipoK?>">Entendi</button>
            </div>
          </div>
        </div>
      </div>
      <!-- //MODAIS TIPOS -->
    <? } ?>

    <!-- FOOTER -->
    <? include(APP_PATH.'/proprietario/estrutura/footer.php'); ?>
    
  </main>
  <!-- //PÁGINA -->

</body>

</html>
