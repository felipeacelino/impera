<?php
if (!isset($_SESSION)) { session_start(); } 

$acao = isset($_POST['acao']) && $_POST['acao'] != "" ? $_POST['acao'] : "view";

if ($_POST['acao'] != 'view') {
  include_once("../../../paths.php");
  include_once("" . BASE_PATH . "/base.class.php");
  include_once("" . BASE_PATH . "/init.class.php");
  include_once("" . BASE_PATH . "/tools.class.php");
  Tools::debug(false);
  include_once("" . BASE_PATH . "/crud.class.php");
  include_once("" . CONF_PATH . "/conf.php");
  include_once("" . CLASS_PATH . "/email/email.class.php");
  include_once("" . CLASS_PATH . "/uploads.php");
  include_once("" . ACOES_APP_PATH . "/cliente/restrito.php");
}

$tabela = "clientes_arquivos";
$arquivos = new Crud($tabela);

$idUser = (int) $user['id'];

$path = ARQ_PATH . "/" . $tabela;
$extensoes_permitidas = array("png", "gif", "svg", "jpg", "jpeg", "doc", "docx", "xlx", "xls", "pdf", "zip", "rar", "txt", "csv", "xlsx");
$grava = true;
$remove = false;

$upload = new Uploads($tabela);
// VERIFICA A AÇÃO/PÁGINA
if (!isset($_POST['acao'])) {
  
  switch ($param3) {
    case 'update':
      $acao = "update";
      $titulo = "Editar documento";
      $botao = "Atualizar";
      break;
    case 'insert':
      $acao = "insert";
      $titulo = "Enviar documento";
      $botao = "Cadastrar";
      break;
    default:
      $acao = "view";
      $titulo = "Documentos";
      break;
  }
} else {
  $acao = $_POST['acao'];
}

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {

  $filtro = "WHERE id > 0 AND id_usuario = $idUser";

  // TOTAL DE DOCUMENTO (RECEBIDOS)
  $totalArquivosRecebidos = $arquivos->SelectTotalSQL("SELECT id FROM $tabela $filtro AND status = 1 AND origem = 'enviados_admin'");

  // LISTA DE Arquivos (RECEBIDOS)
  $arquivosRecebidoslist = $arquivos->SelectMultiple("SELECT * FROM $tabela $filtro AND status = 1 AND origem = 'enviados_admin' ORDER BY id DESC", true, 30);

  // TOTAL DE DOCUMENTO (ENVIADOS)
  $totalArquivosEnviados = $arquivos->SelectTotalSQL("SELECT id FROM $tabela $filtro AND status = 1 AND origem = 'recebidos_admin'");

  // LISTA DE Arquivos (ENVIADOS)
  $arquivosEnviadoslist = $arquivos->SelectMultiple("SELECT * FROM $tabela $filtro AND status = 1 AND origem = 'recebidos_admin' ORDER BY id DESC", true, 30);
}

//==================================================//
//                    CADASTRAR                     //
//==================================================//
if ($acao == "insert") {

  // REALIZA O CADASTRO
  if (!empty($_POST)) {

    // DADOS
    $dados = array(
      'id_usuario' => $idUser,
      'origem' => 'recebidos_admin',
      'imovel_cod' => $_POST['imovel_cod'],
      'tipo' => $_POST['tipo'],
      'titulo' => $_POST['titulo'],
      'date_time' => Tools::getDate(),
      'status' => $_POST['status'] != "" ? $_POST['status'] : 1,
      'url_amigavel' => Tools::geraSlug($_POST['titulo'])
    );

    if ($arquivos->Insert($dados)) {

      $ultimo_id = $arquivos->getId();

      $path = $path . "/" . $ultimo_id;
      $upload->uploadArquivos($_FILES['arquivos'], $path, $ultimo_id, $grava, $remove);

      $dados_email = array(
        'titulo' => 'Documento Recebido',
        'texto' => 'O cliente <b>' . $user['nome'] . '</b> acaba de enviar um documento, entre na área administrativa para ver mais detalhes.',
        'botao' => array(
          'texto' => 'Acessar Administração',
          'url' => URL . 'admin'
        )
      );
      $assunto = "Documento Recebido";
      $destinatarios = array(EMAIL_DOCS_CLIENTES);
      $responderParaNome = $user['nome'];
      $responderParaEmail = $user['email'];
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);

      $email->Enviar();

      $retorno = URL . "cliente/documentos/cad-success";

      $arr_retorno = array(
        'status' => 'ok',
        'idDocumento' => $ultimo_id,
        'tipo' => $tabela,
        'retorno' => $retorno,
        'acao' => 'insert'
      );
    } else {

      $arr_retorno = array(
        'status' => 'erro'
      );
    }

    echo json_encode($arr_retorno);
  }
}

//==================================================//
//                     EDITAR                       //
//==================================================//
if ($acao == "update") {

  $idArquivo = (int) Tools::somenteNumeros($param4);
  $arquivo = $arquivos->SelectSingle("SELECT * FROM $tabela WHERE id = $idArquivo AND id_usuario = $idUser");

  // REALIZA A ATUALIZAÇÃO
  if (!empty($_POST)) {

    $idArquivo = $_POST['id_arquivo'];
    
    // DADOS
    $dados = array(
      'imovel_cod' => $_POST['imovel_cod'],
      'tipo' => $_POST['tipo'],
      'titulo' => $_POST['titulo'],
      'date_time' => Tools::getDateTime(),
      'url_amigavel' => Tools::geraSlug($_POST['titulo'])
    );

    if ($arquivos->Update($dados, "WHERE id=$idArquivo AND id_usuario=$idUser")) {

      $ultimo_id = $idArquivo;

      $path = $path . "/" . $ultimo_id;
      $upload->uploadArquivos($_FILES['arquivos'], $path, $ultimo_id, $grava, $remove);

      $dados_email = array(
        'titulo' => 'Documento Recebido',
        'texto' => 'O cliente <b>' . $user['nome'] . '</b> acaba de atualizar um documento, entre na área administrativa para ver mais detalhes.',
        'botao' => array(
          'texto' => 'Acessar Administração',
          'url' => URL . 'admin'
        )
      );
      $assunto = "Documento Recebido";
      $destinatarios = array(EMAIL_DOCS_CLIENTES);
      $responderParaNome = $user['nome'];
      $responderParaEmail = $user['email'];
      $anexos = array();
      $email = new Email($dados_email, $assunto, $destinatarios, $responderParaNome, $responderParaEmail, $anexos);

      $email->Enviar();

      $retorno = URL . "cliente/documentos/edit-success";

      $arr_retorno = array(
        'status' => 'ok',
        'idArquivo' => $ultimo_id,
        'tipo' => $tabela,
        'retorno' => $retorno,
        'acao' => 'update'
      );
    } else {
      $arr_retorno = array(

        'status' => 'erro'
      );
    }

    echo json_encode($arr_retorno);
  }
}

//==================================================//
//                     REMOVER                      //
//==================================================//
if ($acao == "remover") {

  $idUser = (int) $user['id'];
  $idDel = (int) Tools::somenteNumeros($_POST['id_remove']);
  $path = '';
  $pathRemove = $path . "/" . $idDel;
  $ordemExibicao = false;

  $adicionais = array();

  $operacao = $arquivos->Delete($idDel, "WHERE id = $idDel AND id_usuario = $idUser", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

  if ($operacao) {
    echo "ok";
  } else {
    echo "erro";
  }
}
