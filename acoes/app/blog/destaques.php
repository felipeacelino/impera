<?php

// POSTS DESTAQUE
$resultPostsDest = $conexao->prepare("SELECT * FROM blog_posts WHERE status=1 AND destaque=1 ORDER BY data_exibe DESC LIMIT 3");
$resultPostsDest->execute();
$numPostsDest = $resultPostsDest->rowCount();
$postsDest = $resultPostsDest->fetchAll(PDO::FETCH_ASSOC);
