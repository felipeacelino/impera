<!-- MODAL RESTRITO -->
<div class="modal" id="modal-user-restrito">
  <div class="modal-wrap modal-sm">
    <span class="modal-btn-close modal-close" data-modal="modal-user-restrito"></span>
    <div class="modal-header">
      <span class="modal-titulo">Área Restrita</span>                
    </div>
    <div class="modal-body">
      <div class="texto center">
        <p>Escolha um tipo de conta:</p>
      </div>
      <div>
        <a href="" class="btn btn-full btn-primario btn-cliente" style="margin-bottom: 10px;" data-logado="<?=$_SESSION['user']['cliente']['id']?>">Sou Cliente</a>
        <a href="" class="btn btn-full btn-primario btn-proprietario" style="margin-bottom: 10px;" data-logado="<?=$_SESSION['user']['proprietario']['id']?>">Sou Proprietário</a>
        <a href="" class="btn btn-full btn-primario btn-corretor" style="margin-bottom: 10px;" data-logado="<?=$_SESSION['user']['corretor']['id']?>">Sou Corretor</a>
        <a href="" class="btn btn-full btn-primario btn-afiliado" data-logado="<?=$_SESSION['user']['afiliado']['id']?>">Sou Afiliado</a>
      </div>
    </div>
  </div>
</div>
<!-- //MODAL RESTRITO -->

<!-- CONTATOS LATERAIS -->
<div class="contatos-laterais">
  <a href="https://web.whatsapp.com/send?phone=55<?=Tools::somenteNumeros(WHATSAPP)?>&text=Olá <?=TITULO_PAGS?>!" target="_blank" class="hide-mobile" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
  <a href="https://api.whatsapp.com/send?phone=55<?=Tools::somenteNumeros(WHATSAPP)?>&text=Olá <?=TITULO_PAGS?>!" class="hide-desktop hide-tablet" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
</div>

<!-- VOLTAR AO TOPO -->
<div class="gotop"></div>

<!-- LOADING -->
<div class="loading">
  <div class="loading-wrap">
    <div class="loader">Aguarde...</div>
  </div>
</div>

<!-- ALERTA -->
<div class="modal" id="modal-alert">
  <div class="modal-wrap modal-sm">
    <span class="modal-btn-close modal-close" data-modal="modal-alert"></span>
    <div class="modal-header">
      <span class="modal-titulo" id="alert-titulo"></span>          
    </div>
    <div class="modal-body">
      <div class="modal-alert-icon">
        <i class="fas fa-check-circle"></i>
        <i class="fas fa-exclamation-circle"></i>
        <i class="fas fa-times-circle"></i>
      </div>
      <p class="texto" id="alert-texto"></p>
      <div class="modal-btn center">	
        <button type="button" class="btn btn-sm modal-close" data-modal="modal-alert">Fechar</button>
      </div>  
    </div>
  </div>
</div>
<!-- //ALERTA -->

<!-- POPUP DE COOKIES -->
<? include(PATH_ATUAL.'/popup_cookies/popup.php'); ?>

<span id="infos" data-url-base="<?=URL?>"></span>

<!-- SCRIPTS -->
<script src="https://www.google.com/recaptcha/api.js?onload=initRecaptcha&render=explicit" async defer></script>
<script src="<?=URL_APP?>assets/dist/js/plugins.min.js?v=100"></script>
<script src="<?=URL_APP?>assets/dist/js/script.min.js?v=101"></script>
