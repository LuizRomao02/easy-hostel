<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE pro_produto SET pro_status = 0 WHERE pro_id = :id ");

$sth->bindValue(":id", $id, PDO::PARAM_INT);

$sth->execute();

header('LOCATION: tabela_produto.php ');
