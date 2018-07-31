<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('LISTA DOS PRESTADORES DE SERVIÇOS'), 0, 0, 'C');
		$this->Ln();
		/*$this->SetFont('Times', '', 12);
		$this->Cell(276, 10, 'Street address of Employee Office', 0, 0, 'C');*/
		$this->Ln(0);
	}

	function footer () {
		$this->SetY(-15);
		$this->SetFont('Arial', '', 8);
		$this->Cell(0, 10, 'Pag. '.$this->PageNo().'/{nb}', 0, 0, 'C');
		$this->Cell(0, 10, utf8_decode('Centro Ortopédico de Viana.'), 0, 0, 'R');
	}

	function headerTable () {
		$this->SetFont('Times', 'B', 12);
		$this->Cell(50, 10, 'Nome', 1, 0, 'C');
		$this->Cell(40, 10, utf8_decode('NIF'), 1, 0, 'C');
		$this->Cell(40, 10, utf8_decode('Endereço'), 1, 0, 'C');
		$this->Cell(40, 10, utf8_decode('Area de Actuação'), 1, 0, 'C');
		$this->Cell(30, 10, utf8_decode('Telefone'), 1, 0, 'C');
		$this->Cell(50, 10, utf8_decode('E-mail'), 1, 0, 'C');
		$this->Cell(30, 10, utf8_decode('Descrição'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT * FROM tbl_prestadores');
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(50, 10, utf8_decode($data->nome), 1, 0, 'L');
			$this->Cell(40, 10, utf8_decode($data->nif), 1, 0, 'L');
			$this->Cell(40, 10, utf8_decode($data->endereco), 1, 0, 'L');
			$this->Cell(40, 10, utf8_decode($data->area_actuacao), 1, 0, 'L');
			$this->Cell(30, 10, utf8_decode($data->telefone), 1, 0, 'L');
			$this->Cell(50, 10, utf8_decode($data->email), 1, 0, 'L');
			$this->Cell(30, 10, utf8_decode($data->obs), 1, 0, 'L');
			$this->Ln();
		}
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4', 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>