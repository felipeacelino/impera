<?
// CONFIGURAÇÕES
$tabela = "anuncios_datas_indisponiveis";
$tabelaAnuncio = "anuncios";
$order = "ORDER BY dta ASC";
$paginacao = true;
$num_regs = 25;
$ordemExibicao = true;
$uploadArquivo = false;
$removeDiretorio = false;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// Categoria
$anuncio =  $acoes->SelectSingle("SELECT * FROM $tabelaAnuncio WHERE id = $id_enviado2");
if ($anuncio == "") {
  Tools::redireciona("" . URL . "admin/" . $pasta_modulo . "/" . $tabelaAnuncio . "/" . TOKEN . "/view");
}

$filtro = "WHERE origem='1' AND anuncio_id = " . $id_enviado2;
switch ($acao_enviado) {
  case 'insert':
    $tit_pag_geral = $anuncio['titulo'] . " &rsaquo; Datas indisponíveis";
    break;
  case 'edit':
    $tit_pag_geral = $anuncio['titulo'] . " &rsaquo; Datas indisponíveis";
    break;
  default:
    $tit_pag_geral = $anuncio['titulo'] . " &rsaquo; Datas indisponíveis";
    break;
}

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
  $path = IMG_PATH . "/" . $tabela;
  $extensoes_permitidas = array("png", "gif", "svg", "jpg", "jpeg");
  $redimensiona = false;
  $largura = 0;
  $altura = 0;
  $forma_redimensiona = ''; // '', 'crop', 'auto'
  $grava = true;
  $remove = true;
  $thumbs = array();
}

// URL RETORNO GERAL
$retorno_geral = $_GET['p2'] != '' ?
  "" . URL . "admin/" . $pasta_modulo . "/" . $tabelaAnuncio . "/" . TOKEN . "/view?p=" . $_GET['p2'] : "" . URL . "admin/" . $pasta_modulo . "/" . $tabelaAnuncio . "/" . TOKEN . "/view";

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $anuncio['id'];
if (isset($_GET['p']) && $_GET['p'] != '') {
  $current_url_view = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $anuncio['id'] . "?p=" . $_GET['p'];
  $current_url_insert = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/insert/0/" . $anuncio['id'] . "?p=" . $_GET['p'];
  $current_url_delete = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/delete/0/" . $anuncio['id'] . "?p=" . $_GET['p'];
} else {
  $current_url_view = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/view/0/" . $anuncio['id'];
  $current_url_insert = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/insert/0/" . $anuncio['id'];
  $current_url_delete = "" . URL . "admin/" . $pasta_modulo . "/" . $pag_include . "/" . TOKEN . "/delete/0/" . $anuncio['id'];
}

// CONFIGURAÇÕES DE RETORNO
if($acao == "delete"){    
	$retorno_pag = $current_url_view;
}else{
	$retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}


//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {	

	// ORDERNAR
	if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
		$_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
		$order = $_SESSION[$pag_include]['ordem'];    
	} else if ($_SESSION[$pag_include]['ordem'] != "") {
		$order = $_SESSION[$pag_include]['ordem'];
	}

	$resultado = $acoes->SelectMultiple("SELECT * FROM $tabela $filtro $order", $paginacao, $num_regs);
	$total_registros = $acoes->totalRegistros();

}


//==================================================//
//                      INSERT                      //
//==================================================//
if($acao == "insert"){

	if(isset($_POST['acao']) && $_POST['acao'] == "insert" && TOKEN == $token_confirma){

		// VERIFICA CAMPOS ÚNICOS
		$verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST);
		if ($verificaUnicos === true) {

			// VERIFICA IMAGENS
			$verificaImagens = $upload->validateImages($_FILES['img'], $extensoes_permitidas);
			if ($verificaImagens === true) {

        if($_POST['datas_indisponiveis'] != ' até '){

          $datasCadastro = explode(' até ', $_POST['datas_indisponiveis']);
          $erro = 0;

          $inicio = Tools::formataDataBd($datasCadastro[0]);
          $fim = Tools::formataDataBd($datasCadastro[1]);
          $dtas = Tools::intervaloDatas($inicio, $fim);

          foreach ($dtas as $key => $dta) {
              // DADOS
              $dados = array(
                'dta' => $dta,
                'origem' => 1,
                'anuncio_id' => $anuncio['id'],
                'origem_id' => 0,
                'dta_cad' => Tools::getDate()
              );
  
              $operacao = $acoes->Insert($dados);
  
              if (!$operacao) {
                $erro++;
              }
          }

          if ($erro == 0) {
            $_SESSION['msg_retorna'] = Tools::alertReturn(1);
            Tools::redireciona($retorno_pag);
          } else {
            $_SESSION['msg_retorna'] = Tools::alertReturn(4);
            Tools::redireciona($retorno_pag);
          }

        }else{
          $_SESSION['msg_retorna'] = Tools::alertReturn(4);
          Tools::redireciona($retorno_pag);
        }
			
			// ERRO ARQUIVOS
			} else { 
				$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$verificaImagens,"error");
				Tools::redireciona($retorno_pag);
			}		

		// ERRO CAMPOS ÚNICOS
		} else { 
			$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$verificaUnicos,"error");
			Tools::redireciona($_SERVER['REQUEST_URI']);
		}
	}
}		



