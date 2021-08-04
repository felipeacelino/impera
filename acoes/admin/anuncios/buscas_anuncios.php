<?
// CONFIGURAÇÕES
$tabela = "buscas_anuncios";
$tabelaBusca = "buscas";
$filtro = "";
$paginacao = false;
$num_regs = 15;
$ordemExibicao = false;
$uploadArquivo = false;
$removeDiretorio = false;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// Busca
$busca =  $acoes->SelectSingle("SELECT * FROM $tabelaBusca WHERE id = $id_enviado2");
if ($busca == "") {
  Tools::redireciona("" . URL . "admin/" . $pasta_modulo . "/" . $tabelaBusca . "/" . TOKEN . "/view");
}

// Datas de chegada e saída
$chegada = $busca['chegada'];
$saida = $busca['saida'];
$periodo = Tools::intervaloDatas($chegada, $saida);

// INDISPONIBILIZA ANUNCIOS QUE NAO ESTAO DISPONIVEIS NESSAS DATAS
$anuncios_crud = new Crud("anuncios");
foreach ($periodo as $key => $dta) {
  $verificaAnuncios = $anuncios_crud->SelectSQL("SELECT
  anuncio_id  
  FROM anuncios_datas_indisponiveis 
  WHERE dta = '" . $dta . "'");
  foreach ($verificaAnuncios as $verificaId) {
    if ($verificaId['anuncio_id'] != '') {
      $anuncios_ids .= $verificaId['anuncio_id'] . ',';
    }
  }
}
$anuncios_ids_datas_indisponiveis = substr($anuncios_ids, 0, -1);
if ($anuncios_ids_datas_indisponiveis != '') {
  $filtro .= " AND a.id NOT IN (" . $anuncios_ids_datas_indisponiveis . ") ";
}

// PROPRIETÁRIO
$proprietarios = $acoes->SelectSQL("SELECT * FROM proprietarios WHERE status=1 ORDER BY nome ASC");

// CIDADES
$cidades = $acoes->SelectSQL("SELECT * FROM anuncios_destinos GROUP BY cidade ORDER BY id DESC");

// CONDOMÍNIOS
$condominios = $acoes->SelectSQL("SELECT * FROM anuncios_condominios ORDER BY id DESC");

// CARACTERISTICAS
$caracteristicas_anuncios = new Crud("anuncios_caracteristicas_n_n");

switch ($acao_enviado) {
  case 'insert':
    $tit_pag_geral = $busca['titulo'] . " &rsaquo; Busca (" . Tools::formataData($chegada) . " - " . Tools::formataData($saida) . ")";
    break;
  case 'edit':
    $tit_pag_geral = $busca['titulo'] . " &rsaquo; Busca (" . Tools::formataData($chegada) . " - " . Tools::formataData($saida) . ")";
    break;
  default:
    $tit_pag_geral = $busca['titulo'] . " &rsaquo; Busca (" . Tools::formataData($chegada) . " - " . Tools::formataData($saida) . ")";
    break;
}

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
  $path = IMG_PATH . "/" . $tabela;
  $extensoes_permitidas = array("png", "gif", "svg", "jpg", "jpeg");
  $redimensiona = false;
  $largura = 0;
  $altura = 0;
  $forma_redimensiona = ''; // '', 'crop', 'auto'
  $grava = true;
  $remove = true;
  $thumbs = array();
}

// URL RETORNO GERAL
$retorno_geral = $_GET['p2'] != '' ?
  "" . URL . "admin/" . $pasta_modulo . "/" . $tabelaBusca . "/" . TOKEN . "/view?p=" . $_GET['p2'] : "" . URL . "admin/" . $pasta_modulo . "/" . $tabelaBusca . "/" . TOKEN . "/view";

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $busca['id'];
if (isset($_GET['p']) && $_GET['p'] != '') {
  $current_url_view = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $busca['id'] . "?p=" . $_GET['p'];
  $current_url_insert = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/insert/0/" . $busca['id'] . "?p=" . $_GET['p'];
  $current_url_delete = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/delete/0/" . $busca['id'] . "?p=" . $_GET['p'];
} else {
  $current_url_view = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $busca['id'];
  $current_url_insert = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/insert/0/" . $busca['id'];
  $current_url_delete = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/delete/0/" . $busca['id'];
}

