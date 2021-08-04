<?php

// VÍDEOS
$videos = new Crud("videos");

$videos_list = $videos->SelectMultiple("SELECT * FROM videos WHERE status=1 ORDER BY ordem_exibicao ASC", true, 9);
$numVideos = $videos->totalRegistros();

$url_paginacao = URL."videos";