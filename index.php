<!DOCTYPE html>

<html lang="pt-br">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Projeto de Conclusão de Curso - Etec">
	<meta name="author" content="Equipe Easy Hostel">

	<title>Easy Hostel</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/icone.png">
	<link rel="stylesheet" href="assets/src/css/sb-admin.css">
</head>

<body class="bg-dark">

	<div class="container">

		<div class="card card-login mx-auto mt-5">
			<div class="card-header text-center">Entrar no Sistema Easy Hostel</div>
			<div class="card-body">
				<form action="admin/logar.php" method="post">


					<?php
					if (isset($_GET['msg'])) {
						$msg = $_GET['msg'];

						switch ($msg) {
							case 1;
								?>

								<div class="col-md-12">
									<div class="mensagem">
										<div class="alert alert-danger text-center" role="alert">
											<a href="admin.php" class="text-center close" data-dismiss="alert">&times</a>
											Email ou Senha incorreto! <br> Tente novamente
										</div>
									</div>
								</div>

						<?php

						}
					}

					?>

						<?php
						if (isset($_GET['msg'])) {
							$msg = $_GET['msg'];

							switch ($msg) {
								case 2;
									?>
									<div class="col-md-12">
										<div class="mensagem">
											<div class="alert alert-success text-center" role="alert">
												<a href="admin.php" class="text-center close" data-dismiss="alert">&times</a>
												Deslogado com Sucesso
											</div>
										</div>
									</div>

							<?php

							}
						}

						?>

							<?php
							if (isset($_GET['msg'])) {
								$msg = $_GET['msg'];

								switch ($msg) {
									case 3;
										?>

										<div class="col-md-12">
											<div class="mensagem">
												<div class="alert alert-danger text-center" role="alert">
													<a href="admin.php" class="text-center close" data-dismiss="alert">&times</a>
													Para ter acesso <br> Primeiro Faça o login
												</div>
											</div>
										</div>

								<?php

								}
							}

							?>
								<div class="form-row">
									<div class="col-md-12 ml-1 text-center">
										<img src="assets/images/logoAdmin.png" alt="Image" class="img-fluid image-absolute">
									</div>
									<div class="col-md-12 mb-4 text-center">
										<input type="text" name="email" class="form-control" placeholder="Login" required>
									</div>
									<div class="col-md-12 mb-4">
										<input type="password" name="senha" class="form-control" placeholder="Senha" required>
									</div>
									<div class="col-md-12  text-center">
										<input class="btn btn-primary btn-block" type="submit" value="Logar" />
									</div>
				</form>
			</div>
		</div>

	</div>


	<script src="assets/src/js/popper.min.js"></script>
	<script src="assets/src/js/jquery.min.js"></script>
	<script src="assets/src/js/bootstrap.min.js"></script>
	<script src="assets/src/js/sb-admin.min.js"></script>


</body>

</html>