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
    <div id='page-title'>
        <h3>".utf8_encode($loggedInUser->displayname)."
        	<small>Bem vindo ao sistema de gestão hospitalar</small>
        </h3>
    </div>
    <div id='page-content' style='margin-top:-30px;'>
        <div class='row mrg20B'>";
            if (isset($_POST)) {
                if (isset($_POST['aberturaDoCaixa'])) {

                     
                    $id_funcionario = $loggedInUser->user_id;
                    $nome_funcionario = $loggedInUser->displayname;
                    $valor_abertura = $_POST['valor_abertura'];
                    $data_abertura = date('d-m-Y H:i:s');
                    $data_abertura_s = date('d-m-Y');
                    $con=connection();

                    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
                    $query = "INSERT INTO tbl_caixa_abrir VALUES (Null, '$id_funcionario','$valor_abertura','$nome_funcionario','$data_abertura','$data_abertura_s')";
                    $a=mysqli_query($con,$query) ? true : false ;

                    if($a){
                        echo "<script>swal('Caixa aberta com sucesso','','success');</script>";
                    }
                    else echo "<script>swal('Ocorreu um erro ao abrir o caixa!', '', 'error');</script>";
                    }              
            }
            if($loggedInUser->title == 'admin' || $loggedInUser->title == 'enfermeiro' || $loggedInUser->title == 'doctor' || $loggedInUser->title == 'grafico') {
                echo" 
            <div class='col-lg-3'style='margin-top:30px;'>
                <a href='#' style='background-color: #149900; color: #fff;' class='tile-button btn' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                ".$n."
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center style='font-size:65%;'>
                            PACIENTES <br>CADASTRADOS
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                    </div>
                </a>
            </div>       ";			$data = date('Y-m-d');
            						$myQuery = "SELECT nome FROM tbl_paciente WHERE data = '$data'";
            						$resultado = mysqli_query($con, $myQuery);
            						$linhas = mysqli_fetch_row($resultado);
            						$n_recepcao = (count($linhas));
                            
            echo"    
            <div class='col-lg-3' style='margin-top:30px;'>
                <a href='#' style='background-color: #149900; color: #fff;' class='tile-button btn' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                ".$n_recepcao."
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center style='font-size:65%;'>
                            PACIENTES <br>NA RECEPÇÃO
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                    </div>
                </a>
            </div>
            <div class='col-lg-3'style='margin-top:30px;'>
                <a href='#' style='background-color: #149900; color: #fff;' class='tile-button btn' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                ".$hn."
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center style='font-size:65%;'>
                            PACIENTES <br>NOVOS ESTE MÊS
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                    </div>
                </a>
            </div>";
        }
            echo "        
            <div class='col-lg-11'style='margin-top:30px;'>
                <center>
                    <h1>Filas de Atendimento<br />
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
