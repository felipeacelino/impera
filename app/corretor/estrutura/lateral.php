<nav class="conta-lateral">
  <div class="conta-lateral-header">
    <a href="<?=URL?>corretor/meus-dados" class="conta-lateral-header-foto"><img
        src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></a>
    <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
    <!-- <div class="conta-lateral-header-email"><?=$user['email']?></div> -->
    <!-- <div class="conta-lateral-header-email">Proprietário</div> -->
  </div>
  <ul class="conta-lateral-menu">
    <li class="empty-item"></li>
    <li data-menu="inicio"><a href="<?=URL?>corretor/inicio"><i class="las la-tachometer-alt"></i> Início</a></li>
    <li data-menu="imoveis"><a href="<?=URL?>corretor/imoveis"><i class="las la-home"></i> Meus imóveis</a></li>
    <li data-menu="agendamentos"><a href="<?=URL?>corretor/agendamentos"><i class="las la-calendar-check"></i> Agendamentos</a></li>
    <li data-menu="pagamentos"><a href="<?=URL?>corretor/pagamentos"><i class="las la-wallet"></i> Minhas Comissões</a></li>
    <li data-menu="documentos"><a href="<?=URL?>corretor/documentos"><i class="las la-folder"></i> Documentos</a></li>
    <li data-menu="mensagens"><a href="<?=URL?>corretor/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
    <li data-menu="dados"><a href="<?=URL?>corretor/meus-dados"><i class="las la-user"></i> Meus dados</a></li>
    <li data-menu="ajuda"><a href="<?=URL?>corretor/ajuda"><i class="las la-question-circle"></i> Me ajuda</a></li>
    <li><a href="<?=URL?>acoes/app/corretor/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>
    <li class="empty-item"></li>
  </ul>
</nav>
