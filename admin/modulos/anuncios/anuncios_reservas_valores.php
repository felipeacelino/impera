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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor">
                    Valor *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="valor" id="valor" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['valor']); ?>" required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor">Descrição *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor" id="ckeditor" class="ckeditor" rows="1" required><?= $linha_edit['descricao']; ?></textarea>
                    <label for="ckeditor" class="error"></label>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data">
                    Data *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="data" id="data" type="text" class="form-control datepicker col-md-7 col-xs-12" <? if ($acao == 'edit') { ?> value="<?= Tools::formataData($linha_edit['data']); ?>" <? } ?> required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="forma_pgto">
                    Forma de Pagamento *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="forma_pgto" id="forma_pgto" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['forma_pgto']; ?>" required>
                    <!--<select name="forma_pgto" id="forma_pgto" class="form-control col-md-7 col-xs-12" required>
                      <option value="Dinheiro" <? if ('Dinheiro' == $linha_edit['forma_pgto']) { ?> selected <? } ?>>Dinheiro</option>
                      <option value="Cheque" <? if ('Cheque' == $linha_edit['forma_pgto']) { ?> selected <? } ?>>Cheque</option>
                      <option value="Cartão de Débito" <? if ('Cartão de Débito' == $linha_edit['forma_pgto']) { ?> selected <? } ?>>Cartão de Débito</option>
                      <option value="Cartão de Crédito" <? if ('Cartão de Crédito' == $linha_edit['forma_pgto']) { ?> selected <? } ?>>Cartão de Crédito</option>
                      <option value="Boleto" <? if ('Boleto' == $linha_edit['forma_pgto']) { ?> selected <? } ?>>Boleto</option>
                      <option value="Transferência" <? if ('Transferência' == $linha_edit['forma_pgto']) { ?> selected <? } ?>>Transferência</option>
                    </select>-->
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo">
                    Tipo *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="tipo" id="tipo" class="form-control col-md-7 col-xs-12" required>
                      <option value="Ato" <? if ('Ato' == $linha_edit['tipo']) { ?> selected <? } ?>>Ato</option>
                      <option value="Parcela" <? if ('Parcela' == $linha_edit['tipo']) { ?> selected <? } ?>>Parcela</option>
                    </select>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="arquivos">Anexo de Pagamento
                    <br>
                    <small><i class="fa fa-exclamation-circle"></i> Insira outro arquivo para alterar</small>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="arq[arquivo]" accept="*">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                    Status *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="status" id="status" class="switch" value="1" data-label-true="Pago" data-label-false="Pendente" <? if ($acao == 'edit') {
                                                                                                                                                        Tools::checked("1", $linha_edit['status']);
                                                                                                                                                      } else { ?> <? } ?> />
                      <span class="switch-label"></span>
                    </label>
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
                <? if ($acao == "edit") { ?>
                  <input type="hidden" name="id" id="id" value="<?= $id_enviado; ?>">
                <? } ?>
                <!--hidden fields -->

              </form>
              <!--fim formulario -->

            </div>
            <!--fim cadastrar e editar  -->

          <? } ?>

          <!--view -->
          <? if ($acao == "view") { ?>

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
                <!-- DIREITA -->
                <div class="header_row_right">
                  <div class="header_row_item">
                    <a href="<?= $current_url_insert; ?>" class="btn btn-success btn-header">
                      <i class="fas fa-plus"></i>
                      <span>Cadastrar</span>
                    </a>
                  </div>
                </div>
                <!-- FIM DIREITA -->
              </div>
              <!-- FIM LINHA HEADER -->

              <!-- LINHA HEADER -->
              <div class="header_row">

                <!-- ESQUERDA -->
                <div class="header_row_left">

                  <!-- COM SELECIONADOS -->
                  <div class="header_row_item">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Com selecionados
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a class="acao-multiplos" data-acao="status_1"><i class="fas fa-check"></i> Pago
                          </a>
                        </li>
                        <li>
                          <a class="acao-multiplos" data-acao="status_0"><i class="fas fa-times"></i> Pendente
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-multiplos" data-acao="remover"><i class="fas fa-trash-alt"></i> Remover
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- FIM COM SELECIONADOS -->

                </div>
                <!-- FIM ESQUERDA -->

                <!-- DIREITA -->
                <div class="header_row_right">

                  <div class="header_row_item header_row_item_hide">
                    <i class="fas fa-file-alt"></i> <?= $total_registros; ?> registro(s)
                  </div>

                  <!-- ORDEM -->
                  <div class="header_row_item">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Ordenar
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY data ASC"><i class="fas fa-sort-alpha-down"></i> Data (mais antiga)
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY data DESC"><i class="fas fa-sort-alpha-down-alt"></i> Data (mais nova)
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY id DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais novos
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY id ASC"><i class="fas fa-sort-numeric-down"></i> Mais antigos
                          </a>
                        </li>
                      </ul>
                      <form id="form-ordem" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                        <input type="hidden" name="sort_ordem" id="sort_ordem" value="<?= $_SESSION[$pag_include]['ordem'] ?>">
                        <input type="hidden" name="acao_exec" value="ordenar">
                      </form>
                    </div>
                  </div>
                  <!-- FIM ORDEM -->

                </div>
                <!-- FIM DIREITA -->

              </div>
              <!-- FIM LINHA HEADER -->


              <!-- FILTROS -->
              <div id="filtros" class="header_row">
                <div class="filtros-btn-container">
                  <button class="btn btn-default" id="exibe_filtros">
                    <i class="fas fa-filter"></i>
                    Filtros
                    <i class="fas fa-chevron-down"></i>
                  </button>
                </div>
                <div class="filtros-container">
                  <form method="post" action="<?= $acao_filtros ?>">
                    <div class="filtros-itens">

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_status" class="control-label">Status:</label>
                        <select name="filtro_status" id="filtro_status" class="form-control">
                          <option value="">Todos</option>
                          <option value="1" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "1") ?>>Pago</option>
                          <option value="0" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "0") ?>>Pendente</option>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_data" class="control-label">Data:</label>
                        <input type="text" name="filtro_data" id="filtro_data" class="form-control data_range" data-popup-direction="left" readonly="readonly" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_data'] ?>">
                      </div>
                      <!-- // Item filtro -->

                    </div>
                    <div class="filtros-actions full">
                      <a href="<?= URL ?>acoes/admin/geral/limpar_filtros.php?pagina=<?= $pag_include ?>&retorno=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-default"><i class="fas fa-times"></i> Limpar</a>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Aplicar</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- FIM FILTROS -->

              <form name="excluir" id="form_acao" method="post">

                <? if ($total_registros > 0) { ?>

                  <table class="table table_responsive">

                    <!--cabeçalho -->
                    <thead>
                      <tr>
                        <th>
                          <label class="check"><input type="checkbox" id="selecctall"><span></span></label>
                        </th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <!--cabeçalho -->

                    <tbody>

                      <? foreach ($resultado as $linha) { ?>

                        <?
                              $current_url_edit = $_GET['p'] != '' ?
                                "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/edit/" . $linha['id'] . "/" . $reserva['id'] . "?p=" . $_GET['p'] : "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/edit/" . $linha['id'] . "/" . $reserva['id'];
                              ?>

                        <tr>

                          <!--item -->
                          <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?= $linha['id'] ?>"><span></span></label></td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Valor">
                            <p><b>R$ <?= Tools::formataMoeda($linha['valor']); ?></b></p>
                            <p>Forma de Pagamento: <?= $linha['forma_pgto']; ?></p>
                            <p>Tipo: <?= $linha['tipo']; ?></p>
                            <p>Data: <?= Tools::formataData($linha['data']); ?></p>
                            <? if ($linha['arquivo'] != '') { ?>
                              <p><a href="<?= $pathView ?>/<?= $linha['id']; ?>/<?= $linha['arquivo']; ?>" target="_blank">
                                  <i class="fa fa-download"></i>&nbsp Anexo de Pagamento
                                </a></p>
                              <p>
                                <a href="#" class="btn btn-xs btn-danger btn-remove-anexo" data-iddel="<?= $linha['id']; ?>"><i class="fa fa-trash"></i> Remover Anexo</a>
                              </p>
                            <? } ?>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Status">
                            <? $status = array('Pendente', 'Pago'); ?>
                            <label class="status status<?= $linha['status']; ?>">
                              <i class="fas fa-circle"></i>
                              <span><?= $status[$linha['status']]; ?></span>
                            </label>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td>
                            <a class="btn btn-xs btn-default" href="<?= $current_url_edit ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a href="#" class="btn btn-xs btn-danger btn-remove" data-iddel="<?= $linha['id']; ?>"><i class="fas fa-trash-alt"></i> Remover</a>
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

              <!-- Modal remove anexo -->
              <div class="modal fade" id="modal-remove-anexo" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title">Remover registro</h4>
                    </div>

                    <form id="form_excluir" name="form_excluir" method="post" action="<?=$current_url_delete_anexo; ?>">

                      <div class="modal-body">
                        <p>Deseja remover esse anexo?</p>                            
                        <input type="hidden" name="id" id="id_remove_anexo" value="">  
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
              <!-- Fim Modal remove anexo -->

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
