<? include(ACOES_APP_PATH."/afiliado/restrito.php"); ?>
<? include(ACOES_APP_PATH."/afiliado/anuncios.php"); ?>
<?php
$titulo_pagina = "Início - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="inicio">

  <!-- HEADER -->
  <? include(APP_PATH.'/afiliado/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/afiliado/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <div class="conta-titulo">Seja bem-vindo(a), <span><?=$user['primeiro_nome']?></span>!</div>
      </div>

      <div class="row conta-bl-atalhos">

        <a href="<?=URL?>afiliado/pagamentos" class="grid-4 grid-m-6 grid-s-12 conta-bla">
          <div class="conta-bla-icon">
            <i class="las la-wallet"></i>
          </div>
          <div class="conta-bla-infos">
            <div class="conta-bla-title">Minhas Comissões</div>
            <div class="conta-bla-text">Visualize seus pagamentos e as comissões pagas e pendentes</div>
          </div>
        </a>

        <a href="<?=URL?>afiliado/mensagens" class="grid-4 grid-m-6 grid-s-12 conta-bla">
          <div class="conta-bla-icon">
            <i class="las la-comment-alt"></i>
          </div>
          <div class="conta-bla-infos">
            <div class="conta-bla-title">Mensagens</div>
            <div class="conta-bla-text">Visualize e responda as mensagens da imobiliária</div>
          </div>
        </a>

        <a href="<?=URL?>afiliado/meus-dados" class="grid-4 grid-m-6 grid-s-12 conta-bla">
          <div class="conta-bla-icon">
            <i class="las la-user"></i>
          </div>
          <div class="conta-bla-infos">
            <div class="conta-bla-title">Meus Dados</div>
            <div class="conta-bla-text">Cadastre e gerencie suas informações e dados cadastrais</div>
          </div>
        </a>

        <a href="#" class="grid-4 grid-m-6 grid-s-12 conta-bla">
          <div class="conta-bla-icon">
            <i class="las la-question-circle"></i>
          </div>
          <div class="conta-bla-infos">
            <div class="conta-bla-title">Me ajuda</div>
            <div class="conta-bla-text">Precisa de ajuda? Clique aqui e veja nossos artigos e guias de ajuda</div>
          </div>
        </a>

      </div>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/afiliado/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

  <? if ($param3 == "success") { ?>
    <script>
    showAlert('Parabéns!', 'Seu cadastro foi realizado com sucesso!', 'success');
    </script>
  <? } ?>

</body>

</html>
