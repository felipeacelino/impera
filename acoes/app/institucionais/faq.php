<?php

// PERGUNTAS FREQUENTES
$resultFaq = $conexao->prepare("SELECT * FROM faq WHERE status=1 ORDER BY ordem_exibicao ASC");
$resultFaq->execute();
$numFaq = $resultFaq->rowCount();
$faqLista = $resultFaq->fetchAll(PDO::FETCH_ASSOC);
