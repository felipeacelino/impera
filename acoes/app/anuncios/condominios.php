<?php

// CONDOMINIOS
$condominios_crud = new Crud("anuncios_condominios");
$sql = "SELECT * FROM anuncios_condominios WHERE status=1 ORDER BY id DESC";
$url_paginacao = URL."condominios";

$condominios = $condominios_crud->SelectMultiple($sql, true, 12);
$numCondominios = $condominios_crud->totalRegistros();
