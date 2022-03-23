$(function () {
	$(document).on('submit', 'form[name="formularioReserva"]', function () {
		var forma = $(this);
		var data_inicial = $("input[name=data_entrada]").val();
		var data_saida = $("input[name=data_saida]").val();

		var dados = forma.serialize();

		$.ajax({
			url: 'reserva_ajax.php',
			data: dados,
			method: 'POST',
			beforeSend: function () {

			},
			success: function (resposta) {
				$('form[name="reservar_clientes"]').show();
				$('input[name="entrada"]').val(data_inicial);
				$('input[name="saida"]').val(data_saida);
				$('.select_quarto').html(resposta);
			},
			complete: function () {

			}
		});

		return false;
	});
});
