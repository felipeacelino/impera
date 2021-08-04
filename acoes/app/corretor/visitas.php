<?php
if (isset($_POST['acao']) && $_POST['acao'] != "") {
  include ("../../../paths.php");
  include ("".BASE_PATH."/base.class.php");
  include ("".BASE_PATH."/init.class.php");
  include ("".BASE_PATH."/tools.class.php");
  include ("".CLASS_PATH."/uploads.php");
  Tools::debug(false);
  include ("".BASE_PATH."/crud.class.php");
  include ("".CONF_PATH."/conf.php");
  include ("".ACOES_APP_PATH."/corretor/restrito.php");

  $acao = Tools::protege($_POST['acao']);
} else {
  $acao = "view";
}

$idUsuario = (int) $user['id'];

$anuncios = new Crud('anuncios');
$visitas = new Crud('anuncios_visitas');

// VIEW
if ($acao == "view") {

  $idAnuncio = Tools::protege($param3);

  $sqlAnuncio = "SELECT 
    a.id,
    a.codigo,
    a.titulo,
    a.finalidade,
    a.residente
  FROM anuncios AS a
  WHERE 
    a.id='$idAnuncio'
    AND a.id_usuario = '$idUsuario'
  LIMIT 1";
  $anuncio = $anuncios->SelectSingle($sqlAnuncio);

  if ($anuncio == "") {
    Tools::redireciona(URL."corretor/imoveis");
  }

  // Próximas visitas
  $sqlVisitas = "SELECT *, DATE_FORMAT(data, '%H:%i') AS horario FROM anuncios_visitas WHERE anuncio_id='$idAnuncio' AND data >= NOW() ORDER BY data ASC";
  $visitasLista = $visitas->SelectMultiple($sqlVisitas, false, 0);
  $numVisitas = $visitas->totalRegistros();

  // Visita antigas
  $sqlVisitasAntigas = "SELECT *, DATE_FORMAT(data, '%H:%i') AS horario FROM anuncios_visitas WHERE anuncio_id='$idAnuncio' AND data < NOW() ORDER BY data DESC";
  $visitasAntigasLista = $visitas->SelectMultiple($sqlVisitasAntigas, false, 0);
  $numVisitasAntigas = $visitas->totalRegistros();

}

// REAGENDAR
if ($acao == "reagendar" && $_POST['id_visita'] != "") {
  $idVisita = Tools::protege($_POST['id_visita']);
  $updateVisita = $visitas->Update(array('status' => "3"), "WHERE id=$idVisita");
  if ($updateVisita) {
    $arrResponse = array (
      'status' => 'ok'
    );
  } else {
    $arrResponse = array (
      'status' => 'erro'
    );
  }
  echo json_encode($arrResponse);
}

// CONFIRMAR
if ($acao == "confirmar" && $_POST['id_visita'] != "") {
  $idVisita = Tools::protege($_POST['id_visita']);
  $updateVisita = $visitas->Update(array('status' => "1"), "WHERE id=$idVisita");
  if ($updateVisita) {
    $arrResponse = array (
      'status' => 'ok'
    );
  } else {
    $arrResponse = array (
      'status' => 'erro'
    );
  }
  echo json_encode($arrResponse);
}
