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
include(ACOES_APP_PATH."/proprietario/restrito.php");

$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud('anuncios_fotos');

//Atualiza
if ($_POST['acao'] == "update") {

  $idUsuario = (int) $user['id'];
  $idEdit = (int) $_POST['id_anuncio'];
  $id_destaque = (int) $_POST['id_destaque'];

  $acoes->Update(array('destaque' => 0), "WHERE item_id = $idEdit");

  $dados = array(
    'destaque' => 1
  );	

  $operacao = $acoes->Update($dados, "WHERE id = $id_destaque");

  if ($operacao) {

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
