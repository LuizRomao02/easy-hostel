<html>

<body>

	<head>

		<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">

	</head>

	<?php

	include '../conexao.php';

	$sth = $pdo->prepare("SELECT * FROM res_reserva r
	INNER JOIN for_formapag f ON r.for_id = f.for_id 
	INNER JOIN cli_cliente c ON r.cli_id = c.cli_id 
	INNER JOIN qua_quarto q ON r.qua_id = q.qua_id 
	INNER JOIN usu_usuario u ON r.usu_id = u.usu_id 
	");
	
	$sth->execute();

	$status = $pdo->prepare("SELECT * FROM res_reserva WHERE res_status = 1");

	$status->execute();

	echo '<p>Existem: ' . $status->rowCount() . ' registros</p>';
	echo '<table class="table table-bordered text-center" id="tabelareserva" width="100%" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>Nome</th>';
	echo '<th>Data de Entrada</th>';
	echo '<th>Data de Saída</th>';
	echo '<th>Quarto</th>';
	echo '<th>Placa do Carro</th>';
	echo '<th>Usuario</th>';
	echo '<th>Ações</th>';
	echo '</tr>';
	echo '</thead>';

	foreach ($sth as $res) {

		extract($res);

		if ($res_status == 1) {
			echo '<tr>';
			echo '<td> ' . $cli_nome . ' </td>';
			echo '<td> ' . $res_dataEntrada . ' </td>';
			echo '<td> ' . $res_dataSaida . ' </td>';
			echo '<td> ' . $qua_numero . ' </td>';
			echo '<td> ' . $res_placaCarro . ' </td>';
			echo '<td> ' . $usu_nome . ' </td>';
			echo '<td><i onclick="changeData(' . $res_id . ')" style="cursor:pointer" data-toggle="modal" data-target="#modalExemplo" class="fas fa-trash-alt text-danger mr-2" data-toggle="rem" title="Remover"></i>';
			echo '<a href="form_reserva_update.php?id=' . $res_id . '"><i class="fas fa-wrench text-success ml-3" data-toggle="att" title="Atualizar"></i></i></a>';
			echo '<a><i class="far fa-eye ml-4" id="myModal" title="Ver todos os Dados" data-toggle="modal" data-target="#exampleModalLong' . $res_id . '"></i></a>';
			echo '<a href="pdf.php?id=' . $res_id . '" target="_blank"><i class="fas fa-file-download text-primary ml-4" data-toggle="imp" title="Imprimir"></i></a></td>';
			echo '</td>';
			echo '</tr>';
		}
		?>
		<div class="modal fade " id="exampleModalLong<?= $res_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Todos os Dados</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p><b>Nome do Cliente :</b> <?= $cli_nome; ?></p>
						<p><b>Dependentes :</b> <?= $res_depnome; ?></p>
						<p><b>Quarto :</b> <?= $qua_numero; ?></p>
						<p><b>Data Entrada : </b> <?= $res_horaEntrada; ?></p>
						<p><b>Data Saída :</b> <?= $res_horaSaida; ?></p>
						<p><b>Horario Entrada : </b> <?= $res_dataSaida; ?></p>
						<p><b>Horario Saída :</b> <?= $res_dataSaida; ?></p>
						<p><b>Usuario que Efetuou :</b> <?= $usu_nome; ?></p>
						<p><b>Pagamento : </b> <?= $for_tipo; ?></p>
						<p><b>Placa do Carro : </b> <?= $res_placaCarro; ?></p>
						<p><b>Motivo da Viagem :</b> <?= $res_motivoViagem; ?></p>
						<p><b>Ultima Procedencia :</b> <?= $res_ultimaProcedencia; ?></p>
						<p><b>Proximo Destino : </b> <?= $res_proximoDestino; ?></p>
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

</body>

</html>
