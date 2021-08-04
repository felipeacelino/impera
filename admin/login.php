<?php

session_start();

include ("../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

$title_site = TITULO_PAGS;
$descr_site = "";

Tools::debug(false);

include ("".ACOES_ADMIN_PATH."/geral/login.php");

?>

<!DOCTYPE html>
<html lang="en">

<?
include ('estrutura/head.php');
?>

<body class="login">
  <div>

    <div class="login_wrapper">

      <div class="animate form login_form">

        <section class="login_content">

          <img src="<?=LOGO_PRINCIPAL; ?>" class="logo-login">

          <!--formulario --> 
          <form id="form-login" class="form-horizontal form-label-left" method="post" action="<?=$action_form?>" >

            <div class="clearfix"></div>

            <h1><?=$tit_pag_geral?></h1>

            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="email" name="email" class="form-control has-feedback-left" id="email" placeholder="E-mail" required>
              <span class="fa fa-user form-control-feedback left"></span>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="password" name="pass" class="form-control has-feedback-left" id="pass" placeholder="Senha" required>
              <span class="fa fa-lock form-control-feedback left"></span>
            </div>          

            <div class="login-btn-container">
              <input type="submit" name="bt" class="btn btn-dark submit" value="Entrar" >
              <a class="reset_pass" href="#" data-toggle="modal" data-target="#modal-recuperacao">Esqueceu a senha?</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <div class="clearfix"></div>
              
              <!--mensagem retorno -->          
              <?
              echo $_SESSION['msg_retorna_login'];
              ?>
              <span id="divclean"></span>
              <!--fim mensagem retorno -->                

            </div>

            <!--hidden fields -->
            <input type="hidden" name="acao" value="loga">

          <!--hidden fields -->
          </form>
          <!--formulario --> 

        </section>
      </div>

      <!-- MODAL DE RECUPERAÇÃO DE SENHA -->
      <div class="modal fade" id="modal-recuperacao" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Esqueceu sua senha?</h4>
            </div>

            <form method="post" id="form-rec" action="<?=URL?>acoes/admin/geral/enviar_email_recuperacao.php">

              <div class="modal-body">  

                <div class="form-group" id="form-group-rec">                       
                  <p class="col-md-12 col-sm-12 col-xs-12">Informe seu e-mail de cadastro:</p>
                  <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                    <input type="email" name="email" class="form-control has-feedback-left" id="emailrec" placeholder="E-mail" required>
                    <span class="fa fa-envelope form-control-feedback left"></span>          
                  </div> 
                </div>

                <div class="clearfix"></div>

                <div id="alert-rec-1" class="alert alert-success" role="alert">                  
                  Uma mensagem foi enviada para o seu e-mail cadastrado contendo as instruções para criar uma nova senha.
                </div>

                <div id="alert-rec-2" class="alert alert-danger" role="alert">                  
                  O e-mail informado não encontra-se cadastrado em nosso sistema.
                </div> 

                <div id="alert-rec-3" class="alert alert-danger" role="alert">                 
                  Não foi possível realizar essa operação.
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" id="btn-rec-ok" class="btn btn-default" data-dismiss="modal">Ok</button>
                <button type="button" id="btn-rec-canc" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <input type="submit" id="enviar" class="btn btn-dark" value="Enviar">
              </div>

            </form>

          </div>
        </div>
      </div>
      <!-- FIM DO MODAL -->

    <!-- Bootstrap -->
    <script src="<?=URL; ?>admin/js/envia_form_recuperacao.js"></script>
    <script src="<?=URL; ?>admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!--validação formularios -->
    <script src="<?=URL; ?>admin/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?=URL; ?>admin/vendors/jquery-validation/dist/localization/messages_pt_BR.js"></script>
    <script src="<?=URL; ?>admin/vendors/pnotify/dist/pnotify.js" type="text/javascript"></script>
    <script src="<?=URL; ?>admin/vendors/pnotify/dist/pnotify.buttons.js" type="text/javascript"></script>
    <script src="<?=URL; ?>admin/vendors/pnotify/dist/pnotify.animate.js" type="text/javascript"></script>

     <script type="text/javascript">
      $(document).ready(function () {
        setTimeout(function () {
          $('#divclean').load('<?=URL; ?>acoes/admin/geral/remove_session.php');
        }, 500);
      });
    </script>

    </body>
</html>
<!-- fim estrutura -->
