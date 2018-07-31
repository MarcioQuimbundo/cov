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
		<h3>Histórico de Vendas</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 
 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nº da factura</th>
			<th>Paciente</th>
			<th>Funcionário</th>
			<th>Serviço</th>
			<th>Tipo de pagamento</th>
			<th>Total</th>
			<th>Data</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_facturacao INNER JOIN tbl_users ON(tbl_facturacao.funcionario = tbl_users.id)";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['facturacao_id']."</td>
			<td>".$row['nome_paciente']."</a></td>
			<td>".$row['user_name']."</td>
			<td>".$row['servico']."</td>
			<td>".utf8_encode($row['tipo_pagamento'])."</td>
			<td>".dinheiro($row['total'])."</td>
			<td>".$row['data']."</td>
		</tr>";
	}	echo "	
	</tbody>
</table>
<a style='background-color: #149900; color: #fff;font-size:15px; padding:6px;' title='Imprimir' target='_blank' href='imprimir/imprimir_relatorio_pagamentos.php' class='print small btn primary-bg'>
    <i class='glyph-icon icon-print'></i>
    Imprimir
</a>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
?>


