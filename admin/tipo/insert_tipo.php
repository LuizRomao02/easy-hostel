<?php

include '../conexao.php';

$tipquarto = filter_input(INPUT_POST, 'tipquarto', FILTER_DEFAULT);

$sth = $pdo->prepare("INSERT INTO tip_tipo VALUES (DEFAULT, :tipquarto, tip_status = 0)");

$sth->bindValue(":tipquarto", $tipquarto);

if ($sth->execute()) {
    echo '{"status":"1"}';
} else echo '{"status":"0"}';
