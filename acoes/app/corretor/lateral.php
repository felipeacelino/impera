<?php
$idUsuario = (int) $user['id'];
$novasAvaliacoes = new Crud('anuncios_avaliacoes');
$novasMensagens = new Crud('anuncios_mensagens');

$totalNovasAv = $novasAvaliacoes->SelectTotalSQL("SELECT id FROM anuncios_avaliacoes WHERE id_usuario = '$idUsuario'");

$totalNovasMsg = $novasMensagens->SelectTotalSQL("SELECT id FROM anuncios_mensagens WHERE id_usuario = '$idUsuario'");


