<?php
if (!isset($_SESSION)) { session_start(); }
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".CLASS_PATH."/uploads.php");
Tools::debug(false);
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".ACOES_APP_PATH."/corretor/restrito.php");

$anuncios = new Crud('anuncios');
$anunciosCaracteristicas = new Crud('anuncios_caracteristicas_n_n');
$anunciosComodidades = new Crud('anuncios_comodidades_n_n');
$anunciosComodos = new Crud('anuncios_comodos_n_n');
$anunciosComodos2 = new Crud('anuncios_comodos2_n_n');
$anunciosCondominio = new Crud('anuncios_condominio_n_n');
$anunciosLazer = new Crud('anuncios_lazer_n_n');
$anunciosMobilias = new Crud('anuncios_mobilias_n_n');
$anunciosSeguranca = new Crud('anuncios_seguranca_n_n');
$anunciosBairros = new Crud('bairros');
$anunciosFotos = new Crud('anuncios_fotos');

if ($_POST['acao'] == "insert") {

  $slug = Tools::geraSlug(Tools::protege($_POST['titulo']));
    
  // DADOS
  $dados = array(
    'id_usuario' => $user['id'],
    'tipo_user' => "corretor",
    'finalidade' => Tools::protege($_POST['finalidade']),
    'governo' => 0,
    'tipo_id' => Tools::protege($_POST['tipo_id']),
    'tipo' => Tools::protege($_POST['tipo']),
    'titulo' => Tools::protege($_POST['titulo']),
    'area' => $_POST['area'] != "" ? Tools::somenteNumeros($_POST['area']) : 0,
    'quartos' => $_POST['quartos'] != "" ? Tools::somenteNumeros($_POST['quartos']) : 0,
    'banheiros' => $_POST['banheiros'] != "" ? Tools::somenteNumeros($_POST['banheiros']) : 0,
    'vagas' => $_POST['vagas'] != "" ? Tools::somenteNumeros($_POST['vagas']) : 0,
    'andar' => $_POST['andar'] != "" ? Tools::somenteNumeros($_POST['andar']) : 0,
    'sol' => Tools::protege($_POST['sol']),
    'orientacao' => Tools::protege($_POST['orientacao']),
    'valor_venda' => $_POST['valor_venda'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_venda']))) : 0.00,
    'valor_aluguel' => $_POST['valor_aluguel'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_aluguel']))) : 0.00,
    'valor_condominio' => $_POST['valor_condominio'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_condominio']))) : 0.00,
    'valor_iptu' => $_POST['valor_iptu'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_iptu']))) : 0.00,
    'valor_seguro_incendio' => 0.00,
    'valor_taxa_servico' => 0.00,
    'cep' => Tools::protege($_POST['cep']),
    'logradouro' => Tools::protege($_POST['logradouro']),
    'numero' => Tools::protege($_POST['numero']),
    'complemento' => Tools::protege($_POST['complemento']),
    'bairro' => Tools::protege($_POST['bairro']),
    'cidade' => Tools::protege($_POST['cidade']),
    'estado' => Tools::protege($_POST['estado']),
    'bairro_id' => Tools::protege($_POST['bairro_id']),
    'cidade_id' => Tools::protege($_POST['cidade_id']),
    'estado_id' => Tools::protege($_POST['estado_id']),
    'lat' => Tools::protege($_POST['lat']),
    'lng' => Tools::protege($_POST['lng']),
    'regiao_id' => $_POST['regiao_id'] != "" ? Tools::protege($_POST['regiao_id']) : 0,
    'mobiliado' => $_POST['mobiliado'] != "" ? Tools::somenteNumeros($_POST['mobiliado']) : 0,
    'possui_elevador' => $_POST['possui_elevador'] != "" ? Tools::somenteNumeros($_POST['possui_elevador']) : 0,
    'proximo_metro' => $_POST['proximo_metro'] != "" ? Tools::somenteNumeros($_POST['proximo_metro']) : 0,
    'proximo_brt' => $_POST['proximo_brt'] != "" ? Tools::somenteNumeros($_POST['proximo_brt']) : 0,
    'proximo_trem' => $_POST['proximo_trem'] != "" ? Tools::somenteNumeros($_POST['proximo_trem']) : 0,
    'aceita_pet' => $_POST['aceita_pet'] != "" ? Tools::somenteNumeros($_POST['aceita_pet']) : 0,
    'domingo_status' => array_search("domingo", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'segunda_status' => array_search("segunda", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'terca_status' => array_search("terca", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'quarta_status' => array_search("quarta", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'quinta_status' => array_search("quinta", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'sexta_status' => array_search("sexta", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'sabado_status' => array_search("sabado", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'domingo_inicio' => Tools::protege($_POST['domingo_inicio']),
    'domingo_fim' => Tools::protege($_POST['domingo_fim']),
    'segunda_inicio' => Tools::protege($_POST['segunda_inicio']),
    'segunda_fim' => Tools::protege($_POST['segunda_fim']),
    'terca_inicio' => Tools::protege($_POST['terca_inicio']),
    'terca_fim' => Tools::protege($_POST['terca_fim']),
    'quarta_inicio' => Tools::protege($_POST['quarta_inicio']),
    'quarta_fim' => Tools::protege($_POST['quarta_fim']),
    'quinta_inicio' => Tools::protege($_POST['quinta_inicio']),
    'quinta_fim' => Tools::protege($_POST['quinta_fim']),
    'sexta_inicio' => Tools::protege($_POST['sexta_inicio']),
    'sexta_fim' => Tools::protege($_POST['sexta_fim']),
    'sabado_inicio' => Tools::protege($_POST['sabado_inicio']),
    'sabado_fim' => Tools::protege($_POST['sabado_fim']),
    'exclusivo' => $_POST['exclusivo'] != "" ? Tools::somenteNumeros($_POST['exclusivo']) : 0,
    'taxa' => $_POST['exclusivo'] != "" ? TAXA_EXCLUSIVOS : TAXA,
    'residente' => $_POST['residente'] != "" ? Tools::somenteNumeros($_POST['residente']) : 0,
    'prop_nome' => Tools::protege($_POST['prop_nome']),
    'prop_tel' => Tools::protege($_POST['prop_tel']),
    'prop_email' => Tools::protege($_POST['prop_email']),
    'destaque' => 0,
    'status' => 1,
    'views' => 0,
    'slug' => $slug,
    'data_cad' => Tools::getDateTime()
  );	

  $operacao = $anuncios->Insert($dados);
   
  if ($operacao) {

    $ultimoId = $anuncios->getId();

    // Código e hash
    $zeros_cod_pedido = Tools::zerofill($ultimoId, 6);
    $pre = "IR";
    $ref = $pre.$zeros_cod_pedido;
    $hash = Tools::geraHash('sha1',Tools::getDateTime()).$ultimoId;
    $dadosHash = array(
      'hash' => $hash,
      'codigo' => $ref
    );
    $anuncios->Update($dadosHash,"WHERE id='$ultimoId'");

    // Verifica se existe mais de um registro com a mesma slug
    $slugJaExiste = $anuncios->SelectTotalSQL("SELECT id FROM anuncios WHERE slug='$slug'");
    if ($slugJaExiste > 1) {
      $slug = $slug."-".$ultimoId;
      $updateSlug = $anuncios->Update(["slug" => $slug], "WHERE id=$ultimoId");
    }

    // Cômodos
    if (is_array($_POST['comodos'])) {
      foreach ($_POST['comodos'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'comodo_id' => Tools::protege($item)
        );
        $anunciosComodos->Insert($dadosItem);
      }
    }

    // Detalhes do imóvel
    if (is_array($_POST['caracteristicas'])) {
      foreach ($_POST['caracteristicas'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'caracteristica_id' => Tools::protege($item)
        );
        $anunciosCaracteristicas->Insert($dadosItem);
      }
    }

    // Detalhes do condomínio
    if (is_array($_POST['condominio'])) {
      foreach ($_POST['condominio'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'condominio_id' => Tools::protege($item)
        );
        $anunciosCondominio->Insert($dadosItem);
      }
    }

    // Mobílias e eletros
    if (is_array($_POST['mobilias'])) {
      foreach ($_POST['mobilias'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'mobilia_id' => Tools::protege($item)
        );
        $anunciosMobilias->Insert($dadosItem);
      }
    }

    // Comodidades
    if (is_array($_POST['comodidades'])) {
      foreach ($_POST['comodidades'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'comodidade_id' => Tools::protege($item)
        );
        $anunciosComodidades->Insert($dadosItem);
      }
    }

    // Segurança
    if (is_array($_POST['seguranca'])) {
      foreach ($_POST['seguranca'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'seguranca_id' => Tools::protege($item)
        );
        $anunciosSeguranca->Insert($dadosItem);
      }
    }

    // Lazer e esporte
    if (is_array($_POST['lazer'])) {
      foreach ($_POST['lazer'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'lazer_id' => Tools::protege($item)
        );
        $anunciosLazer->Insert($dadosItem);
      }
    }

    // Cômodos (Comercial)
    if (is_array($_POST['comodos2'])) {
      foreach ($_POST['comodos2'] as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'comodo2_id' => Tools::protege($item)
        );
        $anunciosComodos2->Insert($dadosItem);
      }
    }

    // Resposta
    $arrResponse = array (
      'status' => 'ok',
      'url' => Tools::protege($_POST['retorno_success'])."/".$ultimoId."/insert",
      'job' => 'cadastrar'
    );

  } else {
    $arrResponse = array (
      'status' => 'erro'
    );
  }
  echo json_encode($arrResponse);
}

// Atualizar
if ($_POST['acao'] == "update") {

  $idEdit = Tools::somenteNumeros($_POST['id']);
  $idUsuario = (int) $user['id'];
  $slug = Tools::geraSlug(Tools::protege($_POST['titulo']));
    
  // DADOS
  $dados = array(
    'finalidade' => Tools::protege($_POST['finalidade']),
    'tipo_id' => Tools::protege($_POST['tipo_id']),
    'tipo' => Tools::protege($_POST['tipo']),
    'titulo' => Tools::protege($_POST['titulo']),
    'area' => $_POST['area'] != "" ? Tools::somenteNumeros($_POST['area']) : 0,
    'quartos' => $_POST['quartos'] != "" ? Tools::somenteNumeros($_POST['quartos']) : 0,
    'banheiros' => $_POST['banheiros'] != "" ? Tools::somenteNumeros($_POST['banheiros']) : 0,
    'vagas' => $_POST['vagas'] != "" ? Tools::somenteNumeros($_POST['vagas']) : 0,
    'andar' => $_POST['andar'] != "" ? Tools::somenteNumeros($_POST['andar']) : 0,
    'sol' => Tools::protege($_POST['sol']),
    'orientacao' => Tools::protege($_POST['orientacao']),
    'valor_venda' => $_POST['valor_venda'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_venda']))) : 0.00,
    'valor_aluguel' => $_POST['valor_aluguel'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_aluguel']))) : 0.00,
    'valor_condominio' => $_POST['valor_condominio'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_condominio']))) : 0.00,
    'valor_iptu' => $_POST['valor_iptu'] != "" ? Tools::formataMoedaBd(str_replace("R$ ","", Tools::protege($_POST['valor_iptu']))) : 0.00,
    'cep' => Tools::protege($_POST['cep']),
    'logradouro' => Tools::protege($_POST['logradouro']),
    'numero' => Tools::protege($_POST['numero']),
    'complemento' => Tools::protege($_POST['complemento']),
    'bairro' => Tools::protege($_POST['bairro']),
    'cidade' => Tools::protege($_POST['cidade']),
    'estado' => Tools::protege($_POST['estado']),
    'bairro_id' => Tools::protege($_POST['bairro_id']),
    'cidade_id' => Tools::protege($_POST['cidade_id']),
    'estado_id' => Tools::protege($_POST['estado_id']),
    'lat' => Tools::protege($_POST['lat']),
    'lng' => Tools::protege($_POST['lng']),
    'regiao_id' => $_POST['regiao_id'] != "" ? Tools::protege($_POST['regiao_id']) : 0,
    'mobiliado' => $_POST['mobiliado'] != "" ? Tools::somenteNumeros($_POST['mobiliado']) : 0,
    'possui_elevador' => $_POST['possui_elevador'] != "" ? Tools::somenteNumeros($_POST['possui_elevador']) : 0,
    'proximo_metro' => $_POST['proximo_metro'] != "" ? Tools::somenteNumeros($_POST['proximo_metro']) : 0,
    'proximo_brt' => $_POST['proximo_brt'] != "" ? Tools::somenteNumeros($_POST['proximo_brt']) : 0,
    'proximo_trem' => $_POST['proximo_trem'] != "" ? Tools::somenteNumeros($_POST['proximo_trem']) : 0,
    'aceita_pet' => $_POST['aceita_pet'] != "" ? Tools::somenteNumeros($_POST['aceita_pet']) : 0,
    'domingo_status' => array_search("domingo", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'segunda_status' => array_search("segunda", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'terca_status' => array_search("terca", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'quarta_status' => array_search("quarta", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'quinta_status' => array_search("quinta", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'sexta_status' => array_search("sexta", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'sabado_status' => array_search("sabado", $_POST['dias_visita']) !== FALSE ? 1 : 0,
    'domingo_inicio' => Tools::protege($_POST['domingo_inicio']),
    'domingo_fim' => Tools::protege($_POST['domingo_fim']),
    'segunda_inicio' => Tools::protege($_POST['segunda_inicio']),
    'segunda_fim' => Tools::protege($_POST['segunda_fim']),
    'terca_inicio' => Tools::protege($_POST['terca_inicio']),
    'terca_fim' => Tools::protege($_POST['terca_fim']),
    'quarta_inicio' => Tools::protege($_POST['quarta_inicio']),
    'quarta_fim' => Tools::protege($_POST['quarta_fim']),
    'quinta_inicio' => Tools::protege($_POST['quinta_inicio']),
    'quinta_fim' => Tools::protege($_POST['quinta_fim']),
    'sexta_inicio' => Tools::protege($_POST['sexta_inicio']),
    'sexta_fim' => Tools::protege($_POST['sexta_fim']),
    'sabado_inicio' => Tools::protege($_POST['sabado_inicio']),
    'sabado_fim' => Tools::protege($_POST['sabado_fim']),
    'exclusivo' => $_POST['exclusivo'] != "" ? Tools::somenteNumeros($_POST['exclusivo']) : 0,
    'taxa' => $_POST['exclusivo'] != "" ? TAXA_EXCLUSIVOS : TAXA,
    'residente' => $_POST['residente'] != "" ? Tools::somenteNumeros($_POST['residente']) : 0,
    'prop_nome' => Tools::protege($_POST['prop_nome']),
    'prop_tel' => Tools::protege($_POST['prop_tel']),
    'prop_email' => Tools::protege($_POST['prop_email']),
    //'status' => 2,
    'slug' => $slug
  );	

  $operacao = $anuncios->Update($dados, "WHERE id=$idEdit AND id_usuario=$idUsuario");
   
  if ($operacao) {

    $ultimoId = $idEdit;

    // Verifica se existe mais de um registro com a mesma slug
    $slugJaExiste = $anuncios->SelectTotalSQL("SELECT id FROM anuncios WHERE slug='$slug'");
    if ($slugJaExiste > 1) {
      $slug = $slug."-".$ultimoId;
      $updateSlug = $anuncios->Update(["slug" => $slug], "WHERE id=$ultimoId");
    }

    // Cômodos
    if (is_array($_POST['comodos'])) {
      $delAtuais = $anunciosComodos->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['comodos'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'comodo_id' => Tools::protege($item)
          );
          $anunciosComodos->Insert($dadosItem);
        }
      }
    }

    // Detalhes do imóvel
    if (is_array($_POST['caracteristicas'])) {
      $delAtuais = $anunciosCaracteristicas->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['caracteristicas'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'caracteristica_id' => Tools::protege($item)
          );
          $anunciosCaracteristicas->Insert($dadosItem);
        }
      }
    }

    // Detalhes do condomínio
    if (is_array($_POST['condominio'])) {
      $delAtuais = $anunciosCondominio->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['condominio'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'condominio_id' => Tools::protege($item)
          );
          $anunciosCondominio->Insert($dadosItem);
        }
      }
    }

    // Mobílias e eletros
    if (is_array($_POST['mobilias'])) {
      $delAtuais = $anunciosMobilias->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['mobilias'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'mobilia_id' => Tools::protege($item)
          );
          $anunciosMobilias->Insert($dadosItem);
        }
      }
    }

    // Comodidades
    if (is_array($_POST['comodidades'])) {
      $delAtuais = $anunciosComodidades->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['comodidades'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'comodidade_id' => Tools::protege($item)
          );
          $anunciosComodidades->Insert($dadosItem);
        }
      }
    }

    // Segurança
    if (is_array($_POST['seguranca'])) {
      $delAtuais = $anunciosSeguranca->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['seguranca'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'seguranca_id' => Tools::protege($item)
          );
          $anunciosSeguranca->Insert($dadosItem);
        }
      }
    }

    // Lazer e esporte
    if (is_array($_POST['lazer'])) {
      $delAtuais = $anunciosLazer->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['lazer'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'lazer_id' => Tools::protege($item)
          );
          $anunciosLazer->Insert($dadosItem);
        }
      }
    }

    // Cômodos (Comercial)
    if (is_array($_POST['comodos2'])) {
      $delAtuais = $anunciosComodos2->Delete("0", "WHERE anuncio_id=$ultimoId", array(), false, false, "");
      if ($delAtuais) {
        foreach ($_POST['comodos2'] as $item) {
          $dadosItem = array(
            'anuncio_id' => $ultimoId,
            'comodo2_id' => Tools::protege($item)
          );
          $anunciosComodos2->Insert($dadosItem);
        }
      }
    }

    $arrResponse = array (
      'status' => 'ok',
      'url' => Tools::protege($_POST['retorno_success']),
      'job' => 'atualizar'
    );

  } else {
    $arrResponse = array (
      'status' => 'erro'
    );
  }
  echo json_encode($arrResponse);
}

// Duplicar
if ($_POST['acao'] == "duplicar") {
  $idDuplica = Tools::protege($_POST['id_duplica']);
  $resultAnuncioDp = $conexao->prepare("SELECT * FROM anuncios WHERE id_usuario=:id_usuario AND id=:id LIMIT 1");
  $resultAnuncioDp->bindValue(':id_usuario', $user['id'], PDO::PARAM_INT);
  $resultAnuncioDp->bindValue(':id', $idDuplica, PDO::PARAM_INT);
  $resultAnuncioDp->execute();
  $numAnuncioDp = $resultAnuncioDp->rowCount();
  $anuncioDp = $resultAnuncioDp->fetch(PDO::FETCH_ASSOC);
  if ($numAnuncioDp > 0) {
    $dados = array(
      'id_usuario' => $anuncioDp['id_usuario'],
      'tipo_user' => $anuncioDp['tipo_user'],
      //'finalidade' => $anuncioDp['finalidade'],
      'governo' => $anuncioDp['governo'],
      'tipo_id' => $anuncioDp['tipo_id'],
      'tipo' => $anuncioDp['tipo'],
      'titulo' => $anuncioDp['titulo'],
      'area' => $anuncioDp['area'],
      'quartos' => $anuncioDp['quartos'],
      'banheiros' => $anuncioDp['banheiros'],
      'vagas' => $anuncioDp['vagas'],
      'andar' => $anuncioDp['andar'],
      'sol' => $anuncioDp['sol'],
      'orientacao' => $anuncioDp['orientacao'],
      'valor_venda' => $anuncioDp['valor_venda'],
      'valor_aluguel' => $anuncioDp['valor_aluguel'],
      'valor_condominio' => $anuncioDp['valor_condominio'],
      'valor_iptu' => $anuncioDp['valor_iptu'],
      'valor_seguro_incendio' => $anuncioDp['valor_seguro_incendio'],
      'valor_taxa_servico' => $anuncioDp['valor_taxa_servico'],
      'cep' => $anuncioDp['cep'],
      'logradouro' => $anuncioDp['logradouro'],
      'numero' => $anuncioDp['numero'],
      'complemento' => $anuncioDp['complemento'],
      'bairro' => $anuncioDp['bairro'],
      'cidade' => $anuncioDp['cidade'],
      'estado' => $anuncioDp['estado'],
      'bairro_id' => $anuncioDp['bairro_id'],
      'cidade_id' => $anuncioDp['cidade_id'],
      'estado_id' => $anuncioDp['estado_id'],
      'lat' => $anuncioDp['lat'],
      'lng' => $anuncioDp['lng'],
      'regiao_id' => $anuncioDp['regiao_id'],
      'video_url' => $anuncioDp['video_url'],
      'video_id' => $anuncioDp['video_id'],
      'video_plataforma' => $anuncioDp['video_plataforma'],
      'tour_url' => $anuncioDp['tour_url'],
      'mobiliado' => $anuncioDp['mobiliado'],
      'possui_elevador' => $anuncioDp['possui_elevador'],
      'proximo_metro' => $anuncioDp['proximo_metro'],
      'proximo_brt' => $anuncioDp['proximo_brt'],
      'proximo_trem' => $anuncioDp['proximo_trem'],
      'aceita_pet' => $anuncioDp['aceita_pet'],
      'domingo_status' => $anuncioDp['domingo_status'],
      'segunda_status' => $anuncioDp['segunda_status'],
      'terca_status' => $anuncioDp['terca_status'],
      'quarta_status' => $anuncioDp['quarta_status'],
      'quinta_status' => $anuncioDp['quinta_status'],
      'sexta_status' => $anuncioDp['sexta_status'],
      'sabado_status' => $anuncioDp['sabado_status'],
      'domingo_inicio' => $anuncioDp['domingo_inicio'],
      'domingo_fim' => $anuncioDp['domingo_fim'],
      'segunda_inicio' => $anuncioDp['qusegunda_inicioartos'],
      'segunda_fim' => $anuncioDp['segunda_fim'],
      'terca_inicio' => $anuncioDp['terca_inicio'],
      'terca_fim' => $anuncioDp['terca_fim'],
      'quarta_inicio' => $anuncioDp['quarta_inicio'],
      'quarta_fim' => $anuncioDp['quarta_fim'],
      'quinta_inicio' => $anuncioDp['quinta_inicio'],
      'quinta_fim' => $anuncioDp['quinta_fim'],
      'sexta_inicio' => $anuncioDp['sexta_inicio'],
      'sexta_fim' => $anuncioDp['sexta_fim'],
      'sabado_inicio' => $anuncioDp['sabado_inicio'],
      'sabado_fim' => $anuncioDp['sabado_fim'],
      'exclusivo' => $anuncioDp['exclusivo'],
      'taxa' => $anuncioDp['taxa'],
      'tag_destaque' => $anuncioDp['tag_destaque'],
      'residente' => $anuncioDp['residente'],
      'prop_nome' => $anuncioDp['prop_nome'],
      'prop_tel' => $anuncioDp['prop_tel'],
      'prop_email' => $anuncioDp['prop_email'],
      'destaque' => 0,
      'status' => 2,
      'slug' => $anuncioDp['slug'],
      'data_cad' => Tools::getDateTime()
    );	
    $operacao = $anuncios->Insert($dados);
    if ($operacao) {
      $ultimoId = $anuncios->getId();
      // Código e hash
      $zeros_cod_pedido = Tools::zerofill($ultimoId, 6);
      $pre = "IR";
      $ref = $pre.$zeros_cod_pedido;
      $hash = Tools::geraHash('sha1',Tools::getDateTime()).$ultimoId;
      $dadosHash = array(
        'hash' => $hash,
        'codigo' => $ref
      );
      $anuncios->Update($dadosHash,"WHERE id='$ultimoId'");
      // Verifica se existe mais de um registro com a mesma slug
      $slug = $anuncioDp['slug'];
      $slugJaExiste = $anuncios->SelectTotalSQL("SELECT id FROM anuncios WHERE slug='$slug'");
      if ($slugJaExiste > 1) {
        $slug = $slug."-".$ultimoId;
        $updateSlug = $anuncios->Update(["slug" => $slug], "WHERE id=$ultimoId");
      }

      // Cômodos
      $arrAtuais = $anunciosComodos->SelectSQL("SELECT * FROM anuncios_comodos_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'comodo_id' => $item['comodo_id']
        );
        $anunciosComodos->Insert($dadosItem);
      }

      // Detalhes do imóvel
      $arrAtuais = $anunciosCaracteristicas->SelectSQL("SELECT * FROM anuncios_caracteristicas_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'caracteristica_id' => $item['caracteristica_id']
        );
        $anunciosCaracteristicas->Insert($dadosItem);
      }

      // Detalhes do condomínio
      $arrAtuais = $anunciosCondominio->SelectSQL("SELECT * FROM anuncios_condominio_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'condominio_id' => $item['condominio_id']
        );
        $anunciosCondominio->Insert($dadosItem);
      }

      // Mobílias e eletros
      $arrAtuais = $anunciosMobilias->SelectSQL("SELECT * FROM anuncios_mobilias_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'mobilia_id' => $item['mobilia_id']
        );
        $anunciosMobilias->Insert($dadosItem);
      }

      // Comodidades
      $arrAtuais = $anunciosComodidades->SelectSQL("SELECT * FROM anuncios_comodidades_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'comodidade_id' => $item['comodidade_id']
        );
        $anunciosComodidades->Insert($dadosItem);
      }

      // Segurança
      $arrAtuais = $anunciosSeguranca->SelectSQL("SELECT * FROM anuncios_seguranca_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'seguranca_id' => $item['seguranca_id']
        );
        $anunciosSeguranca->Insert($dadosItem);
      }

      // Lazer e esporte
      $arrAtuais = $anunciosLazer->SelectSQL("SELECT * FROM anuncios_lazer_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'lazer_id' => $item['lazer_id']
        );
        $anunciosLazer->Insert($dadosItem);
      }

      // Cômodos (Comercial)
      $arrAtuais = $anunciosComodos2->SelectSQL("SELECT * FROM anuncios_comodos2_n_n WHERE anuncio_id=$idDuplica");
      foreach ($arrAtuais as $item) {
        $dadosItem = array(
          'anuncio_id' => $ultimoId,
          'comodo2_id' => $item['comodo2_id']
        );
        $anunciosComodos2->Insert($dadosItem);
      }

      // Fotos
      $fotosAtuais = $anunciosFotos->SelectSQL("SELECT * FROM anuncios_fotos WHERE item_id=$idDuplica");
      $numFotos = 0;
      foreach ($fotosAtuais as $item) {
        $numFotos++;
        $dadosFoto = array(
          'item_id' => $ultimoId,
          'foto' => $item['foto'],
          'destaque' => $item['destaque']
        );
        if ($item['ordem'] != "") {
          $dadosFoto['ordem'] = $item['ordem'];
        }
        if ($item['descricao'] != "") {
          $dadosFoto['descricao'] = $item['descricao'];
        }
        $anunciosFotos->Insert($dadosFoto);
      }
      if ($numFotos > 0) {
        $pathAntigo = IMG_PATH."/anuncios/".$idDuplica;
        $pathNovo = IMG_PATH."/anuncios/".$ultimoId;
        Tools::copiaDir($pathAntigo, $pathNovo);
      }

      $arrResponse = array (
        'status' => 'ok'
      );
    }
  } else {
    $arrResponse = array (
      'status' => 'erro'
    );
  }
  echo json_encode($arrResponse);
}

