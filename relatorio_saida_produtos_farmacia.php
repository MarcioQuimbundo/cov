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
		<h3>Relatório das Saidas Dos Produto da Farmácia</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 
 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Data-Saida</th>
			<th>Funcionário</th>
			<th>Produto</th>
			<th>Quantidade</th>
			<th>Local</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT tbl_saida_de_produto_farmacia.data_saida,tbl_users.user_name,tbl_produto_farmacia.nome_comercial,tbl_saida_de_produto_farmacia.qtde,tbl_saida_de_produto_farmacia.local FROM tbl_saida_de_produto_farmacia INNER JOIN tbl_produto_farmacia on tbl_saida_de_produto_farmacia.id_produto=tbl_produto_farmacia.id_produto INNER JOIN tbl_users ON tbl_saida_de_produto_farmacia.user_id=tbl_users.id";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row[0]."</td>
			<td>".$row[1]."</a></td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
			<td>".$row[4]."</td>
		</tr>";
	}	echo "	
	</tbody>
</table>
<a style='background-color: #149900; color: #fff;font-size:15px; padding:6px;' title='Imprimir' target='_blank' href='imprimir/imprimir_relatorio_saida_produtos_farmacia.php' class='print small btn'>
    <i class='glyph-icon icon-print'></i>
    Imprimir
</a>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";

?>


