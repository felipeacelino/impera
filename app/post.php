<? include(ACOES_APP_PATH."/blog/detalhe.php"); ?>
<?php
$titulo_pagina = $post['titulo']." - ".TITULO_PAGS;
$descr_site = $post['description'] != "" ? $post['description'] : Tools::limitarTexto($post['texto'], 160);

$og_title = $post['titulo'];
$og_description = $descr_site;
$og_image = URL."uploads/img/blog_posts/".$post['id']."/".$post['foto'];
$og_url = URL."post/".$post['url_amigavel'];
$canonical = $og_url;
$og_type = "article";
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- HEAD -->
<? include(APP_PATH.'/estrutura/head.php'); ?>

<body>

	<!-- HEADER -->
  <? include(APP_PATH.'/estrutura/header.php'); ?>

  <!-- BANNER TÍTULO -->
  <section class="banner-titulo" style="background-image: url('<?=URL?>app/assets/dist/img/bg_banner_tit.jpg');">
    <span class="mascara default"></span>
    <div class="container">
      <div class="grid-9 grid-m-12 grid-s-12 segura-texto">
        <h2 class="titulo" data-aos="fade-up">Blog</h2>
      </div>
    </div>
  </section>
  <!-- //BANNER TÍTULO -->
  
  <!-- PÁGINA -->
  <section class="secao last-secao">
    <div class="container">

      <!-- POST DETALHE -->
      <div class="grid-9 grid-m-12 grid-s-12 segura-texto post-detalhe" data-aos="fade-up">
        
        <h1 class="post-detalhe-titulo"><?=$post['titulo']?></h1>

        <div class="row">

          <!-- DATA/AUTOR -->
          <div class="grid-6 grid-s-12 post-detalhe-data">
            Por <b><?=$post['autor']?></b> em <b><?=Tools::formataDataBlog($post['data_exibe'])?></b>
          </div>

          <!-- COMPARTILHAMENTO -->
          <div class="grid-6 grid-s-12 post-detalhe-share">
            <div class="share">
              <div class="share-text">Compartilhar</div>
              <div class="share-buttons">
                <a href="#" target="_blank" rel="nofollow" class="share-button facebook" title="Compartilhar no Facebook"><i class="fab fa-facebook-square"></i></a>
                <a href="#" target="_blank" rel="nofollow" class="share-button twitter" title="Compartilhar no Twitter"><i class="fab fa-twitter-square"></i></a>
                <a href="#" target="_blank" rel="nofollow" class="share-button whatsapp" title="Compartilhar no WhatsApp"><i class="fab fa-whatsapp-square"></i></a>
                <a href="#" target="_blank" rel="nofollow" class="share-button linkedin" title="Compartilhar no LinkedIn"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="share-button copy-link" title="Copiar link"><i class="fas fa-link fa-flip-horizontal"></i></a>
              </div>
            </div>
          </div>
          <!-- //COMPARTILHAMENTO -->

        </div>

        <!-- FOTO -->	
        <figure class="post-detalhe-foto">
          <img src="<?=URL?>uploads/img/blog_posts/<?=$post['id']?>/<?=$post['foto']?>" alt="<?=$post['titulo']?>">
        </figure>
        <!-- //FOTO -->

        <!-- TEXTO -->
        <div class="post-detalhe-texto">
          <h3 class="texto"><?=$post['texto']?></h3>
        </div>
        <!-- //TEXTO -->

        <!-- COMENTÁRIOS -->
        <? if ($post['comentarios'] == "1") { ?>
        <div class="blog-comentarios">

          <h3 class="subtitulo">Comentários</h3>

          <div class="btn-container right">
            <button class="btn btn-sm btn-primario modal-open" data-modal="modal-comentario">Deixar Comentário</button>
          </div>

          <!-- LISTA COMENTÁRIOS -->
          <ul class="blog-comentarios-lista">
            <? if ($numComentarios > 0) { ?>
              <? foreach ($comentarios as $comentario) { ?>

                <!-- Repete -->
                <li class="blog-comentario">						
                  <div class="blog-comentario-texto"><?=$comentario['comentario']?></div>
                  <div class="blog-comentario-nome"><?=$comentario['nome']?></div>
                  <div class="blog-comentario-data"><?=Tools::formataData($comentario['data_cad'])?></div>
                </li>
                <!-- //Repete -->	

              <? } ?>

            <!-- SEM REGISTROS -->
            <? } else { ?>
              <li class="blog-comentario-empty">
                <p>Nenhum comentário. Seja o primeiro a comentar!</p>
              </li>	
            <? } ?>				
          </ul>
          <!-- //LISTA COMENTÁRIOS -->

        </div>
        <? } ?>
        <!-- //COMENTÁRIOS -->
      
      </div>
      <!-- //POST DETALHE -->

    </div>
  </section>
  <!-- //PÁGINA -->

  <!-- MODAL COMENTÁRIO -->
  <div class="modal" id="modal-comentario">
    <div class="modal-wrap">
      <span class="modal-btn-close modal-close" data-modal="modal-comentario"></span>
      <div class="modal-header">
        <span class="modal-titulo">Comentário</span>                
      </div>
      <div class="modal-body">
        <form id="form-comentario" action="<?=URL?>acoes/app/blog/envia_comentario.php" method="post" class="form-validation">
          <div class="campo-container">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" maxlength="255" class="campo" placeholder="Digite seu nome" required />
          </div>
          <div class="campo-container">
            <label for="email">E-mail (Não será exibido)</label>
            <input type="email" name="email" id="email" maxlength="255" class="campo" placeholder="Digite seu e-mail" required />
          </div>
          <div class="campo-container">
            <label for="comentario">Comentário</label>
            <textarea name="comentario" id="comentario" maxlength="1000" class="campo" rows="4" placeholder="Digite seu comentário" required /></textarea>
          </div>
          <div class="recaptcha-container">
            <div class="recaptcha-el" data-form="form-comentario" data-key="<?=RECAPTCHA_KEY?>"></div>
          </div>	
          <div class="modal-btn center">						
            <input type="hidden" name="post_id" value="<?=$post['id']?>">
            <input type="hidden" name="post_titulo" value="<?=$post['titulo']?>">
            <button type="submit" id="enviar" class="btn btn-primario btn-pulse">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- //MODAL COMENTÁRIO -->

<!-- FOOTER -->
<? include(APP_PATH.'/estrutura/footer.php'); ?>

</body>
</html>
