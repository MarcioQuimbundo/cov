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
    $hora = date("H:i:s");
    $data_hoje = date("d-m-Y");
    echo "$dia/$mes/$ano - $hora"; 
    $id_funcionario = $loggedInUser->user_id;
    
    $con = connection();
    $query = "SELECT valor_abertura FROM tbl_caixa_abrir WHERE id_funcionario = $id_funcionario AND data_abertura_simples = '$data_hoje' ORDER BY valor_abertura ";
    $queryTot = "SELECT SUM(total_recebido) FROM `tbl_facturacao` WHERE data_simples = '$data_hoje' AND funcionario = $id_funcionario";


    $resultado = mysqli_query($con, $query);
    $resultadoTot = mysqli_query($con, $queryTot);

    $linhaTot = mysqli_fetch_row($resultadoTot);
    $linha = mysqli_fetch_row($resultado);
    $total = $linha[0] + $linhaTot[0];
    $linha = $total;

	echo "
	<div id='page-content-wrapper'>
		<div id='page-title' style='margin-bottom:18px;'>
		<h3>Fecho do caixa</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>";	
		if (isset($_POST['fechar_caixa'])) {
                    $nome_funcionario = $loggedInUser->displayname;
                    $valor_fecho = $_POST['valor_fecho'];
                    $valor_fecho_mao = $_POST['valor_fecho_mao'];
                    $data_fecho = date('d-m-Y H:i:s');
					mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'"); 
					mysqli_query($con,"UPDATE tbl_users SET active = '0' WHERE tbl_users.id = '$id_funcionario'");
                    $query = "INSERT INTO tbl_caixa_fechar VALUES (Null, '$id_funcionario','$valor_fecho','$valor_fecho_mao','$nome_funcionario','$data_fecho','$data_hoje')";
                    //var_dump($query);
                    $a=mysqli_query($con,$query) ? true : false ;

                    if($a){ ?>
                    		<script type="text/javascript">
                    			setTimeout("location.href = 'logout.php';", 3000);
                    		</script>
                         <?php
                         echo "	<div class='row'>
										<div class='col-md-4'  style='text-align: center; box-shadow: 1px 1px 19px 1px gray;margin-top:10%;margin-left:30%; font-size: 20px;'>	
											<h3>$dia/$mes/$ano - $hora</h3>
											<form method='post' action='caixa_fechar.php'>	
												<script>swal('Caixa fechado Com Sucesso','','success');</script>
												echo'<script>window.location='index.php';</script>';

											</form>
							            </div>
								</div>";
								die();
							}
                    else echo "<script>alert('Ocorreu um erro ao fechar o caixa!');</script>";
	}
		echo "		<div class='row'>
						<div class='col-md-4'  style='text-align: center; box-shadow: 1px 1px 19px 1px gray;margin-top:10%;margin-left:30%; font-size: 20px;'>	
							<h3>$dia/$mes/$ano - $hora</h3><br>
							<form method='post' action='caixa_fechar.php'>	
								<div class='form-row'>										
									<div class='form-label col-md-6'>
										<label for='Nome'>
											Valor do fecho:
										</label>
									</div>
									<div class='form-input col-md-6'>
									<input style='font-size: 25px;' value = '$linha' type='hidden' name='valor_fecho' id='valor_fecho'  class='form-control' required='required' autocomplete='off''/>
											<input style='font-size: 25px;' type='number' name='valor_fecho_mao' id='valor_fecho_mao'  class='form-control' required='required' autocomplete='off''/>
									</div>
								</div>
								<button style='background-color:#149900; color: #fff;' class='btn large' name='fechar_caixa'>
									<span class='button-content'>Fechar caixa</span>
									<i class='glyph-icon icon-money'></i>
								</button>
							</form>
			            </div>
					</div>
			</div><!-- #page-content -->
		</div><!-- #page-main -->
	</div><!-- #page-wrapper -->
	";
?>