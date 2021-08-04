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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mensagem">
                    Mensagem *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="mensagem" id="mensagem" class="form-control col-md-7 col-xs-12" rows="3" maxlength="1000" data-rule-maxlength="1000" required><?=$linha_edit['mensagem']; ?></textarea>
                 </div>
                </div>
                <!--repete -->

                <div class="separator-form"></div>

                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prioridade">
                    Prioridade *
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="prioridade" id="prioridade" class="form-control col-md-7 col-xs-12" required>
                      <option value="" hidden>Selecione</option>
                      <option value="1" <?=Tools::selected("1", $linha_edit['prioridade'])?>>Baixa</option>
                      <option value="2" <?=Tools::selected("2", $linha_edit['prioridade'])?>>Média</option>
                      <option value="3" <?=Tools::selected("3", $linha_edit['prioridade'])?>>Alta</option>
                    </select>                  
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
                <input type="hidden" name="usuario_id" value="<?=ID_USUARIO_ADMIN; ?>">
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
                          <a class="acao-ordenar" data-ordem="ORDER BY id DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais novos
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY id ASC"><i class="fas fa-sort-numeric-down"></i> Mais antigos
                          </a>
                        </li> 
                        <li class="divider" role="separator"></li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY prioridade DESC"><i class="fas fa-sort-amount-down"></i> Mais importantes
                          </a>
                        </li>
                        <li>
                          <a class="acao-ordenar" data-ordem="ORDER BY prioridade ASC"><i class="fas fa-sort-amount-down-alt"></i> Menos importantes
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
                        <th>Mensagem</th>               
                        <th>De</th>                       
                        <th>Prioridade</th>                       
                        <th>Data</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <!--cabeçalho -->   

                    <tbody>

                      <? foreach ($resultado as $linha) { ?>

                        <?
                        $nomeUser = $acoes->SelectSingle("SELECT nome FROM admin WHERE id = ".$linha['usuario_id'])['nome'];   

                        $current_url_edit = $_GET['p'] != '' ? 
                        "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id']."?p=".$_GET['p'] : 
                        "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/edit/".$linha['id'];
                        ?>

                        <tr>

                          <!--item -->
                          <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?=$linha['id']?>"><span></span></label></td>
                          <!--item --> 

                          <!--item -->
                          <td data-label="Mensagem" class="tr-lg-txt"><?=Tools::limitarTexto($linha['mensagem'], 100); ?></td>
                          <!--item -->
                          
                          <!--item -->
                          <td data-label="De"><?=$nomeUser?></td>
                          <!--item -->    

                          <!--item -->
                          <td data-label="Prioridade">
                            <?
                            $prioridade = array('null', 'Baixa', 'Média', 'Alta');
                            $color = $linha['prioridade'] == "3" ? "0" : $linha['prioridade'];
                            ?>
                            <label class="status status<?=$color?>">
                              <i class="fas fa-circle"></i>
                              <span><?=$prioridade[$linha['prioridade']]; ?></span> 
                            </label>
                          </td>
                          <!--item -->                     

                          <!--item -->
                          <td data-label="Data"><?=Tools::formataData($linha['data_cad']); ?></td>
                          <!--item -->   

                          <!--item -->
                          <td>
                            <a class="btn btn-sm btn-default btn-ler-aviso" data-msg="<?=$linha['mensagem']; ?>" data-user="<?=$nomeUser?>" href="#"><i class="fas fa-eye"></i> Visualizar</a>
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
                
                <!-- Modal aviso -->
                <div class="modal fade" id="modal-aviso" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>×</span>
                        </button>
                        <h4 class="modal-title">Aviso</h4>
                      </div>
                      <div class="modal-body">                        
                      </div>
                      <div class="modal-footer">                                
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>
                    </div>
                  </div>
                </div> 
                <!-- Fim Modal aviso -->
                <script type="text/javascript">
                  $(function() {
                    $('.btn-ler-aviso').on('click', function(e) {
                      e.preventDefault();
                      $('#modal-aviso .modal-body').html('');
                      $('#modal-aviso .modal-body').html('<p><b>De:</b> '+$(this).data('user')+'</p><p>'+$(this).data('msg')+'</p>');                                 
                      $('#modal-aviso').modal('show');
                    });
                  });
                </script>
              
                <input type="hidden" id="confere" value="" />
                <input type="hidden" name="tabela_atual" id="tabela_atual" value="<?=$tabela; ?>" />
                <input type="hidden" name="token" value="<?=TOKEN; ?>" />
                <input type="hidden" name="acao_exec" id="acao_exec" value="" />
                <input type="hidden" name="campo" value="status"  />
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
