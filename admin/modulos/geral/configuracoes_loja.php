<? include ("".ACOES_ADMIN_PATH."/".$pasta_modulo."/".$pag_include.".php"); ?>

<!-- estrutura -->
<div class="right_col" role="main">
  <div class="">

    <!-- titulo -->
    <div class="page-title">
      <div class="title_left">
        <h3>
          <?=$tit_pag_geral; ?>
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

          <? if($acao == "insert" || $acao == "edit"){?>

            <!--cadastrar e editar  -->
            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- barra infos -->
              <div class="linha_menor">                
                <div class="esquerda">
                  <div class="item_linha">
                    
                  </div>
                </div>
              </div>
              <!--fim  barra infos -->   
   
              <!--formulario --> 
              <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?=$action_form; ?>" >

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo_loja">
                    Título do site *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo_loja" id="titulo_loja" type="text" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['titulo_loja']; ?>">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_atendimento">
                    E-mail de exibição *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_atendimento" id="email_atendimento" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_atendimento']; ?>">
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefones">
                    Telefone *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="telefones" id="telefones" type="tel" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['telefones']; ?>">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="horario_funcionamento">Horário de funcionamento
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="horario_funcionamento" id="horario_funcionamento" class="form-control" rows="1"><?=$linha_edit['horario_funcionamento']; ?></textarea>
                 </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endereco">Endereço
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="endereco" id="endereco" class="form-control" rows="2"><?=$linha_edit['endereco']; ?></textarea>
                 </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mapa">Código do mapa<br>
                  <a href="#" data-toggle="modal" data-target="#modal-maps"><i class="fas fa-question-circle"></i> Como obter o código do mapa</a>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="mapa" id="mapa" class="form-control" rows="4"><?=$linha_edit['mapa']; ?></textarea>
                 </div>
                </div>
                <!--repete -->

                <div class="separator-form">
                  <div class="separator-form-titulo">Notificações (E-mail)</div>
                </div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_formulario">
                    Formulário de contato *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_formulario" id="email_formulario" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_formulario']; ?>">
                    <small>E-mail para recebimento das mensagens do formulário de contato.</small>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_agendamentos">
                    Agendamentos *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_agendamentos" id="email_agendamentos" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_agendamentos']; ?>">
                    <small>E-mail para recebimento das notificações de agendamento.</small>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_propostas">
                    Propostas *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_propostas" id="email_propostas" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_propostas']; ?>">
                    <small>E-mail para recebimento das notificações de propostas.</small>
                  </div>
                </div>
                <!--repete -->
                
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_docs_clientes">
                    Documentos (Clientes) *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_docs_clientes" id="email_docs_clientes" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_docs_clientes']; ?>">
                    <small>E-mail para recebimento das notificações para documentos enviados de clientes.</small>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_docs_proprietarios">
                    Documentos (Proprietários) *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_docs_proprietarios" id="email_docs_proprietarios" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_docs_proprietarios']; ?>">
                    <small>E-mail para recebimento das notificações para documentos enviados de proprietários.</small>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_docs_corretores">
                    Documentos (Corretores) *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_docs_corretores" id="email_docs_corretores" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email_docs_corretores']; ?>">
                    <small>E-mail para recebimento das notificações para documentos enviados de corretores.</small>
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form">
                  <div class="separator-form-titulo">Taxas dos imóveis</div>
                </div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="taxa">
                    Taxa padrão (%) *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="taxa" id="taxa" type="text" inputmode="numeric" class="form-control col-md-7 col-xs-12 input_percent" required value="<?=str_replace(".",",",$linha_edit['taxa']);?>">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="taxa_exclusivos">
                    Taxa exclusivos (%) *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="taxa_exclusivos" id="taxa_exclusivos" type="text" inputmode="numeric" class="form-control col-md-7 col-xs-12 input_percent" required value="<?=str_replace(".",",",$linha_edit['taxa_exclusivos']);?>">
                  </div>
                </div>
                <!--repete -->
                
                <div class="separator-form">
                  <div class="separator-form-titulo">Redes sociais</div>
                </div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="whatsapp">
                    Whatsapp
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="tel" name="whatsapp" id="whatsapp" class="form-control col-md-7 col-xs-12 has-feedback-left telefone" value="<?=$linha_edit['whatsapp']; ?>">
                    <span class="fab fa-whatsapp form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skype">
                    Skype
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="skype" id="skype" class="form-control col-md-7 col-xs-12 has-feedback-left" value="<?=$linha_edit['skype']; ?>">
                    <span class="fab fa-skype form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">
                    Facebook
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="url" name="facebook" id="facebook" class="form-control col-md-7 col-xs-12 has-feedback-left" value="<?=$linha_edit['facebook']; ?>">
                    <span class="fab fa-facebook-f form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter">
                    Twitter
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="url" name="twitter" id="twitter" class="form-control col-md-7 col-xs-12 has-feedback-left" value="<?=$linha_edit['twitter']; ?>">
                    <span class="fab fa-twitter form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">
                    Instagram
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="url" name="instagram" id="instagram" class="form-control col-md-7 col-xs-12 has-feedback-left" value="<?=$linha_edit['instagram']; ?>">
                    <span class="fab fa-instagram form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="youtube">
                    YouTube
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="url" name="youtube" id="youtube" class="form-control col-md-7 col-xs-12 has-feedback-left" value="<?=$linha_edit['youtube']; ?>">
                    <span class="fab fa-youtube form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="linkedin">
                    LinkedIn
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="url" name="linkedin" id="linkedin" class="form-control col-md-7 col-xs-12 has-feedback-left" value="<?=$linha_edit['linkedin']; ?>">
                    <span class="fab fa-linkedin form-control-feedback left"></span>
                  </div>
                </div>
                <!--repete -->

                <div class="ln_solid"></div>

                <!--botoes -->
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" id="bt1" class="btn btn-primary" value="bt1" name="bt1"><?=$msg_botao; ?></button>
                  </div>
                </div>
                <!--botoes -->

                <!--hidden fields -->
                <input type="hidden" name="retorno" id="retorno" value="">
                <input type="hidden" name="token" value="<?=TOKEN; ?>">
                <input type="hidden" name="acao" value="edit">               
                <input type="hidden" name="id" id="id" value="<?=$linha_edit['id']; ?>">      
                <!--hidden fields -->

              </form>
              <!--fim formulario -->

            </div>
            <!--fim cadastrar e editar  -->

          <? } ?>

          <!-- Modal Maps -->
          <div class="modal fade" id="modal-maps" tabindex="-1" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                  </button>
                  <h4 class="modal-title">Obtendo o código do Google Maps</h4>
                </div>
                <div class="modal-body">
                  <ul>
                    <li>
                      <p><b>1 - </b> Acesse o <a href="https://www.google.com.br/maps/" target="_blank">Google Maps</a> e pesquise pelo endereço desejado.</p>
                    </li>
                    <li>
                      <p><b>2 - </b> Quando encontrar o endereço, clique na opção <b>COMPARTILHAR</b>.</p>
                      <img src="<?=URL?>static/img/admin/maps_1.png">
                      <br><br>
                    </li>
                    <li>
                      <p><b>3 - </b> Será aberta uma nova janela, então clique na aba <b>INCORPORAR UM MAPA</b>.</p>
                      <img src="<?=URL?>static/img/admin/maps_2.png">
                      <br><br>
                    </li>
                    <li>
                      <p><b>4 - </b> Por fim clique em <b>COPIAR HTML</b> e cole o código no campo da administração.</p>
                      <img src="<?=URL?>static/img/admin/maps_3.png">
                    </li>
                  </ul>
                </div>
                <div class="modal-footer">                                
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  
                </div>
              </div>
            </div>
          </div> 
          <!-- Fim Modal Maps -->

        </div>
      </div>             
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
