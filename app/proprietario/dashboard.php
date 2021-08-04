<? include(ACOES_APP_PATH . "/proprietario/restrito.php"); ?>
<? include(ACOES_APP_PATH . "/proprietario/reservas.php"); ?>
<?php
$titulo_pagina = "Reservas - " . TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH . '/estrutura/head.php'); ?>

<body class="pg-conta">

  <!-- HEADER -->
  <? include(APP_PATH . '/proprietario/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH . '/proprietario/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Reservas</h1>
      </div>

      <!-- Filtros -->
      <div class="conta-bloco conta-filtros">
        <div class="conta-bloco-content">
          <form action="<?= URL ?>proprietario/inicio" method="get">
            <div class="campo-container">
              <select name="imovel" class="campo">
                <option value="">Todos imóveis</option>
                <? foreach ($imoveis as $imovel) { ?>
                  <option value="<?= $imovel['id'] ?>" <?= Tools::selected($imovel['id'], $_GET['imovel']) ?>><?= $imovel['titulo'] ?> - (<?= $imovel['codigo'] ?>)</option>
                <? } ?>
              </select>
              <i class="arrow"></i>
            </div>
            <?
            $dataInicial = Tools::formataData(Tools::subData(Tools::getDate(), 29));
            $dataFinal = Tools::formataData(Tools::getDate());
            $filtroData = $_GET['data'] != "" ? $_GET['data'] : $dataInicial . " a " . $dataFinal;
            ?>
            <div class="campo-container">
              <input type="text" name="data" class="campo datepicker_prerange" placeholder="Data" value="<?= $filtroData ?>" readonly>
            </div>
            <div class="btn-container">
              <button type="submit" class="btn btn-sm btn-primario">Filtrar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- //Filtros -->

      <!-- Resumo -->
      <div class="row agenda-resumos">
        <div class="grid-3 grid-m-6 grid-s-6 agenda-resumo">
          <span>Imóveis</span>
          <strong><?= $numImoveis ?></strong>
          <small>cadastrado(s)</small>
        </div>
        <div class="grid-3 grid-m-6 grid-s-6 agenda-resumo terciaria">
          <span>Total</span>
          <strong><sup>R$</sup> <?= Tools::formataMoeda($totalReservas) ?></strong>
          <small><b><?= $numReservas ?></b> reservas(s)</small>
        </div>
        <div class="grid-3 grid-m-6 grid-s-6 agenda-resumo pendente">
          <span>Total a receber</span>
          <strong><sup>R$</sup> <?= Tools::formataMoeda($totalReceber) ?></strong>
          <small>&nbsp</small>
        </div>
        <div class="grid-3 grid-m-6 grid-s-6 agenda-resumo aprovado">
          <span>Total recebido</span>
          <strong><sup>R$</sup> <?= Tools::formataMoeda($totalRecebido) ?></strong>
          <small>&nbsp</small>
        </div>
      </div>
      <!-- //Resumo -->

      <? if ($numReservas > 0) { ?>

        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th width="100px">Imóvel</th>
                  <th></th>
                  <th width="200px">Reserva</th>
                  <th width="200px">Repasse</th>
                  <!-- <th width="150px"></th> -->
                </tr>
              </thead>
              <tbody>

                <? foreach ($reservas as $reserva) {
                    // QUANTIDADES PAGAMENTOS DO LOCATARIO
                    $qtdPagamentosLocatario = $acoes->SelectTotalSQL("SELECT * FROM anuncios_reservas_valores WHERE reserva_id =  " . $reserva['id'] . " ORDER BY data ASC");
                    // QUANTIDADE DE PAGAMENTOS REPASSE
                    $qtdPagamentosCadastradosRepasse = $acoes->SelectTotalSQL("SELECT * FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $reserva['id'] . "");

                    // Valor Taxas
                    $valorTaxasRepasse = $acoes->SelectSingle("SELECT SUM(taxa_repasse) AS valor_taxas FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $reserva['id'] . "");

                    // Valor Pago
                    $valorPagoRepasse = $acoes->SelectSingle("SELECT SUM(valor_repasse) AS valor_pago FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $reserva['id'] . " AND status_repasse = 1");

                    // Valor Pendente
                    $valorPendenteRepasse = $acoes->SelectSingle("SELECT SUM(valor_repasse) AS valor_pendente FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $reserva['id'] . " AND status_repasse = 0");
                    ?>

                  <!-- Repete -->
                  <tr>
                    <td>
                      <a href="<?= URL ?>imovel/<?= $reserva['anuncio']['url_amigavel'] ?>-im<?= $reserva['anuncio']['id'] ?>" target="_blank" class="conta-tabela-img">
                        <img src="<?= $reserva['foto_anuncio'] ?> ">
                      </a>
                    </td>
                    <td>
                      <p><small><b><?= $reserva['anuncio']['titulo'] ?></b></small></p>
                      <p><small><?= $reserva['anuncio']['local'] ?> <? if ($reserva['anuncio']['estado_nome'] != '') {
                                                                          echo ' - ';
                                                                          echo $reserva['anuncio']['estado_nome'];
                                                                        } ?></small></p>
                    </td>
                    <td>
                      <p><small><b>Chegada:</b> <?= Tools::formataData($reserva['chegada']) ?></small></p>
                      <p><small><b>Saída:</b> <?= Tools::formataData($reserva['saida']) ?></small></p>
                      <p><small><b>Hóspedes:</b> <?= $reserva['hospedes'] ?></small></p>
                      <? if ($qtdPagamentosLocatario > 0) { ?>
                        <p style="margin-top: 5px;">
                          <div class="conta-tabela-opcoes">
                            <button class="btn btn-xs modal-open" data-modal="modal-reserva-<?= $reserva['id'] ?>"><i class="fas fa-plus"></i>Pagamentos</a>
                          </div>
                        </p>
                      <? } ?>
                    </td>
                    <td>
                      <p><small><b>Total:</b> R$ <?= Tools::formataMoeda($reserva['total']); ?></small></p>
                      <? if ($qtdPagamentosCadastradosRepasse > 0) { ?>
                        <p><small><b>Taxa:</b> <span class="text-error">R$ <?= Tools::formataMoeda($valorTaxasRepasse['valor_taxas']) ?></span></small></p>
                        <p><small><b>Pendente:</b> <span class="text-warning">R$ <?= Tools::formataMoeda($valorPendenteRepasse['valor_pendente']) ?></span></small></p>
                        <p><small><b>Pago:</b> <span class="text-success">R$ <?= Tools::formataMoeda($valorPagoRepasse['valor_pago']) ?></span></small></p>
                        <p style="margin-top: 5px;">
                          <div class="conta-tabela-opcoes">
                            <button class="btn btn-xs modal-open" data-modal="modal-reserva-repasse-<?= $reserva['id'] ?>"><i class="fas fa-plus"></i>Repasses</a>
                          </div>
                        </p>
                      <? } ?>
                    </td>
                  </tr>
                  <!-- //Repete -->

                <? } ?>

              </tbody>
            </table>
            <!-- //Tabela -->

            <!-- PAGAMENTOS DO LOCATARIO -->
            <? foreach ($reservas as $reserva) {
                // PAGAMENTOS DO LOCATARIO
                $pagamentosLocatario = $acoes->SelectSQL("SELECT * FROM anuncios_reservas_valores WHERE reserva_id =  " . $reserva['id'] . " ORDER BY data ASC");
                ?>
              <!-- PAGAMENTOS -->
              <div class="modal" id="modal-reserva-<?= $reserva['id'] ?>">
                <div class="modal-wrap">
                  <span class="modal-btn-close modal-close" data-modal="modal-reserva-<?= $reserva['id'] ?>"></span>
                  <div class="modal-header">
                    <span class="modal-titulo">Pagamentos do Locatário</span>
                  </div>
                  <div class="modal-body">
                    <!-- Tabela -->
                    <table class="conta-tabela">
                      <thead>
                        <tr>
                          <th>Valor</th>
                          <th>Data</th>
                          <th>Status (Pagamento)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <? foreach ($pagamentosLocatario as $pagamento) { ?>
                          <!-- Repete -->
                          <tr>
                            <td>
                              <p><small>R$ <?= Tools::formataMoeda($pagamento['valor']); ?></small></p>
                            </td>
                            <td>
                              <p><small><?= Tools::formataData($pagamento['data']); ?></small></p>
                            </td>
                            <td>
                              <? if ($pagamento['status'] == 1) { ?>
                                <span class="conta-status aprovado">Pago</span>
                              <? } ?>
                              <? if ($pagamento['status'] == 0) { ?>
                                <span class="conta-status pendente">Pendente</span>
                              <? } ?>
                            </td>
                          </tr>
                          <!-- //Repete -->
                        <? } ?>
                      </tbody>
                    </table>
                    <!-- //Tabela -->
                    <div class="modal-btn center">
                      <button type="button" class="btn btn-sm modal-close" data-modal="modal-reserva-<?= $reserva['id'] ?>">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- //PAGAMENTOS -->
            <? } ?>
            <!--// PAGAMENTOS DO LOCATARIO -->


            <!-- REPASSE AO PROPRIETARIO -->
            <? foreach ($reservas as $reserva) {
                // REPASSE
                $repasseProprietario = $acoes->SelectSQL("SELECT * FROM anuncios_reservas_valores_repasse WHERE reserva_id =  " . $reserva['id'] . " ORDER BY data_repasse ASC");
                ?>
              <!-- PAGAMENTOS -->
              <div class="modal" id="modal-reserva-repasse-<?= $reserva['id'] ?>">
                <div class="modal-wrap">
                  <span class="modal-btn-close modal-close" data-modal="modal-reserva-<?= $reserva['id'] ?>"></span>
                  <div class="modal-header">
                    <span class="modal-titulo">Repasses</span>
                  </div>
                  <div class="modal-body">
                    <!-- Tabela -->
                    <table class="conta-tabela">
                      <thead>
                        <tr>
                          <th>Valor</th>
                          <th>Taxa</th>
                          <th>Data</th>
                          <th>Status (Pagamento)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <? foreach ($repasseProprietario as $pagamento) { ?>
                          <!-- Repete -->
                          <tr>
                            <td>
                              <p><small>R$ <?= Tools::formataMoeda($pagamento['valor_repasse']); ?></small></p>
                            </td>
                            <td>
                              <p><small>R$ <?= Tools::formataMoeda($pagamento['taxa_repasse']); ?></small></p>
                            </td>
                            <td>
                              <p><small><?= Tools::formataData($pagamento['data_repasse']); ?></small></p>
                            </td>
                            <td>
                              <? if ($pagamento['status_repasse'] == 1) { ?>
                                <span class="conta-status aprovado">Pago</span>
                              <? } ?>
                              <? if ($pagamento['status_repasse'] == 0) { ?>
                                <span class="conta-status pendente">Pendente</span>
                              <? } ?>
                            </td>
                          </tr>
                          <!-- //Repete -->
                        <? } ?>
                      </tbody>
                    </table>
                    <!-- //Tabela -->
                    <div class="modal-btn center">
                      <button type="button" class="btn btn-sm modal-close" data-modal="modal-reserva-<?= $reserva['id'] ?>">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- //PAGAMENTOS -->
            <? } ?>
            <!-- REPASSE AO PROPRIETARIO -->

          </div>
        </div>

      <? } else { ?>

        <!-- sem registros -->
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <div class="conta-empty texto">
              <p>Nenhuma reserva encontrada.</p>
            </div>
          </div>
        </div>
        <!-- sem registros -->

      <? } ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->

    <? include(APP_PATH . '/proprietario/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
