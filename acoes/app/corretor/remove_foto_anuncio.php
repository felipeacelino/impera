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
include(ACOES_APP_PATH."/corretor/restrito.php");

$db = new Init();
$conexao = $db->conectar();

if ($_POST['acao'] == "remover") {

  $anuncio_fotos = new Crud('anuncios_fotos');
  $upload = new Uploads('anuncios_fotos');
  $idDel = (int) $_POST['id_remove'];

  //Resgata a foto
  $foto = $anuncio_fotos->SelectSingle("SELECT * FROM anuncios_fotos WHERE id = $idDel");

  $path = Tools::protege($_POST['path']);
  
	$operacao = $anuncio_fotos->Delete($idDel, "WHERE id=$idDel", array(), false, false, "");

    if ($operacao) {

      if ($foto['destaque'] == "1") {
        $anuncio_fotos->Update(array("destaque" => 1),"WHERE item_id = ".$foto['item_id']." ORDER BY id ASC LIMIT 1");
      }

      $upload->removeFiles($path."/".$foto['foto']);

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

      foreach ($thumbs as $thumb) {			
        $largura = (int)$thumb['largura'];
        $altura = (int)$thumb['altura'];
        $thumb = $path."/thumb-".$largura."-".$altura."/".$foto['foto'];
        $upload->removeFiles($thumb);
    }
  
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


