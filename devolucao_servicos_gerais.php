<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
echo "
<body> 
	<div id='loading' class='ui-front loader ui-widget-overlay bg-white opacity-100'>
		<img src='assets/images/loader-dark.gif' alt=''>
	</div>
	<div id='page-wrapper' class='demo-example'>";
include('models/topbar.php');
include("models/sidebar.php");
echo "
	<div id='page-content-wrapper'>
		<div id='page-title' style='margin-bottom:18px;'>
		<h3>Devolução dos Serviços Gerais</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

 	if(isset($_GET['Id']))
        {
	        $acao = sanitize($_GET['acao']);
	        $Id = sanitize($_GET['Id']);
	        $con=connection();

	        if ($acao == 'devolver') {

	        	echo "<script>
					swal('Escreva o motivo da devolução:', {
						content: 'input',
					}).then((value) => {
						swal('Devolução efectuada com sucesso!', '', 'success');
					});
					</script>";
	        	$factura_id = $_GET['facturaId'];

	        	$query = "SELECT facturacao_id, nome_paciente, servico, total, data FROM tbl_facturacao WHERE facturacao_id =  '$factura_id'";

				$resultado = mysqli_query($con, $query);
				
				$linhas = mysqli_fetch_row($resultado);

				
				
				$n_fatura = $linhas[0];
				$paciente = $linhas[1];
				$servico = $linhas[2];
				$total = $linhas[3];
				$data_devolucao = date('d-m-Y h:i:sa');
				$queryInsert = "INSERT INTO tbl_devolucao_servicos_gerais VALUES ('', '$n_fatura', '$paciente', '$servico','', '$total', '$data_devolucao')";
				mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
				$resultadoInsert = mysqli_query($con, $queryInsert) ? true : false;
				
				if ($resultadoInsert) {					
					//echo "<script>swal('Devolução efectuada com sucesso!', '', 'success');</script>";
					$queryUpdate = "UPDATE `tbl_facturacao` SET `d_servicos_gerais` = '1' WHERE `tbl_facturacao`.`facturacao_id` = '$n_fatura'";
					$resultadoInsert = mysqli_query($con, $queryUpdate) ? true : false;
					//echo "<script>document.location.href = 'devolucao_servicos_gerais.php';</script>";
				} else "<script>swal('Oops! Ocorreu um erro ao efetuar a devolução!', '', 'error');</script>";
	        }
        }
        ?>



        <?php
echo "
<div id='resposta'></div>
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nº da factura</th>
			<th>Paciente</th>
			<th>Serviço</th>
			<th>Total</th>
			<th>Data</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";

	$con=connection();

		$queryIdDevol="SELECT n_fatura FROM tbl_devolucao_servicos_gerais";
		
		$resultIdDevol=mysqli_query($con,$queryIdDevol);
		$linhasId = mysqli_fetch_array($resultIdDevol);

		$nf = implode(' ', $linhasId);
		if (empty($linhasId)) $linhasId[] = null;

	    $queryNome="SELECT nome FROM tbl_servicos_gerais";
	    $resultNome=mysqli_query($con,$queryNome);

		$nomeConsulta = null;
	    while($linha=mysqli_fetch_array($resultNome))
		{
	        $nomeConsulta[] = $linha['nome'];
	    }

	    $nomeConsulta = $nomeConsulta[0];
		$query = "SELECT 
					tbl_facturacao.facturacao_id,
					tbl_facturacao.nome_paciente,
					tbl_facturacao.total,
					tbl_facturacao.data,
					tbl_facturacao.servico
					FROM tbl_facturacao 
					INNER JOIN tbl_users ON(tbl_facturacao.funcionario = tbl_users.id)
					WHERE 
					(
						servico='RELATORIO MEDICO' 
				        OR servico='1 SESSAO DE FISIOTERAPIA' 
				        OR servico='10 SESSOES DE FISIOTERAPIA' 
				        OR servico='15 SESSOES DE FISIOTERAPIA'
				        OR servico='2 SESSAO DE FISIOTERAPIA' 
				        OR servico='20 SESSOES DE FISIOTERAPIA'
				        OR servico='3 SESSOES PSICOTERAPIA' 
				        OR servico='4 SESSAO DE FISIOTERAPIA'
				        OR servico='4 SESSOES PSICOTERAPIA'
				        OR servico='6 SESSOES PSICOTERAPIA'
				        OR servico='8 SESSOES DE FISIOTERAPIA'       
				        OR servico='8 SESSOES PSICOTERAPIA' 
				        OR servico='ATESTADO MEDICO P/BOLSA DE ESTUDO' 
				        OR servico='ATESTADO MEDICO P/CARTA DE CONDUCAO' 
				        OR servico='ATESTADO MEDICO P/DESPORTO' 
				        OR servico='ATESTADO MEDICO P/MATRICULA' 
				        OR servico='ATESTADO MEDICO P/PASSAPORTE' 
				        OR servico='ATESTADO MEDICO P/SERVICO' 
				        OR servico='INFORMACAO CLINICA' 
				        OR servico='RELATORIO MEDICO'
					)
					 AND tbl_facturacao.d_servicos_gerais = 0";

		$result=mysqli_query($con,$query);
		
	while($row=mysqli_fetch_array($result))
	{		
		if (is_numeric($row['total']))
			$total = $row['total'];

		echo "<tr>
				<td>".$row['facturacao_id']."</td>
				<td>".$row['nome_paciente']."</a></td>
				<td>".$row['servico']."</td>
				<td>".dinheiro($total)."</td>
				<td>".$row['data']."</td>
				<td>
	            <form method='post' action='devolucao_servicos_gerais.php'>
	                <a href='#' name ='devolver' id='devolverBtn' data-id='".$row['facturacao_id']."' href='javascript:void(0)' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Devolver'>
	                    <i class='glyph-icon icon-money'></i>
	                </a>
	            </form>
	            </td>
			</tr>";
	}	echo "	
	</tbody>
</table>

</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
?>
<script>
	$(document).ready(function(){

		$(document).on('click', '#devolverBtn', function(e){
			var facturaId = $(this).data('id');
			swal('Escreva o motivo da devolução:', {
						content: 'input',
					}).then((value) => {
						var motivo = value;
						if (motivo != '') {
							var facturaId = $(this).data('id');
							Devolver(facturaId, motivo);
						}
					});			
			e.preventDefault();
		});		
	});

	function Devolver(facturaId, motivo){
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.open("GET","AjaxFazerDevolucao.php?facturaId="+facturaId+"&motivo="+motivo, false);
						xmlhttp.send(null);
							//alert(xmlhttp.responseText);
						if (xmlhttp.responseText == '1'){
							swal('Devolução efectuada com sucesso!', '', 'success');
							setTimeout("location.href = 'devolucao_servicos_gerais.php';", 2500);
						} 							
						else
							swal('Ocorreu um erro ao efetuar a devolução!', '', 'error');
		}
</script>

