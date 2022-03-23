<html>

<body>

	<head>

		<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">
		<link rel="stylesheet" href="../../assets/src/css/sb-admin.css">


	</head>

	<?php



	include '../conexao.php';

	$sth = $pdo->prepare("SELECT * FROM tip_tipo");

	$sth->execute();

	$status = $pdo->prepare("SELECT * FROM tip_tipo WHERE tip_status = 1");

	$status->execute();

	echo '<p>Existem: ' . $status->rowCount() . ' registros</p>';
	echo '<table class="table table-bordered text-center" id="tabelatipo" width="100%" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Tipo</th>';
	echo '<th>Ações</th>';
	echo '</tr>';
	echo '</thead>';

	foreach ($sth as $res) {

		extract($res);

		if ($tip_status == 1) {
			echo '<tr>';
			echo '<td> ' . $tip_nome . ' </td>';
			echo '<td><i onclick="changeData(' . $tip_id . ')" style="cursor:pointer" data-toggle="modal" data-target="#modalExemplo" class="fas fa-trash-alt text-danger mr-2" data-toggle="rem" title="Remover"></i>';
			echo '<a href="form_tipo_update.php?id=' . $tip_id . '"><i class="fas fa-wrench text-success ml-3" data-toggle="att" title="Atualizar"></i></i></a></td> ';
			echo '</td>';
			echo '</tr>';
		}
	}

	echo '</table>';
	?>

</body>

</html>
