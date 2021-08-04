<? include("" . ACOES_ADMIN_PATH . "/" . $pasta_modulo . "/" . $pag_include . ".php"); ?>

<!-- estrutura -->
<div class="right_col" role="main">
  <div class="">

    <!-- titulo -->
    <div class="page-title">
      <div class="title_left">
        <h3>
          <?= $tit_pag_geral; ?>
          <small></small>
        </h3>
      </div>
    </div>
    <!-- fim titulo -->

    <!-- conteudo -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <!--mensagem retorno -->
          <?
          echo $_SESSION['msg_retorna'];
          ?>
          <span id="divclean"></span>
          <!--fim mensagem retorno -->

          <? if ($acao == "insert" || $acao == "edit") { ?>

            <!--cadastrar e editar  -->
            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- LINHA HEADER -->
              <div class="header_row" id="barra_header">
                <!-- ESQUERDA -->
                <div class="header_row_left">
                  <div class="header_row_item">
                    <a href="<?= $retorno_geral; ?>" class="btn btn-primary btn-header">
                      <i class="fas fa-chevron-left"></i>
                      <span>Voltar</span>
                    </a>
                  </div>
                </div>
                <!-- FIM ESQUERDA -->
              </div>
              <!-- FIM LINHA HEADER -->

              <!--formulario -->
              <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?= $action_form; ?>" enctype="multipart/form-data">

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="taxa_repasse">
                    Taxa *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="taxa_repasse" id="taxa_repasse" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['taxa_repasse']); ?>" required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor_repasse">
                    Valor * <br>
                    <small>Valor que será repassado ao proprietário</small>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="valor_repasse" id="valor_repasse" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['valor_repasse']); ?>" required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_repasse">
                    Data *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="data_repasse" id="data_repasse" type="text" class="form-control datepicker col-md-7 col-xs-12" <? if ($linha_edit['data_repasse'] != '') { ?> value="<?= Tools::formataData($linha_edit['data_repasse']); ?>" <? } ?> required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_repasse">
                    Status *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="status_repasse" id="status_repasse" class="switch" value="1" data-label-true="Pago" data-label-false="Pendente" <? if ($acao == 'edit') {Tools::checked("1", $linha_edit['status_repasse']);} else { ?> <? } ?> />
                      <span class="switch-label"></span>
                    </label>
                  </div>
                </div>
                <!--repete -->

                <div class="ln_solid"></div>

                <!--botoes -->
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" id="bt1" class="btn btn-primary" value="bt1" name="bt1"><?= $msg_botao; ?></button>
                  </div>
                </div>
                <!--botoes -->

                <!--hidden fields -->
                <input type="hidden" name="retorno" id="retorno" value="">
                <input type="hidden" name="token" value="<?= TOKEN; ?>">
                <input type="hidden" name="acao" value="<?= $acao; ?>">
                <input type="hidden" name="tabela_verifica" id="tabela_verifica" value="<?= $tabela; ?>">
                <? if ($acao == "edit") { ?>
                  <input type="hidden" name="id" id="id" value="<?= $id_enviado2; ?>">
                <? } ?>
                <!--hidden fields -->

              </form>
              <!--fim formulario -->

            </div>
            <!--fim cadastrar e editar  -->

          <? } ?>

        </div>
      </div>
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
