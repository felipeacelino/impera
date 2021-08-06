<nav class="conta-lateral">
  <div class="conta-lateral-header">
    <a href="<?=URL?>corretor/meus-dados" class="conta-lateral-header-foto"><img
        src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></a>
    <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
    <!-- <div class="conta-lateral-header-email"><?=$user['email']?></div> -->
    <!-- <div class="conta-lateral-header-email">Proprietário</div> -->
    <div class="conta-lateral-btn"><a href="#" class="btn btn-xs btn-secundario modal-open" data-modal="modal-link-afiliado">Link de afiliados</a></div>
  </div>
  <ul class="conta-lateral-menu">
    <li class="empty-item"></li>
    <li data-menu="inicio"><a href="<?=URL?>corretor/inicio"><i class="las la-tachometer-alt"></i> <span>Início</span></a></li>
    <li data-menu="imoveis"><a href="<?=URL?>corretor/imoveis"><i class="las la-home"></i> <span>Meus imóveis</span></a></li>
    <li data-menu="agendamentos"><a href="<?=URL?>corretor/agendamentos"><i class="las la-calendar-check"></i> <span>Agendamentos</span></a></li>
    <li data-menu="agendamentos2"><a href="<?=URL?>corretor/agendamentos-imobiliaria"><i class="las la-calendar-check"></i> <span>Agendamentos imobiliária</span></a></li>
    <li data-menu="pagamentos"><a href="<?=URL?>corretor/pagamentos"><i class="las la-wallet"></i> <span>Minhas Comissões</span></a></li>
    <li data-menu="clientes"><a href="<?=URL?>corretor/clientes"><i class="las la-user-friends"></i> <span>Clientes</span></a></li>
    <li data-menu="leads"><a href="<?=URL?>corretor/leads"><i class="las la-phone"></i> <span>Contatos (Leads)</span></a></li>
    <li data-menu="mensagens"><a href="<?=URL?>corretor/mensagens"><i class="las la-comment-alt"></i> <span>Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></span></a></li>
    <li data-menu="dados"><a href="<?=URL?>corretor/meus-dados"><i class="las la-user"></i> <span>Meus dados</span></a></li>
    <li data-menu="ajuda"><a href="<?=URL?>corretor/ajuda"><i class="las la-question-circle"></i> <span>Me ajuda</span></a></li>
    <li><a href="<?=URL?>acoes/app/corretor/logout.php"><i class="las la-sign-out-alt"></i> <span>Sair</span></a></li>
    <li class="empty-item"></li>
  </ul>
</nav>
