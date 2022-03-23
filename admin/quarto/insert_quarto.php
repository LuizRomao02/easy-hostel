<?php

include '../conexao.php';

$numero = filter_input(INPUT_POST, 'numero', FILTER_DEFAULT);
$valor = filter_input(INPUT_POST, 'valor', FILTER_DEFAULT);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
$andar = filter_input(INPUT_POST, 'andar', FILTER_DEFAULT);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_DEFAULT);


$sth = $pdo->prepare("INSERT INTO qua_quarto VALUES (DEFAULT, :numero, :valor, :descricao, :andar, :tip_id, qua_status = 0 )");

$sth->bindValue(":numero", $numero);
$sth->bindValue(":valor", $valor);
$sth->bindValue(":descricao", $descricao);
$sth->bindValue(":andar", $andar);
$sth->bindValue(":tip_id", $tipo);

if ($sth->execute()) {
    echo '{"status":"1"}';
} else echo '{"status":"0"}';

