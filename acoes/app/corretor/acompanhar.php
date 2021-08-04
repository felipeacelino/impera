<?php
$idAnuncio = Tools::protege($param3);
$idUsuario = (int) $user['id'];

$anuncios = new Crud('anuncios');

$sqlAnuncio = "SELECT 
  a.id,
  a.codigo,
  a.titulo,
  a.finalidade,
  a.etapa_venda,
  a.etapa_aluguel
FROM anuncios AS a
WHERE 
  a.id='$idAnuncio'
  AND a.id_usuario = '$idUsuario'
LIMIT 1";
$anuncio = $anuncios->SelectSingle($sqlAnuncio);

if ($anuncio == "") {
  Tools::redireciona(URL."corretor/inicio");
}
