<html>

<body>

	<head>

		<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">

	</head>

	<?php

	include '../conexao.php';

	$sth = $pdo->prepare("SELECT * FROM cli_cliente c
     INNER JOIN end_endereco e ON c.end_id = e.end_id 
	");


	$sth->execute();

	$status = $pdo->prepare("SELECT * FROM cli_cliente WHERE cli_status = 1");

	$status->execute();

	echo '<p>Existem: ' . $status->rowCount() . ' registros</p>';
	echo '<table class="table table-bordered text-center" id="tabelacliente" width="100%" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Nome</th>';
	echo '<th>Email</th>';
	echo '<th>Cidade</th>';
	echo '<th>Estado</th>';
	echo '<th>Ações</th>';
	echo '</tr>';
	echo '</thead>';

	foreach ($sth as $res) {

		extract($res);

		if ($cli_status == 1) {
			echo '<tr>';
			echo '<td> ' . $cli_nome . ' </td>';
			echo '<td> ' . $cli_email . ' </td>';
			echo '<td> ' . $end_cidade . ' </td>';
			echo '<td> ' . $end_estado . ' </td>';
			echo '<td><i onclick="changeData(' . $cli_id . ')" style="cursor:pointer" data-toggle="modal" data-target="#modalExemplo" class="fas fa-trash-alt text-danger mr-2" data-toggle="rem" title="Remover"></i>';
			echo '<a href="form_cliente_update.php?id=' . $cli_id . '"><i class="fas fa-wrench text-success ml-3" data-toggle="att" title="Atualizar"></i></i></a>';
			echo '<a><i class="far fa-eye ml-4" id="myModal" title="Ver todos os Dados" data-toggle="modal" data-target="#exampleModalLong' . $cli_id . '"></i></a> </td>';
			echo '</td>';
			echo '</tr>';
		}
		?>
		<div class="modal fade " id="exampleModalLong<?= $cli_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Todos os Dados</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p><b>Nome:</b> <?= $cli_nome; ?></p>
						<p><b>E-mail:</b> <?= $cli_email; ?></p>
						<p><b>Nacionalidade:</b> <?= $cli_nacionalidade; ?></p>
						<p><b>Data Nasciemento:</b> <?= $cli_dataNascimento; ?></p>
						<p><b>Estado Civil:</b> <?= $cli_estadoCivil; ?></p>
						<p><b>Sexo:</b> <?= $cli_sexo; ?></p>
						<p><b>RG:</b> <?= $cli_rg; ?></p>
						<p><b>CPF:</b> <?= $cli_cpf; ?></p>
						<p><b>Telefone:</b> <?= $cli_telResidencia; ?></p>
						<p><b>Celular:</b> <?= $cli_telCelular; ?></p>
						<p><b>CEP:</b> <?= $end_cep; ?></p>
						<p><b>Cidade:</b> <?= $end_cidade; ?></p>
						<p><b>Estado:</b> <?= $end_estado; ?></p>
						<p><b>Bairro:</b> <?= $end_bairro; ?></p>
						<p><b>Rua:</b> <?= $end_rua; ?></p>
						<p><b>Numero:</b> <?= $end_numero; ?></p>
						<p><b>Complemento:</b> <?= $end_complemento; ?></p>

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
