<? include ("".ACOES_ADMIN_PATH."/".$pasta_modulo."/paginas.php"); ?>

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
   
              <!--formulario --> 
              <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?=$action_form; ?>" enctype="multipart/form-data">

                <? if ($paginas_conf[$pagina]['titulo_pag'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo_pag">
                    Título da página
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo_pag" id="titulo_pag" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo_pag']; ?>">
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div> 
                <? } ?>

                <? if ($paginas_conf[$pagina]['banner_login'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[banner_login]"> Banner (Login)                 
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[banner_login]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['banner_login']?>" <? } ?>>
                    <label for="img[banner_login]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo'] === true || $paginas_conf[$pagina]['subtitulo'] === true || $paginas_conf[$pagina]['texto'] === true || $paginas_conf[$pagina]['foto'] === true || $paginas_conf[$pagina]['banner'] === true) { ?>
                <div class="separator-form">
                  <div class="separator-form-titulo">1ª - Parte</div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['foto'] === true) { ?>
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
                <? } ?>        

                <? if ($paginas_conf[$pagina]['banner'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[banner]"> Banner                  
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[banner]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['banner']?>" <? } ?>>
                    <label for="img[banner]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div>
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['titulo'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">
                    Título
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo" id="titulo" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo']; ?>">
                  </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['subtitulo'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtitulo">
                    Subtítulo
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="subtitulo" id="subtitulo" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['subtitulo']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>

                <? if ($paginas_conf[$pagina]['texto'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor">Texto
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor" id="ckeditor" class="ckeditor" rows="1"><?=$linha_edit['texto']; ?></textarea>
                    <label for="ckeditor" class="error"></label>
                 </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo2'] === true || $paginas_conf[$pagina]['subtitulo2'] === true || $paginas_conf[$pagina]['texto2'] === true || $paginas_conf[$pagina]['foto2'] === true) { ?>
                <div class="separator-form">
                  <div class="separator-form-titulo">2ª - Parte</div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['foto2'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto2]"> Imagem                
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[foto2]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['foto2']?>" <? } ?>>
                    <label for="img[foto2]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div> 
                <? } ?> 

                <? if ($paginas_conf[$pagina]['titulo2'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo2">
                    Título
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo2" id="titulo2" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo2']; ?>">
                  </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['subtitulo2'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtitulo2">
                    Subtítulo
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="subtitulo2" id="subtitulo2" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['subtitulo2']; ?>">
                  </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['texto2'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor2">Texto
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor2" id="ckeditor2" class="ckeditor" rows="1"><?=$linha_edit['texto2']; ?></textarea>
                    <label for="ckeditor2" class="error"></label>
                 </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo3'] === true || $paginas_conf[$pagina]['subtitulo3'] === true || $paginas_conf[$pagina]['texto3'] === true || $paginas_conf[$pagina]['foto3'] === true) { ?>
                <div class="separator-form">
                  <div class="separator-form-titulo">3ª - Parte</div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['foto3'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto3]"> Imagem                
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[foto3]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['foto3']?>" <? } ?>>
                    <label for="img[foto3]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div> 
                <? } ?> 

                <? if ($paginas_conf[$pagina]['titulo3'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo3">
                    Título
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo3" id="titulo3" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo3']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['subtitulo3'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtitulo3">
                    Subtítulo
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="subtitulo3" id="subtitulo3" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['subtitulo3']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['texto3'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor3">Texto
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor3" id="ckeditor3" class="ckeditor" rows="1"><?=$linha_edit['texto3']; ?></textarea>
                    <label for="ckeditor3" class="error"></label>
                 </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo4'] === true || $paginas_conf[$pagina]['subtitulo4'] === true || $paginas_conf[$pagina]['texto4'] === true || $paginas_conf[$pagina]['foto4'] === true) { ?>
                <div class="separator-form">
                  <div class="separator-form-titulo">4ª - Parte</div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['foto4'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto4]"> Imagem                
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[foto4]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['foto4']?>" <? } ?>>
                    <label for="img[foto4]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div> 
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo4'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo4">
                    Título
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo4" id="titulo4" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo4']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['subtitulo4'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtitulo4">
                    Subtítulo
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="subtitulo4" id="subtitulo4" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['subtitulo4']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['texto4'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor4">Texto
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor4" id="ckeditor4" class="ckeditor" rows="1"><?=$linha_edit['texto4']; ?></textarea>
                    <label for="ckeditor4" class="error"></label>
                 </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo5'] === true || $paginas_conf[$pagina]['subtitulo5'] === true || $paginas_conf[$pagina]['texto5'] === true || $paginas_conf[$pagina]['foto5'] === true) { ?>
                <div class="separator-form">
                  <div class="separator-form-titulo">5ª - Parte</div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['foto5'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img[foto5]"> Imagem                
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="img[foto5]" accept="image/*" class="ezdz" <? if($acao == "edit"){ ?> data-value="<?=URL?>uploads/img/<?=$tabela?>/<?=$linha_edit['id']?>/<?=$linha_edit['foto5']?>" <? } ?>>
                    <label for="img[foto5]" class="error error-img"></label>
                  </div>
                </div>
                <!--repete -->
                <div class="separator-form"></div> 
                <? } ?>

                <? if ($paginas_conf[$pagina]['titulo5'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo5">
                    Título
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="titulo5" id="titulo5" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['titulo5']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['subtitulo5'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subtitulo5">
                    Subtítulo
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input name="subtitulo5" id="subtitulo5" type="text" class="form-control col-md-7 col-xs-12" value="<?=$linha_edit['subtitulo5']; ?>">
                  </div>
                </div>
                <!--repete --> 
                <? } ?>
                
                <? if ($paginas_conf[$pagina]['texto5'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor5">Texto
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="ckeditor5" id="ckeditor5" class="ckeditor" rows="1"><?=$linha_edit['texto5']; ?></textarea>
                    <label for="ckeditor5" class="error"></label>
                 </div>
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['fotos'] === true || $paginas_conf[$pagina]['blocos'] === true || $paginas_conf[$pagina]['icones'] === true || $paginas_conf[$pagina]['faq'] === true) { ?>
                <div class="separator-form">
                  <div class="separator-form-titulo">Adicionais</div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['fotos'] === true) { ?>
                <!--repete -->
                <div class="item form-group">
                  <div class="col-md-3 col-sm-3 col-xs-12"></div>
                  <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
                    <a href="<?=URL?>admin/paginas/paginas_fotos/<?=TOKEN?>/view/0/<?=$linha_edit['id']; ?>" class="btn btn-success btn-lg"><i class="fas fa-image"></i>Gerenciar Fotos</a> 
                  </div>                                   
                </div>
                <!--repete -->
                <? } ?>

                <? if ($paginas_conf[$pagina]['blocos'] === true) { ?>
                <div class="form-group">
                   <div class="col-md-3 col-sm-3 col-xs-12"></div>
                   <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
                      <a href="<?=URL?>admin/paginas/paginas_blocos/<?=TOKEN?>/view/0/<?=$linha_edit['id']; ?>" class="btn btn-lg btn-primary"><i class="fa fa-bars" aria-hidden="true"></i>
                      Gerenciar Blocos</a>
                  </div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['icones'] === true) { ?>
                <div class="form-group">
                   <div class="col-md-3 col-sm-3 col-xs-12"></div>
                   <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
                      <a href="<?=URL?>admin/paginas/paginas_icones/<?=TOKEN?>/view/0/<?=$linha_edit['id']; ?>" class="btn btn-lg btn-primary"><i class="fa fa-circle" aria-hidden="true"></i>
                      Gerenciar Ícones</a>
                  </div>
                </div>
                <? } ?>

                <? if ($paginas_conf[$pagina]['faq'] === true) { ?>
                <div class="form-group">
                   <div class="col-md-3 col-sm-3 col-xs-12"></div>
                   <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: left;">
                    <a href="<?=URL?>admin/paginas/paginas_faq/<?=TOKEN?>/view/0/<?=$linha_edit['id']; ?>" class="btn btn-lg btn-primary"><i class="fa fa-question" aria-hidden="true"></i> Gerenciar Perguntas</a>
                  </div>
                </div>
                <? } ?>

                <div class="ln_solid"></div>

                <!--botoes -->
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" id="bt1" class="btn btn-primary" value="bt1" name="bt1"><?=$msg_botao; ?></button>
                  </div>
                </div>
                <!--botoes -->

                <!--hidden fields -->
                <input type="hidden" name="retorno" id="retorno" value="">
                <input type="hidden" name="token" value="<?=TOKEN; ?>">
                <input type="hidden" name="acao" value="edit">               
                <input type="hidden" name="id" id="id" value="<?=$linha_edit['id']; ?>">      
                <!--hidden fields -->

              </form>
              <!--fim formulario -->

            </div>
            <!--fim cadastrar e editar  -->

          <? } ?>

        </div>
      </div>             
    </div>
    <!-- fim conteudo -->

  </div>
</div>
<!-- fim estrutura -->
