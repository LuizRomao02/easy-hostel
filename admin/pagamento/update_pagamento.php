<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE for_formapag set for_descricao = :descricao, for_tipo = :tipo WHERE for_id = :id");

$sth->bindValue(":descricao", $descricao);
$sth->bindValue(":tipo", $tipo);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
 } else echo '{"status":"0"}';
 
 