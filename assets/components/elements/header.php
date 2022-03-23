<?php

define("LINK", "..");

?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

	<a class="navbar-brand mr-1" href="<?= LINK ?>/home/dashboard.php">Easy Hostel</a>

	<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
		<i class="fas fa-bars"></i>
	</button>

	<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>

	<ul class="navbar-nav ml-auto ml-md-0">
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-arrow-right"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" data-toggle="modal" data-target="#sair">Sair</a>
			</div>

		</li>
	</ul>

</nav>

<div id="wrapper">

	<ul class="sidebar navbar-nav">
		<li class="nav-item">



			<?php
			if ($_SESSION['Login']['nivel'] == 1) : ?>
				<a class="nav-link" href="<?= LINK ?>/home/">
					<i class="fas fa-chart-line mr-2  mt-3"></i>
					<span>Dashboard</span>
				</a>
				<a class="nav-link" href="<?= LINK ?>/usuario/">
					<i class="fas fa-user mr-2"></i>
					<span>Registrar Usuario</span>
				</a>
			<?php else : ?>
				<p></p>
			<?php endif ?>
			<a class="nav-link" href="<?= LINK ?>/calendario/">
				<i class="far fa-calendar mr-2"></i>
				<span>Calendário</span>
			</a>
			<a class="nav-link" href="<?= LINK ?>/home/mapadehospedes.php">
				<i class="fas fa-user-friends mr-2"></i>
				<span>Mapa de Hospedes</span>
			</a>
			<a class="nav-link" href="<?= LINK ?>/reserva/">
				<i class="fas fa-bed mr-2"></i>
				<span>Fazer Reserva</span>
			</a>

		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-chalkboard-teacher mr-2"></i>
				<span>Cadastros</span>
			</a>
			<div class="dropdown-menu" aria-labelledby="pagesDropdown">
				<h6 class="dropdown-header">Temos:</h6>
				<?php

				if ($_SESSION['Login']['nivel'] == 1) : ?>
					<a class="dropdown-item" href="<?= LINK ?>/cliente/">Cliente</a>
					<a class="dropdown-item" href="<?= LINK ?>/produto/">Produto</a>
					<a class="dropdown-item" href="<?= LINK ?>/quarto/">Quarto</a>
					<a class="dropdown-item" href="<?= LINK ?>/pagamento/">Tipo de Pagamento</a>
					<a class="dropdown-item" href="<?= LINK ?>/tipo/">Tipo de Quarto</a>
				<?php else : ?>
					<a class="dropdown-item" href="<?= LINK ?>/cliente/">Cliente</a>
				<?php endif ?>

			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-list mr-2"></i>
				<span>Tabelas</span>
			</a>
			<div class="dropdown-menu" aria-labelledby="pagesDropdown">
				<h6 class="dropdown-header">Temos:</h6>

				<?php

				if ($_SESSION['Login']['nivel'] == 1) : ?>
					<a class="dropdown-item" href="<?= LINK ?>/cliente/tabela_cliente.php">Cliente</a>
					<a class="dropdown-item" href="<?= LINK ?>/usuario/tabela_usuario.php">Usuário</a>
					<a class="dropdown-item" href="<?= LINK ?>/produto/tabela_produto.php">Produto</a>
					<a class="dropdown-item" href="<?= LINK ?>/quarto/tabela_quarto.php">Quarto</a>
					<a class="dropdown-item" href="<?= LINK ?>/pagamento/tabela_pagamento.php">Tipo de Pagamento</a>
					<a class="dropdown-item" href="<?= LINK ?>/tipo/tabela_tipo.php">Tipo de Quarto</a>
					<a class="dropdown-item" href="<?= LINK ?>/reserva/tabela_reserva.php">Reserva</a>
				<?php else : ?>
					<a class="dropdown-item" href="<?= LINK ?>/cliente/tabela_cliente.php">Cliente</a>
					<a class="dropdown-item" href="<?= LINK ?>/reserva/tabela_reserva.php">Reserva</a>
				<?php endif ?>

			</div>
		</li>
	</ul>