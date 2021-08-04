<?php

$idUser = (int) $user['id'];

$mensagensCrud = new Crud('anuncios_reservas');
$tabela = 'anuncios_reservas';

$acoes = new Crud($tabela);

// Imóveis
$resultImoveis = $conexao->prepare("SELECT * FROM anuncios
WHERE id_proprietario=:proprietario_id
ORDER BY id DESC");
$resultImoveis->bindValue(':proprietario_id', $idUser, PDO::PARAM_INT);
$resultImoveis->execute();
$numImoveis = $resultImoveis->rowCount();
$imoveis = $resultImoveis->fetchAll(PDO::FETCH_ASSOC);

// Filtros de Datas
if (isset($_GET['data']) && $_GET['data'] != '') {
  if ($_GET['data'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_GET['data']);
    $dataInit = Tools::formataDataBd(explode(" a ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
    $dataEnd = Tools::formataDataBd(explode(" a ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
    $filtro_data = " AND (r.chegada BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "' OR r.saida BETWEEN '" . $dataInit . "' AND '" . $dataEnd . "')";
    $filtro .= $filtro_data;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_data']);
    $filtro_data = "";
  }
}

// Filtro de Imóvel
if (isset($_GET['imovel'])) {
  if ($_GET['imovel'] != "") {
    $_SESSION[$pag_include]['filtros']['filtro_anuncio'] = addslashes($_GET['imovel']);
    $filtro_anuncio = " AND r.anuncio_id = " . $_SESSION[$pag_include]['filtros']['filtro_anuncio'] . "";
    $filtro .= $filtro_anuncio;
  } else {
    unset($_SESSION[$pag_include]['filtros']['filtro_anuncio']);
    $filtro_anuncio = "";
  }
}

// Reservas
$resultReservas = $conexao->prepare("SELECT r.* FROM $tabela AS r
INNER JOIN anuncios AS a ON a.id = r.anuncio_id
WHERE a.id_proprietario=:proprietario_id
$filtro 
AND r.status != 0
ORDER BY r.id DESC");
$resultReservas->bindValue(':proprietario_id', $idUser, PDO::PARAM_INT);
$resultReservas->execute();
$numReservas = $resultReservas->rowCount();
$reservas = $resultReservas->fetchAll(PDO::FETCH_ASSOC);

// Seleciona o proprietário/anuncio
foreach ($reservas as $key => $value) {
  $reserva['id'] = $value['id'];

  // Anúncio
  $resultAnuncio = $conexao->prepare("SELECT * FROM anuncios WHERE id = :anuncio_id");
  $resultAnuncio->bindValue(":anuncio_id", $value['anuncio_id'], PDO::PARAM_INT);
  $resultAnuncio->execute();
  $anuncio = $resultAnuncio->fetch(PDO::FETCH_ASSOC);

  // Local
  if ($anuncio['destino_nome'] != '') {
    $destino = $anuncio['destino_nome'] . ', ';
  }
  $cidade_estado = $anuncio['cidade'];

  $anuncio['local'] = $destino . $cidade_estado;

  $reservas[$key]['anuncio'] = $anuncio;

  // Foto de Destaque
  $fotoDest = $acoes->SelectSingle("SELECT foto FROM anuncios_fotos WHERE destaque = 1 AND item_id = " . $anuncio['id'] . " LIMIT 1")['foto'];
  $fotoDest = $fotoDest != "" ?
    "" . URL . "uploads/img/anuncios/" . $anuncio['id'] . "/anuncios_fotos/thumb-300-250/" . $fotoDest : "" . URL . "static/img/admin/sem-foto.jpg";

  $reservas[$key]['foto_anuncio'] = $fotoDest;

  // Total (Reservas)
  $totalReservas += $value['total'];

  // Valor Pago // Total (Recebido)
  $valorPagoRepasse = $acoes->SelectSingle("SELECT SUM(valor_repasse) AS valor_pago FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $reserva['id'] . " AND status_repasse = 1");
  $totalRecebido += $valorPagoRepasse['valor_pago'];

  // Valor Pendente // Total (A Receber)
  $valorPendenteRepasse = $acoes->SelectSingle("SELECT SUM(valor_repasse) AS valor_pendente FROM anuncios_reservas_valores_repasse WHERE reserva_id=" . $reserva['id'] . " AND status_repasse = 0");
  $totalReceber += $valorPendenteRepasse['valor_pendente'];

}
