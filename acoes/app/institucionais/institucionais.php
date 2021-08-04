<?php

$pagInst = $param1;

// Para obter o banner da institucional para a de login/cadastro
if ($param1 === "proprietario" && ($param2 == "criar-conta" || $param2 == "entrar" || $param2 == "cadastrar-senha")) {
  $pagInst = "para-voce-proprietario";
}
if ($param1 === "corretor" && ($param2 == "criar-conta" || $param2 == "entrar" || $param2 == "cadastrar-senha")) {
  $pagInst = "para-voce-corretor";
}

// Página de ajuda dentro da área restrita
if ($param1 === "proprietario" && $param2 === "ajuda") {
  $pagInst = "proprietario-ajuda";
}
if ($param1 === "cliente" && $param2 === "ajuda") {
  $pagInst = "cliente-ajuda";
}
if ($param1 === "corretor" && $param2 === "ajuda") {
  $pagInst = "corretor-ajuda";
}

// PÁGINAS INSTITUCIONAIS
$resultInstitucionais = $conexao->prepare("SELECT * FROM paginas WHERE pagina=:pagina");
$resultInstitucionais->bindValue(":pagina", $pagInst, PDO::PARAM_STR);
$resultInstitucionais->execute();
$numInstitucionais = $resultInstitucionais->rowCount();
$pagina = $resultInstitucionais->fetch(PDO::FETCH_ASSOC);

