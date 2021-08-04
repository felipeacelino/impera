<?php

// TEXTO BUSCA
$resultTextoBusca = $conexao->prepare("SELECT * FROM paginas WHERE pagina='busca'");
$resultTextoBusca->execute();
$textoBusc = $resultTextoBusca->fetch(PDO::FETCH_ASSOC);
$tituloBusca = $textoBusc['titulo'];
$textoBusca = $textoBusc['subtitulo'];

// CIDADES COM ANÚNCIOS
$resultCidadesBusca = $conexao->prepare(
  "SELECT DISTINCT
    c.*
  FROM cidades AS c
  INNER JOIN anuncios AS a ON a.cidade_id=c.id 
  WHERE
    c.estado_id=19
    AND a.status=1
  ORDER BY c.titulo ASC"
);
$resultCidadesBusca->execute();
$numCidadesBusca = $resultCidadesBusca->rowCount();
$cidadesBusca = $resultCidadesBusca->fetchAll(PDO::FETCH_ASSOC);

// CIDADES GERAL
/* $resultCidadesBusca = $conexao->prepare(
  "SELECT
    c.*
  FROM cidades AS c
  WHERE 
    c.estado_id=19
  ORDER BY c.titulo ASC"
);
$resultCidadesBusca->execute();
$numCidadesBusca = $resultCidadesBusca->rowCount();
$cidadesBusca = $resultCidadesBusca->fetchAll(PDO::FETCH_ASSOC); */

// FILTROS VALOR (COMPRA)
$filtrosValoresCompra = array(
  'x-250000' => 'Até R$ 250.000',
  'x-500000' => 'Até R$ 500.000',
  'x-1000000' => 'Até R$ 1.000.000',
  'x-1500000' => 'Até R$ 1.500.000',
  '1500000-x' => 'Acima de R$ 1.500.000'
);

// FILTROS VALOR (ALUGUEL)
$filtrosValoresAluguel = array(
  'x-1000' => 'Até R$ 1.000',
  'x-1500' => 'Até R$ 1.500',
  'x-2000' => 'Até R$ 2.000',
  'x-3000' => 'Até R$ 3.000',
  'x-5000' => 'Até R$ 5.000',
  '5000-x' => 'Acima de R$ 5.000'
);

// FILTROS VALOR (CONDOMÍNIO + IPTU)
$filtrosValoresCondominioIPTU = array(
  'x-100' => 'Até R$ 100',
  'x-250' => 'Até R$ 250',
  'x-500' => 'Até R$ 500',
  'x-1000' => 'Até R$ 1.000',
  '1000-x' => 'Acima de R$ 1.000'
);

// FILTROS ÁREA
$filtrosAreas = array(
  'x-30' => 'Até 30m²',
  'x-40' => 'Até 40m²',
  'x-50' => 'Até 50m²',
  'x-100' => 'Até 100m²',
  '100-x' => 'Acima de 100m²'
);

// TIPOS
$tiposBusca = $confs->SelectSQL("SELECT * FROM anuncios_tipos WHERE status = 1 ORDER BY ordem_exibicao ASC");
foreach ($tiposBusca as $tipoK => $tipoV) {
  $tipoID = $tipoV['id'];
  $itensTiposBusca = $confs->SelectSQL("SELECT * FROM anuncios_tipos_itens WHERE status = 1 AND tipo_id=$tipoID ORDER BY ordem_exibicao ASC");
  $tiposBusca[$tipoK]['itens'] = $itensTiposBusca;
}

// CARACTERÍSTICAS
$caracteristicasFiltro = $confs->SelectSQL("SELECT * FROM anuncios_caracteristicas WHERE status=1 ORDER BY ordem_exibicao ASC");

// CÔMODOS
$comodosFiltro = $confs->SelectSQL("SELECT * FROM anuncios_comodos WHERE status=1 ORDER BY ordem_exibicao ASC");

// CONDOMÍNIO
$condominioFiltro = $confs->SelectSQL("SELECT * FROM anuncios_condominio WHERE only_admin=0 AND status=1 ORDER BY ordem_exibicao ASC");

// MOBÍLIAS
$mobiliasFiltro = $confs->SelectSQL("SELECT * FROM anuncios_mobilias WHERE status=1 ORDER BY ordem_exibicao ASC");

// COMODIDADES
$comodidadesFiltro = $confs->SelectSQL("SELECT * FROM anuncios_comodidades WHERE status=1 ORDER BY ordem_exibicao ASC");

// SEGURANÇA
$segurancaFiltro = $confs->SelectSQL("SELECT * FROM anuncios_seguranca WHERE status=1 ORDER BY ordem_exibicao ASC");

// LAZER
$lazerFiltro = $confs->SelectSQL("SELECT * FROM anuncios_lazer WHERE status=1 ORDER BY ordem_exibicao ASC");

// CÔMODOS (COMERCIAL)
$comodos2Filtro = $confs->SelectSQL("SELECT * FROM anuncios_comodos2 WHERE status=1 ORDER BY ordem_exibicao ASC");
