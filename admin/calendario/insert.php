<?php

include '../conexao.php';

$title = filter_input(INPUT_POST, 'title', FILTER_DEFAULT);
$start_event = filter_input(INPUT_POST, 'start_event', FILTER_DEFAULT);
$end_event = filter_input(INPUT_POST, 'end_event', FILTER_DEFAULT);


$sth = $pdo->prepare("INSERT INTO events (title, start_event, end_event) VALUES (:title, :start_event, :end_event)");
 $sth->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
