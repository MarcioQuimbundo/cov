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
		<h3>Relatório das Entradas dos Produtos</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 
 $user_id = $loggedInUser->user_id;
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Data-Entrada</th>
			<th>Funcionário</th>
			<th>Produto</th>
			<th>Quantidade</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT tbl_entrada_de_produto.data_entrada_produto,tbl_users.user_name,tbl_produto.descricao,tbl_entrada_de_produto.qtde FROM tbl_entrada_de_produto INNER JOIN tbl_produto on tbl_entrada_de_produto.id_produto=tbl_produto.id_produto INNER JOIN tbl_users ON tbl_entrada_de_produto.user_id=tbl_users.id";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row[0]."</td>
			<td>".$row[1]."</a></td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
		</tr>";
	}	echo "	
	</tbody>
</table>
<a style='background-color: #149900; color: #fff;font-size:15px; padding:6px;' title='Imprimir' target='_blank' href='imprimir/imprimir_relatorio_entrada_produtos.php' class='print small btn'>
    <i class='glyph-icon icon-print'></i>
    Imprimir
</a>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";

?>


