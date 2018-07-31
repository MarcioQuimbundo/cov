<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('RELATÓRIO DOS AGENDAMENTOS FEITOS'), 0, 0, 'C');
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
		$this->Cell(40, 10, utf8_decode('Data'), 1, 0, 'C');
		$this->Cell(80, 10, utf8_decode('Funcionário'), 1, 0, 'C');
		$this->Cell(80, 10, utf8_decode('Paciente'), 1, 0, 'C');
		$this->Cell(80, 10, utf8_decode('Serviços'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT * FROM tbl_agenda INNER JOIN tbl_paciente on(tbl_agenda.id_paciente = tbl_paciente.Id) INNER JOIN tbl_users on(tbl_agenda.user_id = tbl_users.id) WHERE agendado=1');
		//var_dump($stmt);
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(40, 10, $data->data_agenda, 1, 0, 'C');
			$this->Cell(80, 10, $data->user_name, 1, 0, 'L');
			$this->Cell(80, 10, utf8_decode($data->nome), 1, 0, 'L');
			$this->Cell(80, 10, $data->servicos, 1, 0, 'L');
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