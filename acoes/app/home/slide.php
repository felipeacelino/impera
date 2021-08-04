<?php

// SLIDE
$resultSlide = $conexao->prepare("SELECT * FROM slide WHERE status=1 ORDER BY ordem_exibicao ASC");
$resultSlide->execute();
$numSlide = $resultSlide->rowCount();
$slides = $resultSlide->fetchAll(PDO::FETCH_ASSOC);

foreach ($slides as $key => $slide) {

    $link = $slide['url'] != "" ? $slide['url'] : "#";
    $target = $slide['tipo_link'] == "externo" ? "target='_blank'" : "";
    
    $slides[$key]['target'] = $target;
    $slides[$key]['url'] = $link;

}