<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE res_reserva SET res_status = 0 WHERE res_id = :id ");

$sth->bindValue(":id", $id, PDO::PARAM_INT);

$sth2 = $pdo->prepare("DELETE FROM qua_reserva WHERE res_id = :id");

$sth2->bindValue(":id", $id, PDO::PARAM_INT);

$sth->execute();

$sth2->execute();

header('LOCATION: ../home/mapadehospedes.php ');
