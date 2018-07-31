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
<h3>Estoque da Farmácia</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
<div id='page-content' style='margin-top:-18px;'>"; 		
	
?><br>
<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Produto</th>
			<th>Quantidade</th>
			<th>Preço Unitário</th>
		</tr>
	</thead>
	<tbody>";

	$con=connection();
	$queryP="SELECT count(*) as total FROM tbl_produto_farmacia";
	$resultP = mysqli_query($con,$queryP);

	$dados = mysqli_fetch_row($resultP);
	
	if ($dados[0] != '0') {
	$con=connection();
	$query="SELECT * FROM tbl_estoque_farmacia";
	$result=mysqli_query($con,$query);
	
	while($row=mysqli_fetch_array($result))
	{
		$queryP="SELECT * FROM tbl_produto_farmacia WHERE id_produto = ".$row['id_produto'];
		$resultP= mysqli_query($con,$queryP);
	echo "<tr>";
			while ($rowP = mysqli_fetch_array($resultP)) {
				echo "<td><a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=ver '>".$rowP['nome_comercial']."</a></td>";
			}
			echo "			
			<td>".$row['qtde']."</td>
			<td>".$row['preco_unitario']."</a></td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
<a style='background-color: #149900; color: #fff;margin-left:5px; font-size:15px; padding:3px;' title='Imprimir' target='_blank' href='imprimir/imprimir_estoque_produtos_farmacia.php' class='print small btn'>
    <i class='glyph-icon icon-print'></i>
    Imprimir
</a>";
}

echo"
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";


?>
