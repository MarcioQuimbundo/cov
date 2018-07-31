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
        <h3>Abertura/Fecho do Caixa.</h3>
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
                    <th>Data/Hora de abertura</th>
                    <th>Data/Hora do fecho</th>
                    <th>Valor da abertura</th>
                    <th>Valor de fecho</th>
                    <th>Qtd de facturas</th>
                    <th>Total</th> <!-- somatório do valor de abertura mais o de fecho -->
                    <th>Ações</th>
                </tr>
            </thead>";
            $con = connection();
            $data_hoje = date("d-m-Y");
            $sql = "SELECT 
            		tbl_users.display_name, 
            		tbl_caixa_abrir.data_abertura, 
            		tbl_caixa_fechar.data_fecho,
            		decimal(tbl_caixa_abrir.valor_abertura), 
            		tbl_caixa_fechar.valor_fecho,
            		COUNT(tbl_facturacao.total_recebido) AS decimal(total)
            		FROM tbl_users 
            		INNER JOIN tbl_facturacao ON(tbl_users.id = tbl_facturacao.funcionario)
            		INNER JOIN tbl_caixa_abrir ON(tbl_users.id = tbl_caixa_abrir.id_funcionario)
            		INNER JOIN tbl_caixa_fechar ON(tbl_users.id = tbl_caixa_fechar.id_funcionario)
            		";
				$resultado = mysqli_query($con, $sql);
            	while($v1=mysqli_fetch_array($resultado)){
		            echo "
		                <tr>
		                    <td>".utf8_encode($v1['display_name'])."</td>
		                    <td>".$v1['data_abertura']."</td>
		                    <td>".$v1['data_fecho']."</td>
		                    <td>".dinheiro($v1['valor_abertura'])."</td>
		                    <td>".$v1['valor_fecho']."</td>
		                    <td>".$v1['total']."</td>
		                    <td>".$v1['valor_fecho']."</td>
		                    <td>
		                    	<a href='#' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='ver'>
							        <i class='glyph-icon icon-eye'></i>
							    </a>
							    <a href='#' class='btn small bg-gray  tooltip-button' data-placement='top' title='imprimir'>
							        <i class='glyph-icon icon-print'></i>
							    </a>
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