// CONFIGURAÇÕES DE RETORNO
if ($acao == "delete") {
  $retorno_pag = $current_url_view;
} else {
  $retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

// URL FILTROS
$acao_filtros = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $busca['id'];

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {

  // FILTRO 'PROPRIETÁRIO'
  if (isset($_POST['filtro_proprietario'])) {
    if ($_POST['filtro_proprietario'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_proprietario'] = addslashes($_POST['filtro_proprietario']);
      $filtro_proprietario = " AND a.id_proprietario = '" . $_SESSION[$pag_include]['filtros']['filtro_proprietario'] . "'";
      $filtro .= $filtro_proprietario;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_proprietario']);
      $filtro_proprietario = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_proprietario'])) {
    $filtro_proprietario = " AND a.id_proprietario = '" . $_SESSION[$pag_include]['filtros']['filtro_proprietario'] . "'";
    $filtro .= $filtro_proprietario;
  }

  // FILTRO 'TÍTULO'
  if (isset($_POST['filtro_titulo'])) {
    if ($_POST['filtro_titulo'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_titulo'] = addslashes($_POST['filtro_titulo']);
      $filtro_titulo = " AND a.titulo LIKE '%" . $_SESSION[$pag_include]['filtros']['filtro_titulo'] . "%'";
      $filtro .= $filtro_titulo;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_titulo']);
      $filtro_titulo = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_titulo'])) {
    $filtro_titulo = " AND a.titulo LIKE '%" . $_SESSION[$pag_include]['filtros']['filtro_titulo'] . "%'";
    $filtro .= $filtro_titulo;
  }

  // FILTRO 'ANÚNCIO'
  if (isset($_POST['filtro_codigo'])) {
    if ($_POST['filtro_codigo'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_codigo'] = addslashes($_POST['filtro_codigo']);
      $filtro_codigo = " AND a.codigo = '" . $_SESSION[$pag_include]['filtros']['filtro_codigo'] . "'";
      $filtro .= $filtro_codigo;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_codigo']);
      $filtro_codigo = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_codigo'])) {
    $filtro_codigo = " AND a.codigo = '" . $_SESSION[$pag_include]['filtros']['filtro_codigo'] . "'";
    $filtro .= $filtro_codigo;
  }

  // FILTRO 'CIDADE'
  if (isset($_POST['filtro_cidade'])) {
    if ($_POST['filtro_cidade'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_cidade'] = addslashes($_POST['filtro_cidade']);
      $filtro_cidade = " AND a.cidade = '" . $_SESSION[$pag_include]['filtros']['filtro_cidade'] . "'";
      $filtro .= $filtro_cidade;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_cidade']);
      $filtro_cidade = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_cidade'])) {
    $filtro_cidade = " AND a.cidade = '" . $_SESSION[$pag_include]['filtros']['filtro_cidade'] . "'";
    $filtro .= $filtro_cidade;
  }

  // FILTRO 'STATUS'
  if (isset($_POST['filtro_status'])) {
    if ($_POST['filtro_status'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
      $filtro_status = " AND a.status = '" . $_SESSION[$pag_include]['filtros']['filtro_status'] . "'";
      $filtro .= $filtro_status;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_status']);
      $filtro_status = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
    $filtro_status = " AND a.status = '" . $_SESSION[$pag_include]['filtros']['filtro_status'] . "'";
    $filtro .= $filtro_status;
  }


  // FILTRO 'TIPO' Venda / Temporada
  if (isset($_POST['filtro_tipoanuncio'])) {
    if ($_POST['filtro_tipoanuncio'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'] = addslashes($_POST['filtro_tipoanuncio']);
      $filtro_tipoanuncio = " AND a.tipo_anuncio = '" . $_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'] . "'";
      $filtro .= $filtro_tipoanuncio;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_tipoanuncio']);
      $filtro_tipoanuncio = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'])) {
    $filtro_tipoanuncio = " AND a.tipo_anuncio = '" . $_SESSION[$pag_include]['filtros']['filtro_tipoanuncio'] . "'";
    $filtro .= $filtro_tipoanuncio;
  }

  // FILTRO 'TIPO' Apartamento / Casa
  if (isset($_POST['filtro_tipo'])) {
    if ($_POST['filtro_tipo'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_tipo'] = addslashes($_POST['filtro_tipo']);
      $filtro_tipo = " AND a.tipo = '" . $_SESSION[$pag_include]['filtros']['filtro_tipo'] . "'";
      $filtro .= $filtro_tipo;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_tipo']);
      $filtro_tipo = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_tipo'])) {
    $filtro_tipo = " AND a.tipo = '" . $_SESSION[$pag_include]['filtros']['filtro_tipo'] . "'";
    $filtro .= $filtro_tipo;
  }

  // FILTRO 'QUARTO'
  if (isset($_POST['filtro_quarto'])) {
    if ($_POST['filtro_quarto'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_quarto'] = addslashes($_POST['filtro_quarto']);
      $filtro_quarto = " AND a.quartos >= " . $_SESSION[$pag_include]['filtros']['filtro_quarto'] . "";
      $filtro .= $filtro_quarto;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_quarto']);
      $filtro_quarto = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_quarto'])) {
    $filtro_quarto = " AND a.quartos >= " . $_SESSION[$pag_include]['filtros']['filtro_quarto'] . "";
    $filtro .= $filtro_quarto;
  }

  // FILTRO 'SUITES'
  if (isset($_POST['filtro_suite'])) {
    if ($_POST['filtro_suite'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_suite'] = addslashes($_POST['filtro_suite']);
      $filtro_suite = " AND a.suites >= " . $_SESSION[$pag_include]['filtros']['filtro_suite'] . "";
      $filtro .= $filtro_suite;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_suite']);
      $filtro_suite = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_suite'])) {
    $filtro_suite = " AND a.suites >= " . $_SESSION[$pag_include]['filtros']['filtro_suite'] . "";
    $filtro .= $filtro_suite;
  }

  // FILTRO 'BANHEIROS'
  if (isset($_POST['filtro_banheiro'])) {
    if ($_POST['filtro_banheiro'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_banheiro'] = addslashes($_POST['filtro_banheiro']);
      $filtro_banheiro = " AND a.banheiros >= " . $_SESSION[$pag_include]['filtros']['filtro_banheiro'] . "";
      $filtro .= $filtro_banheiro;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_banheiro']);
      $filtro_banheiro = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_banheiro'])) {
    $filtro_banheiro = " AND a.banheiros >= " . $_SESSION[$pag_include]['filtros']['filtro_banheiro'] . "";
    $filtro .= $filtro_banheiro;
  }

  // FILTRO 'VAGAS'
  if (isset($_POST['filtro_vaga'])) {
    if ($_POST['filtro_vaga'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_vaga'] = addslashes($_POST['filtro_vaga']);
      $filtro_vaga = " AND a.vagas >= " . $_SESSION[$pag_include]['filtros']['filtro_vaga'] . "";
      $filtro .= $filtro_vaga;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_vaga']);
      $filtro_vaga = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_vaga'])) {
    $filtro_vaga = " AND a.vagas >= " . $_SESSION[$pag_include]['filtros']['filtro_vaga'] . "";
    $filtro .= $filtro_vaga;
  }

  // FILTRO 'HOSPEDES'
  if (isset($_POST['filtro_hospede'])) {
    if ($_POST['filtro_hospede'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_hospede'] = addslashes($_POST['filtro_hospede']);
      $filtro_hospede = " AND a.hospedes >= " . $_SESSION[$pag_include]['filtros']['filtro_hospede'] . "";
      $filtro .= $filtro_hospede;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_hospede']);
      $filtro_hospede = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_hospede'])) {
    $filtro_hospede = " AND a.hospedes >= " . $_SESSION[$pag_include]['filtros']['filtro_hospede'] . "";
    $filtro .= $filtro_hospede;
  }

  // FILTRO 'CONDOMINIO'
  if (isset($_POST['filtro_condominio'])) {
    if ($_POST['filtro_condominio'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_condominio'] = addslashes($_POST['filtro_condominio']);
      $filtro_condominio = " AND a.condominio = " . $_SESSION[$pag_include]['filtros']['filtro_condominio'] . "";
      $filtro .= $filtro_condominio;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_condominio']);
      $filtro_condominio = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_condominio'])) {
    $filtro_condominio = " AND a.condominio >= " . $_SESSION[$pag_include]['filtros']['filtro_condominio'] . "";
    $filtro .= $filtro_condominio;
  }

  // FILTRO 'DESTINO'
  if (isset($_POST['filtro_destino'])) {
    if ($_POST['filtro_destino'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_destino'] = addslashes($_POST['filtro_destino']);
      $filtro_destino = " AND (a.cidade LIKE '%" . $_SESSION[$pag_include]['filtros']['filtro_destino'] . "%' OR a.destino = '" . $_SESSION[$pag_include]['filtros']['filtro_destino'] .  "') ";
      $filtro .= $filtro_destino;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_destino']);
      $filtro_destino = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_destino'])) {
    $filtro_destino = " AND (a.cidade LIKE '%" . $_SESSION[$pag_include]['filtros']['filtro_destino'] . "%' OR a.destino = '" . $_SESSION[$pag_include]['filtros']['filtro_destino'] .  "') ";
    $filtro .= $filtro_destino;
  }


  // FILTRO 'PREÇO'
  if (isset($_POST['filtro_faixa'])) {
    if ($_POST['filtro_faixa'] != "") {
      $filtro_preco = Tools::protege($_POST['filtro_faixa']);
      $_SESSION[$pag_include]['filtros']['filtro_faixa'] = addslashes($_POST['filtro_faixa']);
      $filtro_preco = explode("-", $filtro_preco);
      if ($filtro_preco[0] != "0") {
        $filtro_preco_de = " AND a.valor >= " . $filtro_preco[0];
      }
      if ($filtro_preco[1] != "0") {
        $filtro_preco_ate = " AND a.valor <= " . $filtro_preco[1];
      }
      $filtro_faixa .= $filtro_preco_de;
      $filtro_faixa .= $filtro_preco_ate;
      $filtro .= $filtro_faixa;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_faixa']);
      $filtro_faixa = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_faixa'])) {
    $filtro_preco = Tools::protege($_POST['filtro_faixa']);
    $_SESSION[$pag_include]['filtros']['filtro_faixa'] = addslashes($_POST['filtro_faixa']);
    $filtro_preco = explode("-", $filtro_preco);
    if ($filtro_preco[0] != "0") {
      $filtro_preco_de = " AND a.valor >= " . $filtro_preco[0];
    }
    if ($filtro_preco[1] != "0") {
      $filtro_preco_ate = " AND a.valor <= " . $filtro_preco[1];
    }
    $filtro_faixa .= $filtro_preco_de;
    $filtro_faixa .= $filtro_preco_ate;
    $filtro .= $filtro_faixa;
  }

  // FILTRO CARACTERISTICAS
  if (isset($_POST['caracteristicas'])) {
    $filtros_caracteristicas .= "INNER JOIN anuncios_caracteristicas_n_n AS ac ON ac.anuncio_id=a.id ";
    foreach ($_POST['caracteristicas'] as $caracteristica) {
      $caracteristicas .= $caracteristica . ',';
    }
    $caracteristicas = substr($caracteristicas, 0, -1);
    $filtros_caracteristicas .= "AND ac.caracteristica_id IN ($caracteristicas) ";
    $_SESSION[$pag_include]['filtros']['filtro_caracteristicas'] = $_POST['caracteristicas'];
  }

  // FILTRO 'DATA'
  if (isset($_POST['filtro_data'])) {
    if ($_POST['filtro_data'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
      $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
      $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
      $filtro_data = " AND (a.data_cad BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "')";
      $filtro .= $filtro_data;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_data']);
      $filtro_data = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
    $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
    $filtro_data = " AND (a.data_cad BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "')";
    $filtro .= $filtro_data;
  }

  $quantidadeFiltros = count(array_filter($_SESSION[$pag_include]));

  // Anúncios selecionados
  $anuncios_selecionados = $acoes->SelectMultiple("SELECT * FROM buscas_anuncios AS ba 
  INNER JOIN anuncios AS a ON ba.anuncio_id = a.id
  WHERE ba.busca_id = $id_enviado2 ORDER BY a.id DESC", false, 0);
  $total_anuncios_selecionados = $acoes->totalRegistros();

  // Seleciona o proprietário/tarifa diferenciada (se houver)
  foreach ($anuncios_selecionados as $key => $value) {

    $anuncioId = $value['id'];

    //Tarifas
    foreach ($periodo as $key_tarifa => $dta) {
      $verifica = $anuncios_crud->SelectSingle("SELECT 
      id,
      valor,
      data_inicial,
      data_final
      FROM anuncios_precos 
      WHERE anuncio_id = $anuncioId
      AND '" . $dta . "' BETWEEN data_inicial AND data_final");
      if ($verifica['valor'] != "" && $verifica['valor'] > 0) {
        $anuncios_selecionados[$key]['valor_diferenciado'] = $verifica['valor'];
        if ($key_tarifa != $ultimaDataKey) {
          $valorTotal += $verifica['valor'];
        }
        $possuiValorDiferenciado = true;
        $datasValorDiferenciado = Tools::formataData($verifica['data_inicial']) . ' a ' . Tools::formataData($verifica['data_final']);
        if ($chegada == $verifica['data_inicial'] && $saida == $verifica['data_final']) {
          $datasDiferenciadoAprovado = true;
        } else {
          $datasDiferenciadoAprovado = false;
        }
      } else {
        if ($key_tarifa != $ultimaDataKey) {
          $valorTotal += $diariaBasica;
        }
      }
    }

    // Proprietário
    $resultProprietario = $conexao->prepare("SELECT nome, cpf FROM proprietarios WHERE id = :id_proprietario");
    $resultProprietario->bindValue(":id_proprietario", $value['id_proprietario'], PDO::PARAM_INT);
    $resultProprietario->execute();
    $proprietario = $resultProprietario->fetch(PDO::FETCH_ASSOC);

    $anuncios_selecionados[$key]['proprietario'] = $proprietario['nome'] . ' - ' . $proprietario['cpf'];
  }

  // Anúncios
  $anuncios = $acoes->SelectMultiple("SELECT * FROM anuncios AS a 
  $filtros_caracteristicas
  WHERE a.id <> 0
  $filtro ORDER BY a.id DESC", false, 0);
  $total_anuncios = $acoes->totalRegistros();

  // Seleciona o proprietário/tarifa diferenciada (se houver)
  foreach ($anuncios as $key => $value) {

    $anuncioId = $value['id'];

    //Tarifas
    foreach ($periodo as $key_tarifa => $dta) {
      $verifica = $anuncios_crud->SelectSingle("SELECT 
      id,
      valor,
      data_inicial,
      data_final
      FROM anuncios_precos 
      WHERE anuncio_id = $anuncioId
      AND '" . $dta . "' BETWEEN data_inicial AND data_final");
      if ($verifica['valor'] != "" && $verifica['valor'] > 0) {
        $anuncios[$key]['valor_diferenciado'] = $verifica['valor'];
        if ($key_tarifa != $ultimaDataKey) {
          $valorTotal += $verifica['valor'];
        }
        $possuiValorDiferenciado = true;
        $datasValorDiferenciado = Tools::formataData($verifica['data_inicial']) . ' a ' . Tools::formataData($verifica['data_final']);
        if ($chegada == $verifica['data_inicial'] && $saida == $verifica['data_final']) {
          $datasDiferenciadoAprovado = true;
        } else {
          $datasDiferenciadoAprovado = false;
        }
      } else {
        if ($key_tarifa != $ultimaDataKey) {
          $valorTotal += $diariaBasica;
        }
      }
    }

    // Proprietário
    $resultProprietario = $conexao->prepare("SELECT nome, cpf FROM proprietarios WHERE id = :id_proprietario");
    $resultProprietario->bindValue(":id_proprietario", $value['id_proprietario'], PDO::PARAM_INT);
    $resultProprietario->execute();
    $proprietario = $resultProprietario->fetch(PDO::FETCH_ASSOC);

    $anuncios[$key]['proprietario'] = $proprietario['nome'] . ' - ' . $proprietario['cpf'];
  }
}
