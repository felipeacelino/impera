<?
// CONFIGURAÇÕES
$tabela = "sistema_conf";
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
		$tit_pag_geral = "Configurações gerais";
		break;
	case 'edit':
		$tit_pag_geral = "Configurações gerais";
		break;
	default:
		$tit_pag_geral = "Configurações gerais";
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

// TIMEZONE
$timezones = array(
	'AC' => 'America/Rio_branco',   'AL' => 'America/Maceio',
	'AP' => 'America/Belem',        'AM' => 'America/Manaus',
	'BA' => 'America/Bahia',        'CE' => 'America/Fortaleza',
	'DF' => 'America/Sao_Paulo',    'ES' => 'America/Sao_Paulo',
	'GO' => 'America/Sao_Paulo',    'MA' => 'America/Fortaleza',
	'MT' => 'America/Cuiaba',       'MS' => 'America/Campo_Grande',
	'MG' => 'America/Sao_Paulo',    'PR' => 'America/Sao_Paulo',
	'PB' => 'America/Fortaleza',    'PA' => 'America/Belem',
	'PE' => 'America/Recife',       'PI' => 'America/Fortaleza',
	'RJ' => 'America/Sao_Paulo',    'RN' => 'America/Fortaleza',
	'RS' => 'America/Sao_Paulo',    'RO' => 'America/Porto_Velho',
	'RR' => 'America/Boa_Vista',    'SC' => 'America/Sao_Paulo',
	'SE' => 'America/Maceio',       'SP' => 'America/Sao_Paulo',
	'SE' => 'America/Maceio',		'TO' => 'America/Araguaia'   
);

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
					'url_base' => $_POST['url_base'],			
					'smtp_host' => $_POST['smtp_host'],
					'smtp_user' => $_POST['smtp_user'],
					'smtp_pass' => $_POST['smtp_pass'],	
          'email_autenticado' => $_POST['email_autenticado'] != "" ? $_POST['email_autenticado'] : 0,
          'envio_gmail' => $_POST['envio_gmail'] != "" ? $_POST['email_autenticado'] : 0,
					'google_analytcs' => $_POST['google_analytcs'],			
					'timezone' => $_POST['timezone'],
					'cor_principal' => $_POST['cor_principal'],
					'cor_secundaria' => $_POST['cor_secundaria'],
					'btn_principal' => $_POST['btn_principal'],
					'btn_secundario' => $_POST['btn_secundario'],
					'cor_icheck' => $_POST['cor_icheck'],
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
