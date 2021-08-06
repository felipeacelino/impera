<div class="cd-dropdown-wrapper">
  <nav class="cd-dropdown cd-dropdown-user">
    <ul class="cd-dropdown-content">

      <!-- HEADER -->
      <li class="cd-dropdown-header cd-dropdown-header-user">
        <div class="conta-lateral-header">
          <figure class="conta-lateral-header-foto"><img src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></figure>
          <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
          <div class="conta-lateral-btn"><a href="#" class="btn btn-xs btn-secundario modal-open" data-modal="modal-link-afiliado">Link de afiliados</a></div>
        </div>
      </li>
      <!-- //HEADER -->

      <li><a href="<?=URL?>afiliado/inicio"><i class="las la-home"></i> Início</a></li>
      <li><a href="<?=URL?>afiliado/pagamentos"><i class="las la-wallet"></i> Minhas Comissões</a></li>
      <li><a href="<?=URL?>afiliado/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
      <li><a href="<?=URL?>afiliado/meus-dados"><i class="las la-user"></i> Meus dados</a></li>      
      <li><a href="#"><i class="las la-question-circle"></i> Me ajuda</a></li>
      <li><a href="<?=URL?>"><i class="las la-share"></i> Voltar para o portal</a></li>
      <li><a href="<?=URL?>acoes/app/afiliado/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>

    </ul> <!-- .cd-dropdown-content -->
  </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->
