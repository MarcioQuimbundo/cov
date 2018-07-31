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
<h3>Alocadores
</h3>
</div>
<div id='page-content'>
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Local</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_alocador ORDER BY id_alocador ASC";
	$result=mysqli_query($con,$query);
	$i=1;
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['local']."</td>
			<td>
			<a href='#'class='btn small bg-blue-alt tooltip-button' data-placement='top' title='View'>
			                            <i class='glyph-icon icon-file-o'></i>
			                        </a>
			<a href='#' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Edit'>
			                            <i class='glyph-icon icon-edit'></i>
			                        </a>
			                        <a href='#' class='btn small bg-red tooltip-button' data-placement='top' title='Remove'>
			                            <i class='glyph-icon icon-remove'></i>
			                        </a>
			</td>
		</tr>";
$i=$i+1;
	}
	echo "	
	</tbody>
</table>		
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
