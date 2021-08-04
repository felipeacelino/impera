<?php

Tools::debug(false);

// CONDOMINIOS
$destino_busca = $_GET['destino'];
$filtro_destino_busca = $destino_busca != "" ? 'AND cidade = "' . $destino_busca . '" ' : '';

$condominios = $confs->SelectSQL("SELECT * FROM anuncios_condominios WHERE status = 1 $filtro_destino_busca ORDER BY condominio ASC");

// FAIXA DE PREÇO
$faixa_de_preco = array(
  'x-1000' => 'Até de R$ 1.000,00',
  '1000-2000' => 'De R$ 1.000,00 a R$ 2.000,00',
  '2000-3000' => 'De R$ 2.000,00 a R$ 3.000,00',
  '3000-5000' => 'De R$ 3.000,00 a R$ 5.000,00',
  '5000-10000' => 'De R$ 5.000,00 a R$ 10.000,00',
  '10000-x' => 'A partir de R$ 10.000,00'
);

// TIPO DE IMOVEL
$tipo_de_imovel = array(
  'casa' => 'Casa',
  'apartamento' => 'Apartamento'
);

// QUARTOS
$qtd_quartos = $confs->SelectSQL("SELECT DISTINCT quartos FROM anuncios WHERE status = 1 GROUP BY quartos ORDER BY quartos ASC");
$quartos = array();
$i = 0;
foreach ($qtd_quartos as $quarto) {
  $quartos[$i]['chave'] = $quarto['quartos'];
  $quartos[$i]['valor'] = $quarto['quartos'] > 1 ? $quarto['quartos'] . ' Quartos' : $quarto['quartos'] . ' Quarto';
  $i++;
}

// SUITES
$qtd_suites = $confs->SelectSQL("SELECT DISTINCT suites FROM anuncios WHERE status = 1 GROUP BY suites ORDER BY suites ASC");
$suites = array();
$i = 0;
foreach ($qtd_suites as $suite) {
  $suites[$i]['chave'] = $suite['suites'];
  $suites[$i]['valor'] = $suite['suites'] > 1 ? $suite['suites'] . ' Suítes' : $suite['suites'] . ' Suíte';
  $i++;
}

// BANHEIROS
$qtd_banheiros = $confs->SelectSQL("SELECT DISTINCT banheiros FROM anuncios WHERE status = 1 GROUP BY banheiros ORDER BY banheiros ASC");
$banheiros = array();
$i = 0;
foreach ($qtd_banheiros as $banheiro) {
  $banheiros[$i]['chave'] = $banheiro['banheiros'];
  $banheiros[$i]['valor'] = $banheiro['banheiros'] > 1 ? $banheiro['banheiros'] . ' Banheiros' : $banheiro['banheiros'] . ' Banheiro';
  $i++;
}

// HOSPEDES
$qtd_hospedes = $confs->SelectSQL("SELECT DISTINCT hospedes FROM anuncios WHERE status = 1 GROUP BY hospedes ORDER BY hospedes ASC");
$hospedes = array();
$i = 0;
foreach ($qtd_hospedes as $hospede) {
  $hospedes[$i]['chave'] = $hospede['hospedes'];
  $hospedes[$i]['valor'] = $hospede['hospedes'] > 1 ? $hospede['hospedes'] . ' Hóspedes' : $hospede['hospedes'] . ' Hóspede';
  $i++;
}

// VAGAS
$qtd_vagas = $confs->SelectSQL("SELECT DISTINCT vagas FROM anuncios WHERE status = 1 GROUP BY vagas ORDER BY vagas ASC");
$vagas = array();
$i = 0;
foreach ($qtd_vagas as $vaga) {
  $vagas[$i]['chave'] = $vaga['vagas'];
  $vagas[$i]['valor'] = $vaga['vagas'] > 1 ? $vaga['vagas'] . ' Vagas' : $vaga['vagas'] . ' Vaga';
  $i++;
}

// Características
$caracteristicas = $confs->SelectSQL("SELECT * FROM anuncios_caracteristicas WHERE status = 1 ORDER BY ordem_exibicao ASC");

// Destinos (cidades)
$destinos = $confs->SelectSQL("SELECT * FROM anuncios_destinos WHERE status = 1 GROUP BY cidade ORDER BY id DESC");
foreach($destinos as $key => $destino){
  $cidade_destino = $destino['cidade'];
  // Destinos (praias, etc)
  $destinos_opc = $confs->SelectSQL("SELECT * FROM anuncios_destinos WHERE cidade = '$cidade_destino' AND status = 1 ORDER BY id DESC");
  $numDestinosOpc = count(array_filter($destinos_opc));
  $destinos[$key]['destinos_opc'] = $destinos_opc;
  $destinos[$key]['destinos_opc_qtd'] = $numDestinosOpc;
}

