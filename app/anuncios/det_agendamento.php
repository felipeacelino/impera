<!-- MODAL RESTRITO -->
<div class="modal" id="modal-det-agendamento-restrito">
  <div class="modal-wrap modal-sm">
    <span class="modal-btn-close modal-close" data-modal="modal-det-agendamento-restrito"></span>
    <div class="modal-header">
      <span class="modal-titulo">Agendar Visita</span>                
    </div>
    <div class="modal-body">
      <div class="texto center">
        <p>Para agendar uma visita neste imóvel é necessário que você possua uma conta no site.</p>
        <p>Escolha uma das opções abaixo.</p>
      </div>
      <div>
        <a href="<?=URL?>cliente/criar-conta?retorno=<?=$_SERVER['REQUEST_URI']?>" class="btn btn-full btn-primario" style="margin-bottom: 10px;">Sou Cliente</a>
        <a href="<?=URL?>corretor/criar-conta?retorno=<?=$_SERVER['REQUEST_URI']?>" class="btn btn-full btn-primario">Sou Corretor</a>
      </div>
    </div>
  </div>
</div>
<!-- //MODAL RESTRITO -->

<!-- MODAL INTERESSE -->
<div class="modal" id="modal-det-interesse">
  <div class="modal-wrap modal-sm">
    <span class="modal-btn-close modal-close" data-modal="modal-det-interesse"></span>
    <div class="modal-header">
      <span class="modal-titulo">Interesse neste imóvel</span>                
    </div>
    <div class="modal-body">
      <div class="texto center"><p>Como deseja prosseguir?</p></div>
      <div>
        <? if (isset($_SESSION['user']['corretor']['id']) && $_SESSION['user']['corretor']['id'] != "") { ?>
          <button class="btn btn-full btn-primario show-modal-agendamento-corretor" data-corretor="<?=$user['id']?>" style="margin-bottom: 10px;">Agendar Visita</button>
        <? } else if (isset($_SESSION['user']['cliente']['id']) && $_SESSION['user']['cliente']['id'] != "") { ?>
          <button class="btn btn-full btn-primario show-modal-agendamento-cliente" data-cliente="<?=$user['id']?>" data-nome="<?=$user['nome']?>" data-email="<?=$user['email']?>" data-telefone="<?=$user['telefone']?>" style="margin-bottom: 10px;">Agendar Visita</button>
        <? } else { ?>
          <button class="btn btn-full btn-primario modal-open" data-modal="modal-det-agendamento-restrito" style="margin-bottom: 10px;">Agendar Visita</button>
        <? } ?>
        <a href="<?=URL?>contato?assunto=Dúvida imóvel (<?=$anuncio['codigo']?>)&msg=Olá! Gostaria de mais informações sobre o imóvel (<?=$anuncio['codigo']?>)." class="btn btn-full">Tirar Dúvidas</a>
      </div>
    </div>
  </div>
</div>
<!-- //MODAL INTERESSE -->

<!-- MODAL AGENDAMENTO -->
<div class="modal" id="modal-det-agendamento">
  <div class="modal-wrap">
    <span class="modal-btn-close modal-close" data-modal="modal-det-agendamento"></span>
    <div class="modal-header">
      <span class="modal-titulo">Agendar Visita</span>                
    </div>
    <div class="modal-body">
      <form id="form-agendamento" action="<?=URL?>acoes/app/anuncios/agendar_visita.php" method="post" class="form-validation">
        <div class="row">
          <div class="grid-12 campo-container">
            <label for="ag-nome">Nome completo do cliente</label>
            <input type="text" name="nome" id="ag-nome" maxlength="255" class="campo" placeholder="Digite o nome completo do cliente" data-parsley-fullname data-parsley-trigger="change" required />
          </div>
          <div class="grid-6 grid-s-12 campo-container">
            <label for="ag-email">E-mail do cliente</label>
            <input type="email" name="email" id="ag-email" maxlength="255" class="campo" placeholder="Digite o e-mail do cliente" data-parsley-trigger="change" />
          </div>
          <div class="grid-6 grid-s-12 campo-container">
            <label for="ag-telefone">Telefone do cliente</label>
            <input type="tel" name="telefone" id="ag-telefone" maxlength="255" class="campo telefone" placeholder="Digite o telefone do cliente" data-parsley-trigger="change" />
          </div>
        </div>
        <div class="row flex-center">
          <div class="grid-9 grid-m-12 grid-s-12 campo-container campo-container-center">
            <label>Tipo de visita</label><br>
            <div class="btn-group btn-group-toggle full">
              <? foreach ($tiposVisita as $tipoVisitaK => $tipoVisitaV) { ?>
                <label class="btn" data-tippy-content="<?=$tipoVisitaV['descricao']?>" data-tippy-placement="bottom"><input type="radio" name="tipo" value="<?=$tipoVisitaK?>" <?=Tools::checked($tipoVisitaK, "presencial")?>><?=$tipoVisitaV['titulo']?></label>
              <? } ?>
            </div>
          </div>
        </div>
        <div class="campo-container radio-box-container">
          <label>Selecione o dia</label>
          <ul class="carrosel radio-box-list radio-box-days">
            <? foreach ($dataVisitas as $diaKey => $diaVisita) { ?>
              <? $disabled = $diaVisita['disabled'] == "1" ? "disabled" : ""; ?>
              <li class="radio-box-item <?=$disabled?>">
                <input type="radio" name="data" id="ag-data-<?=$diaVisita['data']?>" value="<?=$diaVisita['data']?>" <?=Tools::checked($diaVisita['checked'], "1")?> data-horarios="<?=implode(",", $diaVisita['horarios'])?>" <?=$disabled?> data-parsley-required-message="Selecione uma data" required>
                <label for="ag-data-<?=$diaVisita['data']?>" class="radio-box-wrp">
                  <div class="radio-box-sub"><?=$diaVisita['dia_semana']?></div>
                  <div class="radio-box-dest"><?=$diaVisita['dia']?></div>
                  <div class="radio-box-sub"><?=$diaVisita['mes']?></div>
                </label>
              </li>
            <? } ?>         
          </ul>
        </div>
        <div class="campo-container radio-box-container">
          <label>Selecione o horário</label>
          <ul class="carrosel radio-box-list radio-box-time"></ul>
        </div>
        <!-- <div class="recaptcha-container">
          <div class="recaptcha-el" data-form="form-agendamento" data-key="<?=RECAPTCHA_KEY?>"></div>
        </div> -->
        <div class="btn-container">
          <input type="hidden" name="residente" value="<?=$anuncio['residente']?>">
          <input type="hidden" name="anuncio_id" value="<?=$idAnuncio?>">
          <input type="hidden" name="corretor_id" id="ag-corretor">
          <input type="hidden" name="cliente_id" id="ag-cliente">
          <button type="submit" class="btn btn-primario btn-agendar">Agendar Visita</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- //MODAL AGENDAMENTO -->
