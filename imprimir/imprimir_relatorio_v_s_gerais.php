<?php
require "fpdf/fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

class myPDF extends FPDF {
	function header () {
		$this->image('assets/images/logo.png', 10, 6);
		$this->SetFont('Arial', 'B', 14);
		$this->Cell(276, 35, utf8_decode('RELATÓRIO DE VENDAS DOS SERVIÇOS GERAIS'), 0, 0, 'C');
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
		$this->Cell(15, 10, utf8_decode('Recibo'), 1, 0, 'C');
		$this->Cell(55, 10, utf8_decode('Paciente'), 1, 0, 'C');
		$this->Cell(55, 10, utf8_decode('Funcionário'), 1, 0, 'C');
		$this->Cell(55, 10, utf8_decode('Serviço'), 1, 0, 'C');
		$this->Cell(25, 10, utf8_decode('Pagamento'), 1, 0, 'C');
		$this->Cell(30, 10, utf8_decode('Total'), 1, 0, 'C');
		$this->Cell(40, 10, utf8_decode('Data'), 1, 0, 'C');
		$this->Ln();
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);

	    $stmtNome = $db->query("SELECT nome FROM tbl_servicos_gerais");

	    while($linha=$stmtNome->fetch(PDO::FETCH_OBJ))
		{
	        $nomeConsulta[] = $linha->nome;
	    }

	    $nomeConsulta = $nomeConsulta[0];

		$stmt = $db->query("SELECT facturacao_id, nome_paciente, user_name, servico, tipo_pagamento, total, data  FROM tbl_facturacao INNER JOIN tbl_users ON(tbl_facturacao.funcionario = tbl_users.id) WHERE FIND_IN_SET('$nomeConsulta',servico)");
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(15, 10, $data->facturacao_id, 1, 0, 'C');
			$this->Cell(55, 10, $data->nome_paciente, 1, 0, 'L');
			$this->Cell(55, 10, utf8_decode($data->user_name), 1, 0, 'L');
			$this->Cell(55, 10, utf8_decode($data->servico), 1, 0, 'L');
			$this->Cell(25, 10, utf8_decode($data->tipo_pagamento), 1, 0, 'L');
			$this->Cell(30, 10, number_format($data->total,2).' kz', 1, 0, 'L');
			$this->Cell(40, 10, utf8_decode($data->data), 1, 0, 'L');
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