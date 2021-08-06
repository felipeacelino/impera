<? include(ACOES_APP_PATH."/afiliado/restrito.php"); ?>
<? include(ACOES_APP_PATH."/afiliado/pagamentos.php"); ?>
<?php
$titulo_pagina = "Minhas Comissões - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="pagamentos">

  <!-- HEADER -->
  <? include(APP_PATH.'/afiliado/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/afiliado/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Minhas Comissões</h1>
      </div>

      <div class="row conta-bl-valores">

        <div class="grid-4 grid-m-6 grid-s-12 conta-blv success">
          <div class="conta-blv-title">Total pagas</div>
          <div class="conta-blv-price">R$ 20.000,00</div>
        </div>

        <div class="grid-4 grid-m-6 grid-s-12 conta-blv warning">
          <div class="conta-blv-title">Total pendentes</div>
          <div class="conta-blv-price">R$ 10.000,00</div>
        </div>

        <div class="grid-4 grid-m-6 grid-s-12 conta-blv">
          <div class="conta-blv-title">Total geral</div>
          <div class="conta-blv-price">R$ 30.000,00</div>
        </div>

      </div>

      <div class="conta-bloco">
        <div class="conta-bloco-content">
          <!-- Tabela -->
          <table class="conta-tabela">
            <thead>
              <tr>
                <th width="150px">Imóvel</th>
                <th>Cliente</th>
                <th width="150px">VGV <span class="campo-icon-help" data-tippy-content="Valor geral de venda"><i class="las la-exclamation-circle"></i></span></th>
                <th width="150px">Comissão (%)</th>
                <th width="150px">Valor</th>
                <th width="150px">Data</th>
                <th width="200px">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><b>IR0000123</b></td>
                <td>João da Silva</td>
                <td>R$ <?=Tools::formataMoeda("100000.00")?></td>
                <td>10%</td>
                <td>R$ <?=Tools::formataMoeda("10000.00")?></td>
                <td><?=Tools::formataData("2021-05-01")?></td>
                <td>
                  <span class="conta-status warning">Pendente</span>
                </td>
              </tr>
              <tr>
                <td><b>IR0000123</b></td>
                <td>Camila Ferreira</td>
                <td>R$ <?=Tools::formataMoeda("80000.00")?></td>
                <td>8%</td>
                <td>R$ <?=Tools::formataMoeda("8000.00")?></td>
                <td><?=Tools::formataData("2021-05-01")?></td>
                <td>
                  <span class="conta-status success">Paga</span>
                </td>
              </tr>
              <tr>
                <td><b>IR0000123</b></td>
                <td>Bruno Oliveira</td>
                <td>R$ <?=Tools::formataMoeda("100000.00")?></td>
                <td>10%</td>
                <td>R$ <?=Tools::formataMoeda("12000.00")?></td>
                <td><?=Tools::formataData("2021-05-01")?></td>
                <td>
                  <span class="conta-status success">Paga</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- sem registros -->
      <!-- <div class="conta-bloco">
        <div class="conta-bloco-content">
          <div class="conta-empty texto">
            <p>Você ainda não possui comissões para visualizar.</p>
          </div>
        </div>
      </div> -->
      <!-- sem registros --> 

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/afiliado/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
