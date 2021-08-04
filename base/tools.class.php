<? class Tools{

    // Retorna a data atual
    static function getDate() {
        return date('Y-m-d');
    }

    // Retorna a data e horário atuais
    static function getDateTime() {
        return date('Y-m-d H:i:s');
    }

  //Intervalo entre datas
  static function intervaloDatas ($dtaInicial,$dtaFinal) 
  {
    $arrDatas = array();  
    $start = new \DateTime($dtaInicial);
    $end = new \DateTime($dtaFinal);
    $end->setTime(0,0,1);
    $periodArr = new \DatePeriod($start , new \DateInterval('P1D') , $end);

    foreach($periodArr as $period) {
        $var = $period->format('Y-m-d');
        array_push($arrDatas,$var);
    }
    return $arrDatas;
  }
  
    // recebe data em formato americano e Retorna dia numérico
    static function retornaDia($data){     
      $data_explode = explode('-', $data);
      $dia = $data_explode[2];
      return substr($dia, 0, 2);
    }

    // recebe o ano da data
    static function retornaAno($data){     
      $data_explode = explode('-', $data);
      $ano = $data_explode[0];
      return $ano;
    }

    // recebe data em formato americano e Retorna mes escrito em português 
    static function retornaMes($data){     
        $data_explode = explode('-', $data);
        $mes = $data_explode[1];
        switch ($mes) {
        case "01":    $mes = Janeiro;     break;
        case "02":    $mes = Fevereiro;   break;
        case "03":    $mes = Março;       break;
        case "04":    $mes = Abril;       break;
        case "05":    $mes = Maio;        break;
        case "06":    $mes = Junho;       break;
        case "07":    $mes = Julho;       break;
        case "08":    $mes = Agosto;      break;
        case "09":    $mes = Setembro;    break;
        case "10":    $mes = Outubro;     break;
        case "11":    $mes = Novembro;    break;
        case "12":    $mes = Dezembro;    break; 
        }
        return $mes;
    }

    static function retornaDiaSemana($data){
      $diasSemana = array('Domingo', 'Segunda-feira', 'Terça-feira',  'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
      return $diasSemana[date("w", strtotime($data))];
    }
  
    // Retorna a data passsada no formato BR (DD/MM/AAAA)
    static function formataData($date){
        return date("d/m/Y",strtotime($date));        
    }

    // Retorna a data passsada no formato padrao americado (AAAA/MM/DD)
    static function formataDataBd($date){
        $data = str_replace(" ","",$date);
        $date_r = explode("/",$data);
        $date_bd = $date_r[2]."-".$date_r[1]."-".$date_r[0];
        return $date_bd;
    }

    // Retorna a data e horas passsada no formato BR (DD/MM/AAAA HH:MM:SS)   
    static function formataDataTime($date){
        return date("d/m/Y H:i:s",strtotime($date));        
    }

    // Retorna a quantidade de dias entre duas datas
    static function difData($data_inicial,$data_final){
        $time_inicial = strtotime($data_inicial);
        $time_final = strtotime($data_final);
        $diferenca_dtas = $time_final - $time_inicial;     
        $numero_dias = (int)floor($diferenca_dtas / (60 * 60 * 24));     
        return $numero_dias;
    }

    // Retorna a quantidade de horas entre duas datas
    static function difHoras($data_inicial,$data_final){
        $datatime1 = new DateTime($data_inicial);
        $datatime2 = new DateTime($data_final);
        $data1  = $datatime1->format('Y-m-d H:i:s');
        $data2  = $datatime2->format('Y-m-d H:i:s');
        $diff = $datatime1->diff($datatime2);
        $horas = $diff->h + ($diff->days * 24);
        return $horas;
    }
    
    // Soma uma determinada quantidade de dias a uma data         
    static function somaData($data_inicial, $dias) {     
      $soma_data = date('Y-m-d', strtotime("+".$dias." days",strtotime($data_inicial)));        
      return $soma_data;     
    }

    // Subtrai uma determinada quantidade de dias de uma data         
    static function subData($data_inicial,$dias){     
        $sub_data = date('Y-m-d', strtotime("-".$dias." days",strtotime($data_inicial)));        
        return $sub_data;     
    }

    // Retorna o valor (BANCO) passado em reais (R$)
    static function formataMoeda($valor){        
        return number_format($valor,2,",",".");        
    }       
    
    // Retorna o valor em reais (R$) passado em valor do banco
    static function formataMoedaBd($valor){
        $moeda = str_replace(".","",$valor);    
        $moeda = str_replace(",",".",$moeda);        
        return $moeda;        
    }     
    
    // Preenche com zeros (Cod. pedido)
    static function zeroFill($mStretch, $iLength = 2)
    {
        $sPrintfString = '%0' . (int) $iLength . 's';
        return sprintf($sPrintfString, $mStretch);
    }

    // Gera um hash de uma string de acordo com o tipo passado
    static function geraHash($tipo,$str){        
        if($tipo == "md5"){
            $hash = md5($str);
        }        
        if($tipo == "sha1"){
            $hash = sha1($str); 
        }
        if($tipo == "password"){                
            $options = array(
                'cost' => 7
            );

            $hash = password_hash($str, PASSWORD_BCRYPT, $options);
        }
        return $hash;
    }

    // Remove os caracteres não permitidos de uma string
    static function protege($string){
        $str = strip_tags($string);
        $str = addslashes($str);
        return $str;
    }
    
    // Adiciona 'HTTP' ou 'HTTPS' a uma string      
    static function urlExt($url){
        $url_explode = explode(":",$url);
        if($url_explode[0]!="http" && $url_explode[0]!="https"){
            $url = "http://".$url;
        }        
        return $url;   
    }       
        
    static function wordWrap($string, $chunk_size = 400) {

        $offset = 0;
        $result = array();

        while(preg_match('#<(\w+)[^>]*>.*?</\1>|<\w+[^>]*/>#', $string, $match, PREG_OFFSET_CAPTURE, $offset)) {

            if($match[0][1] > $offset) {

                $non_html = substr($string, $offset, $match[0][1] - $offset);
                $chunks = str_split($non_html, $chunk_size );
                foreach($chunks as $s) {
                    // Wrap text with length 8 in <span>, otherwise leave as it is
                    $result[] = (strlen($s) == $chunk_size  ? "<span>" . $s . "</span>" : $s);
                }

            } 

            // Leave HTML tags untouched
            $result[] = $match[0][0];
            $offset = $match[0][1] + strlen($match[0][0]);
        }

        // Process last unmatched string
        if(strlen($string) > $offset) {
            $non_html = substr($string, $offset);
            $chunks = str_split($non_html, $chunk_size );
            foreach($chunks as $s) {
                $result[] = strlen($s) == $chunk_size  ? "" . $s . "" : $s;
            }
        } 

        return $result;
    }   
    
    // Limita uma string de acordo com o limite passado    
    static function limitarTexto($texto, $limite){        
        if(strlen($texto) > $limite){
            $texto = strip_tags($texto);
            $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
        }        
        $texto = strip_tags($texto);        
        return $texto; 
    }       

    // Cria um arquivo de log
    static function gravaLog($msg, $path, $nome_arquivo){

        $arquivo = fopen($path.'/'.$nome_arquivo,'a');
        fwrite($arquivo,"[".date("r")."] -  $msg\r\n--------------------------------------------------------------------------------------\r\n");
        fclose($arquivo);

    }
    
    // Seleciona o campo SELECT caso os dois alores passados sejam iguais
    static function selected($valor_banco, $valor_select){
        if(isset($valor_banco)){
            if($valor_banco === $valor_select){
                echo "selected";
            }
        }
    }
    
    // Seleciona o campo RADIO/CHECKBOX caso os dois alores passados sejam iguais
    static function checked($valor_banco, $valor_select){
        if(isset($valor_banco)){
            if($valor_banco === $valor_select){
                echo "checked";
            }
        }
    }
    
    // Habilita/Desabilita a exibição de erros de PHP
    static function debug($status){        
        if($status == true){            
            ini_set('display_errors',1);
            ini_set('display_startup_erros',1);
            error_reporting(E_ALL);            
        }else{
            ini_set('display_errors',0);
            ini_set('display_startup_erros',0);
            error_reporting(0);    
        }        
    }   
    
    // Remove o diretório passado
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

    // Copia o diretório passado
    function copiaDir($dirFont, $dirDest){
        if(!file_exists($dirDest)){
            mkdir($dirDest);
        }
        if ($dd = opendir($dirFont)) {
            while (false !== ($arq = readdir($dd))) {
                if($arq != "." && $arq != ".."){
                    $pathIn = "$dirFont/$arq";
                    $pathOut = "$dirDest/$arq";
                    if(is_dir($pathIn)){
                        self::copiaDir($pathIn, $pathOut);
                    }elseif(is_file($pathIn)){
                        copy($pathIn, $pathOut);
                    }
                }
            }
            closedir($dd);
        }
    }

    // Gera uma url amigável
    static function geraSlug($str){
                
        $find = array('á', 'à', 'ã', 'â', 'é', 'ê', 'í', 'ó', 'ô', 'õ', 'ú', 'ü', 'ç', 'Á', 'À', 'Ã', 'Â', 'É', 'Ê', 'Í', 'Ó', 'Ô', 'Õ', 'Ú', 'Ü', 'Ç','&');
        $replace = array('a', 'a', 'a', 'a', 'e', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'c', 'A', 'A', 'A', 'A', 'E', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'C','e');

        $slug = str_replace($find, $replace, $str);
        
        $slug = strtolower($slug);
        $slug = trim($slug);
        $slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
        $slug = preg_replace("/[\s-]+/", " ", $slug);
        $slug = preg_replace("/[\s_]/", "-", $slug);          
               
        return $slug;
            
    }   
    
    // Depura um array ou objeto
    static function dump($data) {
        if(is_array($data)) { 
            print "<pre>-----------------------\n";
            print_r($data);
            print "-----------------------</pre>";
        } elseif (is_object($data)) {
            print "<pre>--------------------\n";
            var_dump($data);
            print "--------------------------</pre>";
        } else {
            print "--------------&gt; ";
            var_dump($data);
            print " &lt;-------------------";
        }
    }     

    // Recarrega a página
    static function reload() {
        echo "<script>location.reload();</script>";
    }

    // Redireciona uma página
    static function redireciona($url) {
        echo "<script>location.href = '".$url."';</script>";
    }

    // Exibe um alerta em JAVASCRIPT
    static function alert($msg) {
        echo "<script>alert('".$msg."');</script>";
    }

    // Somente números
    static function somenteNumeros($valor){
        $var = preg_replace("/[^0-9]/", "", $valor);       
        return $var;
    }

    // Monta uma url com filtros GET removendo campos vazios e não permitidos
    static function montaUrlFiltro($array) {
        $url = "";
        foreach ($array as $key => $value) {
            if($value != "" && $key != "id" && $key != "path" && $key != "pag"){
                $url .= strpos($url, '?') === false ? "?".$key."=".$value : "&".$key."=".$value;
            }  
        }
        return $url;
    }

    // Mensagem de retorno das ações CRUD  
    function alertReturn($template = "", $titulo = "", $texto = "", $tipo = "") {

        $templates = array(
            '0' => array(
                'title' => $titulo,
                'text' => $texto,
                'type' => $tipo
            ),
            '1' => array(
                'title' => 'Cadastrado com sucesso',
                'text' => 'Registro cadastrado com sucesso',
                'type' => 'success'
            ),
            '2' => array(
                'title' => 'Atualizado com sucesso',
                'text' => 'Registro atualizado com sucesso',
                'type' => 'success'
            ),
            '3' => array(
                'title' => 'Removido com sucesso',
                'text' => 'Registro removido com sucesso',
                'type' => 'success'
            ),
            '4' => array(
                'title' => 'Erro na operação',
                'text' => 'Não foi possível realizar essa operação',
                'type' => 'error'
            )
        );

        $alert =    '<script type="text/javascript">
                    $(function(){       
                        new PNotify({
                            title: "'.$templates[$template]['title'].'",
                            text: "'.$templates[$template]['text'].'",
                            type: "'.$templates[$template]['type'].'",
                            styling: "bootstrap3",
                            addclass: "stack-bottomright",
                            stack: {"dir1": "up", "dir2": "left"},
                            animate: {
                              animate: true,
                              in_class: "fadeInRight",
                              out_class: "fadeOutRight"
                            },
                            buttons: {
                              sticker: false,
                              closer_hover: false
                            }
                        });
                    });
                    </script>';
        return $alert;
    }

    // Aplica uma máscara
    static function mask($string, $mascara) {
        $maskared = '';
        $k = 0;
        for($i=0; $i<=strlen($mascara)-1; $i++) {
            if($mascara[$i] == '#') {
                if(isset($string[$k])) {
                    $maskared .= $string[$k++];
                }
            } else {
                if(isset($mascara[$i])) {
                    $maskared .= $mascara[$i];
                }
            }
        }
        return $maskared;
    }

    // Retorno um array com todos estados brasileiros
    static function getEstados() {
    
        $estadosBrasileiros = array(
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        );

        return $estadosBrasileiros;
    
    }

  // Formata data blog
  static function formataDataBlog($data) {
    $mesesArray = array(
      '01' => 'Janeiro',
      '02' => 'Fevereiro',
      '03' => 'Março',
      '04' => 'Abril',
      '05' => 'Maio',
      '06' => 'Junho',
      '07' => 'Julho',
      '08' => 'Agosto',
      '09' => 'Setembro',
      '10' => 'Outubro',
      '11' => 'Novembro',
      '12' => 'Dezembro'
    );
    $dataArray = explode("-", explode(" ", $data)[0]);
    $dia = $dataArray[2];
    $mes = $mesesArray[$dataArray[1]];
    $ano = $dataArray[0];
    return $dia." de ".$mes." de ".$ano;
  }

  // Retorna o range entre duas datas
  static function getRange($dataInicial, $dataFinal) {
    $range = array();
    $dataInicialObj = new DateTime($dataInicial);
    $dataFinalObj = new DateTime($dataFinal);
    while ($dataInicialObj <= $dataFinalObj) {
      $range[] = $dataInicialObj->format('Y-m-d');
      $dataInicialObj = $dataInicialObj->modify('+1day');
    } 
    return $range;
  }

  static function getTimeRange($start, $end, $interval = '30 mins', $format = '24') {
    $startTime = strtotime($start); 
    $endTime   = strtotime($end);
    $returnTimeFormat = ($format == '12')?'g:i A':'G:i';
    $current   = time(); 
    $addTime   = strtotime('+'.$interval, $current); 
    $diff      = $addTime - $current;
    $times = array(); 
    while ($startTime < $endTime) { 
      $times[] = date($returnTimeFormat, $startTime); 
      $startTime += $diff; 
    } 
    $times[] = date($returnTimeFormat, $startTime); 
    return $times; 
  }
}
?>
