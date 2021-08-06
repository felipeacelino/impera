<? include(ACOES_APP_PATH."/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH."/corretor/documentos.php"); ?>
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
  <? include(APP_PATH.'/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo"><?=$cliente['nome']?> <i class="fas fa-chevron-right"></i> <?=$titulo?></h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>corretor/documentos/<?=$cliente['id']?>" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      </div>

      <form id="form-arquivo" action="<?=URL?>acoes/app/corretor/documentos.php" method="post" class="form-validation" enctype="multipart/form-data">

        <div class="conta-bloco">
          <div class="conta-bloco-content">

            <div class="texto">
              <p>(*) Campos obrigatórios.</p>
            </div>

            <!-- <div class="row">
              <div class="grid-4 grid-m-12 grid-s-12 campo-container">
                <label for="imovel_cod">Código do imóvel *</label>
                <input type="text" name="imovel_cod" id="imovel_cod" maxlength="255" class="campo"
                  placeholder="Informe o código do imóvel" value="<?=$arquivo['imovel_cod']?>" data-parsley-trigger="change" required />
              </div>
            </div> -->

            <div class="row">
              <div class="grid-4 campo-container">
                <label for="tipo_doc">Tipo de documento * <span class="campo-icon-help campo-icon-help-docs modal-open" style="font-size: 1.2em"><i class="las la-exclamation-circle"></i></span></label>
                <select name="tipo" id="tipo_doc" class="campo" data-parsley-trigger="change" required>
                  <option value="" hidden>Selecione</option>
                  <? foreach ($tiposDocumentos as $tipoK => $tipoV) { ?>
                    <option value="<?=$tipoK?>"><?=$tipoK?> - <?=$tipoV['titulo']?></option>
                  <? } ?>
                </select>
                <div class="arrow"></div>
              </div>
            </div>
            
            <div class="row document-desc-wrp" style="display: none;">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="titulo">Descrição do documento *</label>
                <input type="text" name="titulo" id="titulo" maxlength="255" class="campo"
                  placeholder="Informe a descrição do documento" value="<?=$arquivo['titulo']?>" data-parsley-trigger="change" required />
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
          <input type="hidden" name="id_cliente" value="<?=$cliente['id']?>">
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
    <? include(APP_PATH.'/corretor/estrutura/footer.php'); ?>
    
  </main>
  <!-- //PÁGINA -->

</body>

</html>
