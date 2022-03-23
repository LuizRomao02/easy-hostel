<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE qua_quarto SET qua_status = 0 WHERE qua_id = :id ");

$sth->bindValue(":id", $id, PDO::PARAM_INT);

$sth->execute();

header('LOCATION: tabela_quarto.php ');
