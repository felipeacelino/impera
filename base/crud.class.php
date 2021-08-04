<?
class Crud {
	
	private $tabela;
	private $registros_total;
	private $path;
	private $retorno;

  public function __construct($tabela) {

    $this->tabela = $tabela;
    $this->db = Init::conectar();
    
  }

	// Função responsável por gravar os erros em um arquivo de LOG
	function gravaErros($msg_erro){
		
		$hj = date("Y-m-d");
		$erro_banco = "Erro: " . $msg_erro. PHP_EOL.'-------------------------------------------------------------------------------------------------------------------------'; 
		$pagina_erro = $_SERVER['REQUEST_URI'];
		$arquivo = fopen(ERROS_PATH.'/'.$hj.'_erro_query.txt','a');
		fwrite($arquivo,"- [".$pagina_erro."] [".date("r")."]  $erro_banco\r\n");
		fclose($arquivo);

	}

	// Remove um diretório
	static function apagarDir($path){
		if (file_exists($path)) {
			$files = glob($path . '/*');
			foreach ($files as $file) {
				is_dir($file) ? self::apagarDir($file) : unlink($file);
			}
			rmdir($path);			
		}
        return;
    }

	function setMsgRetorno($retorno){
		
		$this->retorno = $retorno;		
		return $this->retorno;
		
	}

	// Insert
	public function Insert($dados=array()){
		
		if($dados != "" && is_array($dados)){

			foreach ($dados as $key => $value) {

				$value = addslashes($value);
				$value = "'$value'";					
				$read[] = "$key = $value";

			}

			$dados = implode(', ', $read);

			$insert = $this->db->prepare("INSERT INTO ".$this->tabela." SET $dados");
			$executa_insert = $insert->execute();
			$erro = $insert->errorInfo();
			$msg_erro = $erro[2];
			
			if(!$executa_insert){
				$this->gravaErros($msg_erro);
				$operacao = false;
			}else{
				$operacao = true;	
			}
			
			return $operacao;

		}

	}

	// Update
	public function Update($dados=array(), $where=""){
		
		if($dados != "" && is_array($dados)){
			
			foreach ($dados as $key => $value) {

				$value = addslashes($value);
				$value = "'$value'";					
				$updates[] = "$key = $value";

			}	

			$dados = implode(', ', $updates);

			$upd = $this->db->prepare("UPDATE ".$this->tabela." SET $dados $where");
			$executa_upd = $upd->execute();
			
			$erro = $upd->errorInfo();
			$msg_erro = $erro[2];

			if(!$executa_upd){
				$this->gravaErros($msg_erro);
				$operacao = false;
			}else{
				$operacao = true;	
			}

			return $operacao;

		}				
		
	}

	// Delete
	public function Delete($idDel, $where, $adicionais = array(), $ordemExibicao = false, $removeDiretorio = false, $path = null){

		if ($idDel != "" && is_numeric($idDel)) {

			// Pega a ordem de exibição do item a ser excluído
			if ($ordemExibicao) {				
			   	$result_item_del = $this->db->prepare("SELECT ordem_exibicao FROM ".$this->tabela." $where");
			    $result_item_del->execute();	      
			    $ordem_item_del = $result_item_del->fetch(PDO::FETCH_ASSOC)['ordem_exibicao'];
			}

			$del = $this->db->prepare("DELETE FROM ".$this->tabela." $where");
			$executa_del = $del->execute();
		
			$erro = $del->errorInfo();
			$msg_erro = $erro[2];

			if (!$executa_del) {

				$this->gravaErros($msg_erro);
				$operacao = false;

			} else {

				// Atualiza a ordem dos itens decrementando 1 (-1), cujo a ordem seja maior que o item excluído
				if ($ordemExibicao) {				
					$update_itens = $this->db->prepare("UPDATE ".$this->tabela." SET ordem_exibicao = ordem_exibicao - 1 WHERE ordem_exibicao > :oe");
		    		$update_itens->bindValue(':oe',$ordem_item_del,PDO::PARAM_INT);
			        $update_itens->execute();
				}

				// Remove o diretório
				if ($removeDiretorio) {
					$this->apagarDir($path);
				}

				// Tabelas adicionais
				foreach ($adicionais as $tab => $campo) {	
					$del = $this->db->prepare("DELETE FROM ".$tab." WHERE ".$campo."=:valor");
					$del->bindValue(":valor",$idDel,PDO::PARAM_INT);
					$executa_del = $del->execute();
				}

				$operacao = true;

			}

			return $operacao;
		
		}

	}

	// Select Multiple
	public function SelectMultiple($query,$paginacao,$num_regs){
	
		if($paginacao == false){

			$select = $this->db->prepare($query);
			$executa_selec = $select->execute();
			$erro = $select->errorInfo();
			$msg_erro = $erro[2];
			$operacao = !$executa_selec ? self::gravaErros($msg_erro) : "ok";
		
			$num_rows = $select->rowCount();
			$this->registros_total = $num_rows;

			if($num_rows > 0){

				$rows = $select->fetchAll(PDO::FETCH_ASSOC);
				
			}else{
				$rows = "";
			}
		
		}else{
			
			$registros = $num_regs;
			$select_total = $this->db->prepare($query);
			$select_total->execute();
			$num_rows = $select_total->rowCount();		
			$this->registros_total = $num_rows;

			# PAGINAÇÃO
			if(isset($_GET['p']) && $_GET['p'] != "") {
				$this->pagina_atual = $_GET['p'];
			}else{
				$this->pagina_atual = 1;
			}

			$this->paginas_t = ceil($this->registros_total / $registros);
			$fim = $registros * $this->pagina_atual;
			$inicio = ($fim - $registros);
			
			$select = $this->db->prepare("$query LIMIT $inicio, $registros");
			$executa_selec = $select->execute();
			$erro = $select->errorInfo();
			$msg_erro = $erro[2];
			$operacao = !$executa_selec ? self::gravaErros($msg_erro) : "ok";
			$num_rows = $select->rowCount();
			if($num_rows > 0){
				$rows = $select->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$rows = false;
			}
			
		}

		return $rows;
			
	}

