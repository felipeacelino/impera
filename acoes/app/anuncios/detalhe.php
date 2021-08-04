<?php
$anuncios = new Crud("anuncios");

// Slug do anúncio
$slugAnuncio = $param1;

// Visualização restrita
$idPropLogado = $_SESSION['user']['proprietario']['id'];
$idCorrLogado = $_SESSION['user']['corretor']['id'];
$viewRestrito = false;
$filtroView = "";
$filtroStatus = "AND a.status=1";
$filtroStatusUser = "AND p.status=1";
$filtroFotos = "AND (SELECT count(f.id) FROM anuncios_fotos AS f WHERE f.item_id=a.id) > 4";
if ($param2 === "view" && ((isset($idPropLogado) && $idPropLogado != "") || (isset($idCorrLogado) && $idCorrLogado != ""))) {
  $viewRestrito = true;
  $filtroView = "AND (a.id_usuario=$idPropLogado OR a.id_usuario=$idCorrLogado)";
  $filtroStatus = "";
  $filtroStatusUser = "";
  $filtroFotos = "";
}

// Detalhe anúncio
$sqlAnuncio = 
"SELECT 
  a.*,
  ati.titulo AS tipo_item
FROM 
  anuncios AS a 
  INNER JOIN proprietarios AS p ON p.id=a.id_usuario
  INNER JOIN anuncios_tipos_itens AS ati ON ati.id=a.tipo_id
WHERE
  a.slug='$slugAnuncio'
  $filtroView
  $filtroStatus
  $filtroStatusUser
  $filtroFotos
ORDER BY a.id ASC LIMIT 1";
$anuncio = $anuncios->SelectSingle($sqlAnuncio);

if ($anuncio == "") {
  Tools::redireciona(URL);
  exit();
}

$idAnuncio = $anuncio['id'];

// Valores aluguel
if ($anuncio['finalidade'] == "aluguel" || $anuncio['finalidade'] == "venda-aluguel") {
  // Taxa serviço
  $anuncio['valor_taxa_servico'] = ($anuncio['taxa'] * $anuncio['valor_aluguel']) / 100;
  $anuncio['total_aluguel'] = $anuncio['valor_aluguel'] + $anuncio['valor_iptu'] + $anuncio['valor_condominio'] + $anuncio['valor_seguro_incendio'] + $anuncio['valor_taxa_servico'];
  $anuncio['renda_ideal'] = $anuncio['total_aluguel'] * 2.5;
}

// Valores venda
$anuncio['valor_itbi'] = 0;
$anuncio['valor_escritura'] = 0;
$anuncio['valor_registro'] = 0;
$taxasVenda = $anuncios->SelectSingle("SELECT * FROM anuncios_taxas WHERE estado_id=".$anuncio['estado_id']." LIMIT 1");
if ($taxasVenda != "" && $anuncio['governo'] != "1") {
  $taxaITBI = (float) $taxasVenda['itbi'];
  $taxaEscritura = (float) $taxasVenda['escritura'];
  $taxaRegistro = (float) $taxasVenda['registro'];
  $anuncio['valor_itbi'] = ($taxaITBI * (float) $anuncio['valor_venda']) / 100;   
  $anuncio['valor_escritura'] = ($taxaEscritura * (float) $anuncio['valor_venda']) / 100; 
  $anuncio['valor_registro'] = ($taxaRegistro * (float) $anuncio['valor_venda']) / 100;
}

// Fotos
$fotosAnuncio = $anuncios->SelectSQL("SELECT * FROM anuncios_fotos WHERE item_id=".$idAnuncio." ORDER BY destaque DESC, ordem ASC, id ASC");
$anuncio['fotos'] = $fotosAnuncio;
$totalFotos = count(array_filter($fotosAnuncio));

// Contador de views
if (!$_COOKIE['an-view-'.$idAnuncio]) {
  $update_view = $conexao->prepare("UPDATE anuncios SET views=views+1 WHERE id=:id");
  $update_view->bindValue(":id", $idAnuncio, PDO::PARAM_INT);
  if ($update_view->execute()) {
      setcookie('an-view-'.$idAnuncio, true, strtotime('+1 days'));
  }
}

// Cômodos
$comodosAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_comodos_n_n AS b INNER JOIN anuncios_comodos AS a ON a.id=b.comodo_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Características
$caracteristicasAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_caracteristicas_n_n AS b INNER JOIN anuncios_caracteristicas AS a ON a.id=b.caracteristica_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Condomínio
$condominioAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_condominio_n_n AS b INNER JOIN anuncios_condominio AS a ON a.id=b.condominio_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Mobílias
$mobiliasAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_mobilias_n_n AS b INNER JOIN anuncios_mobilias AS a ON a.id=b.mobilia_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Comodidades
$comodidadesAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_comodidades_n_n AS b INNER JOIN anuncios_comodidades AS a ON a.id=b.comodidade_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Segurança
$segurancaAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_seguranca_n_n AS b INNER JOIN anuncios_seguranca AS a ON a.id=b.seguranca_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Lazer
$lazerAnuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_lazer_n_n AS b INNER JOIN anuncios_lazer AS a ON a.id=b.lazer_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Cômodos (Comercial)
$comodos2Anuncio = $anuncios->SelectSQL("SELECT a.titulo FROM anuncios_comodos2_n_n AS b INNER JOIN anuncios_comodos2 AS a ON a.id=b.comodo2_id WHERE b.anuncio_id=$idAnuncio AND a.status=1 ORDER BY a.ordem_exibicao ASC");

// Anúncios relacionados
$finalidadeRel = $anuncio['finalidade'];
$filtroRelFinalidade = "AND (a.finalidade='$finalidadeRel' OR a.finalidade='venda-aluguel')";
$linkRelacionados = URL."imoveis?finalidade=".$finalidadeRel;
if ($finalidadeRel == "venda-aluguel") {
  $filtroRelFinalidade = "";
  $linkRelacionados = URL."imoveis";
}
$sqlAnunciosRel = "SELECT 
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
  a.id<>$idAnuncio
  $filtroRelFinalidade
  AND a.status=1
  AND p.status=1
ORDER BY rand() DESC LIMIT 20";
$anunciosRel = $anuncios->SelectMultiple($sqlAnunciosRel, false, 0);
$numAnunciosRel = $anuncios->totalRegistros();

foreach ($anunciosRel as $anuncioK => $anuncioV) {
  // Valores
  if ($anuncioV['finalidade'] == "venda") {
    $anunciosRel[$anuncioK]['valor'] = $anuncioV['valor_venda'];
  } else if ($anuncioV['finalidade'] == "aluguel") {
    $anunciosRel[$anuncioK]['valor'] = $anuncioV['valor_aluguel'];
  }
  $anunciosRel[$anuncioK]['valor_add'] = doubleval($anuncioV['valor_condominio']) + doubleval($anuncioV['valor_iptu']);
  // Fotos
  $fotosAnuncio = $anuncios->SelectSQL("SELECT * FROM anuncios_fotos WHERE item_id=".$anuncioV['id']." ORDER BY destaque DESC, ordem ASC, id ASC LIMIT 5");
  $anunciosRel[$anuncioK]['fotos'] = $fotosAnuncio;
}
