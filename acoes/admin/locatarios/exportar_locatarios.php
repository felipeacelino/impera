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

$acoes = new Crud("locatarios");

$tabela = "locatarios";
$filtro = "WHERE id > 0";
$order = "ORDER BY id DESC";

// FILTRO 'NOME'
if (isset($_POST['filtro_nome'])) {
  if ($_POST['filtro_nome'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_nome'] = addslashes($_POST['filtro_nome']);
    $filtro_nome = " AND nome LIKE '%" . $_SESSION[$pag_include]['filtros']['filtro_nome'] . "%'";
    $filtro .= $filtro_nome;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_nome']);
    $filtro_nome = "";
  }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_nome'])) {
  $filtro_nome = " AND nome LIKE '%" . $_SESSION[$pag_include]['filtros']['filtro_nome'] . "%'";
  $filtro .= $filtro_nome;
}

// FILTRO 'EMAIL'
if (isset($_POST['filtro_email'])) {
  if ($_POST['filtro_email'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_email'] = addslashes($_POST['filtro_email']);
    $filtro_email = " AND email = '" . $_SESSION[$pag_include]['filtros']['filtro_email'] . "'";
    $filtro .= $filtro_email;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_email']);
    $filtro_email = "";
  }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_email'])) {
  $filtro_email = " AND email = '" . $_SESSION[$pag_include]['filtros']['filtro_email'] . "'";
  $filtro .= $filtro_email;
}

// FILTRO 'STATUS'
if (isset($_POST['filtro_status'])) {
  if ($_POST['filtro_status'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
    $filtro_status = " AND status = '" . $_SESSION[$pag_include]['filtros']['filtro_status'] . "'";
    $filtro .= $filtro_status;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_status']);
    $filtro_status = "";
  }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
  $filtro_status = " AND status = '" . $_SESSION[$pag_include]['filtros']['filtro_status'] . "'";
  $filtro .= $filtro_status;
}

// FILTRO 'STATUS ATENDIMENTO'
if (isset($_POST['filtro_status_atendimento'])) {
  if ($_POST['filtro_status_atendimento'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_status_atendimento'] = addslashes($_POST['filtro_status_atendimento']);
    $filtro_status_atendimento = " AND status_atendimento = '" . $_SESSION[$pag_include]['filtros']['filtro_status_atendimento'] . "'";
    $filtro .= $filtro_status_atendimento;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_status_atendimento']);
    $filtro_status_atendimento = "";
  }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_status_atendimento'])) {
  $filtro_status_atendimento = " AND status_atendimento = '" . $_SESSION[$pag_include]['filtros']['filtro_status_atendimento'] . "'";
  $filtro .= $filtro_status_atendimento;
}

// FILTRO 'DATA'
if (isset($_POST['filtro_data'])) {
  if ($_POST['filtro_data'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
    $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
    $filtro_data = " AND (dta_cad BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "')";
    $filtro .= $filtro_data;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_data']);
    $filtro_data = "";
  }
} else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
  $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
  $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
  $filtro_data = " AND (dta_cad BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "')";
  $filtro .= $filtro_data;
}

// ORDERNAR
if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
  $_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
  $order = $_SESSION[$pag_include]['ordem'];
} else if ($_SESSION[$pag_include]['ordem'] != "") {
  $order = $_SESSION[$pag_include]['ordem'];
}

$locatarios = $acoes->SelectMultiple("SELECT * FROM $tabela $filtro $order", false, 0);
$total_registros = $acoes->totalRegistros();

if ($total_registros > 0) {

  $objPHPExcel = new PHPExcel();

  // Títulos das colunas
  $header_itens = array('Locatário', 'E-mail');

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

  foreach ($locatarios as $locatario) {

    // Popula os dados na planilha
    $coluna = 0;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $locatario['nome']);
    $coluna++;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $locatario['email']);
    $coluna++;

    $linha++;
  }

  // Título da planilha
  $objPHPExcel->getActiveSheet()->setTitle('locatarios');
  // Tipo do arquivo
  header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
  // Nome do arquivo
  header('Content-Disposition: attachment;filename="locatarios_' . Tools::formataData(Tools::getDate()) . '.xls"');
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
  Tools::redireciona("" . URL . "admin/locatarios/locatarios/" . TOKEN . "/view");
}
