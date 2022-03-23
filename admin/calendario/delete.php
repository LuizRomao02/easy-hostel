<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("DELETE from events WHERE id = :id");

$sth->execute(
    array(
        ':id' => $_POST['id']
    )
);
