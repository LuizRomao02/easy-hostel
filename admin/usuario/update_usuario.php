<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT);
$nivel = filter_input(INPUT_POST, 'nivel', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE usu_usuario set usu_nome = :nome, usu_email = :email, usu_cpf = :cpf, usu_nivel = :nivel WHERE usu_id = :id");

$sth->bindValue(":nome", $nome);
$sth->bindValue(":email", $email);
$sth->bindValue(":cpf", $cpf);
$sth->bindValue(":nivel", $nivel);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
} else {
	echo '{"status":"0"}';
}
