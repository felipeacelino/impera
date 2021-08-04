<?php

$registros = 30;
$anuncios = new Crud("anuncios");

// Título
$cidadeNome = "";
$bairroNome = "";
$titulo = "Imóveis à venda e para alugar";
$tituloLocal = "";
$subtitulo = " imóveis encontrados";
$subtituloLocal = "";
$ordemValorAsc = "ORDER BY a.valor_aluguel ASC, a.valor_venda ASC";
$ordemValorDesc = "ORDER BY a.valor_aluguel DESC, a.valor_venda DESC";

// Finalidade
$filtroFinalidade = "";
if (isset($_GET['finalidade']) && $_GET['finalidade'] != "" && $_GET['finalidade'] != "venda-aluguel") {
  $filtroFinalidade = Tools::protege($_GET['finalidade']);
  $filtroFinalidade = "AND (a.finalidade='".$filtroFinalidade."' OR a.finalidade='venda-aluguel')";
  if ($_GET['finalidade'] == "venda") {
    $titulo = "Imóveis à venda";
    $campoValorOrdem = "a.valor_venda";
    $ordemValorAsc = "ORDER BY a.valor_venda ASC";
    $ordemValorDesc = "ORDER BY a.valor_venda DESC";
  } else if ($_GET['finalidade'] == "aluguel") {
    $titulo = "Imóveis para alugar";
    $ordemValorAsc = "ORDER BY a.valor_aluguel ASC";
    $ordemValorDesc = "ORDER BY a.valor_aluguel DESC";
  }
}

// Cidade
$filtroCidade = "";
if (isset($_GET['cidade']) && $_GET['cidade'] != "") {
  $cidadeID = Tools::somenteNumeros($_GET['cidade']);
  $filtroCidade = "AND a.cidade_id='".$cidadeID."'";
  $cidadeInfo = $anuncios->SelectSingle("SELECT titulo FROM cidades WHERE id=$cidadeID LIMIT 1");
  if ($cidadeInfo != "") {
    $cidadeNome = $cidadeInfo['titulo'];
    $tituloLocal = " em <b>$cidadeNome</b>";
    $subtituloLocal = " na região";
  }
}

// Bairro
$filtroBairro = "";
if (isset($_GET['bairro']) && $_GET['bairro'] != "") {
  $bairroID = Tools::somenteNumeros($_GET['bairro']);
  $filtroBairro = "AND a.bairro_id='".$bairroID."'";
  $bairroInfo = $anuncios->SelectSingle("SELECT titulo FROM bairros WHERE id=$bairroID LIMIT 1");
  if ($bairroInfo != "") {
    $bairroNome = $bairroInfo['titulo'];
    $tituloLocal = " em <b>$cidadeNome</b>";
    if ($cidadeNome != "") {
      $tituloLocal = " em <b>$bairroNome, $cidadeNome</b>";
    } else {
      $tituloLocal = " em <b>$bairroNome</b>";
    }
    $subtituloLocal = " na região";
  }
}

// Região
$filtroRegiao = "";
if (isset($_GET['regiao']) && $_GET['regiao'] != "") {
  $regiaoID = Tools::somenteNumeros($_GET['regiao']);
  $filtroRegiao = "AND a.regiao_id='".$regiaoID."'";
  $regiaoInfo = $anuncios->SelectSingle("SELECT titulo FROM anuncios_regioes WHERE id=$regiaoID LIMIT 1");
  if ($regiaoInfo != "") {
    $tituloLocal = " em <b>".$regiaoInfo['titulo']."</b>";
    $subtituloLocal = " na região";
  }
}

// Tipo
$filtroTipo = "";
if (isset($_GET['tipo']) && $_GET['tipo'] != "") {
  $filtroTipo = Tools::somenteNumeros($_GET['tipo']);
  $filtroTipo = "AND a.tipo_id='".$filtroTipo."'";
}

// Valor venda
$filtroValorVenda = "";
if (isset($_GET['valor_venda']) && $_GET['valor_venda'] != "") {
  $valoresArr = explode("-", Tools::protege($_GET['valor_venda']));
  $valorDe = $valoresArr[0] != "x" ? $valoresArr[0] : 0;
  $valorAte = $valoresArr[1] != "x" ? $valoresArr[1] : 1000000000;
  $filtroValorVenda = "AND a.valor_venda BETWEEN '$valorDe' AND '$valorAte'";
}

