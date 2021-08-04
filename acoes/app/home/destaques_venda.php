<?php

$anunciosExibidosVenda = array();

// Destaques venda
$anuncios = new Crud("anuncios");
$sqlAnuncios = "SELECT 
  a.id, 
  a.id_usuario, 
  a.titulo, 
  a.finalidade,
  a.tipo, 
  a.logradouro,
  a.bairro, 
  a.cidade, 
  a.area, 
  a.quartos, 
  a.vagas,
  a.valor_venda,
  a.valor_aluguel,
  a.valor_condominio,
  a.valor_iptu,
  a.slug,
  a.tag_destaque,
  ati.titulo AS tipo_item
FROM 
  anuncios AS a 
INNER JOIN anuncios_tipos_itens AS ati ON ati.id=a.tipo_id
INNER JOIN proprietarios AS p ON p.id=a.id_usuario
WHERE 
  (a.finalidade='venda' OR a.finalidade='venda-aluguel')
  AND a.destaque=1
  AND a.status=1
  AND p.status=1
  AND (SELECT count(f.id) FROM anuncios_fotos AS f WHERE f.item_id=a.id) > 4
ORDER BY a.id DESC LIMIT 20";
$destaquesVenda = $anuncios->SelectMultiple($sqlAnuncios, false, 0);
$numAnunciosVenda = $anuncios->totalRegistros();

foreach ($destaquesVenda as $anuncioK => $anuncioV) {
  // Valores
  if ($anuncioV['finalidade'] == "venda") {
    $destaquesVenda[$anuncioK]['valor'] = $anuncioV['valor_venda'];
  } else if ($anuncioV['finalidade'] == "aluguel") {
    $destaquesVenda[$anuncioK]['valor'] = $anuncioV['valor_aluguel'];
  }
  $destaquesVenda[$anuncioK]['valor_add'] = doubleval($anuncioV['valor_condominio']) + doubleval($anuncioV['valor_iptu']);
  // Fotos
  $fotosAnuncio = $anuncios->SelectSQL("SELECT * FROM anuncios_fotos WHERE item_id=".$anuncioV['id']." ORDER BY destaque DESC, ordem ASC, id ASC LIMIT 5");
  $destaquesVenda[$anuncioK]['fotos'] = $fotosAnuncio;

  array_push($anunciosExibidosVenda, $anuncioV['id']);
}
