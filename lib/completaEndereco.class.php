<?php

class CompletaEndereco {

    // Retorna o endereço
	static function getEndereco($cep, $retorno = "json") {
				
		$url = "http://www.buscarcep.com.br/?cep=".$cep."&formato=xml&chave=1C/qnlVW&identificador=5393";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_ENCODING, "utf-8");
		$result = curl_exec($curl);
		$result = simplexml_load_string($result);

		// Verifica se foi obtido algum resultado
		if ($result && $result->quantidade == 1) {

			$status = (string) $result->retorno[0]->resultado;

			// Verifica se não há erros
			if ($status == '1') {
				
				$parte1cep = substr((string)$result->retorno[0]->cep,0,5);
				$parte2cep = substr((string)$result->retorno[0]->cep,5,8);
				$tipo_logradouro = (string)$result->retorno[0]->tipo_logradouro;
				$logradouro = (string)$result->retorno[0]->logradouro;
				$logradouro_completo = $tipo_logradouro." ".$logradouro;
				$bairro = (string)$result->retorno[0]->bairro;
				$cidade = (string) $result->retorno[0]->cidade;
				$uf = (string) $result->retorno[0]->uf;
			
				$endereco = array(
					'logradouro' => $logradouro_completo,
					'bairro' => $bairro,
					'cidade' => $cidade,
					'uf' => $uf,
					'cep' => $parte1cep.$parte2cep
				);
				
				// Retorno JSON
				if ($retorno == 'json') {

					return json_encode($endereco);
					
				} 
				// Retorno ARRAY
				else if ($retorno == 'array') {

					return $endereco;

				}
			} 

			// Exibe o erro
			else {
				return self::getError($status);
			}
			
		} else {			
			return false;
		}
	}

	// Retorna a mensagem do erro passado
	function getError($error) {
		switch ($error) {
			case '-1':
				return "CEP não encontrado.";
				break;
			
			case '-2':
				return "Formato de CEP inválido.";
				break;
			
			case '-3':
				return "Limite de buscas de ip por minuto excedido.";
				break;
			
			case '-4':
				return "IP banido. Contate o administrador.";
				break;
			
			case '-5':
				return "Chave banida. Contate o administrador.";
				break;

			case '-6':
				return "Entre 0 e 6 horas da madrugada todas as buscas são limitadas a 5 buscas por minuto.";
				break;
			
			case '-7':
				return "chave inválida. Cadastre-se para continuar utilizando o serviço.";
				break;

			case '-8':
				return "Chave inativa.";
				break;

			case '-9':
				return "Realize upgrade de sua chave.";
				break;

			case '-10':
				return "Sem créditos para pesquisa. Aguardando confirmação de pagamento.";
				break;
			
			case '-11':
				return "Muitos resultados. Seja mais espefícico.";
				break;
		}
	}
}