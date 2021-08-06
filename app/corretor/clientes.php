<? include(ACOES_APP_PATH."/corretor/restrito.php"); ?>
<? include(ACOES_APP_PATH."/corretor/clientes.php"); ?>
<?php
$titulo_pagina = "Clientes - ".TITULO_PAGS;
$descr_site = DESCRIPTION;
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="clientes">

  <!-- HEADER -->
  <? include(APP_PATH.'/corretor/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/corretor/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Meus clientes</h1>
        <div class="conta-topo-btns">
          <a href="#" class="btn btn-sm btn-primario modal-insert" data-tit="Cadastrar cliente" data-btn="Cadastrar" data-acao="insert"><i class="fas fa-plus"></i> Cadastrar</a>
        </div>
      </div>

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
                  <th></th>
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
                    <td><a href="<?=URL?>corretor/documentos/<?=$registro['id']?>" class="btn btn-sm btn-primario">Documentos</a></td>
                    <td>
                      <div class="conta-tabela-opcoes">
                        <a class="btn btn-xs modal-update" data-reg="<?=$registro['id']?>" data-tit="Editar cliente" data-btn="Atualizar" data-acao="update" data-campos='<?=json_encode($registro)?>'><i class="fas fa-pen"></i>Editar</a>
                        <a class="btn btn-xs btn-rem modal-rem" data-reg="<?=$registro['id']?>" data-tit="Remover cliente" data-text="Deseja remover este cliente?" data-btn="Remover" data-acao="delete"><i class="fas fa-trash"></i>Remover</a>
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
          <form id="form-registro" action="<?=URL?>acoes/app/corretor/clientes.php" method="post" class="form-validation" enctype="multipart/form-data">

            <div class="texto center"><p class="modal-registro-texto"><b></b></p></div>

            <div class="modal-registro-campos">
              <div class="campo-container">
                <label for="nome">Nome do cliente *</label>
                <input type="text" name="nome" id="nome" maxlength="255" class="campo" placeholder="Digite o nome do cliente" data-parsley-trigger="change" required />
              </div>
              <div class="campo-container">
                <label for="email">E-mail do cliente</label>
                <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite o e-mail do cliente" data-parsley-trigger="change" />
              </div>
              <div class="campo-container">
                <label for="telefone">Telefone do cliente</label>
                <input type="telefone" name="telefone" id="telefone" maxlength="255" class="campo telefone" placeholder="Digite o telefone do cliente" data-parsley-trigger="change" />
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
