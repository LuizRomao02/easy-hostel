<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$preco = filter_input(INPUT_POST, 'preco', FILTER_DEFAULT);
$marca = filter_input(INPUT_POST, 'marca', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE pro_produto set pro_nome = :nome, pro_preco = :preco, pro_marca = :marca WHERE pro_id = :id");

$sth->bindValue(":nome", $nome);
$sth->bindValue(":preco", $preco);
$sth->bindValue(":marca", $marca);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
 } else echo '{"status":"0"}';
 