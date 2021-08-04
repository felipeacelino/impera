<? include(ACOES_APP_PATH . "/cliente/restrito.php"); ?>
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
  <? include(APP_PATH . '/cliente/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH . '/cliente/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Meus Dados</h1>
      </div>

      <form id="form-update-dados" action="<?= URL ?>acoes/app/cliente/update_dados.php" method="post" class="form-validation" enctype="multipart/form-data">

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
                <input type="cpf" name="cpf" id="cpf" maxlength="255" class="campo cpf" placeholder="Digite seu CPF" <? if ($user['cpf'] == "") { ?> required <? } else { ?> value="<?=$user['cpf']?>" readonly <? } ?> data-parsley-cpf data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/cliente/verifica_cpf.php" data-parsley-remote-options='{ "type": "POST", "data": { "id_edit": "<?= $user['id'] ?>" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Esse CPF já está sendo utilizado" />
              </div>
            </div>
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="email">E-mail *</label>
                <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite seu e-mail" <? if ($user['email'] == "") { ?> required <? } else { ?> value="<?=$user['email']?>" readonly <? } ?> data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/cliente/verifica_email.php" data-parsley-remote-options='{ "type": "POST", "data": { "id_edit": "<?= $user['id'] ?>" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Esse endereço de e-mail já está sendo utilizado" />
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
            <div class="conta-bloco-titulo">Endereço</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="cep">CEP *</label>
                <div class="campo-loading" title="Aguarde...">
                  <i class="fas fa-circle-notch fa-spin"></i>
                </div>
                <input type="text" name="cep" id="cep" maxlength="255" class="campo cep cep_completa" placeholder="Informe o CEP" data-parsley-trigger="change" data-url="<?= URL ?>acoes/api/completa_endereco.php" value="<?= $user['cep'] ?>" required />
              </div>
            </div>
            <div class="row">
              <div class="grid-9 grid-m-12 grid-s-12 campo-container">
                <label for="logradouro">Endereço *</label>
                <input type="text" name="logradouro" id="logradouro" maxlength="255" class="campo" placeholder="Informe o endereço" data-parsley-trigger="change" value="<?= $user['logradouro'] ?>" required />
              </div>
              <div class="grid-3 grid-m-12 grid-s-12 campo-container">
                <label for="numero">Número *</label>
                <input type="text" name="numero" id="numero" maxlength="255" class="campo" placeholder="Informe o número do endereço" value="<?= $user['numero'] ?>" required />
              </div>
            </div>
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" id="complemento" maxlength="255" class="campo" placeholder="Informe o complemento" value="<?= $user['complemento'] ?>" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="bairro">Bairro *</label>
                <input type="text" name="bairro" id="bairro" maxlength="255" class="campo" placeholder="Informe o bairro" data-parsley-trigger="change" value="<?= $user['bairro'] ?>" required />
              </div>
            </div>

            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="cidade">Cidade *</label>
                <input type="text" name="cidade" id="cidade" maxlength="255" class="campo" placeholder="Informe a cidade" data-parsley-trigger="change" value="<?=$user['cidade']?>" required />
              </div>

              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="estado">Estado *</label>
                <select name="estado" id="estado" class="campo" data-parsley-trigger="change" required>
                  <option value="" hidden>Selecione o estado</option>
                  <? foreach (Tools::getEstados() as $uf => $estado) { ?>
                    <option value="<?= $uf ?>" <?= Tools::selected($user['estado'], $uf) ?>><?= $estado ?></option>
                  <? } ?>
                </select>
                <i class="arrow"></i>
              </div>
            </div>
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
    <? include(APP_PATH . '/cliente/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
