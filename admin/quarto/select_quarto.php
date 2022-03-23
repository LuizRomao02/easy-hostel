<html>

<body>

	<head>

		<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">

	</head>

	<?php

	include '../conexao.php';

	$sth = $pdo->prepare("SELECT * FROM qua_quarto q
	INNER JOIN tip_tipo t ON q.tip_id = t.tip_id ");

	$sth->execute();

	$status = $pdo->prepare("SELECT * FROM qua_quarto WHERE qua_status = 1");

	$status->execute();

	echo '<p>Existem: ' . $status->rowCount() . ' registros</p>';
	echo '<table class="table table-bordered text-center" id="tabelaquarto" width="100%" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Número</th>';
	echo '<th>Valor</th>';
	echo '<th>Andar</th>';
	echo '<th>Descrição</th>';
	echo '<th>Ações</th>';
	echo '</tr>';
	echo '</thead>';

	foreach ($sth as $res) {

		extract($res);

		if ($qua_status == 1) {
			echo '<tr>';
			echo '<td> ' . $qua_numero . ' </td>';
			echo '<td> ' . $qua_valor . ' </td>';
			echo '<td> ' . $qua_andar . ' </td>';
			echo '<td> ' . $qua_descricao . ' </td>';
			echo '<td><i onclick="changeData(' . $qua_id . ')" style="cursor:pointer" data-toggle="modal" data-target="#modalExemplo" class="fas fa-trash-alt text-danger mr-2" data-toggle="rem" title="Remover"></i>';
			echo '<a href="form_quarto_update.php?id=' . $qua_id . '"><i class="fas fa-wrench text-success ml-3" data-toggle="att" title="Atualizar"></i></i></a>';
			echo '<a><i class="far fa-eye ml-4" id="myModal" data-toggle="modal" title="Ver todos os Dados" data-target="#exampleModalLong' . $qua_id . '"></i></a> </td>';
			echo '</td>';
			echo '</tr>';
		}
		?>
		<div class="modal fade " id="exampleModalLong<?= $qua_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Todos os Dados</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p><b>Numero do Quarto:</b> <?= $qua_numero; ?></p>
						<p><b>Valor:</b> R$<?= $qua_valor; ?></p>
						<p><b>Andar:</b> <?= $qua_andar; ?></p>
						<p><b>Descricao:</b> <?= $qua_descricao; ?></p>
						<p><b>Tipo:</b> <?= $tip_nome; ?></p>
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
