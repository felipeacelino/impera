<?
// CONFIGURAÇÕES
$tabela = "anuncios_fotos";
$tabelaItem = "anuncios";
$order = "ORDER BY ordem_exibicao, id ASC";
$uploadArquivo = true;
$removeDiretorio = true;
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

// ITEM
$item =  $acoes->SelectSingle("SELECT * FROM $tabelaItem WHERE id = $id_enviado2");
if ($item == "") {
	Tools::redireciona("".URL."admin/".$pasta_modulo."/".$tabelaItem."/".TOKEN."/view");
}

$filtro = "WHERE item_id = ".$item['id'];
switch ($acao_enviado) { 
	case 'insert':
		$tit_pag_geral = $item['titulo']." &rsaquo; Fotos";
		break;
	case 'edit':
		$tit_pag_geral = $item['titulo']." &rsaquo; Fotos";
		break;
	default:
		$tit_pag_geral = $item['titulo']." &rsaquo; Fotos";
		break;
}

// CONFIGURAÇÕES DE UPLOAD DE IMAGEM
if ($uploadArquivo || $removeDiretorio) {
	$path = IMG_PATH."/".$tabelaItem."/".$item['id']."/".$tabela;
	$pathView = URL."/uploads/img/".$tabelaItem."/".$item['id']."/".$tabela;
	$extensoes_permitidas = array("png","gif","svg","jpg","jpeg");
	$redimensiona = false;
	$largura = 0;
	$altura = 0;
	$forma_redimensiona = ''; // '', 'crop', 'auto'
	$grava = true;
	$remove = true;	
	$thumbs = array(
    array(
			"largura" => 1200,
			"altura" => 800,
			"forma" => 'crop'
		),
		array(
			"largura" => 600,
			"altura" => 469,
			"forma" => 'crop'
		),
		array(
			"largura" => 300,
			"altura" => 250,
			"forma" => 'crop'
    ),
		array(
			"largura" => 300,
			"altura" => 200,
			"forma" => 'crop'
		)
	);
}

// CONFIGURAÇÕES GALERIA
$habilita_titulo = false;   // Habilita a edição da descrição do imagem
$habilita_destaque = true;  // Habilita o destaque das imagens
$habilita_zoom = true;      // Habilita o zoom das imagens
$limiteQtde = 0;            // Limite de imagens (0 = ilimitado)
$maxFileSize = 10;          // Tamanho máximo da imagem em MB
$maxFileCount = 999;         // Quantidade máxima de imagens selecionadas no formulário(Válido somente quando não há limites)
$extensoes_permitidas_var = "['".implode("', '", $extensoes_permitidas)."']";

// OBTÉM O TOTAL DE FOTOS JÁ CADASTRADAS
if ($limiteQtde > 0) {
	$totalFotos = $acoes->SelectTotalSQL("SELECT id FROM $tabela $filtro");
	$maxFileCount = $limiteQtde - $totalFotos;
}

// URL RETORNO GERAL
$retorno_geral = $_GET['p2'] != '' ?
"".URL."admin/".$pasta_modulo."/".$tabelaItem."/".TOKEN."/view?p=".$_GET['p2'] :
"".URL."admin/".$pasta_modulo."/".$tabelaItem."/".TOKEN."/view";

