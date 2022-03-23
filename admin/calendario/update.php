<?php

include '../conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE events SET title=:title, start_event=:start_event, end_event=:end_event WHERE id=:id");
$sth->execute(
    array(
        ':title'  => $_POST['title'],
        ':start_event' => $_POST['start'],
        ':end_event' => $_POST['end'],
        ':id'   => $_POST['id']
    )
);
