<?php
session_start();
include ("../../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
Tools::debug(false);
include ("".CONF_PATH."/conf.php");
include ("".ACOES_ADMIN_PATH."/geral/restritos.php");
include ("".ACOES_ADMIN_PATH."/geral/user.php");

// Arquivos (Parâmetro)
$arquivo = $_FILES['upload'];
// Extensões permitidas 
$extPermitidas = array("jpg","jpeg","png","gif","svg","webp");
// Limite de tamanho (MB)
$maxSize = 10;
// Caminho das imagens enviados
$pathUpload = PATH_ATUAL."/admin/editor/ckeditor/uploads/images/";            
// URL da imagem
$pathUrl = URL."admin/editor/ckeditor/uploads/images/";

// Verifica se o usuário está logado
if (isset($_SESSION['ip_Admin']) && $_SESSION['ip_Admin'] != "") {

  // Verifica a imagem
  function validateImage($imagem, $maxSize, $extPermitidas) {
    $nome_imagem = $imagem['name'];
    $size_imagem = $imagem['size'];
    $error_imagem = $imagem['error'];
    $erro = "";
    if ($nome_imagem != "") {
      // Verifica se há erros no arquivo
      if ($error_imagem) {
        $erro = "Não foi possível enviar a imagem.";
        return false;
      } else {
        // Verifica o tamanho da imagem
        if (getSizeMB($size_imagem) > $maxSize) {
          $erro = "A imagem enviada não deve ser maior que ".$maxSize." MB.";
          return false;
        } else {
          // Verifica se a extensão da imagem 
          if (!in_array(getExtension($nome_imagem), $extPermitidas)) {
            $erro = "O formato da imagem é inválido.";
            return false;
          }
        }
      }
    }		
    return true;
  }

  // Converte o tamanho do arquivo para MB
  function getSizeMB($filesize) {
    return ($filesize * .0009765625) * .0009765625;
  }

  // Retorna a extensão do arquivo
  function getExtension($fileName) {
    $extensao = explode('.',$fileName);
    $extensao = strtolower(end($extensao));
    return $extensao;
  }

  // Realiza o upload
  function uploadImage($imagem, $path) {
    set_time_limit(0);
    $nome_imagem = $imagem['name'];
    $tipo_imagem = $imagem['type'];
    $tmp_name_imagem = $imagem['tmp_name'];
    $size_imagem = $imagem['size'];
    // Renomeia a imagem
    $nome_imagem = md5($nome_imagem.date('H:i:s')).".".getExtension($nome_imagem);
    // Cria o diretório caso ainda não exista
    if (!file_exists($path)){ 
      mkdir ($path, 0755, true);
    }
    // Caminho completo da imagem
    $pic = $path."/".$nome_imagem;
    // Realiza o upload da imagem
    if (move_uploaded_file($tmp_name_imagem, $pic)) {
      return $nome_imagem;
    } else {
      $erro = "Não foi possível realizar o upload da imagem.";
      return false;
    }
    return false;	
  }

  // Verifica se alguma imagem foi enviada
  if ($arquivo['name']) {
    // Valida a imagem
    if (validateImage($arquivo, $maxSize, $extPermitidas)) {
      $grava = uploadImage($arquivo, $pathUpload);
      if ($grava) {
        $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
        $url = $pathUrl.$grava;
        $msg = "";
        echo "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
      } else {
        Tools::alert("Não foi possível enviar a imagem.");
      }
    } else {
      Tools::alert("Arquivo de imagem inválida.");
    }
  } else {
    Tools::alert("Nenhuma imagem enviada.");
  }
}

die();

?>
