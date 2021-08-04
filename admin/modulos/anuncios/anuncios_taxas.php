<? include ("".ACOES_ADMIN_PATH."/".$pasta_modulo."/".$pag_include.".php"); ?>

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

          <? if($acao == "insert" || $acao == "edit"){?>

          <!--cadastrar e editar  -->
          <div class="col-md-12 col-sm-12 col-xs-12">

            <!-- LINHA HEADER -->
            <div class="header_row" id="barra_header">
              <!-- DIREITA -->
              <div class="header_row_left">
                <div class="header_row_item">
                  <a href="<?= $current_url_view; ?>" class="btn btn-primary btn-header">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                  </a>
                </div>
              </div>
              <!-- FIM DIREITA -->
            </div>
            <!-- FIM LINHA HEADER -->

            <!--formulario -->
            <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?= $action_form; ?>" enctype="multipart/form-data">

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">
                  Estado
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="titulo" id="titulo" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo'];?>" readonly>
                </div>
              </div>
              <!--repete -->

              <div class="separator-form"></div>

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itbi">
                  ITBI (%) *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="itbi" id="itbi" type="text" inputmode="numeric" class="form-control col-md-7 col-xs-12 input_percent" value="<?=str_replace(".",",",$linha_edit['itbi']);?>" required>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="escritura">
                  Escritura (%) *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="escritura" id="escritura" type="text" inputmode="numeric" class="form-control col-md-7 col-xs-12 input_percent" value="<?=str_replace(".",",",$linha_edit['escritura']);?>" required>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registro">
                  Registro (%) *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="registro" id="registro" type="text" inputmode="numeric" class="form-control col-md-7 col-xs-12 input_percent" value="<?=str_replace(".",",",$linha_edit['registro']);?>" required>
                </div>
              </div>
              <!--repete -->

              <div class="ln_solid"></div>

              <!--botoes -->
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" id="bt1" class="btn btn-primary" value="bt1" name="bt1"><?= $msg_botao; ?> e continuar</button>
                  <button type="submit" id="bt2" class="btn btn-success" value="bt2" name="bt2"><?= $msg_botao; ?></button>
                </div>
              </div>
              <!--botoes -->

              <!--hidden fields -->
              <input type="hidden" name="retorno" id="retorno" value="">
              <input type="hidden" name="token" value="<?= TOKEN; ?>">
              <input type="hidden" name="acao" value="<?= $acao; ?>">
              <input type="hidden" name="tabela_verifica" id="tabela_verifica" value="<?= $tabela; ?>">
              <? if($acao == "edit"){ ?>
              <input type="hidden" name="id" id="id" value="<?= $id_enviado; ?>">
              <input type="hidden" name="banner_atual" value="<?= $linha_edit['banner'] ?>">
              <? } ?>
              <!--hidden fields -->

            </form>
            <!--fim formulario -->

          </div>
          <!--fim cadastrar e editar  -->

          <? } ?>

          <!--view -->
          <? if($acao == "view"){ ?>

          <div class="col-md-12 col-sm-12 col-xs-12">

            <form name="excluir" id="form_acao" method="post">

              <? if ($total_registros > 0) { ?>

              <table class="table table_responsive">

                <!--cabeçalho -->
                <thead>
                  <tr>
                    <th>Estado</th>
                    <th width="150px">ITBI</th>
                    <th width="150px">Escritura</th>
                    <th width="150px">Registro</th>
                    <th width="150px"></th>
                  </tr>
                </thead>
                <!--cabeçalho -->

                <tbody>

                  <? foreach ($resultado as $linha) { ?>

                    <?
                    $current_url_edit = $_GET['p'] != '' ? 
                    "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id']."?p=".$_GET['p'] : 
                    "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id'];
                    ?>

                  <tr>
                    
                    <!--item -->
                    <td data-label="Estado"><b><?=$linha['titulo']?></b></td>
                    <!--item -->

                    <!--item -->
                    <td data-label="ITBI"><?=str_replace(".",",",$linha['itbi'])?>%</td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Escritura"><?=str_replace(".",",",$linha['escritura'])?>%</td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Registro"><?=str_replace(".",",",$linha['registro'])?>%</td>
                    <!--item -->

                    <!--item -->
                    <td>
                      <a class="btn btn-xs btn-default" href="<?= $current_url_edit ?>"><i class="fas fa-edit"></i> Editar</a>
                    </td>
                    <!--item -->

                  </tr>

                  <? } ?>

                </tbody>

              </table>

              <? } else { ?>

              <span class="sem-registro-txt">
                <i class="fas fa-exclamation-circle"></i>
                Nenhum registro encontrado
              </span>

              <? } ?>

              <input type="hidden" id="confere" value="" />
              <input type="hidden" name="tabela_atual" id="tabela_atual" value="<?= $tabela; ?>" />
              <input type="hidden" name="token" value="<?= TOKEN; ?>" />
              <input type="hidden" name="acao_exec" id="acao_exec" value="" />
              <input type="hidden" name="campo" value="status" />
              <input type="hidden" name="status" id="status">
              <input type="hidden" name="retorno" value="<?= $_SERVER['REQUEST_URI']; ?>" />

            </form>

            <? $acoes->Pagination($url_paginacao); ?>

            <!-- Modal remove -->
            <div class="modal fade" id="modal-remove" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                    </button>
                    <h4 class="modal-title">Remover registro</h4>
                  </div>

                  <form id="form_excluir" name="form_excluir" method="post" action="<?= $current_url_delete; ?>">

                    <div class="modal-body">
                      <p>Deseja remover esse item?</p>
                      <input type="hidden" name="id" id="id_remove" value="">
                      <input type="hidden" name="id_adicional" value="">
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <input type="submit" class="btn btn-danger" value="Remover">
                    </div>

                  </form>

                </div>
              </div>
            </div>
            <!-- Fim Modal remove -->

            <!-- Modal múltiplos -->
            <div class="modal fade" id="modal-multiplo" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                    </button>
                    <h4 class="modal-title" id="titulo-modal-multiplo"></h4>
                  </div>
                  <div class="modal-body">
                    <p id="texto-modal-multiplo"></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn-multiplo" class="" data-dismiss="modal"></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fim Modal múltiplos -->

            <!-- Modal alerta -->
            <div class="modal fade" id="modal-alerta" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                    </button>
                    <h4 class="modal-title">Atenção</h4>
                  </div>
                  <div class="modal-body">
                    <p>Selecione ao menos um item.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fim Modal alerta -->

          </div>

          <? } ?>
          <!--fim view -->

        </div>
      </div>
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
