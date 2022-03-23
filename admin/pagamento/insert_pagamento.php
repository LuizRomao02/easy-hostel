<?php

include '../conexao.php';

$descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_DEFAULT);

$sth = $pdo->prepare("INSERT INTO for_formapag VALUES (DEFAULT, :descricao, :tipo, for_status = 0)");

$sth->bindValue(":descricao", $descricao);
$sth->bindValue(":tipo", $tipo);

if ($sth->execute()) {
    echo '{"status":"1"}';
} else echo '{"status":"0"}';

