<div class="anuncio-det-atributos">
  <ul class="row anuncio-det-atributos-lista">
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-home"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Tipo de imóvel</h2>
        <h3><?=$anuncio['tipo_item']?></h3>
      </div>
    </li>
    <? if ($anuncio['andar'] > 0) { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-building"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Andar do imóvel</h2>
        <h3><?=$anuncio['andar']?>º andar</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['area'] > 0) { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-expand"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Área</h2>
        <h3><?=$anuncio['area']?> m²</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['quartos'] > 0) { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-bed"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Quartos</h2>
        <h3><?=$anuncio['quartos']?> quarto(s)</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['banheiros'] > 0) { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-bath"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Banheiros</h2>
        <h3><?=$anuncio['banheiros']?> banheiro(s)</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['vagas'] > 0) { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-car"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Vagas</h2>
        <h3><?=$anuncio['vagas']?> vaga(s)</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['tipo'] == "Residencial") { ?>
    <? $mobiliadoClass = $anuncio['mobiliado'] == "1" ? "" : "disabled"; ?>
    <? $mobiliadoText = $anuncio['mobiliado'] == "1" ? "Sim" : "Não"; ?>
    <li class="anuncio-det-atributos-item <?=$mobiliadoClass?>">
      <div class="anuncio-det-atributos-icon"><i class="las la-couch"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Mobiliado</h2>
        <h3><?=$mobiliadoText?></h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['possui_elevador'] == "1") { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-sort-numeric-up-alt"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Elevador</h2>
        <h3>Sim</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['proximo_metro'] == "1") { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-subway"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Próximo ao metrô</h2>
        <h3>Sim</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['proximo_brt'] == "1") { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-bus"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Próximo ao BRT</h2>
        <h3>Sim</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['proximo_trem'] == "1") { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-train"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Próximo ao trem</h2>
        <h3>Sim</h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['sol'] != "") { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-sun"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Sol</h2>
        <h3><?=$opcoesSol[$anuncio['sol']]?></h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['orientacao'] != "") { ?>
    <li class="anuncio-det-atributos-item">
      <div class="anuncio-det-atributos-icon"><i class="las la-arrows-alt-h"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Orientação</h2>
        <h3><?=$opcoesOrientacoes[$anuncio['orientacao']]?></h3>
      </div>
    </li>
    <? } ?>
    <? if ($anuncio['tipo'] == "Residencial") { ?>
    <? $aceitaPetClass = $anuncio['aceita_pet'] == "1" ? "" : "disabled"; ?>
    <? $aceitaPetoText = $anuncio['aceita_pet'] == "1" ? "Sim" : "Não"; ?>
    <li class="anuncio-det-atributos-item <?=$aceitaPetClass?>">
      <div class="anuncio-det-atributos-icon"><i class="las la-paw"></i></div>
      <div class="anuncio-det-atributos-infos">
        <h2>Aceita pet</h2>
        <h3><?=$aceitaPetoText?></h3>
      </div>
    </li>
    <? } ?>
  </ul>
</div>
