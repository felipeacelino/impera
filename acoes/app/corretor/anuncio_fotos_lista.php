<?php
$idAnuncio = Tools::protege($param3);
$acaoFotos = Tools::protege($param4);
$idUsuario = (int) $user['id'];

$anuncio = new Crud('anuncios');
$anuncio_fotos = new Crud('anuncios_fotos');

$limiteFotos = 35;

$sqlAnuncio = "SELECT 
* 
FROM anuncios 
WHERE id = '".$idAnuncio."' 
AND id_usuario = '".$idUsuario."'";
$anuncio = $anuncio->SelectSingle($sqlAnuncio);

if ($anuncio == "") {
  Tools::redireciona(URL."corretor/imoveis");
}

//Fotos
$sqlFotos = "SELECT 
* 
FROM anuncios_fotos 
WHERE item_id = '".$idAnuncio."' ORDER BY destaque DESC, ordem ASC, id ASC";
$linhaFotos = $anuncio_fotos->SelectMultiple($sqlFotos, false, 0);
$totalFotos = $anuncio_fotos->totalRegistros();

$fotosRestantes = ($limiteFotos - $totalFotos);

// Insert
if ($acaoFotos == "insert") {
  $tituloFotos = "Cadastrar Fotos";
  $btnConcluirLink = URL."corretor/imoveis/cad-success";
} 

// Update
else if ($acaoFotos == "update") {
  $tituloFotos = "Gerenciar Fotos";
  $btnConcluirLink = URL."corretor/imoveis";
}
