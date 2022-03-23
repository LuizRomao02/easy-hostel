<html>

<body>

	<head>

		<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">

	</head>

	<?php

	include '../conexao.php';

	$sth = $pdo->prepare("SELECT * FROM usu_usuario");


	$sth->execute();

	$status = $pdo->prepare("SELECT * FROM usu_usuario WHERE usu_status = 1");

	$status->execute();

	echo '<p>Existem: ' . $status->rowCount() . ' registros</p>';
	echo '<table class="table table-bordered text-center" id="tabelaadm" width="100%" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Nome</th>';
	echo '<th>Email</th>';
	echo '<th>Cpf</th>';
	echo '<th>Ações</th>';
	echo '</tr>';
	echo '</thead>';

	foreach ($sth as $res) {

		extract($res);
		if ($usu_status == 1) {
			echo '<tr>';
			echo '<td> ' . $usu_nome . ' </td>';
			echo '<td> ' . $usu_email . ' </td>';
			echo '<td> ' . $usu_cpf . ' </td>';
			echo '<td><i onclick="changeData(' . $usu_id . ')" style="cursor:pointer" data-toggle="modal" data-target="#modalExemplo" class="fas fa-trash-alt text-danger mr-2" data-toggle="rem" title="Remover"></i>';
			echo '<a href="form_usuario_update.php?id=' . $usu_id . '"><i class="fas fa-wrench text-success ml-3" data-toggle="att" title="Atualizar"></i></i></a>';
			echo '<a><i class="far fa-eye ml-4" id="myModal" data-toggle="modal" title="Ver todos os Dados" data-target="#exampleModalLong' . $usu_id . '"></i></a> </td>';
			echo '</td>';
			echo '</tr>';
		}
		?>
		<div class="modal fade " id="exampleModalLong<?= $usu_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Todos os Dados</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p><b>Nome:</b> <?= $usu_nome; ?></p>
						<p><b>CPF:</b> <?= $usu_cpf; ?></p>
						<p><b>E-mail:</b> <?= $usu_email; ?></p>
						<p><b>Nivel de Acesso:</b> <?= $usu_nivel; ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	echo '</table>';

	?>

	<script>
		$('#myModal').on('hidden.bs.modal', function() {
			$(this).removeData('bs.modal');
		});
	</script>
	
</body>

</html>
