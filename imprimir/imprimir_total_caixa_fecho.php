<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('Relatório do valor total aberto pelos caixas'), 0, 0, 'C');
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
		$this->Cell(110, 10, utf8_decode('Funcionário'), 1, 0, 'C');
		$this->Cell(82, 10, utf8_decode('Total de Fecho(Sistema)'), 1, 0, 'C');
		$this->Cell(82, 10, utf8_decode('Total de Fecho(Mão)'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT 
                        tbl_caixa_fechar.id_funcionario, 
                        tbl_caixa_fechar.nome_funcionario, 
                        SUM(valor_fecho) AS TotalFecho,
                        SUM(valor_fecho_mao) AS TotalFechoMao
                        FROM tbl_caixa_fechar
                        GROUP BY tbl_caixa_fechar.id_funcionario');
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(110, 10, utf8_decode($data->nome_funcionario), 1, 0, 'L');
			$this->Cell(82, 10, number_format($data->TotalFecho, 2) . ' kz', 1, 0, 'L');
			$this->Cell(82, 10, number_format($data->TotalFechoMao, 2) . ' kz', 1, 0, 'L');
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