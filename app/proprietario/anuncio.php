<? include(ACOES_APP_PATH."/proprietario/restrito.php"); ?>
<? include(ACOES_APP_PATH."/proprietario/anuncio_pag.php"); ?>
<?php
$titulo_pagina = $titulo." - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="imoveis">

  <!-- HEADER -->
  <? include(APP_PATH.'/proprietario/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/proprietario/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo"><?=$titulo?></h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>proprietario/inicio" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      </div>

      <form id="form-anuncio" action="<?=URL?>acoes/app/proprietario/anuncio.php" method="post" class="form-validation form-anuncio" enctype="multipart/form-data">

        <!-- Finalidade -->
        <div class="row">
          <div class="grid-4 grid-m-6 grid-s-12 campo-container">
            <label>Finalidade *</label>
            <select name="finalidade" id="finalidade" class="campo campo-finalidade select2 ver_end_dup" data-placeholder="Selecione" required>
              <option></option>
              <option value="venda" <?=Tools::selected($anuncio['finalidade'], "venda")?>>Venda</option>
              <option value="aluguel" <?=Tools::selected($anuncio['finalidade'], "aluguel")?>>Aluguel</option>
              <!-- <option value="venda-aluguel" <?=Tools::selected($anuncio['finalidade'], "venda-aluguel")?>>Venda e aluguel</option> -->
            </select>
          </div>
        </div>

        <!-- Localização -->
        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Localização</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <div class="grid-3 grid-m-6 grid-s-8 campo-container">
                <label for="cep">CEP *</label>
                <div class="campo-loading" title="Aguarde...">
                  <i class="fas fa-circle-notch fa-spin"></i>
                </div>
                <input type="text" name="cep" id="cep" maxlength="255" class="campo cep cep_completa_cad ver_end_dup" placeholder="Digite o CEP" data-parsley-trigger="change" data-url="<?=URL?>acoes/api/completa_endereco_cadastro.php" value="<?=$anuncio['cep']?>" required />
              </div>
            </div>
            <? $showEnderecos = $anuncio['bairro_id'] != "" ? "" : 'style="display: none;"'; ?>
            <div class="campos-endereco" <?=$showEnderecos?>>
              <div class="row">
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="logradouro">Endereço *</label>
                  <input type="text" name="logradouro" id="logradouro" maxlength="255" class="campo ver_end_dup" placeholder="Digite o endereço" data-parsley-trigger="change" value="<?=$anuncio['logradouro']?>" required />
                </div>
                <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                  <label for="numero">Número * <span class="campo-icon-help" data-tippy-content="Não se preocupe, o número e complemento do seu imóvel não ficarão visíveis no anúncio."><i class="las la-exclamation-circle"></i></span></label>
                  <input type="text" name="numero" id="numero" maxlength="255" class="campo ver_end_dup" placeholder="Digite o número" data-parsley-trigger="change" value="<?=$anuncio['numero']?>" required />
                </div>
                <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                  <label for="complemento">Complemento</label>
                  <input type="text" name="complemento" id="complemento" maxlength="255" class="campo ver_end_dup" placeholder="Digite o complemento" data-parsley-trigger="change" value="<?=$anuncio['complemento']?>" />
                </div>
                <div class="grid-4 grid-m-12 grid-s-12 campo-container">
                  <label for="cidade_id">Cidade *</label>
                  <select name="cidade_id" id="cidade_id" class="campo select2 ver_end_dup" data-search="true" required data-placeholder="Selecione" data-src-placeholder="Buscar cidade...">
                    <option></option>
                    <? foreach ($cidadesCad as $cidade) { ?>
                      <option value="<?=$cidade['id']?>" <?=Tools::selected($anuncio['cidade_id'], $cidade['id'])?>><?=$cidade['titulo']?></option>
                    <? } ?>
                  </select>
                </div>
                <div class="grid-4 grid-m-12 grid-s-12 campo-container">
                  <label for="bairro_id">Bairro *</label>
                  <select name="bairro_id" id="bairro_id" class="campo select2 ver_end_dup" required data-search="true" data-placeholder="Selecione" data-src-placeholder="Buscar bairro..."
                  data-sync-url="<?=URL?>acoes/api/carrega_bairros.php" 
                  data-sync-input="#cidade_id" 
                  data-sync-param="cidade" 
                  data-sync-value="<?=$anuncio['bairro_id']?>"
                  data-sync-option-value="id" 
                  data-sync-option-text="titulo" 
                  data-sync-placeholder="Bairro">
                    <option></option>
                  </select>
                </div>
                <div class="grid-4 grid-m-12 grid-s-12 campo-container">
                  <label for="regiao_id">Região</label>
                  <select name="regiao_id" id="regiao_id" class="campo select2" data-placeholder="Selecione">
                    <option></option>
                    <option value="0" <?=Tools::selected($anuncio['regiao_id'], "0")?>>Nenhuma</option>
                    <? foreach ($regioesCad as $regiao) { ?>
                      <option value="<?=$regiao['id']?>" <?=Tools::selected($anuncio['regiao_id'], $regiao['id'])?>><?=$regiao['titulo']?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <div class="campo-container" style="margin-bottom: 5px;">
                <label>Mapa *</label>
                <div class="texto">Clique no botão abaixo para localizar o imóvel no mapa. É possível arrastar o marcador para ajustar a localização.</div>
                <a href="#" class="btn btn-sm btn-mapa"><i class="fas fa-map-marker-alt"></i> &nbsp; Localizar no mapa</a>
                <div>
                  <input type="text" name="lat" id="lat" class="campo-lat" data-parsley-trigger="change" data-parsley-required-message="É necessário adicionar o marcador no local do imóvel no mapa" required value="<?=$anuncio['lat']?>" />
                  <input type="hidden" name="lng" id="lng" value="<?=$anuncio['lng']?>" />
                  <div id="form-mapa-anuncio" class="campo-mapa"></div>
                </div>
              </div>
            </div>
            <input type="hidden" name="bairro" id="bairro_nome" value="<?=$anuncio['bairro']?>">
            <input type="hidden" name="cidade" id="cidade_nome" value="<?=$anuncio['cidade']?>">
            <input type="hidden" name="estado" id="estado_nome" value="<?=$anuncio['estado']?>">
            <input type="hidden" name="estado_id" id="estado_id" value="<?=$anuncio['estado_id']?>">
          </div>
        </div>
        <!-- //Localização -->

        <!-- Informações -->
        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Informações do imóvel</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <!-- <div class="grid-4 grid-m-6 grid-s-12 campo-container">
                <label>Finalidade *</label>
                <select name="finalidade" id="finalidade" class="campo campo-finalidade select2" data-placeholder="Selecione" required>
                  <option value="venda" <?=Tools::selected($anuncio['finalidade'], "venda")?>>Venda</option>
                  <option value="aluguel" <?=Tools::selected($anuncio['finalidade'], "aluguel")?>>Aluguel</option>
                </select>
              </div> -->
              <div class="grid-4 grid-m-6 grid-s-12 campo-container">
                <label for="tipo_id">Tipo de imóvel *</label>
                <select name="tipo_id" id="tipo_id" class="campo select2" data-placeholder="Selecione" required>
                  <option></option>
                  <? foreach ($tiposCad as $tipo) { ?>
                    <optgroup label="<?=$tipo['titulo']?>">
                      <? foreach ($tipo['itens'] as $itemTipo) { ?>
                        <option value="<?=$itemTipo['id']?>" <?=Tools::selected($anuncio['tipo_id'], $itemTipo['id'])?>><?=$itemTipo['titulo']?></option>
                      <? } ?>
                    </optgroup>
                  <? } ?>
                </select>
                <input type="hidden" name="tipo" id="tipo_nome" value="<?=$anuncio['tipo']?>">
              </div>
            </div>
            <div class="row">
              <div class="grid-8 grid-m-12 grid-s-12 campo-container">
                <label for="titulo">Título do anúncio *</label>
                <input type="text" name="titulo" id="titulo" maxlength="255" class="campo" data-parsley-trigger="change" value="<?=$anuncio['titulo']?>" required />
              </div>
            </div>
            <div class="row">
              <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                <label for="area">Área do imóvel (m²)</label>
                <input type="number" inputmode="numeric" name="area" id="area" maxlength="255" class="campo" min="0" data-parsley-trigger="change" value="<?=$anuncio['area']?>" />
              </div>
              <div class="grid-3 grid-m-6 grid-s-6 campo-container">
                <label for="quartos">Quartos *</label>
                <input type="number" inputmode="numeric" name="quartos" id="quartos" maxlength="255" class="campo" min="0" data-parsley-trigger="change" value="<?=$anuncio['quartos']?>" required />
              </div>
              <div class="grid-3 grid-m-6 grid-s-6 campo-container">
                <label for="banheiros">Banheiros *</label>
                <input type="number" inputmode="numeric" name="banheiros" id="banheiros" maxlength="255" class="campo" min="0" data-parsley-trigger="change" value="<?=$anuncio['banheiros']?>" required />
              </div>
              <div class="grid-3 grid-m-6 grid-s-6 campo-container">
                <label for="vagas">Vagas *</label>
                <input type="number" inputmode="numeric" name="vagas" id="vagas" maxlength="255" class="campo" min="0" data-parsley-trigger="change" value="<?=$anuncio['vagas']?>" required />
              </div>
              <div class="grid-3 grid-m-6 grid-s-6 campo-container">
                <label for="andar">Andar</label>
                <input type="number" inputmode="numeric" name="andar" id="andar" maxlength="255" class="campo" min="0" data-parsley-trigger="change" value="<?=$anuncio['andar']?>" />
              </div>    
              <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                <label for="sol">Sol</label>
                <select name="sol" id="sol" class="campo select2" data-placeholder="Selecione">
                  <option></option>
                  <? foreach ($opcoesSol as $solK => $solV) { ?>
                    <option value="<?=$solK?>" <?=Tools::selected($anuncio['sol'], $solK)?>><?=$solV?></option>
                  <? } ?>
                </select>
              </div>
              <div class="grid-3 grid-m-6 grid-s-12 campo-container">
                <label for="orientacao">Orientação</label>
                <select name="orientacao" id="orientacao" class="campo select2" data-placeholder="Selecione">
                  <option></option>
                  <? foreach ($opcoesOrientacoes as $orK => $orV) { ?>
                    <option value="<?=$orK?>" <?=Tools::selected($anuncio['orientacao'], $orK)?>><?=$orV?></option>
                  <? } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- //Informações -->

        <!-- Valores -->
        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Valores</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <div class="grid-4 grid-m-6 grid-s-12 campo-container campo-venda">
                <label for="valor_venda">Valor de venda * (<span class="campo-valor-txt reais" data-campo="#valor_venda">Reais</span>)</label>
                <input type="text" inputmode="numeric" name="valor_venda" id="valor_venda" maxlength="20" class="campo valor" data-parsley-trigger="change" placeholder="R$ 0,00" data-required required <?if($acao=="update" && $anuncio['valor_venda'] != "0"){?> value="<?=Tools::formataMoeda($anuncio['valor_venda'])?>" <?}?> />
              </div>
              <div class="grid-4 grid-m-6 grid-s-12 campo-container campo-aluguel">
                <label for="valor_aluguel">Valor do aluguel * (<span class="campo-valor-txt reais" data-campo="#valor_aluguel">Reais</span>)</label>
                <input type="text" inputmode="numeric" name="valor_aluguel" id="valor_aluguel" maxlength="20" class="campo valor" data-parsley-trigger="change" placeholder="R$ 0,00" data-required required <?if($acao=="update" && $anuncio['valor_aluguel'] != "0"){?> value="<?=Tools::formataMoeda($anuncio['valor_aluguel'])?>" <?}?> />
              </div>
              <div class="grid-4 grid-m-6 grid-s-12 campo-container">
                <label for="valor_condominio">Valor do condomínio (<span class="campo-valor-txt reais" data-campo="#valor_condominio">Reais</span>)</label>
                <input type="text" inputmode="numeric" name="valor_condominio" id="valor_condominio" maxlength="20" class="campo valor" data-parsley-trigger="change" placeholder="R$ 0,00" <?if($acao=="update" && $anuncio['valor_condominio'] != "0"){?> value="<?=Tools::formataMoeda($anuncio['valor_condominio'])?>" <?}?> />
              </div>
              <div class="grid-4 grid-m-6 grid-s-12 campo-container">
                <label for="valor_iptu">Valor do IPTU (Mensal) <span class="campo-icon-help" data-tippy-content="Para calcular o valor mensal do <b>IPTU</b>, basta dividir o valor total por <b>12</b>."><i class="las la-exclamation-circle"></i></span></label>
                <input type="text" inputmode="numeric" name="valor_iptu" id="valor_iptu" maxlength="20" class="campo valor" data-parsley-trigger="change" placeholder="R$ 0,00" <?if($acao=="update" && $anuncio['valor_iptu'] != "0"){?> value="<?=Tools::formataMoeda($anuncio['valor_iptu'])?>" <?}?> />
              </div>
            </div>
          </div>
        </div>
        <!-- //Valores -->

        <!-- Características -->
        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Características</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="mobiliado" value="1" <?=Tools::checked($anuncio['mobiliado'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Mobiliado</span>
                  </label>
                </div>
              </div>
              <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="possui_elevador" value="1" <?=Tools::checked($anuncio['possui_elevador'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Possui elevador</span>
                  </label>
                </div>
              </div>
              <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="proximo_metro" value="1" <?=Tools::checked($anuncio['proximo_metro'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Próximo ao metrô</span>
                  </label>
                </div>
              </div>
              <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="proximo_brt" value="1" <?=Tools::checked($anuncio['proximo_brt'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Próximo ao BRT</span>
                  </label>
                </div>
              </div>
              <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="proximo_trem" value="1" <?=Tools::checked($anuncio['proximo_trem'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Próximo ao trem</span>
                  </label>
                </div>
              </div>
              <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="aceita_pet" value="1" <?=Tools::checked($anuncio['aceita_pet'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Aceita pet</span>
                  </label>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- //Características -->
        
        <!-- Cômodos -->
        <div class="conta-bloco campos-residencial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Cômodos</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($comodosCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="comodos[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $comodosAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Cômodos -->

        <!-- Detalhes do imóvel -->
        <div class="conta-bloco campos-residencial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Detalhes do imóvel</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($caracteristicasCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="caracteristicas[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $caracteristicasAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Detalhes do imóvel -->

        <!-- Detalhes do condomínio -->
        <div class="conta-bloco campos-residencial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Detalhes do condomínio</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($condominioCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="condominio[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $condominioAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Detalhes do condomínio -->

        <!-- Mobílias e eletros -->
        <div class="conta-bloco campos-residencial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Mobílias e eletros</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($mobiliasCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="mobilias[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $mobiliasAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Mobílias e eletros -->

        <!-- Comodidades -->
        <div class="conta-bloco campos-comercial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Comodidades e serviços</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($comodidadesCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="comodidades[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $comodidadesAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Comodidades -->

        <!-- Segurança -->
        <div class="conta-bloco campos-comercial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Segurança</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($segurancaCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="seguranca[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $segurancaAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Segurança -->

        <!-- Lazer -->
        <div class="conta-bloco campos-comercial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Lazer e esporte</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($lazerCad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="lazer[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $lazerAtuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Lazer -->

        <!-- Cômodos (Comercial) -->
        <div class="conta-bloco campos-comercial">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Cômodos</div>
          </div>
          <div class="conta-bloco-content">
            <div class="row">
              <? foreach ($comodos2Cad as $item) { ?>
                <div class="grid-3 grid-m-4 grid-s-12 campo-caract">
                  <div class="campo-container cr-container">
                    <label class="cr-lbl">
                      <input type="checkbox" name="comodos2[]" value="<?=$item['id']?>" <? if (in_array($item['id'], $comodos2Atuais)) {?> checked <? } ?>>
                      <i class="checkbox"></i>
                      <span><?=$item['titulo']?></span>
                    </label>
                  </div>
                </div>
              <? } ?>
            </div>  
          </div>
        </div>
        <!-- //Cômodos (Comercial) -->

        <!-- Disponibilidade visitas -->
        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Disponibilidade para visitas</div>
          </div>
          <div class="conta-bloco-content">
            <div class="texto"><p>Selecione os dias da semana e horários em que o imóvel ficará <b>disponível para receber visitas</b>.</p></div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="domingo" data-parsley-required-message="Selecione ao menos um dia para visita" required <?=Tools::checked($anuncio['domingo_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Domingo</span>
                  </label>
                </div>
              </div>
              <? $anuncio['domingo_inicio'] = $anuncio['domingo_inicio'] != "" ? $anuncio['domingo_inicio'] : "09:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="domingo_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="domingo_inicio" id="domingo_inicio" maxlength="255" class="campo timepicker" data-min="09:00" data-max="13:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['domingo_inicio']?>" />
              </div>
              <? $anuncio['domingo_fim'] = $anuncio['domingo_fim'] != "" ? $anuncio['domingo_inicio'] : "13:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="domingo_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="domingo_fim" id="domingo_fim" maxlength="255" class="campo timepicker" data-min="09:00" data-max="13:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['domingo_fim']?>" />
              </div>
            </div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="segunda" <?=Tools::checked($anuncio['segunda_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Segunda-feira</span>
                  </label>
                </div>
              </div>
              <? $anuncio['segunda_inicio'] = $anuncio['segunda_inicio'] != "" ? $anuncio['segunda_inicio'] : "08:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="segunda_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="segunda_inicio" id="segunda_inicio" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['segunda_inicio']?>" />
              </div>
              <? $anuncio['segunda_fim'] = $anuncio['segunda_fim'] != "" ? $anuncio['segunda_fim'] : "18:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="segunda_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="segunda_fim" id="segunda_fim" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['segunda_fim']?>" />
              </div>
            </div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="terca" <?=Tools::checked($anuncio['terca_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Terça-feira</span>
                  </label>
                </div>
              </div>
              <? $anuncio['terca_inicio'] = $anuncio['terca_inicio'] != "" ? $anuncio['terca_inicio'] : "08:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="terca_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="terca_inicio" id="terca_inicio" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['terca_inicio']?>" />
              </div>
              <? $anuncio['terca_fim'] = $anuncio['terca_fim'] != "" ? $anuncio['terca_fim'] : "18:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="terca_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="terca_fim" id="terca_fim" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['terca_fim']?>" />
              </div>
            </div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="quarta" <?=Tools::checked($anuncio['quarta_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Quarta-feira</span>
                  </label>
                </div>
              </div>
              <? $anuncio['quarta_inicio'] = $anuncio['quarta_inicio'] != "" ? $anuncio['quarta_inicio'] : "08:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="quarta_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="quarta_inicio" id="quarta_inicio" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['quarta_inicio']?>" />
              </div>
              <? $anuncio['quarta_fim'] = $anuncio['quarta_fim'] != "" ? $anuncio['quarta_fim'] : "18:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="quarta_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="quarta_fim" id="quarta_fim" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['quarta_fim']?>" />
              </div>
            </div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="quinta" <?=Tools::checked($anuncio['quinta_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Quinta-feira</span>
                  </label>
                </div>
              </div>
              <? $anuncio['quinta_inicio'] = $anuncio['quinta_inicio'] != "" ? $anuncio['quinta_inicio'] : "08:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="quinta_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="quinta_inicio" id="quinta_inicio" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['quinta_inicio']?>" />
              </div>
              <? $anuncio['quinta_fim'] = $anuncio['quinta_fim'] != "" ? $anuncio['quinta_fim'] : "18:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="quinta_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="quinta_fim" id="quinta_fim" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['quinta_fim']?>" />
              </div>
            </div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="sexta" <?=Tools::checked($anuncio['sexta_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Sexta-feira</span>
                  </label>
                </div>
              </div>
              <? $anuncio['sexta_inicio'] = $anuncio['sexta_inicio'] != "" ? $anuncio['sexta_inicio'] : "08:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="sexta_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="sexta_inicio" id="sexta_inicio" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['sexta_inicio']?>" />
              </div>
              <? $anuncio['sexta_fim'] = $anuncio['sexta_fim'] != "" ? $anuncio['sexta_fim'] : "18:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="sexta_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="sexta_fim" id="sexta_fim" maxlength="255" class="campo timepicker" data-min="08:00" data-max="18:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['sexta_fim']?>" />
              </div>
            </div>
            <div class="row dia-disponibilidade">
              <div class="grid-2-4 grid-m-4 grid-s-12">
                <div class="campo-container cr-container">
                  <label class="cr-lbl">
                    <input type="checkbox" name="dias_visita[]" value="sabado" <?=Tools::checked($anuncio['sabado_status'], "1")?> <?=Tools::checked($anuncio['sabado_status'], "1")?>>
                    <i class="checkbox"></i>
                    <span>Sábado</span>
                  </label>
                </div>
              </div>
              <? $anuncio['sabado_inicio'] = $anuncio['sabado_inicio'] != "" ? $anuncio['sabado_inicio'] : "09:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="sabado_inicio">Horário inicial</label>
                <input type="text" inputmode="numeric" name="sabado_inicio" id="sabado_inicio" maxlength="255" class="campo timepicker" data-min="09:00" data-max="16:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['sabado_inicio']?>" />
              </div>
              <? $anuncio['sabado_fim'] = $anuncio['sabado_fim'] != "" ? $anuncio['sabado_fim'] : "16:00"; ?>
              <div class="grid-3 grid-m-4 grid-s-6 campo-container">
                <label for="sabado_fim">Horário final</label>
                <input type="text" inputmode="numeric" name="sabado_fim" id="sabado_fim" maxlength="255" class="campo timepicker" data-min="09:00" data-max="16:00" placeholder="00:00" data-parsley-trigger="change" readonly required value="<?=$anuncio['sabado_fim']?>" />
              </div>
            </div>
            <div class="bl-dest-campo">
              <div class="row">
                <div class="grid-12 campo-container" style="margin-bottom: 5px;">
                  <label for="residente">Atualmente está residindo neste imóvel?</label>
                </div>
                <div class="grid-2 grid-m-6 grid-s-12 campo-container" style="margin-bottom: 0px;">
                  <select name="residente" id="residente" class="campo select2" data-placeholder="Selecione" required>
                    <option></option>
                    <option value="1" <?=Tools::selected($anuncio['residente'], "1")?>>Sim</option>
                    <option value="0" <?=Tools::selected($anuncio['residente'], "0")?>>Não</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- //Disponibilidade visitas -->

        <!-- Fidelidade -->
        <div class="conta-bloco">
          <div class="conta-bloco-header">
            <div class="conta-bloco-titulo">Fidelidade</div>
          </div>
          <div class="conta-bloco-content">
            <div class="texto">
              <p>Marque a opção abaixo caso este imóvel tenha exclusividade com a <b>Impera Real</b>.</p>
              <p>Para mais informações, acesse a página <a href="<?=URL?>proprietario/ajuda" target="_blank">Me Ajuda</a>, onde você poderá ver mais detalhes sobre as taxas e outras informações importantes.</p>
            </div>
            <div class="campo-container cr-container" style="margin-bottom: 0px;">
              <label class="cr-lbl">
                <input type="checkbox" name="exclusivo" value="1" <?=Tools::checked($anuncio['exclusivo'], "1")?>>
                <i class="checkbox"></i>
                <span style="font-weight: 600;">Desejo que meu imóvel seja anunciado exclusivamente na Impera Real</span>
              </label>
            </div>
          </div>
        </div>
        <!-- //Fidelidade -->

        <div class="conta-base-btns">
          <? if ($acao == "update") { ?>
            <input type="hidden" name="id" value="<?=$anuncio['id']?>">
            <input type="hidden" id="retorno_success" name="retorno_success" value="<?=URL?>proprietario/inicio/<?=$paramRetorno?>">
          <? } else { ?>
            <input type="hidden" id="retorno_success" name="retorno_success" value="<?=URL?>proprietario/anuncio_fotos">
          <? } ?>
          <button type="submit" id="cadastrar" class="btn btn-sm btn-primario"><?=$botao?></button>
        </div>
        <input type="hidden" name="acao" value="<?=$acao?>">
      </form>

    </div>
    <!-- //CONTEÚDO -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/proprietario/estrutura/footer.php'); ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=MAPS_API?>"></script>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
