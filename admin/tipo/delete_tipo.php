<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE tip_tipo SET tip_status = 0 WHERE tip_id = :id ");

$sth->bindValue(":id", $id, PDO::PARAM_INT);

$sth->execute();

header('LOCATION: tabela_tipo.php ');
