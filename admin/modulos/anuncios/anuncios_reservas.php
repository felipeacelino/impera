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

                <div class="texto" style="text-align: center">
                  <p><b>Observação:</b> As datas <b>confirmadas</b> são bloqueadas automaticamente, para desmarca-las, é necessário que sejam <b>canceladas</b>.</p>
                </div>

                <ul class="calendario-legendas center">
                  <li class="primaria"><i class="fas fa-circle"></i> Datas selecionadas</li>
                  <li class="error"><i class="fas fa-circle"></i> Datas reservadas/indisponíveis</li>
                </ul>

                <ul class="calendario-legendas center">
                  <li><i class="fas fa-calendar-alt"></i> Chegada: <?= Tools::formataData($linha_edit['chegada']) ?></li>
                  <li><i class="fas fa-calendar-alt"></i> Saída: <?= Tools::formataData($linha_edit['saida']) ?></li>
                </ul>

                <!--calendário-->
                <div class="campo-calendario">
                </div>
                <!--calendário-->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="taxas">
                    Taxas * <br>
                    <small>Ex: Limpeza, Manutenção, etc</small>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="taxas" id="taxas" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['taxas']); ?>" required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_sem_taxas">
                    Reserva *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="total_sem_taxas" id="total_sem_taxas" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['total_sem_taxas']); ?>" required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-2 col-xs-12" for="hospedes">
                    Hóspedes *
                  </label>
                  <div class="col-md-2 col-sm-3 col-xs-12">
                    <div class="number-picker-input">
                      <span class="number-picker-sub disabled" data-target="#hospedes"><i class="fas fa-minus-circle"></i></span>
                      <input type="text" id="hospedes" name="hospedes" data-min="1" <? if ($acao == 'insert') { ?> value="0" <? } else { ?> value="<?= $linha_edit['hospedes'] ?>" <? } ?> data-max="<?= $anuncio['hospedes'] ?>" readonly="" required="">
                      <span class="number-picker-add" data-target="#hospedes"><i class="fas fa-plus-circle"></i></span>
                    </div>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="horario">
                    Horário <br>
                    <small>Horário de entrada e saída para o contrato</small><br>
                    <small>Padrão: com entrada às 15hs e saída às 11hs</small>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="horario" id="horario" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['horario']; ?>">
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
                <input type="hidden" name="anuncio_id" id="anuncio_id" value="<?= $anuncio['id']; ?>">
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
                <!-- DIREITA -->
                <div class="header_row_right">
                  <div class="header_row_item">
                    <br><br>
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
                    <div class="filtros-itens">

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_codigo" class="control-label"># (Código):</label>
                        <input type="text" name="filtro_codigo" id="filtro_codigo" class="form-control" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_codigo'] ?>">
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <link href="<?= URL; ?>admin/vendors/multiple-select-master/multiple-select-admin.css" rel="stylesheet" />
                      <div class="campo-filtro form-group">
                        <label for="filtro_proprietario" class="control-label">Proprietário:</label>
                        <select name="filtro_proprietario" id="filtro_proprietario" multiple="multiple" class="campos_busca">
                          <? foreach ($proprietarios as $proprietario) { ?>
                            <option value="<?= $proprietario['id']; ?>" <?= Tools::selected("" . $proprietario['id'] . "", $_SESSION[$pag_include]['filtros']['filtro_proprietario']) ?>><?= $proprietario['nome']; ?> - <?= $proprietario['cpf']; ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <script src="<?= URL; ?>admin/vendors/multiple-select-master/multiple-select.js"></script>
                      <script>
                        $('#filtro_proprietario').multipleSelect({
                          filter: true,
                          placeholder: "Selecione",
                          selectAll: false,
                          minimumCountSelected: 1,
                          single: true,
                          allSelected: 'Proprietário Selecionado',
                          countSelected: '# de % selecionados',
                          noMatchesFound: 'Proprietário não encontrado',
                          selectAllText: 'Selecionar todos',
                          selectAllDelimiter: [''],
                          onClick: function(view) {
                            $('#filtro_proprietario').valid();
                          }
                        });
                      </script>
                      <style>
                        .ms-parent {
                          height: 34px;
                        }

                        .ms-parent input[type=radio] {
                          opacity: 0;
                        }
                      </style>
                      <!-- //Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_locatario" class="control-label">Locatário:</label>
                        <select name="filtro_locatario" id="filtro_locatario" multiple="multiple" class="campos_busca">
                          <? foreach ($locatarios as $locatario) { ?>
                            <option value="<?= $locatario['id']; ?>" <?= Tools::selected("" . $locatario['id'] . "", $_SESSION[$pag_include]['filtros']['filtro_locatario']) ?>><?= $locatario['nome']; ?> - <?= $locatario['cpf']; ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <script>
                        $('#filtro_locatario').multipleSelect({
                          filter: true,
                          placeholder: "Selecione",
                          selectAll: false,
                          minimumCountSelected: 1,
                          single: true,
                          allSelected: 'Locatário Selecionado',
                          countSelected: '# de % selecionados',
                          noMatchesFound: 'Locatário não encontrado',
                          selectAllText: 'Selecionar todos',
                          selectAllDelimiter: [''],
                          onClick: function(view) {
                            $('#filtro_locatario').valid();
                          }
                        });
                      </script>
                      <!-- //Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_anuncio" class="control-label">Anúncio:</label>
                        <select name="filtro_anuncio" id="filtro_anuncio" multiple="multiple" class="campos_busca">
                          <? foreach ($anuncios as $anuncio) { ?>
                            <option value="<?= $anuncio['id']; ?>" <?= Tools::selected("" . $anuncio['id'] . "", $_SESSION[$pag_include]['filtros']['filtro_anuncio']) ?>><?= $anuncio['titulo']; ?> - <?= $anuncio['codigo']; ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <script>
                        $('#filtro_anuncio').multipleSelect({
                          filter: true,
                          placeholder: "Selecione",
                          selectAll: false,
                          minimumCountSelected: 1,
                          single: true,
                          allSelected: 'Anúncio Selecionado',
                          countSelected: '# de % selecionados',
                          noMatchesFound: 'Anúncio não encontrado',
                          selectAllText: 'Selecionar todos',
                          selectAllDelimiter: [''],
                          onClick: function(view) {
                            $('#filtro_anuncio').valid();
                          }
                        });
                      </script>
                      <!-- //Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_status" class="control-label">Status:</label>
                        <select name="filtro_status" id="filtro_status" class="form-control">
                          <option value="">Todos</option>
                          <option value="1" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "1") ?>>Confirmada</option>
                          <option value="3" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "3") ?>>Em Atendimento</option>
                          <option value="2" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "2") ?>>Pendente</option>
                          <option value="0" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "0") ?>>Cancelado</option>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_data" class="control-label">Datas das Reservas:</label>
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
                          <a class="acao-multiplos" data-acao="status_1"><i class="fas fa-check"></i> Confirmar
                          </a>
                        </li>
                        <li>
                          <a class="acao-multiplos" data-acao="status_3"><i class="fas fa-headset"></i> Em Atendimento
                          </a>
                        </li>
                        <li>
                          <a class="acao-multiplos" data-acao="status_2"><i class="fas fa-clock"></i> Pendente
                          </a>
                        </li>
                        <li>
                          <a class="acao-multiplos" data-acao="status_0"><i class="fas fa-times"></i> Cancelar
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
                          <a class="acao-ordenar" data-ordem="ORDER BY r.data_exibe DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais novos
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY r.data_exibe ASC"><i class="fas fa-sort-numeric-down"></i> Mais antigos
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
                        <th>Imóvel</th>
                        <th>Reserva</th>
                        <th>Valores da Reserva</th>
                        <th>Pagamentos (Locatário)</th>
                        <th>Repasse (Proprietário)</th>
                      </tr>
                    </thead>
                    <!--cabeçalho -->

                    <tbody>

                      <? foreach ($resultado as $linha) {

                            $current_url_edit = $_GET['p'] != '' ?
                              "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/edit/" . $linha['id'] . "?p=" . $_GET['p'] : "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/edit/" . $linha['id'];

                            // FOTO DE DESTAQUE
                            $fotoDest = $acoes->SelectSingle("SELECT foto FROM anuncios_fotos WHERE destaque = 1 AND item_id = " . $linha['anuncio']['id'] . " LIMIT 1")['foto'];
                            $fotoDest = $fotoDest != "" ?
                              "" . URL . "uploads/img/anuncios/" . $linha['anuncio']['id'] . "/anuncios_fotos/thumb-300-200/" . $fotoDest : "" . URL . "static/img/admin/sem-foto.jpg";

                            // VALORES
                            $url_valores = $_GET['p'] != '' ?
                              "" . URL . "admin/" . $pasta_modulo . "/anuncios_reservas_valores/" . TOKEN . "/view/0/" . $linha['id'] . "?p2=" . $_GET['p'] : "" . URL . "admin/" . $pasta_modulo . "/anuncios_reservas_valores/" . TOKEN . "/view/0/" . $linha['id'];

                            // Quantidade de pagamentos 
                            $totalPagamentosCadastrados = $acoes->SelectTotalSQL("SELECT * FROM anuncios_reservas_valores WHERE reserva_id=" . $linha['id'] . "");

                            // Valor Pago
                            $valorPago = $acoes->SelectSingle("SELECT SUM(valor) AS valor_pago FROM anuncios_reservas_valores WHERE reserva_id=" . $linha['id'] . " AND status = 1");

                            // Valor Pendente
                            $valorPendente = $acoes->SelectSingle("SELECT SUM(valor) AS valor_pendente FROM anuncios_reservas_valores WHERE reserva_id=" . $linha['id'] . " AND status = 0");

                            // REPASSE
                            $url_repasse = $_GET['p'] != '' ?
                              "" . URL . "admin/" . $pasta_modulo . "/anuncios_reservas_valores_repasse/" . TOKEN . "/view/0/" . $linha['id'] . "?p2=" . $_GET['p'] : "" . URL . "admin/" . $pasta_modulo . "/anuncios_reservas_valores_repasse/" . TOKEN . "/view/0/" . $linha['id'];

                            // Quantidade de pagamentos 
                            $totalPagamentosCadastradosRepasse = $acoes->SelectTotalSQL("SELECT * FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $linha['id'] . "");

                            // Valor Taxas
                            $valorTaxasRepasse = $acoes->SelectSingle("SELECT SUM(taxa_repasse) AS valor_taxas FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $linha['id'] . "");

                            // Valor Pago
                            $valorPagoRepasse = $acoes->SelectSingle("SELECT SUM(valor_repasse) AS valor_pago FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $linha['id'] . " AND status_repasse = 1");

                            // Valor Pendente
                            $valorPendenteRepasse = $acoes->SelectSingle("SELECT SUM(valor_repasse) AS valor_pendente FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $linha['id'] . " AND status_repasse = 0");


                            ?>

                        <tr>

                          <!--item -->
                          <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?= $linha['id'] ?>"><span></span></label></td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Anúncio" style="width: 200px;">
                            <img src="<?= $fotoDest ?>" style="margin-bottom: 15px;">
                            <p><b>Código <?= Tools::limitarTexto($linha['anuncio']['codigo'], 100); ?></b></p>
                            <p><b>Proprietário: </b><br><?= $linha['proprietario']; ?></p>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Reserva">
                            <p># <b><?= $linha['codigo'] ?></b></p>
                            <p><i class="fas fa-moon"></i> Noites: <?= $linha['diarias'] ?></p>
                            <p><i class="fas fa-calendar-alt"></i> Chegada: <?= Tools::formataData($linha['chegada']) ?></p>
                            <p><i class="fas fa-calendar-alt"></i> Saída: <?= Tools::formataData($linha['saida']) ?></p>
                            <p><i class="fas fa-users"></i> Hóspedes: <?= $linha['hospedes'] ?></p>
                            <p><b>Locatário: </b><br>
                              <?= $linha['locatario']; ?><br>
                              <? if ($linha['locatario_telefone'] != '') { ?>
                                <a target="_blank" href="https://web.whatsapp.com/send?phone=55<?= Tools::somenteNumeros($linha['locatario_telefone']) ?>&text=Olá <?= $linha['locatario']; ?>!"><i class="fab fa-whatsapp" style="color: #66C065"></i> <?= $linha['locatario_telefone']; ?></a><br>
                              <? } ?>
                              <? if ($linha['telefone_reserva'] != '') { ?>
                                <a target="_blank" href="https://web.whatsapp.com/send?phone=55<?= Tools::somenteNumeros($linha['telefone_reserva']) ?>&text=Olá <?= $linha['locatario']; ?>!"><i class="fab fa-whatsapp" style="color: #66C065"></i> <?= $linha['telefone_reserva']; ?></a><br>
                              <? } ?>
                              <?= $linha['locatario_email']; ?><br>
                              <? if ($linha['mensagem'] != '') { ?>
                                <a class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-mensagem-<?= $linha['id']; ?>" style="margin-top: 5px;">Ver mensagem</a>
                              <? } ?>
                            </p>
                            <? $status = array('Cancelada', 'Confirmada', 'Pendente', 'Em Atendimento'); ?>
                            <label class="status status<?= $linha['status']; ?>">
                              <i class="fas fa-circle"></i>
                              <span><?= $status[$linha['status']]; ?></span>
                            </label>
                            <? if ($linha['aceitacao_contrato'] == 1) { ?>
                              <br><label class="status status1">
                                <i class="fas fa-circle"></i>
                                <span>Aceitou os Termos</span>
                              </label>
                            <? } ?>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Valores">
                            <p><i class="fas fa-hand-holding-usd"></i> Taxas: R$ <?= Tools::formataMoeda($linha['taxas']); ?></p>
                            <p><i class="fas fa-tag"></i> Reserva: R$ <?= Tools::formataMoeda($linha['total_sem_taxas']); ?></p>
                            <p><i class="fas fa-money-bill"></i> Total: R$ <?= Tools::formataMoeda($linha['total']); ?></p>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Pagamentos">
                            <p><i class="fas fa-money-bill"></i> Pago: R$ <?= Tools::formataMoeda($valorPago['valor_pago']) ?></p>
                            <p><i class="fas fa-money-bill"></i> Pendente: R$ <?= Tools::formataMoeda($valorPendente['valor_pendente']) ?></p>
                            <a href="<?= $url_valores ?>" class="btn btn-sm btn-default btn-primary btn-xs"><i class="fas fa-money-bill"></i> Pagamentos
                              <? if ($totalPagamentosCadastrados > 0) { ?>
                                (<?= $totalPagamentosCadastrados ?>)
                              <? } ?>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Repasse">
                            <? if ($totalPagamentosCadastradosRepasse > 0) { ?>
                              <p><i class="fas fa-hand-holding-usd"></i> Taxas: R$ <?= Tools::formataMoeda($valorTaxasRepasse['valor_taxas']) ?></p>
                              <p><i class="fas fa-money-bill"></i> Total Pago: R$ <?= Tools::formataMoeda($valorPagoRepasse['valor_pago']) ?></p>
                              <p><i class="fas fa-money-bill"></i> Total Pendente: R$ <?= Tools::formataMoeda($valorPendenteRepasse['valor_pendente']) ?></p>
                            <? } ?>
                            <a href="<?= $url_repasse ?>" class="btn btn-sm btn-default btn-primary btn-xs"><i class="fas fa-money-bill"></i> Repasse
                              <? if ($totalPagamentosCadastradosRepasse > 0) { ?>
                                (<?= $totalPagamentosCadastradosRepasse ?>)
                              <? } ?>
                            </a>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td>
                            <? if ($linha['status'] != 1) { ?>
                              <a class="btn btn-xs btn-default" href="<?= $current_url_edit ?>"><i class="fas fa-edit"></i> Editar</a><br>
                            <? } ?>
                            <a href="#" class="btn btn-xs btn-danger btn-remove" data-iddel="<?= $linha['id']; ?>"><i class="fas fa-trash-alt"></i> Remover</a>
                            </a><br>
                            <a href="<?= URL ?>acoes/app/locatario/gera_contrato.php?reserva_id=<?= $linha['id'] ?>" class="btn btn-xs btn-info"><i class="fas fa-file-alt"></i> Contrato</a>
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

              <? foreach ($resultado as $key => $linha) { ?>

                <!-- Modal lista -->
                <div class="modal fade" id="modal-mensagem-<?= $linha['id']; ?>" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content" id="print-content-<?= $linha['id']; ?>">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                        </button>
                        <h4 class="modal-title" style="display: inline-block;">Mensagem - <?= $linha['locatario']; ?></b></h4>
                      </div>
                      <div class="modal-body" id="modal-pedido-<?= $linha['id']; ?>" style="float: left; width: 100%;">
                        <?= $linha['mensagem']; ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Fechar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Fim Modal lista -->

              <? } ?>

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
