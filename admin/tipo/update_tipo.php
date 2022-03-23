<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$tipquarto = filter_input(INPUT_POST, 'tipquarto', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE tip_tipo set tip_nome = :tipquarto WHERE tip_id = :id");

$sth->bindValue(":tipquarto", $tipquarto);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
} else echo '{"status":"0"}';
