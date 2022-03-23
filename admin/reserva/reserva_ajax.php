<link rel="stylesheet" href="../../assets/src/css/sb-admin.css">

<?php
include '../conexao.php';
$data_entrada = filter_input(INPUT_POST, 'data_entrada', FILTER_DEFAULT);
$data_saida = filter_input(INPUT_POST, 'data_saida', FILTER_DEFAULT);


$data = filter_input(INPUT_POST, 'data_entrada', FILTER_DEFAULT);


$begin = new DateTime($data_entrada);
$end = new DateTime($data_saida);
$end = $end->modify('+1 day');

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval, $end);

$sth = $pdo->prepare('SELECT * FROM qua_quarto qq where not EXISTS ( select *from qua_reserva q where qq.qua_id = q.qua_id and q.qre_data BETWEEN :inicial and :final  )');
$sth->bindValue(":inicial", $data_entrada);
$sth->bindValue(":final", $data_saida);

$sth->execute();

if ($sth->rowCount() > 0) :
	?>
	<select class="custom-select" name="quarto" required autofocus="autofocus">
		<option selected class="form-control">Quartos Disponíveis</option>

		<?php
			foreach ($sth as $res) {
				extract($res);
				//echo "<p>Quarto: <div quarto=". $qua_id.">". $qua_numero."</div></p>";
				echo '<option value="' . $qua_id . '">' . $qua_numero . '</option>';
			}
			?>
	</select>
<?php

else :

	echo '<input class="form-control" placeholder="Todos Quartos estão Lotados" readonly="true">';

// echo "LOTADO";

endif;

/*
$encontrado = array();
$nao_encontrado = array();
$sth1 = $pdo->prepare('select *from qua_quarto ');
$sth1->execute();
foreach ($sth1 as $res1) {
	extract($res1);
	$quarto = $qua_id;

	foreach ($daterange as $date) {
		$data = $date->format("Y-m-d");

		$sth2 = $pdo->prepare('select *from qua_reserva where qua_id = :qua_id and qre_data = :dat');
		$sth2->bindValue(":qua_id", $quarto);
		$sth2->bindValue(":dat", $data);
		$sth2->execute();
		if($sth2->rowCount() > 0):
			array_push($encontrado, $quarto);
		else:
			array_push($nao_encontrado, $quarto);
		endif;

	}
}

 $dados = array_unique($nao_encontrado);

 foreach($encontrado as $res1) {
 	if (in_array($res1, $nao_encontrado)){
 		 array_diff($nao_encontrado, $res1);
 		unset($nao_encontrado[$res1]);
 	}
 }

 var_dump(array_unique($nao_encontrado));

 foreach($dados as $res) {
 	echo $res;
}
*/
