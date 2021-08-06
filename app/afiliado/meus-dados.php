<? include(ACOES_APP_PATH . "/afiliado/restrito.php"); ?>
<?php
$titulo_pagina = "Meus Dados - " . TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH . '/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="dados">

  <!-- HEADER -->
  <? include(APP_PATH . '/afiliado/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH . '/afiliado/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Meus Dados</h1>
      </div>

      <form id="form-update-dados" action="<?= URL ?>acoes/app/afiliado/update_dados.php" method="post" class="form-validation" enctype="multipart/form-data">

        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Informações pessoais</div>
          </div>
          <div class="conta-bloco-content">
            <div class="texto">
              <p>(*) Campos obrigatórios.</p>
            </div>
            <div class="campo-container">
              <label for="foto">Foto de perfil (Máx. 10Mb)</label>
              <input type="file" name="img[foto]" id="foto" class="campo file" data-parsley-maxfilesize="10" accept="image/*" data-parsley-trigger="change" />
            </div>
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="nome">Nome completo *</label>
                <input type="text" name="nome" id="nome" maxlength="255" class="campo" placeholder="Digite seu nome completo" data-parsley-fullname data-parsley-trigger="change" value="<?= $user['nome'] ?>" required />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="cpf">CPF *</label>
                <input type="cpf" name="cpf" id="cpf" maxlength="255" class="campo cpf" placeholder="Digite seu CPF" <? if ($user['cpf'] == "") { ?> required <? } else { ?> value="<?=$user['cpf']?>" readonly <? } ?> data-parsley-cpf data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/afiliado/verifica_cpf.php" data-parsley-remote-options='{ "type": "POST", "data": { "id_edit": "<?= $user['id'] ?>" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Esse CPF já está sendo utilizado" />
              </div>
            </div>
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="email">E-mail *</label>
                <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite seu e-mail" <? if ($user['email'] == "") { ?> required <? } else { ?> value="<?=$user['email']?>" readonly <? } ?> data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/afiliado/verifica_email.php" data-parsley-remote-options='{ "type": "POST", "data": { "id_edit": "<?= $user['id'] ?>" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Esse endereço de e-mail já está sendo utilizado" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="telefone">Telefone *</label>
                <input type="tel" name="telefone" id="telefone" maxlength="255" class="campo telefone" placeholder="Digite seu telefone" data-parsley-trigger="change" value="<?=$user['telefone']?>" readonly />
              </div>
            </div>
            <div class="texto" style="font-size: 15px;"><i class="las la-exclamation-circle" style="color: #ffbb33"></i> Para sua maior segurança, solicite alteração de dados através do <b>Chat</b> ou pelo nosso <b>WhatsApp</b>.</div>
          </div>
        </div>

        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Alterar senha</div>
          </div>
          <div class="conta-bloco-content">
            <div class="texto">
              <p>Preencha os campos abaixo para alterar a sua senha.</p>
            </div>
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="senha">Nova senha</label>
                <input type="password" name="senha" id="senha" minlength="6" maxlength="16" class="campo" placeholder="Digite uma nova senha" data-parsley-length-message="Sua senha deve ter entre 6 e 16 caracteres" data-parsley-trigger="change" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="senha2">Confirmar senha</label>
                <input type="password" name="senha2" id="senha2" minlength="6" maxlength="16" class="campo" placeholder="Confirme a nova senha" data-parsley-length-message="Sua senha deve ter entre 6 e 16 caracteres" data-parsley-equalto="#senha" data-parsley-equalto-message="Digite a mesma senha novamente" data-parsley-trigger="change" />
              </div>
            </div>
          </div>
        </div>

        <div class="conta-base-btns">
          <button type="submit" id="atualizar" class="btn btn-sm btn-primario">Salvar Alterações</button>
        </div>

      </form>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH . '/afiliado/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
