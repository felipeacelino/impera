<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = "Entrar - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";

$retorno = isset($_GET['retorno']) && $_GET['retorno'] != "" ? Tools::protege($_GET['retorno']) : URL."corretor/inicio";
$urlRetorno = isset($_GET['retorno']) && $_GET['retorno'] != "" ? URL."corretor/criar-conta?retorno=".$retorno : URL."corretor/criar-conta";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-login" style="background-image: url('<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-2000-0/<?=$pagina['banner_login']?>');">
<span class="mascara"></span>
<div class="container">
  <div class="pg-login-wrapper">

    <!-- Conteúdo -->
    <div class="pg-login-content">
      <a href="<?=URL?>" title="<?=TITULO_PAGS?>" class="pg-login-logo">
        <img src="<?=LOGO_PRINCIPAL?>" alt="<?=TITULO_PAGS?>">
      </a>
      <h2 class="titulo">Seja Nosso Corretor Parceiro!</h2>
      <h3 class="subtitulo">Multiplique os seus negócios trabalhando de onde estiver!</h3>
      <div class="texto">Realize o seu cadastro completo que em breve entraremos em contato!</div>
      <div class="btn-container">
        <a href="<?=$urlRetorno?>" class="btn btn-primario outline hide-mobile">Cadastre-se Agora</a>
      </div>
    </div>
    <!-- //Conteúdo -->

    <!-- Formulário -->
    <form id="form-login" action="<?=URL?>acoes/app/corretor/login.php" method="post" class="pg-login-form form-validation">
      <h1 class="titulo">Entrar</h1>

      <div class="texto"><p>Informe seu e-mail e senha para entrar.</p></div>

      <div class="campo-container campo-icon">
        <input type="email" name="login" id="lg-login" maxlength="255" class="campo" placeholder="Digite seu e-mail" data-parsley-trigger="change" required />
        <label class="icon" for="lg-login"><i class="las la-user"></i></label>
      </div>

      <div class="campo-container campo-icon">
        <input type="password" name="senha" id="lg-senha" class="campo" placeholder="Digite sua senha" data-parsley-trigger="change" required />
        <label class="icon" for="lg-senha"><i class="las la-lock"></i></label>
      </div>

      <div class="link-rec">
        <a href="#" class="link modal-open" data-modal="modal-recuperacao">Esqueci minha senha</a>
      </div>

      <div class="btn-container">
        <input type="hidden" name="facebook_id" id="facebook_id_login"
          data-url="<?=URL?>acoes/app/corretor/verifica_facebook.php">
        <input type="hidden" name="retorno_success" id="login_retorno" value="<?=$retorno?>">
        <button type="submit" id="cd-login" class="btn btn-full btn-primario btn-pulse">Entrar</button>
        <a href="<?=$urlRetorno?>" class="btn btn-full btn-primario outline hide-desktop hide-tablet">Criar Conta</a>
      </div>
    </form>
    <!-- //Formulário -->

  </div>
</div>

<!-- MODAL RECUPERAÇÃO -->
<div class="modal" id="modal-recuperacao">
  <div class="modal-wrap modal-sm">
    <span class="modal-btn-close modal-close" data-modal="modal-recuperacao"></span>
    <div class="modal-header">
      <span class="modal-titulo">Esqueci minha senha</span>
    </div>
    <div class="modal-body">
      <div class="texto" style="font-weight: 300;">
        <p>Esqueceu a sua senha? Não tem problema, basta nos informar o endereço de e-mail utilizado no momento em que você se cadastrou que nós lhe enviaremos um e-mail com as instruções para você definir uma nova senha.</p>
      </div>
      <form id="form-recuperacao" action="<?=URL?>acoes/app/corretor/envia_email_recuperacao.php" method="post"
        class="form-validation">
        <div class="campo-container campo-icon">
          <input type="email" name="email" id="email_recuperacao" maxlength="255" class="campo"
            placeholder="Digite seu e-mail de cadastro" required data-parsley-trigger="change"
            data-parsley-remote="<?=URL?>acoes/app/corretor/verifica_email_recuperacao.php"
            data-parsley-remote-options='{ "type": "POST", "data": { "tipo": "corretor" } }'
            data-parsley-remote-validator="remote"
            data-parsley-remote-message="Este endereço de e-mail não foi encontrado em nosso sitema." />
          <label class="icon" for="email_recuperacao"><i class="fas fa-envelope"></i></label>
        </div>
        <div class="modal-btn center" style="margin-top: 0px;">
          <button type="submit" id="enviar_rec" class="btn btn-full btn-primario">Enviar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- //MODAL RECUPERAÇÃO -->

<? include(APP_PATH.'/estrutura/gerais_footer.php'); ?>

</body>
</html>
