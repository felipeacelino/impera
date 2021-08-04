<? include ("".ACOES_ADMIN_PATH."/".$pasta_modulo."/".$pag_include.".php"); ?>

<!-- estrutura -->
<div class="right_col" role="main">
  <div class="">

    <!-- titulo -->
    <div class="page-title">
      <div class="title_left">
        <h3>
          <?=$tit_pag_geral; ?>
          <small></small>
        </h3>
      </div>
    </div>
    <!-- fim titulo -->

    <!-- conteudo -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <!--mensagem retorno -->          
          <?
          echo $_SESSION['msg_retorna'];
          ?>
          <span id="divclean"></span>
          <!--fim mensagem retorno -->

          <? if($acao == "insert" || $acao == "edit"){?>

            <!--cadastrar e editar  -->
            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- LINHA HEADER -->
              <div class="header_row" id="barra_header">                
                <!-- DIREITA -->
                <div class="header_row_left">
                  <div class="header_row_item">
                    <a href="<?=$current_url_view; ?>" class="btn btn-primary btn-header">
                      <i class="fas fa-times"></i> 
                      <span>Cancelar</span>
                    </a>
                  </div>                  
                </div> 
                <!-- FIM DIREITA -->               
              </div>
              <!-- FIM LINHA HEADER -->   
  
              <!--formulario --> 
              <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?=$action_form; ?>" enctype="multipart/form-data">  
                
                <!-- FILEINPUT -->
                <link rel="stylesheet" type="text/css" href="<?=URL; ?>admin/vendors/bootstrap-fileinput/css/fileinput.custom.css">               
                <div class="item form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input id="fotos" name="fotos[]" type="file" multiple accept="image/*" class="file-loading" data-msg-required="Você deve selecionar alguma imagem antes de enviar." required>
                    <label class="error error-multiple-photos" for="fotos"></label>
                  </div>
                </div>
                <script type="text/javascript" src="<?=URL; ?>admin/vendors/bootstrap-fileinput/js/fileinput.min.js"></script>
                <script type="text/javascript" src="<?=URL; ?>admin/vendors/bootstrap-fileinput/js/locales/pt-BR.js"></script>
                <script type="text/javascript">
                  $(function() {
                    $('#fotos').fileinput({
                      language: 'pt-BR',
                      showCaption: true,
                      showUpload: false,
                      showClose: false,                      
                      showRemove: true,                      
                      removeFromPreviewOnError: true,
                      allowedFileTypes: ['image'],
                      allowedFileExtensions : <?=$extensoes_permitidas_var;?>,
                      maxFileSize: <?=$maxFileSize*1024;?>,
                      maxFileCount: <?=$maxFileCount;?>       
                    });
                    $('#fotos').on('change', function(event) {
                      $(this).valid();
                      if ($('.file-input').hasClass('has-error')) {
                        $('#bt2').attr('disabled', true);
                      } else {
                        $('#bt2').attr('disabled', false);
                      }
                    });                   
                  });                
                </script>
                <!-- FILEINPUT -->

                <!--botoes -->
                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                    <button type="submit" id="bt2" class="btn btn-success" value="bt2" name="bt2">
                      <i class="fas fa-arrow-circle-up"></i> Enviar Imagens                      
                    </button>
                  </div>
                </div>
                <!--botoes -->                
                      
                <!--hidden fields -->
                <input type="hidden" name="retorno" id="retorno" value="">
                <input type="hidden" name="token" value="<?=TOKEN; ?>">
                <input type="hidden" name="acao" value="<?=$acao; ?>">
                <? if($acao == "edit"){ ?>
                  <input type="hidden" name="id" id="id" value="<?=$id_enviado; ?>">
                <? } ?>
                <!--hidden fields -->

              </form>
              <!--fim formulario -->

            </div>
            <!--fim cadastrar e editar  -->

          <? } ?>

          <!--view -->
          <? if($acao == "view"){ ?>

            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- LINHA HEADER -->
              <div class="header_row" id="barra_header">       
                <!-- ESQUERDA -->
                <div class="header_row_left">
                  <div class="header_row_item">
                    <a href="<?=$retorno_geral; ?>" class="btn btn-primary btn-header">
                      <i class="fas fa-chevron-left"></i> 
                      <span>Voltar</span>
                    </a>
                  </div>                  
                </div> 
                <!-- FIM ESQUERDA -->         
                <!-- DIREITA -->
                <div class="header_row_right">
                  <? if ($limiteQtde == 0 || $maxFileCount > 0) { ?>
                  <div class="header_row_item">
                    <a href="<?=$current_url_insert; ?>" class="btn btn-success btn-header">
                      <i class="fas fa-plus"></i> 
                      <span>Cadastrar</span>
                    </a>
                  </div> 
                  <? } ?>                
                </div> 
                <!-- FIM DIREITA -->               
              </div>
              <!-- FIM LINHA HEADER -->

              <!-- LINHA HEADER -->
              <div class="header_row">  

                <!-- ESQUERDA --> 
                <div class="header_row_left">

                  <!-- COM SELECIONADOS -->
                  <div class="header_row_item">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Com selecionados
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">                      
                        <li>
                          <a class="acao-multiplos" data-acao="remover"><i class="fas fa-trash-alt"></i> Remover
                          </a>
                        </li>
                      </ul>
                    </div> 
                  </div> 
                  <!-- FIM COM SELECIONADOS -->

                </div> 
                <!-- FIM ESQUERDA -->   

                <!-- DIREITA -->  
                <div class="header_row_right">

                  <div class="header_row_item header_row_item_hide">
                    <? if ($limiteQtde > 0) { ?>
                      <i class="fas fa-images"></i> <?=$totalFotos; ?> de <?=$limiteQtde; ?> foto(s)
                    <? } else { ?>
                      <i class="fas fa-images"></i> <?=$total_registros; ?> foto(s)
                    <? } ?>                   
                  </div>

                </div>  
                <!-- FIM DIREITA -->

              </div>
              <!-- FIM LINHA HEADER -->
  
              <form name="excluir" id="form_acao" method="post">

                <? if ($total_registros > 0) { ?>

                  <div class="header_row">
                    <div class="header_row_left">
                      <label class="check"><input type="checkbox" id="selecctall"><span></span></label>
                      <label for="selecctall" class="selecctall_lbl" id="selecctall_lbl">Selecionar todas</label>
                    </div>
                  </div>
          
                  <link rel="stylesheet" href="<?=URL; ?>admin/vendors/lightbox2/dist/css/lightbox.min.css">

                  <script src="<?=URL; ?>admin/vendors/Sortable-master/Sortable.min.js"></script>

                  <div class="sortable" id="sortable">

                    <? foreach ($resultado as $linha) { ?>

                      <!--repete -->
                      <div class="col-md-55" data-id="<?=$linha['id']?>">                          
                        <div class="thumbnail">
                          <label>
                            <label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?=$linha['id']?>"><span></span></label>
                            Selecionar
                          </label>
                          <? if ($habilita_destaque && $linha['destaque'] == '1') { ?>
                            <span class="destaque" data-toggle="tooltip" title="Imagem destaque"><i class="fas fa-star"></i></span>
                          <? } ?>                            
                          <div class="image view view-first">
                            <img src="<?=$pathView."/thumb-300-200/".$linha['foto']?>" alt="<?=$linha['foto']?>" />
                            <div class="mask no-caption">
                              <div class="tools tools-bottom">

                                <!-- ZOOM -->
                                <? if ($habilita_zoom) { ?>                                    
                                  <a href="<?=$pathView."/".$linha['foto']?>" data-lightbox="fotos" data-title="<?=$linha['descricao']?>" data-toggle="tooltip" title="Zoom"><i class="fas fa-search-plus"></i></a>                         
                                <? } ?>

                                <!-- EDITAR TÍTULO -->
                                <? if ($habilita_titulo) { ?>
                                  <a id="edit_<?=$linha['id']?>" data-toggle="tooltip" title="Editar descrição"><i class="fas fa-edit"></i></a>
                                  <script type="text/javascript">
                                    $(function() {
                                      $('#edit_<?=$linha['id']?>').on('click', function(e){ 
                                        e.preventDefault();
                                        e.stopPropagation();          
                                        $('#descricao').val('<?=$linha['descricao']; ?>');
                                        $('#id_edit').val(<?=$linha['id']; ?>);
                                        $('#modal-image').html('');
                                        $('#modal-image').append('<img src="<?=$pathView."/thumb-300-200/".$linha['foto']?>" alt="<?=$linha['foto']?>" />');
                                        $('#modal-edit').modal('show');
                                      }); 
                                    });
                                  </script>
                                <? } ?>

                                <!-- DESTAQUE -->
                                <? if ($habilita_destaque) { ?>
                                  <? if (!$linha['destaque'] == '1') { ?>
                                    <a id="dest_<?=$linha['id']?>" data-toggle="tooltip" title="Destacar imagem"><i class="fas fa-star"></i></a>
                                    <script type="text/javascript">
                                      $(function() {
                                        $('#dest_<?=$linha['id']?>').on('click', function(e){ 
                                          e.preventDefault();
                                          e.stopPropagation();   
                                          $('#id_dest').val(<?=$linha['id']; ?>);                    
                                          $('#modal-destaque').modal('show');
                                        }); 
                                      });
                                    </script>
                                  <? } ?>                                                            
                                <? } ?>
                                
                                <!-- REMOVER -->
                                <a id="remove_<?=$linha['id']?>" data-toggle="tooltip" title="Remover imagem"><i class="fas fa-trash-alt"></i></a>
                                <script type="text/javascript">
                                  $('#remove_<?=$linha['id']?>').on('click', function(e){ 
                                    $('#id_remove').val(<?=$linha['id']; ?>);
                                    $('#modal-remove').modal('show');
                                  });
                                </script>
                              </div>
                            </div>
                          </div>
                          <!-- TÍTULO -->
                          <? if ($habilita_titulo) { ?>
                            <div class="caption" <? if (strlen($linha['descricao']) > 70) { ?> data-toggle="tooltip" data-placement="bottom" title="<?=$linha['descricao']?>" <? } ?>>
                              <p><?=Tools::limitarTexto($linha['descricao'], 70)?></p>
                            </div>
                          <? } ?>
                          <!-- FIM TÍTULO -->
                        </div>               
                      </div>
                    <!--repete -->

                    <? } ?> 

                  </div> 

                  <script>
                    $(function() {
                      var el = document.getElementById('sortable');
                      var sort = Sortable.create(el, {                      
                        onStart: function () {                          
                          this._currentOrder = this.toArray();                       
                        },
                        onUpdate: function (e) {  
                          var instance = this;
                          var novaOrdem = instance.toArray();

                          instance.option('disabled', true);
                          instance.el.classList.add('pulsate');

                          $.ajax({                
                            url: '<?=URL?>acoes/admin/geral/altera_ordem_exibicao_fotos.php',
                            type: 'POST',
                            data: {
                              nova_ordem: novaOrdem,
                              tabela: '<?=$tabela?>'
                            },                               
                            success: function (data) {                                
                              instance.option('disabled', false);
                              instance.el.classList.remove('pulsate');
                              console.log(data); 
                              if (data.trim() == 'ok') {
                                console.log('Sucesso!');                     
                              } else {
                                instance.sort(instance._currentOrder);
                              }                             
                            },
                            error: function (request, status, error) {                   
                              console.log(request.responseText);
                              instance.option('disabled', false);
                              instance.el.classList.remove('pulsate');
                              instance.sort(instance._currentOrder);
                            }
                          });
                          
                        }
                      });

                    });
                  </script>

                  <script src="<?=URL; ?>admin/vendors/lightbox2/dist/js/lightbox.min.js"></script>                                
                <? } else { ?>

                  <span class="sem-registro-txt">
                    <i class="fas fa-exclamation-circle"></i>
                    Nenhuma imagem cadastrada
                  </span>                      

                <? } ?>                 
              
                <input type="hidden" id="confere" value="" />
                <input type="hidden" name="tabela_atual" id="tabela_atual" value="<?=$tabela; ?>" />
                <input type="hidden" name="token" value="<?=TOKEN; ?>" />
                <input type="hidden" name="acao_exec" id="acao_exec" value="" />
                <input type="hidden" name="campo" value="status"  />
                <input type="hidden" name="status" id="status">
                <input type="hidden" name="retorno" value="<?=$_SERVER['REQUEST_URI']; ?>" />

              </form>

              <? $acoes->Pagination($url_paginacao); ?>

              <!-- Modal Descrição -->
              <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title">Descrição da imagem</h4>
                    </div>

                    <form id="form_edit" name="form_edit" method="post" action="<?=$action_form?>">

                      <div class="modal-body">                       
                  
                        <span id="modal-image"></span>
                        <p>Digite uma descrição para a imagem:</p>
                        <div class="form-group">
                          <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição da imagem" maxlength="255" required>        
                        </div>            

                        <input type="hidden" name="id_edit" id="id_edit" value="">
                        <input type="hidden" name="acao_edit" value="descricao">  
                        <input type="hidden" name="acao" value="edit">

                      </div>

                      <div class="modal-footer">                               
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" value="Salvar">       
                      </div>

                    </form>  

                  </div>
                </div>
              </div> 
              <!-- Fim Modal Descrição -->

              <!-- Modal Destaque -->
              <div class="modal fade" id="modal-destaque" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title">Destacar imagem</h4>
                    </div>

                    <form id="form_edit" name="form_edit" method="post" action="<?=$action_form?>">

                      <div class="modal-body"> 
                        
                        <p>Deseja destacar essa imagem?</p>
                        <input type="hidden" name="id_edit" id="id_dest" value="">
                        <input type="hidden" name="acao_edit" value="destaque">  
                        <input type="hidden" name="acao" value="edit">

                      </div>

                      <div class="modal-footer">                               
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" value="Aplicar">       
                      </div>

                    </form>  

                  </div>
                </div>
              </div> 
              <!-- Fim Modal Destaque -->

              <!-- Modal remove -->
              <div class="modal fade" id="modal-remove" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title">Remover imagem</h4>
                    </div>

                    <form id="form_excluir" name="form_excluir" method="post" action="<?=$current_url_delete; ?>">

                      <div class="modal-body">
                        <p>Deseja remover essa imagem?</p>                            
                        <input type="hidden" name="id" id="id_remove" value="">  
                        <input type="hidden" name="id_adicional" value="">   
                      </div>

                      <div class="modal-footer">                               
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Remover">       
                      </div>

                    </form>  

                  </div>
                </div>
              </div> 
              <!-- Fim Modal remove -->

              <!-- Modal múltiplos -->
              <div class="modal fade" id="modal-multiplo" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title" id="titulo-modal-multiplo"></h4>
                    </div>
                    <div class="modal-body">
                      <p id="texto-modal-multiplo"></p> 
                    </div>
                    <div class="modal-footer">                                
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn-multiplo" class="" data-dismiss="modal"></button>           
                    </div>
                  </div>
                </div>
              </div> 
              <!-- Fim Modal múltiplos -->

              <!-- Modal alerta -->
              <div class="modal fade" id="modal-alerta" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title">Atenção</h4>
                    </div>
                    <div class="modal-body">
                      <p>Selecione ao menos um item.</p> 
                    </div>
                    <div class="modal-footer">                                
                        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>                                 
                    </div>
                  </div>
                </div>
              </div> 
              <!-- Fim Modal alerta -->

            </div> 
          
          <? } ?>
          <!--fim view -->

        </div>
      </div>             
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