// CONFIGURAÇÕES DE PAGINAÇÃO
$url_paginacao = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$item['id'];
if (isset($_GET['p']) && $_GET['p'] != '') {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$item['id']."?p=".$_GET['p'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$item['id']."?p=".$_GET['p'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$item['id']."?p=".$_GET['p'];
} else {
	$current_url_view = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/view/0/".$item['id'];
	$current_url_insert = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/insert/0/".$item['id'];
	$current_url_delete = "".URL."admin/".$pasta_modulo."/".$pag_include."/".TOKEN."/delete/0/".$item['id'];
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

	$resultado = $acoes->SelectMultiple("SELECT * FROM $tabela $filtro $order", false, "");
	$total_registros = $acoes->totalRegistros();

}


//==================================================//
//                      INSERT                      //
//==================================================//
if($acao == "insert"){

	// REDIRECIONA CASO HAJA LIMITE E O MESMO TENHA SIDO ATINGIDO
	if ($limiteQtde > 0 && $maxFileCount < 1) {
		$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Atenção","O limite de imagens cadastradas foi atingido","warning");
		Tools::redireciona($current_url_view);
	}

	if(isset($_POST['acao']) && $_POST['acao'] == "insert" && TOKEN == $token_confirma){

		$retorno_pag = $current_url_view;	
		
		// VERIFICA CAMPOS ÚNICOS
		$verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST);
		if ($verificaUnicos === true) {

			// VERIFICA IMAGENS
			$verificaImagens = $upload->validateImages($_FILES['fotos'], $extensoes_permitidas);
			if ($verificaImagens === true) {

				// DADOS
				$dados = array(
					"item_id" => $item['id'],
					"descricao" => 'Sem descrição',
					"destaque" => 0			
				);

				// UPLOAD DE IMAGEM
				$uploadMultiplas = $upload->uploadImagensMultiplas($_FILES['fotos'], $path, $dados, $grava, $redimensiona, $largura, $altura, $forma_redimensiona, $thumbs);

				if ($uploadMultiplas) {

					// DESTAQUE NA PRIMEIRA
					$totalDestaques = $acoes->SelectTotalSQL("SELECT id FROM $tabela WHERE destaque=1 AND item_id=".$item['id']);
					if ($totalDestaques == 0) {
						$aplicaDestaque = $acoes->Update(array("destaque" => 1),"WHERE item_id = ".$item['id']." ORDER BY id ASC LIMIT 1");
					}

					$_SESSION['msg_retorna'] = Tools::alertReturn(1);
					Tools::redireciona($retorno_pag);

				// ERRO OPERAÇÃO		
				} else {

					$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Erro",$uploadMultiplas,"error");
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
if(isset($_POST['acao']) && $_POST['acao'] == "edit" && TOKEN == $token_enviado){

	$idEdit = Tools::protege($_POST['id_edit']);

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $idEdit LIMIT 1");	

	if ($linha_edit == "") {
		Tools::redireciona($current_url_view);
	}

	// VERIFICA CAMPOS ÚNICOS
	$verificaUnicos = $acoes->verificaUnicos($campos_unicos, $_POST, $idEdit);
	if ($verificaUnicos === true) {

		// VERIFICA IMAGENS
		$verificaImagens = $upload->validateImages($_FILES['fotos'], $extensoes_permitidas);
		if ($verificaImagens === true) {

			// ATUALIZA DESCRIÇÃO
			if ($_POST['acao_edit'] == "descricao") {
				// DADOS
				$dados = array(
					"descricao" => $_POST['descricao']			
				);
				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){
					$_SESSION['msg_retorna'] = Tools::alertReturn(2);
					Tools::redireciona($retorno_pag);
				// ERRO OPERAÇÃO
				} else { 
					$_SESSION['msg_retorna'] = Tools::alertReturn(4);
					Tools::redireciona($retorno_pag);
				}
			}	

			// ATUALIZA DESTAQUE
			if ($_POST['acao_edit'] == "destaque") {

				// LIMPAR AS DEMAIS IMAGENS EM DESTAQUE
				$limpaDestaques = $acoes->Update(array("destaque" => 0),"WHERE item_id = ".$item['id']);

				// DADOS
				$dados = array(
					"destaque" => 1			
				);

				$operacao = $acoes->Update($dados,"WHERE id = $idEdit");

				if($operacao){
					$_SESSION['msg_retorna'] = Tools::alertReturn(2);
					Tools::redireciona($retorno_pag);
				// ERRO OPERAÇÃO
				} else { 
					$_SESSION['msg_retorna'] = Tools::alertReturn(4);
					Tools::redireciona($retorno_pag);
				}
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


//==================================================//
//                     DELETE                       //
//==================================================//
if($acao == "delete" && TOKEN == $token_confirma_del){

	$idDel = Tools::protege($_POST['id']);

	// RESGATA REGISTRO
	$linha_del = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $idDel LIMIT 1");	

	if ($linha_del == "") {
		Tools::redireciona($current_url_view);
	}

	$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", array(), false, false, null);

	if ($operacao) {
		
		// ATUALIZA DESTAQUE
		if ($linha_del['destaque'] == '1') {
			$updateDestaque = $acoes->Update(array("destaque" => 1),"WHERE item_id = ".$linha_del['item_id']." ORDER BY id ASC LIMIT 1");
		}
		
		// REMOVE ARQUIVO
		if ($remove) {

			$upload->removeFiles($path."/".$linha_del['foto']);

			// REMOVE THUMBS
			if (!empty($thumbs)) {
				foreach ($thumbs as $thumb) {			
					$largura = (int)$thumb['largura'];
					$altura = (int)$thumb['altura'];
					$thumb = $path."/thumb-".$largura."-".$altura."/".$linha_del['foto'];
					$upload->removeFiles($thumb);
				}
			}							

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

	$retorno_pag = $current_url_view;

	$ids = $_POST['id'];

	foreach ($ids as $idDel) {

		// RESGATA REGISTRO
		$linha_del = $acoes->SelectSingle("SELECT * FROM $tabela WHERE id = $idDel LIMIT 1");	

		if ($linha_del == "") {
			Tools::redireciona($current_url_view);
		}

		$operacao = $acoes->Delete($idDel, "WHERE id=$idDel", array(), false, false, null);

		if ($operacao) {
		
			// ATUALIZA DESTAQUE
			if ($linha_del['destaque'] == '1') {
				$updateDestaque = $acoes->Update(array("destaque" => 1),"WHERE item_id = ".$linha_del['item_id']." ORDER BY id ASC LIMIT 1");
			}
			
			// REMOVE ARQUIVO
			if ($remove) {

				$upload->removeFiles($path."/".$linha_del['foto']);

				// REMOVE THUMBS
				if (!empty($thumbs)) {
					foreach ($thumbs as $thumb) {			
						$largura = (int)$thumb['largura'];
						$altura = (int)$thumb['altura'];
						$thumb = $path."/thumb-".$largura."-".$altura."/".$linha_del['foto'];
						$upload->removeFiles($thumb);
					}
				}

			}

		// ERRO OPERAÇÃO
		} else {
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
