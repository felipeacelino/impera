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

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto]">Imagem *
                  <? if($acao == "edit"){ ?>
                    <br>
                    <small><i class="fas fa-exclamation-circle"></i> Clique na imagem para alterar</small>
                  <? } ?>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[foto]" accept="image/*" class="ezdz" <? if($acao == "insert"){ ?> required="required" <? }else{ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['foto']?>" <? } ?>>
                    <label for="img[foto]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                              
                <div class="separator-form"></div>              

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">
                    Título *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo" id="titulo" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo']; ?>" required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor">Texto *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor" id="ckeditor" class="ckeditor" rows="1" required><?=$linha_edit['texto']; ?></textarea>
                    <label for="ckeditor" class="error"></label>
                 </div>
                </div>
                <!--repete -->

                <!-- <div class="separator-form"></div> -->

                <!--repete -->
                <!-- <link href="<?=URL;?>admin/vendors/multiple-select-master/multiple-select-admin.css" rel="stylesheet" />
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="categorias">
                    Categorias *                                  
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="categorias[]" id="categorias" multiple="multiple" required>
                      <? foreach ($categorias as $categoria) { ?>
                        <option value="<?=$categoria['id']; ?>" <? if(in_array($categoria['id'], $categorias_atuais_post)){ ?> selected <? } ?>><?=$categoria['titulo']; ?></option> 
                      <? } ?>
                    </select>  
                    <label for="categorias" class="error"></label>  
                  </div>
                </div>  
                <script src="<?=URL;?>admin/vendors/multiple-select-master/multiple-select.js"></script>
                <script>            
                  $('#categorias').multipleSelect({
                    filter: true,
                    placeholder: "Selecione",
                    selectAll: true,
                    minimumCountSelected: 5,                    
                    allSelected: 'Todas as categorias',
                    countSelected: '# de % selecionadas',
                    noMatchesFound: 'Categoria não encontrada',
                    selectAllText: 'Selecionar todas',
                    selectAllDelimiter: [''],
                    onClick: function(view) {
                      //console.log(view);
                      // Realiza a validação
                      $('#categorias').valid();
                    }                    
                  });   
                </script> -->
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_exibe">
                    Data *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="data_exibe" id="titudata_exibelo" type="text" class="form-control col-md-7 col-xs-12 datepicker" <? if ($acao == "edit") { ?> value="<?=Tools::formataData($linha_edit['data_exibe'])?>" <? } ?> required>
                  </div>
                </div>
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="autor">
                    Autor *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="autor" id="autor" type="text" class="form-control col-md-7 col-xs-12" <? if ($acao == "insert") { ?> value="<?=NOME_USUARIO_ADMIN?>" <? } else { ?> <? } ?> value="<?=$linha_edit['autor']; ?>" required>
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <!-- <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="destaque">
                    Destaque *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="destaque" id="destaque" class="switch" value="1" data-label-true="Post em destaque" data-label-false="Sem destaque"  <? if($acao == 'edit'){ Tools::checked("1",$linha_edit['destaque']); } ?> />
                      <span class="switch-label">sadasdsadas</span>                      
                    </label>                    
                  </div>
                </div> -->
                <!--repete -->

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comentarios">
                    Comentários *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="comentarios" id="comentarios" class="switch" value="1" data-label-true="Comentários ativos" data-label-false="Comentários desativados" <? if($acao == 'edit'){ Tools::checked("1",$linha_edit['comentarios']); } else { ?> checked <? } ?> />
                      <span class="switch-label"></span>                      
                    </label>                    
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                    Status *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="status" id="status" class="switch" value="1" data-label-true="Ativo" data-label-false="Inativo" <? if($acao == 'edit'){ Tools::checked("1",$linha_edit['status']); } else { ?> checked <? } ?> />
                      <span class="switch-label"></span>                      
                    </label>                    
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form">
                  <div class="separator-form-titulo">SEO</div>
                </div>

                <!--repete --> 
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="description" id="description" class="form-control" rows="5"><?=$linha_edit['description']; ?></textarea>           
                 </div>
                </div>
                <!--repete -->

                <div class="ln_solid"></div>

                <!--botoes -->
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" id="bt1" class="btn btn-primary" value="bt1" name="bt1"><?=$msg_botao; ?> e continuar</button>
                    <button type="submit" id="bt2" class="btn btn-success" value="bt2" name="bt2"><?=$msg_botao; ?></button>
                  </div>
                </div>
                <!--botoes -->

                <!--hidden fields -->
                <input type="hidden" name="retorno" id="retorno" value="">
                <input type="hidden" name="token" value="<?=TOKEN; ?>">
                <input type="hidden" name="acao" value="<?=$acao; ?>"> 
                <input type="hidden" name="tabela_verifica" id="tabela_verifica" value="<?=$tabela; ?>">              
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
                <!-- DIREITA -->
                <div class="header_row_right">
                  <div class="header_row_item">
                    <a href="<?=$current_url_insert; ?>" class="btn btn-success btn-header">
                      <i class="fas fa-plus"></i> 
                      <span>Cadastrar</span>
                    </a>
                  </div>                  
                </div> 
                <!-- FIM DIREITA -->               
              </div>
              <!-- FIM LINHA HEADER -->

              <!-- FILTROS -->
              <div id="filtros" class="header_row">                
                <div class="filtros-btn-container">
                  <button class="btn btn-default" id="exibe_filtros">
                    <i class="fas fa-filter"></i> 
                    Filtros 
                    <i class="fas fa-chevron-down"></i>
                  </button>
                </div>       
                <div class="filtros-container">
                  <form method="post" action="<?=$acao_filtros?>">
                    <div class="filtros-itens">

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_titulo" class="control-label">Título:</label>
                        <input type="text" name="filtro_titulo" id="filtro_titulo" class="form-control" maxlength="255" value="<?=$_SESSION[$pag_include]['filtros']['filtro_titulo']?>">
                      </div>
                      <!-- // Item filtro -->                      

                      <!-- Item filtro -->
                      <!-- <div class="campo-filtro form-group">
                        <label for="filtro_categoria" class="control-label">Categoria:</label>
                        <select name="filtro_categoria" id="filtro_categoria" class="form-control">
                          <option value="">Todas</option>
                          <? foreach ($categorias as $categoria) { ?>
                            <option value="<?=$categoria['id']?>" <?=Tools::selected($_SESSION[$pag_include]['filtros']['filtro_categoria'], $categoria['id'])?>><?=$categoria['titulo']?></option>
                          <? } ?>
                        </select>                        
                      </div> -->
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_status" class="control-label">Status:</label>
                        <select name="filtro_status" id="filtro_status" class="form-control">
                          <option value="">Todos</option>
                          <option value="1" <?=Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "1")?>>Ativos</option>
                          <option value="0" <?=Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "0")?>>Inativos</option>
                        </select>                        
                      </div>
                      <!-- // Item filtro -->

                      <!-- Item filtro -->
                      <div class="campo-filtro form-group">
                        <label for="filtro_data" class="control-label">Data de cadastro:</label>
                        <input type="text" name="filtro_data" id="filtro_data" class="form-control data_range" data-popup-direction="left" readonly="readonly" maxlength="255" value="<?=$_SESSION[$pag_include]['filtros']['filtro_data']?>">
                      </div>
                      <!-- // Item filtro -->

                    </div>  
                    <div class="filtros-actions full">
                      <a href="<?=URL?>acoes/admin/geral/limpar_filtros.php?pagina=<?=$pag_include?>&retorno=<?=$_SERVER['REQUEST_URI']?>" class="btn btn-default"><i class="fas fa-times"></i> Limpar</a>
                      <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Aplicar</button>
                    </div>
                  </form>                  
                </div>
              </div>
              <!-- FIM FILTROS -->

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
                          <a class="acao-multiplos" data-acao="status_1"><i class="fas fa-check"></i> Ativar
                          </a>
                        </li>
                        <li>
                          <a class="acao-multiplos" data-acao="status_0"><i class="fas fa-times"></i> Desativar
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
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
                    <i class="fas fa-file-alt"></i> <?=$total_registros; ?> registro(s)
                  </div>

                  <!-- ORDEM -->   
                  <div class="header_row_item">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Ordenar
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY p.titulo ASC"><i class="fas fa-sort-alpha-down"></i> Título (A-Z)
                          </a>
                        </li> 
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY p.titulo DESC"><i class="fas fa-sort-alpha-down-alt"></i> Título (Z-A)
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY p.views DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais vistos
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY p.views ASC"><i class="fas fa-sort-numeric-down"></i> Menos vistos
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY p.data_exibe DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais novos
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY p.data_exibe ASC"><i class="fas fa-sort-numeric-down"></i> Mais antigos
                          </a>
                        </li>                                               
                      </ul>
                      <form id="form-ordem" action="<?=$_SERVER['REQUEST_URI']?>" method="post">
                        <input type="hidden" name="sort_ordem" id="sort_ordem" value="<?=$_SESSION[$pag_include]['ordem']?>">
                        <input type="hidden" name="acao_exec" value="ordenar">
                      </form>
                    </div> 
                  </div> 
                  <!-- FIM ORDEM -->

                </div>  
                <!-- FIM DIREITA -->

              </div>
              <!-- FIM LINHA HEADER -->

              <form name="excluir" id="form_acao" method="post">

                <? if ($total_registros > 0) { ?>

                  <table class="table table_responsive">

                    <!--cabeçalho -->
                    <thead>
                      <tr>
                        <th>
                          <label class="check"><input type="checkbox" id="selecctall"><span></span></label>
                        </th>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Visualizações</th>
                        <th>Data</th>                        
                        <th>Status</th>                                           
                        <th></th>
                      </tr>
                    </thead>
                    <!--cabeçalho -->   

                    <tbody>

                      <? foreach ($resultado as $linha) { ?>

                        <?   
                        $current_url_edit = $_GET['p'] != '' ? 
                        "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id']."?p=".$_GET['p'] : 
                        "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id'];                                   
                        ?>

                        <tr>

                          <!--item -->
                          <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?=$linha['id']?>"><span></span></label></td>
                          <!--item -->     

                          <!--item -->
                          <td class="tr-lg">                          
                            <img src="<?=URL; ?>uploads/img/<?=$tabela?>/<?=$linha['id']; ?>/thumb-500-350/<?=$linha['foto']; ?>">
                          </td>
                          <!--item -->
   
                          <!--item -->
                          <td data-label="Título">
                            <b><?=Tools::limitarTexto($linha['titulo'],50); ?></b>
                            <!-- <p><i class="fas fa-tags"></i> <?=Tools::limitarTexto($linha['categorias'],50); ?></p>   -->                          
                          </td>
                          <!--item --> 

                          <!--item -->
                          <td data-label="Views"><i class="fas fa-eye"></i> <?=$linha['views']; ?></td>
                          <!--item --> 

                          <!--item -->
                          <td data-label="Data"><i class="far fa-calendar"></i> <?=Tools::formataData($linha['data_exibe']); ?></td>
                          <!--item --> 

                          <!--item -->
                          <td data-label="Status">
                            <?
                            $status = array('Inativo', 'Ativo', 'Pendente');
                            ?>
                            <label class="status status<?=$linha['status']; ?>">
                              <i class="fas fa-circle"></i>
                              <span><?=$status[$linha['status']]; ?></span> 
                            </label>
                            
                            <? if ($linha['destaque'] == "1") { ?>
                              <!-- <br>
                              <label class="status status2">
                                <i class="fas fa-star"></i>
                                <span>Destaque</span> 
                              </label> -->
                            <? } ?>                            
                          </td>
                          <!--item -->                         
                                                
                          <!--item -->
                          <td>  
                            <a class="btn btn-xs btn-default" href="<?=$current_url_edit?>"><i class="fas fa-edit"></i> Editar</a>                                                   
                            <a href="#" class="btn btn-xs btn-danger btn-remove" data-iddel="<?=$linha['id']; ?>"><i class="fas fa-trash-alt"></i> Remover</a>
                          </td>
                          <!--item -->

                        </tr>                         

                      <? } ?>                 

                    </tbody>

                  </table>

                <? } else { ?>

                  <span class="sem-registro-txt">
                    <i class="fas fa-exclamation-circle"></i>
                    Nenhum registro encontrado
                  </span>

                <? } ?>
              
                <input type="hidden" id="confere" value="" />
                <input type="hidden" name="tabela_atual" id="tabela_atual" value="<?=$tabela; ?>" />
                <input type="hidden" name="token" value="<?=TOKEN; ?>" />
                <input type="hidden" name="acao_exec" id="acao_exec" value="" />
                <input type="hidden" name="campo" value="status" />
                <input type="hidden" name="status" id="status">
                <input type="hidden" name="retorno" value="<?=$_SERVER['REQUEST_URI']; ?>" />

              </form>

              <? $acoes->Pagination($url_paginacao); ?>

              <!-- Modal remove -->
              <div class="modal fade" id="modal-remove" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                      </button>
                      <h4 class="modal-title">Remover registro</h4>
                    </div>

                    <form id="form_excluir" name="form_excluir" method="post" action="<?=$current_url_delete; ?>">

                      <div class="modal-body">
                        <p>Deseja remover esse item?</p>                            
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
