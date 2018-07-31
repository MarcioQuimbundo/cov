<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('RELATÓRIO DAS SAIDA DOS PRODUTOS DA FARMÁCIA'), 0, 0, 'C');
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
		$this->Cell(60, 10, 'Data-Saida', 1, 0, 'C');
		$this->Cell(60, 10, utf8_decode('Funcionário'), 1, 0, 'C');
		$this->Cell(60, 10, utf8_decode('Produto'), 1, 0, 'C');
		$this->Cell(50, 10, utf8_decode('Quantidade'), 1, 0, 'C');
		$this->Cell(50	, 10, utf8_decode('Local'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT tbl_saida_de_produto_farmacia.data_saida,tbl_users.user_name,tbl_produto_farmacia.nome_comercial,tbl_saida_de_produto_farmacia.qtde,tbl_saida_de_produto_farmacia.local FROM tbl_saida_de_produto_farmacia INNER JOIN tbl_produto_farmacia on tbl_saida_de_produto_farmacia.id_produto=tbl_produto_farmacia.id_produto INNER JOIN tbl_users ON tbl_saida_de_produto_farmacia.user_id=tbl_users.id');
			while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(60, 10, $data->data_saida, 1, 0, 'C');
			$this->Cell(60, 10, $data->user_name, 1, 0, 'C');
			$this->Cell(60, 10, utf8_decode($data->nome_comercial), 1, 0, 'C');
			$this->Cell(50, 10, utf8_decode($data->qtde), 1, 0, 'C');
			$this->Cell(50, 10, utf8_decode($data->local), 1, 0, 'C');
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