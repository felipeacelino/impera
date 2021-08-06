<?php
// AÇÃO
if (isset($_POST['acao']) && $_POST['acao'] != "") {
  include_once ("../../../paths.php");
  include_once ("".BASE_PATH."/base.class.php");
  include_once ("".BASE_PATH."/init.class.php");
  include_once ("".BASE_PATH."/tools.class.php");
  Tools::debug(false);
  include_once ("".BASE_PATH."/crud.class.php");
  include_once ("".CONF_PATH."/conf.php");
  include_once ("".ACOES_APP_PATH."/corretor/restrito.php");
  $acao = Tools::protege($_POST['acao']);
} else {
  $acao = "view";
}

// VARIÁVEIS
$tabela = "corretores_leads";
$registros = new Crud($tabela);
$idUser = $user['id'];

// VIEW
if ($acao == "view") {
  /* $registrosLista = $registros->SelectMultiple("SELECT * FROM $tabela WHERE id_usuario=$idUser ORDER BY id DESC", false, 0); */
  $registrosLista = $registros->SelectMultiple("SELECT * FROM $tabela ORDER BY id DESC", false, 0);
  $numRegistros = $registros->totalRegistros();
}

// UPDATE
if ($acao == "update") {
  $idRegistro = Tools::somenteNumeros($_POST['registro']);
  $dados = array(
    "status" => Tools::protege($_POST['status']),
    "motivo_negativa" => Tools::protege($_POST['motivo_negativa']),
    "feedback" => Tools::protege($_POST['feedback']),
    "renda" => Tools::protege($_POST['renda']),
    "fgts" => Tools::protege($_POST['fgts']),
    "possui_dependente" => $_POST['possui_dependente'] ? Tools::protege($_POST['possui_dependente']) : 0
  );
  //$updateRegistro = $registros->Update($dados, "WHERE id=$idRegistro AND id_usuario=$idUser");
  $updateRegistro = $registros->Update($dados, "WHERE id=$idRegistro");
  if ($updateRegistro) {
    echo json_encode(array(
      "status" => "success",
      "msg" => "Contato atualizado com sucesso!"
    ));
  } else {
    echo json_encode(array(
      "status" => "error",
      "msg" => "Não foi possível realizar esta operação."
    ));
  }
}
