<?php

require "../fpdf/fpdf.php";

$db = new PDO('mysql:host=localhost;dbname=cov;charset=utf8','root','ANGO_covdb157016');

$id_paciente = $_GET['id'];
$funcionario = $_GET['uid'];


class myPDF extends FPDF {
	function header () {
		
		GLOBAL $db, $id_paciente, $funcionario;

		$stmt = $db->query("SELECT * FROM tbl_facturacao WHERE id_paciente ='$id_paciente' AND funcionario = '$funcionario' ORDER BY facturacao_id DESC LIMIT 1");
		
		$dados = $stmt->fetch(PDO::FETCH_OBJ);

		$data = date('d-m-Y');
		$hora = date('H:i');
		$tipo_venda = $dados->tipo_pagamento;
		$numero = $dados->n_factura;
		$proc = 'PROC'.$dados->id_paciente;
		$nome = $dados->nome_paciente;
		
		$servicos = explode(",", $dados->servico);
		//var_dump($servicos);

		$servico = $dados->servico;
		$total = $dados->total;
		$troco = $dados->troco;
		//$this->image('assets/images/logo.png', 100, 6);
		$this->SetFont('Arial', 'B', 10);
		$this->Cell(0, 5, utf8_decode('Centro Ortopédico de Viana'), 0, 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell(-85, 15, utf8_decode('Vila de Viana'), 0, 0, 'C');
		$this->Cell(85, 25, utf8_decode('Luanda - Angola'), 1, 0, 'C');
		$this->Cell(-85, 35, utf8_decode('Telfs: 244222546543 / 244992435688'), 0, 0, 'C');
		$this->Cell(85, 45, utf8_decode('NIF: 7416013798'), 0, 0, 'C');
		$this->Cell(-144, 65, 'Data: '.$data, 0, 0, 'C');
		$this->Cell(265, 65, utf8_decode('Venda a '.$tipo_venda), 0, 0, 'C');
		$this->Cell(-395, 75, 'Hora: '.$hora, 0, 0, 'C');
		$this->Cell( 525, 75, utf8_decode('Nº: '.$numero), 0, 0, 'C');
		$this->Cell( -590, 85, utf8_decode($proc), 0, 0, 'C');
		$this->SetFont('Arial', 'B', 10);
		$this->Cell( 590, 95, utf8_decode($nome), 0, 0, 'C');
		$this->SetFont('Arial', '', 10);
		$this->Cell( -585, 105, utf8_decode('- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - '), 0, 0, 'C');
		$this->Cell( 525, 115, utf8_decode('Serviço'), 0, 0, 'C');
		$this->Cell( -465, 125, utf8_decode('- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - '), 0, 0, 'C');
		$this->Cell( 445, 115, utf8_decode('QTD'), 0, 0, 'C');
		$this->Cell( -411, 115, utf8_decode('Preço'), 0, 0, 'C');
		$this->Cell( 447, 115, utf8_decode('Taxa'), 0, 0, 'C');
		$this->Cell( -416, 115, utf8_decode('Total'), 0, 0, 'C');
		
		if (count($servicos) == 1) {
				$this->SetFont('Arial', '', 8);
				$this->Cell( 270, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);
				$this->Cell( -225, 135, '1', 0, 0, 'C');

				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);
				$this->Cell( 257, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -220, 135, '0%', 0, 0, 'C');	
				$this->Cell( 245, 205, number_format($total, 2).' kz', 0, 0, 'C');

		} elseif (count($servicos) == 2) {
				$this->SetFont('Arial', '', 8);
				$this->Cell( 270, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);
				$this->Cell( -225, 135, '1', 0, 0, 'C');

				//$servico1 = str_replace(' ', '', $servicos[0]);
				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE TRIM(nome) = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);
				//var_dump($servico1);
				$this->Cell( 257, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -220, 135, '0%', 0, 0, 'C');
				$this->SetFont('Arial', '', 8);
				$this->Cell( 106, 145, utf8_decode($servicos[1]), 0, 0, 'C');		
				$this->SetFont('Arial', '', 10);		
				$this->Cell( -61, 146, '1', 0, 0, 'C');

				//$servico2 = str_replace(' ', '', $servicos[1]);
				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 92, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -53, 146, '0%', 0, 0, 'C');
				$this->Cell( 78, 205, number_format($total, 2). ' kz', 0, 0, 'C');
			}	elseif (count($servicos) == 3) {
				$this->SetFont('Arial', '', 8);
				$this->Cell( 270, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);
				$this->Cell( -225, 135, '1', 0, 0, 'C');

				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 257, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -220, 135, '0%', 0, 0, 'C');
				
				//----------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( 106, 145, utf8_decode($servicos[1]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);				
				$this->Cell( -61, 146, '1', 0, 0, 'C');

				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 92, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -53, 146, '0%', 0, 0, 'C');

				//-------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( -62, 155, utf8_decode($servicos[2]), 0, 0, 'C');	
				$this->SetFont('Arial', '', 10);			
				$this->Cell( 107, 155, '1', 0, 0, 'C');

				$servico3 = $servicos[2];
				$stmtS3 = $db->query("SELECT * FROM tbl_servicos_exames WHERE nome = '$servico3'");
				$dadosS3 = $stmtS3->fetch(PDO::FETCH_OBJ);
				//var_dump($stmtS3);
				$this->Cell( -76, 156, $dadosS3->preco, 0, 0, 'C');
				$this->Cell( 115, 156, '0%', 0, 0, 'C');
				$this->Cell( -85, 205, number_format($total, 2). ' kz', 0, 0, 'C');
				
			}	elseif (count($servicos) == 4) {
				$this->SetFont('Arial', '', 8);
				$this->Cell( 270, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);
				$this->Cell( -225, 135, '1', 0, 0, 'C');

				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 257, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -220, 135, '0%', 0, 0, 'C');
				
				//----------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( 106, 145, utf8_decode($servicos[1]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);				
				$this->Cell( -61, 146, '1', 0, 0, 'C');

				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 92, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -53, 146, '0%', 0, 0, 'C');

				//-------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( -62, 155, utf8_decode($servicos[2]), 0, 0, 'C');	
				$this->SetFont('Arial', '', 10);			
				$this->Cell( 107, 155, '1', 0, 0, 'C');

				$servico3 = $servicos[2];
				$stmtS3 = $db->query("SELECT * FROM tbl_servicos_exames WHERE nome = '$servico3'");
				$dadosS3 = $stmtS3->fetch(PDO::FETCH_OBJ);
				//var_dump($stmtS3);
				$this->Cell( -76, 156, $dadosS3->preco, 0, 0, 'C');
				$this->Cell( 115, 156, '0%', 0, 0, 'C');
				//-------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( -230, 165, utf8_decode($servicos[3]), 0, 0, 'C');	
				$this->SetFont('Arial', '', 10);			
				$this->Cell( 275, 165, '1', 0, 0, 'C');

				$servico3 = $servicos[3];
				$stmtS3 = $db->query("SELECT * FROM tbl_servicos_exames WHERE nome = '$servico3'");
				$dadosS3 = $stmtS3->fetch(PDO::FETCH_OBJ);
				//var_dump($stmtS3);
				$this->Cell( -244, 165, $dadosS3->preco, 0, 0, 'C');
				$this->Cell( 283, 165, '0%', 0, 0, 'C');
				$this->Cell( -255, 205, number_format($total, 2). ' kz', 0, 0, 'C');
			} elseif (count($servicos) == 5) {

				$this->SetFont('Arial', '', 8);
				$this->Cell( 270, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);
				$this->Cell( -225, 135, '1', 0, 0, 'C');

				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 257, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -220, 135, '0%', 0, 0, 'C');
				
				//----------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( 106, 145, utf8_decode($servicos[1]), 0, 0, 'C');
				$this->SetFont('Arial', '', 10);				
				$this->Cell( -61, 146, '1', 0, 0, 'C');

				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 92, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -53, 146, '0%', 0, 0, 'C');

				//-------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( -62, 155, utf8_decode($servicos[2]), 0, 0, 'C');	
				$this->SetFont('Arial', '', 10);			
				$this->Cell( 107, 155, '1', 0, 0, 'C');

				$servico3 = $servicos[2];
				$stmtS3 = $db->query("SELECT * FROM tbl_servicos_exames WHERE nome = '$servico3'");
				$dadosS3 = $stmtS3->fetch(PDO::FETCH_OBJ);
				//var_dump($stmtS3);
				$this->Cell( -76, 156, $dadosS3->preco, 0, 0, 'C');
				$this->Cell( 115, 156, '0%', 0, 0, 'C');
				//-------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( -230, 165, utf8_decode($servicos[3]), 0, 0, 'C');	
				$this->SetFont('Arial', '', 10);			
				$this->Cell( 275, 165, '1', 0, 0, 'C');

				$servico3 = $servicos[3];
				$stmtS3 = $db->query("SELECT * FROM tbl_servicos_exames WHERE nome = '$servico3'");
				$dadosS3 = $stmtS3->fetch(PDO::FETCH_OBJ);
				//var_dump($stmtS3);
				$this->Cell( -244, 165, $dadosS3->preco, 0, 0, 'C');
				$this->Cell( 283, 165, '0%', 0, 0, 'C');
				$this->Cell( -255, 205, number_format($total, 2). ' kz', 0, 0, 'C');

				//-------------------------------------------------
				$this->SetFont('Arial', '', 8);
				$this->Cell( 112, 175, utf8_decode($servicos[4]), 0, 0, 'C');	
				$this->SetFont('Arial', '', 10);			
				$this->Cell( -67, 175, '1', 0, 0, 'C');

				$servico3 = $servicos[4];
				$stmtS3 = $db->query("SELECT * FROM tbl_servicos_exames WHERE nome = '$servico3'");
				$dadosS3 = $stmtS3->fetch(PDO::FETCH_OBJ);
				//var_dump($stmtS3);
				$this->Cell( 98, 175, $dadosS3->preco, 0, 0, 'C');
				$this->Cell( -59, 175, '0%', 0, 0, 'C');
				$this->Cell( -255, 205, number_format($total, 2). ' kz', 0, 0, 'C');
			}	elseif (count($servicos) == 6) {
				$this->Cell( 338, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->Cell( -305, 135, '1', 0, 0, 'C');

				$servico1 = str_replace(' ', '', $servicos[0]);
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 327, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -301, 135, '0%', 0, 0, 'C');

				$this->Cell( 220, 145, utf8_decode($servicos[1]), 0, 0, 'C');				
				$this->Cell( -187, 146, '1', 0, 0, 'C');

				$servico2 = str_replace(' ', '', $servicos[1]);
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 209, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -183, 146, '0%', 0, 0, 'C');
				$this->Cell( 215, 205, $total, 0, 0, 'C');
			}	elseif (count($servicos) == 7) {
				$this->Cell( 338, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->Cell( -305, 135, '1', 0, 0, 'C');

				$servico1 = str_replace(' ', '', $servicos[0]);
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 327, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -301, 135, '0%', 0, 0, 'C');

				$this->Cell( 220, 145, utf8_decode($servicos[1]), 0, 0, 'C');				
				$this->Cell( -187, 146, '1', 0, 0, 'C');

				$servico2 = str_replace(' ', '', $servicos[1]);
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 209, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -183, 146, '0%', 0, 0, 'C');
				$this->Cell( 215, 205, $total, 0, 0, 'C');
			}	elseif (count($servicos) == 8) {
				$this->Cell( 338, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->Cell( -305, 135, '1', 0, 0, 'C');

				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 327, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -301, 135, '0%', 0, 0, 'C');

				$this->Cell( 220, 145, utf8_decode($servicos[1]), 0, 0, 'C');				
				$this->Cell( -187, 146, '1', 0, 0, 'C');

				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 209, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -183, 146, '0%', 0, 0, 'C');
				$this->Cell( 215, 205, $total, 0, 0, 'C');
			}	elseif (count($servicos) == 9) {
				$this->Cell( 338, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->Cell( -305, 135, '1', 0, 0, 'C');

				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 327, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -301, 135, '0%', 0, 0, 'C');

				$this->Cell( 220, 145, utf8_decode($servicos[1]), 0, 0, 'C');				
				$this->Cell( -187, 146, '1', 0, 0, 'C');

				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 209, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -183, 146, '0%', 0, 0, 'C');
				$this->Cell( 215, 205, $total, 0, 0, 'C');
			}	elseif (count($servicos) == 10) {
				$this->Cell( 338, 135, utf8_decode($servicos[0]), 0, 0, 'C');
				$this->Cell( -305, 135, '1', 0, 0, 'C');

				$servico1 = $servicos[0];
				$stmtS = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico1'");
				$dadosS = $stmtS->fetch(PDO::FETCH_OBJ);

				$this->Cell( 327, 135, $dadosS->preco, 0, 0, 'C');
				$this->Cell( -301, 135, '0%', 0, 0, 'C');

				$this->Cell( 220, 145, utf8_decode($servicos[1]), 0, 0, 'C');				
				$this->Cell( -187, 146, '1', 0, 0, 'C');

				$servico2 = $servicos[1];
				$stmtS2 = $db->query("SELECT preco FROM tbl_servicos_exames WHERE nome = '$servico2'");
				$dadosS2 = $stmtS2->fetch(PDO::FETCH_OBJ);

				$this->Cell( 209, 146, $dadosS2->preco, 0, 0, 'C');
				$this->Cell( -183, 146, '0%', 0, 0, 'C');
				$this->Cell( 215, 205, $total, 0, 0, 'C');
			}	
		$this->Ln(10);
	}

	function footer () {
		//require_once("models/config.php");		
		GLOBAL $db, $id_paciente, $funcionario;
		$stmt = $db->query("SELECT * FROM tbl_facturacao WHERE id_paciente ='$id_paciente' ORDER BY facturacao_id DESC LIMIT 1");
		$dados = $stmt->fetch(PDO::FETCH_OBJ);

		$stmtA = $db->query("SELECT total_recebido, tipo_pagamento, funcionario, n_factura, id_paciente, nome_paciente, servico, total, troco FROM tbl_facturacao WHERE id_paciente ='$id_paciente' AND funcionario='$funcionario' ORDER BY facturacao_id DESC LIMIT 1");
		
		$dadosA = $stmtA->fetch(PDO::FETCH_OBJ);
		$id_funcionario = $dados->funcionario;

		$stmtF = $db->query("SELECT display_name FROM tbl_users WHERE id = $id_funcionario");
		$dadosF = $stmtF->fetch(PDO::FETCH_OBJ);

		$nome_funcionario = $dadosF->display_name;
		
		$total = $dadosA->total;
		$troco = $dadosA->troco;
		$totalRecebido = $dadosA->total_recebido;

		$this->SetY(-15);
		$this->SetFont('Arial', 'B', 8);
		$this->Cell(0, -30, utf8_decode('- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - '), 0, 0, 'C');
		$this->Cell(-136, -20, utf8_decode('Total Líquido:'), 0, 0, 'C');
		$this->Cell(250, -20, utf8_decode(number_format($total,2).' kz'), 0, 0, 'C');
		$this->Cell(-368, -10, utf8_decode('Total Taxa:'), 0, 0, 'C');
		$this->Cell(487, -10, utf8_decode('0'), 0, 0, 'C');
		$this->Cell(-600, 0, utf8_decode('Total Recebido:'), 0, 0, 'C');
		if ($dados->tipo_pagamento != 'Multicaixa') {
			$this->Cell(640, 0, utf8_decode(number_format($totalRecebido, 2).' kz'), 0, 0, 'C');
		}	
		//print_r($dados->tipo_pagamento);	
		$this->Cell(-591, 0, utf8_decode('Troco:'), 0, 0, 'C');
		$this->Cell(615, 0, utf8_decode($troco), 0, 0, 'C');
		$this->Cell(-672, 10, utf8_decode('- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - '), 0, 0, 'C');
		$this->Cell(669, 20, utf8_decode('Funcionário: '.$nome_funcionario), 0, 0, 'C');
	}

	function headerTable () {
		/*$nome = ctype_upper('DYUAGSUYDGASUIDYASBIUDGABSUD ARLINDO SOARES BONIFACIO');
		$this->SetFont('Times', 'B', 12);
		$this->Cell( 0, 10, utf8_decode('dasdnasnd'), 1, 0, 'C');
		$this->Ln();*/
	}

	function viewTable ($db) {
		$this->SetFont('Times', 'B', 12);
		$stmt = $db->query('SELECT * FROM tbl_consultorio');
		while ($data = $stmt->fetch(PDO::FETCH_OBJ)) {
			$this->Cell(20, 10, '000'.$data->id_consultorio, 1, 0, 'C');
			$this->Cell(60, 10, utf8_decode($data->nome), 1, 0, 'L');
				$id_medico = $data->id_medico;
				$stmtM = $db->query("SELECT * FROM tbl_medico WHERE id_medico ='$id_medico'");
				while ($rowM = $stmtM->fetch(PDO::FETCH_OBJ)) {
					$this->Cell(95, 10, utf8_decode($rowM->nome), 1, 0, 'L');
				}			
			$this->Cell(100, 10, utf8_decode($data->especialidade), 1, 0, 'L');
			$this->Ln();
		}
	}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P',array(100, 150), 0);
$pdf->headerTable();
$pdf->Output();
?>