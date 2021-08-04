<? include(ACOES_APP_PATH."/cliente/restrito.php"); ?>
<? include(ACOES_APP_PATH."/cliente/pagamentos.php"); ?>
<?php
$titulo_pagina = "Meus Boletos - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="boletos">

  <!-- HEADER -->
  <? include(APP_PATH.'/cliente/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/cliente/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Meus Boletos</h1>
      </div>

      <? if ($numPagamentos > 0) { ?>

        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <ul class="row payments-an">
              <? foreach ($pagamentosLista as $pagamento) { ?>
                <li class="grid-4 grid-m-6 grid-s-12 payment-an">
                  <div class="payment-an-tit"><?=Tools::retornaMes($pagamento['data'])?> <?=explode("-", $pagamento['data'])[0]?></div>
                  <div class="payment-an-status">
                    <span class="conta-status <?=$statusPagamentos[$pagamento['status']]['class']?>"><?=$statusPagamentos[$pagamento['status']]['titulo']?></span>
                    <? if ($pagamento['status'] == "1" && $pagamento['data_pgto'] != "") { ?>
                      <small>Pago em <b><?=Tools::formataData($pagamento['data_pgto'])?></b></small>
                    <? } ?>
                  </div>
                  <ul class="payment-an-itens">
                    <li><span>Imóvel</span><span>IR000012</span></li>
                    <li><span>Vencimento</span><span><?=Tools::formataData($pagamento['data'])?></span></li>
                    <li class="dest"><span>Valor</span><span>R$ <?=Tools::formataMoeda($pagamento['total'])?></span></li>
                  </ul>
                  <div class="payment-an-btn">
                    <a href="https://google.com.br" class="btn btn-sm btn-primario" target="_blank">Visualizar boleto</a>
                  </div>
                </li>
              <? } ?>
            </ul>
          </div>
        </div>

      <? } else { ?>

        <!-- sem registros -->
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <div class="conta-empty texto">
              <p>Você não possui boletos para visualizar.</p>
            </div>
          </div>
        </div>
        <!-- sem registros --> 
        
      <? } ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/cliente/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
