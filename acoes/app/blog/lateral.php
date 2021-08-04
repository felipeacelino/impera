<?php

// CATEGORIAS
$cats = new Crud("blog_categorias");
$categorias = $cats->SelectMultiple("SELECT * FROM blog_categorias WHERE status=1 ORDER BY ordem_exibicao ASC", false, "");

// POPULARES
$blog_top = new Crud("blog_categorias");
$populares = $blog_top->SelectMultiple("SELECT * FROM blog_posts WHERE status=1 ORDER BY views DESC LIMIT 5", false, "");