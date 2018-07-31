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
		<h3>Histórico de Devoluções das Consultas</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>";
	if(isset($_GET['Id']))
        {
	        $acao = sanitize($_GET['acao']);
	        $Id = sanitize($_GET['Id']);

	        if ($acao == 'ver') {	

				$con=connection();
				$query="SELECT * FROM tbl_devolucao_servicos_consultas";
	            $result=mysqli_query($con,$query);
	            $row=mysqli_fetch_row($result);

	            echo "
	            	<div id='regbox'>
			<a href='h_devolucao_servicos_consultas.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
	            		<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
	                        <div class='form-row'>
	                            <div class='form-label col-md-2'>
	                                <label for='processo'>
	                                    Nº da fatura:
	                                </label>
	                            </div>
	                            <div class='form-input col-md-6'>
	                                <h4>$row[1]</h4>
	                            </div>
	                        </div>
	                        <div class='form-row'>
	                            <div class='form-label col-md-2'>
	                                <label for='Nome'>
	                                    Paciente:
	                                </label>
	                            </div>
	                            <div class='form-input col-md-6'>
	                                <h4>$row[2]</h4>
	                            </div>
	                        </div>

	                        <div class='form-row'>
	                            <div class='form-label col-md-2'>
	                                <label for='Preço'>
	                                   Serviço:
	                                </label>
	                            </div>
	                            <div class='form-input col-md-6'>
	                                <h4>".$row[3]."</h4>
	                            </div>
	                        </div>

	                        <div class='form-row'>
	                            <div class='form-label col-md-2'>
	                                <label for='Descrição'>
	                                   Total:
	                                </label>
	                            </div>
	                            <div class='form-input col-md-6'>
	                                <h4>$row[4]</h4>
	                            </div>
	                        </div>

	                        <div class='form-row'>
	                            <div class='form-label col-md-2'>
	                                <label for='Descrição'>
	                                   Data da Devolução::
	                                </label>
	                            </div>
	                            <div class='form-input col-md-6'>
	                                <h4>$row[5]</h4>
	                            </div>
	                        </div>
	            		</form>
	            ";
             die();
	        }
        }


echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nº da factura</th>
			<th>Paciente</th>
			<th>Serviço</th>
			<th>Total</th>
			<th>Data/Hora</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";

	$con=connection();

		$query = "SELECT * FROM tbl_devolucao_servicos_consultas";	
		$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{

	if (is_numeric($row['total']))
		$total = $row['total'];

	echo "<tr>
			<td>".$row['n_fatura']."</td>
			<td>".$row['paciente']."</a></td>
			<td>".$row['servico']."</td>
			<td>".dinheiro($total)."</td>
			<td>".$row['data_devolucao']."</td>
			<td>
	            <form method='get' action='h_devolucao_servicos_consultas.php'>
	                <a href='h_devolucao_servicos_consultas.php?Id=".$row['id']."&acao=ver' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
	                    <i class='glyph-icon icon-eye'></i>
	                </a>
	            </form>
	        </td>
		</tr>";
	}	echo "	
	</tbody>
</table>
<a style='background-color: #149900; color: #fff;font-size:15px; padding:6px;' title='Imprimir' target='_blank' href='imprimir/imprimir_relatorio_d_s_consultas.php' class='print small btn primary-bg'>
    <i class='glyph-icon icon-print'></i>
    Imprimir
</a>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
?>