//Remover
if ($_POST['acao'] == "remover") {

  $anuncio = new Crud('anuncios');
  $idDel = (int) $_POST['id_remove'];
  $path = Tools::protege(IMG_PATH."/anuncios/".$idDel);

  $adicionais = array(
    'anuncios_avaliacoes' => "anuncio_id",
    'anuncios_caracteristicas_n_n' => "anuncio_id",
    'anuncios_comodidades_n_n' => "anuncio_id",
    'anuncios_comodos_n_n' => "anuncio_id",
    'anuncios_comodos2_n_n' => "anuncio_id",
    'anuncios_condominio_n_n' => "anuncio_id",
    'anuncios_lazer_n_n' => "anuncio_id",
    'anuncios_mobilias_n_n' => "anuncio_id",
    'anuncios_seguranca_n_n' => "anuncio_id",
    'anuncios_fotos' => "item_id",
  );

  $operacao = $anuncio->Delete($idDel, "WHERE id=$idDel AND id_usuario=".$user['id'], $adicionais, false, true, $path);

  if ($operacao) {
    $arrResponse = array (
      'status' => 'ok',
      'url' => $_POST['retorno_success'],
      'job' => 'remover'
    );
  } else {
    $arrResponse = array (
      'status' => 'erro'
    );
  }
  echo json_encode($arrResponse);
}
