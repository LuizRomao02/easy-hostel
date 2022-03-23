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

	<?php

	include '../conexao.php';
	$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

	$sth = $pdo->prepare("select *from tip_tipo where tip_id = :id");
	$sth->bindValue(":id", $id, PDO::PARAM_INT);
	$sth->execute();
	$resultado = $sth->fetch(PDO::FETCH_ASSOC);
	extract($resultado);

	?>

	<div id="content-wrapper">

		<div class="container-fluid">

			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Atualizar Informações de Tipo de Quarto</li>
			</ol>

			<form class="card m-5" onsubmit="insert(event); return false" method="post">
				<div class="card-header"><i class="far fa-edit mr-2"></i>Atualizar Informações Tipo de Quarto</div>
				<div class="form-row m-4">
					<div class="col-md-12 mb-4">
						<input type="hidden" name="id" value="<?= $tip_id; ?>" />
						<label for="Tipo Quarto">Alterar Tipo de Quarto</label>
						<input type="text" class="form-control" name="tipquarto" placeholder="Tipo Quarto" value="<?= $tip_nome; ?>" required>
					</div>
					<div class="col-12 col-md-3">
						<button class="btn btn-primary btn-block" type="submit">Enviar</button>
					</div>
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
						<p>O Tipo de Quarto foi atualizado com Sucesso!</p>
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
	<script src="../../assets/src/js/jquery.min.js"></script>
	<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>

	<script>
		$('#myModal').on('hidden.bs.modal', function() {
			$(this).removeData('bs.modal');
		});

		const inputs = document.querySelectorAll('form input, form select')

		async function insert(e) {
			e.preventDefault();

			const formData = new FormData()

			for (let i = 0; i < inputs.length; i++) {
				formData.append(inputs[i].name, inputs[i].value)
			}

			const data = await (await fetch('update_tipo.php', {
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