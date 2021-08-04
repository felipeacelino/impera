<div class="cd-dropdown-wrapper">
  <nav class="cd-dropdown cd-dropdown-user">
    <ul class="cd-dropdown-content">

      <!-- HEADER -->
      <li class="cd-dropdown-header cd-dropdown-header-user">
        <div class="conta-lateral-header">
          <figure class="conta-lateral-header-foto"><img src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></figure>
          <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
        </div>
      </li>
      <!-- //HEADER -->

      <li><a href="<?=URL?>corretor/inicio"><i class="las la-tachometer-alt"></i> Início</a></li>
      <li><a href="<?=URL?>corretor/imoveis"><i class="las la-home"></i> Meus imóveis</a></li>
      <li><a href="<?=URL?>corretor/agendamentos"><i class="las la-calendar-check"></i> Agendamentos</a></li>
      <li><a href="<?=URL?>corretor/pagamentos"><i class="las la-wallet"></i> Minhas Comissões</a></li>
      <li><a href="<?=URL?>corretor/documentos"><i class="las la-folder"></i> Documentos</a></li>
      <li><a href="<?=URL?>corretor/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
      <li><a href="<?=URL?>corretor/meus-dados"><i class="las la-user"></i> Meus dados</a></li>
      <li><a href="<?=URL?>corretor/ajuda"><i class="las la-question-circle"></i> Me ajuda</a></li>
      <li><a href="<?=URL?>"><i class="las la-share"></i> Voltar para o portal</a></li>
      <li><a href="<?=URL?>acoes/app/corretor/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>

    </ul> <!-- .cd-dropdown-content -->
  </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->
