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
   
              <!--formulario --> 
              <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?=$action_form; ?>" >

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url_base">
                    URL base *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="url_base" id="url_base" type="text" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['url_base']; ?>">
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="timezone">
                    Estado de origem *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="timezone" id="timezone" class="form-control col-md-7 col-xs-12" required>
                      <option value="" hidden>Selecione</option>
                      <? foreach ($timezones as $key => $value) { ?>
                        <option value="<?=$value; ?>" <?=Tools::selected($value,$linha_edit['timezone']); ?>>
                          <?=$key; ?>
                        </option>
                      <? } ?>
                    </select>
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form">
                  <div class="separator-form-titulo">Dados de SMTP (E-mail)</div>
                </div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="smtp_host">
                    SMTP host *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="smtp_host" id="smtp_host" type="text" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['smtp_host']; ?>">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="smtp_user">
                    SMTP usuário *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="smtp_user" id="smtp_user" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['smtp_user']; ?>">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="smtp_pass">
                    SMTP senha *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="smtp_pass" id="smtp_pass" type="password" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['smtp_pass']; ?>">
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_autenticado">
                    E-mail autenticado *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="email_autenticado" id="email_autenticado" class="switch" value="1" data-label-true="Ativado" data-label-false="Desativado" <? if($acao == 'edit'){ Tools::checked("1",$linha_edit['email_autenticado']); } else { ?> checked <? } ?> />
                      <span class="switch-label"></span>                      
                    </label>                    
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="envio_gmail">
                    Gmail *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="envio_gmail" id="envio_gmail" class="switch" value="1" data-label-true="Ativado" data-label-false="Desativado" <? if($acao == 'edit'){ Tools::checked("1",$linha_edit['envio_gmail']); } else { ?> checked <? } ?> />
                      <span class="switch-label"></span>                      
                    </label>                    
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form">
                  <div class="separator-form-titulo">SEO</div>
                </div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="google_analytcs">Google analytcs
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="google_analytcs" id="google_analytcs" class="form-control" rows="6"><?=$linha_edit['google_analytcs']; ?></textarea>
                 </div>
                </div>
                <!--repete -->

                <div class="separator-form">
                  <div class="separator-form-titulo">Tema (Admin)</div>
                </div>

                <link href="<?=URL; ?>admin/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

                <!--repete -->                
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cor_principal">
                  Cor principal *
                </label>                
                <div class="input-group colorpicker-component col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" name="cor_principal" id="cor_principal" class="form-control col-md-7 col-xs-12" required <? if($linha_edit['cor_principal'] != ""){ ?> value="<?=$linha_edit['cor_principal']; ?>" <? } else { ?> value="#111111" <? } ?> /> 
                  <span class="input-group-addon"><i></i></span>                                     
                </div> 
                <!--repete --> 

                <!--repete -->                
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cor_secundaria">
                  Cor secundária *
                </label>                
                <div class="input-group colorpicker-component col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" name="cor_secundaria" id="cor_secundaria" class="form-control col-md-7 col-xs-12" required <? if($linha_edit['cor_principal'] != ""){ ?> value="<?=$linha_edit['cor_secundaria']; ?>" <? } else { ?> value="#E39300" <? } ?> /> 
                  <span class="input-group-addon"><i></i></span>                                     
                </div> 
                <!--repete --> 

                <!--repete -->                
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="btn_principal">
                  Botão principal *
                </label>                
                <div class="input-group colorpicker-component col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" name="btn_principal" id="btn_principal" class="form-control col-md-7 col-xs-12" required <? if($linha_edit['btn_principal'] != ""){ ?> value="<?=$linha_edit['btn_principal']; ?>" <? } else { ?> value="#337AB7" <? } ?> /> 
                  <span class="input-group-addon"><i></i></span>                                     
                </div> 
                <!--repete --> 

                <!--repete -->                
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="btn_secundario">
                  Botão secundário *
                </label>                
                <div class="input-group colorpicker-component col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" name="btn_secundario" id="btn_secundario" class="form-control col-md-7 col-xs-12" required <? if($linha_edit['cor_principal'] != ""){ ?> value="<?=$linha_edit['btn_secundario']; ?>" <? } else { ?> value="#26B99A" <? } ?> /> 
                  <span class="input-group-addon"><i></i></span>  
                </div> 
                <!--repete --> 

                <!--repete -->                
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cor_icheck">
                  Cor Checkbox/Radio *
                </label>                
                <div class="input-group colorpicker-component col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" name="cor_icheck" id="cor_icheck" class="form-control col-md-7 col-xs-12" required <? if($linha_edit['cor_icheck'] != ""){ ?> value="<?=$linha_edit['cor_icheck']; ?>" <? } else { ?> value="#337AB7" <? } ?> /> 
                  <span class="input-group-addon"><i></i></span>         
                </div> 
                <!--repete --> 

                <div class="separator-form"></div>

                <script> 
                  $(function() { 
                    $('.colorpicker-component').colorpicker(); 
                  }); 
                </script>
                <script src="<?=URL; ?>admin/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
                
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

        </div>
      </div>             
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
