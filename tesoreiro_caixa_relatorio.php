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
        <h3>Relatorio do Caixa - hoje.</h3>
    </div>
    <div id='g10' class='small-gauge float-left hidden'></div>
    <div id='g11' class='small-gauge float-right hidden' style='border: 1px solid red;'></div>
    <div id='page-content' style='margin-top:-18px;'>"; 
echo "
    <form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
        <table class='table' id='example1'> 
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Data/Hora da abertura</th>
                    <th>Data/Hora do fecho</th>
                    <th>Abertura</th>
					<th>fecho(sistema)</th>
					<th>fecho(mão)</th>
                    <th>Ações</th>
                </tr>
            </thead>";
            $con = connection();
            $data_hoje = date("d-m-Y");
				
				$sql = "SELECT DISTINCTROW(tbl_caixa_abrir.id_funcionario), 
				tbl_caixa_abrir.nome_funcionario, 
				data_abertura, data_fecho, 
				valor_abertura, 
				valor_fecho,
				valor_fecho_mao
                        FROM tbl_caixa_abrir 
                        INNER JOIN tbl_caixa_fechar ON (tbl_caixa_fechar.id_funcionario = tbl_caixa_abrir.id_funcionario)
                        WHERE data_abertura_simples = '$data_hoje' AND data_fecho_simples = '$data_hoje'";	
				$resultado = mysqli_query($con, $sql);
				
            	while($v1=mysqli_fetch_array($resultado)){
		            echo "
		                <tr>
		                    <td>".utf8_encode($v1['nome_funcionario'])."</td>
		                    <td>".$v1['data_abertura']."</td>
		                    <td>".$v1['data_fecho']."</td>
		                    <td>".dinheiro($v1['valor_abertura'])."</td>
		                    <td>".dinheiro($v1['valor_fecho'])."</td>
		                    <td>".dinheiro($v1['valor_fecho_mao'])."</td>
		                    <td>
		                    	<a href='tesoreiro_caixa_relatorio_totalp.php?id=".$v1['id_funcionario']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='ver'>
							        <i class='glyph-icon icon-eye'></i>
							    </a>
							    <!--<a href='#' class='btn small bg-blue-alt  tooltip-button' data-placement='top' title='imprimir'>
                                    <i class='glyph-icon icon-print'></i>
                                </a>-->

		                    </td>
		                </tr>";
    			}
echo "
        </table>
    </form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
