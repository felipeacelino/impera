<? include(ACOES_APP_PATH."/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH."/corretor/leads.php"); ?>
<?php
$titulo_pagina = "Contatos (Leads) - ".TITULO_PAGS;
$descr_site = DESCRIPTION;
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="leads">

  <!-- HEADER -->
  <? include(APP_PATH.'/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Contatos (Leads)</h1>
      </div>

      <div class="texto" style="margin-bottom: 30px;">Confira os contatos (leads) enviados pela imobiliária para você.<br> Clique no botão <b>Feedback</b> para informar o desfecho do contato (se o cliente teve ou não interesse).</div>

      <? if ($numRegistros > 0) { ?>

        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Telefone</th>
                  <th>Data</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                <? foreach ($registrosLista as $registro) { ?>
                  
                  <!-- Repete -->
                  <tr>
                    <td><b><?=$registro['nome']?></b></td>
                    <td><?=$registro['email']?></td>
                    <td><?=$registro['telefone']?></td>
                    <td><?=Tools::formataData($registro['data_cad'])?></td>
                    <td>
                      <span class="conta-status <?=$statusLeads[$registro['status']]['class']?>"><?=$statusLeads[$registro['status']]['titulo']?></span>
                    </td>
                    <td>
                      <div class="conta-tabela-opcoes">
                        <a class="btn btn-xs btn-primario modal-update" data-reg="<?=$registro['id']?>" data-tit="Atualizar Contato" data-btn="Salvar" data-acao="update" data-campos='<?=json_encode($registro)?>'><i class="fas fa-pen"></i>Feedback</a>
                      </div>
                    </td>
                  </tr>
                  <!-- //Repete -->

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
              <p>Nenhum registro encontrado.</p>
            </div>
          </div>
        </div>
        <!-- sem registros --> 

      <? } ?>

    </div>
    <!-- //CONTEÚDO -->

    <!-- MODAL CADASTRAR/EDITAR -->
    <div class="modal" id="modal-registro">
      <div class="modal-wrap">
        <span class="modal-btn-close modal-close" data-modal="modal-registro"></span>
        <div class="modal-header">
          <span class="modal-titulo"></span>                
        </div>
        <div class="modal-body">
          <form id="form-registro" action="<?=URL?>acoes/app/corretor/leads.php" method="post" class="form-validation" enctype="multipart/form-data">

            <div class="texto center"><p class="modal-registro-texto"><b></b></p></div>

            <div class="modal-registro-campos">
              <div class="campo-container">
                <label for="nome">Nome do cliente</label>
                <input type="text" name="nome" id="nome" maxlength="255" class="campo" placeholder="Digite o nome do cliente" data-parsley-trigger="change" readonly />
              </div>
              <div class="row">
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="email">E-mail do cliente</label>
                  <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite o e-mail do cliente" data-parsley-trigger="change" readonly />
                </div>
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="telefone">Telefone do cliente</label>
                  <input type="telefone" name="telefone" id="telefone" maxlength="255" class="campo telefone" placeholder="Digite o telefone do cliente" data-parsley-trigger="change" readonly />
                </div>
              </div>
              <div class="row">
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="campo select2 status-lead" data-placeholder="Selecione">
                    <option></option>
                    <? foreach ($statusLeads as $statusK => $statusV) { ?>
                      <option value="<?=$statusK?>"><?=$statusV['titulo']?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <div class="campo-container sem-interesse">
                <label for="motivo_negativa">Motivo</label>
                <input type="text" name="motivo_negativa" id="motivo_negativa" maxlength="255" class="campo" placeholder="Descreva o motivo pelo qual o cliente não teve interesse..." data-parsley-trigger="change" data-required="true" />
              </div>
              <div class="row com-interesse">
                <div class="grid-12 campo-container">
                  <label for="feedback">Região ou imóvel de interesse</label>
                  <input type="text" name="feedback" id="feedback" maxlength="255" class="campo" placeholder="Informe o feedback" data-parsley-trigger="change" data-required="true" />
                </div>
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="renda">Renda</label>
                  <input type="text" name="renda" id="renda" maxlength="255" class="campo" placeholder="Informe a renda do cliente" data-parsley-trigger="change" />
                </div>
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="fgts">FGTS</label>
                  <input type="text" name="fgts" id="fgts" maxlength="255" class="campo" placeholder="Informe o FGTS do cliente" data-parsley-trigger="change" />
                </div>
                <div class="grid-6 grid-m-12 grid-s-12 campo-container">
                  <label for="possui_dependente">Possui dependente?</label>
                  <select name="possui_dependente" id="possui_dependente" class="campo select2" data-placeholder="Selecione" data-required="true">
                    <option></option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="modal-btn left">
              <button class="btn btn-sm modal-close" data-modal="modal-registro">Cancelar</button>
            </div>

            <div class="modal-btn right">
              <input type="hidden" name="acao" id="modal-acao">
              <input type="hidden" name="registro" id="modal-registro">
              <button type="submit" class="btn btn-sm btn-primario modal-btn-ac"></button>
            </div>

          </form>  
        </div>
      </div>
    </div>
    <!-- //MODAL CADASTRAR/EDITAR -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/corretor/estrutura/footer.php'); ?>
    
  </main>
  <!-- //PÁGINA -->

</body>

</html>
