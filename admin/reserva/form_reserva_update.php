<?php

session_start();

if (!$_SESSION['Login']) :
	header("Location: ../../admin.php?msg=3");

	die;

endif;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Projeto de Conclusão de Curso - Etec">
	<meta name="author" content="Equipe Easy Hostel">

	<title>Easy Hostel</title>

	<link rel="shortcut icon" type="image/x-icon" href="../../assets/images/icone.png">
	<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">
	<link rel="stylesheet" href="../../assets/components/datatables/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="../../assets/src/css/sb-admin.css">

	<style>
		html {
			scroll-behavior: smooth
		}
	</style>

</head>

<body id="page-top">

	<?php
	include '../../assets/components/elements/header.php'
	?>

	<?php

	include '../conexao.php';
	
	$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

	$sth = $pdo->prepare("SELECT * FROM res_reserva r 
	INNER JOIN cli_cliente cl ON r.cli_id = cl.cli_id 
	INNER JOIN for_formapag f ON r.for_id = f.for_id 
	INNER JOIN qua_quarto q ON r.qua_id = q.qua_id 
	INNER JOIN qua_status qs ON r.sta_id = qs.sta_id 
	INNER JOIN usu_usuario u ON r.usu_id = u.usu_id 
	where res_id = :id");

	$sth->bindValue(":id", $id, PDO::PARAM_INT);
	$sth->execute();
	$resultado = $sth->fetch(PDO::FETCH_ASSOC);
	extract($resultado);

	?>

	<div id="content-wrapper">

		<div class="container-fluid">

			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Atualizar Informações da Reserva</li>
			</ol>

			<form name="formularioReserva" class="card m-5" action="#" method="post">
				<div class="card-header"><i class="far fa-calendar-alt mr-2"></i>Verificar Quartos Disponíveis</div>
				<div class="form-row m-4">
					<div class="col-md-6 mb-4">
						<label for="Entrada">Data de Entrada</label>
						<input type="date" class="form-control " name="data_entrada" placeholder="Data de Entrada" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Saida">Data de Saída</label>
						<input type="date" class="form-control" name="data_saida" placeholder="Data de Saída" required>
					</div>

					<button class="btn btn-primary btn-block ml-1 mt-3 w-25" href="#page-form">Consultar</button>
				</div>
			</form>

			<form name="reservar_clientes" class="card m-5" id="page-form" onsubmit="insert(event); return false" method="post">
				<div class="card-header"><i class="far fa-edit mr-2"></i>Atualizar Informações da Reserva</div>
				<div class="form-row m-4">
					<div class="col-md-6 mb-4">
						<input type="hidden" name="id" value="<?= $id; ?>" />
						<label for="Cliente">Alterar Nome do Cliente</label>
						<div class="input-group">
							<input type="text" class="form-control typeahead" name="cliente" id="query" placeholder="Busque o cliente" data-provide="typeahead" autocomplete="off" required>
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="col-md-6 mb-4">
						<label for="nomedep">Alterar Nome do Dependente</label>
						<input type="text" class="form-control" name="depnome" placeholder="Dependentes" value="<?= $res_depnome; ?>" required>
					</div>
					<div class="col-md-6 mb-4">
						<input type="hidden" name="id" value="<?= $id; ?>" />
						<label for="Funcionário">Alterar Nome do Usuario</label>
						<select class="custom-select" name="usuario" value="<?= $usu_nome; ?>" required>
							<option selected class="form-control">Selecionar</option>
							<?php
							include '../conexao.php';

							$sth = $pdo->prepare('select *from usu_usuario');
							$sth->execute();
							foreach ($sth as $res) {
								extract($res);
								echo '<option value="' . $usu_id . '">' . $usu_nome . '</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<input type="hidden" name="id" value="<?= $id; ?>" />
						<label for="Pagamento">Alterar Forma de Pagamento</label>
						<select class="custom-select" name="pagamento" value="<?= $for_tipo; ?>" required>
							<option selected class="form-control">Selecionar</option>
							<?php
							include '../conexao.php';

							$sth = $pdo->prepare('select *from for_formapag');
							$sth->execute();
							foreach ($sth as $res) {
								extract($res);
								echo '<option value="' . $for_id . '">' . $for_tipo . '</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Quarto">Alterar Quarto</label>
						<div class="select_quarto">
							<input type="text" class="form-control" name="quarto" placeholder="Fazer a Consulta Primeiro" value="<?= $qua_id; ?>" required readonly="true">
						</div>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Procedencia">Alterar Última Procedência</label>
						<input type="text" class="form-control" name="procedencia" placeholder="Última Procedência" value="<?= $res_ultimaProcedencia; ?>" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Status">Alterar Status</label>
						<input type="hidden" name="id" value="<?= $id; ?>" />
						<select class="custom-select" name="stats" value="<?= $sta_nome; ?>" required>
							<option selected class="form-control">Selecionar</option>
							<?php
							include '../conexao.php';

							$sth = $pdo->prepare('select *from qua_status');
							$sth->execute();
							foreach ($sth as $res) {
								extract($res);
								echo '<option value="' . $sta_id . '">' . $sta_nome . '</option>';
							}
							?>
						</select>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Viagem">Alterar Motivo Viagem</label>
						<input type="text" class="form-control" name="viagem" placeholder="Motivo Viagem" value="<?= $res_motivoViagem; ?>" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Destino">Alterar Proximo Destino</label>
						<input type="text" class="form-control" name="destino" placeholder="Proximo Destino" value="<?= $res_proximoDestino; ?>" required>
					</div>
					<div class="col-md-3 mb-4">
						<label for="Entrada">Alterar Data de Entrada</label>
						<input type="date" class="form-control" name="entrada" placeholder="Data de Entrada" value="<?= $res_dataEntrada; ?>" required readonly="true">
					</div>
					<div class="col-md-3 mb-4">
						<label for="Saida">Alterar Data de Saída</label>
						<input type="date" class="form-control" name="saida" placeholder="Data de Saída" value="<?= $res_dataSaida; ?>" required readonly="true">
					</div>
					<div class="col-md-4 mb-4">
						<label for="Entrada">Alterar Horário de Entrada</label>
						<input type="time" class="form-control" name="hentrada" placeholder="Data de Entrada" value="<?= $res_horaEntrada; ?>" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Saida">Alterar Horário de Saída</label>
						<input type="time" class="form-control" name="hsaida" placeholder="Data de Saída" value="<?= $res_horaSaida; ?>" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Carro">Alterar Placa do Carro</label>
						<input type="text" class="form-control" name="carro" id="placa" placeholder="AAA-0000" value="<?= $res_placaCarro; ?>" required>
					</div>
					<button class="btn btn-primary btn-block ml-1 mt-3 w-25" type="submit">Enviar</button>
				</div>
			</form>

		</div>

		<?php
		include '../../assets/components/elements/footer.php'
		?>

	</div>

	</div>

	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<div class="modal fade" id="sair" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pronto para partir?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Selecione "Sair" abaixo se você estiver pronto para terminar sua sessão atual.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					<a class="btn btn-primary" href="../sair.php">Sair</a>
				</div>
			</div>
		</div>
	</div>

	<div id="mensagem">
		<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Atualizado com Sucesso</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<p>A Reserva foi atualizada com Sucesso!</p>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-success" data-dismiss="modal">Confirmar</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="../../assets/src/js/popper.min.js"></script>
	<script src="../../assets/src/js/jquery.min.js"></script>
	<script src="../../assets/src/js/bootstrap.min.js"></script>
	<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>
	<script src="../../assets/src/js/jquery.mask.js"></script>
	<script src="js/reserva.js"></script>
	<script src="js/autocomplete.js"></script>

	<script>
		$(document).ready(function() {
			$("#placa").mask("AAA-0000", {
				translation: {
					'A': {
						pattern: /[A-Z]/
					},
					'a': {
						pattern: /[e-zA-Z]/
					},
					's': {
						pattern: /[a-zA-Z0-9]/
					},
				}
			})
		})

		<?php
		$sth = $pdo->prepare('select cli_id, cli_nome from cli_cliente');
		$sth->execute();
		foreach ($sth as $res) {
			extract($res);
			$data[] = ['name' => "$cli_id - $cli_nome"];
		}
		?>

		$("#query").typeahead({
			source: <?= json_encode($data) ?>,
		});
	</script>

	<script>
		$('#myModal').on('hidden.bs.modal', function() {
			$(this).removeData('bs.modal');
		});

		async function insert(e) {
			e.preventDefault();

			const inputs = document.querySelectorAll('form input:not([type=submit]),form select')
			const formData = new FormData()

			for (let i = 0; i < inputs.length; i++) {
				formData.append(inputs[i].name, inputs[i].value)
			}

			const data = await (await fetch('update_reserva.php', {
				method: 'POST',
				body: formData
			})).json()

			if (data.status === '1') {
				$('#modalExemplo').modal({
					show: true
				})

				for (let i = 0; i < inputs.length; i++) {
					if (inputs[i].type !== 'select-one') {
						inputs[i].value = ''
					}
				}
			} else {
				console.log('erro')
			}
		}

		function msg() {
			$("#mensagem").addClass('ver');

			setTimeout(function() {
				$("#mensagem").removeClass('ver');
			}, 3000);
		}
	</script>

</body>

</html>
