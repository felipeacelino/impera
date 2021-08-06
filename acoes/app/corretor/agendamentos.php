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

  // Próximas visitas
  $sqlVisitas = "SELECT v.*, DATE_FORMAT(v.data, '%H:%i') AS horario, a.codigo, a.slug FROM anuncios_visitas AS v INNER JOIN anuncios AS a ON a.id=v.anuncio_id WHERE v.id_corretor='$idUsuario' AND origem='user' AND v.data >= NOW() ORDER BY v.data ASC";
  $visitasLista = $visitas->SelectMultiple($sqlVisitas, false, 0);
  $numVisitas = $visitas->totalRegistros();

  // Visita antigas
  $sqlVisitasAntigas = "SELECT v.*, DATE_FORMAT(v.data, '%H:%i') AS horario, a.codigo, a.slug FROM anuncios_visitas AS v INNER JOIN anuncios AS a ON a.id=v.anuncio_id WHERE v.id_corretor='$idUsuario' AND origem='user' AND v.data < NOW() ORDER BY v.data DESC";
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
