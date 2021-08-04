<?php

$anuncios_crud = new Crud("anuncios");

$chegada = Tools::formataDataBd($_GET['chegada']);
$saida = Tools::formataDataBd($_GET['saida']);
$periodo = Tools::intervaloDatas($chegada, $saida);

// BUSCA PERSONALIZADA
if (isset($param2) && $param2 != "") {
  $slug = explode('-', $param2);
  $buscaId = $slug[1];
}
$resultBuscaPersonalizada = $conexao->prepare("SELECT * FROM buscas WHERE id = :id");
$resultBuscaPersonalizada->bindValue(":id", $buscaId, PDO::PARAM_INT);
$resultBuscaPersonalizada->execute();
$buscaPersonalizada = $resultBuscaPersonalizada->fetch(PDO::FETCH_ASSOC);
if($buscaPersonalizada['status'] == 0){
  Tools::redireciona(URL.'imoveis');
}

// ID DOS ANUNCIOS DA BUSCA
$resultIdsBuscas = $conexao->prepare("SELECT anuncio_id FROM buscas_anuncios WHERE busca_id = :id");
$resultIdsBuscas->bindValue(":id", $buscaId, PDO::PARAM_INT);
$resultIdsBuscas->execute();
$idsBuscas = $resultIdsBuscas->fetchAll(PDO::FETCH_COLUMN);
foreach ($idsBuscas as $key => $id) {
  $lista_ids_anuncios .= $id . ', ';
}
$lista_ids_anuncios = substr($lista_ids_anuncios, 0, -2);

// FILTROS
$filtros_caracteristicas = "";
$filtros = "WHERE a.status = 1";
$order = 'ORDER BY a.id DESC';

// ANÚNCIOS
$sql = "SELECT DISTINCT a.*, 
(SELECT ac.condominio FROM anuncios_condominios AS ac WHERE ac.id = a.condominio) AS condominio_nome,  
(SELECT ad.destino FROM anuncios_destinos AS ad WHERE ad.id = a.destino) AS destino_nome, 
(SELECT ad.estado FROM anuncios_destinos AS ad WHERE ad.id = a.destino) AS estado_nome, 
(SELECT AVG(aa.estrelas) FROM anuncios_avaliacoes AS aa WHERE aa.anuncio_id = a.id AND aa.status = 1) AS media_avaliacao, 
(SELECT af.foto FROM anuncios_fotos AS af WHERE af.item_id = a.id AND af.destaque = 1 ORDER BY af.id DESC, af.ordem_exibicao) AS foto_destaque 
FROM anuncios AS a
$filtros_caracteristicas
$filtros
$tipo_anuncio
AND a.id IN ($lista_ids_anuncios)
$order";
$url_paginacao = URL . "imoveis";
$url_paginacao = $url_paginacao . Tools::montaUrlFiltro($_GET);

$anuncios = $anuncios_crud->SelectMultiple($sql, true, 12);
$numAnuncios = $anuncios_crud->totalRegistros();

if ($numAnuncios == 0) {
  $prefixoBusca = 'Nenhum';
} else if ($numAnuncios == 1) {
  $prefixoBusca = 'Imóvel';
} else {
  $prefixoBusca = 'Imóveis';
}

// FOTOS DOS ANÚNCIOS / LOCAL / VALOR 
foreach ($anuncios as $key => $anuncio) {

  if ($_GET['destino'] != '') {
    $complementoBusca = " em <b>" . $anuncio['cidade'] . "</b>";
  }

  // FOTOS
  $resultFotos = $conexao->prepare("SELECT * FROM anuncios_fotos WHERE item_id=:item_id ORDER BY ordem_exibicao ASC LIMIT 3");
  $resultFotos->bindValue(":item_id", $anuncio['id'], PDO::PARAM_INT);
  $resultFotos->execute();
  $numFotos = $resultFotos->rowCount();
  $anunciosFotos = $resultFotos->fetchAll(PDO::FETCH_ASSOC);
  $anuncios[$key]['fotos'] = $anunciosFotos;
  $anuncios[$key]['num_fotos'] = $numFotos;

  // LOCAL
  if ($anuncio['destino_nome'] != '') {
    $destino = $anuncio['destino_nome'] . ', ';
  }
  $cidade_estado = $anuncio['cidade'];

  $anuncios[$key]['local'] = $destino . $cidade_estado;

  if ($_GET['chegada'] != '' && $_GET['saida'] != '') {
    // CALCULAR VALOR DA RESERVA
    $anuncioId = $anuncio['id'];
    $end = end($periodo);
    $ultimaDataKey = key($end);
    $diarias = count($periodo);
    $diarias--;
    $valorTotal = 0;
    $valorTotalComTaxas = 0;
    $possuiValorDiferenciado = false;
    $datasValorDiferenciado = '';
    $possuiTaxaDiferenciada = false;

    //Resgata o anúncio
    $sqlAnuncios = "SELECT 
    valor
    FROM anuncios
    WHERE id = $anuncioId
    AND status = 1";
    $linhaAnuncio = $anuncios_crud->SelectSingle($sqlAnuncios);
    $diariaBasica = $linhaAnuncio['valor'];

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
        $anuncios[$key]['valor'] = $verifica['valor'];
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

    // Taxas
    $sqlTaxas = "SELECT 
    *
    FROM anuncios_taxas
    WHERE anuncio_id = $anuncioId";
    $valorTaxasRown = $anuncios_crud->SelectSQL($sqlTaxas);
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
    $anuncios[$key]['valor_total'] = $valorTotalComTaxas;
  } else {
    $anuncios[$key]['valor_total'] = '';
  }
}
