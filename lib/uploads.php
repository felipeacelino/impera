<?

include ("Canvas.class.php");

class Uploads {

	// Atributos
	protected $tabela = null;                  // Tabela do banco de dados
	protected $crud = null;                    // Ações da classe CRUD

	// Constantes
	const QUALIDADE = 100;		               // Qualidade da compressão
	const MAX_SIZE_IMG = 10000;                 // Tamanho máximo para as fotos
	const MAX_SIZE_ARQ = 10000;                 // Tamanho máximo para os demais arquivos

	// Imagick habilitado
	protected $hasImagick = false;

	// Construtor
	public function __construct($tabela = null) {

		$this->tabela = $tabela;
		$this->crud = new Crud($this->tabela);

		// Verifica se 'Imagick' está instalado e habilitado no servidor
		$this->hasImagick = extension_loaded('imagick') && class_exists("Imagick");	
	}
	
	// Retorna a extensão do arquivo
	function getExtension($fileName){
		$extensao = strtolower(end(explode('.',$fileName)));
		return $extensao;
	}

	// Retorna uma nova altura com base na largura
	function getAutoHeight($nova_largura, $pic){
		list($largura_img, $altura_img) = getimagesize($pic);
		$percent = ($nova_largura/$largura_img);
	   	$nova_altura = $altura_img * $percent; 
	   	return $nova_altura;
	}

	// Insere o arquivo no banco de dados
	function insert($id, $campo, $valor) {
		$dados = array(
			$campo => $valor
		);
		return $this->crud->Update($dados,"WHERE id = $id");	
	}
	
	// Retorna o nome do arquivo gravado no banco
	function resgataFile($id, $campo){
		return $this->crud->SelectSingle("SELECT ".$campo." FROM ".$this->tabela." WHERE id = ".$id."")[$campo];
	}

	// Remove um arquivo do diretório
	function removeFiles($path){		
		if(file_exists($path)){
			return unlink($path);
		}
		return false; 
	}

	// Redimensionamento
	function redimensiona($pic, $path, $largura, $altura, $forma_redimensiona) {

		// Imagick
		if ($this->hasImagick) {

			$image = new Imagick($pic);

			switch ($forma_redimensiona) {
				// Auto
				case 'auto':
					$image->resizeImage($largura, 0, Imagick::FILTER_LANCZOS, true);
					break;
				// Crop
				case 'crop':
					$image->cropThumbnailImage($largura, $altura);
					break;	
				// ''
				default:
					$image->resizeImage($largura, $altura, Imagick::FILTER_LANCZOS, true);
					break;	
			}

			$image->writeImage($path);
			$image->destroy();

		} 
		// GD (Canvas)
		else {
			
			switch ($forma_redimensiona) {
				// Auto
				case 'auto':
					$w = $largura; 		
					$h = self::getAutoHeight($w, $pic);
					$type = '';
					break;
				// Crop
				case 'crop':
					$w = $largura; 		
					$h = $altura; 		
					$type = 'crop';
					break;	
				// ''
				default:
					$w = $largura; 		
					$h = $altura; 		
					$type = '';
					break;	
			}

			$canvas = new canvas;
			$canvas->carrega($pic);
			$canvas->redimensiona($w, $h, $type);
			$canvas->grava($path);

		}
					
	}

	// Comprimi a imagem
	function comprimi($pic, $path, $qualidade) {
		// Imagick
		if ($this->hasImagick) {

			$image = new Imagick($pic);
			$image->setImageCompressionQuality($qualidade);
			$image->stripImage();
			$image->writeImage($path);
			$image->destroy();

		} 
		// GD
		else {

			$image = imagecreatefromjpeg($pic);
			imagejpeg($image, $path, $qualidade);
			imagedestroy($image);

		}					
	}

	// Rotate
	function rotate($pic, $angulo, $pic_new) {
		
    	$original = imagecreatefromjpeg($pic);    
   		$rotated = imagerotate($pic, $angulo, 0);    
        imagejpeg($rotated, $pic_new);
    	imagedestroy($rotated);

	}

	// Auto rotate
	function autoRotate($pic) {

		$exif = exif_read_data($pic);

		if (!empty($exif['Orientation'])) {

			$original = imagecreatefromjpeg($pic);
			$new = $pic;

		    switch($exif['Orientation']) {
		        case 8:
		            $new_photo = imagerotate($original,90,0);
		            imagejpeg($new_photo, $new); 
					imagedestroy($original);
					imagedestroy($new_photo);
		            break;
		        case 3:
		            $new_photo = imagerotate($original,180,0);
		            imagejpeg($new_photo, $new); 
					imagedestroy($original);
					imagedestroy($new_photo);
		            break;
		        case 6:
		            $new_photo = imagerotate($original,-90,0);
		            imagejpeg($new_photo, $new); 
					imagedestroy($original);
					imagedestroy($new_photo);
		            break;
		    }

		}

	}

