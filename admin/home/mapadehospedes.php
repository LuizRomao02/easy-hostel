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

</head>

<body id="page-top">

	<?php
	include '../../assets/components/elements/header.php'
	?>

	<div id="content-wrapper">

		<div class="container-fluid">

			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="#">Dashboard</a>
				</li>
				<li class="breadcrumb-item active mr-5">Mapa de Hospedes</li>
			</ol>

			<form name="formularioMapa" class="card m-5" action="#" method="post">
				<div class="card-header"><i class="far fa-calendar-alt mr-2"></i>Consultar data de Reserva</div>
				<div class="form-row mx-3 my-4">
					<div class="col-md-2 mb-4">
						<label for="Entrada">Data de Entrada</label>
						<input type="date" class="form-control pr-1" name="data_entrada" placeholder="Data de Entrada" required>
					</div>
					<div class="col-md-2 mb-4">
						<label for="Saida">Data de Saída</label>
						<input type="date" class="form-control pr-1" name="data_saida" placeholder="Data de Saída" required>
					</div>
					<div class="col-md-2 mb-4">
						<label for="#"><br></label>
						<button class="btn btn-primary btn-block w-75" href="#page-form">Consultar</button>
					</div>
					<form action="#">
						<div class="col-md-2 mb-4">
							<label for="#"><br></label>
							<button class="btn btn-success btn-block w-75" href="#">Disponivel</button>
						</div>
						<div class="col-md-2 mb-4">
							<label for="#"><br></label>
							<button class="btn btn-danger btn-block w-75" href="#">Ocupado</button>
						</div>
						<div class="col-md-2 mb-4">
							<label for="#"><br></label>
							<button class="btn btn-warning btn-block w-75" href="#">Reservado</button>
						</div>
					</form>
				</div>
			</form>

			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-4 border-bottom"></div>

			<form name="form_mapa" class="m-5" id="page-form">
				<div class="select_mapa">
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

	<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Remover</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<p>Deseja remover?</p>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-danger"><a id="btnRemove" style="text-decoration:none;color:white">Remover</a></buton>
				</div>
			</div>
		</div>
	</div>

	<script src="../../assets/src/js/jquery.min.js"></script>
	<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>
	<script src="js/mapa.js"></script>

	<script>
		const btnRemove = document.querySelector('#btnRemove')

		$(document).ready(function() {
			$('[data-toggle="rem"]').tooltip();
			$('[data-toggle="modal"]').tooltip();
		});

		function changeData(id) {
			btnRemove.href = `../reserva/delete_reserva.php?id=${id}`
		}
	</script>

</body>

</html>
