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
		<h3>Histórico de Vendas dos Serviços Gerais</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 
	if(isset($_GET['Id']))
        {
	        $acao = sanitize($_GET['acao']);
	        $Id = sanitize($_GET['Id']);
	        $con=connection();

	        if ($acao == 'ver') {	


				$con=connection();
				$queryNome="SELECT nome FROM tbl_servicos_gerais";
			    $resultNome=mysqli_query($con,$queryNome);
			    $nomeConsulta = null;
			    while($linha=mysqli_fetch_array($resultNome))
				{
			        $nomeConsulta[] = $linha['nome'];
			    }

	    	$nomeConsulta = $nomeConsulta[0];
			$query="SELECT facturacao_id, nome_paciente, user_name, servico, tipo_pagamento, total, data  FROM tbl_facturacao INNER JOIN tbl_users ON(tbl_facturacao.funcionario = tbl_users.id) WHERE facturacao_id = '$Id'";
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_row($result);
            echo "
            <div id='regbox'>
			<a href='historico_vendas_servicos_gerais.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
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
                                <h4>$row[0]</h4>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Nome'>
                                    Paciente:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[1]</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Preço'>
                                   Funcionário:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>".$row[2]."</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Descrição'>
                                   Serviço:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[3]</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Descrição'>
                                   Tipo de pagamento:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[4]</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Descrição'>
                                   Total:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[5]</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Descrição'>
                                   Data:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[6]</h4>
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
			<th>Funcionário</th>
			<th>Serviço</th>
			<th>Tipo de pagamento</th>
			<th>Total</th>
			<th>Data</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";

	$con=connection();

	    $queryNome="SELECT nome FROM tbl_servicos_gerais";
	    $resultNome=mysqli_query($con,$queryNome);
	    $nomeConsulta = null;
	    while($linha=mysqli_fetch_array($resultNome))
		{
	        $nomeConsulta[] = $linha['nome'];
	    }

	    $nomeConsulta = $nomeConsulta[0];

	$query="SELECT facturacao_id, nome_paciente, user_name, servico, tipo_pagamento, total, data  FROM tbl_facturacao INNER JOIN tbl_users ON(tbl_facturacao.funcionario = tbl_users.id) WHERE 
        (
        servico='RELATORIO MEDICO' 
        OR servico='1 SESSAO DE FISIOTERAPIA' 
        OR servico='10 SESSOES DE FISIOTERAPIA' 
        OR servico='15 SESSOES DE FISIOTERAPIA'
        OR servico='2 SESSAO DE FISIOTERAPIA' 
        OR servico='20 SESSOES DE FISIOTERAPIA'
        OR servico='3 SESSOES PSICOTERAPIA' 
        OR servico='4 SESSAO DE FISIOTERAPIA'
        OR servico='4 SESSOES PSICOTERAPIA'
        OR servico='6 SESSOES PSICOTERAPIA'
        OR servico='8 SESSOES DE FISIOTERAPIA'       
        OR servico='8 SESSOES PSICOTERAPIA' 
        OR servico='ATESTADO MEDICO P/BOLSA DE ESTUDO' 
        OR servico='ATESTADO MEDICO P/CARTA DE CONDUCAO' 
        OR servico='ATESTADO MEDICO P/DESPORTO' 
        OR servico='ATESTADO MEDICO P/MATRICULA' 
        OR servico='ATESTADO MEDICO P/PASSAPORTE' 
        OR servico='ATESTADO MEDICO P/SERVICO' 
        OR servico='INFORMACAO CLINICA' 
        OR servico='RELATORIO MEDICO' )";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		if (is_numeric($row['total']))
		$total = $row['total'];
	
	echo "<tr>
			<td>".$row['facturacao_id']."</td>
			<td>".$row['nome_paciente']."</a></td>
			<td>".$row['user_name']."</td>
			<td>".$row['servico']."</td>
			<td>".utf8_encode($row['tipo_pagamento'])."</td>
			<td>".dinheiro($total)."</td>
			<td>".$row['data']."</td>
			<td>
	            <form method='get' action='historico_vendas_servicos_gerais.php'>
	                <a href='historico_vendas_servicos_gerais.php?Id=".$row['facturacao_id']."&acao=ver&facturaId=".$row['facturacao_id']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
	                    <i class='glyph-icon icon-eye'></i>
	                </a>
	            </form>
	        </td>
		</tr>";
	}	echo "	
	</tbody>
</table>
<a style='background-color: #149900; color: #fff;font-size:15px; padding:6px;' title='Imprimir' target='_blank' href='imprimir/imprimir_relatorio_v_s_gerais.php' class='print small btn primary-bg'>
    <i class='glyph-icon icon-print'></i>
    Imprimir
</a>

</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
?>


