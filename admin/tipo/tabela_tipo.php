<?php

session_start();

if (!$_SESSION['Login']) :

	header("Location: ../../index.php?msg=3");

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
				<li class="breadcrumb-item active">Tabela Tipo de Quarto</li>
			</ol>

			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Tabela Tipo de Quarto</div>
				<div class="card-body">
					<div class="table-responsive">
						<?php
						include 'select_tipo.php';
						?>
					</div>
				</div>
				<div class="card-footer small text-muted">Atualizado</div>
			</div>

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
	<script src="../../assets/components/datatables/jquery.dataTables.min.js"></script>
	<script src="../../assets/components/datatables/dataTables.bootstrap4.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>
	<script src="../../assets/components/demo/datatables-demo.js"></script>
	<script>
		$(document).ready(function() {
			$('#tabelatipo').dataTable({
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
				}
			});
		});
	</script>
	
	<script>
		const btnRemove = document.querySelector('#btnRemove')

		$(document).ready(function() {
			$('[data-toggle="rem"]').tooltip();
			$('[data-toggle="att"]').tooltip();
			$('[data-toggle="modal"]').tooltip();

		});

		function changeData(id) {
			btnRemove.href = `delete_tipo.php?id=${id}`
		}
	</script>

</body>

</html>
