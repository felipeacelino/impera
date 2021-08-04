<?php
$idAnuncio = Tools::protege($param3);
$idUsuario = (int) $user['id'];

$anuncios = new Crud('anuncios');
$pagamentos = new Crud('anuncios_pagamentos');

$sqlAnuncio = "SELECT 
  a.id,
  a.codigo,
  a.titulo,
  a.finalidade
FROM anuncios AS a
WHERE 
  a.id='$idAnuncio'
  AND a.id_usuario = '$idUsuario'
LIMIT 1";
$anuncio = $anuncios->SelectSingle($sqlAnuncio);

if ($anuncio == "") {
  Tools::redireciona(URL."proprietario/inicio");
}

$sqlPagamentos = "SELECT * FROM anuncios_pagamentos WHERE anuncio_id='$idAnuncio' ORDER BY data DESC";
$pagamentosLista = $pagamentos->SelectMultiple($sqlPagamentos, false, 0);
$numPagamentos = $pagamentos->totalRegistros();
