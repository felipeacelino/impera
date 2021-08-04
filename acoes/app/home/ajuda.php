<?php

// TEXTOS
$resultTxtSec = $conexao->prepare("SELECT * FROM paginas WHERE pagina='contato-home' LIMIT 1");
$resultTxtSec->execute();
$txtSec = $resultTxtSec->fetch(PDO::FETCH_ASSOC);
