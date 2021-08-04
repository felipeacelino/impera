<? include(ACOES_APP_PATH."/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = $pagina['titulo']." - ".TITULO_PAGS;
$descr_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BANNER -->
  <section class="banner-inst" style="background-image: url('<?=URL?>uploads/img/paginas/<?=$pagina['id']?>/thumb-2000-0/<?=$pagina['banner']?>');">
    <span class="mascara"></span>
    <div class="container">
      <div class="grid-10 grid-m-12 grid-s-12 segura-texto" data-aos="fade-up">
        <h1 class="titulo"><?=$pagina['titulo']?></h1>
        <h2 class="subtitulo"><?=$pagina['subtitulo']?></h2>
        <h3 class="texto"><?=$pagina['subtitulo2']?></h3>
        <div class="btn-container">
          <a href="<?=URL?>contato" class="btn btn-white">Fale Conosco</a>
        </div>
      </div>
    </div>
  </section>
  <div class="section-divider sd-m8">
    <div class="section-divider-inner">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
      </svg>
    </div>
  </div>
  <!-- //BANNER -->

  <!-- INSTITUCIONAL -->
  <section class="secao">
    <div class="container">

      <div class="border-bottom" data-aos="fade-up" data-aos-offset="0">

        <div class="grid-5 grid-m-12 grid-s-12">
          <div class="titulo">Quero Comprar</div>
        </div>

        <div class="grid-7 grid-m-12 grid-s-12 segura-btns-ajuda">

          <div style="float: left;width: 100%;justify-content: center;display: flex;flex-wrap: wrap;">

            <a href="" class="btn btn-primario outline">Quero Comprar</a>
            <a href="" class="btn btn-primario outline">Contato</a>
            <a href="" class="btn btn-primario outline">Propostas</a>
            <a href="" class="btn btn-primario outline">Pagamento</a>
            <a href="" class="btn btn-primario outline">Enviar Documentos</a>
            <a href="" class="btn btn-primario outline">Documentação do Imóvel</a>
            <a href="" class="btn btn-primario outline">Análise de Crédito</a>

          </div>

        </div>

      </div>

      <div class="border-bottom" data-aos="fade-up">

        <div class="grid-5 grid-m-12 grid-s-12">
          <div class="titulo">Quero Alugar</div>
        </div>

        <div class="grid-7 grid-m-12 grid-s-12 segura-btns-ajuda">

          <div style="float: left;width: 100%;justify-content: center;display: flex;flex-wrap: wrap;">

            <a href="" class="btn btn-primario outline">Quero Alugar</a>
            <a href="" class="btn btn-primario outline">Pagamento</a>
            <a href="" class="btn btn-primario outline">Envio de Documentos</a>
            <a href="" class="btn btn-primario outline">Recebimento de Chaves</a>
            <a href="" class="btn btn-primario outline">Análise de Crédito</a>
            <a href="" class="btn btn-primario outline">Deveres do Inquilino</a>
            <a href="" class="btn btn-primario outline">Contrato e Vistoria</a>
          </div>

        </div>

      </div>

      <div class="border-bottom" data-aos="fade-up">

        <div class="grid-5 grid-m-12 grid-s-12">
          <div class="titulo">Sou Proprietário</div>
        </div>

        <div class="grid-7 grid-m-12 grid-s-12 segura-btns-ajuda">
          <a href="" class="btn btn-primario outline">Quero Anunciar</a>
          <a href="" class="btn btn-primario outline">Pagamento</a>
          <a href="" class="btn btn-primario outline">Visitas e Propostas</a>
          <a href="" class="btn btn-primario outline">Rescisão do Contrato</a>
          <a href="" class="btn btn-primario outline">Documentação do Imóvel</a>
          <a href="" class="btn btn-primario outline">Deveres do Proprietário</a>
        </div>

      </div>

      <div class="border-bottom" data-aos="fade-up">

        <div class="grid-5 grid-m-12 grid-s-12">
          <div class="titulo">Sou Corretor</div>
        </div>

        <div class="grid-7 grid-m-12 grid-s-12 segura-btns-ajuda">
          <a href="" class="btn btn-primario outline">Quero me Cadastrar</a>
          <a href="" class="btn btn-primario outline">Corretor de Locação</a>
          <a href="" class="btn btn-primario outline">Visitas</a>
          <a href="" class="btn btn-primario outline">Comissionamento</a>
          <a href="" class="btn btn-primario outline">Benefícios de ser Parceiro</a>
          <a href="" class="btn btn-primario outline">Pagamento</a>
          <a href="" class="btn btn-primario outline">Corretor de Venda</a>
          <a href="" class="btn btn-primario outline">Sobre a Parceria</a>
          <a href="" class="btn btn-primario outline">Corretor de Planta</a>
          <a href="" class="btn btn-primario outline">Política de Vínculo</a>
        </div>

      </div>

      <div class="border-bottom" data-aos="fade-up">

        <div class="grid-5 grid-m-12 grid-s-12">
          <div class="titulo">Quero indicar</div>
        </div>

        <div class="grid-7 grid-m-12 grid-s-12 segura-btns-ajuda">
          <a href="" class="btn btn-primario outline">Quero ser um Afiliado</a>
          <a href="" class="btn btn-primario outline">Como Divulgar</a>
          <a href="" class="btn btn-primario outline">Benefícios de ser Afiliado</a>
          <a href="" class="btn btn-primario outline">Comissionamento</a>
        </div>

      </div>

      <div class="border-bottom" data-aos="fade-up">

        <div class="grid-5 grid-m-12 grid-s-12">
          <div class="titulo">Impera Real</div>
        </div>

        <div class="grid-7 grid-m-12 grid-s-12 segura-btns-ajuda">

          <div style="float: left;width: 100%;justify-content: center;display: flex;flex-wrap: wrap;">
            <a href="" class="btn btn-primario outline">Quem Somos</a>
            <a href="" class="btn btn-primario outline">Contato</a>
            <a href="" class="btn btn-primario outline">Região de Atuação</a>
            <a href="" class="btn btn-primario outline">Propostas e Contratos</a>
            <a href="" class="btn btn-primario outline">Nosso Blog</a>
          </div>

        </div>

      </div>


    </div>
  </section>
  <!-- //INSTITUCIONAL -->

  <!-- DESTAQUES (ÍCONES) -->
  <? if ($numPagIcons > 0) { ?>
  <section class="secao blocos-home" style="background-image: url('<?=URL_APP?>/assets/dist/img/bg_blocos.jpg');">
    <span class="mascara"></span>
    <div class="container">
      <div class="grid-12"><h2 class="titulo">Ganhe uma renda extra!</h2></div>
      <ul class="inst-icons">
        <? foreach ($pagIcons as $icon) { ?>
          <li class="grid-4 grid-m-6 grid-s-12 inst-icon" data-aos="zoom-in">
            <figure class="inst-icon-foto">
              <? if ($icon['icone'] != "") { ?>
                <i class="<?=$icon['icone']?>"></i>
              <? } else { ?>
                <img src="<?=URL?>uploads/img/paginas_icones/<?=$icon['id']?>/thumb-250-250/<?=$icon['foto']?>" alt="<?=$icon['titulo']?>">
              <? } ?>
            </figure>
            <div class="inst-icon-infos">
              <h3><?=$icon['titulo']?></h3>
              <? if ($icon['texto'] != "") { ?>
                <div class="texto"><?=$icon['texto']?></div>
              <? } ?>
            </div>
          </li>
        <? } ?>
      </ul>
    </div>
  </section>
  <? } ?>
  <!-- //DESTAQUES -->

  <!-- PERGUNTAS -->
  <? if ($numPagFaq > 0) { ?>
  <section id="pag-faq" class="secao inst-faq">
    <div class="container">
      <div class="grid-12"><h2 class="titulo">Perguntas Frequentes</h2></div>
      <div class="grid-8 grid-m-12 grid-s-12 segura-texto faq-lista">
        <? foreach ($pagFaq as $faq) { ?>
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
  </section>
  <? } ?>
  <!-- //PERGUNTAS -->

  <!-- FOOTER -->
  <? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
