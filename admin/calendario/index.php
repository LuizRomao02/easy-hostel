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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

</head>

<body id="page-top">

	<?php
	include '../../assets/components/elements/header.php'
	?>


	<div id="content-wrapper">

		<div class="container-fluid">

			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Calendario</li>
			</ol>

			<div class="container">
				<div class="card p-4 m-4" id="calendar"></div>
			</div>

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

	<script src="../../assets/src/js/popper.min.js"></script>
	<script src="../../assets/src/js/jquery.min.js"></script>
	<script src="../../assets/src/js/bootstrap.min.js"></script>
	<script src="../../assets/src/js/bootstrap.bundle.min.js"></script>
	<script src="../../assets/components/jquery-easing/jquery.easing.min.js"></script>
	<script src="../../assets/src/js/sb-admin.min.js"></script>
	<script src="../../assets/src/js/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


	<script>
		$(document).ready(function() {
			var calendar = $('#calendar').fullCalendar({
				monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
				monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
				dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
				dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
				editable: true,
				eventColor: "#64b5f6 ",
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				events: 'load.php',
				selectable: true,
				selectHelper: true,
				select: function(start, end, allDay) {
					var title = prompt("Coloque o Titulo do evento");
					if (title) {
						var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
						var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
						$.ajax({
							url: "insert.php",
							type: "POST",
							data: {
								title: title,
								start: start,
								end: end
							},
							success: function() {
								calendar.fullCalendar('refetchEvents');
								alert("Adicionado com sucesso");
							}
						})
					}
				},
				editable: true,
				eventResize: function(event) {
					var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
					var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
					var title = event.title;
					var id = event.id;
					$.ajax({
						url: "update.php",
						type: "POST",
						data: {
							title: title,
							start: start,
							end: end,
							id: id
						},
						success: function() {
							calendar.fullCalendar('refetchEvents');
							alert('Deseja mudar este evento?');
						}
					})
				},

				eventDrop: function(event) {
					var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
					var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
					var title = event.title;
					var id = event.id;
					$.ajax({
						url: "update.php",
						type: "POST",
						data: {
							title: title,
							start: start,
							end: end,
							id: id
						},
						success: function() {
							calendar.fullCalendar('refetchEvents');
							alert("Evento modificado com sucesso");
						}
					});
				},

				eventClick: function(event) {
					if (confirm("Você deseja mesmo excluir este evento?")) {
						var id = event.id;
						$.ajax({
							url: "delete.php",
							type: "POST",
							data: {
								id: id
							},
							success: function() {
								calendar.fullCalendar('refetchEvents');
								alert("Evento excluido com sucesso");
							}
						})
					}
				},

			});
		});
	</script>
</body>

</html>
