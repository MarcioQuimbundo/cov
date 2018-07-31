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
		<h3>Faturação de Serviços Gerais</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 
		if(isset($_POST['isencao']))
		{
			$id_paciente = $_POST['id_paciente'];
			$n_factura=$_POST['n_factura']; 
			$nome_paciente=$_POST['nome_paciente'];			
			$funcionario = $loggedInUser->user_id; 
			$idade=$_POST['idade'];
			$telefone=$_POST["telefone"];
			$servico=$_POST['servico'];
			$total='';
			$troco='';
			$totalRecebido = '';
			$referencia = '';
			$tipo_pagamento =utf8_decode('Isenção');
			$data = date('d-m-Y H:i:s');
			$data_simples = date('d-m-Y');
			$con=connection();

			$query="INSERT INTO tbl_facturacao VALUES (Null, '$n_factura','$id_paciente','$nome_paciente','$funcionario','$idade','$telefone','gerais','$servico','$total','$troco','$totalRecebido','$tipo_pagamento','$referencia', 0, 0, 0, 0, '$data','$data_simples')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET pagou_sgerais=1 WHERE Id = '$id_paciente'");
			    echo "	<div class='row'>
			                <div class='col-md-6'  style='margin-top:20%;margin-left:25%;'>
			                    <div class='infobox success-bg mrg0A text-center'>
			                        <h2>Facturação efectuada com sucesso</h2><br>
			                        <a href='imprimir/imprimir_fatura_s_gerais.php?id=".$id_paciente."&uid=".$funcionario."' target='_blank' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Gerar Factura</span>
									</a>
			                        <a href='faturar_servicos_gerais.php' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Pacientes</span>
									</a>
			                    </div>
			                </div>
			            </div>";
			            die();
			}         
			else echo "
			            <div class='row'>
			                <div class='col-md-6'>
			                    <div class='infobox error-bg mrg0A'>
			                        <p>Ocorreu um erro</p>
			                    </div>
			                </div>
			            </div>
			        ";
		}
		if(isset($_POST['isencao_p_idade']))
		{
			$id_paciente = $_POST['id_paciente'];
			$n_factura=$_POST['n_factura']; 
			$nome_paciente=$_POST['nome_paciente'];			
			$funcionario = $loggedInUser->user_id; 
			$idade=$_POST['idade'];
			$telefone=$_POST["telefone"];
			$servico=$_POST['servico'];
			$total='';
			$troco='';
			$referencia = '';
			$tipo_pagamento = utf8_decode('Isenção por idade');
			$data = date('d-m-Y H:i:s');
			$data_simples = date('d-m-Y');
			$con=connection();

			$query="INSERT INTO tbl_facturacao VALUES (Null, '$n_factura','$id_paciente','$nome_paciente','$funcionario','$idade','$telefone','gerais','$servico','$total','$troco','$troco','$tipo_pagamento','$referencia', 0, 0, 0, 0, '$data','$referencia', '$data_simples')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET pagou_sgerais=1 WHERE Id = '$id_paciente'");
			    echo "<div class='row'>
			                <div class='col-md-6'  style='margin-top:20%;margin-left:25%;'>
			                    <div class='infobox success-bg mrg0A text-center'>
			                        <h2>Facturação efectuada com sucesso</h2><br>
			                        <a href='imprimir/imprimir_fatura_s_gerais.php?id=".$id_paciente."' target='_blank' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Gerar Factura</span>
									</a>
			                        <a href='faturar_servicos_gerais.php' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Pacientes</span>
									</a>
			                    </div>
			                </div>
			            </div>";
			            die();
			}         
			else echo "
			            <div class='row'>
			                <div class='col-md-6'>
			                    <div class='infobox error-bg mrg0A'>
			                        <p>Ocorreu um erro</p>
			                    </div>
			                </div>
			            </div>
			        ";
		}

		if(isset($_POST['seguro_saude']))
		{
			$id_paciente = $_POST['id_paciente'];
			$n_factura=$_POST['n_factura']; 
			$nome_paciente=$_POST['nome_paciente'];			
			$funcionario = $loggedInUser->user_id; 
			$idade=$_POST['idade'];
			$telefone=$_POST["telefone"];
			$servico=$_POST['servico'];
			$total = '';
			$troco = '';
			$referencia = '';
			$tipo_pagamento =utf8_decode('Seguro de saúde');
			$data = date('d-m-Y H:i:s');
			$data_simples = date('d-m-Y');
			$con=connection();

			$query="INSERT INTO tbl_facturacao VALUES (Null, '$n_factura','$id_paciente','$nome_paciente','$funcionario','$idade','$telefone','gerais','$servico','$total','$troco','$troco','$tipo_pagamento','$referencia', 0, 0, 0, 0, '$data', '$data_simples')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET pagou_sgerais=1 WHERE Id = '$id_paciente'");
			    echo "<div class='row'>
			                <div class='col-md-6'  style='margin-top:20%;margin-left:25%;'>
			                    <div class='infobox success-bg mrg0A text-center'>
			                        <h2>Facturação efectuada com sucesso</h2><br>
			                        <a href='imprimir/imprimir_fatura_s_gerais.php?id=".$id_paciente."&uid=".$funcionario."' target='_blank' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Gerar Factura</span>
									</a>
			                        <a href='faturar_servicos_gerais.php' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Pacientes</span>
									</a>
			                    </div>
			                </div>
			            </div>";
			            die();
			}         
			else echo "
			            <div class='row'>
			                <div class='col-md-6'>
			                    <div class='infobox error-bg mrg0A'>
			                        <p>Ocorreu um erro</p>
			                    </div>
			                </div>
			            </div>
			        ";
		}

		if(isset($_POST['venda_multicaixa']))
		{		
			$id_paciente = $_POST['id_paciente'];
			$n_factura = $_POST['n_factura']; 
			$nome_paciente = $_POST['nome_paciente'];			
			$funcionario = $loggedInUser->user_id; 
			$idade = $_POST['idade'];
			$telefone = $_POST["telefone"];
			$servico = $_POST['servico'];
			$servico = implode(",", $servico);
			$total = $_POST['total'];
			$troco = $_POST['troco'];
			$referencia = $_POST['referencia'];
			$totalRecebido = $_POST['totalRecebido'];
			$tipo_pagamento = utf8_decode('Multicaixa');
			$data = date('d-m-Y H:i:s');
			$data_simples = date('d-m-Y');
			
			$con=connection();

			$query="INSERT INTO tbl_facturacao VALUES 
					(Null, 
					'$n_factura',
					'$id_paciente',
					'$nome_paciente',
					'$funcionario',
					'$idade',
					'$telefone',
					'gerais',
					'$servico',
					'$total',
					'$troco',
					'0',
					'$tipo_pagamento', 
					'$referencia',
					0, 
					0, 
					0, 
					0, 
					'$data',
					'$data_simples')";
					//var_dump($query);
					mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET pagou=1 WHERE Id = '$id_paciente'");
			    echo "	<div class='row'>
			                <div class='col-md-6'  style='margin-top:10%;margin-left:25%;'>
			                    <div class='infobox success-bg mrg0A text-center'>
			                        <h2>Facturação efectuada com sucesso</h2><br>
			                        <a href='imprimir/imprimir_fatura_s_gerais.php?id=".$id_paciente."&uid=".$funcionario."' target='_blank' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Gerar Factura</span>
									</a>
			                        <a href='faturar_servicos_gerais.php' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Pacientes</span>
									</a>
			                    </div>
			                </div>
			            </div>";
			            die();
			}         
			else echo "<script>swal('Opps! Ocorreu Um Erro', '', 'error');</script> ";
		}

		if(isset($_POST['multicaixa']))
		{			
				$id_paciente = $_POST['id_paciente'];
				$n_factura = $_POST['n_factura']; 
				$nome_paciente = $_POST['nome_paciente'];	
				$idade = $_POST['idade'];
				$telefone = $_POST["telefone"];
				$servico = $_POST['servico'];
				$servico = implode(",", $servico);
				$total = $_POST['total'];

			    echo "<div class='row'>
							<div class='col-md-4'  style='text-align: center; box-shadow: 1px 1px 19px 1px gray;margin-top:10%;margin-left:30%; font-size: 20px;'>	
									<h3>Valor Pago: ".dinheiro($total)."</h3><br>
									<form method='post' action='faturar_servicos_gerais.php'>	
										<input type='hidden' name='id_paciente' value='".$id_paciente."' />
										<input type='hidden' name='n_factura' value='".$n_factura."' />
										<input type='hidden' name='nome_paciente' value='".$nome_paciente."' />
										<input type='hidden' name='idade' value='".$idade."' />
										<input type='hidden' name='telefone' value='".$telefone."' />
										<input type='hidden' name='servico[]' value='".$servico."' />
										<input type='hidden' name='total' value='".$total."' />
										<div class='form-row'>										
											<div class='form-label col-md-5'>
												<label for='Nome'>
													Referência:
												</label>
											</div>
											<div class='form-input col-md-5'>
												<input style='font-size: 25px;' type='text' name='totalRecebido' id='valorPagar'  class='form-control' required='required' autocomplete='off' onkeyup='calcularTroco()'/>
											</div>
										</div>
										<button style='background-color:#149900; color: #fff;' class='btn large' name='venda_multicaixa'>
											<span class='button-content'>Facturar</span>
											<i class='glyph-icon icon-money'></i>
										</button>
										<button onclick='window.history.back();' style='background-color:#149900; color: #fff;' class='btn large'>
											<span class='button-content'>Cancelar</span>
											<i class='glyph-icon icon-remove'></i>
										</button>
									</form>
			                </div>
						</div>";
						?>
		<script type="text/javascript">
			function calcularTroco()
			{
				var totalVenda = <?=$total;?>;
				var valorPagar = document.getElementById("valorPagar");
				var troco = document.getElementById("troco");
			
				if(totalVenda != "" && valorPagar.value !="" && valorPagar.value >= totalVenda)
				{
					var x = valorPagar.value - totalVenda;
					troco.value = Math.round(x);
				} else {
					troco.value = "";
				}
			}
		</script>
		<?php
			            die();
		}

		if(isset($_POST['venda_cash']))
		{		
			$id_paciente = $_POST['id_paciente'];
			$n_factura = $_POST['n_factura']; 
			$nome_paciente = $_POST['nome_paciente'];			
			$funcionario = $loggedInUser->user_id; 
			$idade = $_POST['idade'];
			$telefone = $_POST["telefone"];
			$servico = $_POST['servico'];
			$servico = implode(",", $servico);
			$total = $_POST['total'];
			$troco = $_POST['troco'];
			$referencia = '';
			$totalRecebido = $_POST['totalRecebido'];
			$tipo_pagamento = utf8_decode('Cash');
			$data = date('d-m-Y H:i:s');
			$data_simples = date('d-m-Y');
			
			$con=connection();
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$query="INSERT INTO tbl_facturacao VALUES (Null, '$n_factura','$id_paciente','$nome_paciente','$funcionario','$idade','$telefone','gerais','$servico','$total','$troco','$totalRecebido','$tipo_pagamento','$referencia', 0, 0, 0, 0, '$data', '$data_simples')";
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET pagou_sgerais=1 WHERE Id = '$id_paciente'");
			    echo "	<div class='row'>
			                <div class='col-md-6'  style='margin-top:10%;margin-left:25%;'>
			                    <div class='infobox success-bg mrg0A text-center'>
			                        <h2>Facturação efectuada com sucesso</h2><br>
			                        <a href='imprimir/imprimir_fatura_s_gerais.php?id=".$id_paciente."&uid=".$funcionario."' target='_blank' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Gerar Factura</span>
									</a>
			                        <a href='faturar_servicos_gerais.php' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Pacientes</span>
									</a>
			                    </div>
			                </div>
			            </div>";
			            die();
			}         
			else echo "
			            <div class='row'>
			                <div class='col-md-6'>
			                    <div class='infobox error-bg mrg0A'>
			                        <p>Ocorreu um erro</p>
			                    </div>
			                </div>
			            </div>
			        ";
		}
			if(isset($_POST['cash']))
		{			
				$id_paciente = $_POST['id_paciente'];
				$n_factura = $_POST['n_factura']; 
				$nome_paciente = $_POST['nome_paciente'];	
				$idade = $_POST['idade'];
				$telefone = $_POST["telefone"];
				$servico = $_POST['servico'];
				$servico = implode(",", $servico);
				$total = $_POST['total'];

			    echo "<div class='row'>
							<div class='col-md-4'  style='text-align: center; box-shadow: 1px 1px 19px 1px gray;margin-top:10%;margin-left:30%; font-size: 20px;'>	
									<h3>Total da venda: ".dinheiro($total)."</h3><br>
									<form method='post' action='faturar_servicos_gerais.php'>	
										<input type='hidden' name='id_paciente' value='".$id_paciente."' />
										<input type='hidden' name='n_factura' value='".$n_factura."' />
										<input type='hidden' name='nome_paciente' value='".$nome_paciente."' />
										<input type='hidden' name='idade' value='".$idade."' />
										<input type='hidden' name='telefone' value='".$telefone."' />
										<input type='hidden' name='servico[]' value='".$servico."' />
										<input type='hidden' name='total' value='".$total."' />
										<div class='form-row'>										
											<div class='form-label col-md-5'>
												<label for='Nome'>
													Valor a Receber:
												</label>
											</div>
											<div class='form-input col-md-5'>
												<input style='font-size: 25px;' type='text' name='totalRecebido' id='valorPagar'  class='form-control' required='required' autocomplete='off' onkeyup='calcularTroco()'/>
											</div>
										</div>
			                        	<div class='form-row'>
											<div class='form-label col-md-5'>
												<label for='Nome'>
													Troco:
												</label>
											</div>
											<div class='form-input col-md-5'>
												<input style='font-size: 25px;' readonly type='text' name='troco' id='troco'  class='form-control' required='required' autocomplete='off'  onkeyup='calcularTroco()' />
											</div>
										</div>
										<button style='background-color:#149900; color: #fff;' class='btn large' name='venda_cash'>
											<span class='button-content'>Facturar</span>
											<i class='glyph-icon icon-money'></i>
										</button>
										<button onclick='window.history.back();' style='background-color:#149900; color: #fff;' class='btn large' name='venda_cash'>
											<span class='button-content'>Cancelar</span>
											<i class='glyph-icon icon-remove'></i>
										</button>
									</form>
			                </div>
						</div>";
						?>
		<script type="text/javascript">
			function calcularTroco()
			{
				var totalVenda = <?=$total;?>;
				var valorPagar = document.getElementById("valorPagar");
				var troco = document.getElementById("troco");
			
				if(totalVenda != "" && valorPagar.value !="" && valorPagar.value >= totalVenda)
				{
					var x = valorPagar.value - totalVenda;
					troco.value = Math.round(x);
				} else {
					troco.value = "";
				}
			}
		</script>
		<?php
			            die();
		}
		
		//----------------------------------------------------------------------------------------
		if(isset($_GET['Id']))
		{
			$acao = sanitize($_GET['acao']);
			$Id = sanitize($_GET['Id']);
			$con=connection();
		    if ($acao == 'facturar') {
				$query="SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade, telefone				
				FROM tbl_paciente WHERE Id = '$Id'";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_row($result);
				echo "
				<div id='regbox'><br>
				<h2 class='text-center'>Perfil do Paciente</h2><br>
				<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
							<input type='hidden' value='$row[0]' name = 'id_paciente'>
							<input type='hidden' value='COVV000$row[0]' name = 'n_factura'>
							<input type='hidden' value='$row[1]' name = 'nome_paciente'>
							<input type='hidden' value='$row[2]' name = 'idade'>
							<input type='hidden' value='$row[5]' name = 'telefone'>
							<div class='form-row'>
								<div class='form-label col-md-2'>
									<label for='processo'>
										Número da Factura:
									</label>
								</div>
								<div class='form-input col-md-6'>
									<h4>COVV000$row[0]</h4>
								</div>
							</div>
							<div class='form-row'>
								<div class='form-label col-md-2'>
									<label for='Nome'>
										Nome Completo:
									</label>
								</div>
								<div class='form-input col-md-6'>
									<h4>".utf8_encode($row[1])."</h4>
								</div>
							</div>
							<div class='form-row'>
								<div class='form-label col-md-2'>
									<label for='Idade'>
									Idade :
									</label>
								</div>
								<div class='form-input col-md-6'>
									<h4>$row[2]</h4>
								</div>
							</div>
							<div class='form-row'>
								<div class='form-label col-md-2'>
									<label for='Telefone'>
									Telefone:
									</label>
								</div>
								<div class='form-input col-md-6'>
									<h4>$row[3]</h4>
								</div>
							</div>
							<br>
							<h2 class='text-center'>Serviço por facturar</h2><br>
							<table class='table' style='width:70%; margin:0 auto;'>
								<thead>
									<tr>
										<th>Serviço</th>
										<th>Preço</th>
										<th>Taxa %</th>
										<th>Taxa Kz</th>
										<th class='col-md-5'>Total</th>
									</tr>
								</thead>
								<tbody>";
								$con=connection();
								$query="SELECT * FROM tbl_agenda WHERE id_paciente = $Id";
								$result=mysqli_query($con,$query);
								$total = 0;
								while($row=mysqli_fetch_array($result))
								{
									$idS = explode(",", $row["tipo_servicos"]);
									foreach ($idS as $n) {
										$queryS='SELECT * FROM `tbl_servicos_gerais` WHERE nome = "'.$n.'"';
										//var_dump($queryS);
										$resultS=mysqli_query($con,$queryS);
										$rowS=mysqli_fetch_row($resultS);

										echo "<input type='hidden' value='$rowS[1]' name = 'servico[]'>";
										echo "<input type='hidden' value='$rowS[2]' name = 'total'>";
										if ($rowS[2] != 0) {
										echo "<tr>
												<td>".$rowS[1]."</td>
												<td>".dinheiro($rowS[2])."</td>
												<td>0.0 %</td>
												<td>0.0 Kz</td>
												";
												//var_dump($rowS[2]);
												//var_dump($n);
											$total += $rowS[2];
											}
									}
									echo "		<td style='font-weight: bold;'>".dinheiro($total)."</td>
												<input type='hidden' value='".$total."' name='total' />
											</tr>";
							}echo "
							</tbody>
						</table>
						<div id='btnIsencao' class='row text-center' style='margin-right:140px'>
							<!--
				            <button class='btn bg-gray large' name='isencao_p_idade'>
							    <span class='button-content'>Isenção P/ Idade</span>
							    <i class='glyph-icon icon-money'></i>
							</button>
				            <button style='background-color: #149900; color: #fff;' class='btn large' name='seguro_saude'>
							    <span class='button-content'>Seguro de Saúde</span>
							    <i class='glyph-icon icon-money'></i>
							</button>-->
				            <button class='btn primary-bg large' name='multicaixa'>
							    <span class='button-content'>Multicaixa</span>
							    <i class='glyph-icon icon-money'></i>
							</button>
				            <button style='background-color: #b20000; color: #fff;'  class='btn bg-red large' name='cash'>
							    <span class='button-content'>Cash AO</span>
							    <i class='glyph-icon icon-money'></i>
							</button>
						</div>
			</form>
			"; 
			?>					
			<script>
				setInterval(function(){
					$("#btnIsencao").load('ajaxBtnIsencao.php');
				}, 1000)
					
			</script>
			<?php
			die();
		    }		
		} 
