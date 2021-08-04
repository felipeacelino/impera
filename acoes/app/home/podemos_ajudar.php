<?php

// TEXTOS
$resultTxtSec = $conexao->prepare("SELECT * FROM paginas WHERE pagina='podemos-ajudar' LIMIT 1");
$resultTxtSec->execute();
$txtSec = $resultTxtSec->fetch(PDO::FETCH_ASSOC);
