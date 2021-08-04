<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<? include(ACOES_APP_PATH."/proprietario/cadastrar_senha_pag.php"); ?>
<?php
$titulo_pagina = "Cadastrar Nova Senha - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
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
    </div>
    <!-- //Conteúdo -->

    <!-- Formulário -->
    <form id="form-senha" action="<?=URL?>acoes/app/proprietario/cadastrar_senha.php" method="post" class="pg-login-form form-validation">
      <h1 class="titulo">Nova Senha</h1>

      <div class="texto"><p>Cadastre sua nova senha abaixo.</p></div>

      <div class="campo-container">
        <label for="rec-senha">Nova senha</label>
        <input type="password" name="senha" id="rec-senha" minlength="6" maxlength="16" class="campo" placeholder="Digite a nova senha" data-parsley-length-message="Sua senha deve ter entre 6 e 16 caracteres" data-parsley-trigger="change" required />
      </div>
      
      <div class="campo-container">
        <label for="rec-senha2">Confirmar senha</label>
        <input type="password" name="senha2" id="rec-senha2" minlength="6" maxlength="16" class="campo" placeholder="Confirme a nova senha" data-parsley-length-message="Sua senha deve ter entre 6 e 16 caracteres" data-parsley-equalto="#rec-senha" data-parsley-equalto-message="Digite a mesma senha novamente" data-parsley-trigger="change" required />
      </div>

      <div class="btn-container">
        <input type="hidden" name="id_user" value="<?=$param3?>">
        <input type="hidden" name="chave_user" value="<?=$param4?>">
        <input type="hidden" name="retorno_success" id="retorno_success" value="<?=URL?>proprietario/entrar">
        <button type="submit" id="rec-cadastrar" class="btn btn-full btn-primario">Cadastrar</button>
      </div>
    </form>
    <!-- //Formulário -->

  </div>
</div>

<? include(APP_PATH.'/estrutura/gerais_footer.php'); ?>

</body>
</html>
