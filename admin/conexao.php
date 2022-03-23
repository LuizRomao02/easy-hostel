<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=bancotcc;charset=utf8', 'root', '');
} catch (PDOException $e) {
	echo $e->getMessage() . "</p>";
	die("Não foi possível estabelecer a conexão com o banco de dados.");
}
