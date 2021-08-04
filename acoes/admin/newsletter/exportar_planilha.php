<?php

session_start();

include ("../../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".ACOES_ADMIN_PATH."/geral/restritos.php");
include ("".ACOES_ADMIN_PATH."/geral/user.php");
include ("".CLASS_PATH."/PHPExcel/Classes/PHPExcel.php");

Tools::debug(false);

$db = new Init();
$conexao = $db->conectar();

$acoes = new Crud("newsletter");

$emails = $acoes->SelectMultiple("SELECT * FROM newsletter WHERE status = 1 ORDER BY email ASC",false,"");

if ($acoes->totalRegistros() > 0) {

	$objPHPExcel = new PHPExcel();

	// Títulos das colunas
	$header_itens = array('Código','E-mail','Cadastro');

	// Popula os títulos da coluna (Primeira linha)
	foreach ($header_itens as $key => $value) {
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($key, 1, $value);
	}

	// Obtém a String da última coluna
	$lastColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();

	// Aplica negrito na fonte de todas as celulas da primeira linha
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$lastColumn.'1')->getFont()->setBold(true);

	// Fixa a primeira linha
	$objPHPExcel->getActiveSheet()->freezePane('A1');

	// Aplica largura automática em todas as colunas e alinha a esquerda
	for ($col = 'A'; $col !== $lastColumn; $col++) {
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle($col)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	}

	// Dados do banco
	$linha = 2; 

	foreach ($emails as $email) {

		// Popula os dados na planilha
		$coluna = 0;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $email['id']);
		$coluna++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, $email['email']);
		$coluna++;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($coluna, $linha, Tools::formataData($email['data_cad']));
		
		$linha++;

	}

	// Título da planilha
	$objPHPExcel->getActiveSheet()->setTitle('Newsletter');
	// Tipo do arquivo
	header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
	// Nome do arquivo
	header('Content-Disposition: attachment;filename="newsletter.xls"');
	header('Cache-Control: max-age=0');
	header('Cache-Control: max-age=1');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	// Salva o arquivo
	$objWriter->save('php://output');
	// Documentação
	//https://github.com/PHPOffice/PHPExcel/wiki/User-documentation

	exit;

} else {
	
	$_SESSION['msg_retorna'] = Tools::alertReturn(0,"Sem registros","Não há registros para serem exportados","warning");
	Tools::redireciona("".URL."admin/newsletter/newsletter/".TOKEN."/view");

}
