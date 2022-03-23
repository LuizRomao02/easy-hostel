<?php

require '../../assets/components/fpdf182/fpdf.php';

class PDF extends FPDF
{
	function Header()
	{
		$this->SetFont('Arial', 'B', '9');
		$this->Cell(60);
		$this->Image('../../assets/images/turismo.jpg', 141, 4, 50);
		$this->Cell(190, 1, utf8_decode(''), 0, 1, 'C');
		$this->Cell(190, 5, utf8_decode('FICHA NACIONAL DE REGISTRO DE HÓSPEDES - FNRH'), 0, 1, 'L');
		$this->Cell(95, 5, utf8_decode('RAZÃO SOCIAL: VICENTE DE PAULO MACEDO RODRIGUES'), 0, 0, 'L');
		$this->Cell(95, 5, utf8_decode('CNPJ: 12.791.801/0001-00'), 0, 1, 'L');
		$this->Cell(95, 5, utf8_decode('NOME FANTASIA: POUSADA DO ZÉ LOUQUINHO'), 0, 1, 'L');
		$this->Cell(95, 5, utf8_decode('CNAE: 55.10-8-01'), 0, 1, 'L');
		$this->Cell(95, 5, utf8_decode('ENDEREÇO: AV ITAGUAÇU - 3530'), 0, 0, 'L');
		$this->Cell(42.5, 5, utf8_decode('CEP:12.570-000'), 0, 0, 'L');
		$this->Cell(42.5, 5, utf8_decode('TELEFONE: (12) 3105-4945'), 0, 1, 'L');
		$this->Cell(35, 5, utf8_decode('ESTADO: SP'), 0, 0, 'L');
		$this->Cell(60, 5, utf8_decode('MUNICÍPIO: APARECIDA'), 0, 0, 'L');
		$this->Cell(95, 5, utf8_decode('E-MAIL: pzeloquinho@gmail.com'), 0, 0, 'L');
		$this->Ln(12);
	}

	function Title()
	{
		$this->SetFont('Arial', 'U', '12');
		$this->Cell(190, 1, utf8_decode('Condiçoes Gerais:'), 0, 2, 'C');
		$this->Ln(5);
	}

	function Main()
	{
		$this->SetFont('Arial', 'B', '8');
		$this->SetX(-193);
		$this->Cell(8, 5, utf8_decode(chr(127)), 0, 0, 'L');
		$this->Cell(185, 5, utf8_decode('Todos os campos são de preenchimento obrigatório;'), 0, 1, 'L');
		$this->SetX(-193);
		$this->Cell(8, 5, utf8_decode(chr(127)), 0, 0, 'L');
		$this->Cell(190, 5, utf8_decode('A FRNH deve ser preenchida por pessoa;'), 0, 1, 'L');
		$this->SetX(-193);
		$this->Cell(8, 5, utf8_decode(chr(127)), 0, 0, 'L');
		$this->Cell(193, 5, utf8_decode('Esta ficha é uma ferramenta para agilizar seu check in e deve ser preenchida quando da existência de uma reserva já confirmada '), 0, 1, 'L');
		$this->SetX(-185);
		$this->Cell(190, 5, utf8_decode('no hotel. Não é válida com confirmação de reserva por parte do hotel;'), 0, 1, 'L');
		$this->SetX(-193);
		$this->Cell(8, 5, utf8_decode(chr(127)), 0, 0, 'L');
		$this->Cell(50, 5, utf8_decode('Check in: a partir das 13:00h'), 0, 0, 'L');
		$this->Cell(125, 5, utf8_decode(' Check out: até as 12:00h;'), 0, 1, 'L');
		$this->Ln(5);
	}

	function Content()
	{
		$this->SetFont('Arial', 'B', '9');
		$this->Ln(3);
		$this->Cell(190, 5, utf8_decode('Para crianças de até 12 anos hospedada no mesmo apartamento dos pais ou responsáveis, solicitamos inserir os dados '), 'T,L,R', 1, 'L', 0,);
		$this->Cell(190, 5, utf8_decode('abaixo. A partir dos 13 anos preencher Ficha de Hóspede individual: '), 'L,R', 1, 'L', 0,);
		$this->SetFont('Arial', 'U', '8');
		$this->Cell(190, 6, utf8_decode('Criança 01: '), 'L,R', 1, 'L', 0,);
		$this->SetFont('Arial', '', '9');
		$this->Cell(190, 6, utf8_decode('Nome: '), 'L,R', 1, 'L', 0,);
		$this->Cell(42.5, 6, utf8_decode('Sexo: M/F'), 'L', 0, 'L', 0,);
		$this->Cell(147.5, 6, utf8_decode('Data de Nascimento: '), 'R', 1, 'L', 0,);
		$this->SetFont('Arial', 'U', '8');
		$this->Cell(190, 6, utf8_decode('Criança 02: '), 'L,R', 1, 'L', 0,);
		$this->SetFont('Arial', '', '9');
		$this->Cell(190, 6, utf8_decode('Nome: '), 'L,R', 1, 'L', 0,);
		$this->Cell(42.5, 6, utf8_decode('Sexo: M/F'), 'L', 0, 'L', 0,);
		$this->Cell(147.5, 6, utf8_decode('Data de Nascimento: '), 'R', 1, 'L', 0,);
		$this->Cell(190, 1, utf8_decode(''), 'L,R', 1, 'L', 0,);
		$this->SetFont('Arial', '', '8');
		$this->Cell(190, 6, utf8_decode('Por determinação da Lei Federal nº 8069/1990, não permitimos a hospedagem de menores de 18 anos, salvo se acompanhado por seus pais ou '), 'L,R', 1, 'L', 0,);
		$this->Cell(190, 6, utf8_decode('responsáveis. Os menores de 18 anos deverão apresentar no momento do check in documento com foto que comprove a sua identidade e filiação, '), 'L,R', 1, 'L', 0,); 
		$this->Cell(190, 6, utf8_decode('ainda que estejam acompanhados pelos pais.'), 'L,R', 1, 'L', 0,);
		$this->Cell(190, 1, utf8_decode(''), 'L,R', 1, 'L', 0,);
		$this->SetFont('Arial', '', '9');
		$this->Cell(190, 6, utf8_decode('Nome do Responsável: '), 'L,R', 1, 'L', 0,);
		$this->Cell(190, 3, utf8_decode(''), 'L, R, B', 1, 'L', 0,);

		$this->SetFont('Arial', 'B', '8');
		$this->Cell(190, 5, utf8_decode(''), '', 1, 'L', 0,);
		$this->Cell(190, 1, utf8_decode('Assinatura eletrônica: '), 0, 1, 'L', 0,);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 10, 'Page ' . $this->PageNo() . '', 0, 0, 'C');
	}
}

