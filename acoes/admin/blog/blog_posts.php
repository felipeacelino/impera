<?
// CONFIGURAÇÕES
$tabela = "blog_posts";
$filtro = "WHERE p.id > 0";
$order = "ORDER BY p.data_exibe DESC";
$paginacao = true;
$num_regs = 15;
$ordemExibicao = false;
$uploadArquivo = true;
$removeDiretorio = true;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();
switch ($acao_enviado) {
	case 'insert':
		$tit_pag_geral = "Cadastrar post";
		break;
	case 'edit':
		$tit_pag_geral = "Editar post";
		break;
	default:
		$tit_pag_geral = "Blog";
		break;
}

// INSTÂNCIA DAS CLASSES
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);
$upload = new Uploads($tabela);

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
	$path = IMG_PATH."/".$tabela;
	$extensoes_permitidas = array("png","gif","svg","jpg","jpeg");
	$redimensiona = true;
	$largura = 900;
	$altura = 0;
	$forma_redimensiona = 'auto'; // '', 'crop', 'auto'
	$grava = true;
	$remove = true;	
	$thumbs = array(
		array(
			"largura" => 500,
			"altura" => 350,
			"forma" => 'crop'
		),
		array(
			"largura" => 65,
			"altura" => 65,
			"forma" => 'crop'
		)
	);
}