// Valor aluguel
$filtroValorAluguel = "";
if (isset($_GET['valor_aluguel']) && $_GET['valor_aluguel'] != "") {
  $valoresArr = explode("-", Tools::protege($_GET['valor_aluguel']));
  $valorDe = $valoresArr[0] != "x" ? $valoresArr[0] : 0;
  $valorAte = $valoresArr[1] != "x" ? $valoresArr[1] : 1000000000;
  $filtroValorAluguel = "AND a.valor_aluguel BETWEEN '$valorDe' AND '$valorAte'";
}

// Valor condimínio + IPTU
$filtroValorCondIptu = "";
if (isset($_GET['valor_condominio_iptu']) && $_GET['valor_condominio_iptu'] != "") {
  $valoresArr = explode("-", Tools::protege($_GET['valor_condominio_iptu']));
  $valorDe = $valoresArr[0] != "x" ? $valoresArr[0] : 0;
  $valorAte = $valoresArr[1] != "x" ? $valoresArr[1] : 1000000000;
  $filtroValorCondIptu = "AND (a.valor_condominio + a.valor_iptu) BETWEEN '$valorDe' AND '$valorAte'";
}

// Área
$filtroArea = "";
if (isset($_GET['area']) && $_GET['area'] != "") {
  $valoresArr = explode("-", Tools::protege($_GET['area']));
  $valorDe = $valoresArr[0] != "x" ? $valoresArr[0] : 0;
  $valorAte = $valoresArr[1] != "x" ? $valoresArr[1] : 1000000000;
  $filtroArea = "AND a.area BETWEEN '$valorDe' AND '$valorAte'";
}

// Quartos
$filtroQuartos = "";
if (isset($_GET['quartos']) && $_GET['quartos'] != "") {
  $numQuartos = Tools::somenteNumeros($_GET['quartos']);
  $filtroQuartos = "AND a.quartos >= '$numQuartos'";
}

// Banheiros
$filtroBanheiros = "";
if (isset($_GET['banheiros']) && $_GET['banheiros'] != "") {
  $numBanheiros = Tools::somenteNumeros($_GET['banheiros']);
  $filtroBanheiros = "AND a.banheiros >= '$numBanheiros'";
}

// Vagas
$filtroVagas = "";
if (isset($_GET['vagas']) && $_GET['vagas'] != "") {
  $numVagas = Tools::somenteNumeros($_GET['vagas']);
  $filtroVagas = "AND a.vagas >= '$numVagas'";
}

// Próximo ao metrô
$filtroProxMetro = "";
if (isset($_GET['proximo_metro']) && $_GET['proximo_metro'] == "1") {
  $filtroProxMetro = "AND a.proximo_metro=1";
}

// Próximo ao BRT
$filtroProxBRT = "";
if (isset($_GET['proximo_brt']) && $_GET['proximo_brt'] == "1") {
  $filtroProxBRT = "AND a.proximo_brt=1";
}

// Próximo ao trem
$filtroProxTrem = "";
if (isset($_GET['proximo_trem']) && $_GET['proximo_trem'] == "1") {
  $filtroProxTrem = "AND a.proximo_trem=1";
}

// Próximo ao trem
$filtroMobiliado = "";
if (isset($_GET['mobiliado']) && $_GET['mobiliado'] == "1") {
  $filtroMobiliado = "AND a.mobiliado=1";
}

// Aceita Pet
$filtroAceitaPet = "";
if (isset($_GET['aceita_pet']) && $_GET['aceita_pet'] == "1") {
  $filtroAceitaPet = "AND a.aceita_pet=1";
}

// Sol
$filtroSol = "";
if (isset($_GET['sol']) && $_GET['sol'] != "") {
  $filtroSol = Tools::protege($_GET['sol']);
  $filtroSol = "AND a.sol='".$filtroSol."'";
}

