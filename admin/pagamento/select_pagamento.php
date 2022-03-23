<html>

<body>

	<head>

		<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">

	</head>

	<?php

	include '../conexao.php';

	$sth = $pdo->prepare("SELECT * FROM for_formapag");

	$sth->execute();

	$status = $pdo->prepare("SELECT * FROM for_formapag WHERE for_status = 1");

	$status->execute();

	echo '<p>Existem: ' . $status->rowCount() . ' registros</p>';
	echo '<table class="table table-bordered text-center" id="tabelapag" width="100%" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Tipo</th>';
	echo '<th>Ações</th>';
	echo '</tr>';
	echo '</thead>';

	foreach ($sth as $res) {

		extract($res);

		if ($for_status == 1) {
			echo '<tr>';
			echo '<td> ' . $for_tipo . ' </td>';
			echo '<td><i onclick="changeData(' . $for_id . ')" style="cursor:pointer" data-toggle="modal" data-target="#modalExemplo" class="fas fa-trash-alt text-danger mr-2" data-toggle="rem" title="Remover"></i>';
			echo '<a href="form_pagamento_update.php?id=' . $for_id . '"><i class="fas fa-wrench text-success ml-3" data-toggle="att" title="Atualizar"></i></i></a> </td>';
			echo '</td>';
			echo '</tr>';
		}
	}

	echo '</table>';

	?>

</body>

</html>