	// Valida as imagem enviadas
	function validateImages($imagens, $extensoes_permitidas) {
		if (!empty($imagens) && $imagens != ""){
			foreach($imagens['name'] as $campo_banco => $infos){

				$nome_imagem = $imagens['name'][$campo_banco];
				$size_imagem = $imagens['size'][$campo_banco];
				$error_imagem = $imagens['error'][$campo_banco];

				if ($nome_imagem != "") {
					// Verifica se há erros 
					if ($error_imagem) {
						return "Não foi possível enviar a imagem.";
					} else {
						// Verifica o tamanho da imagem
						if ($size_imagem > self::MAX_SIZE_IMG * 1024) {
							return "A imagem enviada é muito grande.";
						} else {
							// Verifica se a extensão da imagem 
							if (!in_array(self::getExtension($nome_imagem), $extensoes_permitidas)){
								return "O formato de imagem é inválido.";
							}
						}
					}
				}				

			}
		}
		return true;
	}

	// Valida os arquivos enviados
	function validateArquivos($arquivos, $extensoes_permitidas) {
		if (!empty($arquivos) && $arquivos != ""){
			foreach($arquivos['name'] as $campo_banco => $infos){

				$nome_arquivo = $arquivos['name'][$campo_banco];
				$size_arquivo = $arquivos['size'][$campo_banco];
				$error_arquivo = $arquivos['error'][$campo_banco];

				if ($nome_arquivo != "") {
					// Verifica se há erros 
					if ($error_arquivo) {
						return "Não foi possível enviar a imagem.";
					} else {
						// Verifica o tamanho do arquivo
						if ($size_arquivo > self::MAX_SIZE_ARQ * 1024) {
							return "O arquivo enviado é muito grande.";
						} else {
							// Verifica se a extensão da imagem 
							if (!in_array(self::getExtension($nome_arquivo), $extensoes_permitidas)){
								return "O formato do arquivo é inválido.";
							}
						}
					}
				}

			}
		}
		return true;
	}

	// Remove os campos vazios do array
	function removeVazios($array) {
		$newArray = $array;
		
		foreach ($newArray['name'] as $index => $value) {
			if ($value == "") {
				unset($newArray['name'][$index]);
				unset($newArray['type'][$index]);
				unset($newArray['tmp_name'][$index]);
				unset($newArray['error'][$index]);
				unset($newArray['size'][$index]);
			}
		}

		return $newArray;
	}

	// Gera Thumbnails
	function geraThumbs($thumbs, $pic, $nome_imagem, $path) {

		foreach ($thumbs as $thumb) {
			
			$largura = (int)$thumb['largura'];
			$altura = (int)$thumb['altura'];
			$forma_redimensiona = $thumb['forma'];
			$path_thumb = $path."/thumb-".$largura."-".$altura;
			$thumb = $path_thumb."/".$nome_imagem;
			
			if (!file_exists($path_thumb)){ 
				mkdir($path_thumb, 0755, true);
			}

			$this->redimensiona($pic, $thumb, $largura, $altura, $forma_redimensiona);

		}

	}

	// Upload de imagens
	function uploadImagens($imagens, $path, $id, $grava = true, $remove = true, $redimensiona = false, $largura = 0, $altura = 0, $forma_redimensiona = '', $thumbs = array()) {

		set_time_limit(0);

		$imagens = self::removeVazios($imagens);
		
		foreach($imagens['name'] as $campo_banco => $infos){
			
			$nome_imagem = $imagens['name'][$campo_banco];
			$tipo_imagem = $imagens['type'][$campo_banco];
			$tmp_name_imagem = $imagens['tmp_name'][$campo_banco];
			$size_imagem = $imagens['size'][$campo_banco];

			// Renomeia a imagem
			$nome_imagem = md5($nome_imagem.date('H:i:s')).".".self::getExtension($nome_imagem);
			
			// Cria o diretório caso ainda não exista
			if (!file_exists($path)){ 
				mkdir ($path, 0755, true);
			}

			// Caminho completo da imagem
			$pic = $path."/".$nome_imagem;

			// Realiza o upload da imagem
			if (move_uploaded_file($tmp_name_imagem, $pic)) {

				// Ajusta a rotação de fotos JPG
				if (self::getExtension($nome_imagem) == "jpg" || self::getExtension($nome_imagem) == "jpeg") {
					$this->autoRotate($pic);
				}

				// Comprimi a imagem
				$this->comprimi($pic, $pic, self::QUALIDADE);

				// Redimensiona imagem
				if ($redimensiona) {
					$this->redimensiona($pic, $pic, $largura, $altura, $forma_redimensiona);
				}

				// Thumbnails
				if (!empty($thumbs)) {
					$this->geraThumbs($thumbs, $pic, $nome_imagem, $path);
				}

				// Grava no banco de dados
				if ($grava) {
					// Recupera o arquivo antigo
					$arquivo_antigo = $this->resgataFile($id, $campo_banco);
					if ($this->insert($id, $campo_banco, $nome_imagem)) {		
						// Remove o arquivo antigo
						if ($remove && $arquivo_antigo != "") {
							$this->removeFiles($path."/".$arquivo_antigo);
							// Remove thumbs
							if (!empty($thumbs)) {
								foreach ($thumbs as $thumb) {			
									$largura = (int)$thumb['largura'];
									$altura = (int)$thumb['altura'];
									$thumb = $path."/thumb-".$largura."-".$altura."/".$arquivo_antigo;									
									$this->removeFiles($thumb);
								}								
							}							
						}
					} else {
						return "Não foi possível gravar a imagem no banco de dados";
					}
				}

			} else {
				return "Não foi possível realizar o upload da imagem";
			}			
		}
	}