// Orientação
$filtroOrientacao = "";
if (isset($_GET['orientacao']) && $_GET['orientacao'] != "") {
  $filtroOrientacao = Tools::protege($_GET['orientacao']);
  $filtroOrientacao = "AND a.orientacao='".$filtroOrientacao."'";
}

// Cômodos
if (isset($_GET['comodos']) && $_GET['comodos'] != "") {
  $varComodos = sprintf("'%s'", implode("','", $_GET['comodos']));
  $comodosJoin = "INNER JOIN anuncios_comodos_n_n AS ac ON ac.anuncio_id=a.id";
  $filtroComodos = "AND ac.comodo_id IN(".$varComodos.")";  
  $totalComodos = count($_GET['comodos']);
  $havingComodos = "AND count(distinct ac.comodo_id)=$totalComodos";
}

// Características
if (isset($_GET['caracteristicas']) && $_GET['caracteristicas'] != "") {
  $varCarac = sprintf("'%s'", implode("','", $_GET['caracteristicas']));
  $caracJoin = "INNER JOIN anuncios_caracteristicas_n_n AS acr ON acr.anuncio_id=a.id";
  $filtroCarac = "AND acr.caracteristica_id IN(".$varCarac.")";  
  $totalCarac = count($_GET['caracteristicas']);
  $havingCarac = "AND count(distinct acr.caracteristica_id)=$totalCarac";
}

// Condomínio
if (isset($_GET['condominio']) && $_GET['condominio'] != "") {
  $varCondominio = sprintf("'%s'", implode("','", $_GET['condominio']));
  $condominioJoin = "INNER JOIN anuncios_condominio_n_n AS acd ON acd.anuncio_id=a.id";
  $filtroCondominio = "AND acd.condominio_id IN(".$varCondominio.")";  
  $totalCondominio = count($_GET['condominio']);
  $havingCondominio = "AND count(distinct acd.condominio_id)=$totalCondominio";
}

// Mobílias
if (isset($_GET['mobilias']) && $_GET['mobilias'] != "") {
  $varMobilias = sprintf("'%s'", implode("','", $_GET['mobilias']));
  $mobiliasJoin = "INNER JOIN anuncios_mobilias_n_n AS am ON am.anuncio_id=a.id";
  $filtroMobilias = "AND am.mobilia_id IN(".$varMobilias.")";  
  $totalMobilias = count($_GET['mobilias']);
  $havingMobilias = "AND count(distinct am.mobilia_id)=$totalMobilias";
}

// Comodidades
if (isset($_GET['comodidades']) && $_GET['comodidades'] != "") {
  $varComodidades = sprintf("'%s'", implode("','", $_GET['comodidades']));
  $comodidadesJoin = "INNER JOIN anuncios_comodidades_n_n AS acm ON acm.anuncio_id=a.id";
  $filtroComodidades = "AND acm.comodidade_id IN(".$varComodidades.")";  
  $totalComodidades = count($_GET['comodidades']);
  $havingComodidades = "AND count(distinct acm.comodidade_id)=$totalComodidades";
}

// Segurança
if (isset($_GET['seguranca']) && $_GET['seguranca'] != "") {
  $varSeguranca = sprintf("'%s'", implode("','", $_GET['seguranca']));
  $segurancaJoin = "INNER JOIN anuncios_seguranca_n_n AS acs ON acs.anuncio_id=a.id";
  $filtroSeguranca = "AND acs.seguranca_id IN(".$varSeguranca.")";  
  $totalSeguranca = count($_GET['seguranca']);
  $havingSeguranca = "AND count(distinct acs.seguranca_id)=$totalSeguranca";
}

// Lazer
if (isset($_GET['lazer']) && $_GET['lazer'] != "") {
  $varLazer = sprintf("'%s'", implode("','", $_GET['lazer']));
  $lazerJoin = "INNER JOIN anuncios_lazer_n_n AS acl ON acl.anuncio_id=a.id";
  $filtroLazer = "AND acl.lazer_id IN(".$varLazer.")";  
  $totalLazer = count($_GET['lazer']);
  $havingLazer = "AND count(distinct acl.lazer_id)=$totalLazer";
}

