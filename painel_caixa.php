
<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
?>

        <style>
            .modal {
                z-index: 1000000000000000000000000000;
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                opacity: 0;
                visibility: hidden;
                transform: scaleX(1.1) scaleY(1.1);
                transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
                font-family: sans-serif;
            }
            .modal-content {
                z-index: 1000000000000000000000000000;
                position: absolute;
                top: 45%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 1rem 1.5rem;
                width: 34rem;
                border-radius: 0.5rem;
            }
            .close-button {
                z-index: 1000000000000000000000000000;
                float: right;
                width: 1.5rem;
                line-height: 1.5rem;
                text-align: center;
                cursor: pointer;
                border-radius: 0.25rem;
                background-color: lightgray;
            }
            .close-button:hover {
                background-color: darkgray;
            }
            .show-modal {
                z-index: 1000000000000000000000000000;
                opacity: 1;
                visibility: visible;
                transform: scaleX(1.0) scaleY(1.0);
                transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
            }
            @media only screen and (max-width: 50rem) {
                h1 {
                    font-size: 1.5rem;
                }
                .modal-content {
                    z-index: 1000000000000000000000000000;
                    width: calc(100% - 5rem);                    
                }
            }
        </style>
		<?php
				$con = connection();
				$data_hoje = date("d-m-Y");
				$id_funcionario = $loggedInUser->user_id;
				$queryData = mysqli_query($con, "SELECT data_abertura_simples FROM tbl_caixa_abrir WHERE data_abertura_simples = '$data_hoje' AND id_funcionario = '$id_funcionario'");
				$resultado = mysqli_fetch_array($queryData);
                   $mes = date("m");
                   $dia = date("d");
                   $ano = date("Y"); 
                   $hora = date("H:i:s");
                   echo "$dia/$mes/$ano - $hora"; 
				
				if (count($resultado) == 0) {      
		?>
        <div class="modal">
            <div class="modal-content text-center">            
                <!--<span class="close-button">&times;</span>-->
                <h4>
                    <?php
                        $mes = date("m");
                        $dia = date("d");
                        $ano = date("Y"); 
                        $hora = date("H:i:s");
                        echo "$dia/$mes/$ano - $hora"; 
                    ?>
                </h4><br>
                <h1 class="text-center">Abertura do Caixa</h1><br/>
                
                <form name='aberturaDoCaixa' action='painel.php' method='post'>
                    <div class='form-row'>
                        <div class='form-label col-md-12'>
                            <label style="font-size: 20px;">Valor de Abertura:</label>
                        </div>
                    </div>
                    <div class='form-row'>                    
                        <div class='form-input col-md-12'>
                            <input  style="font-size: 20px;" required='required' type="number" name="valor_abertura" min="0" max="300000" name="troco" />
                        </div>
                    </div>
                    <div class='form-row'>                    
                        <button style=' background-image:-webkit-linear-gradient(top,#149900 0,#149900 100%); width:94%;' 
                                type='submit' 
                                class='btn large primary-bg text-transform-upr font-bold font-size-11 '
                                name="aberturaDoCaixa" 
                                title='Validate!'>
                            <span class='text-center button-content' style='text-align:center; width:92%;'>
                                Abrir Caixa
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
	<?php }?>
    <script>
        var modal = document.querySelector(".modal");
        var trigger = document.querySelector(".trigger");
        var closeButton = document.querySelector(".close-button");

        function toggleModal() {
        modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }
        window.addEventListener("load", toggleModal);
        //window.addEventListener("click", windowOnClick);
        closeButton.addEventListener("click", toggleModal);
        
    </script>


<?php
echo "
<body class='trigger'> 
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
            if($loggedInUser->title == 'admin') {
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
            $query="SELECT * FROM tbl_consultorio";
            $result=mysqli_query($con,$query);
            
            echo "
		</div>		
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
