<? include(ACOES_APP_PATH."/proprietario/restrito.php"); ?>
<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = "Ajuda - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="ajuda">

  <!-- HEADER -->
  <? include(APP_PATH.'/proprietario/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/proprietario/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Me Ajuda</h1>
      </div>

      <div class="conta-topo-btns-anc">
        <a href="#sec-duvidas" class="btn btn-sm btn-primario">Dúvidas</a>
        <a href="#sec-contrato" class="btn btn-sm btn-primario">Contrato</a>
        <a href="#sec-plataforma" class="btn btn-sm btn-primario">Plataforma</a>
        <a href="<?=URL?>ajuda" class="btn btn-sm btn-primario">Mais Informações <i class="las la-share" style="margin-right: 0px; margin-left: 5px;"></i></a>
      </div>

      <div class="conta-bloco" id="sec-duvidas">
        <div class="conta-bloco-content">
          <div class="texto inst">
            <h2><?=$pagina['titulo']?></h2>
            <?=$pagina['texto']?>
          </div>
        </div>
      </div>

      <div class="conta-bloco" id="sec-contrato">
        <div class="conta-bloco-content">
          <div class="texto inst">
            <h2><?=$pagina['titulo2']?></h2>
            <?=$pagina['texto2']?>
          </div>
        </div>
      </div>

      <div class="conta-bloco" id="sec-plataforma">
        <div class="conta-bloco-content">
          <div class="texto inst">
            <h2><?=$pagina['titulo3']?></h2>
            <?=$pagina['texto3']?>
          </div>
        </div>
      </div>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/proprietario/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
