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

      <li><a href="<?=URL?>proprietario/inicio"><i class="las la-home"></i> Meus imóveis</a></li>
      <li><a href="<?=URL?>proprietario/documentos"><i class="las la-folder"></i> Documentos</a></li>
      <li><a href="<?=URL?>proprietario/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
      <li><a href="<?=URL?>proprietario/meus-dados"><i class="las la-user"></i> Meus dados</a></li>
      <li><a href="<?=URL?>proprietario/ajuda"><i class="las la-question-circle"></i> Me ajuda</a></li>
      <li><a href="<?=URL?>"><i class="las la-share"></i> Voltar para o portal</a></li>
      <li><a href="<?=URL?>acoes/app/proprietario/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>

    </ul> <!-- .cd-dropdown-content -->
  </nav> <!-- .cd-dropdown -->
</div> <!-- .cd-dropdown-wrapper -->
