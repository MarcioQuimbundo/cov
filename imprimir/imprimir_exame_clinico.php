<?php
require('fpdf/fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode(''), 0, 0, 'C');
		//$this->Ln();
		/*$this->SetFont('Times', '', 12);
		$this->Cell(276, 10, 'Street address of Employee Office', 0, 0, 'C');*/
		$this->Ln();
	}

	function footer () {
		$this->SetY(-15);
		$this->SetFont('Times', '', 10);
		$this->Cell(0, -10, '__________________________________', 0, 0, 'C');
		$this->Cell(-130, 10, utf8_decode('O(a) médico(a)'), 0, 0, 'C');
		$this->SetFont('Times', '', 6);
		$this->Cell(0, 10, utf8_decode('Centro Ortopédico de Viana.'), 0, 0, 'R');
	}

	function headerTable () {				}

	function viewTable ($db) {
		
		$this->SetFont('Times', 'B', 10);
		
		$id = $_GET['id'];
		$stmt = $db->query("SELECT id_paciente, id_medico, exame_clinico, data_cadastro FROM tbl_exame_clinico_consultado WHERE exame_clinico_id = $id");
		$dados = $stmt->fetch(PDO::FETCH_OBJ);
		
		$id_medico = $dados->id_medico;
		$stmtM = $db->query("SELECT display_name FROM tbl_users WHERE id = $id_medico");
		$dadosM =$stmtM->fetch(PDO::FETCH_OBJ);

		$id_paciente = $dados->id_paciente;
		$stmtP = $db->query("SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade FROM tbl_paciente WHERE Id = $id_paciente");
		$dadosP =$stmtP->fetch(PDO::FETCH_OBJ);

		$this->Cell(-1, 10, utf8_decode('Idade: ' . $dadosP->idade), 0, 0, 'L');
		$this->Cell(1, 25, utf8_decode(' Data: '.$dados->data_cadastro), 0, 0, 'L');
		$this->Cell(0, 40, utf8_decode('Médico(a): '.$dadosM->display_name), 0, 0, 'L');
		$this->Cell(-1, 10, utf8_decode($dadosP->nome), 0, 0, 'R');
		$this->Cell(-1, 25, utf8_decode('Número de processo'), 0, 0, 'R');
		$this->Cell(-1, 40, utf8_decode('PROC0'.$dadosP->Id), 0, 0, 'R');
		$this->Cell(-110, 95, utf8_decode('EXAME CLÍNICO '), 0, 0, 'C');
		$this->SetFont('Times', '', 10);
		$this->SetXY(10,100);
		$dados = utf8_decode($dados->exame_clinico);
		$this->MultiCell(0,5,$dados,'J');


	}
}
	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('P',array(148, 210), 0);	
	$pdf->viewTable($db);
	$pdf->headerTable();
	$pdf->Output();

?>