// CATEGORIAS
$categorias_posts = new Crud("blog_posts_categorias");
$categorias = $acoes->SelectSQL("SELECT * FROM blog_categorias ORDER BY ordem_exibicao ASC");

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";
if (isset($_GET['p']) && $_GET['p'] != '') {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view?p=".$_GET['p'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert?p=".$_GET['p'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete?p=".$_GET['p'];
} else {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert";
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete";
}	

// CONFIGURAÇÕES DE RETORNO
if($acao == "delete"){    
	$retorno_pag = $current_url_view;
}else{
	$retorno_pag = $_POST['retorno'] == "bt1" ? $_SERVER['REQUEST_URI'] : $current_url_view;
}

// URL FILTROS
$acao_filtros = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view";

//==================================================//
//                      VIEW                        //
//==================================================//
if ($acao == "view") {	

	// FILTRO 'TÍTULO'
	if (isset($_POST['filtro_titulo'])) {
	    if ($_POST['filtro_titulo'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_titulo'] = addslashes($_POST['filtro_titulo']);
	        $filtro_titulo = " AND p.titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";	
	        $filtro .= $filtro_titulo;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_titulo']);
	        $filtro_titulo = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_titulo'])) {
	    $filtro_titulo = " AND p.titulo LIKE '%".$_SESSION[$pag_include]['filtros']['filtro_titulo']."%'";
	    $filtro .= $filtro_titulo;
	}

	// FILTRO 'CATEGORIA'
	if (isset($_POST['filtro_categoria'])) {
	    if ($_POST['filtro_categoria'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_categoria'] = addslashes($_POST['filtro_categoria']);
			$filtro_categoria = " AND pc.categoria_id = '".$_SESSION[$pag_include]['filtros']['filtro_categoria']."'";	
			$join_categoria = "INNER JOIN blog_posts_categorias AS pc ON pc.post_id = p.id";
	        $filtro .= $filtro_categoria;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_categoria']);
			$filtro_categoria = "";
			$join_categoria = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_categoria'])) {
		$filtro_categoria = " AND pc.categoria_id = '".$_SESSION[$pag_include]['filtros']['filtro_categoria']."'";
		$join_categoria = "INNER JOIN blog_posts_categorias AS pc ON pc.post_id = p.id";
	    $filtro .= $filtro_categoria;
	}

	// FILTRO 'STATUS'
	if (isset($_POST['filtro_status'])) {
	    if ($_POST['filtro_status'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_status'] = addslashes($_POST['filtro_status']);
	        $filtro_status = " AND p.status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";	
	        $filtro .= $filtro_status;       
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_status']);
	        $filtro_status = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_status'])) {
	    $filtro_status = " AND p.status = '".$_SESSION[$pag_include]['filtros']['filtro_status']."'";
	    $filtro .= $filtro_status;
	}

	// FILTRO 'DATA'
	if (isset($_POST['filtro_data'])) {
	    if ($_POST['filtro_data'] != "") {
	        $_SESSION[$pag_include]['filtros']['filtro_data'] = addslashes($_POST['filtro_data']);
	        $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
	        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
	        $filtro_data = " AND (p.data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	        $filtro .= $filtro_data;     
	    }else{
	        unset($_SESSION[$pag_include]['filtros']['filtro_data']);
	        $filtro_data = "";
	    }
	} else if (isset($_SESSION[$pag_include]['filtros']['filtro_data'])) {
	    $dataInit = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[0]);
        $dataEnd = Tools::formataDataBd(explode(" - ", $_SESSION[$pag_include]['filtros']['filtro_data'])[1]);
        $filtro_data = " AND (p.data_cad BETWEEN '".$dataInit."' AND '".$dataEnd."')";	
	    $filtro .= $filtro_data;
	}

	// ORDERNAR
	if (isset($_POST['acao_exec'])  && $_POST['acao_exec'] == "ordenar") {
		$_SESSION[$pag_include]['ordem'] = $_POST['sort_ordem'];
		$order = $_SESSION[$pag_include]['ordem'];    
	} else if ($_SESSION[$pag_include]['ordem'] != "") {
		$order = $_SESSION[$pag_include]['ordem'];
	}

	$resultado = $acoes->SelectMultiple("SELECT p.* FROM $tabela AS p $join_categoria  $filtro $order", $paginacao, $num_regs);
	$total_registros = $acoes->totalRegistros();

	// Seleciona as categorias
	foreach ($resultado as $key => $value) {
		
		// Categorias do post
		$resultCatsPost = $conexao->prepare("SELECT c.titulo FROM blog_posts_categorias AS pc INNER JOIN blog_categorias AS c ON c.id = pc.categoria_id WHERE pc.post_id = :id");
		$resultCatsPost->bindValue(":id", $value['id'], PDO::PARAM_INT);
		$resultCatsPost->execute();
		$catsPost = $resultCatsPost->fetchAll(PDO::FETCH_COLUMN);

		$resultado[$key]['categorias'] = implode(', ', $catsPost);

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
					'titulo' => $_POST['titulo'],
					'texto' => $_POST['ckeditor'],
					'views' => 0,
					'url_amigavel' => Tools::geraSlug($_POST['titulo']),
					'destaque' => $_POST['destaque'] != "" ? $_POST['destaque'] : 0,
					'comentarios' => $_POST['comentarios'] != "" ? $_POST['comentarios'] : 0,
					'data_cad' => Tools::getDateTime(),
					'data_exibe' => Tools::formataDataBd($_POST['data_exibe']),
					'autor' => $_POST['autor'],
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0,
					'description' => $_POST['description']			
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
						$prox_valor = $acoes->SelectSingle("SELECT MAX(ordem_exibicao) AS maior_valor FROM $tabela LIMIT 1")['maior_valor'];	
						$prox_valor = $prox_valor != "" ? ++$prox_valor : 1;	
						$updateOrdem = $acoes->Update(
							array(			
								"ordem_exibicao" => $prox_valor
							),
							"WHERE id = $ultimo_id"
						);
					}

					// Categorias
					foreach ($_POST['categorias'] as $categoria) {
						$dados_cat = array(
							'categoria_id' => $categoria,
							'post_id' => $ultimo_id
						);
						$insertCats = $categorias_posts->Insert($dados_cat);
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

	// CATEGORIAS ATUAIS
	$resultCatsAtuais = $conexao->prepare("SELECT categoria_id FROM blog_posts_categorias WHERE post_id=:post_id");
	$resultCatsAtuais->bindValue(":post_id", $linha_edit['id'], PDO::PARAM_INT);
	$resultCatsAtuais->execute();
	$categorias_atuais_post = $resultCatsAtuais->fetchAll(PDO::FETCH_COLUMN);

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
					'texto' => $_POST['ckeditor'],					
					'url_amigavel' => Tools::geraSlug($_POST['titulo']),
					'destaque' => $_POST['destaque'] != "" ? $_POST['destaque'] : 0,
					'comentarios' => $_POST['comentarios'] != "" ? $_POST['comentarios'] : 0,
					'data_exibe' => Tools::formataDataBd($_POST['data_exibe']),
					'autor' => $_POST['autor'],
					'status' => $_POST['status'] != "" ? $_POST['status'] : 0,
					'description' => $_POST['description']		
				);

				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){

					// UPLOAD DE IMAGEM
					if ($uploadArquivo) {					
						$path = $path."/".$idEdit;
						$upload->uploadImagens($_FILES['img'], $path, $idEdit, $grava, $remove, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);				
					}

					// Categorias
					$deleteCats = $categorias_posts->Delete($idEdit, "WHERE post_id=$idEdit", array(), false, false, null);
					if ($deleteCats) {
						foreach ($_POST['categorias'] as $categoria) {
							$dados_cat = array(
								'categoria_id' => $categoria,
								'post_id' => $idEdit
							);
							$insertCats = $categorias_posts->Insert($dados_cat);
						}
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

	$adicionais = array(
		'blog_posts_categorias' => "post_id"
	);

	$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

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

		$adicionais = array(
			'blog_posts_categorias' => "post_id"
		);

		$pathRemove = $path."/".$idDel;
		$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", $adicionais, $ordemExibicao, $removeDiretorio, $pathRemove);

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


?>
