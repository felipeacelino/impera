<?
if (!isset($_SESSION)) { session_start(); } 
include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".ACOES_ADMIN_PATH."/geral/restritos.php");
include ("".ACOES_ADMIN_PATH."/geral/user.php");

$conn = new Init();
$conexao = $conn->conectar();

if (!defined('PATH_ATUAL')) exit; 

if (!empty($_GET)) {

	$tabela = $_GET['tab'];
	$idItem = $_GET['id'];
	$idAdicional = $_GET['idadc'];
	$posAtual = $_GET['atual'];
	$posNova = $_GET['nova'];
	$retorno = $_GET['r'];

	// ATUALIZA A ORDEM DO ITEM SELECIONADO
	$updateItem = $conexao->prepare("UPDATE $tabela SET ordem_exibicao = :posNova WHERE id = :idItem");
	$updateItem->bindValue(':posNova', $posNova, PDO::PARAM_INT);
	$updateItem->bindValue(':idItem', $idItem, PDO::PARAM_INT);
	$updateItem->execute();

	// ATUALIZA A ORDEM DOS DEMAIS ITENS
	
	// Subcategorias
	if ($idAdicional != "") {
    if ($tabela == "paginas_blocos" || $tabela == "paginas_icones" || $tabela == "paginas_faq" || $tabela == "paginas_faq2" || $tabela == "paginas_faq3") {
      $campoAdd = "pagina_id";
    } else if ($tabela == "anuncios_bairros") {
      $campoAdd = "cidade_id";
    } else if ($tabela == "anuncios_tipos_itens") {
      $campoAdd = "tipo_id";
    } else {
      $campoAdd = "categoria_id";
    }
		if ($posAtual > $posNova) {
			$updateItens = $conexao->prepare("UPDATE $tabela SET ordem_exibicao=ordem_exibicao+1 WHERE id <> :idItem AND ordem_exibicao >= :posNova AND ordem_exibicao < :posAtual AND $campoAdd = :idAdicional");
			$updateItens->bindValue(':idItem', $idItem, PDO::PARAM_INT);
			$updateItens->bindValue(':posNova', $posNova, PDO::PARAM_INT);
			$updateItens->bindValue(':posAtual', $posAtual, PDO::PARAM_INT);
			$updateItens->bindValue(':idAdicional', $idAdicional, PDO::PARAM_INT);
			$updateItens->execute();
		} else {
			$updateItens = $conexao->prepare("UPDATE $tabela SET ordem_exibicao=ordem_exibicao-1 WHERE id <> :idItem AND ordem_exibicao <= :posNova AND ordem_exibicao > :posAtual AND $campoAdd = :idAdicional");
			$updateItens->bindValue(':idItem', $idItem, PDO::PARAM_INT);
			$updateItens->bindValue(':posNova', $posNova, PDO::PARAM_INT);
			$updateItens->bindValue(':posAtual', $posAtual, PDO::PARAM_INT);
			$updateItens->bindValue(':idAdicional', $idAdicional, PDO::PARAM_INT);
			$updateItens->execute();
		}
	} 
	// Normal
	else {
		if ($posAtual > $posNova) {
			$updateItens = $conexao->prepare("UPDATE $tabela SET ordem_exibicao=ordem_exibicao+1 WHERE id <> :idItem AND ordem_exibicao >= :posNova AND ordem_exibicao < :posAtual");
			$updateItens->bindValue(':idItem', $idItem, PDO::PARAM_INT);
			$updateItens->bindValue(':posNova', $posNova, PDO::PARAM_INT);
			$updateItens->bindValue(':posAtual', $posAtual, PDO::PARAM_INT);
			$updateItens->execute();
		} else {
			$updateItens = $conexao->prepare("UPDATE $tabela SET ordem_exibicao=ordem_exibicao-1 WHERE id <> :idItem AND ordem_exibicao <= :posNova AND ordem_exibicao > :posAtual");
			$updateItens->bindValue(':idItem', $idItem, PDO::PARAM_INT);
			$updateItens->bindValue(':posNova', $posNova, PDO::PARAM_INT);
			$updateItens->bindValue(':posAtual', $posAtual, PDO::PARAM_INT);
			$updateItens->execute();
		}
	}
		
	Tools::redireciona($retorno);

}

?> 
