<?php
/*	Ajax para fazer a devolução dos serviços gerais */
$server='localhost';
$user='root';
$password='ANGO_covdb157016';
$db_name='cov';	
$con = mysqli_connect($server, $user, $password, $db_name);

if ($_GET['facturaId'] && $_GET['motivo'] ) {
	$factura_id = $_GET['facturaId'];
	$motivo = $_GET['motivo'];

	        	$query = "SELECT facturacao_id, nome_paciente, servico, total, data FROM tbl_facturacao WHERE facturacao_id = $factura_id";
				$resultado = mysqli_query($con, $query);
				$linhas = mysqli_fetch_row($resultado);
				$n_fatura = $linhas[0];
				$paciente = $linhas[1];
				$servico = $linhas[2];
				$total = $linhas[3];
				$data_devolucao = date('d-m-Y h:i:sa');

				if (strlen($motivo) < 5) {
					echo "0";
				} else {
						$queryInsert = "INSERT INTO tbl_devolucao_servicos_gerais VALUES ('', '$n_fatura', '$paciente', '$servico', '$total', '$motivo', '$data_devolucao')";
						mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
						$resultadoInsert = mysqli_query($con, $queryInsert) ? true : false;
						if ($resultadoInsert) {					
						echo "1";
						$queryUpdate = "UPDATE `tbl_facturacao` SET `d_servicos_consultas` = '1' WHERE `tbl_facturacao`.`facturacao_id` = '$n_fatura'";
						$resultadoInsert = mysqli_query($con, $queryUpdate) ? true : false;
					} 
				}
				
	}
?>
