<? include(ACOES_APP_PATH."/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH."/corretor/mensagem.php"); ?>
<?php
$titulo_pagina = "Mensagens - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="mensagens">

  <!-- HEADER -->
  <? include(APP_PATH.'/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Mensagens</h1>
      </div>

      <div class="conta-bloco" style="border: none;">
        <div class="conta-bloco-content chat-container">

          <!-- CHAT -->
          <div class="chat">
            
            <!-- Mensagens -->
            <div class="chat-mensagens">
              <? if ($numMensagens > 0) { ?>
                <? foreach ($mensagens as $mensagem) { ?>
                  <!-- Repete -->
                  <div class="chat-mensagem <?=$mensagem['tipo']?>">
                    <figure title="<?=$mensagem['nome']?>"><img src="<?=$mensagem['foto']?>" alt="<?=$mensagem['nome']?>"></figure>
                    <div class="chat-mensagem-content">
                      <div class="chat-mensagem-texto">
                        <?=$mensagem['mensagem']?>
                        <? if ($mensagem['arquivo'] != "") { ?>
                          <br><a href="<?=URL?>uploads/outros/<?=$tabela?>/<?=$mensagem['id']?>/<?=$mensagem['arquivo']?>" class="chat-mensagem-anexo" title="Clique para baixar o anexo" download><i class="fas fa-paperclip"></i> Baixar anexo</a>
                        <? } ?>
                      </div>
                      <div class="chat-mensage-data"><?=$mensagem['data']?></div>
                    </div>
                  </div>
                  <!-- //Repete -->
                <? } ?>
              <? } else { ?>
                <div class="texto center">
                  <p><b>NENHUMA MENSAGEM</b></p>
                  <p>Digite uma mensagem no campo abaixo e clique em <b>Enviar</b>.</p>
                </div>
              <? } ?>
            </div>
            <!-- //Mensagens -->

            <!-- Formulário Mensagem -->
            <form id="chat-form" class="chat-form form-validation" method="post" action="<?=URL?>acoes/app/corretor/envia_mensagem.php" enctype="multipart/form-data">
              <div class="chat-campo-container">
                <textarea name="mensagem" id="chat-mensagem" class="campo" placeholder="Digite uma mensagem" required></textarea>
                <label class="chat-input-anexo" title="">
                  <i class="fas fa-paperclip"></i>
                  <input type="file" name="arquivos[arquivo]" id="chat-anexo" data-parsley-maxfilesize="10" accept="application/msword, text/plain, application/pdf, image/*" data-parsley-trigger="change"/>
                </label>
                <input type="hidden" name="corretor" value="<?=$idUser?>">
                <button type="submit" id="chat-btn-send" class="btn btn-primario">Enviar</button>
              </div>
            </form>
            <!-- //Formulário Mensagem -->
          </div>
          <!-- //CHAT -->

        </div>
      </div>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/corretor/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
