<?php

include '../conexao.php';

$data = array();

$sth = $pdo->prepare("SELECT * FROM events ORDER BY id");

$sth->execute();

$result = $sth->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);
