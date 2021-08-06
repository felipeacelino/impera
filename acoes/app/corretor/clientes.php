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
$tabela = "corretores_clientes";
$registros = new Crud($tabela);
$idUser = $user['id'];

// VIEW
if ($acao == "view") {
  $registrosLista = $registros->SelectMultiple("SELECT * FROM $tabela WHERE id_usuario=$idUser ORDER BY id DESC", false, 0);
  $numRegistros = $registros->totalRegistros();
}

// INSERT
if ($acao == "insert") {
  $dados = array(
    "id_usuario" => $idUser,
    "nome" => Tools::protege($_POST['nome']),
    "email" => Tools::protege($_POST['email']),
    "telefone" => Tools::protege($_POST['telefone']),
    "data_cad" => Tools::getDateTime()
  );
  $insertRegistro = $registros->Insert($dados);
  if ($insertRegistro) {
    echo json_encode(array(
      "status" => "success",
      "msg" => "Cliente cadastrado com sucesso!"
    ));
  } else {
    echo json_encode(array(
      "status" => "error",
      "msg" => "Não foi possível realizar esta operação."
    ));
  }
}

// UPDATE
if ($acao == "update") {
  $idRegistro = Tools::somenteNumeros($_POST['registro']);
  $dados = array(
    "nome" => Tools::protege($_POST['nome']),
    "email" => Tools::protege($_POST['email']),
    "telefone" => Tools::protege($_POST['telefone'])
  );
  $updateRegistro = $registros->Update($dados, "WHERE id=$idRegistro AND id_usuario=$idUser");
  if ($updateRegistro) {
    echo json_encode(array(
      "status" => "success",
      "msg" => "Cliente atualizado com sucesso!"
    ));
  } else {
    echo json_encode(array(
      "status" => "error",
      "msg" => "Não foi possível realizar esta operação."
    ));
  }
}

// DELETE
if ($acao == "delete") {
  $idRegistro = Tools::somenteNumeros($_POST['registro']);
  $deleteRegistro = $registros->Delete($idRegistro, "WHERE id=$idRegistro AND id_usuario=$idUser", array(), false, false, "");
  if ($deleteRegistro) {
    echo json_encode(array(
      "status" => "success",
      "msg" => "Cliente removido com sucesso!"
    ));
  } else {
    echo json_encode(array(
      "status" => "error",
      "msg" => "Não foi possível realizar esta operação."
    ));
  }
}
