<?php
include ("../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");

if (isset($_GET['cidade']) && $_GET['cidade'] != "") {

  $cidadeID = Tools::protege($_GET['cidade']);

  // BAIRROS COM ANÚNCIOS
  $resultBairros = $conexao->prepare(
    "SELECT DISTINCT
      b.*
    FROM bairros AS b
    INNER JOIN anuncios AS a ON a.bairro_id=b.id 
    WHERE 
      b.cidade_id=:cidade_id AND
      b.status<>0 AND
      a.status=1
    ORDER BY b.titulo ASC"
  );

  // BAIRROS GERAL
  /* $resultBairros = $conexao->prepare(
    "SELECT 
      b.* 
    FROM bairros AS b
    WHERE 
      b.cidade_id=:cidade_id AND
      b.status<>0
    ORDER BY b.titulo ASC"
  ); */

  $resultBairros->bindValue(':cidade_id', $cidadeID, PDO::PARAM_INT);
  $resultBairros->execute();
  $numBairros = $resultBairros->rowCount();
  $bairros = $resultBairros->fetchAll(PDO::FETCH_ASSOC);

  if ($numBairros > 0) {
    echo json_encode($bairros);
  } else {
    echo json_encode(array());
  }
}
