<?
/* define('HOST', 'localhost');  
define('DBNAME', 'elloscom_impera');  
define('USER', 'elloscom_impera');  
define('PASSWORD', 'mudar@10');
define('CHARSET', 'utf8'); */

define('HOST', 'localhost');  
define('DBNAME', 'impera');  
define('USER', 'root');  
define('PASSWORD', '');
define('CHARSET', 'utf8');

class Conexao {  
  
	private static $pdo;

  /*  
  * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão  
  */  
  public static function getInstance() {  
    if (!isset(self::$pdo)) {  
   		try {  
   			$opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  
   			self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, $opcoes);  
   		} catch (PDOException $e) {  
   			$erro_msg .= 'Erro: ' . $e->getMessage() . PHP_EOL;
   			$erro_msg .= 'Arquivo: ' . basename($e->getFile()) . '  - Linha: ' . $e->getLine() . PHP_EOL.'-----------------------------------------------------------------------------------------------------------------------------';
   			$hj = date("Y-m-d");
   			$erro = $erro_msg; 
   			$arq = 'logs/erros/conexao';
   			if (!file_exists($arq)){ 
   				mkdir ($arq, 0755, true);
   			}
   			$arquivo = fopen($arq."/".$hj.'_erro_conexao.txt','a');
   			fwrite($arquivo,"-[".date("r")."] $erro\r\n");
   			fclose($arquivo);
   		}  
   	}  
   	return self::$pdo;  
  }  
}
?>