echo "
	<table class='table' id='example1'>
		<thead>
			<tr>
				<th>&nbsp;&nbsp;&nbsp;Nome do Paciente</th>
				<th>Idade</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>";
		$con=connection();

		$queryNome="SELECT nome FROM tbl_servicos_gerais";
	    $resultNome=mysqli_query($con,$queryNome);

	    while($linha=mysqli_fetch_array($resultNome))
		{
	        $nomeConsulta[] = $linha['nome'];
	    }

	    $nomeConsulta = $nomeConsulta[0];

		/*$query = "SELECT t.Id, t.nome, t.endereco, (TIMESTAMPDIFF(YEAR, t.data_nasc, CURDATE())) AS idade FROM tbl_paciente as t INNER JOIN tbl_agenda ON (tbl_agenda.id_paciente = t.Id) WHERE 
		tipo_servicos='RELATORIO MEDICO' 
		OR tipo_servicos ='1 SESSAO DE FISIOTERAPIA' 
		OR tipo_servicos ='10 SESSOES DE FISIOTERAPIA' 
		OR tipo_servicos ='15 SESSOES DE FISIOTERAPIA'
		OR tipo_servicos ='2 SESSAO DE FISIOTERAPIA' 
		OR tipo_servicos ='20 SESSOES DE FISIOTERAPIA'
		OR tipo_servicos ='3 SESSOES PSICOTERAPIA' 
		OR tipo_servicos ='4 SESSAO DE FISIOTERAPIA'
		OR tipo_servicos ='4 SESSOES PSICOTERAPIA'
		OR tipo_servicos ='6 SESSOES PSICOTERAPIA'
		OR tipo_servicos ='8 SESSOES DE FISIOTERAPIA'		
		OR tipo_servicos ='8 SESSOES PSICOTERAPIA' 
		OR tipo_servicos ='ATESTADO MEDICO P/BOLSA DE ESTUDO' 
		OR tipo_servicos ='ATESTADO MEDICO P/CARTA DE CONDUCAO' 
		OR tipo_servicos ='ATESTADO MEDICO P/DESPORTO' 
		OR tipo_servicos ='ATESTADO MEDICO P/MATRICULA' 
		OR tipo_servicos ='ATESTADO MEDICO P/PASSAPORTE' 
		OR tipo_servicos ='ATESTADO MEDICO P/SERVICO' 
		OR tipo_servicos ='INFORMACAO CLINICA' 
		OR tipo_servicos ='RELATORIO MEDICO' 

		AND t.agendado=1 AND t.pagou_sgerais=0 ";*/
		/*
		$query = "SELECT 
					t.Id, t.nome, t.endereco, 
					(TIMESTAMPDIFF(YEAR, 
					t.data_nasc, 
					CURDATE())) AS idade 
					FROM tbl_paciente as t 
					INNER JOIN tbl_agenda ON (tbl_agenda.id_paciente = t.Id) 
					WHERE FIND_IN_SET('$nomeConsulta',tipo_servicos) AND  
					t.agendado=1 AND t.pagou_sgerais=0";*/
		//var_dump($query);
		//var_dump($query);
		$query = "SELECT 
					t.Id, t.nome, t.endereco, 
					(TIMESTAMPDIFF(YEAR, 
					t.data_nasc, 
					CURDATE())) AS idade 
					FROM tbl_paciente as t 
					INNER JOIN tbl_agenda ON (tbl_agenda.id_paciente = t.Id) 
					WHERE (
						servicos = 'gerais' OR 
						servicos = 'gerais,gerais' OR 
						servicos = 'gerais,gerais,gerais' OR 
						servicos = 'gerais,gerais,gerais,gerais' OR 
						servicos = 'gerais,exames' OR 
						servicos = 'gerais,exames,exames' OR 
						servicos = 'gerais,exames,exames,exames' OR 
						servicos = 'gerais,exames,exames,exames,exames' OR 
						servicos = 'gerais,gerais,exames' OR 
						servicos = 'gerais,gerais,exames,exames' OR 
						servicos = 'gerais,gerais,gerais,exames' OR 
						servicos = 'gerais,gerais,gerais,exames,exames' OR 
						servicos = 'gerais,gerais,gerais,gerais,gerais') AND  
					t.agendado=1 AND t.pagou_sgerais=0";
		$result=mysqli_query($con,$query);
		while($row=mysqli_fetch_array($result))
		{
		echo "<tr>
				<td>".utf8_encode($row['nome'])."</td>
				<td>".$row['idade']."</td>
				<td>
				<form method='get' action='faturar_servicos_gerais.php'>
				";
				if($loggedInUser->title == 'admin') {
					echo "
					<a href='faturar_servicos_gerais.php?Id=".$row['Id']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
						<i class='glyph-icon icon-edit'></i>
					</a>";
				}
					echo "
					<a href='faturar_servicos_gerais.php?Id=".$row['Id']."&acao=facturar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Facturar'>
						<i class='glyph-icon icon-money'></i>
					</a>
				</form>
				</td>
			</tr>";
	}
		echo "  
		</tbody>
	</table>	
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
?>
