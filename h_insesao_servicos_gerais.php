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
		<h3>Insenção dos Serviços Gerais</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

echo "
<div id='resposta'></div>
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nome do Paciente</th>
			<th>Motivo da Insenção</th>
			<th>Idade</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";

	$con=connection();
	$query="SELECT tbl_isencao_servicos_gerais.id,motivo_isencao, tbl_paciente.Id, tbl_paciente.nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade,tbl_paciente.genero FROM tbl_isencao_servicos_gerais inner join tbl_paciente ON tbl_isencao_servicos_gerais.id_paciente=tbl_paciente.Id LIMIT 0, 200";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['nome']."</td>
			<td>".$row['motivo_isencao']."</td>
			<td>".$row['idade']."</td>

			<td>
	            <form method='post' action=''>
	                <a target='_blank' href='imprimir/imprimir_isencao_servicos_gerais.php?Id=".$row['Id']."&uid=".$row['id']."' name ='insesao' id=''  class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Comprovativo'>
						<i class='glyph-icon icon-arrow-right'></i>
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
