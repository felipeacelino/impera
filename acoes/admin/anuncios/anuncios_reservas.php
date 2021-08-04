<?
include("" . CLASS_PATH . "/email/email.class.php");
// CONFIGURAÇÕES
$tabela = "anuncios_reservas";
$filtro = "WHERE r.id > 0";
$order = "ORDER BY r.id DESC";
$paginacao = true;
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
switch ($acao_enviado) {
  case 'insert':
    $tit_pag_geral = "Cadastrar reserva";
    break;
  case 'edit':
    $tit_pag_geral = "Editar reserva";
    break;
  default:
    $tit_pag_geral = "Reservas";
    break;
}

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
  $path = IMG_PATH . "/" . $tabela;
  $extensoes_permitidas = array("png", "gif", "svg", "jpg", "jpeg");
  $redimensiona = true;
  $largura = 0;
  $altura = 0;
  $forma_redimensiona = 'auto'; // '', 'crop', 'auto'
  $grava = true;
  $remove = true;
  $thumbs = array();
}

// PROPRIETÁRIO
$proprietarios = $acoes->SelectSQL("SELECT * FROM proprietarios WHERE status=1 ORDER BY nome ASC");

// LOCATÁRIO
$locatarios = $acoes->SelectSQL("SELECT * FROM locatarios WHERE status=1 ORDER BY nome ASC");

// ANÚNCIOS
$anuncios = $acoes->SelectSQL("SELECT * FROM anuncios ORDER BY titulo ASC");

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view";
if (isset($_GET['p']) && $_GET['p'] != '') {
  $current_url_view = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view?p=" . $_GET['p'];
  $current_url_insert = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/insert?p=" . $_GET['p'];
  $current_url_delete = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/delete?p=" . $_GET['p'];
} else {
  $current_url_view = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view";
  $current_url_insert = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/insert";
  $current_url_delete = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/delete";
}

