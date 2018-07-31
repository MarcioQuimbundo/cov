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
        <h3>Relatorio do Caixa</h3>
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
                    <th>Total de Estomatologia(sistema)</th>
                </tr>
            </thead>";
            $con = connection();
            $data_hoje = date("d-m-Y");
				
				$sql = "SELECT tbl_users.display_name,SUM(total) AS Total FROM tbl_facturacao INNER JOIN tbl_users ON (tbl_facturacao.funcionario=tbl_users.id) WHERE tipoServico='estomatologia'";	
                        
				$resultado = mysqli_query($con, $sql);
                //var_dump($resultado);
            	while($v1=mysqli_fetch_array($resultado)){
		            echo "
		                <tr>
		                    <td>".utf8_encode($v1['display_name'])."</td>
                            <td>".dinheiro($v1['Total'])."</td>
		                </tr>";
    			}
echo "
        </table>
        <a style='background-color: #149900; color: #fff; margin-left:5px; font-size:15px; padding:3px;' title='Imprimir' target='_blank' href='imprimir/imprimir_total_caixa_fecho.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
            Imprimir
        </a>
    </form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
