<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('LISTA DOS PRODUTOS NO ESTOQUE'), 0, 0, 'C');
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
		$this->Cell(90, 10, 'Produto', 1, 0, 'C');
		$this->Cell(100, 10, utf8_decode('Quantidade atual'), 1, 0, 'C');
		$this->Cell(90, 10, utf8_decode('Preço unitário'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT * FROM tbl_estoque');
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$id_produto = $data->id_produto;
				$stmtM = $db->query("SELECT * FROM tbl_produto WHERE id_produto ='$id_produto'");
				while ($rowM = $stmtM->fetch(PDO::FETCH_OBJ)) {
					$this->Cell(90, 10, utf8_decode($rowM->descricao), 1, 0, 'L');
				}
			$this->Cell(100, 10, utf8_decode($data->qtde), 1, 0, 'L');
			$this->Cell(90, 10, utf8_decode(number_format($data->preco_unitario, 2).' kz'), 1, 0, 'L');
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