	// Upload de arquivos
	function uploadArquivos($arquivos, $path, $id, $grava = true, $remove = true) {

		set_time_limit(0);

		$arquivos = self::removeVazios($arquivos);

		foreach($arquivos['name'] as $campo_banco => $infos){
			
			$nome_arquivo = $arquivos['name'][$campo_banco];
			$tipo_arquivo = $arquivos['type'][$campo_banco];
			$tmp_name_arquivo = $arquivos['tmp_name'][$campo_banco];
			$size_arquivo = $arquivos['size'][$campo_banco];

			// Renomeia o arquivo
			$nome_arquivo = md5($nome_arquivo.date('H:i:s')).".".self::getExtension($nome_arquivo);
			
			// Cria o diretório caso ainda não exista
			if (!file_exists($path)){ 
				mkdir ($path, 0755, true);
			}

			// Caminho completo do arquivo
			$arquivo = $path."/".$nome_arquivo;

			// Realiza o upload do arquivo
			if (move_uploaded_file($tmp_name_arquivo, $arquivo)) {

				// Grava no banco de dados
				if ($grava) {
					// Recupera o arquivo antigo
					$arquivo_antigo = $this->resgataFile($id, $campo_banco);
					if ($this->insert($id, $campo_banco, $nome_arquivo)) {						
						// Remove o arquivo antigo
						if ($remove && $arquivo_antigo != "") {
							$this->removeFiles($path."/".$arquivo_antigo);							
						}
					} else {
						return "Não foi possível gravar o arquivo no banco de dados";
					}
				}

			} else {
				return "Não foi possível realizar o upload do arquivo";
			}			
		}
	}

	// Upload de imagens múltiplas
	function uploadImagensMultiplas($imagens, $path, $dados, $grava = true, $redimensiona = false, $largura = 0, $altura = 0, $forma_redimensiona = '', $thumbs = array()) {

		set_time_limit(0);

		$imagens = self::removeVazios($imagens);

		foreach($imagens['name'] as $campo_banco => $infos){

			$nome_imagem = $imagens['name'][$campo_banco];
			$tipo_imagem = $imagens['type'][$campo_banco];
			$tmp_name_imagem = $imagens['tmp_name'][$campo_banco];
			$size_imagem = $imagens['size'][$campo_banco];

			// Renomeia a imagem
			$nome_imagem = md5($nome_imagem.date('H:i:s')).".".self::getExtension($nome_imagem);
			
			// Cria o diretório caso ainda não exista
			if (!file_exists($path)){ 
				mkdir ($path, 0755, true);
			}

			// Caminho completo da imagem
			$pic = $path."/".$nome_imagem;

			// Realiza o upload da imagem
			if (move_uploaded_file($tmp_name_imagem, $pic)) {

				// Ajusta a rotação de fotos JPG
				if (self::getExtension($nome_imagem) == "jpg" || self::getExtension($nome_imagem) == "jpeg") {
					$this->autoRotate($pic);
				}

				// Comprimi a imagem
				$this->comprimi($pic, $pic, self::QUALIDADE);
				
				// Redimensiona imagem
				if ($redimensiona) {					
					$this->redimensiona($pic, $pic, $largura, $altura, $forma_redimensiona);	
				}

				// Thumbnails
				if (!empty($thumbs)) {
					$this->geraThumbs($thumbs, $pic, $nome_imagem, $path);
				}

				// Grava no banco de dados
				if ($grava) {	
					$dados['foto'] = $nome_imagem;
					if (!$this->crud->Insert($dados)) {		
						return "Não foi possível gravar a imagem no banco de dados";
					}
				}

			} else {
				return "Não foi possível realizar o upload da imagem";
			}			
		}

		return true;

	}
}

?>
