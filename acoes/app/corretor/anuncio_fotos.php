<?php
if (!isset($_SESSION)) { session_start(); }
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".CLASS_PATH."/uploads.php");
Tools::debug(false);
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".ACOES_APP_PATH."/corretor/restrito.php");
set_time_limit(1440000);
$db = new Init();
$conexao = $db->conectar();

if (!empty($_POST)) {
  
  $anuncio = new Crud('anuncios');
  $anuncio_fotos = new Crud('anuncios_fotos');
  
  $idAnuncio = Tools::protege($_POST['anuncio_id']);
  $idUsuario = (int) $user['id'];
  
  $sqlAnuncio = "SELECT id, titulo, hash FROM anuncios WHERE id=$idAnuncio AND id_usuario=$idUsuario";
  $resultadoAnuncio = $anuncio->SelectSingle($sqlAnuncio);
  
  $upload = new Uploads('anuncios_fotos');
  $path = IMG_PATH."/anuncios";
  $extensoes_permitidas = array("png","gif","svg","jpg","jpeg","heic","JPG", "JPEG");
  $redimensiona = false;
  $largura = "";
  $altura = "";
  $forma_redimensiona = ''; // '', 'crop', 'auto'
  $grava = true;
  $remove = true;	
  $thumbs = array(
    array(
      "largura" => 1200,
      "altura" => 0,
      "forma" => 'auto'
    ),
    array(
      "largura" => 600,
      "altura" => 440,
      "forma" => 'crop'
    ),
    array(
      "largura" => 600,
      "altura" => 500,
      "forma" => 'crop'
    ),
    array(
      "largura" => 300,
      "altura" => 220,
      "forma" => 'crop'
    ),
    array(
      "largura" => 150,
      "altura" => 150,
      "forma" => 'crop'
    ),
  );
        
  // Fotos
  if (isset($_FILES['fotos'])) {					
    $path = IMG_PATH."/anuncios/".$idAnuncio."/anuncios_fotos";
    $dados_galeria = array(
      'item_id' => $idAnuncio,	
      'destaque' => 0
    );
    $uploadGaleria = $upload->uploadImagensMultiplas($_FILES['fotos'], $path, $dados_galeria, $grava, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);
    $totalDestaques = $anuncio_fotos->SelectTotalSql("SELECT id FROM anuncios_fotos WHERE item_id=$idAnuncio WHERE destaque=1");
    // Destaque
    if ($totalDestaques == 0) {
      $destaque = array(
        'destaque' => 1
      );
      $anuncio_fotos->Update($destaque, "WHERE item_id = $idAnuncio ORDER BY id ASC LIMIT 1");
    }
    if ($uploadGaleria) {
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
}
    
