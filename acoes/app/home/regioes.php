<?php

// TEXTOS
$resultTxtSec = $conexao->prepare("SELECT * FROM paginas WHERE pagina='regioes-home' LIMIT 1");
$resultTxtSec->execute();
$txtSec = $resultTxtSec->fetch(PDO::FETCH_ASSOC);

// REGIÕES
$regioesHome = new Crud("anuncios_regioes");
$listaRegioes = $regioesHome->SelectSQL("SELECT * FROM anuncios_regioes WHERE status=1 ORDER BY ordem_exibicao ASC");
$numRegioes = count(array_filter($listaRegioes));
