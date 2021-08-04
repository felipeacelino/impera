<?
// CONFIGURAÇÕES
$tabela = "paginas_faq";
$order = "ORDER BY ordem_exibicao ASC";
$paginacao = false;
$num_regs = 15;
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

// Pagina
$pagina =  $acoes->SelectSingle("SELECT * FROM paginas WHERE id = $id_enviado2");

$filtro = "WHERE pagina_id = ".$pagina['id'];
switch ($acao_enviado) { 
	case 'insert':
		$tit_pag_geral = $pagina['titulo_pag']." &rsaquo; Cadastrar pergunta";
		break;
	case 'edit':
		$tit_pag_geral = $pagina['titulo_pag']." &rsaquo; Editar pergunta";
		break;
  default:
    $tit_pag_geral = $pagina['titulo_pag']." &rsaquo; Perguntas Frequentes";
		break;
}

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
	$path = IMG_PATH."/".$tabela;
	$extensoes_permitidas = array("png","gif","svg","jpg","jpeg","webp");
	$redimensiona = false;
	$largura = 0;
	$altura = 0;
	$forma_redimensiona = ''; // '', 'crop', 'auto'
	$grava = true;
	$remove = true;	
	$thumbs = array();
}

// URL RETORNO GERAL
$retorno_geral = "".URL."admin/".$pasta_modulo."/paginas/".TOKEN."/edit/pag_".$pagina['pagina'];

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$pagina['id'];
if (isset($_GET['p']) && $_GET['p'] != '') {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$pagina['id']."?p=".$_GET['p'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$pagina['id']."?p=".$_GET['p'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$pagina['id']."?p=".$_GET['p'];
} else {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$pagina['id'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$pagina['id'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$pagina['id'];
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

	// ORDENS DE EXIBIÇÃO
	if ($ordemExibicao) {
		$ordens = $acoes->SelectSQL("SELECT ordem_exibicao FROM $tabela WHERE pagina_id = ".$pagina['id']." ORDER BY ordem_exibicao ASC");
	}

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

				// DADOS
				$dados = array(
					'pagina_id' => $pagina['id'],
					'titulo' => $_POST['titulo'],
					'texto' => $_POST['texto'],
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0	
				);
				
				$operacao = $acoes->Insert($dados);

				if ($operacao) {

					$ultimo_id = $acoes->getId();
			
					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$ultimo_id;
						$upload->uploadImagens($_FILES['img'], $path, $ultimo_id, $grava, $remove, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);				
					}

					// Ordem de Exibição
					if ($ordemExibicao) {
						$prox_valor = $acoes->SelectSingle("SELECT MAX(ordem_exibicao) AS maior_valor FROM $tabela WHERE pagina_id=".$pagina['id']." LIMIT 1")['maior_valor'];	
						$prox_valor = $prox_valor != "" ? ++$prox_valor : 1;	
						$updateOrdem = $acoes->Update(
							array(			
								"ordem_exibicao" => $prox_valor
							),
							"WHERE id = $ultimo_id"
						);
					}

					$_SESSION['msg_retorna'] = Tools::alertReturn(1);
					Tools::redireciona($retorno_pag);

				// ERRO OPERAÇÃO
				} else { 
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
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $id_enviado LIMIT 1");	

	if ($linha_edit == "") {
		Tools::redireciona($current_url_view);
	}

	if(isset($_POST['acao']) && $_POST['acao'] == "edit" && TOKEN == $token_confirma){

		$idEdit = Tools::protege($_POST['id']);

		// VERIFICA CAMPOS ÚNICOS
		$verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST, $idEdit);
		if ($verificaUnicos === true) {

			// VERIFICA IMAGENS
			$verificaImagens = $upload->validateImages($_FILES['img'], $extensoes_permitidas);
			if ($verificaImagens === true) {

				// DADOS
				$dados = array(
					'titulo' => $_POST['titulo'],
					'texto' => $_POST['texto'],
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0			
				);	

				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){

					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$idEdit;
						$upload->uploadImagens($_FILES['img'], $path, $idEdit, $grava, $remove, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);				
					}

					$_SESSION['msg_retorna'] = Tools::alertReturn(2);
					Tools::redireciona($retorno_pag);

				// ERRO OPERAÇÃO
				} else { 
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
//                UPDATE MULTIPLE                   //
//==================================================//
if(isset($_POST['acao_exec'])  && $_POST['acao_exec'] == 5){

	$campo = $_POST['campo'];
	$valor = $_POST['status'];
	$ids = $_POST['id'];

	foreach ($ids as $idUpdate) {	

		// Dados
		$dados = array(			
			$campo => $valor
		);	

		$operacao = $acoes->Update($dados,"WHERE id = $idUpdate");

		// ERRO OPERAÇÃO
		if (!$operacao) {
			$_SESSION['msg_retorna'] = Tools::alertReturn(4);
			Tools::redireciona($retorno_pag);
			exit;
		}

	}

	// SUCESSO
	$_SESSION['msg_retorna'] = Tools::alertReturn(2);
	Tools::redireciona($retorno_pag);

}


//==================================================//
//                     DELETE                       //
//==================================================//
if($acao == "delete" && TOKEN == $token_confirma_del){

	$idDel = Tools::protege($_POST['id']);
	$pathRemove = $path."/".$idDel;

	$adicionais = array();

	// Pega a ordem de exibição do item a ser excluído
	if ($ordemExibicao) {
		$result_item_del = $conexao->prepare("SELECT pagina_id, ordem_exibicao FROM $tabela WHERE id = $idDel");
		$result_item_del->execute();	      
		$ordem_item_del = $result_item_del->fetch(PDO::FETCH_ASSOC);
	}

	$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, false, $removeDiretorio, $pathRemove);

	if ($operacao) {

		// Atualiza a ordem dos itens decrementando 1 (-1), cujo a ordem seja maior que o item excluído
		if ($ordemExibicao) {				
			$update_itens = $conexao->prepare("UPDATE $tabela SET ordem_exibicao = ordem_exibicao - 1 WHERE ordem_exibicao > :oe AND pagina_id = :cat");
			$update_itens->bindValue(':oe',$ordem_item_del['ordem_exibicao'],PDO::PARAM_INT);
			$update_itens->bindValue(':cat',$ordem_item_del['pagina_id'],PDO::PARAM_INT);
			$update_itens->execute();
		}

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

		// Pega a ordem de exibição do item a ser excluído
		if ($ordemExibicao) {
			$result_item_del = $conexao->prepare("SELECT pagina_id, ordem_exibicao FROM $tabela WHERE id = $idDel");
			$result_item_del->execute();	      
			$ordem_item_del = $result_item_del->fetch(PDO::FETCH_ASSOC);
		}

		$adicionais = array();

		$pathRemove = $path."/".$idDel;
		$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, false, $removeDiretorio, $pathRemove);

		// ERRO OPERAÇÃO
		if (!$operacao) {	
			
			$_SESSION['msg_retorna'] = Tools::alertReturn(4);
			Tools::redireciona($retorno_pag);
			exit;

		} else {

			// Atualiza a ordem dos itens decrementando 1 (-1), cujo a ordem seja maior que o item excluído
			if ($ordemExibicao) {				
				$update_itens = $conexao->prepare("UPDATE $tabela SET ordem_exibicao = ordem_exibicao - 1 WHERE ordem_exibicao > :oe AND pagina_id = :cat");
				$update_itens->bindValue(':oe',$ordem_item_del['ordem_exibicao'],PDO::PARAM_INT);
				$update_itens->bindValue(':cat',$ordem_item_del['pagina_id'],PDO::PARAM_INT);
				$update_itens->execute();
			}

		}

	}

	// SUCESSO
	$_SESSION['msg_retorna'] = Tools::alertReturn(3);
	Tools::redireciona($retorno_pag);

}

?>
