<?

$anuncios = new Crud("anuncios");
$anuncios_reservas = new Crud("anuncios_reservas");

// TOTAL ANUNCIOS
$totalAnuncios = $anuncios->SelectTotalSQL("SELECT id FROM anuncios WHERE id <> 0");

// ÚLTIMAS RESERVAS
$ultimasReservas = $anuncios_reservas->SelectMultiple("SELECT * FROM anuncios_reservas WHERE id <> 0 AND status != 0 ORDER BY id DESC LIMIT 5", false, 0);
$totalUltimasReservas = $anuncios_reservas->SelectTotalSQL("SELECT * FROM anuncios_reservas WHERE id <> 0 AND status != 0 ORDER BY id DESC");

// Seleciona o proprietário/locatario/anuncio
foreach ($ultimasReservas as $key => $value) {

  // Locatário
  $resultLocatario = $conexao->prepare("SELECT nome, cpf FROM locatarios WHERE id = :locatario_id");
  $resultLocatario->bindValue(":locatario_id", $value['locatario_id'], PDO::PARAM_INT);
  $resultLocatario->execute();
  $locatario = $resultLocatario->fetch(PDO::FETCH_ASSOC);

  $ultimasReservas[$key]['locatario'] = $locatario['nome'] . ' - ' . $locatario['cpf'];

  // Anúncio
  $resultAnuncio = $conexao->prepare("SELECT * FROM anuncios WHERE id = :anuncio_id");
  $resultAnuncio->bindValue(":anuncio_id", $value['anuncio_id'], PDO::PARAM_INT);
  $resultAnuncio->execute();
  $anuncio = $resultAnuncio->fetch(PDO::FETCH_ASSOC);

  $ultimasReservas[$key]['anuncio'] = $anuncio;
}

// RESERVAS POR MÊS
$qtde_meses = array();
$ano_atual = date('Y');
for ($mes = 1; $mes <= 12; $mes++) {
  $qtdeMes = $anuncios_reservas->SelectTotalSQL("SELECT id FROM anuncios_reservas AS p WHERE Month(p.data_cad) = $mes AND Year(p.data_cad) = $ano_atual AND status != 0");
  $qtde_meses[$mes] = $qtdeMes;
}
$qtde_meses = implode(", ", $qtde_meses);

$status_aprovado = "'1'";
$status_pendente = "'0'";

// TOTAL PEDIDOS (CONFIRMADOS, PENDENTES E CANCELADOS)  
$somaTotal = 0;
$totalPedidos = $anuncios->SelectTotalSQL("SELECT id FROM anuncios_reservas WHERE status != 0");
$totalReservas = $anuncios->SelectSingle("SELECT SUM(total) AS total FROM anuncios_reservas
WHERE status != 0");

// TOTAL PEDIDOS CONFIRMADOS
$totalValorConfirmados = $anuncios->SelectSingle("SELECT SUM(valor) AS total FROM anuncios_reservas_valores AS p 
INNER JOIN anuncios_reservas AS r ON r.id = p.reserva_id
WHERE p.status IN($status_aprovado)
AND r.status != 0");

// TOTAL PENDENTES
$totalValorPendentes = $anuncios->SelectSingle("SELECT SUM(valor) AS total FROM anuncios_reservas_valores AS p
INNER JOIN anuncios_reservas AS r ON r.id = p.reserva_id
WHERE p.status IN($status_pendente)
AND r.status != 0");

// TOTAL CANCELADAS
/*$totalCancelados = $anuncios->SelectTotalSQL("SELECT id FROM pedidos AS p WHERE p.status IN($status_cancelado)");
$totalValorCancelados = $anuncios->SelectSingle("SELECT SUM(total) AS total FROM pedidos AS p WHERE p.status IN($status_cancelado)");
$somaTotal += $totalValorCancelados['total'];
$totalPedidos += $totalCancelados;*/

$totalValorConfirmados = Tools::formataMoeda($totalValorConfirmados['total']);
$totalValorPendentes = Tools::formataMoeda($totalValorPendentes['total']);
//$totalValorCancelados = Tools::formataMoeda($totalValorCancelados['total']);
$somaTotal = Tools::formataMoeda($totalReservas['total']);
