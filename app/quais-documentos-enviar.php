<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = $pagina['titulo_pag']." - ".TITULO_PAGS;
$descr_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo with-btn" style="background-image: url('<?=URL?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara"></span>
    <div class="container">
      <a href="<?=URL?>enviar-documentos" class="btn btn-white pag-btn-back"><i class="fas fa-arrow-left"></i></a>
      <div class="grid-7 grid-m-12 grid-s-12 segura-texto">
        <h1 class="titulo" data-aos="fade-up"><?=$pagina['titulo']?></h1>
        <div class="btn-container">
          <a href="<?=URL?>cliente/documentos" class="btn btn-white link-restrito" data-logado="<?=$_SESSION['user']['cliente']['id']?>" data-area="cliente">Enviar Documentos</a>
        </div>
      </div>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- DOCUMENTOS -->
  <section class="secao">
    <div class="container">
      <div class="grid-12" data-aos="fade-up">
        <ul class="blocos-faq">

          <!-- COMPRAR -->
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$pgFaqInfo1['id']?>/thumb-250-0/<?=$pgFaqInfo1['foto']?>" alt="<?=$pgFaqInfo1['titulo']?>"></figure>
                <h2><?=$pgFaqInfo1['titulo']?></h2>
              </div>
              <div class="faq-lista">
                <? foreach ($pagFaq1 as $faq) { ?>
                  <!-- Repete -->
                  <div class="faq" data-aos="fade-up">
                    <div class="faq-pergunta"><i></i> <?=$faq['titulo']?></div>
                    <div class="faq-resposta">
                      <div class="texto"><?=$faq['texto']?></div>
                    </div>
                  </div>
                  <!-- //Repete -->
                <? } ?>
              </div>
            </div>
          </li>
          
          <!-- ALUGAR -->
          <li class="grid-6 grid-m-12 grid-s-12 bloco-faq">
            <div>
              <div class="bloco-faq-tit">
                <figure><img src="<?=URL?>uploads/img/paginas/<?=$pgFaqInfo2['id']?>/thumb-250-0/<?=$pgFaqInfo2['foto']?>" alt="<?=$pgFaqInfo2['titulo']?>"></figure>
                <h2><?=$pgFaqInfo2['titulo']?></h2>
              </div>
              <div class="faq-lista">
                <? foreach ($pagFaq2 as $faq) { ?>
                  <!-- Repete -->
                  <div class="faq" data-aos="fade-up">
                    <div class="faq-pergunta"><i></i> <?=$faq['titulo']?></div>
                    <div class="faq-resposta">
                      <div class="texto"><?=$faq['texto']?></div>
                    </div>
                  </div>
                  <!-- //Repete -->
                <? } ?>
              </div>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </section>
  
  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
