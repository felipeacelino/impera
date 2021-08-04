<?php

// POSTS
$blog = new Crud("blog_posts");
$sql = "SELECT * FROM blog_posts WHERE status=1 ORDER BY data_exibe DESC";
$titulo = "Últimas postagens";
$url_paginacao = URL."blog";

// FILTRO CATEGORIA
if (isset($param2) && $param2 == "categoria") {

  $url_categoria = $param3;
  $categoria = $blog->SelectSingle("SELECT * FROM blog_categorias WHERE url_amigavel = '$url_categoria' LIMIT 1");

  $sql = "SELECT blog_posts.* FROM blog_posts INNER JOIN blog_posts_categorias ON blog_posts_categorias.post_id = blog_posts.id WHERE blog_posts_categorias.categoria_id = ".$categoria['id']." AND blog_posts.status=1 ORDER BY blog_posts.data_exibe DESC";

  $titulo = $categoria['titulo'];

  $url_paginacao = URL."blog/categoria/".$categoria['url_amigavel'];
}

// FILTRO BUSCA
if (isset($param2) && $param2 == "busca") {
    
  $buscaExibe = $param3;
  $busca = $buscaExibe;
  
  $sql = "SELECT * FROM blog_posts WHERE status=1 AND titulo LIKE '%".$busca."%' ORDER BY data_exibe DESC";

  $titulo = "Resultados para '$busca'";

  $url_paginacao = URL."blog/busca".$buscaExibe;
}

$posts = $blog->SelectMultiple($sql, true, 12);
$numPosts = $blog->totalRegistros();
