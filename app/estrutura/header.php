<? include(ACOES_APP_PATH."/gerais/header.php"); ?>
<header class="header-full">
	<div class="container">
		<div class="header-content">

      <!-- MENU MOBILIE BUTTON -->
      <span class="menu-btn-mobile" id="menu-btn-mobile"></span>

      <!-- LOGO -->
      <a href="<?=URL?>" title="<?=TITULO_PAGS?>" class="header-logo colored-logo">
        <img src="<?=LOGO_PRINCIPAL?>" alt="<?=TITULO_PAGS?>">
      </a>
      <a href="<?=URL?>" title="<?=TITULO_PAGS?>" class="header-logo white-logo custswing">
        <img src="<?=LOGO_FOOTER?>" alt="<?=TITULO_PAGS?>">
      </a>

      <!-- DIREITA -->
      <div class="header-direita">

        <!-- MENU LATERAL -->
        <? include('menu_lateral.php'); ?>			

      </div>
      <!-- //DIREITA -->

    </div>
  </div>
</header>

<!-- MENU MOBILE -->
<? include('menu_mobile.php'); ?>
