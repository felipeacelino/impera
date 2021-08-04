<? include(ACOES_APP_PATH . "/blog/posts.php"); ?>
<?php
$titulo_pagina = "Blog - " . TITULO_PAGS;
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH . '/estrutura/head.php'); ?>

<body>

  <!-- HEADER -->
  <? include(APP_PATH . '/estrutura/header.php'); ?>

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo" style="background-image: url('<?= URL ?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara default"></span>
    <div class="container">
      <h1 class="titulo" data-aos="fade-up">Blog</h1>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->

  <!-- PÁGINA -->
  <section class="secao bg-fundo2">
    <div class="container">

      <!-- LISTAGEM -->
      <? if ($numPosts > 0) { ?>
        <div class="lista-posts">

          <div style="display: flex; flex-wrap: wrap; justify-content: center;">
          
            <? foreach ($posts as $post) { ?>

              <!-- Repete -->
              <a href="<?= URL ?>post/<?= $post['url_amigavel'] ?>" class="grid-4 grid-m-6 grid-s-12 bloco-post" data-aos="fade-up">
                <figure class="bloco-post-foto">
                  <img src="<?= URL ?>uploads/img/blog_posts/<?= $post['id'] ?>/thumb-500-350/<?= $post['foto'] ?>" alt="<?= $post['titulo'] ?>">
                </figure>
                <div class="bloco-post-infos">
                  <div class="bloco-post-data"><?= Tools::formataDataBlog($post['data_exibe']) ?></div>
                  <h2 class="bloco-post-titulo"><?= $post['titulo'] ?></h2>
                  <div class="bloco-post-link">Ler mais →</div>
                </div>
              </a>
              <!-- //Repete -->

            <? } ?>

          </div>

          <!-- PAGINAÇÃO -->
          <? $blog->Pagination($url_paginacao); ?>

        </div>
        <!-- //LISTAGEM -->

      <? } else { ?>

        <!-- SEM REGISTROS -->
        <div class="grid-12 empty">
          <span>Nenhuma publicação encontrada.</span>
        </div>

      <? } ?>

    </div>
  </section>
  <!-- //PÁGINA -->

  <!-- FOOTER -->
  <? include(APP_PATH . '/estrutura/footer.php'); ?>

</body>

</html>
