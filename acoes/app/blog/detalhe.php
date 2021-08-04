<?php

$url_post = $param2;

// POST DETALHE
$resultPost = $conexao->prepare("SELECT * FROM blog_posts WHERE status=1 AND url_amigavel=:url_amigavel LIMIT 1");
$resultPost->bindValue(":url_amigavel", $url_post, PDO::PARAM_STR);
$resultPost->execute();
$numPost = $resultPost->rowCount();
$post = $resultPost->fetch(PDO::FETCH_ASSOC);

$id_post = (int)$post['id'];

// COMENTÁRIOS
$resultComentarios = $conexao->prepare("SELECT * FROM blog_posts_comentarios WHERE status=1 AND post_id=:post_id");
$resultComentarios->bindValue(":post_id", $id_post, PDO::PARAM_INT);
$resultComentarios->execute();
$numComentarios = $resultComentarios->rowCount();
$comentarios = $resultComentarios->fetchAll(PDO::FETCH_ASSOC);

// CONTADOR DE VIEWS
if (!$_COOKIE['post-view-'.$post['id']]) {
    $update_view = $conexao->prepare("UPDATE blog_posts SET views=views+1 WHERE id=:id");
    $update_view->bindValue(":id", $post['id'], PDO::PARAM_INT);
    if ($update_view->execute()) {
        setcookie('post-view-'.$post['id'], true, strtotime('+1 days'));
    }
}
