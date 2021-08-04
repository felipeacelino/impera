<? include(ACOES_APP_PATH."/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH."/corretor/acompanhar.php"); ?>
<?php
$titulo_pagina = "Acompanhar imóvel - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="imoveis">

  <!-- HEADER -->
  <? include(APP_PATH.'/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Imóvel (<?=$anuncio['codigo']?>) <i class="fas fa-chevron-right"></i> Acompanhar imóvel
        </h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>corretor/imoveis" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      </div>

      <? if ($anuncio['finalidade'] == "venda") { ?>
      <div class="conta-bloco">
        <div class="conta-bloco-content">
          <div class="texto center">
            <h2>Venda</h2>
          </div>
          <ul class="ac-list">
            <? foreach ($etapasVenda as $etapaK => $etapaV) { ?>
              <? $activeItem = $anuncio['etapa_venda'] >= $etapaK ? "active" : ""; ?>
              <li class="ac-item <?=$activeItem?>">
                <div class="ac-item-icon"><?=$etapaV['icone']?></div>
                <div class="ac-item-infos">
                  <div class="ac-item-tit"><?=$etapaV['titulo']?></div>
                </div>
              </li>
            <? } ?>
          </ul>
          <div class="texto">

            <p><h2>Como funciona cada etapa</h2></p>

            <div class="faq-lista no-float">
              <? foreach ($etapasVenda as $etapaK => $etapaV) { ?>
                <div class="faq">
                  <div class="faq-pergunta"><i></i> <?=$etapaV['titulo']?></div>
                  <div class="faq-resposta">
                    <div class="texto"><?=$etapaV['descricao']?></div>
                  </div>
                </div>
              <? } ?>
            </div>

          </div>
        </div>
      </div>
      <? } ?>
      
      <? if ($anuncio['finalidade'] == "aluguel") { ?>
      <div class="conta-bloco">
      <div class="conta-bloco">
        <div class="conta-bloco-content">
          <div class="texto center">
            <h2>Locação</h2>
          </div>
          <ul class="ac-list">
            <? foreach ($etapasAluguel as $etapaK => $etapaV) { ?>
              <? $activeItem = $anuncio['etapa_aluguel'] >= $etapaK ? "active" : ""; ?>
              <li class="ac-item <?=$activeItem?>">
                <div class="ac-item-icon"><?=$etapaV['icone']?></div>
                <div class="ac-item-infos">
                  <div class="ac-item-tit"><?=$etapaV['titulo']?></div>
                </div>
              </li>
            <? } ?>
          </ul>
          <div class="texto">

            <p><h2>Como funciona cada etapa</h2></p>

            <div class="faq-lista no-float">
              <? foreach ($etapasAluguel as $etapaK => $etapaV) { ?>
                <div class="faq">
                  <div class="faq-pergunta"><i></i> <?=$etapaV['titulo']?></div>
                  <div class="faq-resposta">
                    <div class="texto"><?=$etapaV['descricao']?></div>
                  </div>
                </div>
              <? } ?>
            </div>

          </div>
        </div>
      </div>
      <? } ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/corretor/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
