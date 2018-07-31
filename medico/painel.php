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

$mes = date("m");
$con = connection();
$q = $con->query("SELECT * FROM tbl_paciente");
$h = $con->query("SELECT * FROM tbl_paciente WHERE MONTH(data_cadastro) = '$mes'");
$n = mysqli_num_rows($q);
$hn = mysqli_num_rows($h);
echo "
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>";
echo "
<div id='page-content-wrapper'>
<div id='page-title'>
<h3>".utf8_encode($loggedInUser->displayname)."
	<small>Bem vindo ao sistema de gestão hospitalar</small>
</h3>
</div>
<div id='page-content' style='margin-top:-30px;'>
 <div class='row mrg20B'>
            <div class='col-lg-3'style='margin-top:30px;'>
                <a href='#' class='tile-button btn bg-gray-alt' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                ".$n."
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            PACIENTES <br>CADASTRADOS
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                    </div>
                </a>
            </div>           
            <div class='col-lg-3' style='margin-top:30px;'>
                <a href='#' class='tile-button btn bg-gray-alt' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                0
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            PACIENTES <br>NA RECEPÇÃO
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                    </div>
                </a>
            </div>
            <div class='col-lg-3'style='margin-top:30px;'>
                <a href='#' class='tile-button btn bg-gray-alt' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                ".$hn."
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            PACIENTES <br>NOVOS ESTE MÊS
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                    </div>
                </a>
            </div>
            <div class='col-lg-11'style='margin-top:30px;'>
                <center>
                    <h1>Filas de Atendimento:</h1>
                </center>
            </div>";
            $query="SELECT * FROM tbl_consultorio";
            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_array($result))
            {
            echo"<div class='col-lg-6'style='margin-top:30px;'>
                <a href='#' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                            ".$row['nome']."
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>";
                            $id_medico = $row['id_medico'];
                            $queryM="SELECT * FROM tbl_medico WHERE id_medico ='$id_medico'";
                            $resultM=mysqli_query($con,$queryM);

                            while ($rowM = mysqli_fetch_array($resultM)) {
                                echo $rowM['nome'];
                            }

                            echo"
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>";
                            $id_medico = $row['id_medico'];
                            $queryA="SELECT * FROM tbl_atendimento WHERE id_medico ='$id_medico' AND ativo = 1 ";
                            $resultA=mysqli_query($con,$queryA);
                            while ($rowA = mysqli_fetch_array($resultA)) {
                                $id_paciente = $rowA['id_paciente'];
                                $queryP="SELECT * FROM tbl_paciente WHERE Id ='$id_paciente'";
                                $resultP=mysqli_query($con,$queryP);
                                while ($rowP = mysqli_fetch_array($resultP)) {
                                    echo "<h4>".$rowP['Nome']."</h4>";
                                }
                            }
                            
                        echo"
                    </div>
                </a>
            </div>";
            }
            echo "
		</div>		
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
