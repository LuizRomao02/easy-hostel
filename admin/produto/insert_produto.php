<?php

include '../conexao.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$preco = filter_input(INPUT_POST, 'preco', FILTER_DEFAULT);
$marca = filter_input(INPUT_POST, 'marca', FILTER_DEFAULT);

$sth = $pdo->prepare("INSERT INTO pro_produto VALUES (DEFAULT, :nome, :preco, :marca, pro_status = 0)");

$sth->bindValue(":nome", $nome);
$sth->bindValue(":preco", $preco);
$sth->bindValue(":marca", $marca);

if ($sth->execute()) {
    echo '{"status":"1"}';
} else echo '{"status":"0"}';
