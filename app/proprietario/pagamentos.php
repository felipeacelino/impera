<? include(ACOES_APP_PATH."/proprietario/restrito.php"); ?>
<? include(ACOES_APP_PATH."/proprietario/pagamentos.php"); ?>
<?php
$titulo_pagina = "Pagamentos do imóvel - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="imoveis">

  <!-- HEADER -->
  <? include(APP_PATH.'/proprietario/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/proprietario/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Imóvel (<?=$anuncio['codigo']?>) <i class="fas fa-chevron-right"></i> Pagamentos
        </h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>proprietario/inicio" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
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
                    <li><span>Aluguel</span><span>R$ <?=Tools::formataMoeda($pagamento['aluguel'])?></span></li>
                    <? if ($pagamento['iptu'] > 0) { ?>
                      <li><span>IPTU</span><span>R$ <?=Tools::formataMoeda($pagamento['iptu'])?></span></li>
                    <? } ?>
                    <? if ($pagamento['taxa_adm'] > 0) { ?>
                      <li><span>Taxa administrativa <a href="#" class="modal-open" data-modal="modal-taxa-admin"><i class="las la-exclamation-circle"></i></a></span><span>- R$ <?=Tools::formataMoeda($pagamento['taxa_adm'])?></span></li>
                    <? } ?>
                    <? if ($pagamento['taxa_ext'] > 0) { ?>
                      <li><span>Cobrança extraordinária <a href="#" class="modal-open" data-modal="modal-cobranca-extra"><i class="las la-exclamation-circle"></i></a></span><span>- R$ <?=Tools::formataMoeda($pagamento['taxa_ext'])?></span></li>
                    <? } ?>
                    <li class="dest"><span>Total</span><span>R$ <?=Tools::formataMoeda($pagamento['total'])?></span></li>
                  </ul>
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
              <p>Não há pagamentos disponíveis para este imóvel.</p>
            </div>
          </div>
        </div>
        <!-- sem registros --> 
        
      <? } ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- Cobrança extraordinária -->
    <div class="modal" id="modal-cobranca-extra">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-cobranca-extra"></span>
        <div class="modal-header">
          <span class="modal-titulo">Cobrança extraordinária</span>                
        </div>
        <div class="modal-body">
          <div class="texto">
            <p>As taxas extraordinárias estão previstas no art. 22 da Lei do Inquilinato, são despesas não rotineiras proveniente de imprevistos referente ao condomínio. Cabe ao proprietário arcar, pois diferente das despesas ordinárias (paga pelo inquilino) estas são de situações emergenciais.</p>
          </div>
          <div style="text-align: center;">
            <button type="button" class="btn btn-sm btn-primario modal-close" data-modal="modal-cobranca-extra">Entendi</button>
          </div>
        </div>
      </div>
    </div>
    <!-- //Cobrança extraordinária -->

    <!-- Taxa administrativa -->
    <div class="modal" id="modal-taxa-admin">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-taxa-admin"></span>
        <div class="modal-header">
          <span class="modal-titulo">Taxa administrativa</span>                
        </div>
        <div class="modal-body">
          <div class="texto">
            <p>É a remuneração devida à imobiliária pelos serviços prestados, como administração ou intermediação do seu imóvel.</p>
          </div>
          <div style="text-align: center;">
            <button type="button" class="btn btn-sm btn-primario modal-close" data-modal="modal-taxa-admin">Entendi</button>
          </div>
        </div>
      </div>
    </div>
    <!-- //Taxa administrativa -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/proprietario/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
