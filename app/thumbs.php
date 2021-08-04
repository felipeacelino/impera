<?php
require_once '../lib/Canvas.class.php';

function protege($string){
  $str = strip_tags($string);
  $str = addslashes($str);
  return $str;
}

if (isset($_GET['img'])) {

  $pic = protege($_GET['img']);
  $w = protege($_GET['w']);
  $h = protege($_GET['h']);
  
  $t = new Canvas;
  $t->carrega($pic);
  $t->redimensiona($w, $h, 'crop');
  $t->grava();

}
