<? include(ACOES_APP_PATH."/anuncios/agendamento.php"); ?>

<div class="anuncio-lateral-wrp">
  <div class="anuncio-det-bloco anuncio-lateral" data-id-img="reserva-mobile">
    <div class="anuncio-det-bloco-body anuncio-lateral-valores">

      <? if ($anuncio['finalidade'] == "aluguel" || $anuncio['finalidade'] == "venda-aluguel") { ?>
        <div class="anuncio-lateral-valores-lbl">Valor do aluguel</div>
        <div class="anuncio-lateral-valores-n">R$ <?=Tools::formataMoeda($anuncio['valor_aluguel'])?> <!-- <span>/mês</span> --></div>
      <? } ?>

      <? if ($anuncio['finalidade'] == "venda" || $anuncio['finalidade'] == "venda-aluguel") { ?>
        <? $mt = $anuncio['finalidade'] == "venda-aluguel" ? 'style="margin-top: 10px;"' : ""; ?>
        <div class="anuncio-lateral-valores-lbl" <?=$mt?>>Valor de venda</div>
        <div class="anuncio-lateral-valores-n">R$ <?=Tools::formataMoeda($anuncio['valor_venda'])?></div>
      <? } ?>

      <? if ($anuncio['finalidade'] == "aluguel" || $anuncio['finalidade'] == "venda-aluguel") { ?>
        <ul class="anuncio-lateral-valores-list">
          <? if ($anuncio['valor_condominio'] > 0) { ?>
            <li><span>Condomínio <a href="#" class="modal-open" data-modal="modal-condominio"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_condominio'])?></span></li>
          <? } ?>
          <? if ($anuncio['valor_iptu'] > 0) { ?>
            <li><span>IPTU <a href="#" class="modal-open" data-modal="modal-iptu"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_iptu'])?></span></li>
          <? } ?>
          <? if ($anuncio['valor_seguro_incendio'] > 0) { ?>
            <li><span>Seguro Incêndio <a href="#" class="modal-open" data-modal="modal-seguro-incendio"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_seguro_incendio'])?></span></li>
          <? } ?>
          <? if ($anuncio['valor_taxa_servico'] > 0) { ?>
            <li><span>Taxa de serviço <a href="#" class="modal-open" data-modal="modal-taxa-servico"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_taxa_servico'])?></span></li>
          <? } ?>
          <li class="dest"><span>Total</span><span>R$ <?=Tools::formataMoeda($anuncio['total_aluguel'])?></span></li>
        </ul>
        <div class="anuncio-lateral-valores-renda">
          <i class="las la-piggy-bank"></i>
          <span>Renda sugerida:<br> A partir de <b>R$ <?=Tools::formataMoeda($anuncio['renda_ideal'])?></b></span>
        </div>
      <? } ?>

      <? if ($anuncio['finalidade'] == "venda") { ?>
        <ul class="anuncio-lateral-valores-list">
          <? if ($anuncio['valor_condominio'] > 0) { ?>
            <li><span>Condomínio <a href="#" class="modal-open" data-modal="modal-condominio"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_condominio'])?></span></li>
          <? } ?>
          <? if ($anuncio['valor_iptu'] > 0) { ?>
            <li><span>IPTU <a href="#" class="modal-open" data-modal="modal-iptu"><i class="las la-exclamation-circle"></i></a></span><span>R$ <?=Tools::formataMoeda($anuncio['valor_iptu'])?></span></li>
          <? } ?>
        </ul>
      <? } ?>

    </div>
    <div class="anuncio-det-bloco-body anuncio-lateral-btns">
      <small>Agende sua visita gratuita</small>
      <? if (isset($_SESSION['user']['corretor']['id']) && $_SESSION['user']['corretor']['id'] != "") { ?>
        <button class="btn btn-primario show-modal-agendamento-corretor" data-corretor="<?=$user['id']?>">Agendar Visita</button>
      <? } else if (isset($_SESSION['user']['cliente']['id']) && $_SESSION['user']['cliente']['id'] != "") { ?>
        <button class="btn btn-primario show-modal-agendamento-cliente" data-cliente="<?=$user['id']?>" data-nome="<?=$user['nome']?>" data-email="<?=$user['email']?>" data-telefone="<?=$user['telefone']?>">Agendar Visita</button>
      <? } else { ?>
        <button class="btn btn-primario modal-open" data-modal="modal-det-agendamento-restrito">Agendar Visita</button>
      <? } ?>
      <button class="btn">Mais Informações</button>
      <div class="anuncio-det-share">
        <div class="share">
          <div class="share-text">Compartilhar</div>
          <div class="share-buttons">
            <a href="#" target="_blank" rel="nofollow" class="share-button facebook" title="Compartilhar no Facebook"><i class="fab fa-facebook-square"></i></a>
            <a href="#" target="_blank" rel="nofollow" class="share-button twitter" title="Compartilhar no Twitter"><i class="fab fa-twitter-square"></i></a>
            <a href="#" target="_blank" rel="nofollow" class="share-button whatsapp" title="Compartilhar no WhatsApp"><i class="fab fa-whatsapp-square"></i></a>
            <a href="#" class="share-button copy-link" title="Copiar link"><i class="fas fa-link fa-flip-horizontal"></i></a>
            <a href="#" class="share-button share-link btn-mbl-share" data-title="<?=$anuncio['titulo']?>" data-text="Clique no link para visualizar o imóvel." data-url="<?=URL?>slug"><i class="fas fa-share-alt"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Âncora Fixa (Mobile) -->
<div class="anuncio-det-anchor">
  <a href="#reserva-mobile-sec" class="btn btn-primario"><i class="las la-calendar-check"></i> Agendar Visita</a>
</div>
