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
	<script src="../../assets/src/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

</head>

<body id="page-top">

	<script type="text/javascript">
		$(document).ready(function() {

			function limpa_formulário_cep() {
				$("#rua").val("");
				$("#bairro").val("");
				$("#cidade").val("");
				$("#uf").val("");
			}

			$("#cep").blur(function() {

				var cep = $(this).val().replace(/\D/g, '');

				if (cep != "") {

					var validacep = /^[0-9]{8}$/;

					if (validacep.test(cep)) {

						$("#rua").val("...");
						$("#bairro").val("...");
						$("#cidade").val("...");
						$("#uf").val("...");

						$.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

							if (!("erro" in dados)) {
								$("#rua").val(dados.logradouro);
								$("#bairro").val(dados.bairro);
								$("#cidade").val(dados.localidade);
								$("#uf").val(dados.uf);
								$("#pais").val("");

							} else {
								limpa_formulário_cep();
								alert("CEP não encontrado.");
							}
						});
					} else {
						limpa_formulário_cep();
						alert("Formato de CEP inválido.");
					}
				} else {
					limpa_formulário_cep();
				}
			});
		});
	</script>

	<?php
	include '../../assets/components/elements/header.php'
	?>


	<?php

	include '../conexao.php';
	$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

	$sth = $pdo->prepare("SELECT * FROM cli_cliente c INNER JOIN end_endereco e ON c.end_id = e.end_id 
	where cli_id = :id");
	$sth->bindValue(":id", $id, PDO::PARAM_INT);
	$sth->execute();
	$resultado = $sth->fetch(PDO::FETCH_ASSOC);
	extract($resultado);

	?>

	<div id="content-wrapper">

		<div class="container-fluid">

			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Atualizar Informações de Cliente</li>
			</ol>

			<form class="card m-5" onsubmit="insert(event); return false" method="post">
				<div class="card-header"><i class="far fa-edit mr-2"></i>Atualizar Informações de Cliente</div>
				<div class="form-row m-4">
					<div class="col-md-6 mb-4">
						<input type="hidden" name="id" value="<?= $cli_id; ?>" />
						<label for="Nome">Alterar Nome</label>
						<input type="text" class="form-control" name="nome" placeholder="Nome" value="<?= $cli_nome; ?>" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Email">Alterar E-mail</label>
						<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $cli_email; ?>" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Nacionalidade">Alterar Nacionalidade</label>
						<input type="text" class="form-control" name="nacionalidade" placeholder="Nacionalidade" value="<?= $cli_nacionalidade; ?>" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="DataNascimento">Alterar Data de Nascimento</label>
						<input type="date" class="form-control" name="datanascimento" placeholder="Data de Nascimento" value="<?= $cli_datanascimento; ?>" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="EstadoCivil">Alterar Estado Civíl</label>
						<select class="custom-select" name="estadocivil" value="<?= $cli_estadocivil; ?>" required>
							<option value="0">Escolha a Opção</option>
							<option value="Solteiro">Solteiro</option>
							<option value="Casado">Casado</option>
							<option value="Viúvo">Viúvo</option>
							<option value="Separado">Separado judicialmente</option>
							<option value="Divorciado">Divorciado</option>
						</select>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Sexo">Alterar Sexo</label>
						<select class="custom-select" name="sexo" value="<?= $cli_sexo; ?>" required>
							<option value="0" disabled selected>Escolha a Opção</option>
							<option value="Masculino">Masculino</option>
							<option value="Feminino">Feminino</option>
						</select>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Rg">Alterar Rg</label>
						<input type="text" class="form-control" name="rg" id="rg" placeholder="Rg" value="<?= $cli_rg; ?>" required>
					</div>
					<div class="col-md-4 mb-4">
						<label for="Cpf">Alterar Cpf</label>
						<input type="text" class="form-control" name="cpf" id="cpf" placeholder="Cpf" value="<?= $cli_cpf; ?>" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Telefone">Alterar Telefone Residencial</label>
						<input type="text" class="form-control" name="telefone" id="tel" placeholder="Telefone Residencial" value="<?= $cli_telResidencia; ?>" required>
					</div>
					<div class="col-md-6 mb-4">
						<label for="Celular">Alterar Celular</label>
						<input type="text" class="form-control" name="celular" id="cel" placeholder="Celular" value="<?= $cli_telCelular; ?>" required>
					</div>
					<div class="col-md-3 mb-4">
						<input type="hidden" name="id" value="<?= $end_id; ?>" />
						<label for="Cep">Alterar Cep</label>
						<div class="input-group">
							<input type="text" id="cep" class="form-control" name="cep" placeholder="Cep" aria-label="Search" aria-describedby="basic-addon2" value="<?= $end_cep; ?>" required>
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search"></i>
								</button>
							</div>
						</div>
					</div>
					<div class="col-md-3 mb-4">
						<label for="Estado">Estado</label>
						<input type="text" id="uf" class="form-control" name="estado" placeholder="Estado" value="<?= $end_estado; ?>" required>
					</div>
					<div class="col-md-3 mb-4">
						<label for="Cidade">Cidade</label>
						<input type="text" id="cidade" class="form-control" name="cidade" placeholder="Cidade" value="<?= $end_cidade; ?>" required>
					</div>
					<div class="col-md-3 mb-4">
						<label for="Bairro">Bairro</label>
						<input type="text" id="bairro" class="form-control" name="bairro" placeholder="Bairro" value="<?= $end_bairro; ?>" required>
					</div>
					<div class="col-md-5 mb-4">
						<label for="Rua">Rua</label>
						<input type="text" id="rua" class="form-control" name="rua" placeholder="Rua" value="<?= $end_rua; ?>" required>
					</div>
					<div class="col-md-5 mb-4">
						<label for="Complemento">Alterar Complemento</label>
						<input type="text" class="form-control" name="complemento" placeholder="Complemento" value="<?= $end_complemento; ?>" required>
					</div>
					<div class="col-md-2 mb-4">
						<label for="Numero">Alterar Número</label>
						<input type="number" class="form-control" name="numero" placeholder="Número" value="<?= $end_numero; ?>" required>
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
						<p>O Cliente foi atualizado com Sucesso!</p>
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
	<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>
	<script src="../../assets/src/js/jquery.mask.js"></script>

	<script>
		$(document).ready(function() {
			$("#cpf").mask("000.000.000-00")
			$("#rg").mask("00.000.000-A")
			$("#cel").mask("(00) 00000-0000")
			$("#tel").mask("(00) 0000-0000")
			$("#cep").mask("00000-000")
		})
	</script>

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

			const data = await (await fetch('update_cliente.php', {
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