if ($numInstitucionais > 0) {
  // FOTOS
  $resultPagFotos = $conexao->prepare("SELECT * FROM paginas_fotos WHERE pagina_id=:pagina_id ORDER BY destaque DESC, id ASC");
  $resultPagFotos->bindValue(":pagina_id", $pagina['id'], PDO::PARAM_INT);
  $resultPagFotos->execute();
  $numPagFotos = $resultPagFotos->rowCount();
  $pagFotos = $resultPagFotos->fetchAll(PDO::FETCH_ASSOC);

  // BLOCOS
  $resultPagBlocos = $conexao->prepare("SELECT * FROM paginas_blocos WHERE pagina_id=:pagina_id AND status=1 ORDER BY ordem_exibicao ASC");
  $resultPagBlocos->bindValue(":pagina_id", $pagina['id'], PDO::PARAM_INT);
  $resultPagBlocos->execute();
  $numPagBlocos = $resultPagBlocos->rowCount();
  $pagBlocos = $resultPagBlocos->fetchAll(PDO::FETCH_ASSOC);

  // ÍCONES
  $resultPagIcons = $conexao->prepare("SELECT * FROM paginas_icones WHERE pagina_id=:pagina_id AND status=1 ORDER BY ordem_exibicao ASC");
  $resultPagIcons->bindValue(":pagina_id", $pagina['id'], PDO::PARAM_INT);
  $resultPagIcons->execute();
  $numPagIcons = $resultPagIcons->rowCount();
  $pagIcons = $resultPagIcons->fetchAll(PDO::FETCH_ASSOC);

  // PERGUNTAS
  $resultPagFaq = $conexao->prepare("SELECT * FROM paginas_faq WHERE pagina_id=:pagina_id AND status=1 ORDER BY ordem_exibicao ASC");
  $resultPagFaq->bindValue(":pagina_id", $pagina['id'], PDO::PARAM_INT);
  $resultPagFaq->execute();
  $numPagFaq = $resultPagFaq->rowCount();
  $pagFaq = $resultPagFaq->fetchAll(PDO::FETCH_ASSOC); 

  //==================================================//
  //                 PÁGINA CORRETOR                  //
  //==================================================//
  if ( $pagina['id'] == "6") {
    // BLOCO CORRETOR 1
    $resultBlCor1 = $conexao->prepare('SELECT * FROM paginas WHERE id=10 LIMIT 1');
    $resultBlCor1->execute();
    $blCor1 = $resultBlCor1->fetch(PDO::FETCH_ASSOC);

    // BLOCO CORRETOR 2
    $resultBlCor2 = $conexao->prepare('SELECT * FROM paginas WHERE id=11 LIMIT 1');
    $resultBlCor2->execute();
    $blCor2 = $resultBlCor2->fetch(PDO::FETCH_ASSOC);

    // BLOCO CORRETOR 3
    $resultBlCor3 = $conexao->prepare('SELECT * FROM paginas WHERE id=12 LIMIT 1');
    $resultBlCor3->execute();
    $blCor3 = $resultBlCor3->fetch(PDO::FETCH_ASSOC);
  }

  //==================================================//
  //               PÁGINA PROPRIETÁRIO                //
  //==================================================//
  if ( $pagina['id'] == "7") {
    // VANTAGENS
    $resultPropVants = $conexao->prepare('SELECT * FROM paginas WHERE id=18 LIMIT 1');
    $resultPropVants->execute();
    $propVants = $resultPropVants->fetch(PDO::FETCH_ASSOC);
  }

  //==================================================//
  //                 PÁGINA AFILIADO                  //
  //==================================================//
  if ( $pagina['id'] == "8") {
    // COMISSÕES
    $resultAfCom = $conexao->prepare('SELECT * FROM paginas WHERE id=19 LIMIT 1');
    $resultAfCom->execute();
    $afCom = $resultAfCom->fetch(PDO::FETCH_ASSOC);
  }

  //==================================================//
  //                 ENVIAR DOCUMENTOS                //
  //==================================================//
  if ( $pagina['id'] == "20") {
    // BENEFÍCIOS
    $resultDocsBen = $conexao->prepare('SELECT * FROM paginas WHERE id=21 LIMIT 1');
    $resultDocsBen->execute();
    $docsBen = $resultDocsBen->fetch(PDO::FETCH_ASSOC);

    // DOCUMENTOS
    $resultPgDocs = $conexao->prepare('SELECT * FROM paginas WHERE id=24 LIMIT 1');
    $resultPgDocs->execute();
    $pgDocs = $resultPgDocs->fetch(PDO::FETCH_ASSOC);
  }

  //==================================================//
  //             QUAIS DOCUMENTOS ENVIAR              //
  //==================================================//
  if ( $pagina['id'] == "24") {
    // PÁGINA (COMPRAR)
    $resultPgFaqInfo1 = $conexao->prepare('SELECT * FROM paginas WHERE id=22 LIMIT 1');
    $resultPgFaqInfo1->execute();
    $pgFaqInfo1 = $resultPgFaqInfo1->fetch(PDO::FETCH_ASSOC);

    // PERGUNTAS (COMPRAR)
    $resultPagFaq1 = $conexao->prepare("SELECT * FROM paginas_faq WHERE pagina_id=22 AND status=1 ORDER BY ordem_exibicao ASC");
    $resultPagFaq1->execute();
    $numPagFaq1 = $resultPagFaq1->rowCount();
    $pagFaq1 = $resultPagFaq1->fetchAll(PDO::FETCH_ASSOC); 

    // PÁGINA (ALUGAR)
    $resultPgFaqInfo2 = $conexao->prepare('SELECT * FROM paginas WHERE id=23 LIMIT 1');
    $resultPgFaqInfo2->execute();
    $pgFaqInfo2 = $resultPgFaqInfo2->fetch(PDO::FETCH_ASSOC);

    // PERGUNTAS (ALUGAR)
    $resultPagFaq2 = $conexao->prepare("SELECT * FROM paginas_faq WHERE pagina_id=23 AND status=1 ORDER BY ordem_exibicao ASC");
    $resultPagFaq2->execute();
    $numPagFaq2 = $resultPagFaq2->rowCount();
    $pagFaq2 = $resultPagFaq2->fetchAll(PDO::FETCH_ASSOC);
  }
}
