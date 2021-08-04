<? include("" . ACOES_ADMIN_PATH . "/" . $pasta_modulo . "/" . $pag_include . ".php"); ?>

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

          <!--mensagem retorno -->
          <?
          echo $_SESSION['msg_retorna'];
          ?>
          <span id="divclean"></span>
          <!--fim mensagem retorno -->

          <? if ($acao == "insert" || $acao == "edit") { ?>

            <!--cadastrar e editar  -->
            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- LINHA HEADER -->
              <div class="header_row" id="barra_header">
                <!-- DIREITA -->
                <div class="header_row_left">
                  <div class="header_row_item">
                    <a href="<?= $retorno_geral; ?>" class="btn btn-primary btn-header">
                      <i class="fa fa-chevron-left"></i>
                      <span>Voltar</span>
                    </a>
                  </div>
                </div>
                <!-- FIM DIREITA -->
              </div>
              <!-- FIM LINHA HEADER -->

              <!-- SEGURA CHAT -->
              <div class="form-horizontal form-label-left">

                <!-- CHAT -->
                <div class="chat">

                  <!-- Mensagens -->
                  <div class="chat-mensagens" id="chat-mensagens">
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

                  <script>
                    var objDiv = document.getElementById("chat-mensagens");
                    objDiv.scrollTop = objDiv.scrollHeight;
                  </script>

                  <!-- Formulário Mensagem -->
                  <form id="chat-form" class="chat-form form-validation" method="post" action="<?= URL ?>acoes/admin/proprietarios/envia_mensagem.php" enctype="multipart/form-data">
                    <div class="chat-campo-container">
                      <textarea name="mensagem" id="chat-mensagem" class="campo" placeholder="Digite uma mensagem" required></textarea>
                      <label class="chat-input-anexo" title="">
                        <i class="fas fa-paperclip"></i>
                        <input type="file" name="arquivos[arquivo]" id="chat-anexo" data-parsley-maxfilesize="10" accept="application/msword, text/plain, application/pdf, image/*" data-parsley-trigger="change" />
                      </label>
                      <input type="hidden" name="proprietario" value="<?= $origem['id'] ?>">
                      <button type="submit" id="chat-btn-send" class="btn btn-primario">Enviar</button>
                    </div>
                  </form>
                  <!-- //Formulário Mensagem -->
                </div>
                <!-- //CHAT -->

              </div>
              <!-- SEGURA CHAT -->

            </div>
            <!--fim cadastrar e editar  -->

          <? } ?>

        </div>
      </div>
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
