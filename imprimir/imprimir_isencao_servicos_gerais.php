<?php
require('fpdf/fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');
$id_paciente = $_GET['Id']; 
$id_comprovativo = $_GET['uid']; 

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode(''), 0, 0, 'C');
		$this->Ln();
	}

	function footer () {
		GLOBAL $id_paciente,$id_comprovativo;
		$this->SetY(-40);
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(0, -20, utf8_decode('O(A) Profissional'), 0, 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell(-190, -10, '__________________________________', 0, 0, 'C');
		$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');
		$stmtI = $db->query("SELECT tbl_users.display_name FROM tbl_isencao_servicos_gerais inner join tbl_users on user_id=tbl_users.id WHERE id_paciente=$id_paciente");
		$dadosI =$stmtI->fetch(PDO::FETCH_OBJ);
		$this->Cell(105, 10, utf8_decode(''.$dadosI->display_name), 0, 0, 'R');
		$this->Cell(0, 20, utf8_decode('Centro Ortopédico de Viana.'), 0, 0, 'R');
	}

	function headerTable () {


		$this->SetFont('Times', 'B', 14);
		$this->Cell(-200, 60, utf8_decode('ISENÇÃO DE SERVIÇOS EXAMES'), 0, 0, 'C');
		$this->SetFont('Times', 'B', 12);
		$this->Cell(200, 80, utf8_decode(''), 0, 0, 'C');
		$this->Cell(-300, 80, utf8_decode('Descrição'), 0, 0, 'C');
		$this->Cell(380, 80, utf8_decode('Preço'), 0, 0, 'C');
		$this->Cell(-300, 80, utf8_decode('Quantidade'), 0, 0, 'C');
		$this->Cell(370, 80, utf8_decode('Total'),0, 0, 'C');
		$this->Ln();

	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);

		GLOBAL $id_paciente,$id_comprovativo;
		$stmtP = $db->query("SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade FROM tbl_paciente WHERE Id = $id_paciente");

		$dadosP =$stmtP->fetch(PDO::FETCH_OBJ);

		

		$this->Cell(-1, 10, utf8_decode('Idade: '.$dadosP->idade), 0, 0, 'L');
		$this->Cell(1, 25, utf8_decode(' Data: '.date('d-m-Y')), 0, 0, 'L');
		$this->Cell(190, 40, utf8_decode('Hora:'.date('H:i')), 0, 0, 'L');
		$this->Cell(-1, 10, utf8_decode($dadosP->nome), 0, 0, 'R');
		$this->Cell(-1, 25, utf8_decode('Número de processo'), 0, 0, 'R');
		$this->Cell(-1, 40, utf8_decode('PROC0'.$dadosP->Id), 0, 0, 'R');
		$this->SetFont('Times', '', 10);

		$stmtI = $db->query("SELECT * FROM tbl_isencao_servicos_gerais INNER JOIN tbl_servicos_gerais  ON tbl_isencao_servicos_gerais.servicos=tbl_servicos_gerais.id WHERE tbl_isencao_servicos_gerais.id = $id_comprovativo");
		$dadosI =$stmtI->fetch(PDO::FETCH_OBJ);


		$this->Cell(-290,90, utf8_decode($dadosI->nome), 0, 0, 'C');
		$this->Cell(360,90, utf8_decode($dadosI->preco), 0, 0, 'C');
		$this->Cell(-278,90, utf8_decode($dadosI->quantidade), 0, 0, 'C');
		$this->Cell(350,90, utf8_decode($dadosI->total),0, 0, 'C');
		$this->SetFont('Times', 'B', 12);
		$this->Cell(-600,200, utf8_decode('Motivo da Insenção:'),0, 0, 'C');
		$this->SetFont('Times', '', 12);
		$this->Cell(600,215, utf8_decode($dadosI->motivo_isencao),0, 0, 'C');
		$this->Cell(0,200, utf8_decode(''),0, 0, 'C');
	
		

	}
}
	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();	
	$pdf->viewTable($db);
	$pdf->headerTable();
	$pdf->Output();

?>