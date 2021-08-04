<?
// CONFIGURAÇÕES
$tabela = "loja_conf";
$filtro = "WHERE id = 1 LIMIT 1";
$order = "";
$paginacao = true;
$num_regs = 15;
$ordemExibicao = false;
$uploadArquivo = false;
$removeDiretorio = false;
$action_form = $_SERVER['REQUEST_URI'];
$acao = $acao_enviado;
$token_confirma = $_POST['token'];
$token_confirma_del = $token_enviado;
$msg_retorna = "";
$msg_botao = $acao == "insert" ? "Cadastrar" : "Atualizar";
$campos_unicos = array();
switch ($acao_enviado) {
	case 'insert':
		$tit_pag_geral = "Informações gerais";
		break;
	case 'edit':
		$tit_pag_geral = "Informações gerais";
		break;
	default:
		$tit_pag_geral = "Informações gerais";
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
	$redimensiona = false;
	$largura = 0;
	$altura = 0;
	$forma_redimensiona = ''; // '', 'crop', 'auto'
	$grava = true;
	$remove = true;	
	$thumbs = array();
}

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

//==================================================//
//                      UPDATE                      //
//==================================================//
if($acao == "edit"){

	// RESGATA REGISTRO
	$linha_edit = $acoes->SelectSingle("SELECT * FROM $tabela $filtro");	
	if ($linha_edit == "") {
		Tools::redireciona(URL_ADMIN);
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
					'titulo_loja' => $_POST['titulo_loja'],
					'email_atendimento' => $_POST['email_atendimento'],
					'email_formulario' => $_POST['email_formulario'],			
					'email_agendamentos' => $_POST['email_agendamentos'],
					'email_propostas' => $_POST['email_propostas'],			
					'email_docs_clientes' => $_POST['email_docs_clientes'],
					'email_docs_proprietarios' => $_POST['email_docs_proprietarios'],
					'email_docs_corretores' => $_POST['email_docs_corretores'],			
					'telefones' => $_POST['telefones'],			
					'horario_funcionamento' => $_POST['horario_funcionamento'],	
					'endereco' => $_POST['endereco'],			
					'mapa' => $_POST['mapa'],			
					'whatsapp' => $_POST['whatsapp'],
					'skype' => $_POST['skype'],
					'facebook' => $_POST['facebook'],
					'twitter' => $_POST['twitter'],
					'instagram' => $_POST['instagram'],
					'youtube' => $_POST['youtube'],
					'linkedin' => $_POST['linkedin'],
          'taxa' => $_POST['taxa'] != "" ? str_replace(",",".",$_POST['taxa']) : 0,
          'taxa_exclusivos' => $_POST['taxa_exclusivos'] != "" ? str_replace(",",".",$_POST['taxa_exclusivos']) : 0,
					'status' => 1
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


?>
