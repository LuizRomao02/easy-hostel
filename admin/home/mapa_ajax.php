<link rel="stylesheet" href="../../assets/components/fontawesome-free/css/all.min.css" type="text/css">
<link rel="stylesheet" href="../../assets/components/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="../../assets/src/css/sb-admin.css">

<?php

include '../conexao.php';

$data_entrada = filter_input(INPUT_POST, 'data_entrada', FILTER_DEFAULT);
$data_saida = filter_input(INPUT_POST, 'data_saida', FILTER_DEFAULT);

$begin = new DateTime($data_entrada);
$end = new DateTime($data_saida);
$end = $end->modify('+1 day');

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval, $end);

$sth = $pdo->prepare('SELECT distinct cli_nome, qua_numero, res_dataEntrada, res_dataSaida, res_depnome, for_tipo, sta_nome from 
res_reserva as r, cli_cliente as c, qua_quarto as q, qua_reserva as qa, for_formapag as f, qua_status as qs WHERE r.cli_id = c.cli_id and r.qua_id = q.qua_id and 
r.res_id = qa.res_id and r.for_id = f.for_id and r.sta_id = qs.sta_id and EXISTS (select * from qua_reserva q where qa.qua_id = q.qua_id and q.qre_data BETWEEN :inicial and :final) AND res_status = 1 ');

$sth->bindValue(":inicial", $data_entrada);
$sth->bindValue(":final", $data_saida);

$sth->execute();

$sth2 = $pdo->prepare('SELECT * FROM res_reserva r
	INNER JOIN for_formapag f ON r.for_id = f.for_id 
	INNER JOIN cli_cliente c ON r.cli_id = c.cli_id 
	INNER JOIN qua_quarto q ON r.qua_id = q.qua_id 
	INNER JOIN usu_usuario u ON r.usu_id = u.usu_id 
	INNER JOIN qua_status qs ON r.sta_id = qs.sta_id 
	WHERE res_status = 1');

$sth2->execute();

echo '<div class="row">';

if ($sth->rowCount() > 0) :

	?>

	<?php

		foreach ($sth as $res) {

			extract($res);

			foreach ($sth2 as $res) {

				extract($res);

				echo
					'<div class="col-sm-6 col-xl-3 mb-4">
					<div class="card text-white ' . ($sta_nome === 'Ocupado' ? 'bg-danger' : 'bg-warning') . ' border-light">
						<div class="card-header">Quarto ' . $qua_numero . '
							<i onclick="changeData(' . $res_id . ')" style="cursor:pointer;margin-left:100px" data-toggle="modal" data-target="#modalExemplo" class="fas fa-times text-light" data-toggle="rem" title="Remover"></i></a>
						</div>
						<div class="card-body bg-white text-dark border-left border-right ' . ($sta_nome === 'Ocupado' ? 'border-danger' : 'border-warning') . '">
							<small><i class="fas fa-file-signature"></i><span class="ml-1">Responsável: ' . $cli_nome . '<br></span></small>
							<small><i class="far fa-user"></i><span class="ml-2">Dependentes: ' . $res_depnome . '<br></span></small>
							<small><i class="far fa-calendar-alt"></i><span class="ml-2">Data: ' . $res_dataEntrada . '/' . $res_dataSaida . '<br></span></small>
						</div>
						<div class="card-footer text-white clearfix small z-1 text-center">
						<span><i class="far fa-credit-card text-white center" data-toggle="forpag" title="Forma de Pagamento : ' . $for_tipo . ' "></i></span>	
						</div>
					</div>
				</div>';
			}
		}


		?>

<?php

else :

endif;

$sth1 = $pdo->prepare('SELECT * FROM qua_quarto qq where not EXISTS ( select *from qua_reserva q where qq.qua_id = q.qua_id and q.qre_data BETWEEN :inicial and :final  )');

$sth1->bindValue(":inicial", $data_entrada);
$sth1->bindValue(":final", $data_saida);

$sth1->execute();

if ($sth1->rowCount() > 0) :

	?>

	<?php

		foreach ($sth1 as $res) {

			extract($res);

			echo
				'<div class="col-sm-6 col-xl-3 mb-4">
						<div class="card text-white bg-success border-light">
						<div class="card-header">Quarto ' . $qua_numero . '</div>
						<div class="card-body bg-white text-dark border-left border-right border-success' . '">
						<small><i class="fas fa-file-signature"></i><span class="ml-1">Responsável: <br></span></small>
						<small><i class="far fa-user"></i><span class="ml-2">Dependentes: <br></span></small>
						<small><i class="far fa-calendar-alt"></i><span class="ml-2">Data: <br></span></small>
						</div>
						<div class="card-footer text-white clearfix small z-1 text-center">
						<span><i class="far fa-credit-card text-white center" data-toggle="forpag" title="Forma de Pagamento : "></i></span>
						</div>
					</div>
				</div>';
		}

		?>

<?php

	echo '</div>';

else :

endif;

?>

<script src="../../assets/src/js/jquery.min.js"></script>
<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
<script src="../../assets/src/js/sb-admin.min.js"></script>

<script>
	$(document).ready(function() {
		$('[data-toggle="forpag"]').tooltip();
		$('[data-toggle="rem"]').tooltip();
		$('[data-toggle="modal"]').tooltip();
	});
</script>
