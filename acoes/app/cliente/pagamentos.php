<?php
$idAnuncio = Tools::protege($param3);
$idUsuario = (int) $user['id'];

$anuncios = new Crud('anuncios');
$pagamentos = new Crud('anuncios_pagamentos');

$sqlPagamentos = "SELECT * FROM anuncios_pagamentos ORDER BY data DESC";
$pagamentosLista = $pagamentos->SelectMultiple($sqlPagamentos, false, 0);
$numPagamentos = $pagamentos->totalRegistros();
