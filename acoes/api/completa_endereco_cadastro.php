<?php
include ("../../paths.php");
include ("".BASE_PATH."/base.class.php");
include ("".BASE_PATH."/init.class.php");
include ("".BASE_PATH."/tools.class.php");
include ("".BASE_PATH."/crud.class.php");
include ("".CONF_PATH."/conf.php");
include ("".CLASS_PATH."/completaEndereco.class.php");

if (isset($_POST['cep']) && $_POST['cep'] != "") {
  $cep = Tools::somenteNumeros($_POST['cep']);
  if ($cep != "") {
    $endereco = CompletaEndereco::getEndereco($cep);
    if (json_decode($endereco)) {
      $endereco = json_decode($endereco, true);

      $disponivel = 1;
      $bloqueado = 0;

      // Obtém o ID do estado
      $resultEstadoId = $conexao->prepare("SELECT id FROM estados WHERE uf=:uf LIMIT 1");
      $resultEstadoId->bindValue(':uf', $endereco['uf'], PDO::PARAM_STR);
      $resultEstadoId->execute();
      $numEstadoId = $resultEstadoId->rowCount();
      $estadoId = $resultEstadoId->fetch(PDO::FETCH_ASSOC);
      $endereco['estado_id'] = $estadoId['id'];
      if ($numEstadoId == 0) {
        $disponivel = 0;
      }
      
      // Obtém o ID da cidade
      $resultCidadeId = $conexao->prepare("SELECT id FROM cidades WHERE titulo=:titulo AND estado_id=:estado_id LIMIT 1");
      $resultCidadeId->bindValue(':titulo', $endereco['cidade'], PDO::PARAM_STR);
      $resultCidadeId->bindValue(':estado_id', $estadoId['id'], PDO::PARAM_INT);
      $resultCidadeId->execute();
      $numCidadeId = $resultCidadeId->rowCount();
      $cidadeId = $resultCidadeId->fetch(PDO::FETCH_ASSOC);
      $endereco['cidade_id'] = $cidadeId['id'];
      if ($numCidadeId == 0) {
        $disponivel = 0;
      }

      // Obtém o ID do bairro
      $resultBairroId = $conexao->prepare("SELECT id FROM bairros WHERE titulo=:titulo AND cidade_id=:cidade_id LIMIT 1");
      $resultBairroId->bindValue(':titulo', $endereco['bairro'], PDO::PARAM_STR);
      $resultBairroId->bindValue(':cidade_id', $cidadeId['id'], PDO::PARAM_INT);
      $resultBairroId->execute();
      $numBairroId = $resultBairroId->rowCount();
      $bairroId = $resultBairroId->fetch(PDO::FETCH_ASSOC);
      $endereco['bairro_id'] = $bairroId['id'];
      if ($numBairroId == 0) {
        $disponivel = 0;
      }

      // Verifica se o endereço está bloqueado
      $resultBloqueado = $conexao->prepare("SELECT id FROM enderecos_bloqueados WHERE cep=:cep OR (slug=:slug AND bairro_id=:bairro_id)");
      $resultBloqueado->bindValue(':cep', $endereco['cep'], PDO::PARAM_STR);
      $resultBloqueado->bindValue(':slug', Tools::geraSlug($endereco['logradouro']), PDO::PARAM_STR);
      $resultBloqueado->bindValue(':bairro_id', $endereco['bairro_id'], PDO::PARAM_INT);
      $resultBloqueado->execute();
      $numBloqueado = $resultBloqueado->rowCount();
      if ($numBloqueado > 0) {
        $bloqueado = 1;
      }

      $endereco['disponivel'] = $disponivel;
      $endereco['bloqueado'] = $bloqueado;

      echo json_encode($endereco);
    } else {
      echo $endereco;
    }
  } else {
    echo "Informe um CEP.";
  }
}
