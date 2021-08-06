<nav class="conta-lateral">
  <div class="conta-lateral-header">
    <a href="<?=URL?>afiliado/meus-dados" class="conta-lateral-header-foto"><img src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></a>
    <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
    <div class="conta-lateral-btn"><a href="#" class="btn btn-xs btn-secundario modal-open" data-modal="modal-link-afiliado">Link de afiliados</a></div>
  </div>
  <ul class="conta-lateral-menu">
    <li class="empty-item"></li>
    <li data-menu="inicio"><a href="<?=URL?>afiliado/inicio"><i class="las la-home"></i> Início</a></li>
    <li data-menu="pagamentos"><a href="<?=URL?>afiliado/pagamentos"><i class="las la-wallet"></i> <span>Minhas Comissões</span></a></li>
    <li data-menu="mensagens"><a href="<?=URL?>afiliado/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
    <li data-menu="dados"><a href="<?=URL?>afiliado/meus-dados"><i class="las la-user"></i> Meus dados</a></li>    
    <li data-menu="ajuda"><a href="#"><i class="las la-question-circle"></i> Me ajuda</a></li>
    <li><a href="<?=URL?>acoes/app/afiliado/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>
    <li class="empty-item"></li>
  </ul>
</nav>
