<?php

$idUser = (int) $user['id'];

$mensagensCrud = new Crud('proprietarios_mensagens');
$tabela = 'proprietarios_mensagens';

$user['foto'] = $user['foto'] != "" ? URL."uploads/img/proprietarios/".$user['id']."/thumb-150-150/".$user['foto'] : URL."static/img/admin/user-profile.png";

// Mensagens
$resultMensagens = $conexao->prepare("SELECT * FROM $tabela WHERE id_usuario=:id_usuario ORDER BY id ASC");
$resultMensagens->bindValue(':id_usuario', $idUser, PDO::PARAM_INT);
$resultMensagens->execute();
$numMensagens = $resultMensagens->rowCount();
$mensagens = $resultMensagens->fetchAll(PDO::FETCH_ASSOC);

foreach ($mensagens as $kMensagem => $vMensagem) {
  $mensagens[$kMensagem]['tipo'] = $vMensagem['remetente'] == "usuario" ? "enviada" : "recebida";
  $mensagens[$kMensagem]['foto'] = $vMensagem['remetente'] == "usuario" ? $user['foto'] : LOGO_ADMIN;
  $mensagens[$kMensagem]['nome'] = $vMensagem['remetente'] == "usuario" ? $user['nome'] : TITULO_PAGS;
  $mensagens[$kMensagem]['email'] = $vMensagem['remetente'] == "usuario" ? $user['email'] : EMAIL_ATENDIMENTO;
  $mensagens[$kMensagem]['data'] = Tools::formataData($vMensagem['data']) == Tools::formataData(Tools::getDate()) ? substr(explode(" ",$vMensagem['data'])[1], 0, 5) : Tools::formataData($vMensagem['data']);
}

// Marca todas mensagens como lidas
$updateMensagens = $mensagensCrud->Update(array("lida" => 1), "WHERE id_usuario=$idUser AND lida=0 AND remetente='admin'");
