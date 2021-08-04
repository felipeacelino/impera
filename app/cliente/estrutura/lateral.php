<nav class="conta-lateral">
  <div class="conta-lateral-header">
    <a href="<?=URL?>cliente/meus-dados" class="conta-lateral-header-foto"><img
        src="<?=$user['foto_perfil']?>" alt="<?=$user['nome']?>"></a>
    <div class="conta-lateral-header-nome"><?=$user['nome']?></div>
  </div>
  <ul class="conta-lateral-menu">
    <li class="empty-item"></li>
    <li data-menu="inicio"><a href="<?=URL?>cliente/inicio"><i class="las la-home"></i> Início</a></li>
    <li data-menu="boletos"><a href="<?=URL?>cliente/boletos"><i class="las la-barcode"></i> Meus Boletos</a></li>
    <li data-menu="documentos"><a href="<?=URL?>cliente/documentos"><i class="las la-folder"></i> Documentos</a></li>
    <li data-menu="mensagens"><a href="<?=URL?>cliente/mensagens"><i class="las la-comment-alt"></i> Mensagens <?if($msgPendentes>0){?><span class="contador"><?=$msgPendentes?></span><?}?></a></li>
    <li data-menu="dados"><a href="<?=URL?>cliente/meus-dados"><i class="las la-user"></i> Meus dados</a></li>    
    <li data-menu="ajuda"><a href="<?=URL?>cliente/ajuda"><i class="las la-question-circle"></i> Me ajuda</a></li>
    <li><a href="<?=URL?>acoes/app/cliente/logout.php"><i class="las la-sign-out-alt"></i> Sair</a></li>
    <li class="empty-item"></li>
  </ul>
</nav>
