<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$cliente = filter_input(INPUT_POST, 'cliente', FILTER_DEFAULT);
$depnome = filter_input(INPUT_POST, 'depnome', FILTER_DEFAULT);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_DEFAULT);
$pagamento = filter_input(INPUT_POST, 'pagamento', FILTER_DEFAULT);
$quarto = filter_input(INPUT_POST, 'quarto', FILTER_DEFAULT);
$procedencia = filter_input(INPUT_POST, 'procedencia', FILTER_DEFAULT);
$status = filter_input(INPUT_POST, 'stats', FILTER_DEFAULT);
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

$sth = $pdo->prepare("UPDATE res_reserva set res_ultimaprocedencia = :procedencia, res_proximodestino = :destino, res_motivoviagem = :viagem, 
res_dataentrada = :entrada, res_datasaida = :saida, res_mes = :mes, res_ano = :ano, res_horaentrada = :hentrada, res_horasaida = :hsaida, 
res_placacarro = :carro, res_depnome = :depnome, cli_id = :cliente, usu_id = :usuario, for_id = :pagamento, qua_id = :quarto, 
sta_id = :stats WHERE res_id = :id");

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
$sth->bindValue(":cliente", $cliente);
$sth->bindValue(":usuario", $usuario);
$sth->bindValue(":pagamento", $pagamento);
$sth->bindValue(":quarto", $quarto);
$sth->bindValue(":stats", $status);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
} else echo '{"status":"0"}';
