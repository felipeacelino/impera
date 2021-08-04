<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = "Criar Conta - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";

$retorno = isset($_GET['retorno']) && $_GET['retorno'] != "" ? Tools::protege($_GET['retorno']) : URL."proprietario/inicio/success";
$urlRetorno = isset($_GET['retorno']) && $_GET['retorno'] != "" ? URL."proprietario/entrar?retorno=".$retorno : URL."proprietario/entrar";
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
      <h2 class="titulo">Proprietário</h2>
      <h3 class="subtitulo"><?=$pagina['titulo']?></h3>
      <div class="texto"><?=$pagina['subtitulo']?></div>
      <div class="btn-container">
        <a href="<?=$urlRetorno?>" class="btn btn-primario outline hide-mobile">Já Possuo Cadastro</a>
      </div>
    </div>
    <!-- //Conteúdo -->

    <!-- Formulário -->
    <form id="form-cadastro" action="<?=URL?>acoes/app/proprietario/cadastro.php" method="post" class="pg-login-form pg-login-form-cadastro form-validation">
      <h1 class="titulo">Criar Conta</h1>

      <div class="texto"><p>Informe os dados abaixo.</p></div>

      <div class="campo-container campo-icon">
        <input type="text" name="nome" id="cd-nome" maxlength="255" class="campo" placeholder="Digite seu nome completo" data-parsley-fullname data-parsley-trigger="change" required />
        <label class="icon" for="cd-nome"><i class="las la-user"></i></label>
      </div>

      <div class="campo-container campo-icon">
        <input type="email" name="email" id="cd-email" maxlength="255" class="campo" placeholder="Digite seu e-mail" required data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/proprietario/verifica_email.php" data-parsley-remote-options='{ "type": "POST", "data": { "tipo": "proprietario" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Este endereço de e-mail já está sendo utilizado" />
        <label class="icon" for="cd-email"><i class="las la-envelope"></i></label>
      </div>

      <div class="campo-container campo-icon">
        <input type="tel" name="telefone" id="cd-telefone" maxlength="255" class="campo telefone" placeholder="Digite seu telefone" data-parsley-trigger="change" data-parsley-pattern="(\([1-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})" data-parsley-pattern-message="Digite um número de telefone válido." required />
        <label class="icon" for="cd-telefone"><i class="las la-phone"></i></label>
      </div>

      <div class="campo-container campo-icon">
        <input type="password" name="senha" id="cd-senha" class="campo" placeholder="Crie uma senha" minlength="6" maxlength="16" data-parsley-length-message="Sua senha deve ter entre 6 e 16 caracteres" data-parsley-trigger="change" required />
        <label class="icon" for="cd-senha"><i class="las la-lock"></i></label>
      </div>

      <div class="campo-container cr-container">
        <label class="cr-lbl" for="cd-termos">
          <input type="checkbox" name="termos" id="cd-termos" value="aceito" data-parsley-required-message="É necessário concordar com os termos antes de continuar" required>
          <i class="checkbox"></i>
          <span>Li e concordo com os <a href="<?=URL?>termos-de-uso" class="link" target="_blank">termos de uso</a> do site.</span>
        </label>
      </div>

      <div class="recaptcha-container" style="margin-bottom: 10px;">
        <div class="recaptcha-el" data-form="form-cadastro" data-key="<?=RECAPTCHA_KEY?>"></div>
      </div>

      <div class="btn-container">
        <input type="hidden" name="facebook_id" id="facebook_id_cad"
          data-url="<?=URL?>acoes/app/proprietario/verifica_facebook.php">
        <input type="hidden" name="retorno_success" id="cadastro_retorno" value="<?=$retorno?>">
        <button type="submit" id="cd-cadastrar" class="btn btn-full btn-primario btn-pulse">Criar Conta</button>
        <a href="<?=$urlRetorno?>" class="btn btn-full btn-primario outline hide-desktop hide-tablet">Já Possuo Cadastro</a>
      </div>
    </form>
    <!-- //Formulário -->

  </div>
</div>

<? include(APP_PATH.'/estrutura/gerais_footer.php'); ?>

</body>
</html>
