<?php
$titulo = $param3 == "update" ? "Editar Imóvel" : "Cadastrar Imóvel";
$botao = $param3 == "update" ? "Atualizar" : "Continuar";
$acao = $param3 == "update" ? "update" : "insert";
$paramRetorno = $param3 == "update" ? "upd-success" : "cad-success";

// CIDADES GERAL
$resultCidadesCad = $conexao->prepare(
  "SELECT
    c.*
  FROM cidades AS c
  WHERE
    c.estado_id=19
  ORDER BY c.titulo ASC"
);
$resultCidadesCad->execute();
$numCidadesCad = $resultCidadesCad->rowCount();
$cidadesCad = $resultCidadesCad->fetchAll(PDO::FETCH_ASSOC);

// TIPOS
$tiposCad = $confs->SelectSQL("SELECT * FROM anuncios_tipos WHERE status = 1 ORDER BY ordem_exibicao ASC");
foreach ($tiposCad as $tipoK => $tipoV) {
  $tipoID = $tipoV['id'];
  $itensTiposCad = $confs->SelectSQL("SELECT * FROM anuncios_tipos_itens WHERE status = 1 AND tipo_id=$tipoID ORDER BY ordem_exibicao ASC");
  $tiposCad[$tipoK]['itens'] = $itensTiposCad;
}

// REGIÕES
$regioesCad = $confs->SelectSQL("SELECT * FROM anuncios_regioes WHERE status=1 ORDER BY ordem_exibicao, titulo ASC");

// CARACTERÍSTICAS
$caracteristicasCad = $confs->SelectSQL("SELECT * FROM anuncios_caracteristicas WHERE status=1 ORDER BY ordem_exibicao ASC");

// CÔMODOS
$comodosCad = $confs->SelectSQL("SELECT * FROM anuncios_comodos WHERE status=1 ORDER BY ordem_exibicao ASC");

// CONDOMÍNIO
$condominioCad = $confs->SelectSQL("SELECT * FROM anuncios_condominio WHERE only_admin=0 AND status=1 ORDER BY ordem_exibicao ASC");

// MOBÍLIAS
$mobiliasCad = $confs->SelectSQL("SELECT * FROM anuncios_mobilias WHERE status=1 ORDER BY ordem_exibicao ASC");

// COMODIDADES
$comodidadesCad = $confs->SelectSQL("SELECT * FROM anuncios_comodidades WHERE status=1 ORDER BY ordem_exibicao ASC");

// SEGURANÇA
$segurancaCad = $confs->SelectSQL("SELECT * FROM anuncios_seguranca WHERE status=1 ORDER BY ordem_exibicao ASC");

// LAZER
$lazerCad = $confs->SelectSQL("SELECT * FROM anuncios_lazer WHERE status=1 ORDER BY ordem_exibicao ASC");

// CÔMODOS (COMERCIAL)
$comodos2Cad = $confs->SelectSQL("SELECT * FROM anuncios_comodos2 WHERE status=1 ORDER BY ordem_exibicao ASC");

// UPDATE
if ($acao == "update") {

  $anuncios = new Crud('imoveis');

  $idAnuncio = Tools::somenteNumeros($param4);
  $idUser = (int) $user['id'];

  // Anúncio
  $sqlAnuncio = "SELECT * FROM anuncios WHERE id='$idAnuncio' AND id_usuario='$idUser' LIMIT 1";
  $anuncio = $anuncios->SelectSingle($sqlAnuncio);

  if ($anuncio == "") {
    Tools::redireciona(URL."proprietario/inicio");
  }

  // Cômodos
  $comodosAtuais = $conexao->prepare("SELECT comodo_id FROM anuncios_comodos_n_n WHERE anuncio_id=:anuncio_id");
  $comodosAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $comodosAtuais->execute();
  $comodosAtuais = $comodosAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Detalhes do imóvel
  $caracteristicasAtuais = $conexao->prepare("SELECT caracteristica_id FROM anuncios_caracteristicas_n_n WHERE anuncio_id=:anuncio_id");
  $caracteristicasAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $caracteristicasAtuais->execute();
  $caracteristicasAtuais = $caracteristicasAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Detalhes do condomínio
  $condominioAtuais = $conexao->prepare("SELECT condominio_id FROM anuncios_condominio_n_n WHERE anuncio_id=:anuncio_id");
  $condominioAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $condominioAtuais->execute();
  $condominioAtuais = $condominioAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Mobílias e eletros
  $mobiliasAtuais = $conexao->prepare("SELECT mobilia_id FROM anuncios_mobilias_n_n WHERE anuncio_id=:anuncio_id");
  $mobiliasAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $mobiliasAtuais->execute();
  $mobiliasAtuais = $mobiliasAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Comodidades
  $comodidadesAtuais = $conexao->prepare("SELECT comodidade_id FROM anuncios_comodidades_n_n WHERE anuncio_id=:anuncio_id");
  $comodidadesAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $comodidadesAtuais->execute();
  $comodidadesAtuais = $comodidadesAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Segurança
  $segurancaAtuais = $conexao->prepare("SELECT seguranca_id FROM anuncios_seguranca_n_n WHERE anuncio_id=:anuncio_id");
  $segurancaAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $segurancaAtuais->execute();
  $segurancaAtuais = $segurancaAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Lazer e esporte
  $lazerAtuais = $conexao->prepare("SELECT lazer_id FROM anuncios_lazer_n_n WHERE anuncio_id=:anuncio_id");
  $lazerAtuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $lazerAtuais->execute();
  $lazerAtuais = $lazerAtuais->fetchAll(PDO::FETCH_COLUMN);

  // Cômodos (Comercial)
  $comodos2Atuais = $conexao->prepare("SELECT comodo2_id FROM anuncios_comodos2_n_n WHERE anuncio_id=:anuncio_id");
  $comodos2Atuais->bindValue(':anuncio_id', $idAnuncio, PDO::PARAM_INT);
  $comodos2Atuais->execute();
  $comodos2Atuais = $comodos2Atuais->fetchAll(PDO::FETCH_COLUMN);

}


