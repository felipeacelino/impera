 <? include ("".ACOES_ADMIN_PATH."/geral/avisos.php"); ?>
 <!-- top navigation -->
 <div class="top_nav navbar-fixed-top">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fas fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">

        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?=NOME_USUARIO_ADMIN; ?>
            <span class=" fas fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li>
              <a href="<?=URL_ADMIN; ?>geral/meus_dados/<?=TOKEN; ?>/edit">Meus dados</a>
            </li>
            <li>
              <a href="<?=URL_ADMIN; ?>geral/alertas/<?=TOKEN; ?>/insert"><span>Deixar aviso</span></a>
            </li>
            <li>
              <a href="<?=URL; ?>acoes/admin/geral/logout.php"><i class="fas fa-sign-out-alt"></i>Sair</a>
            </li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="far fa-bell"></i>

            <? if($total_registros_avisos > 0){ ?>
              <span class="badge bg-orange"><?=$total_registros_avisos; ?></span>
            <? } ?>

          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <? if($total_registros_avisos > 0){ ?>
              <? foreach($result_avisos as $avisos_topo){ ?>
                <li>
                  <a href="<?=URL_ADMIN; ?>geral/alertas/<?=TOKEN; ?>/view">
                    <span>
                      <span>De: <?=$avisos_topo['nome']; ?></span>
                      <span class="time"><?=Tools::formataData($avisos_topo['data_cad']); ?></span>
                    </span>
                    <span class="message">
                      <?=Tools::limitarTexto($avisos_topo['mensagem'],200); ?>
                    </span>
                  </a>
                </li>
              <? } ?>
            <? } else { ?>
              <li>
                <div class="text-center">                  
                  <span class="message">Nenhum aviso</span>
              </li>
            <? } ?>  
            <li>
              <div class="text-center">
                <a href="<?=URL_ADMIN; ?>geral/alertas/<?=TOKEN; ?>/view">
                  <strong>Ver todos os avisos</strong>
                  <i class="fas fa-angle-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
