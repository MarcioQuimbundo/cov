<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		//$this->Cell(276, 35, utf8_decode('JUSTIFICATIVO MÉDICO'), 0, 0, 'C');
		$this->Ln();
		/*$this->SetFont('Times', '', 12);
		$this->Cell(276, 10, 'Street address of Employee Office', 0, 0, 'C');*/
		$this->Ln(0);
	}

	function footer () {
		$this->SetY(-15);
		$this->SetFont('Arial', '', 8);
		$this->Cell(0, -20, '__________________________________', 0, 0, 'L');
		$this->Cell(-85, -5, utf8_decode('Assinatura do(a) Médico'), 0, 0, 'R');
		$this->Cell(0, -20, '__________________________________', 0, 0, 'R');
		$this->Cell(-3, -5, utf8_decode('Nome do(a) Assinante Administrativo'), 0, 0, 'R');
		$this->SetFont('Arial', '', 6);
		$this->Cell(0, 20, utf8_decode('Centro Ortopédico de Viana.'), 0, 0, 'R');
	}

	function headerTable () {				}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 10);

		$id = $_GET['id'];
		$stmt = $db->query("SELECT id_paciente, id_medico, qtd_dias, cid_doenca, data_cadastro FROM tbl_justificativo_medico WHERE id_justificativo_medico = $id");

		$dados = $stmt->fetch(PDO::FETCH_OBJ);
		
		$id_medico = $dados->id_medico;
		$stmtM = $db->query("SELECT display_name FROM tbl_users WHERE id = $id_medico");
		$dadosM =$stmtM->fetch(PDO::FETCH_OBJ);

		$id_paciente = $dados->id_paciente;
		$stmtP = $db->query("SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade, n_identificacao FROM tbl_paciente WHERE Id = $id_paciente");
		$dadosP =$stmtP->fetch(PDO::FETCH_OBJ);
		$this->Ln();
		$this->Cell(-1, 80, utf8_decode('Idade: ' . $dadosP->idade), 0, 0, 'L');
		$this->Cell(1, 95, utf8_decode(' Data: '.$dados->data_cadastro), 0, 0, 'L');
		$this->Cell(0, 110, utf8_decode('Médico: '.$dadosM->display_name), 0, 0, 'L');
		$this->Cell(-1, 80, utf8_decode($dadosP->nome), 0, 0, 'R');
		$this->Cell(-1, 95, utf8_decode('Número de processo'), 0, 0, 'R');
		$this->Cell(-1, 110, utf8_decode('PROC0'.$dadosP->Id), 0, 0, 'R');
		$this->Cell(-110, 150, utf8_decode('JUSTIFICATIVO MÉDICO'), 0, 0, 'C');
		$this->Cell(-190, 30, utf8_decode(''), 0, 0, 'C');
		$this->SetXY(10,100);

		if (strlen($dadosP->n_identificacao) < 3) {
			$bi = '';
		} else {
			$bi = ', portador do BI no '.$dadosP->n_identificacao;
		}
		$dados = 
		'Atestado, para os devidos fins, a pedido do interessado, que '.$dadosP->nome.','.$bi.' foi submetido à consulta médica nesta data '.$dados->data_cadastro.', sendo portador da afecção: '.$dados->cid_doenca.'.'.'Em decorrência, deverá permanecer afastado de suas atividades laborativas por um perido de '.$dados->qtd_dias.''.'dias apartir desta data.';
		$this->MultiCell(0,5,utf8_decode($dados),'J');
		$this->Ln();	
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P',array(148, 210), 0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>