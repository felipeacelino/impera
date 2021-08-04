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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">
                    Nome *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="nome" id="nome" type="text" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['nome']; ?>">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_verifica">
                    E-mail *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="email_verifica" id="email_verifica" type="email" class="form-control col-md-7 col-xs-12" required value="<?=$linha_edit['email']; ?>">
                  </div>
                </div>
                <!--repete -->  

                <div class="separator-form">
                  <div class="separator-form-titulo">Alterar Senha</div>
                </div>

                <!--repete -->
                <div class="item form-group">                  
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="senha">
                    Senha
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="senha" id="senha" type="password" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="senha2">
                    Confirmar senha
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="senha2" id="senha2" type="password" class="form-control col-md-7 col-xs-12">
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
                <input type="hidden" name="id" id="id" value="<?=ID_USUARIO_ADMIN?>">      
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