<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE usu_usuario SET usu_status = 0 WHERE usu_id = :id ");

$sth->bindValue(":id", $id, PDO::PARAM_INT);

$sth->execute();

header('LOCATION: tabela_usuario.php ');
