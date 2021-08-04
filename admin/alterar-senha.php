<?php

session_start();

include ("../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

Tools::debug(false);

$title_site = TITULO_PAGS;
$descr_site = "";

include ("".ACOES_ADMIN_PATH."/geral/alterar-senha.php");

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
              <input type="password" name="senha" class="form-control has-feedback-left" id="senha" placeholder="Nova Senha" required>
              <span class="fa fa-lock form-control-feedback left"></span>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="password" name="senha2" class="form-control has-feedback-left" id="senha2" placeholder="Confirmar Senha" required>
              <span class="fa fa-lock form-control-feedback left"></span>
            </div>          

            <div>
              <input type="submit" name="bt" class="btn btn-dark submit" value="Cadastrar" >
              <a class="reset_pass" href="<?=URL?>admin/login.php">Efetuar login</a>
            </div>

            <div class="clearfix"></div>

            <div class="separator">

              <div class="clearfix"></div>

              <div id="senhas-dif-alert" class="alert alert-danger" role="alert" style="display: none">        
                As senhas digitadas são diferentes.
              </div>
              <!--mensagem retorno -->          
              <?
              echo $_SESSION['msg_retorna_login'];
              ?>
              <span id="divclean"></span>
              <!--fim mensagem retorno -->              

            </div>

            <!--hidden fields -->
            <input type="hidden" name="acao" value="update">
            <input type="hidden" name="id_user" value="<?=$_GET['id_user']?>">

          <!--hidden fields -->
          </form>
          <!--formulario --> 

        </section>
      </div>      

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

    <script type="text/javascript">
      $(document).ready(function () {
        
        $("#form-login").submit(function() {
          if ($('#senha2').val() != $('#senha').val()) {
            $('#senhas-dif-alert').show();
            return false;
          }            
        });

        $('#senha2').on('change', function() {
          if ($('#senha2').val() != $('#senha').val()) {
            $('#senhas-dif-alert').show();
          } else {
            $('#senhas-dif-alert').hide();
          }
        });  

        setTimeout(function () {
          $('#divclean').load('<?=URL; ?>acoes/admin/geral/remove_session.php');
        }, 500);

      });  
 
    </script>
    </body>
</html>
<!-- fim estrutura -->