require '../conexao.php';

$id = $_GET['id'];

$consulta = ("SELECT distinct cli_nome, cli_email, cli_telResidencia, cli_telCelular, cli_estadoCivil, cli_nacionalidade, 
	cli_dataNascimento, cli_sexo, cli_rg, cli_cpf, end_bairro, end_cidade, end_estado, res_ultimaprocedencia, res_proximodestino, 
	res_motivoviagem, res_depnome, res_dataentrada, res_datasaida, res_placacarro, res_id from res_reserva as r, cli_cliente as 
	c, end_endereco as e WHERE r.cli_id = c.cli_id and r.cli_id = e.end_id and res_id = $id");

$resultado = $pdo->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->Title();
$pdf->Main();
$pdf->SetFont('Arial', '', 9);


while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {

	$pdf->SetFont('Arial', 'B', '8');
	$pdf->Cell(65, 12, utf8_decode('Nome: ') . ($row['cli_nome']), 1, 0, 'L', 0,);
	$pdf->Cell(45, 12, utf8_decode('Email: ') . ($row['cli_email']), 1, 0, 'L', 0);
	$pdf->Cell(40, 12, utf8_decode('Telefone: ') . ($row['cli_telResidencia']), 1, 0, 'L', 0);
	$pdf->Cell(40, 12, utf8_decode('Celular: ') . ($row['cli_telCelular']), 1, 1, 'L', 0);
	$pdf->Cell(65, 12, utf8_decode('Estado Civil: ') . ($row['cli_estadoCivil']), 1, 0, 'L', 0);
	$pdf->Cell(45, 12, utf8_decode('Nacionalidade: ') . ($row['cli_nacionalidade']), 1, 0, 'L', 0);
	$pdf->Cell(40, 12, utf8_decode('Data Nasc: ') . ($row['cli_dataNascimento']), 1, 0, 'L', 0);
	$pdf->Cell(40, 12, utf8_decode('Gênero: ') . ($row['cli_sexo']), 1, 1, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Documento de Identidade RG: ') . ($row['cli_rg']), 1, 0, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Número CPF: ') . ($row['cli_cpf']), 1, 1, 'L', 0);
	$pdf->Cell(65, 12, utf8_decode('Bairro: ') . ($row['end_bairro']), 1, 0, 'L', 0);
	$pdf->Cell(65, 12, utf8_decode('Cidade: ') . ($row['end_cidade']), 1, 0, 'L', 0);
	$pdf->Cell(30, 12,  utf8_decode('Estado: ') . ($row['end_estado']), 1, 0, 'L', 0);
	$pdf->Cell(30, 12,  utf8_decode('País'), 1, 1, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Última Procedência: ') . ($row['res_ultimaprocedencia']), 1, 0, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Próximo Destino: ') . ($row['res_proximodestino']), 1, 1, 'L', 0);
	$pdf->Cell(190, 12, utf8_decode('Motivo da Viagem: ') . ($row['res_motivoviagem']), 1, 1, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Dependentes: ') . ($row['res_depnome']), 1, 0, 'L', 0);
	$pdf->Cell(47.5, 12, utf8_decode('Data de Entrada: ') . ($row['res_dataentrada']), 1, 0, 'L', 0);
	$pdf->Cell(47.5, 12, utf8_decode('Data de Saída: ') . ($row['res_datasaida']), 1, 1, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Como conheceu a Pousada?'), 1, 1, 'L', 0);
	$pdf->Cell(95, 12, utf8_decode('Placa do Carro: ') . ($row['res_placacarro']), 1, 0, 'L', 0);
	$pdf->Cell(95, -12, '', 0, 2, 'L', 0);
	$pdf->Cell(95, 24, utf8_decode('Observação'), 1, 1, 'L', 0);

	$pdf->Content();
}

$pdf->Output();
