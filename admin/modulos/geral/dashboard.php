<? include("" . ACOES_ADMIN_PATH . "/geral/dashboard.php"); ?>

<!-- estrutura -->
<div class="right_col" role="main">
  <div class="">

    <div class="dashboard-content">

      <!-- IMOVEIS E VALORES -->
      <div class="agenda-resumos">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="agenda-resumo">
              <span>Imóveis</span>
              <strong><?= $totalAnuncios ?></strong>
              <small>Imóveis cadastrados</small>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="agenda-resumo terciaria">
              <span>Total</span>
              <strong><sup>R$</sup> <?= $somaTotal ?></strong>
              <small><b><?= $totalPedidos ?></b> reservas(s)</small>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="agenda-resumo aprovado">
              <span>Total recebido</span>
              <strong><sup>R$</sup> <?= $totalValorConfirmados ?></strong>
              <small>&nbsp</small>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="agenda-resumo pendente">
              <span>Total a receber</span>
              <strong><sup>R$</sup> <?= $totalValorPendentes ?></strong>
              <small>&nbsp</small>
            </div>
          </div>
        </div>
      </div>
      <!-- IMOVEIS E VALORES -->

      <!-- RESERVAS E ULTIMAS RESERVAS -->
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">

            <!-- RESERVAS -->
            <div class="col-md-8 col-sm-8 col-xs-12 grafico-vendas-container">
              <div class="x_title">
                <h2>Solicitações de reservas em <b><?= date("Y") ?></b></h2>
                <div class="clearfix"></div>
              </div>
              <? if ($totalUltimasReservas > 0) { ?>
                <div>
                  <canvas id="cadastros_chart"></canvas>
                </div>
              <? } else { ?>
                <div class="pedido-linha">
                  <b>Nenhuma solicitação reserva.</b>
                </div>
              <? } ?>
              <script src="<?= URL; ?>admin/vendors/Chart.js/dist/Chart.min.js"></script>
              <script type="text/javascript">
                var ctx = document.getElementById("cadastros_chart");
                var chart = new Chart(ctx, {
                  type: 'line',
                  data: {
                    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    datasets: [{
                      label: 'Reservas',
                      data: [<?= $qtde_meses ?>],
                      backgroundColor: 'rgb(168, 110, 40, .5)',
                      borderColor: 'rgb(168, 110, 40)',
                      borderWidth: 3,
                      fill: true,
                      lineTension: 0.3,
                      pointBorderColor: 'rgb(168, 110, 40)',
                      pointHoverBackgroundColor: 'rgb(168, 110, 40)',
                      pointHoverBorderColor: 'rgb(168, 110, 40)',
                      pointHoverBackgroundColor: 'rgb(168, 110, 40)'
                    }]
                  },
                  options: {
                    responsive: true,
                    legend: {
                      display: false,
                    },
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true,
                        }
                      }],
                      xAxes: [{
                        ticks: {
                          fontSize: 11
                        }
                      }]
                    }
                  }
                });
              </script>
            </div>
            <!-- //RESERVAS -->

            <!-- ÚLTIMAS RESERVAS -->
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div>
                <div class="x_title">
                  <h2>Últimas <b>solicitações reservas</b></h2>
                  <div class="clearfix"></div>
                </div>
                <ul class="list-unstyled top_profiles scroll-view" style="height: auto; margin-bottom: 20px; text-align:left">
                  <? foreach ($ultimasReservas as $ultimaReserva) { ?>
                    <li class="media event">
                      <div class="pedido-linha">
                        <?= Tools::formataDataTime($ultimaReserva['data_cad']) ?><br>
                        <b><?= $ultimaReserva['locatario'] ?></b><br>
                        <b><?= $ultimaReserva['anuncio']['titulo'] ?></b><br>
                        <b><i class="fas fa-money-bill"></i> <?= Tools::formataMoeda($ultimaReserva['total']); ?></b><br>
                        <?
                          $status = array('Cancelado', 'Aprovado', 'Pendente');
                          ?>
                        <label class="status status<?= $ultimaReserva['status']; ?>">
                          <i class="fas fa-circle"></i>
                          <span><?= $status[$ultimaReserva['status']]; ?></span>
                        </label>
                      </div>
                    </li>
                  <? } ?>
                  <li class="media event" style="text-align: center;">
                    <div class="pedido-linha">
                      <a href="<?= URL_ADMIN; ?>anuncios/anuncios_reservas/<?= TOKEN; ?>/view"><b>Ver todas →</b></a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- //ÚLTIMAS RESERVAS -->

          </div>
        </div>
      </div>
      <!-- RESERVAS E ULTIMAS RESERVAS -->

    </div>

  </div>
</div>
<!-- fim estrutura -->
