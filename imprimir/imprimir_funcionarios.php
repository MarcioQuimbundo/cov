<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('LISTA DOS FUNCIONÁRIOS'), 0, 0, 'C');
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
		$this->Cell(20, 10, utf8_decode('NºProc'), 1, 0, 'C');
		$this->Cell(60, 10, 'Nome', 1, 0, 'C');
		$this->Cell(40, 10, utf8_decode('Função'), 1, 0, 'C');
		$this->Cell(60, 10, 'Genero', 1, 0, 'C');
		$this->Cell(36, 10, 'Telefone', 1, 0, 'C');
		$this->Cell(50, 10, utf8_decode('Endereço'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT * FROM tbl_funcionario');
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(20, 10, '000'.$data->Id, 1, 0, 'C');
			$this->Cell(60, 10, $data->nome, 1, 0, 'L');
			$this->Cell(40, 10, utf8_decode($data->funcao), 1, 0, 'L');
			$this->Cell(60, 10, $data->genero, 1, 0, 'L');
			$this->Cell(36, 10, $data->telefone, 1, 0, 'L');
			$this->Cell(50, 10, utf8_decode($data->endereco), 1, 0, 'L');
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