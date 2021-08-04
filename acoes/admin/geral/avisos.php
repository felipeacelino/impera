<?
// Configurações
$tabela = "admin_avisos";
$paginacao = false;
$num_regs = 4;

// Instância das classes
$db = new Init();
$conexao = $db->conectar();
$acoes = new Crud($tabela);

/* - - - - - - - - - - VIEW - - - - - - - - - - */

$result_avisos = $acoes->SelectMultiple("SELECT a.*, u.nome FROM $tabela AS a INNER JOIN admin AS u ON u.id = a.usuario_id ORDER BY a.id DESC LIMIT $num_regs", $paginacao, $num_regs);
$total_registros_avisos = $acoes->totalRegistros();

// Fim view

?>