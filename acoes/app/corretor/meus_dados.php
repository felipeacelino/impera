<?php

$regioesAtuacao = new Crud("regioes_atuacao");
$regioesAtuacaoLista1 = $regioesAtuacao->SelectSQL("SELECT * FROM regioes_atuacao WHERE status=1 AND tipo='avulso-locacao' ORDER BY id ASC");
$regioesAtuacaoLista2 = $regioesAtuacao->SelectSQL("SELECT * FROM regioes_atuacao WHERE status=1 AND tipo='planta' ORDER BY id ASC");

$regioesAtuais = $conexao->prepare("SELECT regiao_id FROM corretores_regioes_atuacao WHERE corretor_id=".$user['id']);
$regioesAtuais->execute();
$regioesAtuais = $regioesAtuais->fetchAll(PDO::FETCH_COLUMN);
