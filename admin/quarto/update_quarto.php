<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$numero = filter_input(INPUT_POST, 'numero', FILTER_DEFAULT);
$valor = filter_input(INPUT_POST, 'valor', FILTER_DEFAULT);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
$andar = filter_input(INPUT_POST, 'andar', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE qua_quarto set qua_numero = :numero, qua_valor = :valor, qua_descricao = :descricao, qua_andar = :andar WHERE qua_id = :id");

$sth->bindValue(":numero", $numero);
$sth->bindValue(":valor", $valor);
$sth->bindValue(":descricao", $descricao);
$sth->bindValue(":andar", $andar);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
 } else echo '{"status":"0"}';
 
 