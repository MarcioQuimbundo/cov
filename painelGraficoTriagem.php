<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
include('models/topbar.php');
echo "
<body'> 
    <div id='loading' class='ui-front loader ui-widget-overlay bg-white opacity-100'>
    <img src='assets/images/loader-dark.gif' alt=''>
    </div>
    <div id='page-wrapper' class='demo-example'>";

    $mes = date("m");
    $dia = date("d");
    $ano = date("Y");
    $con = connection();
    $q = $con->query("SELECT * FROM tbl_paciente");
    $h = $con->query("SELECT * FROM tbl_paciente WHERE MONTH(data) = '$mes'");
    $n = mysqli_num_rows($q);
    $hn = mysqli_num_rows($h);
    echo "
    <div id='g10' class='small-gauge float-left hidden'></div>
    <div id='g11' class='small-gauge float-right hidden'></div>";
    echo "
    <div id='page-content-wrapper'>
    <div id='page-content' style='margin-top:-30px;'>
        <div class='row mrg20B'>";
            if($loggedInUser->title == 'admin' || $loggedInUser->title == 'enfermeiro' || $loggedInUser->title == 'doctor' || $loggedInUser->title == 'grafico') {
                $data = date('Y-m-d');
            	$myQuery = "SELECT nome FROM tbl_paciente WHERE data = '$data'";
            	$resultado = mysqli_query($con, $myQuery);
            	$linhas = mysqli_fetch_row($resultado);
            	$n_recepcao = (count($linhas));
        }
            echo "        
            <div class='col-lg-11'style='margin-top:30px;'>
                <center>
                    <h1>Filas de Atendimento da Triagems<br />
                    ".$dia."/".$mes."/".$ano."</h1>
                </center>
            </div>";

            echo "<div id='resultado'>
            </div>";
            
            echo "
		</div>		
    </div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
<script>
    setInterval(function(){
        $("#resultado").load('ajaxGrafico.php');
    }, 1000)
        
</script>
