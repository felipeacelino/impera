<header class="conta-header">
  <div class="conta-header-infos">
    <span class="menu-btn-mobile" id="menu-btn-mobile"></span>
    <a href="<?=URL?>afiliado/inicio" title="<?=TITULO_PAGS?>" class="conta-header-logo"><img src="<?=LOGO_PRINCIPAL?>" alt="<?=TITULO_PAGS?>"></a>
    Área do afiliado
  </div>
  <nav class="conta-header-links">
    <a href="<?=URL?>" class="btn btn-sm btn-primario">Voltar para o portal <i class="las la-share"></i></a>
    <a href="<?=URL?>acoes/app/afiliado/logout.php" class="btn btn-sm btn-primario outline">Sair <i class="las la-sign-out-alt"></i></a>
  </nav>
</header>

<!-- MENU MOBILE -->
<? include(APP_PATH.'/afiliado/estrutura/menu_mobile.php'); ?>
