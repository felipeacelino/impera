<? include(ACOES_APP_PATH . "/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH . "/corretor/meus_dados.php"); ?>
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
  <? include(APP_PATH . '/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH . '/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <? if ($usuario->cadastroCompleto()) { ?>
          <h1 class="conta-titulo">Meus Dados</h1>
        <? } else { ?>
          <h1 class="conta-titulo">Completar cadastro</h1>
        <? } ?>
      </div>

      <form id="form-update-dados" action="<?= URL ?>acoes/app/corretor/update_dados.php" method="post" class="form-validation" enctype="multipart/form-data">

        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Informações pessoais</div>
          </div>
          <div class="conta-bloco-content">
            <div class="texto">
              <p>(*) Campos obrigatórios.</p>
            </div>
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="nome">Nome completo *</label>
                <input type="text" name="nome" id="nome" maxlength="255" class="campo" placeholder="Digite seu nome completo" data-parsley-fullname data-parsley-trigger="change" value="<?= $user['nome'] ?>" required />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="razao_social">Possui nome social? Caso sim, informe abaixo.</label>
                <input type="text" name="razao_social" id="razao_social" maxlength="255" class="campo" placeholder="Informe seu nome social" data-parsley-trigger="change" value="<?= $user['razao_social'] ?>" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="creci">CRECI *</label>
                <input type="creci" name="creci" id="creci" maxlength="255" class="campo creci" placeholder="Informe seu CRECI" <? if ($user['creci'] == "") { ?> required <? } else { ?> value="<?=$user['creci']?>" readonly <? } ?> data-parsley-trigger="change" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="rg">RG *</label>
                <input type="rg" name="rg" id="rg" maxlength="255" class="campo" placeholder="Informe seu RG" <? if ($user['rg'] == "") { ?> required <? } else { ?> value="<?=$user['rg']?>" readonlyx <? } ?> data-parsley-trigger="change" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="cpf">CPF *</label>
                <input type="cpf" name="cpf" id="cpf" maxlength="255" class="campo cpf" placeholder="Digite seu CPF" <? if ($user['cpf'] == "") { ?> required <? } else { ?> value="<?=$user['cpf']?>" readonly <? } ?> data-parsley-cpf data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/corretor/verifica_cpf.php" data-parsley-remote-options='{ "type": "POST", "data": { "id_edit": "<?= $user['id'] ?>", "tipo": "corretor" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Esse CPF já está sendo utilizado" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="nascimento">Data de nascimento *</label>
                <input type="text" inputmode="numeric" name="nascimento" id="nascimento" maxlength="255" class="campo date" placeholder="__/__/____" data-parsley-trigger="change" value="<?=$user['nascimento']?>" required />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="telefone">Telefone *</label>
                <input type="tel" name="telefone" id="telefone" maxlength="255" class="campo telefone" placeholder="Digite seu telefone" data-parsley-trigger="change" value="<?=$user['telefone']?>" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="email">E-mail *</label>
                <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite seu e-mail" <? if ($user['email'] == "") { ?> required <? } else { ?> value="<?=$user['email']?>" readonly <? } ?> data-parsley-trigger="change" data-parsley-remote="<?=URL?>acoes/app/corretor/verifica_email.php" data-parsley-remote-options='{ "type": "POST", "data": { "id_edit": "<?= $user['id'] ?>", "tipo": "corretor" } }' data-parsley-remote-validator="remote" data-parsley-remote-message="Esse endereço de e-mail já está sendo utilizado" />
              </div>
            </div>
            <? if ($usuario->cadastroCompleto()) { ?>
              <div class="texto" style="font-size: 15px;"><i class="las la-exclamation-circle" style="color: #ffbb33"></i> Para sua maior segurança, solicite alteração de dados através do <b>Chat</b> ou pelo nosso <b>WhatsApp</b>.</div>
            <? } ?>
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
            <div class="conta-bloco-titulo">Preferência de atuação</div>
          </div>
          <div class="conta-bloco-content">
            <div class="campo-container cr-container" style="margin-bottom: 10px;">
              <label>Áreas de atuação</label><br>
              <label class="cr-lbl">
                <input type="checkbox" name="atuacao[]" value="planta" required data-parsley-required-message="Selecione pelo menos uma opção." <?=Tools::checked($user['atuacao_planta'], "1")?>>
                <i class="checkbox"></i>
                <span>Imóvel na planta</span>
              </label><br>
              <label class="cr-lbl">
                <input type="checkbox" name="atuacao[]" value="avulso" <?=Tools::checked($user['atuacao_avulso'], "1")?>>
                <i class="checkbox"></i>
                <span>Imóvel avulso</span>
              </label><br>
              <label class="cr-lbl">
                <input type="checkbox" name="atuacao[]" value="locacao" <?=Tools::checked($user['atuacao_locacao'], "1")?>>
                <i class="checkbox"></i>
                <span>Imóvel para locação</span>
              </label>
            </div>
            <div class="texto" style="font-size: 15px;"><i class="las la-exclamation-circle" style="color: #ffbb33"></i> Procure escolher somente a área de atuação que possui mais experiência para potencializar melhor as suas vendas.</div>

            <div class="campo-container cr-container regioes1" style="display: none; margin-top: 20px; margin-bottom: 0px;">
              <label>
                Regiões de atuação (Imóvel avulso e para locação)<br>
                <span style="font-weight: 400;">Selecione até 2 opções para atuação</span>
              </label><br>
              <? foreach ($regioesAtuacaoLista1 as $tipo1) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="regioes1[]" value="<?=$tipo1['id']?>" data-parsley-maxcheck="2" required data-parsley-required-message="Selecione pelo menos uma opção." <? if (in_array($tipo1['id'], $regioesAtuais)) { ?> checked <? } ?>>
                  <i class="checkbox"></i>
                  <span><b><?=$tipo1['codigo']?>:</b> <?=$tipo1['descricao']?></span>
                </label><br>
              <? } ?>
            </div>

            <div class="campo-container cr-container regioes2" style="display: none; margin-top: 20px; margin-bottom: 0px;">
              <label>
                Regiões de atuação (Imóvel na planta)<br>
                <span style="font-weight: 400;">Selecione até 2 opções para atuação</span>
              </label><br>
              <? foreach ($regioesAtuacaoLista2 as $tipo2) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="regioes2[]" value="<?=$tipo2['id']?>" data-parsley-maxcheck="2" required data-parsley-required-message="Selecione pelo menos uma opção." <? if (in_array($tipo2['id'], $regioesAtuais)) { ?> checked <? } ?>>
                  <i class="checkbox"></i>
                  <span><b><?=$tipo2['codigo']?>:</b> <?=$tipo2['descricao']?></span>
                </label><br>
              <? } ?>
            </div>
            
          </div>
        </div>
        
        <? if ($usuario->cadastroCompleto()) { ?>
          <div class="conta-bloco">
            <div class="conta-bloco-header">
              <div class="conta-bloco-titulo">Escolha seus dias e horários de trabalho</div>
            </div>
            <div class="conta-bloco-content">
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="domingo" data-parsley-required-message="Selecione ao menos um dia para visita" required <?=Tools::checked($user['domingo_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Domingo</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="domingo_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="domingo_inicio" id="domingo_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['domingo_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="domingo_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="domingo_fim" id="domingo_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['domingo_fim']?>" />
                </div>
              </div>
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="segunda" <?=Tools::checked($user['segunda_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Segunda-feira</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="segunda_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="segunda_inicio" id="segunda_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['segunda_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="segunda_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="segunda_fim" id="segunda_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['segunda_fim']?>" />
                </div>
              </div>
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="terca" <?=Tools::checked($user['terca_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Terça-feira</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="terca_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="terca_inicio" id="terca_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['terca_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="terca_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="terca_fim" id="terca_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['terca_fim']?>" />
                </div>
              </div>
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="quarta" <?=Tools::checked($user['quarta_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Quarta-feira</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="quarta_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="quarta_inicio" id="quarta_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['quarta_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="quarta_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="quarta_fim" id="quarta_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['quarta_fim']?>" />
                </div>
              </div>
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="quinta" <?=Tools::checked($user['quinta_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Quinta-feira</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="quinta_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="quinta_inicio" id="quinta_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['quinta_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="quinta_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="quinta_fim" id="quinta_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['quinta_fim']?>" />
                </div>
              </div>
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="sexta" <?=Tools::checked($user['sexta_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Sexta-feira</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="sexta_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="sexta_inicio" id="sexta_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['sexta_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="sexta_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="sexta_fim" id="sexta_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['sexta_fim']?>" />
                </div>
              </div>
              <div class="row dia-disponibilidade">
                <div class="grid-2-4 grid-m-4 grid-s-12">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="dias_trabalho[]" value="sabado" <?=Tools::checked($user['sabado_status'], "1")?> <?=Tools::checked($user['sabado_status'], "1")?>>
                      <i class="checkbox"></i>
                      <span>Sábado</span>
                    </label>
                  </div>
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="sabado_inicio">Horário inicial</label>
                  <input type="text" inputmode="numeric" name="sabado_inicio" id="sabado_inicio" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['sabado_inicio']?>" />
                </div>
                <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                  <label for="sabado_fim">Horário final</label>
                  <input type="text" inputmode="numeric" name="sabado_fim" id="sabado_fim" maxlength="255" class="campo timepicker" data-min="00:00" data-max="23:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$user['sabado_fim']?>" />
                </div>
              </div>
            </div>
          </div>
        <? } ?>

        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Fotos dos documentos</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="foto_doc_frente">Documento de identificação (RG ou CNH)<br> Frente do documento (Máx. 10Mb)</label>
                <input type="file" name="img[foto_doc_frente]" id="foto_doc_frente" class="campo file" data-parsley-maxfilesize="10" accept="image/*" data-parsley-trigger="change" />
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                <label for="foto_doc_verso">Documento de identificação (RG ou CNH)<br> Verso do documento (Máx. 10Mb)</label>
                <input type="file" name="img[foto_doc_verso]" id="foto_doc_verso" class="campo file" data-parsley-maxfilesize="10" accept="image/*" data-parsley-trigger="change" />
              </div>
              <div class="grid-12" style="margin-bottom: 20px;">
                <small>As fotos precisam estar nítidas e sem cortes!</small>
              </div>
              <div class="grid-6 grid-m-12 grid-s-12 campo-container" style="margin-bottom: 0px;">
                <label for="foto">Foto de perfil / Selfie (Máx. 10Mb)</label>
                <input type="file" name="img[foto]" id="foto" class="campo file" data-parsley-maxfilesize="10" accept="image/*" data-parsley-trigger="change" />
              </div>
              <div class="grid-12">
                <small>Escolha um fundo neutro para tirar a selfie e evite acessórios.</small>
              </div>
            </div>
          </div>
        </div>

        <? if ($usuario->cadastroCompleto()) { ?>
          <div class="conta-bloco">
            <div class="conta-bloco-header">
              <div class="conta-bloco-titulo">Dados bancários</div>
            </div>
            <div class="conta-bloco-content">
              <div class="texto">
                <p>Preencha os dados abaixo com as suas informações bancárias.</p>
              </div>
              <div class="row">
                <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                  <label for="banco">Banco *</label>
                  <input type="text" name="banco" id="banco" maxlength="255" class="campo" placeholder="Ex: Itaú" data-parsley-trigger="change" value="<?=$user['banco']?>" required />
                </div>
                <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                  <label for="agencia">Agência *</label>
                  <input type="text" name="agencia" id="agencia" maxlength="255" class="campo" placeholder="Informe sua agência" data-parsley-trigger="change" value="<?=$user['agencia']?>" required />
                </div>
                <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                  <label for="conta">Número da conta *</label>
                  <input type="text" name="conta" id="conta" maxlength="255" class="campo" placeholder="Informe o número da conta" data-parsley-trigger="change" value="<?=$user['conta']?>" required />
                </div>
                <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                  <label for="operacao">Operação</label>
                  <input type="text" name="operacao" id="operacao" maxlength="255" class="campo" placeholder="Informe a operação da conta" data-parsley-trigger="change" value="<?=$user['operacao']?>" />
                </div>
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="chave_pix">Chave PIX (CPF, Celular ou E-mail)</label>
                  <input type="text" name="chave_pix" id="chave_pix" maxlength="255" class="campo" placeholder="Informe sua chave pix" data-parsley-trigger="change" value="<?=$user['chave_pix']?>" />
                </div>
              </div>
              <div class="texto" style="font-size: 15px;">
                <b>* Não será aceita conta bancária de terceiros. O repasse de valores somente será feito para a conta do usuário cadastrado.</b><br>
                <b>* Ao final confira todos os seus dados antes de finalizar o seu cadastro.</b>
              </div>
            </div>
          </div>
        <? } ?>

        <? if ($usuario->cadastroCompleto()) { ?>
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
        <? } ?>
        
        <? if (!$usuario->cadastroCompleto()) { ?>
          <div class="row">
            <div class="grid-6 grid-m-12 grid-s-12 campo-container">
              <label for="como_conheceu">Como você conheceu a Impera Real? *</label>
              <select name="como_conheceu" id="como_conheceu" class="campo" data-parsley-trigger="change" required>
                <option value="" hidden>Selecione</option>
                <option value="Internet" <?= Tools::selected($user['como_conheceu'], "Internet") ?>>Internet</option>
                <option value="Instagram" <?= Tools::selected($user['como_conheceu'], "Instagram") ?>>Instagram</option>
                <option value="Facebook" <?= Tools::selected($user['como_conheceu'], "Facebook") ?>>Facebook</option>
                <option value="LinkedIn" <?= Tools::selected($user['como_conheceu'], "LinkedIn") ?>>LinkedIn</option>
                <option value="Outros" <?= Tools::selected($user['como_conheceu'], "Outros") ?>>Outros</option>
              </select>
              <i class="arrow"></i>
            </div>
          </div>
        <? } ?>

        <div class="conta-base-btns">
          <? if ($usuario->cadastroCompleto()) { ?>
            <button type="submit" id="atualizar" class="btn btn-sm btn-primario">Salvar Alterações</button>
          <? } else { ?>
            <button type="submit" id="atualizar" class="btn btn-sm btn-primario">Concluir Cadastro</button>
          <? } ?>
        </div>

      </form>

    </div>
    <!-- //CONTEÚDO -->

    <!-- Selfie -->
    <div class="modal" id="modal-selfie-creci">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-selfie-creci"></span>
        <div class="modal-header">
          <span class="modal-titulo">Selfie com CRECI</span>                
        </div>
        <div class="modal-body">
          <div class="texto">
            <p>Tire uma <b>selfie</b> segurando seu documento <b>CRECI</b> próximo ao seu rosto. A foto deve estar em boa qualidede, onde possamos ver seu rosto e a foto do documento.</p>
          </div>
          <div style="text-align: center;">
            <button type="button" class="btn btn-sm btn-primario modal-close" data-modal="modal-selfie-creci">Entendi</button>
          </div>
        </div>
      </div>
    </div>
    <!-- //Selfie -->

    <!-- FOOTER -->
    <? include(APP_PATH . '/corretor/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
