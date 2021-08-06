<? include(ACOES_APP_PATH . "/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH . "/corretor/documentos.php"); ?>
<?php
$titulo_pagina = "Documentos - " . TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH . '/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="documentos">

  <!-- HEADER -->
  <? include(APP_PATH . '/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH . '/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo"><?=$cliente['nome']?> <i class="fas fa-chevron-right"></i> Documentos</h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>corretor/clientes" class="btn btn-sm"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      </div>

      <div class="conta-topo">
        <h1 class="conta-titulo">Documentos Enviados</h1>
        <div class="conta-topo-btns">
          <a href="<?= URL ?>corretor/cadastro-arquivo/insert/<?=$cliente['id']?>" class="btn btn-sm btn-primario"><i class="fas fa-plus"></i> Enviar Documento</a>
        </div>
      </div>

      <!-- ARQUIVOS ENVIADOS -->
      <div class="conta-bloco">
        <div class="conta-bloco-content">

          <? if ($totalArquivosEnviados > 0) { ?>

            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th>Descrição</th>
                  <th width="170px">Data</th>
                  <th width="170px">Arquivo</th>
                  <!-- <th width="150px"></th> -->
                </tr>
              </thead>
              <tbody>

                <? foreach ($arquivosEnviadoslist as $documento_enviado) { ?>
                  <!-- Repete -->
                  <tr id="arquivo-<?= $documento_enviado['id'] ?>">
                    <? if ($documento_enviado['tipo'] == "" || $documento_enviado['tipo'] == "9") { ?>
                      <td><b><?=$documento_enviado['titulo']?></b></td>
                    <? } else { ?>
                      <td><b><?=$tiposDocumentos[$documento_enviado['tipo']]['titulo']?></b></td>
                    <? } ?>
                    <td><small><?= Tools::formataData($documento_enviado['date_time']) ?></small></td>
                    <td><a href="<?= URL; ?>uploads/outros/<?= $tabela ?>/<?= $documento_enviado['id'] ?>/<?= $documento_enviado['arquivo'] ?>" target="_blank" download class="btn btn-xs btn-terciario"><i class="fas fa-arrow-down"></i>Baixar</a></td>
                    <!-- <td>
                      <div class="conta-tabela-opcoes">
                        <a href="<?= URL ?>corretor/cadastro-arquivo/update/<?= $documento_enviado['id'] ?>" class="btn btn-xs" title="Editar"><i class="fas fa-pencil-alt m-0"></i></a>
                        <a href="#" class="btn btn-xs btn-rem btn-confirm" data-id="<?= $documento_enviado['id'] ?>" title="Remover"><i class="fas fa-trash m-0"></i></a>
                      </div>
                    </td> -->
                  </tr>
                  <!-- //Repete -->
                <? } ?>

              </tbody>
            </table>
            <!-- //Tabela -->

          <? } else { ?>

            <!-- SEM REGISTROS -->
            <div class="conta-empty texto">
              <p>Nenhum documento enviado.</p>
            </div>

          <? } ?>

        </div>
      </div>
      <!--// ARQUIVOS ENVIADOS -->

      <div class="conta-topo">
        <h1 class="conta-titulo">Documentos Recebidos</h1>
      </div>

      <!-- ARQUIVOS RECEBIDOS -->
      <div class="conta-bloco">
        <div class="conta-bloco-content">

          <? if ($totalArquivosRecebidos > 0) { ?>

            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th>Descrição</th>
                  <th width="170px">Data</th>
                  <th width="170px">Arquivo</th>
                  <!-- <th width="150px"></th> -->
                </tr>
              </thead>
              <tbody>

                <? foreach ($arquivosRecebidoslist as $documento_recebido) { ?>
                  <!-- Repete -->
                  <tr>
                    <td><small><b><?= $documento_recebido['titulo'] ?></b></small></td>
                    <td><small><?= Tools::formataData($documento_recebido['date_time']) ?></small></td>
                    <td><a href="<?= URL; ?>uploads/outros/<?= $tabela ?>/<?= $documento_recebido['id'] ?>/<?= $documento_recebido['arquivo'] ?>" target="_blank" download class="btn btn-xs btn-terciario"><i class="fas fa-arrow-down"></i>Baixar</a></td>
                    <!--<td>
                      <div class="conta-tabela-opcoes">
                        <a href="<?= URL ?>corretor/cadastro-arquivo/update/<?= $documento_recebido['id'] ?>" class="btn btn-xs" title="Editar"><i class="fas fa-pencil-alt m-0"></i></a>
                        <a href="#" class="btn btn-xs btn-rem btn-confirm" data-id="<?= $documento_recebido['id'] ?>" title="Remover"><i class="fas fa-trash m-0"></i></a>
                      </div>
                    </td>-->
                  </tr>
                  <!-- //Repete -->
                <? } ?>

              </tbody>
            </table>
            <!-- //Tabela -->

          <? } else { ?>

            <!-- SEM REGISTROS -->
            <div class="conta-empty texto">
              <p>Nenhum documento recebido.</p>
            </div>

          <? } ?>

        </div>
      </div>
      <!--// ARQUIVOS RECEBIDOS -->

    </div>
    <!-- //CONTEÚDO -->

    <!-- Alerta confirmação -->
    <div class="modal error" id="modal-confirm">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-confirm"></span>
        <div class="modal-header">
          <span class="modal-titulo">Remover</span>
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-times-circle"></i>
          </div>
          <p class="texto">Deseja realmente remover este arquivo?</p>
          <div class="modal-btn left">
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm">Cancelar</button>
          </div>
          <div class="modal-btn right">
            <form id="form-remove-arquivo" action="<?= URL ?>acoes/app/corretor/documentos.php" method="post">
              <input type="hidden" name="acao" value="remover">
              <input type="hidden" id="retorno_success" name="retorno_success" value="<?= URL ?>corretor/documentos">
              <input type="hidden" name="id_remove" id="id_remove" required>
              <button type="submit" class="btn btn-sm btn-rem">Remover</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação -->

    <!-- FOOTER -->
    <? include(APP_PATH . '/corretor/estrutura/footer.php'); ?>

    <? if ($param4 == "edit-success") { ?>
      <script>
        showAlert('Sucesso', 'Arquivo atualizado com sucesso.', 'success');
      </script>
    <? } ?>
    <? if ($param4 == "cad-success") { ?>
      <script>
        showAlert('Sucesso', 'Arquivo enviado com sucesso.', 'success');
      </script>
    <? } ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
