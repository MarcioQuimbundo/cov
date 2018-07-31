<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('HISTÓRICO DE DEVOLUÇÕES DOS S. ESTOMATOLOGIA'), 0, 0, 'C');
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
		$this->Cell(20, 10, utf8_decode('Nº fatura'), 1, 0, 'C');
		$this->Cell(85, 10, utf8_decode('Paciente'), 1, 0, 'C');
		$this->Cell(95, 10, utf8_decode('Serviço'), 1, 0, 'C');
		$this->Cell(35, 10, utf8_decode('Total'), 1, 0, 'C');
		$this->Cell(45, 10, utf8_decode('Data devolução'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT * FROM tbl_devolucao_servicos_estomatologia');
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(20, 10, $data->n_fatura, 1, 0, 'C');
			$this->Cell(85, 10, $data->paciente, 1, 0, 'L');
			$this->Cell(95, 10, utf8_decode($data->servico), 1, 0, 'L');
			$this->Cell(35, 10, utf8_decode($data->total), 1, 0, 'L');
			$this->Cell(45, 10, utf8_decode($data->data_devolucao), 1, 0, 'L');
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