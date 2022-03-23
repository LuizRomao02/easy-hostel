<?php

include '../conexao.php';

$cliente = filter_input(INPUT_POST, 'cliente', FILTER_DEFAULT);
$depnome = filter_input(INPUT_POST, 'depnome', FILTER_DEFAULT);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT);
$pagamento = filter_input(INPUT_POST, 'pagamento', FILTER_DEFAULT);
$quarto = filter_input(INPUT_POST, 'quarto', FILTER_DEFAULT);
$procedencia = filter_input(INPUT_POST, 'procedencia', FILTER_DEFAULT);
$status = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);
$destino = filter_input(INPUT_POST, 'destino', FILTER_DEFAULT);
$viagem = filter_input(INPUT_POST, 'viagem', FILTER_DEFAULT);
$entrada = filter_input(INPUT_POST, 'entrada', FILTER_DEFAULT);
$saida = filter_input(INPUT_POST, 'saida', FILTER_DEFAULT);
$mes = filter_input(INPUT_POST, 'mes', FILTER_DEFAULT);
$ano = filter_input(INPUT_POST, 'ano', FILTER_DEFAULT);
$hentrada = filter_input(INPUT_POST, 'hentrada', FILTER_DEFAULT);
$hsaida = filter_input(INPUT_POST, 'hsaida', FILTER_DEFAULT);
$carro = filter_input(INPUT_POST, 'carro', FILTER_DEFAULT);

$conversaoMes = substr($entrada, 5, 2);
$conversaoAno = substr($entrada, 0, 4);

$sth = $pdo->prepare("INSERT INTO res_reserva VALUES (DEFAULT, :procedencia, :destino, :viagem, :entrada, :saida, :mes, :ano, :hentrada, :hsaida, :carro, :depnome, 1, :cli_id, :usu_id, :for_id, :qua_id, :sta_id)");

$sth->bindValue(":procedencia", $procedencia);
$sth->bindValue(":destino", $destino);
$sth->bindValue(":viagem", $viagem);
$sth->bindValue(":entrada", $entrada);
$sth->bindValue(":saida", $saida);
$sth->bindValue(":mes", $conversaoMes);
$sth->bindValue(":ano", $conversaoAno);
$sth->bindValue(":hentrada", $hentrada);
$sth->bindValue(":hsaida", $hsaida);
$sth->bindValue(":carro", $carro);
$sth->bindValue(":depnome", $depnome);
$sth->bindValue(":cli_id", explode(' ', $cliente)[0]);
$sth->bindValue(":usu_id", $usuario);
$sth->bindValue(":for_id", $pagamento);
$sth->bindValue(":qua_id", $quarto);
$sth->bindValue(":sta_id", $status);

if ($sth->execute()) {
	echo '{"status":"1"}';
} else echo '{"status":"0"}';

$reserva = $pdo->lastInsertId();

$begin = new DateTime($entrada);
$end = new DateTime($saida);
$end = $end->modify('+1 day');

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval, $end);

foreach ($daterange as $date) {
	$dataBd = $date->format("Y-m-d") . "<br>";

	$sth2 = $pdo->prepare("INSERT INTO qua_reserva (res_id, qua_id, qre_data, qre_status) VALUES (:res, :qua, :dat, 1) ");
	
	$sth2->bindValue(":res", $reserva);
	$sth2->bindValue(":qua", $quarto);
	$sth2->bindValue(":dat", $dataBd);

	$sth2->execute();
}
