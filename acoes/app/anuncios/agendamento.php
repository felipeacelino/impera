<?php
include ("".CLASS_PATH."/Usuarios.class.php");

if (isset($_SESSION['user']['corretor']['id']) && $_SESSION['user']['corretor']['id'] != "") {
  $tabelaUser = "proprietarios";
  $ambienteUser = "corretor";
} else if (isset($_SESSION['user']['cliente']['id']) && $_SESSION['user']['cliente']['id'] != "") {
  $tabelaUser = "clientes";
  $ambienteUser = "cliente";
}
$usuario = new Usuarios($tabelaUser, $ambienteUser);
if ($usuario->logado()) {
  $user = $usuario->getUserFromSession();
}

// Visitas agendadas
$visitas = new Crud("anuncios_visitas");
$visitasAgendadas = $visitas->SelectSQL("SELECT data FROM anuncios_visitas WHERE anuncio_id=$idAnuncio AND data>CURDATE() AND status>0 ORDER BY data ASC");
foreach ($visitasAgendadas as $visitasK => $visitasV) {
  $visitasAgendadas[$visitasK]['date'] = explode(" ", $visitasV['data'])[0];
  $visitasAgendadas[$visitasK]['horario'] = substr(explode(" ", $visitasV['data'])[1], 0, 5);
}

// Retorna os novos horários disponíveis de uma data removendo os indisponíveis
function getHorariosDisponiveis($data, $horarios, $visitas) {
  foreach ($visitas as $visita) {
    if ($visita['date'] == $data) {
      $horBloqInicio = (int) str_replace(":", "", date("H:i", strtotime('-'.DURACAO_VISITA." mins", strtotime(Tools::getDate()." ".$visita['horario']))));
      $horBloqFim = (int) str_replace(":", "", date("H:i", strtotime('+'.DURACAO_VISITA." mins", strtotime(Tools::getDate()." ".$visita['horario']))));
      foreach ($horarios as $horarioK => $horarioV) {
        $horarioVer = (int) str_replace(":", "", $horarioV);
        if ($horarioVer > $horBloqInicio && $horarioVer < $horBloqFim) {
          unset($horarios[$horarioK]);
        }
      }
    }
  }
  return $horarios;
}

function getTimeEnd($time, $interval) {
  return date("H:i", strtotime('-'.$interval." mins", strtotime(Tools::getDate()." ".$time)));
}

// Horários agendamento
$horariosVisitas = array();
if ($anuncio['domingo_status'] == "1" && $anuncio['domingo_inicio'] != "" && $anuncio['domingo_fim'] != "") {
  $horariosVisitas[0] = Tools::getTimeRange($anuncio['domingo_inicio'], getTimeEnd($anuncio['domingo_fim'], DURACAO_VISITA));
}
if ($anuncio['segunda_status'] == "1" && $anuncio['segunda_inicio'] != "" && $anuncio['segunda_fim'] != "") {
  $horariosVisitas[1] = Tools::getTimeRange($anuncio['segunda_inicio'], getTimeEnd($anuncio['segunda_fim'], DURACAO_VISITA));
}
if ($anuncio['terca_status'] == "1" && $anuncio['terca_inicio'] != "" && $anuncio['terca_fim'] != "") {
  $horariosVisitas[2] = Tools::getTimeRange($anuncio['terca_inicio'], getTimeEnd($anuncio['terca_fim'], DURACAO_VISITA));
}
if ($anuncio['quarta_status'] == "1" && $anuncio['quarta_inicio'] != "" && $anuncio['quarta_fim'] != "") {
  $horariosVisitas[3] = Tools::getTimeRange($anuncio['quarta_inicio'], getTimeEnd($anuncio['quarta_fim'], DURACAO_VISITA));
}
if ($anuncio['quinta_status'] == "1" && $anuncio['quinta_inicio'] != "" && $anuncio['quinta_fim'] != "") {
  $horariosVisitas[4] = Tools::getTimeRange($anuncio['quinta_inicio'], getTimeEnd($anuncio['quinta_fim'], DURACAO_VISITA));
}
if ($anuncio['sexta_status'] == "1" && $anuncio['sexta_inicio'] != "" && $anuncio['sexta_fim'] != "") {
  $horariosVisitas[5] = Tools::getTimeRange($anuncio['sexta_inicio'], getTimeEnd($anuncio['sexta_fim'], DURACAO_VISITA));
}
if ($anuncio['sabado_status'] == "1" && $anuncio['sabado_inicio'] != "" && $anuncio['sabado_fim'] != "") {
  $horariosVisitas[6] = Tools::getTimeRange($anuncio['sabado_inicio'], getTimeEnd($anuncio['sabado_fim'], DURACAO_VISITA));
}

// Dias agendamento
$dataAtual = Tools::getDate();
$dataInicial = Tools::somaData($dataAtual, 1);
$dataFinal = Tools::somaData($dataInicial, 31);
$datasRange = Tools::getRange($dataInicial, $dataFinal);
$dataVisitas = array();
$limiteDias = 15;
$diaCount = 0;
$checkedPrimeira = false;
foreach ($datasRange as $dataItem) {
  $dataItemArr = explode("-", $dataItem);
  $diaSemana = explode("-", Tools::retornaDiaSemana($dataItem))[0];
  $diaStatus = strtolower(Tools::geraSlug($diaSemana))."_status";
  if ($diaCount < $limiteDias && $anuncio[$diaStatus] == "1") {
    $diaCount++;
    $horarios = $horariosVisitas[date("w", strtotime($dataItem))];
    $horarios = getHorariosDisponiveis($dataItem, $horarios, $visitasAgendadas);
    $checked = "0";
    $disabled = "0";
    if (count($horarios) === 0) {
      $disabled = "1";
    }
    if (!$checkedPrimeira && $disabled == "0") {
      $checkedPrimeira = true;
      $checked = "1";
    }
    array_push($dataVisitas, array(
      'data' => $dataItem,
      'dia' => $dataItemArr[2],
      'mes' => substr(Tools::retornaMes($dataItem), 0, 3),
      'dia_semana' => $diaSemana,
      'horarios' => $horarios,
      'checked' => $checked,
      'disabled' => $disabled,
    ));
  }
}
