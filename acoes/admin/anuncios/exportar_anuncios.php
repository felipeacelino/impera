<?php

session_start();

include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");
include("" . ACOES_ADMIN_PATH . "/geral/restritos.php");
include("" . ACOES_ADMIN_PATH . "/geral/user.php");
include("" . CLASS_PATH . "/PHPExcel/Classes/PHPExcel.php");
include("" . ACOES_APP_PATH . "/gerais/filtros.php");

Tools::debug(false);

$db = new Init();
$conexao = $db->conectar();

$acoes = new Crud("anuncios");

$tabela = "anuncios";
$filtro = "WHERE a.id > 0";
$order = "ORDER BY a.id DESC";

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

// FILTRO 'TIPO'
if (isset($_POST['filtro_tipo'])) {
  if ($_POST['filtro_tipo'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_tipo'] = addslashes($_POST['filtro_tipo']);
    $filtro_tipo = " AND a.tipo_anuncio = '" . $_SESSION[$pag_include]['filtros']['filtro_tipo'] . "'";
    $filtro .= $filtro_tipo;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_tipo']);
    $filtro_tipo = "";
  }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_tipo'])) {
  $filtro_tipo = " AND a.tipo_anuncio = '" . $_SESSION[$pag_include]['filtros']['filtro_tipo'] . "'";
  $filtro .= $filtro_tipo;
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

// ORDERNAR
if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
  $_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
  $order = $_SESSION[$pag_include]['ordem'];
} else if ($_SESSION[$pag_include]['ordem'] != "") {
  $order = $_SESSION[$pag_include]['ordem'];
}

$anuncios = $acoes->SelectMultiple("SELECT a.* FROM $tabela AS a $filtro $order", false, 0);
$total_registros = $acoes->totalRegistros();

foreach ($anuncios as $key => $linha) {

  // CARACTERISTICAS ATUAIS
  $resultCaracsAtuais = $conexao->prepare("SELECT caracteristica_id FROM anuncios_caracteristicas_n_n WHERE anuncio_id=:anuncio_id");
  $resultCaracsAtuais->bindValue(":anuncio_id", $linha['id'], PDO::PARAM_INT);
  $resultCaracsAtuais->execute();
  $caracteristicas_atuais = $resultCaracsAtuais->fetchAll(PDO::FETCH_COLUMN);

  $lista_caracteristica = '';
  foreach ($caracteristicas as $key2 => $filtro_row) {
    if (in_array($filtro_row['id'], $caracteristicas_atuais)) {
      $lista_caracteristicas .= $filtro_row['caracteristica'] . ', ';
    }
  }
  if ($lista_caracteristica != '') {
    $lista_caracteristicas = substr($lista_caracteristicas, 0, -1);
  }
  $anuncios[$key]['caracteristicas'] = $lista_caracteristicas;

  // STATUS
  $anuncios[$key]['status'] = $linha['status'] == 1 ? 'Ativo' : 'Inativo';

  // TIPO 
  $anuncios[$key]['tipo'] = $tipo_de_imovel[$linha['tipo']];

  // DESTINO
  $resultDestino = $conexao->prepare("SELECT destino FROM anuncios_destinos WHERE id=:id");
  $resultDestino->bindValue(":id", $linha['destino'], PDO::PARAM_INT);
  $resultDestino->execute();
  $destino = $resultDestino->fetch(PDO::FETCH_ASSOC);

  $anuncios[$key]['destino'] = $destino['destino'];

  // CONDOMINIO
  $resultCondominio = $conexao->prepare("SELECT condominio FROM anuncios_condominios WHERE id=:id");
  $resultCondominio->bindValue(":id", $linha['condominio'], PDO::PARAM_INT);
  $resultCondominio->execute();
  $condominio = $resultCondominio->fetch(PDO::FETCH_ASSOC);

  $anuncios[$key]['condominio'] = $condominio['condominio'];

  // Proprietário
  $resultProprietario = $conexao->prepare("SELECT nome, cpf, telefone, email FROM proprietarios WHERE id = :id_proprietario");
  $resultProprietario->bindValue(":id_proprietario", $linha['id_proprietario'], PDO::PARAM_INT);
  $resultProprietario->execute();
  $proprietario = $resultProprietario->fetch(PDO::FETCH_ASSOC);

  $anuncios[$key]['proprietario'] = $proprietario['nome'] . ' - ' . $proprietario['cpf'] . ' - Telefone: ' . $proprietario['telefone'] . ' - E-mail: ' . $proprietario['email'];
}

if ($total_registros > 0) {

  $objPHPExcel = new PHPExcel();

  // Títulos das colunas
  $header_itens = array('Proprietário', 'Título', 'Código', 'Status', 'Tipo de imóvel', 'Imóvel destinado para', 'Valor por diária', 'Valor para Venda', 'Estadia mínima', 'Hóspedes', 'Quartos', 'Suítes', 'Banheiros', 'Características', 'Cidade', 'Destino', 'Condomínio', 'Endereço');

  // Popula os títulos da coluna (Primeira linha)
  foreach ($header_itens as $key => $value) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($key, 1, $value);
  }

  // Obtém a String da última coluna
  $lastColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();

  // Aplica negrito na fonte de todas as celulas da primeira linha
  $objPHPExcel->getActiveSheet()->getStyle('A1:' . $lastColumn . '1')->getFont()->setBold(true);

  // Fixa a primeira linha
  $objPHPExcel->getActiveSheet()->freezePane('A1');

  // Aplica largura automática em todas as colunas e alinha a esquerda
  for ($col = 'A'; $col !== $lastColumn; $col++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getStyle($col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  }

  // Dados do banco
  $linha = 2;

  foreach ($anuncios as $anuncio) {

    if ($anuncio['tipo_anuncio'] == 'temporada') {
      $anuncio['tipo_anuncio'] = 'Temporada';
    } else if ($anuncio['tipo_anuncio'] == 'venda') {
      $anuncio['tipo_anuncio'] = 'Venda';
    } else if ($anuncio['tipo_anuncio'] == 'venda_e_temporada') {
      $anuncio['tipo_anuncio'] = 'Venda e Temporada';
    } else {
      $anuncio['tipo_anuncio'] = $anuncio['tipo_anuncio'];
    }

    // Popula os dados na planilha
    $coluna = 0;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['proprietario']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['titulo']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['codigo']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['status']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['tipo']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['tipo_anuncio']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, Tools::formataMoeda($anuncio['valor']));
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, Tools::formataMoeda($anuncio['valor_venda']));
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['estadia_minima']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['hospedes']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['quartos']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['suites']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['banheiros']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['caracteristicas']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['cidade']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['destino']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['condominio']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $anuncio['endereco']);
    $coluna++;

    $linha++;
  }

  // Título da planilha
  $objPHPExcel->getActiveSheet()->setTitle('anuncios');
  // Tipo do arquivo
  header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
  // Nome do arquivo
  header('Content-Disposition: attachment;filename="anuncios_' . Tools::formataData(Tools::getDate()) . '.xls"');
  header('Cache-Control: max-age=0');
  header('Cache-Control: max-age=1');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  // Salva o arquivo
  $objWriter->save('php://output');
  // Documentação
  //https://github.com/PHPOffice/PHPExcel/wiki/User-documentation

  exit;
} else {

  $_SESSION['msg_retorna'] = Tools::alertReturn(0, "Sem registros", "Não há registros para serem exportados", "warning");
  Tools::redireciona("" . URL . "admin/anuncios/anuncios/" . TOKEN . "/view");
}
