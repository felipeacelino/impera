<? include(ACOES_APP_PATH . "/institucionais/institucionais.php"); ?>
<?php
$titulo_pagina = $pagina['titulo_pag']." - " . TITULO_PAGS;
$descr_site = "";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH . '/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH . '/estrutura/header.php'); ?>

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo" style="background-image: url('<?=URL?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara"></span>
    <div class="container">
      <h1 class="titulo" data-aos="fade-up"><?=$pagina['titulo']?></h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PÁGINA -->
  <section class="secao last-secao" data-aos="fade-up">
    <div class="container">

      <div class="grid-8 grid-m-12 grid-s-12 segura-texto">

        <div class="texto center"><p><?=$pagina['texto']?></p></div>

        <!-- FORMULÁRIO -->
        <form id="form-contato" action="<?= URL ?>acoes/app/contato/envia_contato.php" method="post" class="form-validation form-contato">

         <div class="row">
            <div class="grid-6 grid-m-12 grid-s-12 campo-container">
              <label for="nome">Nome</label>
              <input type="text" name="nome" id="nome" maxlength="255" class="campo" placeholder="Digite seu nome" required />
            </div>

            <div class="grid-6 grid-m-12 grid-s-12 campo-container">
              <label for="email">E-mail</label>
              <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite seu e-mail" required />
            </div>
          </div>

          <div class="row">
            <div class="grid-6 grid-m-12 grid-s-12 campo-container">
              <label for="telefone">Telefone</label>
              <input type="tel" name="telefone" id="telefone" maxlength="255" class="campo telefone" placeholder="Digite seu telefone" required />
            </div>

            <div class="grid-6 grid-m-12 grid-s-12 campo-container">
              <label for="assunto">Assunto</label>
              <input type="text" name="assunto" id="assunto" maxlength="255" class="campo" placeholder="Digite um assunto" value="<?= $_GET['assunto'] ?>" required />
            </div>
          </div>

          <div class="campo-container">
            <label for="mensagem">Mensagem</label>
            <textarea name="mensagem" id="mensagem" maxlength="1000" class="campo" rows="4" placeholder="Como podemos ajudar?" required><?= $_GET['msg'] ?></textarea>
          </div>

          <div class="recaptcha-container">
            <div class="recaptcha-el" data-form="form-contato" data-key="<?=RECAPTCHA_KEY?>"></div>
          </div>

          <div class="btn-container">
            <button type="submit" id="enviar" class="btn btn-primario btn-pulse">Enviar</button>
          </div> 

        </form>
        <!-- //FORMULÁRIO -->

      </div>

    </div>
  </section>
  <!-- //PÁGINA -->

  <!-- FOOTER -->
  <? include(APP_PATH . '/estrutura/footer.php'); ?>

</body>

</html>
