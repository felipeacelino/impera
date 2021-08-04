<? include(ACOES_APP_PATH."/gerais/busca.php"); ?>

<section class="secao secao-busca">
  <div class="container">

    <div class="grid-12 busca-infos" data-aos="fade-down" data-aos-offset="0">
      <h1><?=$tituloBusca?></h1>
      <h2><?=$textoBusca?></h2>
    </div>
    
    <!-- FORMULÁRIO -->
    <form id="form-busca" action="<?=URL?>imoveis" method="get" class="grid-12 busca-form form-validation" autocomplete="off" data-aos="fade-up" data-aos-offset="0">
      <div class="form-busca-inner">
        <div class="campo-container btn-group-busca">
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
        </div>
        <div class="row">
          <div class="grid-6 grid-s-12 campo-container campo-icon icon-lg">
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
          <div class="grid-6 grid-s-12">
            <div class="row">
              <div class="grid-6 campo-container campo-icon busca-valor-venda-wrp">
                <select name="valor_venda" id="busca-valor-venda" class="campo select2" data-placeholder="Valor" data-dropdown-class="dp-busca-valores">
                  <option></option>
                  <? foreach ($filtrosValoresCompra as $valorK => $valorV) { ?>
                    <option value="<?=$valorK?>" <?=Tools::selected($_GET['valor_venda'], $valorK)?>><?=$valorV?></option>
                  <? } ?>
                </select>
                <label class="icon" for="busca-valor-venda"><i class="las la-dollar-sign"></i></label>
              </div>
              <div class="grid-6 campo-container campo-icon busca-valor-aluguel-wrp">
                <select name="valor_aluguel" id="busca-valor-aluguel" class="campo select2" data-placeholder="Valor" data-dropdown-class="dp-busca-valores">
                  <option></option>
                  <? foreach ($filtrosValoresAluguel as $valorK => $valorV) { ?>
                    <option value="<?=$valorK?>" <?=Tools::selected($_GET['valor_aluguel'], $valorK)?>><?=$valorV?></option>
                  <? } ?>
                </select>
                <label class="icon" for="busca-valor-aluguel"><i class="las la-dollar-sign"></i></label>
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
            </div>            
          </div>
        </div>
        <div class="busca-btn">
          <button type="submit" class="btn btn-primario">Buscar Imóveis</button>
        </div>
      </div>
    </form>
    <!-- //FORMULÁRIO -->

  </div>
</section>
