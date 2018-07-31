<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Times', 'B', 10);

		$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

		$id = $_GET['id'];
		$stmt = $db->query("SELECT medico, id_paciente, data_receita FROM tbl_receitas WHERE id_receita = $id");
		$dados = $stmt->fetch(PDO::FETCH_OBJ);
		//var_dump($stmt);
		$id_medico = $dados->medico;
		$stmtM = $db->query("SELECT display_name FROM tbl_users WHERE id = $id_medico");
		$dadosM =$stmtM->fetch(PDO::FETCH_OBJ);

		$id_paciente = $dados->id_paciente;
		$stmtP = $db->query("SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade FROM tbl_paciente WHERE Id = $id_paciente");
		$dadosP =$stmtP->fetch(PDO::FETCH_OBJ);

		$this->Cell(-1, 80, utf8_decode('Idade: '. $dadosP->idade), 0, 0, 'L');
		$this->Cell(1, 95, utf8_decode(' Data: '.$dados->data_receita), 0, 0, 'L');
		$this->Cell(0, 110, utf8_decode('Médico(a): '.$dadosM->display_name), 0, 0, 'L');
		$this->Cell(-1, 80, utf8_decode($dadosP->nome), 0, 0, 'R');
		$this->Cell(-1, 95, utf8_decode('Número de processo'), 0, 0, 'R');
		$this->Cell(-1, 110, utf8_decode('PROC0'.$dadosP->Id), 0, 0, 'R');


		$this->Cell(-110, 140, utf8_decode('RECEITA MÉDICA'), 0, 0, 'C');
		$this->Cell(-170, 80, utf8_decode(''), 0, 0, 'C');
		$this->Ln();
		/*$this->SetFont('Times', '', 12);
		$this->Cell(276, 10, 'Street address of Employee Office', 0, 0, 'C');*/
	}

	function footer () {
		$this->SetY(-15);
		$this->SetFont('Times', '', 10);
		$this->Cell(0, -10, '__________________________________', 0, 0, 'C');
		$this->Cell(-130, 10, utf8_decode('O(a) médico(a)'), 0, 0, 'C');
		$this->SetFont('Times', '', 6);
		$this->Cell(0, 10, utf8_decode('Centro Ortopédico de Viana.'), 0, 0, 'R');
	}

	function headerTable () {
		$this->SetFont('Times', 'B', 10);
		$this->Cell(10, 10, utf8_decode('Qtd.'), 1, 0, 'C');
		$this->Cell(50, 10, 'Medicamento', 1, 0, 'C');
		$this->Cell(70, 10, utf8_decode('Observação'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', '', 10);
		$id = $_GET['id'];
		$stmt = $db->query("SELECT * FROM tbl_receitas WHERE id_receita = $id");
		$dados = $stmt->fetch(PDO::FETCH_OBJ);

		$quantidade = explode(",", $dados->quantidade);
		$medicamento = explode(",", $dados->medicamento);
		$observacao = explode(",", $dados->observacao);

		foreach ($observacao as $key => $obs) {
			$this->Cell(10, 10, $quantidade[$key], 1, 0, 'C');
			$this->Cell(50, 10, utf8_decode($medicamento[$key]), 1, 0, 'L');
			$this->Cell(70, 10, utf8_decode($obs), 1, 0, 'L');
			$this->Ln();				
		}
		
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P',array(148, 210), 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>