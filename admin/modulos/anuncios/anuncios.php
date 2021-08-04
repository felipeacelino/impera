<? include ("".ACOES_ADMIN_PATH."/".$pasta_modulo."/".$pag_include.".php"); ?>
<? include ("".ACOES_APP_PATH."/gerais/filtros.php"); ?>

<!-- estrutura -->
<div class="right_col" role="main">
  <div class="">

    <!-- titulo -->
    <div class="page-title">
      <div class="title_left">
        <h3>
          <?= $tit_pag_geral; ?>
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
                  <a href="<?= $current_url_view; ?>" class="btn btn-primary btn-header">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                  </a>
                </div>
              </div>
              <!-- FIM DIREITA -->
            </div>
            <!-- FIM LINHA HEADER -->

            <!--formulario -->
            <form id="form-geral" class="form-horizontal form-label-left" method="post" action="<?= $action_form; ?>" enctype="multipart/form-data">

              <div class="separator-form">
                <div class="separator-form-titulo">Anúncio</div>
              </div>

              <!--repete -->
              <link href="<?= URL; ?>admin/vendors/multiple-select-master/multiple-select-admin.css" rel="stylesheet" />
              <script src="<?= URL; ?>admin/vendors/multiple-select-master/multiple-select.js"></script>
              <style>
                .ms-parent input[type=radio] {
                  opacity: 0;
                }
              </style>

              <div class="item form-group" style="margin-bottom: 0px">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_cliente">
                  Proprietário *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="id_proprietario" id="id_proprietario" multiple="multiple" required>
                    <? foreach ($proprietarios as $proprietario) { ?>
                    <option value="<?= $proprietario['id']; ?>" <? if ($proprietario['id']==$linha_edit['id_proprietario']) { ?> selected
                      <? } ?>><?= $proprietario['nome']; ?> - <?= $proprietario['cpf']; ?></option>
                    <? } ?>
                  </select>
                  <label for="id_proprietario" class="error"></label>
                </div>
              </div>
              <script>
                $('#id_proprietario').multipleSelect({
                  filter: true,
                  placeholder: "Selecione",
                  selectAll: false,
                  minimumCountSelected: 1,
                  single: true,
                  allSelected: '<?= $proprietario['nome'] ?>',
                  countSelected: '# de % selecionados',
                  noMatchesFound: 'Proprietário não encontrado',
                  selectAllText: 'Selecionar todos',
                  selectAllDelimiter: [''],
                  onClick: function(view) {
                    $('#id_proprietario').valid();
                  }
                });
              </script>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">
                  Título *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="titulo" id="titulo" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['titulo']; ?>" required>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="codigo">
                  Código *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="codigo" id="codigo" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['codigo']; ?>" required>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo_anuncio">
                  Imóvel *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="tipo_anuncio" id="tipo_anuncio" class="form-control col-md-7 col-xs-12" required>
                    <option value="temporada" <? if ('temporada'==$linha_edit['tipo_anuncio']) { ?> selected <? } ?>>Temporada</option>
                    <option value="venda" <? if ('venda'==$linha_edit['tipo_anuncio']) { ?> selected <? } ?>>Venda</option>
                    <option value="venda_e_temporada" <? if ('venda_e_temporada'==$linha_edit['tipo_anuncio']) { ?> selected <? } ?>>Venda e Temporada</option>
                  </select>
                </div>
              </div>
              <!--repete -->              

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor">Observações do Contrato
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="observacoes_contrato" id="observacoes_contrato" class="form-control col-md-7 col-xs-12" rows="3"><?= $linha_edit['observacoes_contrato']; ?></textarea>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                  Status *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>
                    <input type="checkbox" name="status" id="status" class="switch" value="1" data-label-true="Ativo" data-label-false="Inativo" <? if($acao=='edit' ){ Tools::checked("1",$linha_edit['status']); } else { ?> checked
                    <? } ?> />
                    <span class="switch-label"></span>
                  </label>
                </div>
              </div>
              <!--repete -->

              <div class="separator-form">
                <div class="separator-form-titulo">Imóvel</div>
              </div>

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ckeditor">Descrição *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="ckeditor" id="ckeditor" class="ckeditor" rows="1" required><?= $linha_edit['descricao']; ?></textarea>
                  <label for="ckeditor" class="error"></label>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group" id="campo-video">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="video">
                  Vídeo (Código)
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="video" id="video" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['video']; ?>">
                  <small class="help">
                    <i class="fa fa-info-circle"></i>
                    Ex: https://www.youtube.com/watch?v=<b>pCVF0CSRTYA</b><br>
                  </small>
                </div>
              </div>

              <? if ($linha_edit['video'] != '') { ?>
                <div class="item form-group" id="campo-video">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="video">
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <iframe src="https://www.youtube.com/embed/<?= $linha_edit['video'] ?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></iframe>
                  </div>
                </div>
              <? } ?>
              <!--repete -->
                
              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distancia_praia">
                  Distância da praia
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="distancia_praia" id="distancia_praia" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['distancia_praia']; ?>">
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <div class="campo-temporada">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor">
                    Valor por diária *
                  </label>
                  <div class="col-md-2 col-sm-3 col-xs-12">
                    <input name="valor" id="valor" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['valor']); ?>">
                  </div>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <div class="campo-venda">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor_venda">
                    Valor para venda *
                  </label>
                  <div class="col-md-2 col-sm-3 col-xs-12">
                    <input name="valor_venda" id="valor_venda" type="text" class="form-control col-md-7 col-xs-12 valor" value="<?= Tools::formataMoeda($linha_edit['valor_venda']); ?>">
                  </div>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo">
                  Tipo de imóvel *
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <select name="tipo" id="tipo" class="form-control col-md-7 col-xs-12" required>
                    <option value="" hidden>Selecione</option>
                    <? foreach ($tipo_de_imovel as $key => $filtro_row) { ?>
                    <option value="<?= $key ?>" <?= Tools::selected($key, $linha_edit['tipo']) ?>><?= $filtro_row ?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group campo-venda">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="metragem">
                  Metragem
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <input name="metragem" id="metragem" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['metragem']; ?>">
                </div>
                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="area_construida">
                  Área construída
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <input name="area_construida" id="area_construida" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['area_construida']; ?>">
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <div class="campo-temporada">
                  <label class="control-label col-md-3 col-sm-2 col-xs-12" for="estadia_minima">
                    Estadia mínima *
                  </label>
                  <div class="col-md-2 col-sm-3 col-xs-12">
                    <div class="number-picker-input">
                      <span class="number-picker-sub disabled" data-target="#estadia_minima"><i class="fas fa-minus-circle"></i></span>
                      <input type="text" id="estadia_minima" name="estadia_minima" data-min="0" <? if($acao=='insert' ){ ?> value="0"
                      <? } else { ?> value="<?= $linha_edit['estadia_minima'] ?>"
                      <? } ?> readonly="" required="">
                      <span class="number-picker-add" data-target="#estadia_minima"><i class="fas fa-plus-circle"></i></span>
                    </div>
                  </div>
                </div>
                <label id="label-vaga" class="control-label col-md-2 col-sm-2 col-xs-12" for="vagas">
                  Vagas *
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <div class="number-picker-input">
                    <span class="number-picker-sub disabled" data-target="#vagas"><i class="fas fa-minus-circle"></i></span>
                    <input type="text" id="vagas" name="vagas" data-min="0" <? if($acao=='insert' ){ ?> value="0"
                    <? } else { ?> value="<?= $linha_edit['vagas'] ?>"
                    <? } ?> readonly="" required="">
                    <span class="number-picker-add" data-target="#vagas"><i class="fas fa-plus-circle"></i></span>
                  </div>
                </div>
              </div>

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-2 col-xs-12" for="hospedes">
                  Hóspedes *
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <div class="number-picker-input">
                    <span class="number-picker-sub disabled" data-target="#hospedes"><i class="fas fa-minus-circle"></i></span>
                    <input type="text" id="hospedes" name="hospedes" data-min="0" <? if($acao=='insert' ){ ?> value="0"
                    <? } else { ?> value="<?= $linha_edit['hospedes'] ?>"
                    <? } ?> readonly="" required="">
                    <span class="number-picker-add" data-target="#hospedes"><i class="fas fa-plus-circle"></i></span>
                  </div>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="quartos">
                  Quartos *
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <div class="number-picker-input">
                    <span class="number-picker-sub disabled" data-target="#quartos"><i class="fas fa-minus-circle"></i></span>
                    <input type="text" id="quartos" name="quartos" data-min="0" <? if($acao=='insert' ){ ?> value="0"
                    <? } else { ?> value="<?= $linha_edit['quartos'] ?>"
                    <? } ?> readonly="" required="">
                    <span class="number-picker-add" data-target="#quartos"><i class="fas fa-plus-circle"></i></span>
                  </div>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="suites">
                  Suítes *
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <div class="number-picker-input">
                    <span class="number-picker-sub disabled" data-target="#suites"><i class="fas fa-minus-circle"></i></span>
                    <input type="text" id="suites" name="suites" data-min="0" <? if($acao=='insert' ){ ?> value="0"
                    <? } else { ?> value="<?= $linha_edit['suites'] ?>"
                    <? } ?> readonly="" required="">
                    <span class="number-picker-add" data-target="#suites"><i class="fas fa-plus-circle"></i></span>
                  </div>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="banheiros">
                  Banheiros *
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                  <div class="number-picker-input">
                    <span class="number-picker-sub disabled" data-target="#banheiros"><i class="fas fa-minus-circle"></i></span>
                    <input type="text" id="banheiros" name="banheiros" data-min="0" <? if($acao=='insert' ){ ?> value="0"
                    <? } else { ?> value="<?= $linha_edit['banheiros'] ?>"
                    <? } ?> readonly="" required="">
                    <span class="number-picker-add" data-target="#banheiros"><i class="fas fa-plus-circle"></i></span>
                  </div>
                </div>
              </div>
              <!--repete -->

              <div class="separator-form">
                <div class="separator-form-titulo">Características</div>
              </div>

              <!--repete -->
              <? $count = 0; foreach ($caracteristicas as $key => $filtro_row) {
                  $count++;
                  if($key % 2 == 0){
                    $class_style = 'col-md-3 col-sm-3 col-xs-12';
                    echo "<div class='item form-group'>";
                  } else {
                    $class_style = 'col-md-2 col-sm-3 col-xs-12';
                  } 
                  if($key == 0){
                    $class_style = 'col-md-3 col-sm-3 col-xs-12';
                  }
                ?>
              <label class="control-label <?= $class_style ?>" for="caracteristicas">
                <?= $filtro_row['caracteristica'] ?> *
              </label>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <label>
                  <input type="checkbox" name="caracteristicas[]" id="caracteristicas" class="switch" value="<?= $filtro_row['id'] ?>" data-label-true="Sim" data-label-false="Não" <? if(in_array($filtro_row['id'], $caracteristicas_atuais)){ ?> checked
                  <? } ?> />
                  <span class="switch-label"></span>
                </label>
              </div>
              <? 
                if($count == 2){
                  echo "</div>";
                  $count = 0;
                }
              } ?>
              <!--repete -->

              <div class="separator-form">
                <div class="separator-form-titulo">Localização</div>
              </div>

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">
                  Cidade *
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="cidade" id="cidade" class="form-control col-md-7 col-xs-12 gera-lat-long" required>
                    <option value="" hidden>Selecione a cidade</option>
                    <? foreach ($cidades as $cidade) { ?>
                    <option value="<?= $cidade['cidade'] ?>" data-estado="<?= $cidade['estado'] ?>" <?= Tools::selected($cidade['cidade'], $linha_edit['cidade']) ?>><?= $cidade['cidade'] ?></option>
                    <? } ?>
                  </select>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="destino">
                  Destino
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="destino" id="destino" class="form-control col-md-7 col-xs-12 gera-lat-long" data-sync-url="<?= "" . URL . "acoes/admin/" . $pasta_modulo . "/retorna_destinos.php" ?>" data-sync-input="#cidade" data-sync-param="cidade" data-sync-value="<?= $linha_edit['destino'] ?>" data-sync-option-value="id" data-sync-option-text="destino" data-sync-placeholder="Selecione">
                    <option value="" hidden>Selecione o destino</option>
                  </select>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="condominio">
                  Condomínio
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="condominio" id="condominio" class="form-control col-md-7 col-xs-12 gera-lat-long" data-sync-url="<?= "" . URL . "acoes/admin/" . $pasta_modulo . "/retorna_condominios.php" ?>" data-sync-input="#cidade" data-sync-param="cidade" data-sync-value="<?= $linha_edit['condominio'] ?>" data-sync-option-value="id" data-sync-option-text="condominio" data-sync-placeholder="Selecione">
                    <option value="" hidden>Selecione o condomínio</option>
                  </select>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cep">
                  CEP
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="cep" id="cep" type="text" class="form-control col-md-7 col-xs-12 gera-lat-long cep" value="<?= $linha_edit['cep']; ?>">
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endereco">Endereço<br>
                  <small><i class="fa fa-info-circle"></i> Apenas para controle interno<br> (não será exibido no site)</small>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea name="endereco" id="endereco" class="form-control" rows="3"><?= $linha_edit['endereco']; ?></textarea>
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitude">Latitude<br>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="latitude" id="latitude" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['latitude']; ?>">
                </div>
              </div>
              <!--repete -->

              <!--repete -->
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitude">Longitude<br>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="longitude" id="longitude" type="text" class="form-control col-md-7 col-xs-12" value="<?= $linha_edit['longitude']; ?>">
                </div>
              </div>
              <!--repete -->

              <div class="ln_solid"></div>

              <!--botoes -->
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" id="bt1" class="btn btn-primary" value="bt1" name="bt1"><?= $msg_botao; ?> e continuar</button>
                  <button type="submit" id="bt2" class="btn btn-success" value="bt2" name="bt2"><?= $msg_botao; ?></button>
                </div>
              </div>
              <!--botoes -->

              <!--hidden fields -->
              <input type="hidden" name="retorno" id="retorno" value="">
              <input type="hidden" name="token" value="<?= TOKEN; ?>">
              <input type="hidden" name="acao" value="<?= $acao; ?>">
              <input type="hidden" name="tabela_verifica" id="tabela_verifica" value="<?= $tabela; ?>">
              <? if($acao == "edit"){ ?>
              <input type="hidden" name="id" id="id" value="<?= $id_enviado; ?>">
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
                  <a href="<?= $current_url_insert; ?>" class="btn btn-success btn-header">
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
                <form method="post" action="<?= $acao_filtros ?>">
                  <div class="filtros-itens">

                    <!-- Item filtro -->
                    <link href="<?= URL; ?>admin/vendors/multiple-select-master/multiple-select-admin.css" rel="stylesheet" />

                    <div class="campo-filtro form-group">
                      <label for="filtro_proprietario" class="control-label">Proprietário:</label>
                      <select name="filtro_proprietario" id="filtro_proprietario" multiple="multiple" class="campos_busca">
                        <? foreach ($proprietarios as $proprietario) { ?>
                        <option value="<?= $proprietario['id']; ?>" <?= Tools::selected("" . $proprietario['id'] . "", $_SESSION[$pag_include]['filtros']['filtro_proprietario']) ?>><?= $proprietario['nome']; ?> - <?=$proprietario['cpf']; ?></option>
                        <? } ?>
                      </select>
                    </div>
                    <script src="<?= URL; ?>admin/vendors/multiple-select-master/multiple-select.js"></script>
                    <script>
                      $('#filtro_proprietario').multipleSelect({
                        filter: true,
                        placeholder: "Selecione",
                        selectAll: false,
                        minimumCountSelected: 1,
                        single: true,
                        allSelected: 'Proprietário Selecionado',
                        countSelected: '# de % selecionados',
                        noMatchesFound: 'Proprietário não encontrado',
                        selectAllText: 'Selecionar todos',
                        selectAllDelimiter: [''],
                        onClick: function(view) {
                          $('#filtro_proprietario').valid();
                        }
                      });
                    </script>
                    <style>
                      .ms-parent{
                        height: 34px;
                      }
                      .ms-parent input[type=radio] {
                        opacity: 0;
                      }
                    </style>
                    <!-- //Item filtro -->

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_codigo" class="control-label">Código:</label>
                      <input type="text" name="filtro_codigo" id="filtro_codigo" class="form-control" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_codigo'] ?>">
                    </div>
                    <!-- // Item filtro -->

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_titulo" class="control-label">Anúncio:</label>
                      <input type="text" name="filtro_titulo" id="filtro_titulo" class="form-control" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_titulo'] ?>">
                    </div>
                    <!-- // Item filtro -->

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_cidade" class="control-label">Cidade:</label>
                      <select name="filtro_cidade" id="filtro_cidade" class="form-control">
                        <option value="">Todas</option>
                        <? foreach ($cidades as $cidade) { ?>
                        <option value="<?= $cidade['cidade'] ?>" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_cidade'], $cidade['cidade']) ?>><?= $cidade['cidade'] ?></option>
                        <? } ?>
                      </select>
                    </div>
                    <!-- // Item filtro -->

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_status" class="control-label">Status:</label>
                      <select name="filtro_status" id="filtro_status" class="form-control">
                        <option value="">Todos</option>
                        <option value="1" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "1") ?>>Ativos</option>
                        <option value="0" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_status'], "0") ?>>Inativos</option>
                      </select>
                    </div>
                    <!-- // Item filtro -->

                    <!-- Item filtro -->
                    <div class="campo-filtro form-group">
                      <label for="filtro_tipo" class="control-label">Tipo:</label>
                      <select name="filtro_tipo" id="filtro_tipo" class="form-control">
                        <option value="">Todos</option>
                        <option value="temporada" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipo'], "temporada") ?>>Temporada</option>
                        <option value="venda" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipo'], "venda") ?>>Venda</option>
                        <option value="venda_e_temporada" <?= Tools::selected($_SESSION[$pag_include]['filtros']['filtro_tipo'], "venda_e_temporada") ?>>Venda e Temporada</option>
                      </select>
                    </div>
                    <!-- // Item filtro -->

                    <!-- Item filtro ->
                    <div class="campo-filtro form-group">
                      <label for="filtro_data" class="control-label">Data de cadastro:</label>
                      <input type="text" name="filtro_data" id="filtro_data" class="form-control data_range" data-popup-direction="left" readonly="readonly" maxlength="255" value="<?= $_SESSION[$pag_include]['filtros']['filtro_data'] ?>">
                    </div>
                    <!-- // Item filtro -->

                  </div>
                  <div class="filtros-actions full">
                    <a href="<?= URL ?>acoes/admin/geral/limpar_filtros.php?pagina=<?= $pag_include ?>&retorno=<?= $_SERVER['REQUEST_URI'] ?>" class="btn btn-default"><i class="fas fa-times"></i> Limpar</a>
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

                <!-- EXPORTAR -->
                <div class="header_row_item">
                  <form action="<?= URL ?>acoes/admin/<?= $pasta_modulo ?>/exportar_anuncios.php" method="POST">
                    <button action="submit" class="btn btn-default" href="<?= URL ?>acoes/admin/<?= $pasta_modulo ?>/exportar_anuncios.php">
                      <i class="fa fa-arrow-circle-down"></i>
                      Exportar Relatório (Excel)
                    </button>
                    <input type="hidden" name="filtro_proprietario" value="<?= $_SESSION[$pag_include]['filtros']['filtro_proprietario'] ?>">
                    <input type="hidden" name="filtro_titulo" value="<?= $_SESSION[$pag_include]['filtros']['filtro_titulo'] ?>">
                    <input type="hidden" name="filtro_codigo" value="<?= $_SESSION[$pag_include]['filtros']['filtro_codigo'] ?>">
                    <input type="hidden" name="filtro_cidade" value="<?= $_SESSION[$pag_include]['filtros']['filtro_cidade'] ?>">
                    <input type="hidden" name="filtro_status" value="<?= $_SESSION[$pag_include]['filtros']['filtro_status'] ?>">
                    <input type="hidden" name="filtro_tipo" value="<?= $_SESSION[$pag_include]['filtros']['filtro_tipo'] ?>">
                  </form>
                </div>
                <!-- FIM EXPORTAR -->

              </div>
              <!-- FIM ESQUERDA -->

              <!-- DIREITA -->
              <div class="header_row_right">

                <div class="header_row_item header_row_item_hide">
                  <i class="fas fa-file-alt"></i> <?= $total_registros; ?> registro(s)
                </div>

                <!-- ORDEM -->
                <div class="header_row_item">
                  <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Ordenar
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                      <li>
                        <a class="acao-ordenar" data-ordem="ORDER BY a.titulo ASC"><i class="fas fa-sort-alpha-down"></i> Título (A-Z)
                        </a>
                      </li>
                      <li>
                        <a class="acao-ordenar" data-ordem="ORDER BY a.titulo DESC"><i class="fas fa-sort-alpha-down-alt"></i> Título (Z-A)
                        </a>
                      </li>
                      <li role="separator" class="divider"></li>
                      <li>
                        <a class="acao-ordenar" data-ordem="ORDER BY a.views DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais vistos
                        </a>
                      </li>
                      <li>
                        <a class="acao-ordenar" data-ordem="ORDER BY a.views ASC"><i class="fas fa-sort-numeric-down"></i> Menos vistos
                        </a>
                      </li>
                      <li role="separator" class="divider"></li>
                      <li>
                        <a class="acao-ordenar" data-ordem="ORDER BY a.data_cad DESC"><i class="fas fa-sort-numeric-down-alt"></i> Mais novos
                        </a>
                      </li>
                      <li>
                        <a class="acao-ordenar" data-ordem="ORDER BY a.data_cad ASC"><i class="fas fa-sort-numeric-down"></i> Mais antigos
                        </a>
                      </li>
                    </ul>
                    <form id="form-ordem" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                      <input type="hidden" name="sort_ordem" id="sort_ordem" value="<?= $_SESSION[$pag_include]['ordem'] ?>">
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
                    <th>Anúncio</th>
                    <th>Visualizações</th>
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
                    
                    // FOTOS
                    $url_fotos = $_GET['p'] != '' ? 
                    "".URL."admin/".$pasta_modulo."/anuncios_fotos/".TOKEN."/view/0/".$linha['id']."?p2=".$_GET['p'] : 
                    "".URL."admin/".$pasta_modulo."/anuncios_fotos/".TOKEN."/view/0/".$linha['id'];

                    // FAIXAS DE PREÇO
                    $url_precos = $_GET['p'] != '' ? 
                    "".URL."admin/".$pasta_modulo."/anuncios_precos/".TOKEN."/view/0/".$linha['id']."?p2=".$_GET['p'] : 
                    "".URL."admin/".$pasta_modulo."/anuncios_precos/".TOKEN."/view/0/".$linha['id'];

                    // TAXA
                    $url_taxas = $_GET['p'] != '' ? 
                    "".URL."admin/".$pasta_modulo."/anuncios_taxas/".TOKEN."/view/0/".$linha['id']."?p2=".$_GET['p'] : 
                    "".URL."admin/".$pasta_modulo."/anuncios_taxas/".TOKEN."/view/0/".$linha['id'];

                    // AVALIAÇÕES
                    $url_avaliacoes = $_GET['p'] != '' ? 
                    "".URL."admin/".$pasta_modulo."/anuncios_avaliacoes/".TOKEN."/view/0/".$linha['id']."?p2=".$_GET['p'] : 
                    "".URL."admin/".$pasta_modulo."/anuncios_avaliacoes/".TOKEN."/view/0/".$linha['id'];

                    // DATAS INDIPONÍVEIS
                    $url_datas_indisponiveis = $_GET['p'] != '' ? 
                    "".URL."admin/".$pasta_modulo."/anuncios_datas_indisponiveis/".TOKEN."/view/0/".$linha['id']."?p2=".$_GET['p'] : 
                    "".URL."admin/".$pasta_modulo."/anuncios_datas_indisponiveis/".TOKEN."/view/0/".$linha['id'];

                    // FOTO DE DESTAQUE
                    $fotoDest = $acoes->SelectSingle("SELECT foto FROM anuncios_fotos WHERE destaque = 1 AND item_id = ".$linha['id']." LIMIT 1")['foto'];                          
                    $fotoDest = $fotoDest != "" ? 
                    "".URL."uploads/img/anuncios/".$linha['id']."/anuncios_fotos/thumb-300-200/".$fotoDest :
                    "".URL."static/img/admin/sem-foto.jpg";
                  ?>

                  <tr>

                    <!--item -->
                    <td><label class="check"><input type="checkbox" class="checkbox1" name="id[]" value="<?= $linha['id'] ?>"><span></span></label></td>
                    <!--item -->

                    <!--item -->
                    <td class="tr-lg">
                      <img src="<?= $fotoDest ?>">
                    </td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Anúncio">
                      <p><b><?= Tools::limitarTexto($linha['titulo'], 100); ?></b></p>
                      <? if ($linha['tipo_anuncio'] == 'temporada') { ?>
                        <p><b style="color: #64BD63">Temporada</b></p>
                      <? } else if ($linha['tipo_anuncio'] == 'venda') { ?>
                        <p><b style="color: #42A5F5">Venda</b></p>
                      <? } else { ?>
                        <p><b style="color: #FFA000">Venda e Temporada</b></p>
                      <? } ?>
                      <? if ($linha['tipo_anuncio'] == 'temporada') { ?>
                        <p><b>Diária: </b>R$ <?= Tools::formataMoeda($linha['valor']); ?></p>
                      <? } else if ($linha['tipo_anuncio'] == 'venda') { ?>
                        <p><b>Valor para Venda: </b>R$ <?= Tools::formataMoeda($linha['valor_venda']); ?></p>
                      <? } else { ?>
                        <p><b>Diária: </b>R$ <?= Tools::formataMoeda($linha['valor']); ?></p>
                        <p><b>Valor para Venda: </b>R$ <?= Tools::formataMoeda($linha['valor_venda']); ?></p>
                      <? } ?>
                      <p><b>Código: </b><?= $linha['codigo']; ?></p>
                      <p><b>Cidade: </b><?= $linha['cidade']; ?></p>
                      <p><b>Proprietário: </b><?= $linha['proprietario']; ?></p>
                      <? if ($linha['aceitacao_contrato'] == 1) { ?>
                      <label class="status status1">
                        <i class="fas fa-circle"></i>
                        <span>Aceitou os Termos</span>
                      </label>
                      <? } ?>
                    </td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Views"><i class="fas fa-eye"></i> <?= $linha['views']; ?></td>
                    <!--item -->

                    <!--item -->
                    <td data-label="Status">
                      <?
                        $status = array('Inativo', 'Ativo', 'Pendente');
                      ?>
                      <label class="status status<?= $linha['status']; ?>">
                        <i class="fas fa-circle"></i>
                        <span><?= $status[$linha['status']]; ?></span>
                      </label>
                    </td>
                    <!--item -->

                    <!--item -->
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" style="font-size: 13px;">Gerenciar
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <? if ($linha['tipo_anuncio'] == 'temporada' || $linha['tipo_anuncio'] == 'venda_e_temporada') { ?>
                            <li>
                              <a href="<?= $url_datas_indisponiveis ?>" style="font-size: 13px;"><i class="fas fa-calendar-alt"></i> Datas Indisponíveis</a>
                            </li>
                            <li>
                              <a href="<?= $url_precos ?>" style="font-size: 13px;"><i class="fas fa-money-bill"></i> Tarifas Diferenciadas</a>
                            </li>
                            <li>
                              <a href="<?= $url_taxas ?>" style="font-size: 13px;"><i class="fas fa-hand-holding-usd"></i> Taxas</a>
                            </li>
                          <? } ?>
                          <li>
                            <a href="<?= $url_fotos ?>" style="font-size: 13px;"><i class="fas fa-image"></i> Fotos</a>
                          </li>
                          <li>
                            <a href="<?= $url_avaliacoes ?>" style="font-size: 13px;"><i class="fas fa-star"></i> Avaliações</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                    <!--item -->

                    <!--item -->
                    <td>
                      <a class="btn btn-xs btn-default" href="<?= $current_url_edit ?>"><i class="fas fa-edit"></i> Editar</a><br>
                      <a href="#" class="btn btn-xs btn-danger btn-remove" data-iddel="<?= $linha['id']; ?>"><i class="fas fa-trash-alt"></i> Remover</a><br>
                      <a href="<?= URL ?>acoes/app/proprietario/gera_contrato.php?anuncio_id=<?= $linha['id'] ?>" class="btn btn-xs btn-info"><i class="fas fa-file-alt"></i> Contrato</a>
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
              <input type="hidden" name="tabela_atual" id="tabela_atual" value="<?= $tabela; ?>" />
              <input type="hidden" name="token" value="<?= TOKEN; ?>" />
              <input type="hidden" name="acao_exec" id="acao_exec" value="" />
              <input type="hidden" name="campo" value="status" />
              <input type="hidden" name="status" id="status">
              <input type="hidden" name="retorno" value="<?= $_SERVER['REQUEST_URI']; ?>" />

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

                  <form id="form_excluir" name="form_excluir" method="post" action="<?= $current_url_delete; ?>">

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
