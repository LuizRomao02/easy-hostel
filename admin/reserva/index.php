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

	<div id="content-wrapper">

		<div class="container-fluid">

			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Cadastro da Reserva</li>
			</ol>


			<form name="formularioReserva" class="card m-5" action="#" method="post">
				<div class="card-header"><i class="far fa-calendar-alt mr-2"></i>Verificar Quartos Disponíveis</div>
				<div class="form-row m-4">
					<div class="col-md-6 mb-4">
						<label for="Entrada">Data de Entrada</label>
						<input type="date" class="form-control" name="data_entrada" placeholder="Data de Entrada" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Saida">Data de Saída</label>
						<input type="date" class="form-control" name="data_saida" placeholder="Data de Saída" required>
					</div>
					<button class="btn btn-primary btn-block ml-1 mt-3 w-25" href="#page-form">Consultar</button>
				</div>
			</form>

			<form onsubmit="insert(event); return false" class="card m-5" method="POST">
				<div class="card-header"><i class="fas fa-plus mr-2"></i>Cadastrar Reserva</div>
				<div class="form-row m-4">
					<div class="col-md-6 mb-4">
						<label for="Cliente">Nome do Cliente</label>
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
						<label for="nomedep">Nome do Dependente</label>
						<input type="text" class="form-control" name="depnome" placeholder="Dependentes" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Funcionário">Nome do Usuario</label>
						<select class="custom-select" name="usuario" required>
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
						<label for="Pagamento">Forma de Pagamento</label>
						<select class="custom-select" name="pagamento" required>
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
						<label for="Quarto">Quarto</label>
						<div class="select_quarto">
							<input type="text" class="form-control" name="quarto" placeholder="Fazer a Consulta Primeiro" required readonly="true">
						</div>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Procedencia">Última Procedência</label>
						<input type="text" class="form-control" name="procedencia" placeholder="Última Procedência" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Status">Status</label>
						<select class="custom-select" name="status" required>
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
						<label for="Viagem">Motivo Viagem</label>
						<input type="text" class="form-control" name="viagem" placeholder="Motivo Viagem" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Destino">Proximo Destino</label>
						<input type="text" class="form-control" name="destino" placeholder="Proximo Destino" required>
					</div>
					<div class="col-md-3 mb-4">
						<label for="Entrada">Data de Entrada</label>
						<input type="date" class="form-control" name="entrada" placeholder="Data de Entrada" required readonly="true">
					</div>
					<div class="col-md-3 mb-4">
						<label for="Saida">Data de Saída</label>
						<input type="date" class="form-control" name="saida" placeholder="Data de Saída" required readonly="true">
					</div>
					<div class="col-md-4 mb-4">
						<label for="Entrada">Horário de Entrada</label>
						<input type="time" class="form-control" name="hentrada" placeholder="Data de Entrada" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Saida">Horário de Saída</label>
						<input type="time" class="form-control" name="hsaida" placeholder="Data de Saída" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Carro">Placa do Carro</label>
						<input type="text" class="form-control" name="carro" id="placa" placeholder="AAA-0000" required>
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
						<h5 class="modal-title">Cadastrado com Sucesso</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<p>A Reserva foi cadastrada com Sucesso!</p>
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
		$sth = $pdo->prepare('SELECT cli_id, cli_nome FROM cli_cliente WHERE cli_status = 1');
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

			const data = await (await fetch('insert_reserva.php', {
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
