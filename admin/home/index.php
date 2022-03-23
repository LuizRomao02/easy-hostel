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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

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
				<li class="breadcrumb-item active">Início</li>
			</ol>

			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center my-4 border-bottom"></div>

			<div class="row text-left">

				<div class="col-md-4 col-sm-12 mb-3">
					<div class="card text-white bg-danger o-hidden h-100">
						<div class="card-body">
							<div class="card-body-icon">
								<i class="fas fa-bed" style="position: absolute;z-index: 0;top: 60px;right: 2rem;opacity: 1;font-size:50px;-webkit-transform:  rotate(-15deg);transform: 0;"></i>
							</div>
							<?php
							include_once('../conexao.php');

							$sth = $pdo->prepare('SELECT COUNT(qua_id) FROM qua_reserva where (SELECT qre_data = CURDATE() LIMIT 1)');

							$sth->execute();
							$quantidade = $sth->fetchColumn();
							?>
							<h3 class="mr-5"><?= $quantidade ?></h3>
							<span>Acomodações Ocupadas Hoje</span>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 mb-3">
					<div class="card text-white bg-success o-hidden h-100">
						<div class="card-body">
							<div class="card-body-icon">
								<i class="fas fa-home" style="position: absolute;z-index: 0;top: 60px;right: 2rem;opacity: 1;font-size:50px;-webkit-transform:  rotate(-15deg);transform: 0;"></i>
							</div>
							<?php
							include_once('../conexao.php');

							$sth = $pdo->prepare("SELECT * FROM qua_quarto qq where not EXISTS ( select *from qua_reserva q where qq.qua_id = q.qua_id and q.qre_data = CURDATE() LIMIT 1)");
							$sth->execute();
							?>
							<h3 class="mr-5"><?= $sth->rowCount(); ?></h3>
							<span>Acomodações Disponíveis Hoje</span>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 mb-3">
					<div class="card text-white bg-info o-hidden h-100">
						<div class="card-body">
							<div class="card-body-icon">
								<i class="far fa-user" style="position: absolute;z-index: 0;top: 60px;right: 2rem;opacity: 1;font-size:50px;-webkit-transform:  rotate(-15deg);transform: 0;"></i>
							</div>
							<?php
							include_once('../conexao.php');

							$sth = $pdo->prepare('SELECT COUNT(cli_id) FROM cli_cliente LIMIT 1');

							$sth->execute();
							$quantidade = $sth->fetchColumn();
							?>
							<h3 class="mr-5"><?= $quantidade ?></h3>
							<span>N ° de Hospedes Cadastrados</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="offset-lg-1 col-lg-10 mb-4">
				<form action="#" class="card mt-2" method="POST">
					<div class="card-header"><i class="fas fa-angle-right mr-2"></i>Selecione o ano para verificar a quantidade de Hospedes nos meses</div>
					<div class="form-row mx-3 my-4">
						<div class="col-md-10 mb-4">
							<label for="Entrada">Selecionar o ano</label>
							<select class="custom-select" method="" name="ano" required>
								<option selected class="form-control">Selecionar o ano</option>
								<?php
								for ($i = date("Y") + 1; $i > date("Y") - 10; $i--) {
									echo '<option value="' . $i . '">' . $i . '</option>';
								}
								?>
							</select>
						</div>
						<form action="#">
							<div class="col-md-2 mb-4">
								<label for="#"><br></label>
								<button class="btn btn-primary btn-block w-75" type="submit" href="#grafico">Enviar</button><span id="loading">
							</div>
						</form>
					</div>
				</form>
			</div>
		</div>

		<?php

		?>

		<?php

		$ano = filter_input(INPUT_POST, 'ano', FILTER_DEFAULT);

		include '../conexao.php';

		$sth = $pdo->prepare("SELECT COUNT(res_mes) as res_mes FROM res_reserva where (SELECT res_mes = 01) AND (SELECT res_ano = $ano) and res_status = 1 
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 02) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 03) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 04) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 05) AND (SELECT res_ano = $ano) and res_status = 1 
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 06) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 07) AND (SELECT res_ano = $ano) and res_status = 1 
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 08) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 09) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 10) AND (SELECT res_ano = $ano) and res_status = 1
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 11) AND (SELECT res_ano = $ano) and res_status = 1 
				UNION ALL SELECT COUNT(res_mes) FROM res_reserva where (SELECT res_mes = 12) AND (SELECT res_ano = $ano) and res_status = 1");

		$sth->execute();

		while ($pdo = $sth->fetch(PDO::FETCH_ASSOC)) {
			extract($pdo);
			$json[] = $res_mes;
		}

		?>

		<?php

		$ano = filter_input(INPUT_POST, 'ano', FILTER_DEFAULT);

		for ($i = date("Y") + 1; $i > date("Y") - 10; $i--) {
			if ($ano == $i) {
				echo '
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							<div class="card mb-3" id="grafico">
								<div class="card-header">
									<i class="fas fa-chart-bar"></i>
									<span class="ml-2">Gráfico do Ano de ' . $ano . ' </span>
								</div>
								<div class="card-body">
									<canvas id="Bar" width="100%" height="35"></canvas>
								</div>
								<div class="card-footer small text-muted">Atualizado</div>
							</div>
						</div>
					</div>
				';
			} else { }
		}

		?>

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

	<script src="../../assets/src/js/jquery.min.js"></script>
	<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../assets/components/chart.js/Chart.min.js"></script>
	<script src="../../assets/components/datatables/jquery.dataTables.min.js"></script>
	<script src="../../assets/components/datatables/dataTables.bootstrap4.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>
	<script src="../../assets/components/demo/datatables-demo.js"></script>

	<script>
		var ctx = document.getElementById('Bar').getContext('2d');
		var chart = new Chart(ctx, {
			type: 'bar',


			data: {
				labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				datasets: [{
					label: "Mês",
					lineTension: 0.3,
					backgroundColor: "rgba(2,117,216,1)",

					data: <?php echo json_encode($json); ?>
				}],
			},

			options: {
				scales: {
					xAxes: [{
						time: {
							unit: 'date'
						},
						gridLines: {
							display: false
						},
						ticks: {
							maxTicksLimit: 12
						}
					}],
					yAxes: [{
						ticks: {
							min: 0,
							max: 500,
							maxTicksLimit: 6
						},
						gridLines: {
							color: "rgba(0, 0, 0, .125)",
						}
					}],
				},
				legend: {
					display: true
				}
			}
		});
	</script>

</body>

</html>
