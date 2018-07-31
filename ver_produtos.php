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
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>";
echo "
<div id='page-content-wrapper'>
<div id='page-title'>
<h3>Produtos
</h3>
</div>
<div id='page-content'>
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Vendor Name</th>
			<th>Item Name</th>
			<th>Price</th>
			<th>Date of Submit</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM quotations ORDER BY Id ASC";
	$result=mysqli_query($con,$query);
	$i=1;
	while($row=mysqli_fetch_array($result))
	{
	$date=date('d-m-Y', strtotime($row['Date']));		
	echo "<tr>
<td>".$row['Vendor_Name']."</td><td>".$row['Item_Name']."</td>
<td>".$row['Price']."</td><td>".$date."</td><td>
<a href='quotation_details.php?Id=".$row['Id']."' target='_blank' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='View'>
                            <i class='glyph-icon icon-file-o'></i>
                        </a>
<a href='editar_produto.php?Id=".$row['Id']."'class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Edit'>
                            <i class='glyph-icon icon-edit'></i>
                        </a>
                        <a href='delete_quotation.php?Id=".$row['Id']."' target='_blank' class='btn small bg-red tooltip-button' data-placement='top' title='Remove'>
                            <i class='glyph-icon icon-remove'></i>
                        </a>
</td>
</tr>";
$i=$i+1;
	}
	echo "	
	</tbody>
	<tfoot>
		<tr>
			<th>Vendor Name</th>
			<th>Item Name</th>
			<th>Price</th>
			<th>Date of Submit</th>
			<th>Actions</th>
		</tr>
	</tfoot>
</table>		
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