	// Select Single
	public function SelectSingle($query){
		
		$select = $this->db->prepare($query);
		$executa_selec = $select->execute();
		$erro = $select->errorInfo();
		$msg_erro = $erro[2];
		$operacao = !$executa_selec ? self::gravaErros($msg_erro) : "ok";
		
		$num_rows = $select->rowCount();
		$this->registros_total = $num_rows;

		if($num_rows > 0){

			$row = $select->fetch(PDO::FETCH_ASSOC);
			
		}else{
			$row = "";
		}
	
		return $row;
			
	}

	// Select SQL (Livre)
	public function SelectSQL($sql){

		$select = $this->db->prepare($sql);
		$executa_selec = $select->execute();
		$erro = $select->errorInfo();
		$msg_erro = $erro[2];
		$operacao = !$executa_selec ? self::gravaErros($msg_erro) : "";
		$num_rows = $select->rowCount();
		$this->registros_total = $num_rows;
		$row = $num_rows > 0 ? $select->fetchAll(PDO::FETCH_ASSOC) : false;

		return $row;

	}

	// Retorna o total de registros
	public function totalRegistros(){

		return $this->registros_total;

	}

	// Retorna o total de registros de uma query
	public function SelectTotalSQL($sql){

		$select_total = $this->db->prepare($sql);
		$select_total->execute();		

		return $select_total->rowCount();

	}	

	// Paginação
	public function Pagination($current_url_view){

		$var_p = strpos($current_url_view, '?') === false ? '?p=' : '&p=';
		$pag_url = $current_url_view.$var_p;
		$pag_atual = $this->pagina_atual;
		$pag_total = $this->paginas_t;
		$pag_prev = $this->pagina_atual - 1;
		$pag_next = $this->pagina_atual + 1;
		$pag_first = $current_url_view;
		$pag_last = $pag_total;
			
		if ($pag_total > 1) {
			$exibe_pag = "<nav class='pagination-nav' aria-label='Page navigation'><ul class='pagination'>";

				// Primeira página e página anterior 
				if ($pag_atual > 1) {
				
					$exibe_pag .= "
					<li>
						<a href='".$current_url_view."' aria-label='First'>
							<span aria-hidden='true'>&laquo;</span>
						</a>
					</li>
					<li class='prev'>
						<a href='".$pag_url.$pag_prev."' aria-label='Previous'>
							<span aria-hidden='true'>&lsaquo;</span>
						</a>
					</li>";

				}

				// Exibe até cinco páginas antes da página atual
				foreach (array_reverse(range($pag_atual - 1, $pag_atual - 5)) as $pag_r) { 
					if ($pag_r > 0) {				
						$exibe_pag .= "
						<li class='pagination-pags'>
							<a href='".$pag_url.$pag_r."'>".$pag_r."</a>
						</li>";
					} 				
				}

				// Página atual
				$exibe_pag .= "
				<li class='active'>
					<a href='#'>
						".$pag_atual."<span class='sr-only'>(current)</span>
					</a>
				</li>";	

				// Exibe até cinco páginas depois da página atual
				foreach (array_reverse(range($pag_atual + 5, $pag_atual + 1)) as $pag_r) { 
					if ($pag_r <= $pag_total){ 
						$exibe_pag .= "
						<li class='pagination-pags'>
							<a href='".$pag_url.$pag_r."'>".$pag_r."</a>
						</li>";
					} 				
				} 

				// Última página e próxima página 
				if ($pag_atual < $pag_total) {

					$exibe_pag .= "
					<li class='next'>
						<a href='".$pag_url.$pag_next."' aria-label='Next'>
							<span aria-hidden='true'>&rsaquo;</span>
						</a>
					</li>
					<li>
						<a href='".$pag_url.$pag_last."' aria-label='Last'>
							<span aria-hidden='true'>&raquo;</span>
						</a>
					</li>";	
				
				}
		
			$exibe_pag .='</ul></nav>';

			echo $exibe_pag;

		}
				
	}	

	// Verifacação de campos únicos
	public function verificaUnicos($campos = array(), $dados = array(), $id = null) {
		foreach ($campos as $campo => $campoInfo) {	
			if (isset($dados[$campoInfo['name']]) && $dados[$campoInfo['name']] != "") {
				if ($id != null && $id != "") {
					$total = self::SelectTotalSQL("SELECT id FROM ".$this->tabela." WHERE $campo = '".$dados[$campoInfo['name']]."' AND id <> $id");				
				} else {
					$total = self::SelectTotalSQL("SELECT id FROM ".$this->tabela." WHERE $campo = '".$dados[$campoInfo['name']]."'");
				}
				if ($total > 0) {
					return $campoInfo['mensagem'];
				}
			}
		}
		return true;
	}

	// Resgata o último ID
	public function GetId(){
	
		return $this->db->lastInsertId($this->tabela);

	}				
	
} 
?>
