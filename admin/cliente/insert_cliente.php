<?php

include '../conexao.php';

$cep = filter_input(INPUT_POST, 'cep', FILTER_DEFAULT);
$estado = filter_input(INPUT_POST, 'estado', FILTER_DEFAULT);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_DEFAULT);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_DEFAULT);
$rua = filter_input(INPUT_POST, 'rua', FILTER_DEFAULT);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_DEFAULT);
$numero = filter_input(INPUT_POST, 'numero', FILTER_DEFAULT);

$sth = $pdo->prepare("INSERT INTO end_endereco VALUES (DEFAULT, :rua, :bairro, :cidade, :estado, :complemento, :numero, :cep)");

$sth->bindValue(":cep", $cep);
$sth->bindValue(":estado", $estado);
$sth->bindValue(":cidade", $cidade);
$sth->bindValue(":bairro", $bairro);
$sth->bindValue(":rua", $rua);
$sth->bindValue(":complemento", $complemento);
$sth->bindValue(":numero", $numero);

$sth->execute();

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

$sthc = $pdo->prepare("INSERT INTO cli_cliente VALUES (DEFAULT, :nome, :email, :nacionalidade, :datanascimento, :rg, :estadocivil, :cpf, :sexo, :telResidencia, :telCelular, :end_id, cli_status = 0)");

$sthc->bindValue(":nome", $nome);
$sthc->bindValue(":email", $email);
$sthc->bindValue(":nacionalidade", $nacionalidade);
$sthc->bindValue(":datanascimento", $datanascimento);
$sthc->bindValue(":rg", $rg);
$sthc->bindValue(":estadocivil", $estadocivil);
$sthc->bindValue(":cpf", $cpf);
$sthc->bindValue(":sexo", $sexo);
$sthc->bindValue(":telResidencia", $telresidencia);
$sthc->bindValue(":telCelular", $telcelular);
$sthc->bindValue(":end_id", $pdo->lastInsertId());

if ($sthc->execute()) {
    echo '{"status":"1"}';
} else echo '{"status":"0"}';
