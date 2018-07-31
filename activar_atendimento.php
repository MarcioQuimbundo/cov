<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/
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
<h3>Activar atendimento</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
<div id='page-content' style='margin-top:-18px;'>"; 
  
		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();
		if ($acao == 'activar') {

		    $query = "UPDATE tbl_agenda SET cancelado = 0 WHERE id_paciente = '$Id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		           	echo "<script>swal('Atendimento ativo Com Sucesso','','success');</script>";
		            }
			else echo "
					<script>swal('Ocorreu um erro','O atendimento não foi ativo','error');</script>
				";
		}		
		}	
	?>
	<?php 
	echo "
	<table class='table' id='example1'>
		<thead>
			<tr>
				<th>Nº Processo</th>
				<th>&nbsp;&nbsp;&nbsp;Nome Completo</th>
				<th>Idade</th>
				<th>&nbsp;&nbsp;&nbsp;Gênero</th>
				<th>&nbsp;&nbsp;&nbsp;Telefone</th>
				<th>&nbsp;&nbsp;&nbsp;Endereço</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>";
                                    //$oq = $con->query("SELECT * FROM tbl_paciente INNER JOIN tbl_atendimento ON tbl_paciente.Id = tbl_atendimento.id_paciente AND ativo=1");

		$con=connection();
		$query="SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade, genero, telefone, endereco  FROM tbl_paciente INNER JOIN tbl_agenda ON (tbl_paciente.Id = tbl_agenda.id_paciente) WHERE cancelado = 1";
		$result=mysqli_query($con,$query);
		while($row=mysqli_fetch_array($result))
		{
					echo "<tr>
							<td>".$row['Id']."</td>
							<td>
								<a href='atendimento.php?Id=".$row['Id']."&acao=ver '>".$row['nome']."</a>
							</td>
							<td>".$row['idade']."</td>
							<td>".$row['genero']."</td>
							<td>".$row['telefone']."</td>
							<td><a href='#'>".$row['endereco']."</a></td>
							<td>
							<form method='get' action='activar.php'>
				                <a href='activar_atendimento.php?Id=".$row['Id']."&acao=activar ' class='btn small bg-green tooltip-button' data-placement='top' title='activar'>
				                    <i class='glyph-icon icon-refresh'></i>
				                </a>
							</form>
							</td>
						</tr>";
		}
		echo "	
		</tbody>
	</table>
	</div><!-- #page-content -->
	</div><!-- #page-main -->
	</div><!-- #page-wrapper -->
	";

?>
