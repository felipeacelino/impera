<?php

// TEXTOS
$resultTxtSec = $conexao->prepare("SELECT * FROM paginas WHERE pagina='blocos' LIMIT 1");
$resultTxtSec->execute();
$txtSec = $resultTxtSec->fetch(PDO::FETCH_ASSOC);

// BLOCOS DA HOME
$blocosHome = new Crud("blocos_home");
$listaBlocosHome = $blocosHome->SelectSQL("SELECT * FROM blocos_home WHERE status=1 ORDER BY ordem_exibicao ASC");
$numBlocosHome = count(array_filter($listaBlocosHome));

// Opções
foreach ($listaBlocosHome as $kBloco => $vBloco) {
  // Tipo de link
  $listaBlocosHome[$kBloco]['target'] = $vBloco['tipo_link'] == "externo" ? "target='_blank'" : "";
}
