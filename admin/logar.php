<?php

include 'conexao.php';

session_start();

$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
$codifica = MD5($senha);

$sth = $pdo->prepare('select * from usu_usuario where usu_email = :email and usu_senha = :senha');

$sth->bindValue(':email', $email);
$sth->bindValue(':senha', $codifica);
$sth->execute();

if ($sth->rowCount() > 0) :

	$linha = $sth->fetch(PDO::FETCH_ASSOC);
	extract($linha);

	$_SESSION['Login']['email'] = $email;
	$_SESSION['Login']['senha'] = $senha;

	$_SESSION['Login']['nivel'] = $usu_nivel;

	if ($_SESSION['Login']['nivel'] == 1) :
		header('Location: home/');

	else :
		header('Location: home/mapadehospedes.php');

	endif;


else :

	header('Location: ../index.php?msg=1');

endif;
