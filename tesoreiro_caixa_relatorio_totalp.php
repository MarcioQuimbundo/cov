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
    <div id='page-content' style='margin-top:-18px;'>"; ?>


    <a type="button" href="tesoreiro_caixa_relatorio.php" style='padding-right: 10px; font-size:20px; background-color: #149900; color: white' class='btn small'>
                        <span class='button-content'>Voltar</span>
                        <i class='glyph-icon icon-arrow-left'></i>
                    </a>
                    <?php
echo "

    <form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
        <table class='table' id='example1'> 
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Total de Consultas</th>
                    <th>Total de Exames</th>
                    <th>Total de Estomatologia</th>
                    <th>Total de Gerais</th>
                </tr>
            </thead>";
            $con = connection();
            $data_hoje = date("d-m-Y");
				$id=$_GET['id'];
                
                $sqlNome = "SELECT tbl_users.display_name FROM tbl_users WHERE id='$id'";    
                
                $sql = "SELECT tbl_users.display_name,SUM(total) AS Totalc FROM tbl_facturacao INNER JOIN tbl_users ON (tbl_facturacao.funcionario=tbl_users.id) WHERE tipoServico='consultas'AND funcionario='$id' AND data_simples='$data_hoje' ";    
                //var_dump($sqlNome);
                $resultado = mysqli_query($con, $sql);

                $resultadoNome = mysqli_query($con, $sqlNome);


                $sqle = "SELECT tbl_users.display_name,SUM(total) AS Totale FROM tbl_facturacao INNER JOIN tbl_users ON (tbl_facturacao.funcionario=tbl_users.id) WHERE tipoServico='estomatologia'AND funcionario='$id' AND data_simples='$data_hoje'"; 
                        
                $sqlex = "SELECT tbl_users.display_name,SUM(total) AS Totalex FROM tbl_facturacao INNER JOIN tbl_users ON (tbl_facturacao.funcionario=tbl_users.id) WHERE tipoServico='exames'AND funcionario='$id' AND data_simples='$data_hoje'";

                $sqlg = "SELECT tbl_users.display_name,SUM(total) AS Totalg FROM tbl_facturacao INNER JOIN tbl_users ON (tbl_facturacao.funcionario=tbl_users.id) WHERE tipoServico='gerais'AND funcionario='$id' AND data_simples='$data_hoje'";    
                        
                $resultadog = mysqli_query($con, $sqlg);    
                $v4=mysqli_fetch_array($resultadog);
                        
                $resultadoex = mysqli_query($con, $sqlex);
                $v3=mysqli_fetch_array($resultadoex);
       
                $resultadoe = mysqli_query($con, $sqle);
                $v2=mysqli_fetch_array($resultadoe);

                $v1=mysqli_fetch_array($resultado);

                $vnome=mysqli_fetch_row($resultadoNome);
		            echo "
		                <tr>
		                    <td>".utf8_encode($vnome[0])."</td>
                            <td>".dinheiro($v1['Totalc'])."</td>
                            <td>".dinheiro($v3['Totalex'])."</td>
                            <td>".dinheiro($v2['Totale'])."</td>
                            <td>".dinheiro($v4['Totalg'])."</td>
		                </tr>";
    			
echo "
        </table>
        <!--<a style='background-color: #149900; color: #fff; margin-left:5px; font-size:15px; padding:3px;' title='Imprimir' target='_blank' href='imprimir/imprimir_total_caixa_fecho.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
            Imprimir
        </a>-->
    </form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
