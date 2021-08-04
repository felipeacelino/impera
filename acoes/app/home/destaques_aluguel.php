<?php

$anunciosExibidosVenda = implode(",", $anunciosExibidosVenda);

// Destaques aluguel
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
  (a.finalidade='aluguel' OR a.finalidade='venda-aluguel')
  AND a.id NOT IN($anunciosExibidosVenda)
  AND a.destaque=1
  AND a.status=1
  AND p.status=1
  AND (SELECT count(f.id) FROM anuncios_fotos AS f WHERE f.item_id=a.id) > 4
ORDER BY a.id DESC LIMIT 20";
$destaquesAluguel = $anuncios->SelectMultiple($sqlAnuncios, false, 0);
$numAnunciosAluguel = $anuncios->totalRegistros();

foreach ($destaquesAluguel as $anuncioK => $anuncioV) {
  // Valores
  if ($anuncioV['finalidade'] == "venda") {
    $destaquesAluguel[$anuncioK]['valor'] = $anuncioV['valor_venda'];
  } else if ($anuncioV['finalidade'] == "aluguel") {
    $destaquesAluguel[$anuncioK]['valor'] = $anuncioV['valor_aluguel'];
  }
  $destaquesAluguel[$anuncioK]['valor_add'] = doubleval($anuncioV['valor_condominio']) + doubleval($anuncioV['valor_iptu']);
  // Fotos
  $fotosAnuncio = $anuncios->SelectSQL("SELECT * FROM anuncios_fotos WHERE item_id=".$anuncioV['id']." ORDER BY destaque DESC, ordem ASC, id ASC LIMIT 5");
  $destaquesAluguel[$anuncioK]['fotos'] = $fotosAnuncio;
}
