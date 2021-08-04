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
                      <i class="fa fa-times"></i> 
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto]"> Imagem                 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[foto]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['foto']?>" <? } ?>>
                    <label for="img[foto]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icone">
                    Ícone (FontAwesome v5)<br>
                    <a href="#" data-toggle="modal" data-target="#modal-icone"><i class="fas fa-question-circle"></i> Como obter o ícone</a>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="icone" id="icone" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['icone']; ?>" placeholder="Ex: fas fa-user">
                  </div>
                </div>
                <!--repete -->
                <!-- Modal Icone -->
                <div class="modal fade" id="modal-icone" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                        </button>
                        <h4 class="modal-title">Obtendo o Ícone</h4>
                      </div>
                      <div class="modal-body">
                        <ul>
                          <li>
                            <p><b>1 - </b> Acesse o <a href="https://fontawesome.com/icons/" target="_blank">Font Awesome</a> e role a página até encontrar o ícone desejado ou pesquise por um termo em inglês.</p>
                          </li>
                          <li>
                            <p><b>2 - </b> Quando encontrar, clique no <b>ícone</b>.</p>
                            <img src="<?=URL?>static/img/admin/icone_1.png" style="max-width: 100%">
                            <br><br>
                          </li>
                          <li>
                            <p><b>3 - </b> Será aberta uma nova janela, então <b>copie a classe do ícone</b> (código entre aspas, após "class="). <b>Ex: fas fa-user</b>.</p>
                            <img src="<?=URL?>static/img/admin/icone_2.png">
                            <br><br>
                          </li>
                          <li>
                            <p><b>4 - </b> Por fim <b>cole o código no campo da administração.</b></p>
                          </li>
                        </ul>
                      </div>
                      <div class="modal-footer">                                
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>  
                      </div>
                    </div>
                  </div>
                </div> 
                <!-- Fim Modal Icone -->

                <div class="separator-form"></div> 

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo"> Título 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo" id="titulo" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo']; ?>">
                  </div>
                </div>
                <!--repete -->

                 <!--repete --> 
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="texto">Texto 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea name="texto" id="texto" class="ckeditor" rows="1"><?=$linha_edit['texto']; ?></textarea>    
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
                <!-- ESQUERDA -->
                <div class="header_row_left">
                  <div class="header_row_item">
                    <a href="<?=$retorno_geral; ?>" class="btn btn-primary btn-header">
                      <i class="fa fa-chevron-left"></i> 
                      <span>Voltar</span>
                    </a>
                  </div>                  
                </div> 
                <!-- FIM ESQUERDA -->              
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
                          <a class="acao-multiplos" data-acao="status_1"><i class="fa fa-check"></i> Ativar
                          </a>
                        </li>
                        <li>
                          <a class="acao-multiplos" data-acao="status_0"><i class="fa fa-times"></i> Desativar
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-multiplos" data-acao="remover"><i class="fa fa-trash"></i> Remover
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
                    <i class="fa fa-file-text"></i> <?=$total_registros; ?> registro(s)
                  </div>

                  <!-- ORDEM -->   
                  <div class="header_row_item">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Ordenar
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu pull-right">
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY titulo ASC"><i class="fa fa-sort-alpha-asc"></i> Título (A-Z)
                          </a>
                        </li> 
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY titulo DESC"><i class="fa fa-sort-alpha-desc"></i> Título (Z-A)
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY ordem_exibicao DESC"><i class="fa fa-sort-numeric-desc"></i> Ordem exibição decrescente
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY ordem_exibicao ASC"><i class="fa fa-sort-numeric-asc"></i> Ordem exibição crescente
                          </a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY id DESC"><i class="fa fa-sort-numeric-desc"></i> Mais novos
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY id ASC"><i class="fa fa-sort-numeric-asc"></i> Mais antigos
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
                        <th>Ordem</th>
                        <th>Imagem (Ícone)</th>
                        <th>Título</th>
                        <th>Status</th>                                           
                        <th></th>
                      </tr>
                    </thead>
                    <!--cabeçalho -->   

                    <tbody>

                      <? foreach ($resultado as $linha) { ?>

                        <?
                        $current_url_edit = $_GET['p'] != '' ? 
                        "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id']."/".$pagina['id']."?p=".$_GET['p'] : 
                        "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id']."/".$pagina['id'];                                   
                        ?>

                        <tr>

                          <!--item -->
                          <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?=$linha['id']?>"><span></span></label></td>
                          <!--item -->

                          <!--item -->
                          <td align="center" data-label="Ordem">              
                            <select name="altera_oe" class="select_ordem">
                              <? foreach ($ordens as $ordem) { ?> 
                                <option value="<?=$linha['id']?>|<?=$linha['ordem_exibicao']?>|<?=$ordem['ordem_exibicao']?>|<?=$linha['pagina_id']?>" <?=Tools::selected($ordem['ordem_exibicao'],$linha['ordem_exibicao'])?>><?=$ordem['ordem_exibicao']?>º Item</option>
                              <? } ?>
                            </select>
                          </td>
                          <!--item --> 

                          <!--item -->
                          <td class="tr-lg">     
                            <? if ($linha['icone'] == "" && $linha['foto'] != "") { ?>
                              <img src="<?=URL; ?>uploads/img/<?=$tabela?>/<?=$linha['id']; ?>/thumb-250-250/<?=$linha['foto']; ?>">
                            <? } else { ?>
                              <i class="<?=$linha['icone']; ?> fa-2x" style="color: #333"></i>
                            <? } ?>
                          </td>
                          <!--item -->

                          <!--item -->
                          <td data-label="Título"><?=$linha['titulo']; ?></td>
                          <!--item --> 

                          <!--item -->
                          <td data-label="Status">
                            <?
                            $status = array('Inativo', 'Ativo', 'Pendente');
                            ?>
                            <label class="status status<?=$linha['status']; ?>">
                              <i class="fa fa-circle"></i>
                              <span><?=$status[$linha['status']]; ?></span> 
                            </label>
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
                    <i class="fa fa-exclamation-circle"></i>
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
