<nav class="conta-lateral">
  <div class="conta-lateral-header">
    <a href="<?=URL?>proprietario/meus-dados" class="conta-lateral-header-foto"><img
        src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></a>
    <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
    <!-- <div class="conta-lateral-header-email"><?=$user['email']?></div> -->
    <!-- <div class="conta-lateral-header-email">Proprietário</div> -->
  </div>
  <ul class="conta-lateral-menu">
    <li class="empty-item"></li>
    <li data-menu="imoveis"><a href="<?=URL?>proprietario/inicio"><i class="las la-home"></i> Meus imóveis</a></li>
    <li data-menu="documentos"><a href="<?=URL?>proprietario/documentos"><i class="las la-folder"></i> Documentos</a></li>
    <li data-menu="mensagens"><a href="<?=URL?>proprietario/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
    <li data-menu="dados"><a href="<?=URL?>proprietario/meus-dados"><i class="las la-user"></i> Meus dados</a></li>
    <li data-menu="ajuda"><a href="<?=URL?>proprietario/ajuda"><i class="las la-question-circle"></i> Me ajuda</a></li>
    <li><a href="<?=URL?>acoes/app/proprietario/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>
    <li class="empty-item"></li>
  </ul>
</nav>
