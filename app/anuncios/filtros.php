<div class="an-filtros-wrp">
  <form id="form-filtros" action="#" method="get" class="an-filtros form-validation" autocomplete="off">
    <div class="an-filtros-header">
      <span class="filtros-close"></span>
      <h2>Filtros</h2>
    </div>
    <div class="an-filtros-body">
      <div class="campo-container btn-group-filtros">
        <div class="btn-group btn-group-toggle">
          <label class="btn"><input type="radio" name="finalidade" value="venda" class="busca-finalidade" <? if(!isset($_GET['finalidade']) || $_GET['finalidade'] == "" || $_GET['finalidade'] == "venda"){?> checked <?}?>>Comprar</label>
          <label class="btn"><input type="radio" name="finalidade" value="aluguel" class="busca-finalidade" <?=Tools::checked($_GET['finalidade'], "aluguel")?>>Alugar</label>
        </div>
      </div>
      <div class="row">
        <div class="grid-6 grid-s-12 campo-container campo-icon">
          <select name="cidade" id="busca-cidade" class="campo select2" data-search="true" data-placeholder="Cidade" data-src-placeholder="Buscar cidade...">
            <option></option>
            <? foreach ($cidadesBusca as $cidadeBusca) { ?>
              <option value="<?=$cidadeBusca['id']?>" <?=Tools::selected($_GET['cidade'], $cidadeBusca['id'])?>><?=$cidadeBusca['titulo']?></option>
            <? } ?>
          </select>
          <label class="icon" for="busca-cidade"><i class="las la-map-marker"></i></label>
        </div>
        <div class="grid-6 grid-s-12 campo-container campo-icon">
          <select name="bairro" id="busca-bairro" class="campo select2" data-search="true" data-placeholder="Bairro" data-src-placeholder="Buscar bairro..."
          data-sync-url="<?=URL?>acoes/api/carrega_bairros_busca.php" 
          data-sync-input="#busca-cidade" 
          data-sync-param="cidade" 
          data-sync-value="<?=$_GET['bairro']?>"
          data-sync-option-value="id" 
          data-sync-option-text="titulo" 
          data-sync-placeholder="Bairro">
            <option></option>
          </select>
          <label class="icon" for="busca-bairro"><i class="las la-map-marker"></i></label>
        </div>
        <div class="grid-12 campo-container campo-icon icon-lg">
          <select name="tipo" id="busca-tipo" class="campo select2" data-placeholder="Tipo de imóvel">
            <option></option>
            <? foreach ($tiposBusca as $tipoBusca) { ?>
              <optgroup label="<?=$tipoBusca['titulo']?>">
                <? foreach ($tipoBusca['itens'] as $itemTipoBusca) { ?>
                  <option value="<?=$itemTipoBusca['id']?>" <?=Tools::selected($_GET['tipo'], $itemTipoBusca['id'])?>><?=$itemTipoBusca['titulo']?></option>
                <? } ?>
              </optgroup>
            <? } ?>
          </select>
          <label class="icon" for="busca-tipo"><i class="las la-home"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon busca-valor-venda-wrp">
          <select name="valor_venda" id="busca-valor-venda" class="campo select2" data-placeholder="Valor">
            <option></option>
            <? foreach ($filtrosValoresCompra as $valorK => $valorV) { ?>
              <option value="<?=$valorK?>" <?=Tools::selected($_GET['valor_venda'], $valorK)?>><?=$valorV?></option>
            <? } ?>
          </select>
          <label class="icon" for="busca-valor-venda"><i class="las la-dollar-sign"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon busca-valor-aluguel-wrp">
          <select name="valor_aluguel" id="busca-valor-aluguel" class="campo select2" data-placeholder="Valor">
            <option></option>
            <? foreach ($filtrosValoresAluguel as $valorK => $valorV) { ?>
              <option value="<?=$valorK?>" <?=Tools::selected($_GET['valor_aluguel'], $valorK)?>><?=$valorV?></option>
            <? } ?>
          </select>
          <label class="icon" for="busca-valor-aluguel"><i class="las la-dollar-sign"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon">
          <select name="valor_condominio_iptu" id="busca-valor-condominio-iptu" class="campo select2" data-placeholder="Cond. + IPTU">
            <option></option>
            <? foreach ($filtrosValoresCondominioIPTU as $valorK => $valorV) { ?>
              <option value="<?=$valorK?>" <?=Tools::selected($_GET['valor_condominio_iptu'], $valorK)?>><?=$valorV?></option>
            <? } ?>
          </select>
          <label class="icon" for="busca-valor-condominio-iptu"><i class="las la-dollar-sign"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon">
          <select name="area" id="busca-area" class="campo select2" data-placeholder="Área (m²)">
            <option></option>
            <? foreach ($filtrosAreas as $valorK => $valorV) { ?>
              <option value="<?=$valorK?>" <?=Tools::selected($_GET['area'], $valorK)?>><?=$valorV?></option>
            <? } ?>
          </select>
          <label class="icon" for="busca-area"><i class="las la-expand"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon icon-lg">
          <select name="quartos" id="busca-quartos" class="campo select2" data-placeholder="Quartos">
            <option></option>
            <option value="1" <?=Tools::selected($_GET['quartos'], "1")?>>1+ quartos</option>
            <option value="2" <?=Tools::selected($_GET['quartos'], "2")?>>2+ quartos</option>
            <option value="3" <?=Tools::selected($_GET['quartos'], "3")?>>3+ quartos</option>
            <option value="4" <?=Tools::selected($_GET['quartos'], "4")?>>4+ quartos</option>
            <option value="5" <?=Tools::selected($_GET['quartos'], "5")?>>5+ quartos</option>
          </select>
          <label class="icon" for="busca-quartos"><i class="las la-bed"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon icon-lg">
          <select name="banheiros" id="busca-banheiros" class="campo select2" data-placeholder="Banheiros">
            <option></option>
            <option value="1" <?=Tools::selected($_GET['banheiros'], "1")?>>1+ banheiros</option>
            <option value="2" <?=Tools::selected($_GET['banheiros'], "2")?>>2+ banheiros</option>
            <option value="3" <?=Tools::selected($_GET['banheiros'], "3")?>>3+ banheiros</option>
            <option value="4" <?=Tools::selected($_GET['banheiros'], "4")?>>4+ banheiros</option>
            <option value="5" <?=Tools::selected($_GET['banheiros'], "5")?>>5+ banheiros</option>
          </select>
          <label class="icon" for="busca-banheiros"><i class="las la-bath"></i></label>
        </div>
        <div class="grid-6 campo-container campo-icon icon-lg">
          <select name="vagas" id="busca-vagas" class="campo select2" data-placeholder="Vagas">
            <option></option>
            <option value="0" <?=Tools::selected($_GET['vagas'], "0")?>>Sem vaga</option>
            <option value="1" <?=Tools::selected($_GET['vagas'], "1")?>>1+ vagas</option>
            <option value="2" <?=Tools::selected($_GET['vagas'], "2")?>>2+ vagas</option>
            <option value="3" <?=Tools::selected($_GET['vagas'], "3")?>>3+ vagas</option>
            <option value="4" <?=Tools::selected($_GET['vagas'], "4")?>>4+ vagas</option>
            <option value="5" <?=Tools::selected($_GET['vagas'], "5")?>>5+ vagas</option>
          </select>
          <label class="icon" for="busca-vagas"><i class="las la-car"></i></label>
        </div>
        <div class="grid-12 filtros-divider"></div>
        <div class="grid-12">
          <div class="campo-container cr-container">
            <label class="an-filtros-lbl-sec" style="margin-bottom: 0px;">Características</label>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline mb-lg">
            <label class="campo-inline-lbl">Próximo ao metrô</label>
            <div class="btn-group btn-group-toggle">
              <label class="btn btn-sm"><input type="radio" name="proximo_metro" value="1" <?=Tools::checked($_GET['proximo_metro'], "1")?>>Sim</label>
              <label class="btn btn-sm"><input type="radio" name="proximo_metro" value="0" <? if(!isset($_GET['proximo_metro']) || $_GET['proximo_metro'] == "" || $_GET['proximo_metro'] == "0"){?> checked <?}?>>Tanto faz</label>
            </div>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline mb-lg">
            <label class="campo-inline-lbl">Próximo ao BRT</label>
            <div class="btn-group btn-group-toggle">
              <label class="btn btn-sm"><input type="radio" name="proximo_brt" value="1" <?=Tools::checked($_GET['proximo_brt'], "1")?>>Sim</label>
              <label class="btn btn-sm"><input type="radio" name="proximo_brt" value="0" <? if(!isset($_GET['proximo_brt']) || $_GET['proximo_brt'] == "" || $_GET['proximo_brt'] == "0"){?> checked <?}?>>Tanto faz</label>
            </div>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline mb-lg">
            <label class="campo-inline-lbl">Próximo ao trem</label>
            <div class="btn-group btn-group-toggle">
              <label class="btn btn-sm"><input type="radio" name="proximo_trem" value="1" <?=Tools::checked($_GET['proximo_trem'], "1")?>>Sim</label>
              <label class="btn btn-sm"><input type="radio" name="proximo_trem" value="0" <? if(!isset($_GET['proximo_trem']) || $_GET['proximo_trem'] == "" || $_GET['proximo_trem'] == "0"){?> checked <?}?>>Tanto faz</label>
            </div>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline mb-lg">
            <label class="campo-inline-lbl">Possui elevador</label>
            <div class="btn-group btn-group-toggle">
              <label class="btn btn-sm"><input type="radio" name="possui_elevador" value="1" <?=Tools::checked($_GET['possui_elevador'], "1")?>>Sim</label>
              <label class="btn btn-sm"><input type="radio" name="possui_elevador" value="0" <? if(!isset($_GET['possui_elevador']) || $_GET['possui_elevador'] == "" || $_GET['possui_elevador'] == "0"){?> checked <?}?>>Tanto faz</label>
            </div>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline mb-lg">
            <label class="campo-inline-lbl">Mobiliado</label>
            <div class="btn-group btn-group-toggle">
              <label class="btn btn-sm"><input type="radio" name="mobiliado" value="1" <?=Tools::checked($_GET['mobiliado'], "1")?>>Sim</label>
              <label class="btn btn-sm"><input type="radio" name="mobiliado" value="0" <? if(!isset($_GET['mobiliado']) || $_GET['mobiliado'] == "" || $_GET['mobiliado'] == "0"){?> checked <?}?>>Tanto faz</label>
            </div>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline mb-lg">
            <label class="campo-inline-lbl">Aceita pet</label>
            <div class="btn-group btn-group-toggle">
              <label class="btn btn-sm"><input type="radio" name="aceita_pet" value="1" <?=Tools::checked($_GET['aceita_pet'], "1")?>>Sim</label>
              <label class="btn btn-sm"><input type="radio" name="aceita_pet" value="0" <? if(!isset($_GET['aceita_pet']) || $_GET['aceita_pet'] == "" || $_GET['aceita_pet'] == "0"){?> checked <?}?>>Tanto faz</label>
            </div>
          </div>
        </div>
        <div class="grid-12">
          <div class="campo-container campo-inline">
            <label class="campo-inline-lbl">Sol</label>
            <div class="btn-group btn-group-toggle">
              <? foreach ($opcoesSol as $solK => $solV) { ?>
                <label class="btn btn-sm"><input type="radio" name="sol" value="<?=$solK?>" <?=Tools::checked($_GET['sol'], $solK)?>><?=$solV?></label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-6 grid-s-12">
          <div class="campo-container">
            <label>Orientação</label>
            <select name="orientacao" id="busca-orientacao" class="campo select2" data-placeholder="Selecione">
              <option></option>
              <? foreach ($opcoesOrientacoes as $orK => $orV) { ?>
                <option value="<?=$orK?>" <?=Tools::selected($_GET['orientacao'], $orK)?>><?=$orV?></option>
              <? } ?>
            </select>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-residencial"></div>
        <div class="grid-12 filtros-residencial">
          <div class="campo-container cr-container">
            <label class="an-filtros-lbl-sec">Cômodos</label>
            <div class="cr-lbl-flex">
              <? foreach ($comodosFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="comodos[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["comodos"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-residencial"></div>
        <div class="grid-12 filtros-residencial">
          <div class="campo-container cr-container">
            <label class="an-filtros-lbl-sec">Detalhes do imóvel</label>
            <div class="cr-lbl-flex">
              <? foreach ($caracteristicasFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="caracteristicas[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["caracteristicas"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-residencial"></div>
        <div class="grid-12 filtros-residencial">
          <div class="campo-container cr-container">
            <label class="an-filtros-lbl-sec">Detalhes do condomínio</label>
            <div class="cr-lbl-flex">
              <? foreach ($condominioFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="condominio[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["condominio"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-residencial"></div>
        <div class="grid-12 filtros-residencial">
          <div class="campo-container cr-container" style="margin-bottom: 0px;">
            <label class="an-filtros-lbl-sec">Mobílias e eletros</label>
            <div class="cr-lbl-flex">
              <? foreach ($mobiliasFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="mobilias[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["mobilias"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-comercial"></div>
        <div class="grid-12 filtros-comercial">
          <div class="campo-container cr-container" style="margin-bottom: 0px;">
            <label class="an-filtros-lbl-sec">Comodidades e serviços</label>
            <div class="cr-lbl-flex">
              <? foreach ($comodidadesFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="comodidades[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["comodidades"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-comercial"></div>
        <div class="grid-12 filtros-comercial">
          <div class="campo-container cr-container" style="margin-bottom: 0px;">
            <label class="an-filtros-lbl-sec">Segurança</label>
            <div class="cr-lbl-flex">
              <? foreach ($segurancaFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="seguranca[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["seguranca"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-comercial"></div>
        <div class="grid-12 filtros-comercial">
          <div class="campo-container cr-container" style="margin-bottom: 0px;">
            <label class="an-filtros-lbl-sec">Lazer e esporte</label>
            <div class="cr-lbl-flex">
              <? foreach ($lazerFiltro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="lazer[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["lazer"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="grid-12 filtros-divider filtros-comercial"></div>
        <div class="grid-12 filtros-comercial">
          <div class="campo-container cr-container" style="margin-bottom: 0px;">
            <label class="an-filtros-lbl-sec">Cômodos</label>
            <div class="cr-lbl-flex">
              <? foreach ($comodos2Filtro as $filtroItem) { ?>
                <label class="cr-lbl">
                  <input type="checkbox" name="comodos2[]" value="<?=$filtroItem['id']?>" <? if (in_array($filtroItem['id'], $_GET["comodos2"])) {?> checked
                  <? } ?>>
                  <i class="checkbox"></i>
                  <span><?=$filtroItem['titulo']?></span>
                </label>
              <? } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="an-filtros-footer">
      <a href="<?=URL?>imoveis" class="btn">Limpar</a>
      <button type="submit" class="btn btn-primario">Aplicar</button>
    </div>
  </form>
</div>
