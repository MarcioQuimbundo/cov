<?php
$link = mysqli_connect("localhost", "root", "ANGO_covdb157016");
mysqli_select_db($link, "cov");

$servico = '';
if (isset($_GET['servicos'])) {
	$servico = $_GET['servicos'];
}

$tipo_servicos = '';
if (isset($_GET['tipo_servicos'])) {
	$tipo_servicos = $_GET['tipo_servicos'];
}

$tbl = "tbl_servicos_".$servico;

if ($tipo_servicos != "" && $servico != "") {	
	$res = mysqli_query($link, "SELECT preco FROM $tbl WHERE nome = '$tipo_servicos'");
		while ($row = mysqli_fetch_array($res))
			echo $row['preco'];
}
?>
