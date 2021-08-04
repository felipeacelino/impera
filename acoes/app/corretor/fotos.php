<?php
$acoes = new Crud('anuncios_fotos');
$acoesAnuncio = new Crud('anuncios');
$idUsuario = (int) $user['id'];
$idAnuncio = Tools::protege($pag_include3);
$filtro = "";
$order = "";

$sqlAnuncio = "SELECT id, titulo, hash FROM anuncios WHERE hash = '$idAnuncio' AND id_usuario = '$idUsuario'";
$resultadoAnuncio = $acoesAnuncio->SelectSingle($sqlAnuncio);