//==================================================//
//                      UPDATE                      //
//==================================================//
if ($acao == "edit") {

  if (isset($_POST['acao']) && $_POST['acao'] == "edit" && TOKEN == $token_confirma) {

    $idEdit = Tools::protege($_POST['id']);

    // VERIFICA CAMPOS ÚNICOS
    $verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST, $idEdit);
    if ($verificaUnicos === true) {

      // VERIFICA IMAGENS
      $verificaImagens = $upload->validateImages($_FILES['img'], $extensoes_permitidas);
      if ($verificaImagens === true) {

        $delDtas = $acoes->SelectSQL("DELETE FROM $tabela WHERE origem='1' AND anuncio_id = " . $anuncio['id']);

        $dtas = explode(",", $_POST['datas_indisponiveis']);
        $erro = 0;

        if ($_POST['datas_indisponiveis'] != '') {
          foreach ($dtas as $dta) {
            // DADOS
            $dados = array(
              'dta' => Tools::formataDataBd($dta),
              'origem' => 1,
              'anuncio_id' => $anuncio['id'],
              'origem_id' => 0,
              'dta_cad' => Tools::getDate()
            );

            $operacao = $acoes->Insert($dados);

            if (!$operacao) {
              $erro++;
            }
          }
        }

        if ($erro == 0) {
          $_SESSION['msg_retorna'] = Tools::alertReturn(1);
          Tools::redireciona($retorno_pag);
        } else {
          $_SESSION['msg_retorna'] = Tools::alertReturn(4);
          Tools::redireciona($retorno_pag);
        }

        // ERRO ARQUIVOS
      } else {
        $_SESSION['msg_retorna'] = Tools::alertReturn(0, "Erro", $verificaImagens, "error");
        Tools::redireciona($retorno_pag);
      }

      // ERRO CAMPOS ÚNICOS
    } else {
      $_SESSION['msg_retorna'] = Tools::alertReturn(0, "Erro", $verificaUnicos, "error");
      Tools::redireciona($_SERVER['REQUEST_URI']);
    }
  }
}

//==================================================//
//                     DELETE                       //
//==================================================//
if($acao == "delete" && TOKEN == $token_confirma_del){

  $idDel = Tools::protege($_POST['id']);
  
  $operacao = $acoes->Delete($idDel, "WHERE id=$idDel", array(), false, false, null);

	if ($operacao) {

		$_SESSION['msg_retorna'] = Tools::alertReturn(3);
		Tools::redireciona($retorno_pag);

	}else{

		$_SESSION['msg_retorna'] = Tools::alertReturn(4);
		Tools::redireciona($retorno_pag);

	}

}


//==================================================//
//                DELETE MULTIPLE                   //
//==================================================//
if(isset($_POST['acao_exec'])  && $_POST['acao_exec'] == 6){

	$ids = $_POST['id'];

	foreach ($ids as $idDel) {

    $operacao = $acoes->Delete($idDel, "WHERE id=$idDel", array(), false, false, null);

		// ERRO OPERAÇÃO
		if (!$operacao) {	
			
			$_SESSION['msg_retorna'] = Tools::alertReturn(4);
			Tools::redireciona($retorno_pag);
			exit;

    } 
    
	}

	// SUCESSO
	$_SESSION['msg_retorna'] = Tools::alertReturn(3);
	Tools::redireciona($retorno_pag);

}
