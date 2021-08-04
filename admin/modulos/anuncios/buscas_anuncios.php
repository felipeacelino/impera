<? include("" . ACOES_ADMIN_PATH . "/" . $pasta_modulo . "/" . $pag_include . ".php"); ?>
<? include("" . ACOES_APP_PATH . "/gerais/filtros.php"); ?>

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
                    <? if ($quantidadeFiltros > 0) { ?>
                      <a href="<?= URL ?>acoes/admin/geral/limpar_filtros.php?pagina=<?= $pag_include ?>&retorno=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-success btn-header">
                        <i class="fas fa-eye"></i>
                        <span>Anúncios Selecionados</span>
                      </a>
                    <? } else { ?>
                      <h5>Para buscar novos anúncios basta filtrar.</h5>
                    <? } ?>
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
                        <label for="filtro_codigo" class="control-label">Código:</label>
                        <input type="text" name="filtro_codigo" id="filtro_codigo" class="form-control" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_codigo'] ?>">
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_titulo" class="control-label">Anúncio:</label>
                        <input type="text" name="filtro_titulo" id="filtro_titulo" class="form-control" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_titulo'] ?>">
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_cidade" class="control-label">Cidade:</label>
                        <select name="filtro_cidade" id="filtro_cidade" class="form-control">
                          <option value="">Todas</option>
                          <? foreach ($cidades as $cidade) { ?>
                            <option value="<?= $cidade['cidade'] ?>" data-estado="<?= $cidade['estado'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_cidade'], $cidade['cidade']) ?>><?= $cidade['cidade'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_destino" class="control-label">Destino:</label>
                        <select name="filtro_destino" id="filtro_destino" class="form-control" data-sync-url="<?= "" . URL . "acoes/admin/" . $pasta_modulo . "/retorna_destinos.php" ?>" data-sync-input="#filtro_cidade" data-sync-param="cidade" data-sync-value="<?= $_SESSION[$pag_include]['filtros']['filtro_destino'] ?>" data-sync-option-value="id" data-sync-option-text="destino" data-sync-placeholder="Selecione">
                          <option value="">Todos</option>
                          <? foreach ($destinos as $destino) { ?>
                            <option class="opt-cidade" value="<?= $destino['cidade'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_destino'], $destino['cidade']) ?>><?= $destino['cidade'] ?></option>
                            <? if ($destino['destinos_opc_qtd'] > 0) { ?>
                              <? foreach ($destino['destinos_opc'] as $destino_opc) { ?>
                                <option class="opt-destino" value="<?= $destino_opc['id'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_destino'], $destino_opc['id']) ?>><?= $destino_opc['destino'] ?></option>
                              <? } ?>
                            <? } ?>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_condominio" class="control-label">Condomínio:</label>
                        <select name="filtro_condominio" id="filtro_condominio" class="form-control" data-sync-url="<?= "" . URL . "acoes/admin/" . $pasta_modulo . "/retorna_condominios.php" ?>" data-sync-input="#filtro_cidade" data-sync-param="cidade" data-sync-value="<?= $_SESSION[$pag_include]['filtros']['filtro_condominio'] ?>" data-sync-option-value="id" data-sync-option-text="condominio" data-sync-placeholder="Selecione">
                          <option value="">Todos</option>
                          <? foreach ($condominios as $key => $filtro_row) { ?>
                            <option value="<?= $filtro_row['id'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_condominio'], $filtro_row['id']) ?>><?= $filtro_row['condominio'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_tipoanuncio" class="control-label">Venda / Temporada:</label>
                        <select name="filtro_tipoanuncio" id="filtro_tipoanuncio" class="form-control">
                          <option value="">Todos</option>
                          <option value="temporada" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'], "temporada") ?>>Temporada</option>
                          <option value="venda" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'], "venda") ?>>Venda</option>
                          <option value="venda_e_temporada" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'], "venda_e_temporada") ?>>Venda e Temporada</option>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_faixa" class="control-label">Faixa de Preço:</label>
                        <select name="filtro_faixa" id="filtro_faixa" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($faixa_de_preco as $key => $filtro_row) { ?>
                            <option value="<?= $key ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_faixa'], $key) ?>><?= $filtro_row ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_tipo" class="control-label">Tipo de Imóvel:</label>
                        <select name="filtro_tipo" id="filtro_tipo" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($tipo_de_imovel as $key => $filtro_row) { ?>
                            <option value="<?= $key ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipo'], $key) ?>><?= $filtro_row ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_quarto" class="control-label">Quartos:</label>
                        <select name="filtro_quarto" id="filtro_quarto" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($quartos as $key => $filtro_row) { ?>
                            <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_quarto'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_suite" class="control-label">Suítes:</label>
                        <select name="filtro_suite" id="filtro_suite" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($suites as $key => $filtro_row) { ?>
                            <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_suite'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_banheiro" class="control-label">Banheiros:</label>
                        <select name="filtro_banheiro" id="filtro_banheiro" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($banheiros as $key => $filtro_row) { ?>
                            <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_banheiro'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_vaga" class="control-label">Vagas:</label>
                        <select name="filtro_vaga" id="filtro_vaga" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($vagas as $key => $filtro_row) { ?>
                            <option value="<?= $filtro_row['chave'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_vaga'], $filtro_row['chave']) ?>><?= $filtro_row['valor'] ?></option>
                          <? } ?>
                        </select>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_hospede" class="control-label">Hóspedes:</label>
                        <select name="filtro_hospede" id="filtro_hospede" class="form-control">
                          <option value="">Todos</option>
                          <? foreach ($hospedes as $key => $hospede) { ?>
                            <option value="<?= $hospede['chave'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_hospede'], $hospede['chave']) ?>><?= $hospede['valor'] ?></option>
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

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group" style="width: 100%">
                        <label for="filtro_status" class="control-label">Características:</label><br>
                        <? foreach ($caracteristicas as $key => $filtro_row) { ?>
                          <div class="checkbox" style="display: inline-block; margin-right: 12px">
                            <label>
                              <input type="checkbox" name="caracteristicas[]" value="<?= $filtro_row['id'] ?>" <? if (in_array($filtro_row['id'], $_SESSION[$pag_include]['filtros']['filtro_caracteristicas'])) { ?> checked <? } ?>>
                              <span><?= $filtro_row['caracteristica'] ?></span>
                            </label>
                          </div>
                        <? } ?>
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro ->
                    <div class="campo-filtro form-group">
                      <label for="filtro_data" class="control-label">Data de cadastro:</label>
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

                </div>
                <!-- FIM ESQUERDA -->

                <!-- DIREITA -->
                <div class="header_row_right">

                </div>
                <!-- FIM DIREITA -->

              </div>
              <!-- FIM LINHA HEADER -->

              <form name="excluir" id="form_acao" method="post">

                <!-- ANÚNCIOS SELECIONADOS -->
                <? if ($quantidadeFiltros == 0) { ?>

                  <? if ($total_anuncios_selecionados > 0) { ?>

                    <h4 style="text-align: center;">Anúncios Selecionados (<span class="total-anuncios-selecionados"><?= $total_anuncios_selecionados ?></span>)</h4>

                    <table class="table table_responsive">

                      <!--cabeçalho -->
                      <thead>
                        <tr>
                          <th>Imagem</th>
                          <th>Anúncio</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <!--cabeçalho -->

                      <tbody>

                        <? foreach ($anuncios_selecionados as $linha) {
                                // FOTO DE DESTAQUE
                                $fotoDest = $acoes->SelectSingle("SELECT foto FROM anuncios_fotos WHERE destaque = 1 AND item_id = " . $linha['id'] . " LIMIT 1")['foto'];
                                $fotoDest = $fotoDest != "" ?
                                  "" . URL . "uploads/img/anuncios/" . $linha['id'] . "/anuncios_fotos/thumb-300-200/" . $fotoDest : "" . URL . "static/img/admin/sem-foto.jpg";
                                ?>

                          <tr data-registro="<?= $linha['id'] ?>" class="lista-anunio">

                            <!--item -->
                            <td class="tr-lg">
                              <img src="<?= $fotoDest ?>">
                            </td>
                            <!--item -->

                            <!--item -->
                            <td data-label="Anúncio">
                              <p><b><?= Tools::limitarTexto($linha['titulo'], 100); ?></b></p>
                              <? if ($linha['tipo_anuncio'] == 'temporada') { ?>
                                <p><b style="color: #64BD63">Temporada</b></p>
                              <? } else if ($linha['tipo_anuncio'] == 'venda') { ?>
                                <p><b style="color: #42A5F5">Venda</b></p>
                              <? } else { ?>
                                <p><b style="color: #FFA000">Venda e Temporada</b></p>
                              <? } ?>
                              <? if ($linha['tipo_anuncio'] == 'temporada') { ?>
                                <? if ($linha['valor_diferenciado'] != 0.00) { ?>
                                  <p><b>Diária (Diferenciada): </b>R$ <?= Tools::formataMoeda($linha['valor_diferenciado']); ?></p>
                                <? } ?>
                                <p><b>Diária: </b>R$ <?= Tools::formataMoeda($linha['valor']); ?></p>
                              <? } else if ($linha['tipo_anuncio'] == 'venda') { ?>
                                <p><b>Valor para Venda: </b>R$ <?= Tools::formataMoeda($linha['valor_venda']); ?></p>
                              <? } else { ?>
                                <? if ($linha['valor_diferenciado'] != 0.00) { ?>
                                  <p><b>Diária (Diferenciada): </b>R$ <?= Tools::formataMoeda($linha['valor_diferenciado']); ?></p>
                                <? } ?>
                                <p><b>Diária: </b>R$ <?= Tools::formataMoeda($linha['valor']); ?></p>
                                <p><b>Valor para Venda: </b>R$ <?= Tools::formataMoeda($linha['valor_venda']); ?></p>
                              <? } ?>
                              <p><b>Código: </b><?= $linha['codigo']; ?></p>
                              <p><b>Cidade: </b><?= $linha['cidade']; ?></p>
                              <p><b>Proprietário: </b><?= $linha['proprietario']; ?></p>
                              <? if ($linha['aceitacao_contrato'] == 1) { ?>
                                <label class="status status1">
                                  <i class="fas fa-circle"></i>
                                  <span>Aceitou os Termos</span>
                                </label>
                              <? } ?>
                            </td>
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
                              <button class="btn btn-xs btn-success lista-add" data-registro="<?= $linha['id'] ?>" data-busca="<?= $id_enviado2 ?>" data-url="<?= URL ?>acoes/admin/anuncios/busca_adiciona.php" style="display: none;"><i class="fas fa-plus"></i> Adicionar</button>
                              <button class="btn btn-xs btn-danger lista-rem hide-line" data-registro="<?= $linha['id'] ?>" data-busca="<?= $id_enviado2 ?>" data-url="<?= URL ?>acoes/admin/anuncios/busca_remove.php"><i class="fas fa-trash"></i> Remover</button>
                            </td>
                            <!--item -->

                          </tr>

                        <? } ?>

                      </tbody>

                    </table>

                  <? } else { ?>

                    <span class="sem-registro-txt">
                      <i class="fas fa-exclamation-circle"></i>
                      Faça uma busca para selecionar anúncios
                    </span>

                  <? } ?>

                <? } ?>
                <!-- ANÚNCIOS SELECIONADOS -->

                <!-- TODOS ANÚNCIOS -->
                <? if ($quantidadeFiltros > 0) { ?>

                  <? if ($total_anuncios > 0) { ?>

                    <h4 style="text-align: center;">Anúncios para Seleção (<?= $total_anuncios ?>)</h4>

                    <table class="table table_responsive">

                      <!--cabeçalho -->
                      <thead>
                        <tr>
                          <th>Imagem</th>
                          <th>Anúncio</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <!--cabeçalho -->

                      <tbody>

                        <? foreach ($anuncios as $linha) {
                                // FOTO DE DESTAQUE
                                $fotoDest = $acoes->SelectSingle("SELECT foto FROM anuncios_fotos WHERE destaque = 1 AND item_id = " . $linha['id'] . " LIMIT 1")['foto'];
                                $fotoDest = $fotoDest != "" ?
                                  "" . URL . "uploads/img/anuncios/" . $linha['id'] . "/anuncios_fotos/thumb-300-200/" . $fotoDest : "" . URL . "static/img/admin/sem-foto.jpg";
                                // VERIFICA SELEÇÃO
                                $verificaSelecao = $acoes->SelectTotalSQL("SELECT id FROM buscas_anuncios WHERE anuncio_id = " . $linha['id'] . " AND busca_id = " . $id_enviado2 . "");
                                ?>

                          <tr data-registro="<?= $linha['id'] ?>" class="lista-anunio">

                            <!--item -->
                            <td class="tr-lg">
                              <img src="<?= $fotoDest ?>">
                            </td>
                            <!--item -->

                            <!--item -->
                            <td data-label="Anúncio">
                              <p><b><?= Tools::limitarTexto($linha['titulo'], 100); ?></b></p>
                              <? if ($linha['tipo_anuncio'] == 'temporada') { ?>
                                <p><b style="color: #64BD63">Temporada</b></p>
                              <? } else if ($linha['tipo_anuncio'] == 'venda') { ?>
                                <p><b style="color: #42A5F5">Venda</b></p>
                              <? } else { ?>
                                <p><b style="color: #FFA000">Venda e Temporada</b></p>
                              <? } ?>
                              <? if ($linha['tipo_anuncio'] == 'temporada') { ?>
                                <? if ($linha['valor_diferenciado'] != '') { ?>
                                  <p><b>Diária (Diferenciada): </b>R$ <?= Tools::formataMoeda($linha['valor_diferenciado']); ?></p>
                                <? } ?>
                                <p><b>Diária: </b>R$ <?= Tools::formataMoeda($linha['valor']); ?></p>
                              <? } else if ($linha['tipo_anuncio'] == 'venda') { ?>
                                <p><b>Valor para Venda: </b>R$ <?= Tools::formataMoeda($linha['valor_venda']); ?></p>
                              <? } else { ?>
                                <? if ($linha['valor_diferenciado'] != '') { ?>
                                  <p><b>Diária (Diferenciada): </b>R$ <?= Tools::formataMoeda($linha['valor_diferenciado']); ?></p>
                                <? } ?>
                                <p><b>Diária: </b>R$ <?= Tools::formataMoeda($linha['valor']); ?></p>
                                <p><b>Valor para Venda: </b>R$ <?= Tools::formataMoeda($linha['valor_venda']); ?></p>
                              <? } ?>
                              <p><b>Código: </b><?= $linha['codigo']; ?></p>
                              <p><b>Cidade: </b><?= $linha['cidade']; ?></p>
                              <p><b>Proprietário: </b><?= $linha['proprietario']; ?></p>
                              <? if ($linha['aceitacao_contrato'] == 1) { ?>
                                <label class="status status1">
                                  <i class="fas fa-circle"></i>
                                  <span>Aceitou os Termos</span>
                                </label>
                              <? } ?>
                            </td>
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
                              <button class="btn btn-xs btn-success lista-add" data-registro="<?= $linha['id'] ?>" data-busca="<?= $id_enviado2 ?>" data-url="<?= URL ?>acoes/admin/anuncios/busca_adiciona.php" <? if ($verificaSelecao != 0) { ?> style="display: none;" <? } ?>><i class="fas fa-plus"></i> Adicionar</button>
                              <button class="btn btn-xs btn-danger lista-rem" data-registro="<?= $linha['id'] ?>" data-busca="<?= $id_enviado2 ?>" data-url="<?= URL ?>acoes/admin/anuncios/busca_remove.php" <? if ($verificaSelecao == 0) { ?> style="display: none;" <? } ?>><i class="fas fa-trash"></i> Remover</button>
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

                <? } ?>
                <!-- TODOS ANÚNCIOS -->

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
