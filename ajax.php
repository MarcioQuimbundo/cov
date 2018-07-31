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


if ($servico != "") {
		$tbl = "tbl_servicos_".$servico;
		$res = mysqli_query($link, "SELECT * FROM $tbl");
		echo "<select id='tipo_servicos' name='tipo_servicos' onchange='mudaPreco();'>
				<option value=''>-- Tipo de serviço --</option>";
			while ($row = mysqli_fetch_array($res)) {
				echo "<option value ='".$row['nome']."'>".$row['nome']."</option>";
			}
		echo "</select>";
}elseif ($tipo_servicos != "") {

	$res = mysqli_query($link, "SELECT preco FROM $tbl WHERE nome = '$tipo_servicos'");
		while ($row = mysqli_fetch_array($res))
			echo $row['preco'];

}
?>
