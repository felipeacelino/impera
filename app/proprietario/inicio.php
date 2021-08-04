<? include(ACOES_APP_PATH."/proprietario/restrito.php"); ?>
<? include(ACOES_APP_PATH."/proprietario/anuncios.php"); ?>
<?php
$titulo_pagina = "Meus Imóveis - ".TITULO_PAGS;
$descr_site = "";
$keywords_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body class="pg-conta" data-pg="imoveis">

  <!-- HEADER -->
  <? include(APP_PATH.'/proprietario/estrutura/header.php'); ?>

  <!-- LATERAL -->
  <? include(APP_PATH.'/proprietario/estrutura/lateral.php'); ?>

  <!-- PÁGINA -->
  <main class="conta-container">

    <!-- CONTEÚDO -->
    <div class="conta-content">

      <div class="conta-topo">
        <h1 class="conta-titulo">Meus Imóveis</h1>
        <div class="conta-topo-btns">
        <a href="<?=URL?>proprietario/anuncio/insert" class="btn btn-sm btn-primario"><i class="fas fa-plus"></i>Cadastrar Novo</a>
        </div>
      </div>

      <? if ($total_registros > 0) { ?>

        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <!-- Tabela -->
            <table class="conta-tabela">
              <thead>
                <tr>
                  <th width="100px">Imóvel</th>
                  <th></th>
                  <th width="180px">Status</th>
                  <th width="130px">Opções</th>
                  <th width="130px"></th>
                </tr>
              </thead>
              <tbody>

                <? foreach ($resultado as $anuncio) { ?>
                
                  <!-- Repete -->
                  <tr>
                    <td>
                      <a href="<?=URL?>proprietario/anuncio_fotos/<?=$anuncio['id']?>/update" class="conta-tabela-img" title="Gerenciar fotos"><img src="<?=$anuncio['foto_view']?>" alt="<?=$anuncio['titulo']?>"></a>
                    </td>
                    <td>
                      <p><a href="<?=URL?><?=$anuncio['slug']?>" target="blank"><b><?=Tools::limitarTexto($anuncio['titulo'], 50)?></b></a></p>
                      <p><?=$anuncio['categoria']?></p>
                      <p><small><b>Código:</b> <?=$anuncio['codigo']?></small></p>
                      <p><small><b>Visitas:</b> <?=$anuncio['views']?></small></p>
                      <? if ($anuncio['total_fotos'] < 5) { ?>
                        <p class="text-danger"><small style="display: block; font-size: 12px;"><b>Atenção:</b> Cadastre pelo menos <b>5 fotos</b> do imóvel para que o mesmo seja exibido no site.</small></p>
                      <? } ?>
                    </td>
                    <td>
                      <span class="conta-status status-<?=$anuncio['status']?>" data-tippy-content="<?=$statusAnuncios[$anuncio['status']]['descricao']?>"><?=$statusAnuncios[$anuncio['status']]['titulo']?></span>
                    </td>
                    <td>
                      <div class="dropdown">
                        <a href="#" class="btn btn-xs btn-terciario dropdown-toggle"><i class="fas fa-caret-down"></i>Opções</a>
                        <div class="dropdown-menu right">
                          <a href="<?=URL?><?=$anuncio['slug']?>/view" class="dropdown-item" target="blank"><i class="fas fa-eye"></i> Pré-visualizar</a></li>
                          <a href="<?=URL?>proprietario/anuncio_fotos/<?=$anuncio['id']?>/update" class="dropdown-item"><i class="fas fa-camera"></i> Gerenciar fotos</a></li>
                          <a href="<?=URL?>proprietario/acompanhar-imovel/<?=$anuncio['id']?>" class="dropdown-item"><i class="las la-search"></i> Acompanhar imóvel</a></li>
                          <a href="<?=URL?>proprietario/visitas/<?=$anuncio['id']?>" class="dropdown-item"><i class="las la-calendar-check"></i> Visitas</a></li>
                          <a href="<?=URL?>proprietario/pagamentos/<?=$anuncio['id']?>" class="dropdown-item"><i class="las la-wallet"></i> Pagamentos</a></li>
                          <a href="#" data-id="<?=$anuncio['id']?>" class="dropdown-item btn-duplicar"><i class="fas fa-clone"></i> Duplicar imóvel</a></li>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="conta-tabela-opcoes">
                        <a href="<?=URL?>proprietario/anuncio/update/<?=$anuncio['id']?>" class="btn btn-xs btn-terciario" title="Editar"><i class="fas fa-pencil-alt m-0"></i></a>
                        <a href="#" class="btn btn-xs btn-rem btn-confirm" data-id="<?=$anuncio['id']?>" title="Remover"><i class="fas fa-trash m-0"></i></a>
                      </div>
                    </td>
                  </tr>
                  <!-- //Repete -->

                <? } ?>

              </tbody>
            </table>
            <!-- //Tabela -->

          </div>

          <? if ($total_registros > 12) { ?>
          <div class="conta-bloco-footer">
            <!-- paginação -->
            <? $acoes->Pagination($url_paginacao); ?>
            <!-- paginação -->
          </div>
          <? } ?>

        </div>

      <? } else { ?>

        <!-- sem registros -->         
        <div class="conta-bloco">
          <div class="conta-bloco-content">
            <div class="conta-empty texto">
              <p>Você ainda não cadastrou nenhum imóvel.</p>
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
          <span class="modal-titulo">Remover</span>     
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <p class="texto">Deseja realmente remover este anúncio?</p>
          <div class="modal-btn left">	
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm">Cancelar</button>
          </div>  
          <div class="modal-btn right">	
            <form id="form-remove-anuncio" action="<?=URL?>acoes/app/proprietario/anuncio.php" method="post">
              <input type="hidden" name="acao" value="remover">
              <input type="hidden" id="retorno_success" name="retorno_success" value="<?=URL?>proprietario/inicio">
              <input type="hidden" name="id_remove" id="id_remove" required>
              <button type="submit" class="btn btn-sm btn-rem">Remover</button>
            </form>
          </div>  
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação -->

    <!-- Alerta confirmação -->
    <div class="modal warning" id="modal-confirm2">
      <div class="modal-wrap modal-sm">
        <span class="modal-btn-close modal-close" data-modal="modal-confirm2"></span>
        <div class="modal-header">
          <span class="modal-titulo">Duplicar</span>     
        </div>
        <div class="modal-body">
          <div class="modal-alert-icon">
            <i class="fas fa-exclamation-circle"></i>
          </div>
          <p class="texto">Deseja realmente duplicar este anúncio?</p>
          <div class="modal-btn left">	
            <button type="button" class="btn btn-sm modal-close" data-modal="modal-confirm2">Cancelar</button>
          </div>  
          <div class="modal-btn right">	
            <form id="form-duplica-anuncio" action="<?=URL?>acoes/app/proprietario/anuncio.php" method="post">
              <input type="hidden" name="acao" value="duplicar">
              <input type="hidden" id="retorno_success" name="retorno_success" value="<?=URL?>proprietario/inicio">
              <input type="hidden" name="id_duplica" id="id_duplica" required>
              <button type="submit" class="btn btn-sm btn-primario">Duplicar</button>
            </form>
          </div>  
        </div>
      </div>
    </div>
    <!-- //Alerta confirmação -->

    <!-- FOOTER -->
    <? include(APP_PATH.'/proprietario/estrutura/footer.php'); ?>

  </main>
  <!-- //PÁGINA -->

  <? if ($param3 == "cad-success") { ?>
    <script>
    showAlert('Parabéns!', '<p><b>Seu imóvel foi cadastrado com sucesso!</b></p><p>Você receberá um e-mail com o link do seu anúncio assim que for analisado e publicado pela nossa equipe.</p><p>Desejamos que você faça um excelente negócio através do nosso portal!</p>', 'success');
    </script>
  <? } ?>
  <? if ($param3 == "upd-success") { ?>
    <script>
    showAlert('Sucesso', 'Anúncio atualizado com sucesso.', 'success');
    </script>
  <? } ?>

  <? if ($param3 == "success") { ?>
    <script>
    showAlert('Parabéns!', 'Seu cadastro foi realizado com sucesso! Clique em <b>Cadastrar Novo</b> para cadastrar um imóvel.', 'success');
    </script>
  <? } ?>

</body>

</html>
