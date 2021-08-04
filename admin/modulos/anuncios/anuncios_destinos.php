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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto]">Imagem *
                  <? if($acao == "edit"){ ?>
                  <br>
                  <small><i class="fas fa-exclamation-circle"></i> Clique na imagem para alterar</small>
                  <? } ?>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" name="img[foto]" accept="image/*" class="ezdz" <? if($acao=="insert" ){ ?> required="required"
                  <? }else{ ?> data-value="<?= URL ?>uploads/img/<?= $tabela ?>/<?= $linha_edit['id'] ?>/<?= $linha_edit['foto'] ?>"
                  <? } ?>>
                  <label for="img[foto]" class="error error-img"></label>
                </div>
              </div>
              <!--repete -->

              <div class="separator-form"></div>

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="destino">
                  Destino *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="destino" id="destino" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['destino']; ?>" required>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">
                  Estado *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="estado" id="estado" class="form-control col-md-7 col-xs-12" required>
                    <option value="" hidden>Selecione o estado</option>
                    <? foreach (Tools::getEstados() as $uf => $estado) { ?>
                    <option value="<?= $estado ?>" <?= Tools::selected($estado, $linha_edit['estado']) ?>><?= $estado ?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">
                  Cidade *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="cidade" id="cidade" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['cidade']; ?>" required>
                </div>
              </div>
              <!--repete -->

              <div class="separator-form"></div>

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                  Status *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>
                    <input type="checkbox" name="status" id="status" class="switch" value="1" data-label-true="Ativo" data-label-false="Inativo" <? if($acao=='edit' ){ Tools::checked("1",$linha_edit['status']); } else { ?> checked
                    <? } ?> />
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

            <!-- LINHA HEADER -->
            <div class="header_row" id="barra_header">
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
                  <div class="filtros-itens align-center-filtros">

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_cidade" class="control-label">Cidade:</label>
                      <select name="filtro_cidade" id="filtro_cidade" class="form-control">
                        <option value="">Todos</option>
                        <? foreach ($cidades as $cidade) { ?>
                        <option value="<?= $cidade['cidade'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_cidade'], $cidade['cidade']) ?>><?= $cidade['cidade'] ?></option>
                        <? } ?>
                      </select>
                    </div>
                    <!-- // Item filtro -->

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_status" class="control-label">Status:</label>
                      <select name="filtro_status" id="filtro_status" class="form-control">
                        <option value="">Todos</option>
                        <option value="1" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "1") ?>>Ativos</option>
                        <option value="0" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "0") ?>>Inativos</option>
                      </select>
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
                        <a class="acao-multiplos" data-acao="status_1"><i class="fas fa-check"></i> Ativar
                        </a>
                      </li>
                      <li>
                        <a class="acao-multiplos" data-acao="status_0"><i class="fas fa-times"></i> Desativar
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

            <form name="excluir" id="form_acao" method="post">

              <? if ($total_registros > 0) { ?>

              <table class="table table_responsive">

                <!--cabeçalho -->
                <thead>
                  <tr>
                    <th>
                      <label class="check"><input type="checkbox" id="selecctall"><span></span></label>
                    </th>
                    <th>Imagem</th>
                    <th>Destino</th>
                    <th>Estado / Cidade</th>
                    <th>Status</th>
                    <th></th>
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
                    <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?= $linha['id'] ?>"><span></span></label></td>
                    <!--item -->

                    <!--item -->
                    <td class="tr-lg">
                      <img src="<?= URL; ?>uploads/img/<?= $tabela ?>/<?= $linha['id']; ?>/thumb-500-600/<?= $linha['foto']; ?>">
                    </td>
                    <!--item -->
                    
                    <!--item -->
                    <td data-label="Destino"><?= $linha['destino']; ?></td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Estado / Cidade"><?= $linha['estado']; ?> / <?= $linha['cidade']; ?></td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Status">
                      <?
                            $status = array('Inativo', 'Ativo', 'Pendente');
                            ?>
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
