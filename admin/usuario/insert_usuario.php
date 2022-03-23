<?php

include '../conexao.php';

$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$resenha = filter_input(INPUT_POST, 'resenha', FILTER_DEFAULT);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT);
$nivel = filter_input(INPUT_POST, 'nivel', FILTER_DEFAULT);

if ($senha == $resenha) :

	$novasenha = MD5($senha);
	$sth = $pdo->prepare("INSERT INTO usu_usuario VALUES (DEFAULT, :nome, :email, :senha, :cpf, :nivel, 1)");

	$sth->bindValue(":nome", $nome);
	$sth->bindValue(":email", $email);
	$sth->bindValue(":senha", $novasenha);
	$sth->bindValue(":cpf", $cpf);
	$sth->bindValue(":nivel", '0');

	if ($sth->execute()) {
		echo '{"status":"1"}';
	} else {
		echo '{"status":"0"}';
	} else :
endif;
