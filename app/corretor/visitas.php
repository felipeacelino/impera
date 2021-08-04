<? include(ACOES_APP_PATH."/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH."/corretor/visitas.php"); ?>
<?php
$titulo_pagina = "Visitas do imóvel - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="imoveis">

  <!-- HEADER -->
  <? include(APP_PATH.'/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Imóvel (<?=$anuncio['codigo']?>) <i class="fas fa-chevron-right"></i> Visitas
        </h1>
        <div class="conta-topo-btns">
          <a href="<?=URL?>corretor/imoveis" class="btn btn-sm btn-primario"><i class="fas fa-angle-left"></i> Voltar</a>
        </div>
      </div>

      <div class="conta-topo">
        <h2 class="conta-titulo">Próximas visitas</h2>
      </div>

      <? if ($numVisitas > 0) { ?>
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th>Nome</th>
                  <!-- <th>E-mail</th> -->
                  <th width="160px">Telefone</th>
                  <th width="120px">Data</th>
                  <th width="100px">Horário</th>
                  <th width="120px">Tipo</th>
                  <th width="150px">Status</th>
                  <th width="120px"></th>
                </tr>
              </thead>
              <tbody>
                <? foreach ($visitasLista as $visita) { ?>
                  <tr>
                    <td><b><?=Tools::limitarTexto($visita['nome'], 50)?></b></td>
                    <!-- <td><?=$visita['email']?></td> -->
                    <td><?=$visita['telefone']?></td>
                    <td><?=Tools::formataData($visita['data'])?></td>
                    <td><?=$visita['horario']?>h</td>
                    <td>
                      <span class="conta-status <?=$tiposVisita[$visita['tipo']]['class']?>"><?=$tiposVisita[$visita['tipo']]['titulo']?></span>
                    </td>
                    <td>
                      <span class="conta-status <?=$statusVisitas[$visita['status']]['class']?>"><?=$statusVisitas[$visita['status']]['titulo']?></span>
                    </td>
                    <td>
                      <? if ($anuncio['residente'] == "1") { ?>
                        <div class="dropdown">
                          <a href="#" class="btn btn-xs btn-terciario dropdown-toggle"><i class="fas fa-caret-down"></i>Opções</a>
                          <div class="dropdown-menu right">
                            <? if ($visita['status'] != "0" && $visita['status'] != "1" && $visita['status'] != "3") { ?>
                              <a href="#" class="dropdown-item btn-confirm-vis" data-id="<?=$visita['id']?>"><i class="fas fa-check"></i>Confirmar</a>
                            <? } ?>
                            <? if ($visita['status'] != "0" && $visita['status'] != "3") { ?>
                            <a href="#" class="dropdown-item btn-confirm" data-id="<?=$visita['id']?>"><i class="fas fa-calendar"></i>Reagendar</a>
                            <? } ?>
                          </div>
                        </div>
                      <? } ?>
                    </td>
                  </tr>
                <? } ?>
              </tbody>
            </table>
            <!-- //Tabela -->
          </div>
        </div>
      <? } else { ?>
        <!-- sem registros -->
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <div class="conta-empty texto">
              <p>Não há visitas agendadas para este imóvel.</p>
            </div>
          </div>
        </div>
        <!-- sem registros -->
      <? } ?>

      <div class="conta-topo">
        <h2 class="conta-titulo">Histórico de visitas</h2>
      </div>
      
      <? if ($numVisitasAntigas > 0) { ?>
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th>Nome</th>
                  <!-- <th>E-mail</th> -->
                  <th width="160px">Telefone</th>
                  <th width="120px">Data</th>
                  <th width="100px">Horário</th>
                  <th width="120px">Tipo</th>
                  <th width="150px">Status</th>
                </tr>
              </thead>
              <tbody>
                <? foreach ($visitasAntigasLista as $visita) { ?>
                  <tr>
                    <td><b><?=Tools::limitarTexto($visita['nome'], 50)?></b></td>
                    <!-- <td><?=$visita['email']?></td> -->
                    <td><?=$visita['telefone']?></td>
                    <td><?=Tools::formataData($visita['data'])?></td>
                    <td><?=$visita['horario']?>h</td>
                    <td>
                      <span class="conta-status <?=$tiposVisita[$visita['tipo']]['class']?>"><?=$tiposVisita[$visita['tipo']]['titulo']?></span>
                    </td>
                    <td>
                      <span class="conta-status <?=$statusVisitas[$visita['status']]['class']?>"><?=$statusVisitas[$visita['status']]['titulo']?></span>
                    </td>
                  </tr>
                <? } ?>
              </tbody>
            </table>
            <!-- //Tabela -->
          </div>
        </div>
      <? } else { ?>
        <!-- sem registros -->
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <div class="conta-empty texto">
              <p>Não há visitas no histórico deste imóvel.</p>
            </div>
          </div>
        </div>
        <!-- sem registros -->
      <? } ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- Alerta confirmação -->
    <div class="modal warning" id="modal-confirm">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-confirm"></span>
        <div class="modal-header">
          <span class="modal-titulo">Reagendar</span>     
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <p class="texto">Deseja solicitar o reagendamento para esta visita?</p>
          <div class="modal-btn left">	
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm">Cancelar</button>
          </div>  
          <div class="modal-btn right">	
            <form id="form-reagenda-visita" action="<?=URL?>acoes/app/corretor/visitas.php" method="post">
              <input type="hidden" name="acao" value="reagendar">
              <input type="hidden" name="id_visita" id="id_remove" required>
              <button type="submit" class="btn btn-sm btn-primario">Reagendar</button>
            </form>
          </div>  
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação -->

    <!-- Alerta confirmação 2 -->
    <div class="modal warning" id="modal-confirm2">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-confirm2"></span>
        <div class="modal-header">
          <span class="modal-titulo">Confirmar</span>     
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <p class="texto">Deseja confirmar esta visita?</p>
          <div class="modal-btn left">	
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm2">Cancelar</button>
          </div>  
          <div class="modal-btn right">	
            <form id="form-confirmar-visita" action="<?=URL?>acoes/app/corretor/visitas.php" method="post">
              <input type="hidden" name="acao" value="confirmar">
              <input type="hidden" name="id_visita" id="id_confirma" required>
              <button type="submit" class="btn btn-sm btn-primario">Confirmar</button>
            </form>
          </div>  
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/corretor/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

</body>

</html>
