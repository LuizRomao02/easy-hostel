<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE cli_cliente SET cli_status = 0 WHERE cli_id = :id ");

$sth->bindValue(":id", $id, PDO::PARAM_INT);

$sth->execute();

header('LOCATION: tabela_cliente.php ');
