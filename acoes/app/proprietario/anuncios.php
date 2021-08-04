<?php
$acoes = new Crud('anuncios');
$idUsuario = (int) $user['id'];
$order = "ORDER BY a.id DESC";
$url_paginacao = "".URL."proprietario/inicio";

$sql = "SELECT 
a.id,
a.codigo,
a.titulo,
a.estado,
a.cidade,
a.bairro,
a.slug,
a.status,
a.views,
(SELECT foto FROM anuncios_fotos WHERE item_id=a.id ORDER BY destaque DESC, ordem ASC, id ASC LIMIT 1) AS foto,
(SELECT count(f.id) FROM anuncios_fotos AS f WHERE f.item_id=a.id) AS total_fotos
FROM 
anuncios a
WHERE 
a.id_usuario = '".$idUsuario."' AND
tipo_user='proprietario'
$order";
$resultado = $acoes->SelectMultiple($sql, true, 10);
$total_registros = $acoes->totalRegistros();

foreach ($resultado as $key => $pag) {

  $idAn = (int) $pag['id'];

  // Foto
  $resultado[$key]['foto_view'] = $pag['foto'] != "" ? URL."uploads/img/anuncios/".$idAn."/anuncios_fotos/thumb-150-150/".$pag['foto'] : URL."static/img/admin/sem-foto.jpg";
  
}