// CONFIGURAÇÕES DE RETORNO
if ($acao == "delete") {
  $retorno_pag = $current_url_view;
} else {
  $retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

// URL FILTROS
$acao_filtros = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view";

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {

  // FILTRO 'ANÚNCIO'
  if (isset($_POST['filtro_codigo'])) {
    if ($_POST['filtro_codigo'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_codigo'] = addslashes($_POST['filtro_codigo']);
      $filtro_codigo = " AND r.codigo = '" . $_SESSION[$pag_include]['filtros']['filtro_codigo'] . "'";
      $filtro .= $filtro_codigo;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_codigo']);
      $filtro_codigo = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_codigo'])) {
    $filtro_codigo = " AND r.codigo = '" . $_SESSION[$pag_include]['filtros']['filtro_codigo'] . "'";
    $filtro .= $filtro_codigo;
  }

  // FILTRO 'LOCATARIO'
  if (isset($_POST['filtro_locatario'])) {
    if ($_POST['filtro_locatario'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_locatario'] = addslashes($_POST['filtro_locatario']);
      $filtro_locatario = " AND r.locatario_id = " . $_SESSION[$pag_include]['filtros']['filtro_locatario'] . "";
      $filtro .= $filtro_locatario;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_locatario']);
      $filtro_locatario = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_locatario'])) {
    $filtro_locatario = " AND r.locatario_id = " . $_SESSION[$pag_include]['filtros']['filtro_locatario'] . "";
    $filtro .= $filtro_locatario;
  }


  // FILTRO 'ANUNCIO'
  if (isset($_POST['filtro_anuncio'])) {
    if ($_POST['filtro_anuncio'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_anuncio'] = addslashes($_POST['filtro_anuncio']);
      $filtro_anuncio = " AND r.anuncio_id = " . $_SESSION[$pag_include]['filtros']['filtro_anuncio'] . "";
      $filtro .= $filtro_anuncio;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_anuncio']);
      $filtro_anuncio = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_anuncio'])) {
    $filtro_anuncio = " AND r.anuncio_id = " . $_SESSION[$pag_include]['filtros']['filtro_anuncio'] . "";
    $filtro .= $filtro_anuncio;
  }

  // FILTRO 'PROPRIETARIO'
  if (isset($_POST['filtro_proprietario'])) {
    if ($_POST['filtro_proprietario'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_proprietario'] = addslashes($_POST['filtro_proprietario']);
      $filtro_proprietario = " AND a.id_proprietario = '" . $_SESSION[$pag_include]['filtros']['filtro_proprietario'] . "'";
      $join_categoria = "INNER JOIN anuncios AS a ON a.id = r.anuncio_id";
      $filtro .= $filtro_proprietario;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_proprietario']);
      $filtro_proprietario = "";
      $join_categoria = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_proprietario'])) {
    $filtro_proprietario = " AND a.id_proprietario = '" . $_SESSION[$pag_include]['filtros']['filtro_proprietario'] . "'";
    $join_categoria = "INNER JOIN anuncios AS a ON a.id = r.anuncio_id";
    $filtro .= $filtro_proprietario;
  }

  // FILTRO 'STATUS'
  if (isset($_POST['filtro_status'])) {
    if ($_POST['filtro_status'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
      $filtro_status = " AND r.status = '" . $_SESSION[$pag_include]['filtros']['filtro_status'] . "'";
      $filtro .= $filtro_status;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_status']);
      $filtro_status = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
    $filtro_status = " AND r.status = '" . $_SESSION[$pag_include]['filtros']['filtro_status'] . "'";
    $filtro .= $filtro_status;
  }

  // FILTRO 'DATA'
  if (isset($_POST['filtro_data'])) {
    if ($_POST['filtro_data'] != "") {
      $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
      $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
      $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
      $filtro_data = " AND (r.chegada BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "' OR r.saida BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "')";
      $filtro .= $filtro_data;
    } else {
      unset($_SESSION[$pag_include]['filtros']['filtro_data']);
      $filtro_data = "";
    }
  } else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
    $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
    $filtro_data = " AND (r.chegada BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "' OR r.saida BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "'))";
    $filtro .= $filtro_data;
  }

  // ORDERNAR
  if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
    $_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
    $order = $_SESSION[$pag_include]['ordem'];
  } else if ($_SESSION[$pag_include]['ordem'] != "") {
    $order = $_SESSION[$pag_include]['ordem'];
  }

  $resultado = $acoes->SelectMultiple("SELECT r.* FROM $tabela AS r $join_categoria  $filtro $order", $paginacao, $num_regs);
  $total_registros = $acoes->totalRegistros();

  // Seleciona o proprietário/locatario/anuncio
  foreach ($resultado as $key => $value) {

    // Locatário
    $resultLocatario = $conexao->prepare("SELECT nome, cpf, email, telefone FROM locatarios WHERE id = :locatario_id");
    $resultLocatario->bindValue(":locatario_id", $value['locatario_id'], PDO::PARAM_INT);
    $resultLocatario->execute();
    $locatario = $resultLocatario->fetch(PDO::FETCH_ASSOC);

    $resultado[$key]['locatario'] = $locatario['nome'];
    $resultado[$key]['locatario_telefone'] = $locatario['telefone'];
    $resultado[$key]['locatario_email'] = $locatario['email'];

    // Anúncio
    $resultAnuncio = $conexao->prepare("SELECT * FROM anuncios WHERE id = :anuncio_id");
    $resultAnuncio->bindValue(":anuncio_id", $value['anuncio_id'], PDO::PARAM_INT);
    $resultAnuncio->execute();
    $anuncio = $resultAnuncio->fetch(PDO::FETCH_ASSOC);

    $resultado[$key]['anuncio'] = $anuncio;

    // Proprietário
    $resultProprietario = $conexao->prepare("SELECT nome, cpf FROM proprietarios WHERE id = :id_proprietario");
    $resultProprietario->bindValue(":id_proprietario", $anuncio['id_proprietario'], PDO::PARAM_INT);
    $resultProprietario->execute();
    $proprietario = $resultProprietario->fetch(PDO::FETCH_ASSOC);

    $resultado[$key]['proprietario'] = $proprietario['nome'];
  }
}

//==================================================//
//                      UPDATE                      //
//==================================================//
if ($acao == "edit") {

  // RESGATA REGISTRO
  $linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado LIMIT 1");

  // RESGATA ANÚNCIO
  $resultAnuncio = $conexao->prepare("SELECT * FROM anuncios WHERE id = :anuncio_id");
  $resultAnuncio->bindValue(":anuncio_id", $linha_edit['anuncio_id'], PDO::PARAM_INT);
  $resultAnuncio->execute();
  $anuncio = $resultAnuncio->fetch(PDO::FETCH_ASSOC);

  if ($linha_edit == "") {
    Tools::redireciona($current_url_view);
  }

  if (isset($_POST['acao']) && $_POST['acao'] == "edit" && TOKEN == $token_confirma) {

    $idEdit = Tools::protege($_POST['id']);

    // VERIFICA CAMPOS ÚNICOS
    $verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST, $idEdit);
    if ($verificaUnicos === true) {

      // VERIFICA IMAGENS
      $verificaImagens = $upload->validateImages($_FILES['img'], $extensoes_permitidas);
      if ($verificaImagens === true) {

        $total = Tools::formataMoedaBd($_POST['total_sem_taxas']) + Tools::formataMoedaBd($_POST['taxas']);

        if ($_POST['datas_indisponiveis'] != '') {
          $dtas = explode(",", $_POST['datas_indisponiveis']);

          // ORDENA DATAS
          foreach ($dtas as $key => $data) {
            $dtas[$key] = Tools::formataDataBd($data);
          }

          function date_sort($a, $b)
          {
            return strtotime($a) - strtotime($b);
          }
          usort($dtas, "date_sort");
          print_r($dtas);

          $dtas = $dtas;

          $chegada = $dtas[0];
          $saida = end($dtas);

          $dtasCount = Tools::intervaloDatas($chegada, $saida);

          $diarias = count($dtasCount);
          $diarias--;

          // DADOS
          $dados = array(
            'chegada' => $chegada,
            'saida' => $saida,
            'horario' => $_POST['horario'],
            'hospedes' => $_POST['hospedes'],
            'diarias' => $diarias,
            'taxas' => $_POST['taxas'] != "" ? Tools::formataMoedaBd($_POST['taxas']) : 0.00,
            'total_sem_taxas' => $_POST['total_sem_taxas'] != "" ? Tools::formataMoedaBd($_POST['total_sem_taxas']) : 0.00,
            'total' => $total != "" ? $total : 0.00
          );
        } else {

          // DADOS
          $dados = array(
            'horario' => $_POST['horario'],
            'hospedes' => $_POST['hospedes'],
            'taxas' => $_POST['taxas'] != "" ? Tools::formataMoedaBd($_POST['taxas']) : 0.00,
            'total_sem_taxas' => $_POST['total_sem_taxas'] != "" ? Tools::formataMoedaBd($_POST['total_sem_taxas']) : 0.00,
            'total' => $total != "" ? $total : 0.00
          );
        }

        $operacao = $acoes->Update($dados, "WHERE id = $idEdit");

        if ($operacao) {

          // DATAS
          $delDtas = $acoes->SelectSQL("DELETE FROM anuncios_datas_indisponiveis WHERE origem='2' AND anuncio_id = " . $anuncio['id'] . " AND origem_id = " . $idEdit);

          $dtas = explode(",", $_POST['datas_indisponiveis']);
          $erro = 0;

          /*if ($_POST['datas_indisponiveis'] != '') {
            $acoes_reservas = new Crud('anuncios_datas_indisponiveis');
            foreach ($dtas as $dta) {
              // DADOS
              $dados = array(
                'dta' => Tools::formataDataBd($dta),
                'origem' => 2,
                'anuncio_id' => $anuncio['id'],
                'origem_id' => $idEdit,
                'dta_cad' => Tools::getDate()
              );
  
              $operacao = $acoes_reservas->Insert($dados);
  
              if (!$operacao) {
                $erro++;
              }
            }
          }*/

          $_SESSION['msg_retorna'] = Tools::alertReturn(2);
          Tools::redireciona($retorno_pag);

          // ERRO OPERAÇÃO
        } else {
          $_SESSION['msg_retorna'] = Tools::alertReturn(4);
          Tools::redireciona($retorno_pag);
        }

        // ERRO ARQUIVOS
      } else {
        $_SESSION['msg_retorna'] = Tools::alertReturn(0, "Erro", $verificaImagens, "error");
        Tools::redireciona($retorno_pag);
      }

      // ERRO CAMPOS ÚNICOS
    } else {
      $_SESSION['msg_retorna'] = Tools::alertReturn(0, "Erro", $verificaUnicos, "error");
      Tools::redireciona($_SERVER['REQUEST_URI']);
    }
  }
}

//==================================================//
//                UPDATE MULTIPLE                   //
//==================================================//
if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == 5) {

  $campo = $_POST['campo'];
  $valor = $_POST['status'];
  $ids = $_POST['id'];

  foreach ($ids as $idUpdate) {

    // Dados
    $dados = array(
      $campo => $valor
    );

    $operacao = $acoes->Update($dados, "WHERE id = $idUpdate");

    // RESGATA REGISTRO DA RESERVA
    $reserva = $acoes->SelectSingle("SELECT * FROM anuncios_reservas WHERE id = $idUpdate LIMIT 1");

    // INDISPONIBILIZA DATAS
    if ($valor == 1) {
      $delDtas = $acoes->SelectSQL("DELETE FROM anuncios_datas_indisponiveis WHERE origem='2' AND origem_id = " . $reserva['id']);
      $dtas = Tools::intervaloDatas($reserva['chegada'], $reserva['saida']);
      $acoes_reservas = new Crud('anuncios_datas_indisponiveis');
      // Remove última data
      array_pop($dtas);
      // Remove primeira data
      array_shift($dtas);
      foreach ($dtas as $key => $dta) {
        // DADOS
        $dados = array(
          'dta' => $dta,
          'origem' => 2,
          'anuncio_id' => $reserva['anuncio_id'],
          'origem_id' => $reserva['id'],
          'dta_cad' => Tools::getDate()
        );
        $operacao = $acoes_reservas->Insert($dados);
        if (!$operacao) {
          //$erro++;
        }
      }
      // RESGATA DADOS DO LOCATÁRIO
      $acoes_locatario = new Crud('locatarios');
      $idLocatario = $reserva['locatario_id'];
      $locatario = $acoes_locatario->SelectSingle("SELECT * FROM locatarios WHERE id = $idLocatario LIMIT 1");
      // ENVIA E-MAIL PARA O LOCATÁRIO
      $dados_email = array(
        'titulo' => 'Hospedagem Confirmada',
        'texto' => "Olá <b>" . $locatario['nome'] . "</b>! Sua hospedagem foi aceita. Acesse sua área para mais informações.",
        'botao' => array(
          'texto' => 'Acessar Conta',
          'url' => URL . "locatario/entrar"
        )
      );
      $assunto = "Hospedagem confirmada";
      $destinatarios = array($locatario['email']);
      $responderParaNome = SMTP_USER;
      $responderParaEmail = SMTP_USER;
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);
      //echo $email->getPrev();		
      $email->enviar();
    }

    // DISPONIBILIZA DATAS
    if ($valor == 0) {
      $delDtas = $acoes->SelectSQL("DELETE FROM anuncios_datas_indisponiveis WHERE origem='2' AND origem_id = " . $idUpdate);
    }

    // ERRO OPERAÇÃO
    if (!$operacao) {
      $_SESSION['msg_retorna'] = Tools::alertReturn(4);
      Tools::redireciona($retorno_pag);
      exit;
    }
  }

  // SUCESSO
  $_SESSION['msg_retorna'] = Tools::alertReturn(2);
  Tools::redireciona($retorno_pag);
}


//==================================================//
//                     DELETE                       //
//==================================================//
if ($acao == "delete" && TOKEN == $token_confirma_del) {

  $idDel = Tools::protege($_POST['id']);
  $pathRemove = $path . "/" . $idDel;

  $adicionais = array(
    'anuncios_reservas_valores' => "reserva_id",
    'anuncios_reservas_valores_repasse' => "reserva_id"
  );

  $operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

  $delDtas = $acoes->SelectSQL("DELETE FROM anuncios_datas_indisponiveis WHERE origem='2' AND origem_id = " . $idDel);

  if ($operacao) {

    $_SESSION['msg_retorna'] = Tools::alertReturn(3);
    Tools::redireciona($retorno_pag);
  } else {

    $_SESSION['msg_retorna'] = Tools::alertReturn(4);
    Tools::redireciona($retorno_pag);
  }
}


//==================================================//
//                DELETE MULTIPLE                   //
//==================================================//
if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == 6) {

  $ids = $_POST['id'];

  foreach ($ids as $idDel) {

    $adicionais = array(
      'anuncios_reservas_valores' => "reserva_id",
      'anuncios_reservas_valores_repasse' => "reserva_id"
    );

    $pathRemove = $path . "/" . $idDel;
    $operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

    $delDtas = $acoes->SelectSQL("DELETE FROM anuncios_datas_indisponiveis WHERE origem='2' AND origem_id = " . $idDel);

    // ERRO OPERAÇÃO
    if (!$operacao) {
      $_SESSION['msg_retorna'] = Tools::alertReturn(4);
      Tools::redireciona($retorno_pag);
      exit;
    }
  }

  // SUCESSO
  $_SESSION['msg_retorna'] = Tools::alertReturn(3);
  Tools::redireciona($retorno_pag);
}