// Cômodos (Comercial)
if (isset($_GET['comodos2']) && $_GET['comodos2'] != "") {
  $varComodos2 = sprintf("'%s'", implode("','", $_GET['comodos2']));
  $comodos2Join = "INNER JOIN anuncios_comodos2_n_n AS ac2 ON ac2.anuncio_id=a.id";
  $filtroComodos2 = "AND ac2.comodo2_id IN(".$varComodos2.")";  
  $totalComodos2 = count($_GET['comodos2']);
  $havingComodos2 = "AND count(distinct ac2.comodo2_id)=$totalComodos2";
}

// Anúncio randômicos
if (isset($_GET['p']) && $_GET['p'] != "" && $_GET['p'] != "1") {
  if (!isset($_SESSION['rand_seed']) || !$_SESSION['rand_seed']) {
    $randSeed = rand(1,100);
    $_SESSION['rand_seed'] = $randSeed;
  }
} else {
  $randSeed = rand(1,100);
  $_SESSION['rand_seed'] = $randSeed;
}
$randSeed = $_SESSION['rand_seed'];

$order = "ORDER BY RAND($randSeed)";

// Ordem
switch ($_GET['ordena']) {
  case 'relevancia':
    $order = "ORDER BY a.views DESC, a.id ASC";
    break;

  case 'menor-preco':
    $order = $ordemValorAsc;
    break;

  case 'maior-preco':
    $order = $ordemValorDesc;
    break;
}

// Resultados
$sqlAnuncios = "SELECT 
  a.id, 
  a.id_usuario, 
  a.titulo, 
  a.finalidade,
  a.tipo, 
  a.logradouro,
  a.bairro, 
  a.cidade, 
  a.lat, 
  a.lng, 
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
  $comodosJoin
  $caracJoin
  $condominioJoin
  $mobiliasJoin
  $comodidadesJoin
  $segurancaJoin
  $lazerJoin
  $comodos2Join
WHERE
  a.status=1
  AND p.status=1
  AND (SELECT count(f.id) FROM anuncios_fotos AS f WHERE f.item_id=a.id) > 4
  $filtroFinalidade
  $filtroCidade
  $filtroBairro
  $filtroTipo
  $filtroRegiao
  $filtroValorVenda
  $filtroValorAluguel
  $filtroValorCondIptu
  $filtroArea
  $filtroQuartos
  $filtroBanheiros
  $filtroVagas
  $filtroProxMetro
  $filtroProxBRT
  $filtroProxTrem
  $filtroMobiliado
  $filtroAceitaPet
  $filtroSol
  $filtroOrientacao
  $filtroComodos
  $filtroCarac
  $filtroCondominio
  $filtroMobilias
  $filtroComodidades
  $filtroSeguranca
  $filtroLazer
  $filtroComodos2
GROUP BY a.id
HAVING 
  a.id > 0
  $havingComodos
  $havingCarac
  $havingCondominio
  $havingMobilias
  $havingComodidades
  $havingSeguranca
  $havingLazer
  $havingComodos2
$order";
$resultado = $anuncios->SelectMultiple($sqlAnuncios, true, $registros);
$numAnuncios = $anuncios->totalRegistros();
$url_paginacao = URL."imoveis";
$url_paginacao = $url_paginacao.Tools::montaUrlFiltro($_GET);

if ($numAnuncios == 1) {
  $subtitulo = " imóvel encontrado";
}

foreach ($resultado as $anuncioK => $anuncioV) {

  // Valores
  if ($anuncioV['finalidade'] == "venda") {
    $resultado[$anuncioK]['valor'] = $anuncioV['valor_venda'];
  } else if ($anuncioV['finalidade'] == "aluguel") {
    $resultado[$anuncioK]['valor'] = $anuncioV['valor_aluguel'];
  }
  $resultado[$anuncioK]['valor_add'] = doubleval($anuncioV['valor_condominio']) + doubleval($anuncioV['valor_iptu']);

  // Fotos
  $fotosAnuncio = $anuncios->SelectSQL("SELECT * FROM anuncios_fotos WHERE item_id=".$anuncioV['id']." ORDER BY destaque DESC, ordem ASC, id ASC LIMIT 5");
  $resultado[$anuncioK]['fotos'] = $fotosAnuncio;
}
