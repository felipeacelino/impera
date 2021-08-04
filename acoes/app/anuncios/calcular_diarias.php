<?php
if (!isset($_SESSION)) { session_start(); } 
include("../../../paths.php");
include("" . BASE_PATH . "/base.class.php");
include("" . BASE_PATH . "/init.class.php");
include("" . BASE_PATH . "/tools.class.php");
include("" . BASE_PATH . "/crud.class.php");
include("" . CONF_PATH . "/conf.php");

Tools::debug(false);

$tabela = "anuncios";
$anuncios = new Crud($tabela);

$anuncioId = $_GET['anuncio'];
$chegada = Tools::formataDataBd($_GET['chegada']);
$saida = Tools::formataDataBd($_GET['saida']);
$hospedes = $_GET['hospedes'];
$diarias = $_GET['diarias'];

$periodo = Tools::intervaloDatas($chegada, $saida);
$end = end($periodo);
$ultimaDataKey = key($end);
$valorTotal = 0;
$possuiValorDiferenciado = false;
$datasValorDiferenciado = '';
$possuiTaxaDiferenciada = false;
$minimoDeDiasValorDiferenciado = 0;
$qtdDiariasDiferenciadas = 0;
$qtdDiariasNormais = 0;

//Resgata o anúncio
$sqlAnuncios = "SELECT 
valor
FROM anuncios
WHERE id = $anuncioId
AND status = 1";
$linhaAnuncio = $anuncios->SelectSingle($sqlAnuncios);
$diariaBasica = $linhaAnuncio['valor'];

//Tarifas
foreach ($periodo as $key => $dta) {
  $verifica = $anuncios->SelectSingle("SELECT 
  id,
  valor,
  data_inicial,
  data_final,
  estadia_minima
  FROM anuncios_precos 
  WHERE anuncio_id = $anuncioId
  AND '" . $dta . "' BETWEEN data_inicial AND data_final");
  if ($verifica['valor'] != "" && $verifica['valor'] > 0) {
    if ($dta != $end) {
      $valorTotal += $verifica['valor'];
    }
    $minimoDeDiasValorDiferenciado = $verifica['estadia_minima'];
    $possuiValorDiferenciado = true;
    //$datasValorDiferenciado = Tools::formataData($verifica['data_inicial']) . ' a ' . Tools::formataData($verifica['data_final']) . ', com no mínimo ' . $minimoDeDiasValorDiferenciado . ' noite(s) nessas datas';
    $datasValorDiferenciado = ' no mínimo ' . $minimoDeDiasValorDiferenciado . ' dia(s)';
    if ($chegada == $verifica['data_inicial'] && $saida == $verifica['data_final']) {
      $datasDiferenciadoAprovado = true;
    } else {
      $datasDiferenciadoAprovado = true;
    }
    $qtdDiariasDiferenciadas++;
  } else {
    if ($dta != $end) {
      $valorTotal += $diariaBasica;
    }
    $qtdDiariasNormais++;
  }
}
if ($datasDiferenciadoAprovado == true) {
  if($qtdDiariasNormais != 0){
    $qtdDiariasDiferenciadas = $qtdDiariasDiferenciadas + $qtdDiariasNormais;
  }
  if ($qtdDiariasDiferenciadas >= $minimoDeDiasValorDiferenciado) {
    $datasDiferenciadoAprovado = true;
  } else {
    $datasDiferenciadoAprovado = false;
  }
}

// Taxas
$sqlTaxas = "SELECT 
*
FROM anuncios_taxas
WHERE anuncio_id = $anuncioId";
$valorTaxasRown = $anuncios->SelectSQL($sqlTaxas);
$valorTaxasIncremento = 0;
foreach ($valorTaxasRown as $valorTaxas) {
  if ($valorTaxas['aplicacao'] == 1) {
    $valorTaxasIncremento += $valorTaxas['valor'] * $diarias;
    $possuiTaxaDiferenciada = true;
  } else {
    $valorTaxasIncremento += $valorTaxas['valor'];
  }
}
$valorTotalComTaxas += $valorTaxasIncremento + $valorTotal;

$arr_retorno = array(
  'valor_total_sem_taxas' => $valorTotal,
  'valor_total_com_taxas' => $valorTotalComTaxas,
  'valor_taxas' => $valorTaxasIncremento,
  'valor_diferenciado' => $possuiValorDiferenciado,
  'datas_valor_diferenciado' => $datasValorDiferenciado,
  'minimo_dias_datas_valor_diferenciado' => $minimoDeDiasValorDiferenciado,
  'qtd_datas_valor_diferenciado' => $qtdDiariasDiferenciadas,
  'datas_diferenciado_aprovado' => $datasDiferenciadoAprovado,
  'valor_taxa_diferenciado' => $possuiTaxaDiferenciada
);

die(json_encode($arr_retorno));
