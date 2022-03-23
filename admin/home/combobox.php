<select class="custom-select" method="" name="ano" required>
	<option selected class="form-control">Selecionar o ano</option>
	<?php

	for ($i = date("Y") + 1; $i > date("Y") - 10; $i--) {
		echo '<option value="' . $i . '">' . $i . '</option>';
	}
	?>
</select>

<?php

$ano = filter_input(INPUT_POST, 'ano', FILTER_DEFAULT);

?>
