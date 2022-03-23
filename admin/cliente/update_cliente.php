<?php

include '../conexao.php';

$id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
$cep = filter_input(INPUT_POST, 'cep', FILTER_DEFAULT);
$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_DEFAULT);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_DEFAULT);
$rua = filter_input(INPUT_POST, 'rua', FILTER_DEFAULT);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_DEFAULT);
$numero = filter_input(INPUT_POST, 'numero', FILTER_DEFAULT);

$nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$nacionalidade = filter_input(INPUT_POST, 'nacionalidade', FILTER_DEFAULT);
$datanascimento = filter_input(INPUT_POST, 'datanascimento', FILTER_DEFAULT);
$rg = filter_input(INPUT_POST, 'rg', FILTER_DEFAULT);
$estadocivil = filter_input(INPUT_POST, 'estadocivil', FILTER_DEFAULT);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_DEFAULT);
$sexo = filter_input(INPUT_POST, 'sexo', FILTER_DEFAULT);
$telresidencia = filter_input(INPUT_POST, 'telefone', FILTER_DEFAULT);
$telcelular = filter_input(INPUT_POST, 'celular', FILTER_DEFAULT);

$sth = $pdo->prepare("UPDATE end_endereco set end_cep = :cep, end_estado = :estado, end_cidade = :cidade, end_bairro = :bairro, 
end_rua = :rua, end_complemento = :complemento, end_numero = :numero WHERE end_id = :id");

$sth->bindValue(":cep", $cep);
$sth->bindValue(":estado", $estado);
$sth->bindValue(":cidade", $cidade);
$sth->bindValue(":bairro", $bairro);
$sth->bindValue(":rua", $rua);
$sth->bindValue(":complemento", $complemento);
$sth->bindValue(":numero", $numero);
$sth->bindValue(":id", $id);

$sth->execute();

$end_id = $pdo->lastInsertId();

$sth = $pdo->prepare("UPDATE cli_cliente set cli_nome = :nome, cli_email = :email, cli_nacionalidade = :nacionalidade, cli_datanascimento = :datanascimento,
cli_rg = :rg, cli_estadocivil = :estadocivil, cli_cpf = :cpf, cli_sexo = :sexo, cli_telresidencia = :telefone, cli_telcelular = :celular WHERE cli_id = :id");

$sth->bindValue(":nome", $nome);
$sth->bindValue(":email", $email);
$sth->bindValue(":nacionalidade", $nacionalidade);
$sth->bindValue(":datanascimento", $datanascimento);
$sth->bindValue(":rg", $rg);
$sth->bindValue(":estadocivil", $estadocivil);
$sth->bindValue(":cpf", $cpf);
$sth->bindValue(":sexo", $sexo);
$sth->bindValue(":telefone", $telresidencia);
$sth->bindValue(":celular", $telcelular);
$sth->bindValue(":id", $id);

if ($sth->execute()) {
	echo '{"status":"1"}';
 } else echo '{"status":"0"}';
 