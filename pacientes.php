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
		<h3>Pacientes</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 


				if (isset($_POST['agendar_servico'])){
					
					$con = connection();
					$id_paciente = sanitize($_POST['id_paciente']);
					$id_medico = sanitize($_POST['profissional']);
					$user_id = $loggedInUser->user_id;
					$n_consulta = $_POST['n_consulta'];
					$agendado_por = $_POST['agendado_por'];
					$hora = $_POST['hora'];
					$data = $_POST['data'];
					$servicos = $_POST['servicos'];	
					$servicos = implode(",", $servicos);					
					$tipo_servicos = $_POST['tipo_servicos'];	
					$tipo_servicos = implode(",", $tipo_servicos);
					$total = $_POST['total'];
					$data_agenda = date('Y-m-d H:i:s');
	
					if (empty($id_medico) || empty($n_consulta) || empty($data) || empty($id_medico) || empty($tipo_servicos) || empty($servicos)) {
				        echo "
				                <script>alert('Paciente não foi agendado, preencha todos os campos!');</script>
				            ";
					}else{
						$queryPId="SELECT id_paciente FROM tbl_agenda WHERE id_paciente = $id_paciente";
						$resultado = mysqli_query($con, $queryPId);
						$linha = mysqli_fetch_array($resultado);

						if ($linha == null) {
							$query="INSERT INTO tbl_agenda values(Null, $id_paciente,'$id_medico','$user_id','$n_consulta','$hora','$data','$servicos','$tipo_servicos', 0, '$data_agenda')";
							mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
							$result=mysqli_query($con,$query);
						} else {
							$query="UPDATE `tbl_agenda` 
									SET `id_medico` = '$id_medico',
									user_id = '$user_id',
									n_consulta = '$n_consulta',
									hora = '$hora',
									data = '$data',
									servicos = '$servicos',
									tipo_servicos = '$tipo_servicos',
									data_agenda = '$data_agenda' WHERE `tbl_agenda`.`id_paciente` = '$id_paciente'";
							$result=mysqli_query($con,$query);
						}
						if($result){
							$novoResult = mysqli_query($con,"UPDATE tbl_paciente SET agendado=1, pagou = 0, pagou_estomatologia = 0, pagou_exames = 0, pagou_sgerais = 0, triado = 0, atendido_medico = 0 WHERE Id = '$id_paciente'");
							
							echo "<script>swal('Paciente agendado com sucesso','','success');</script>";
						}
					}
				}

				if (isset($_POST['faturar_servico'])){
					
					$con = connection();
					$id_paciente = sanitize($_POST['id_paciente']);
					$id_medico = sanitize($_POST['profissional']);
					$user_id = $loggedInUser->user_id;
					$n_consulta = $_POST['n_consulta'];
					$agendado_por = $_POST['agendado_por'];
					$hora = $_POST['hora'];
					$data = $_POST['data'];
					$servicos = $_POST['servicos'];	
					$servicos = implode(",", $servicos);					
					$tipo_servicos = $_POST['tipo_servicos'];	
					$tipo_servicos = implode(",", $tipo_servicos);
					$total = $_POST['total'];
					$data_agenda = date('Y-m-d H:i:s');
	
					if ( empty($tipo_servicos) || empty($servicos)) {
				        echo "
				                <script>alert('Paciente não foi agendado, preencha todos os campos!');</script>
				            ";
					}else{
						$queryPId="SELECT id_paciente FROM tbl_agenda WHERE id_paciente = $id_paciente";
						$resultado = mysqli_query($con, $queryPId);
						$linha = mysqli_fetch_array($resultado);

						if ($linha == null) {
							$query="INSERT INTO tbl_agenda values(Null, $id_paciente,'$id_medico','$user_id','$n_consulta','$hora','$data','$servicos','$tipo_servicos', 0, '$data_agenda')";
							mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
							$result=mysqli_query($con,$query);
						} else {
							$query="UPDATE `tbl_agenda` 
									SET `id_medico` = '$id_medico',
									user_id = '$user_id',
									n_consulta = '$n_consulta',
									hora = '$hora',
									data = '$data',
									servicos = '$servicos',
									tipo_servicos = '$tipo_servicos',
									data_agenda = '$data_agenda' WHERE `tbl_agenda`.`id_paciente` = '$id_paciente'";
							$result=mysqli_query($con,$query);
						}
						if($result){
							$novoResult = mysqli_query($con,"UPDATE tbl_paciente SET agendado=1, pagou = 0, pagou_estomatologia = 0, pagou_exames = 0, pagou_sgerais = 0, triado = 0, atendido_medico = 0 WHERE Id = '$id_paciente'");
							
							echo "<script>swal('Paciente enviado para o caixa com sucesso','','success');</script>";
						}
					}
				}

		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();
		if ($acao == 'apagar') {
			$query="DELETE FROM tbl_paciente WHERE Id='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
					echo "<script>swal('Paciente removido com sucesso','','success');</script>";
		        }
			else echo "<script>swal('Ocorreu um erro ao remover o paciente','','error');</script>";
		}

		if ($acao == 'agendar') {
				
				$patient_id = $_GET['Id'];

				$q = mysqli_query($con,"SELECT * FROM tbl_paciente WHERE Id = '$patient_id' LIMIT 1");
                                $n = mysqli_num_rows($q); 
                                if($n<=0){
                                    return 0;
                                } else {
                                    while($r = mysqli_fetch_array($q)){
                                        $pn = $r['nome'];
                                    }
                                }
				?>	
				<form name='newHospital' class='form-bordered' action='pacientes.php' method='post'>
	            <div class='form-row'>
	            	<a type="button" href="pacientes.php" style='padding-right: 10px; font-size:20px; background-color: #149900; color: white' class='btn small'>
					    <span class='button-content'>Voltar</span>
					    <i class='glyph-icon icon-arrow-left'></i>
					</a>
	            	<button onclick="location.reload();" type="button" href="pacientes.php" style='padding-right: 10px; font-size:20px; background-color: #149900; color: white' class='btn small'>
					    <span class='button-content'>Actualizar página</span>
					    <i class='glyph-icon icon-refresh'></i>
					</button><br>
	           		<input type='hidden' value='<?=$patient_id; ?>' name='id_paciente' id='id_paciente' onfocus='searchVendor()'>

	                <div class='form-label col-md-2'>
	                    <label for='nome'> 
	                        Nome:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input disabled type='text' value='<?=utf8_encode($pn); ?>' name='nome' id='nome' onfocus='searchVendor()'>
	                    <input type='hidden' value='<?=utf8_encode($pn); ?>' name='nome' id='nome' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='n_consulta'>	 
						Nº da consulta:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input disabled value='AGEND000<?=$patient_id; ?>' type='text' name='n_consulta' id='n_consulta' onfocus='searchVendor()'>
	                    <input type='hidden' value='AGEND000<?=$patient_id; ?>' name='n_consulta' id='n_consulta' onfocus='searchVendor()'>
	                </div>
	            </div>
				
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='agendado_por'>
						Agendado por:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input disabled value='<?=utf8_encode($loggedInUser->displayname); ?>' type='text' name='agendado_por' id='agendado_por' onfocus='searchVendor()'>
	                    <input value='<?=utf8_encode($loggedInUser->displayname); ?>' type='hidden' name='agendado_por' id='agendado_por' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='semana'>
	                       Semana:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
						<select required='required' id='diaDaSemana' onchange="mudaMedicoSemana();" name='diaDaSemana' class='form-control' style="font-size: 14px;">
							<option value='' >-- Selecione --</option>
	    	         		<option value='Segunda-Feira' >Segunda-Feira</option>
	    	         		<option value='Terca-Feira' >Terça-Feira</option>
	    	         		<option value='Quarta-Feira' >Quarta-Feira</option>
	    	         		<option value='Quinta-Feira' >Quinta-Feira</option>
	    	         		<option value='Sexta-Feira' >Sexta-Feira</option>
	    	         		<option value='Sabado' >Sabado</option>
	    	         		<option value='Domingo' >Domingo</option>                              
						</select>
					</div>
	        	</div>	

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='hora'>
	                        Hora:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='time' name='hora' id='hora' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='data'>
	                        Data:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input min='<?=date('Y-m-d'); ?>' required='required' type='date' name='data' id='data' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='especialidade'>
	                        Especialidade:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
						<select required='required' id='especialidade' onchange="mudaMedico();" name='especialidade' class='form-control' style="font-size: 14px;">
							<option value='' selected='selected'>-- Escolha uma especialidade --</option>  
							<?php  
								$query="SELECT id_especialidade, nome FROM tbl_especialidade";
								$result=mysqli_query($con,$query);
								while($row=mysqli_fetch_array($result))
								{
							?>
							<option value=<?=$row['id_especialidade']; ?> ><?=$row['nome']; ?></option>        
							<?php } ?>                           
						</select>
					</div>
	        	</div>	
	        	
	        	<div class='form-row'>
	        		<div class='form-label col-md-2'>
						<label for='servicos'>
							Professional:
						</label>
					</div>
	            	<div class='form-input col-md-6'>
						<select required='required' id='medico' name='profissional' class='form-control' style="font-size: 14px;">
							<option value='' selected='selected'>-- Selecione o profissional --</option> 
						</select>
					</div>	
	        	</div>
				
	        	<div class='form-row'>
	        		<div class='form-label col-md-2'>
						<label for='servicos'>
							Serviços:
						</label>

					</div>
					<div class='form-input col-md-2'>
						<select required='required' onchange="mudaServico();" id='servicos' name='servicos[]' class='form-control' style="font-size: 14px;">
							<option value='' selected='selected'>-- Selecione um serviço --</option> 
							<option value="consultas">Consulta</option>
							<option value="estomatologia">Estomatologia</option>
						</select>
					</div>

					<div class='form-input col-md-2'>
						<select onchange="mudaPreco();" required='required' id='tipo_servicos' name='tipo_servicos[]' class='form-control' style="font-size: 14px;">
							<option value='' selected='selected'>-- Tipo de serviço --</option> 
						</select>
					</div>
					<div class='form-input col-md-2'  >
						<input readonly="readonly" style="font-size: 28px;" id='preco' type='text'  >
					</div>		
					<div class='form-input col-md-1'>
						<label style="font-size: 20px; position: relative; top: 8px; right: 26px">kz</label>
					</div>				
	        	</div>
	        	<div class='row'>
					<div id='container'>																		            		
					</div>						            		
				</div>

				<div class='form-row'>
	        		<div class='form-label col-md-2'>
						<label for='servicos'>
							Total:
						</label>

					</div>
					<div class='form-input col-md-2'>
					</div>				
					<div class='form-input col-md-2'>
					</div>				
					<div class='form-input col-md-2'>
						<input class="precos" readonly="readonly" value = "0" style="font-size: 28px; color:#149900;" id='total' name="total" type='text'  >
					</div>				
					<div class='form-input col-md-1'>
						<label style="font-size: 20px; position: relative; top: 8px; right: 26px">kz</label>
					</div>				
	        	</div>
				<br>
	        	<div>
						<p id='add_field' style="cursor: pointer; color: #fff; background-color:#149900; width: 3%;" class='medium btn small'>
								<span class='button-content' style="font-size: 22px;">+</span>
						</p>
					</div><br>
	        	
				<script type="text/javascript">
					var counter = 0;
					$(function(){
						$('p#add_field').click(function(){
							counter += 1;
							$('#container').append(
								'<div class="form-row">'
								+ '<div class="form-label col-md-2" style="border-right: 0px;">'
								+ '<label for="servicos">'
								+ '</label>'
								+ '</div>'
								+ '<div class="form-input col-md-2">'
								+ '<select required="required" onchange="mudaServico'+counter+'();" id="servicos'+counter+'" name="servicos[]" class="form-control" style="font-size: 14px;">'
								+'<option value="" selected="selected">-- Selecione um serviço --</option> '
								+'<option value="consultas">Consulta</option>'
								+'<option value="estomatologia">Estomatologia</option>'
								+'</select>'
								+'</div>'
								+'<div class="form-input col-md-2">'
								+'<select onchange="mudaPreco'+counter+'();" required="required" id="tipo_servicos'+counter+'" name="tipo_servicos[]" class="form-control" style="font-size: 14px;">'
								+'<option value="" selected="selected">-- Tipo de serviço --</option>'
								+'</select>'
								+'</div>'
								+'<div class="form-input col-md-2"  >'
								+'<input class="precos" readonly="readonly" style="font-size: 28px;" id="preco'+counter+'" type="text"  >'
								+'</div>'
								+'<div class="form-input col-md-1">'
								+'<label style="font-size: 20px; position: relative; top: 8px; right: 26px">kz</label>'
								+'</div>'
								+'</div>'
								);
						});
					});		 	
				</script>
	        	<script type="text/javascript">

					/*	-	-	-	-	-	Mudança de preços	-	-	*/
					function calcularTotal() {
									var inputs = document.getElementsByClassName('precos');
								    total  = document.getElementById('total');
								    preco = document.getElementById('preco');
									 for (var i=0; i < inputs.length; i++) {
									        var add = parseFloat(preco.value);
								        	
									        total.value = parseFloat(total.value) + add; 
								}
					}
					function calcularTotal1() {									
								var total  = document.getElementById('total');
								var preco = document.getElementById('preco');
								var preco1 = document.getElementById('preco1');
								total.value = parseFloat(preco.value) + parseFloat(preco1.value); 
					}
					function calcularTotal2() {									
								var total  = document.getElementById('total');
								var preco = document.getElementById('preco');
								var preco1 = document.getElementById('preco1');
								var preco2 = document.getElementById('preco2');
								total.value = 
									parseFloat(preco.value) + 
									parseFloat(preco1.value) +
									parseFloat(preco2.value)
									; 
					}
					function calcularTotal3() {									
								var total  = document.getElementById('total');
								var preco = document.getElementById('preco');
								var preco1 = document.getElementById('preco1');
								var preco2 = document.getElementById('preco2');
								var preco3 = document.getElementById('preco3');
								total.value = 
									parseFloat(preco.value) + 
									parseFloat(preco1.value) +
									parseFloat(preco2.value) +
									parseFloat(preco3.value) 
									; 
					}
					function calcularTotal4() {									
								var total  = document.getElementById('total');
								var preco = document.getElementById('preco');
								var preco1 = document.getElementById('preco1');
								var preco2 = document.getElementById('preco2');
								var preco3 = document.getElementById('preco3');
								var preco4 = document.getElementById('preco4');
								total.value = 
									parseFloat(preco.value) + 
									parseFloat(preco1.value) +
									parseFloat(preco2.value) +
									parseFloat(preco3.value) +
									parseFloat(preco4.value) 
									; 
					}
					function calcularTotal5() {									
								var total  = document.getElementById('total');
								var preco = document.getElementById('preco');
								var preco1 = document.getElementById('preco1');
								var preco2 = document.getElementById('preco2');
								var preco3 = document.getElementById('preco3');
								var preco4 = document.getElementById('preco4');
								var preco5 = document.getElementById('preco5');
								total.value = 
									parseFloat(preco.value) + 
									parseFloat(preco1.value) +
									parseFloat(preco2.value) +
									parseFloat(preco3.value) +
									parseFloat(preco4.value) +
									parseFloat(preco5.value) 
									; 
					}
					function calcularTotal6() {									
								var total  = document.getElementById('total');
								var preco = document.getElementById('preco');
								var preco1 = document.getElementById('preco1');
								var preco2 = document.getElementById('preco2');
								var preco3 = document.getElementById('preco3');
								var preco4 = document.getElementById('preco4');
								var preco5 = document.getElementById('preco5');
								var preco6 = document.getElementById('preco6');
								total.value = 
									parseFloat(preco.value) + 
									parseFloat(preco1.value) +
									parseFloat(preco2.value) +
									parseFloat(preco3.value) +
									parseFloat(preco4.value) +
									parseFloat(preco5.value) +
									parseFloat(preco6.value) 
									; 
					}
					function mudaPreco () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos').value + 
							"&servicos="+ 
							document.getElementById('servicos').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco").value = xmlhttp.responseText;

						calcularTotal();
					}

					function mudaPreco1 () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos1').value + 
							"&servicos="+ 
							document.getElementById('servicos1').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco1").value = xmlhttp.responseText;
						calcularTotal1();
					}

					function mudaPreco2 () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos2').value + 
							"&servicos="+ 
							document.getElementById('servicos2').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco2").value = xmlhttp.responseText;
						calcularTotal2();
					}

					function mudaPreco3 () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos3').value + 
							"&servicos="+ 
							document.getElementById('servicos3').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco3").value = xmlhttp.responseText;
						calcularTotal3();
					}

					function mudaPreco4 () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos4').value + 
							"&servicos="+ 
							document.getElementById('servicos4').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco4").value = xmlhttp.responseText;
						calcularTotal4();
					}

					function mudaPreco5 () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos5').value + 
							"&servicos="+ 
							document.getElementById('servicos5').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco5").value = xmlhttp.responseText;
						calcularTotal5();
					}

					function mudaPreco6 () {

						var xmlhttp = new XMLHttpRequest();

						xmlhttp.open(
							"GET", 
							"ajaxPreco.php?tipo_servicos=" + 
							document.getElementById('tipo_servicos6').value + 
							"&servicos="+ 
							document.getElementById('servicos6').value, false);

						xmlhttp.send(null);
						//alert(xmlhttp.responseText);
						document.getElementById("preco6").value = xmlhttp.responseText;
						calcularTotal6();
					}

					/*	-	-	-	-	-	-	-	-	- Mudancas de serviço	-	-	-	-	-	-	-	-	-	-	-	-	-	*/
						function mudaServico() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos').value, false);

							xmlhttp.send(null);
							document.getElementById("preco").value = '';

							document.getElementById("tipo_servicos").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;

						}				

							function mudaServico1() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos1').value, false);

							xmlhttp.send(null);
							document.getElementById("preco1").value = '';

							document.getElementById("tipo_servicos1").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;
						}				

							function mudaServico2() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos2').value, false);

							xmlhttp.send(null);
							document.getElementById("preco2").value = '';

							document.getElementById("tipo_servicos2").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;
						}				

							function mudaServico3() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos3').value, false);

							xmlhttp.send(null);
							document.getElementById("preco3").value = '';

							document.getElementById("tipo_servicos3").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;
						}				

							function mudaServico4() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos4').value, false);

							xmlhttp.send(null);
							document.getElementById("preco4").value = '';

							document.getElementById("tipo_servicos4").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;
						}				

							function mudaServico5() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos5').value, false);

							xmlhttp.send(null);
							document.getElementById("preco5").value = '';

							document.getElementById("tipo_servicos5").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;
						}				

							function mudaServico6() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos6').value, false);

							xmlhttp.send(null);
							document.getElementById("preco6").value = '';

							document.getElementById("tipo_servicos6").innerHTML = xmlhttp.responseText;
							document.getElementById("total").value = 0;
						}

						function mudaMedico() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajaxMedico.php?diaDaSemana="+document.getElementById('diaDaSemana').value+"&especialidade=" + document.getElementById('especialidade').value, false);

							xmlhttp.send(null);
							//document.getElementById("medico").value = '';

							document.getElementById("medico").innerHTML = xmlhttp.responseText;
						}		


						function mudaMedicoSemana() {

							var xmlhttp = new XMLHttpRequest();
								xmlhttp.open("GET", "ajaxMedicoSemana.php?diaDaSemana=" + document.getElementById('diaDaSemana').value, false);

							xmlhttp.send(null);
							//document.getElementById("medico").value = '';

							document.getElementById("medico").innerHTML = xmlhttp.responseText;
						}		
				</script>
				<button name="agendar_servico" style="background-color: #149900; color: white" class="medium btn float-left popover-button-header hidden-mobile mrg15R tooltip-button'">
					<span>Agendar</span>
					<i class="glyph-icon icon-calendar"></i> 
				</button>  <br>			
			</form>    				
				
			<?php
			die();
		}

		if ($acao == 'faturar') {
			
				
			$patient_id = $_GET['Id'];

			$q = mysqli_query($con,"SELECT * FROM tbl_paciente WHERE Id = '$patient_id' LIMIT 1");
							$n = mysqli_num_rows($q); 
							if($n<=0){
								return 0;
							} else {
								while($r = mysqli_fetch_array($q)){
									$pn = $r['nome'];
								}
							}
			?>	
			<form name='newHospital' class='form-bordered' action='pacientes.php' method='post'>
			<div class='form-row'>
				   <input type='hidden' value='<?=$patient_id; ?>' name='id_paciente' id='id_paciente' onfocus='searchVendor()'>

				<div class='form-label col-md-2'>
					<label for='nome'> 
						Nome:
					</label>
				</div>
				<div class='form-input col-md-6'>
					<input disabled type='text' value='<?=utf8_encode($pn); ?>' name='nome' id='nome' onfocus='searchVendor()'>
					<input type='hidden' value='<?=utf8_encode($pn); ?>' name='nome' id='nome' onfocus='searchVendor()'>
				</div>
			</div>

					<input type='hidden' value='AGEND000<?=$patient_id; ?>' name='n_consulta' id='n_consulta' onfocus='searchVendor()'>
			
			<div class='form-row'>
				<div class='form-label col-md-2'>
					<label for='agendado_por'>
					Agendado por:
					</label>
				</div>
				<div class='form-input col-md-6'>
					<input disabled value='<?=utf8_encode($loggedInUser->displayname); ?>' type='text' name='agendado_por' id='agendado_por' onfocus='searchVendor()'>
					<input value='<?=utf8_encode($loggedInUser->displayname); ?>' type='hidden' name='agendado_por' id='agendado_por' onfocus='searchVendor()'>
				</div>
			</div>
			<input type='hidden' value='' name='diaDaSemana' id='diaDaSemana' onfocus='searchVendor()'>
			<input type='hidden' type='time' name='hora' id='hora' onfocus='searchVendor()'>
			<input type='hidden' min='<?=date('Y-m-d');?>' required='required' type='date' name='data' id='data' onfocus='searchVendor()'>
			<input type='hidden' value='' name='diaDaSemana' id='diaDaSemana' onfocus='searchVendor()'>
			<input type='hidden' value='' name='especialidade' id='especialidade' onfocus='searchVendor()'>
			<input type='hidden' value='' name='profissional' id='profissional' onfocus='searchVendor()'>
			
			<div class='form-row'>
				<div class='form-label col-md-2'>
					<label for='servicos'>
						Serviços:
					</label>

				</div>
				<div class='form-input col-md-2'>
					<select required='required' onchange="mudaServico();" id='servicos' name='servicos[]' class='form-control' style="font-size: 14px;">
						<option value='' selected='selected'>-- Selecione um serviço --</option> 
						<option value="gerais">Gerais</option>
						<option value="exames">Exames</option>
						<option value="estomatologia">Estomatologia</option>
					</select>
				</div>

				<div class='form-input col-md-2'>
					<select onchange="mudaPreco();" required='required' id='tipo_servicos' name='tipo_servicos[]' class='form-control' style="font-size: 14px;">
						<option value='' selected='selected'>-- Tipo de serviço --</option> 
					</select>
				</div>
				<div class='form-input col-md-2'  >
					<input readonly="readonly" style="font-size: 28px;" id='preco' type='text'  >
				</div>		
				<div class='form-input col-md-1'>
					<label style="font-size: 20px; position: relative; top: 8px; right: 26px">kz</label>
				</div>				
			</div>
			<div class='row'>
				<div id='container'>																		            		
				</div>						            		
			</div>

			<div class='form-row'>
				<div class='form-label col-md-2'>
					<label for='servicos'>
						Total:
					</label>

				</div>
				<div class='form-input col-md-2'>
				</div>				
				<div class='form-input col-md-2'>
				</div>				
				<div class='form-input col-md-2'>
					<input class="precos" readonly="readonly" value = "0" style="font-size: 28px; color:#149900;" id='total' name="total" type='text'  >
				</div>				
				<div class='form-input col-md-1'>
					<label style="font-size: 20px; position: relative; top: 8px; right: 26px">kz</label>
				</div>				
			</div>
			<br>
			<div>
					<p id='add_field' style="cursor: pointer; color: #fff; background-color:#149900; width: 3%;" class='medium btn small'>
							<span class='button-content' style="font-size: 22px;">+</span>
					</p>
				</div><br>
			
			<script type="text/javascript">
				var counter = 0;
				$(function(){
					$('p#add_field').click(function(){
						counter += 1;
						$('#container').append(
							'<div class="form-row">'
							+ '<div class="form-label col-md-2" style="border-right: 0px;">'
							+ '<label for="servicos">'
							+ '</label>'
							+ '</div>'
							+ '<div class="form-input col-md-2">'
							+ '<select required="required" onchange="mudaServico'+counter+'();" id="servicos'+counter+'" name="servicos[]" class="form-control" style="font-size: 14px;">'
							+'<option value="" selected="selected">-- Selecione um serviço --</option> '
							+'<option value="gerais">Gerais</option>'
							+'<option value="exames">Exames</option>'
							+'<option value="estomatologia">Estomatologia</option>'
							+'</select>'
							+'</div>'
							+'<div class="form-input col-md-2">'
							+'<select onchange="mudaPreco'+counter+'();" required="required" id="tipo_servicos'+counter+'" name="tipo_servicos[]" class="form-control" style="font-size: 14px;">'
							+'<option value="" selected="selected">-- Tipo de serviço --</option>'
							+'</select>'
							+'</div>'
							+'<div class="form-input col-md-2"  >'
							+'<input class="precos" readonly="readonly" style="font-size: 28px;" id="preco'+counter+'" type="text"  >'
							+'</div>'
							+'<div class="form-input col-md-1">'
							+'<label style="font-size: 20px; position: relative; top: 8px; right: 26px">kz</label>'
							+'</div>'
							+'</div>'
							);
					});
				});		 	
			</script>
			<script type="text/javascript">

				/*	-	-	-	-	-	Mudança de preços	-	-	*/
				function calcularTotal() {
								var inputs = document.getElementsByClassName('precos');
								total  = document.getElementById('total');
								preco = document.getElementById('preco');
								 for (var i=0; i < inputs.length; i++) {
										var add = parseFloat(preco.value);
										
										total.value = parseFloat(total.value) + add; 
							}
				}
				function calcularTotal1() {									
							var total  = document.getElementById('total');
							var preco = document.getElementById('preco');
							var preco1 = document.getElementById('preco1');
							total.value = parseFloat(preco.value) + parseFloat(preco1.value); 
				}
				function calcularTotal2() {									
							var total  = document.getElementById('total');
							var preco = document.getElementById('preco');
							var preco1 = document.getElementById('preco1');
							var preco2 = document.getElementById('preco2');
							total.value = 
								parseFloat(preco.value) + 
								parseFloat(preco1.value) +
								parseFloat(preco2.value)
								; 
				}
				function calcularTotal3() {									
							var total  = document.getElementById('total');
							var preco = document.getElementById('preco');
							var preco1 = document.getElementById('preco1');
							var preco2 = document.getElementById('preco2');
							var preco3 = document.getElementById('preco3');
							total.value = 
								parseFloat(preco.value) + 
								parseFloat(preco1.value) +
								parseFloat(preco2.value) +
								parseFloat(preco3.value) 
								; 
				}
				function calcularTotal4() {									
							var total  = document.getElementById('total');
							var preco = document.getElementById('preco');
							var preco1 = document.getElementById('preco1');
							var preco2 = document.getElementById('preco2');
							var preco3 = document.getElementById('preco3');
							var preco4 = document.getElementById('preco4');
							total.value = 
								parseFloat(preco.value) + 
								parseFloat(preco1.value) +
								parseFloat(preco2.value) +
								parseFloat(preco3.value) +
								parseFloat(preco4.value) 
								; 
				}
				function calcularTotal5() {									
							var total  = document.getElementById('total');
							var preco = document.getElementById('preco');
							var preco1 = document.getElementById('preco1');
							var preco2 = document.getElementById('preco2');
							var preco3 = document.getElementById('preco3');
							var preco4 = document.getElementById('preco4');
							var preco5 = document.getElementById('preco5');
							total.value = 
								parseFloat(preco.value) + 
								parseFloat(preco1.value) +
								parseFloat(preco2.value) +
								parseFloat(preco3.value) +
								parseFloat(preco4.value) +
								parseFloat(preco5.value) 
								; 
				}
				function calcularTotal6() {									
							var total  = document.getElementById('total');
							var preco = document.getElementById('preco');
							var preco1 = document.getElementById('preco1');
							var preco2 = document.getElementById('preco2');
							var preco3 = document.getElementById('preco3');
							var preco4 = document.getElementById('preco4');
							var preco5 = document.getElementById('preco5');
							var preco6 = document.getElementById('preco6');
							total.value = 
								parseFloat(preco.value) + 
								parseFloat(preco1.value) +
								parseFloat(preco2.value) +
								parseFloat(preco3.value) +
								parseFloat(preco4.value) +
								parseFloat(preco5.value) +
								parseFloat(preco6.value) 
								; 
				}
				function mudaPreco () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos').value + 
						"&servicos="+ 
						document.getElementById('servicos').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco").value = xmlhttp.responseText;

					calcularTotal();
				}

				function mudaPreco1 () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos1').value + 
						"&servicos="+ 
						document.getElementById('servicos1').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco1").value = xmlhttp.responseText;
					calcularTotal1();
				}

				function mudaPreco2 () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos2').value + 
						"&servicos="+ 
						document.getElementById('servicos2').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco2").value = xmlhttp.responseText;
					calcularTotal2();
				}

				function mudaPreco3 () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos3').value + 
						"&servicos="+ 
						document.getElementById('servicos3').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco3").value = xmlhttp.responseText;
					calcularTotal3();
				}

				function mudaPreco4 () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos4').value + 
						"&servicos="+ 
						document.getElementById('servicos4').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco4").value = xmlhttp.responseText;
					calcularTotal4();
				}

				function mudaPreco5 () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos5').value + 
						"&servicos="+ 
						document.getElementById('servicos5').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco5").value = xmlhttp.responseText;
					calcularTotal5();
				}

				function mudaPreco6 () {

					var xmlhttp = new XMLHttpRequest();

					xmlhttp.open(
						"GET", 
						"ajaxPreco.php?tipo_servicos=" + 
						document.getElementById('tipo_servicos6').value + 
						"&servicos="+ 
						document.getElementById('servicos6').value, false);

					xmlhttp.send(null);
					//alert(xmlhttp.responseText);
					document.getElementById("preco6").value = xmlhttp.responseText;
					calcularTotal6();
				}

				/*	-	-	-	-	-	-	-	-	- Mudancas de serviço	-	-	-	-	-	-	-	-	-	-	-	-	-	*/
					function mudaServico() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos').value, false);

						xmlhttp.send(null);
						document.getElementById("preco").value = '';

						document.getElementById("tipo_servicos").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;

					}				

						function mudaServico1() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos1').value, false);

						xmlhttp.send(null);
						document.getElementById("preco1").value = '';

						document.getElementById("tipo_servicos1").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;
					}				

						function mudaServico2() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos2').value, false);

						xmlhttp.send(null);
						document.getElementById("preco2").value = '';

						document.getElementById("tipo_servicos2").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;
					}				

						function mudaServico3() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos3').value, false);

						xmlhttp.send(null);
						document.getElementById("preco3").value = '';

						document.getElementById("tipo_servicos3").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;
					}				

						function mudaServico4() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos4').value, false);

						xmlhttp.send(null);
						document.getElementById("preco4").value = '';

						document.getElementById("tipo_servicos4").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;
					}				

						function mudaServico5() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos5').value, false);

						xmlhttp.send(null);
						document.getElementById("preco5").value = '';

						document.getElementById("tipo_servicos5").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;
					}				

						function mudaServico6() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajax.php?servicos=" + document.getElementById('servicos6').value, false);

						xmlhttp.send(null);
						document.getElementById("preco6").value = '';

						document.getElementById("tipo_servicos6").innerHTML = xmlhttp.responseText;
						document.getElementById("total").value = 0;
					}

					function mudaMedico() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajaxMedico.php?diaDaSemana="+document.getElementById('diaDaSemana').value+"&especialidade=" + document.getElementById('especialidade').value, false);

						xmlhttp.send(null);
						//document.getElementById("medico").value = '';

						document.getElementById("medico").innerHTML = xmlhttp.responseText;
					}		


					function mudaMedicoSemana() {

						var xmlhttp = new XMLHttpRequest();
							xmlhttp.open("GET", "ajaxMedicoSemana.php?diaDaSemana=" + document.getElementById('diaDaSemana').value, false);

						xmlhttp.send(null);
						//document.getElementById("medico").value = '';

						document.getElementById("medico").innerHTML = xmlhttp.responseText;
					}		
			</script>
			<button name="faturar_servico" style="background-color: #149900; color: white" class="medium btn float-left popover-button-header hidden-mobile mrg15R tooltip-button'">
				<span>Enviar para Faturar</span>
				<i class="glyph-icon icon-calendar"></i> 
			</button>  <br>			
		</form>    				
			
		<?php
		die();
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_paciente WHERE Id = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2>
			<a href='pacientes.php' type='button' style='float:center; padding: 10px; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
			    <span class='button-content'>Voltar</span>
			    <i class='glyph-icon icon-arrow-left'></i>
			</a><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='$Id'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome Completo:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' required='required' value='".$row['nome']."' name='nome' id='nome' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='data_nasc'>
			                        Data de Nascimento:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input max='".date('Y-m-d')."' required='required' type='text' value='".$row['data_nasc']."' min='0' name='data_nasc' id='data_nasc' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='genero'>
			                        Gênero:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select required='required' id='genero' name='genero'class='form-control'>
			                            <option value='".$row['genero']."' selected='selected'>".$row['genero']."</option>                          
			                            <option value='Masculino'>Masculino</option>'                            
			                            <option value='Femenino'>Femenino</option>'                            
			                    </select>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='endereco'>
			                        *Endereço:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['endereco']."' name='endereco' id='endereco' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['telefone']."' name='telefone' id='telefone' onfocus='searchVendor()'>
			                </div>
			            </div>		            


			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='tipo_id'>
			                        Tipo de ID:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select id='tipo_id' name='tipo_id'class='form-control' onChange='changetextbox();'>
			                            <option value='".$row['tipo_id']."' selected='selected'>".$row['tipo_id']."</option>                          
			                            <option value='Não Aplicavel'>Não Aplicavel</option>'                            
			                            <option value='Bilhete'>Bilhete</option>'                            
			                            <option value='Cédula'>Cédula</option>'                            
			                            <option value='Passaporte'>Passaporte</option>'    
			                    </select>                        
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='n_identificacao'>
			                        Nº de Identificação:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input value='".$row['n_identificacao']."' type='text' name='n_identificacao' id='n_identificacao' onfocus='searchVendor()'>
			                </div>
			            </div>	           

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='provincia'>
			                        Naturalidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['provincia']."' name='provincia' id='provincia' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome_parente'>
			                        Nome do parente:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['nome_parente']."' name='nome_parente' id='nome_parente' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone_parente'>
			                        Telefone do parente:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['telefone_parente']."' name='telefone_parente' id='telefone_parente' onfocus='searchVendor()'>
			                </div>
			            </div>
			<br>
			<button style='background-color: #149900;' class='btn primary-bg medium' name='editarr'>
			    <span class='button-content'>Editar</span>
			    <i class='glyph-icon icon-save'></i>
			</button>
			</form>         
			";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_paciente WHERE Id = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'>
			<h2>Informações Pessoais</h2><br>
							<a href='pacientes.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
				<a href='pacientes.php?Id=".$_GET['Id']."&acao=editar ' style='float:center, font-size:20px; background-color: #149900; color: #fff;' class='btn small'  title='Editar'>
					<span class='button-content'>Editar</span>
					<i class='glyph-icon icon-edit'></i>&nbsp;
				</a>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='processo'>
			                        Nº de processo:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[0]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Data de Nascimento'>
			                       Data de Nascimento :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Gênero'>
			                       Gênero:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Endereço'>
			                      Endereço
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[5]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Tipo de Id'>
			                      Tipo de Id
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[7]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº de Id'>
			                      Nº de Id
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[8]</h4>
			                </div>
			            </div>						

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nome do Parente'>
			                      Nome do Parente
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[9]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Telefone do Parente'>
			                      Telefone do Parente
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[10]</h4>
			                </div>
						</div>
						
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Província'>
			                      Naturalidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[11]</h4>
			                </div>
			            </div>

			</form>
			"; die();
		    		}		
		}
		if (isset($_POST['add'])) 
		{
		$nome=$_POST['nome']; 
		$data_nasc=$_POST['data_nasc']; 
		$genero=$_POST["genero"];
		$telefone=$_POST['telefone'];
		$tipo_id=$_POST['tipo_id'];
		if (isset($_POST['n_identificacao'])) {	$n_identificacao=$_POST['n_identificacao']; } else { $n_identificacao=''; }
		
		$endereco=$_POST['endereco'];
		$provincia=$_POST['provincia'];
		$nome_parente=$_POST['nome_parente'];
		$telefone_parente=$_POST['telefone_parente'];
	    $data = date('Y-m-d H:i:s');

		    if (empty($nome) || empty($data_nasc) || empty($genero) || empty($endereco) ) {
		        echo "
		                <div class='row'>
		                    <div class='col-md-6'>
		                        <div class='infobox error-bg mrg0A'>
		                            <p>Preencha todos os campos marcados com (*). São obrigatórios.</p>
		                        </div>
		                    </div>
		                </div>
		            ";
		    }else{ 
		    	$con=connection();
				$query="
				INSERT INTO tbl_paciente 
				(
					nome,
					data_nasc,
					genero,
					endereco,
					telefone,
					tipo_id,
					n_identificacao,
					nome_parente,
					telefone_parente,
					provincia,
					pagou,
					pagou_estomatologia,
					pagou_exames,
					pagou_sgerais,
					triado,
					agendado,
					atendido_medico,
					data
				)
				VALUES (
					'$nome',
					'$data_nasc',
					'$genero',
					'$endereco',
					'$telefone',
					'$tipo_id',
					'$n_identificacao',
					'$nome_parente',
					'$telefone_parente',
					'$provincia',	
					0,
					0,
					0,
					0,
					0,
					0,
					0,
					'$data')";
					mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
					$a = mysqli_query($con,$query) ? true : false ;
				    if($a){
				        echo "<script>swal('Paciente cadastrado com sucesso','','success');</script>";
				    }         
				    else echo "<script>swal('Opps! Ocorreu um erro ao cadastrar o paciente','','error');</script>";
		    }
	}	

	if (isset($_POST['editarr'])) {
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
			$data_nasc=$_POST['data_nasc']; 
			$genero=$_POST["genero"];
			$telefone=$_POST['telefone'];
			$tipo_id=$_POST['tipo_id'];
			$n_identificacao=$_POST['n_identificacao'];
			$endereco=$_POST['endereco'];
			$provincia=$_POST['provincia'];
			$nome_parente=$_POST['nome_parente'];
			$telefone_parente=$_POST['telefone_parente'];
		    $data = date('Y-m-d H:i:s');

		    if (empty($nome) || empty($data_nasc) || empty($genero)) {
		        echo "
		                <div class='row'>
		                    <div class='col-md-6'>
		                        <div class='infobox error-bg mrg0A'>
		                            <p>Preencha todos os campos.</p>
		                        </div>
		                    </div>
		                </div>
		            ";
		    }else{
		    	$con=connection();				    
				    $query = "UPDATE tbl_paciente SET 
					nome='$nome', 
					data_nasc='$data_nasc',
					genero='$genero',
					telefone='$telefone',
					tipo_id='$tipo_id',
					n_identificacao='$n_identificacao',
					endereco='$endereco',
					provincia='$provincia',
					nome_parente='$nome_parente',
					telefone_parente='$telefone_parente', 
					data='$data' WHERE Id = '$id'";
					
				    $a=mysqli_query($con,$query) ? true : false ;
				    if($a){
							echo "<script>swal('Paciente atualizado com sucesso','','success');</script>";
				            }
				    else echo "<script>swal('Ocorreu um erro ao atualiazar o paciente','','error');</script>";
				    }
	}

	if (isset($_POST['add_novo_paciente'])) {
	echo "
	<h2>Informações Iniciais</h2>
							<a href='pacientes.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
	<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='nome'>
	                        *Nome Completo:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='text' required='required' name='nome' id='nome' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='data_nasc'>
	                        *Data de Nascimento:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input max='".date('Y-m-d')."' type='date' required='required' name='data_nasc' id='data_nasc' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='genero'>
	                        *Gênero:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <select id='genero' name='genero'class='form-control' required='required'>
	                            <option value=''selected='selected'>-- Selecione --</option>                          
	                            <option value='Masculino'>Masculino</option>'                            
	                            <option value='Femenino'>Femenino</option>'                            
	                    </select>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='endereco'>
	                        *Endereço:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input required='required' type='text' name='endereco' id='endereco' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='telefone'>
	                        Telefone:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='text' name='telefone' id='telefone' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <h2>Informações Complementares</h2><br>



	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='tipo_id'>
	                        Tipo de ID:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <select id='tipo_id' name='tipo_id' class='form-control' onChange='changetextbox();'>
	                            <option value=''selected='selected'>-- Selecione --</option>                          
	                            <option value='Não Aplicavel'>Não Aplicavel</option>'                            
	                            <option value='Bilhete'>Bilhete</option>'                            
	                            <option value='Cédula'>Cédula</option>'                            
	                            <option value='Passaporte'>Passaporte</option>'    
	                    </select>                        
	                </div>
				</div>
				

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='n_identificacao'>
	                        Nº de Identificação:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='text' min='0' max='14' name='n_identificacao' id='n_identificacao' onfocus='searchVendor()'>
	                </div>
	            </div>	  
 

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='provincia'>
	                        Naturalidade:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input required='required' type='text' name='provincia' id='provincia' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='nome_parente'>
	                        Nome do Parente:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='text' name='nome_parente' id='nome_parente' onfocus='searchVendor()'>
	                </div>
	            </div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='telefone_parente'>
	                        Telefone do Parente:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='text' name='telefone_parente' id='telefone_parente' onfocus='searchVendor()'>
	                </div>
	            </div>
	<br>

	<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='add'>
	    <span class='button-content'>Salvar</span>
	    <i class='glyph-icon icon-save'></i>
	</button><br><br>
	
	</form>         
	";
	}else{
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nº Processo</th>
			<th>&nbsp;&nbsp;&nbsp;Nome Completo</th>
			<th>Idade</th>
			<th>&nbsp;&nbsp;&nbsp;Gênero</th>
			<th>&nbsp;&nbsp;&nbsp;Telefone</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade, genero, telefone FROM tbl_paciente WHERE agendado=0 LIMIT 0, 100";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['Id']."</td>
			<td>
				<a href='pacientes.php?Id=".$row['Id']."&acao=ver '>".utf8_encode($row['nome'])."</a>
			</td>
			<td>".$row['idade']."</td>
			<td>".$row['genero']."</td>
			<td>".$row['telefone']."</td>
			<td>
			<form method='get' action='pacientes.php'>
			";
			if($loggedInUser->title == 'admin') {
				echo "
				<a href='pacientes.php?Id=".$row['Id']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
				</a>";
				}
				echo "
			    <a href='pacientes.php?Id=".$row['Id']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
				<a href='pacientes.php?Id=".$row['Id']."&acao=agendar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Agendar'>
			        <i class='glyph-icon icon-calendar'></i>
			    </a>

				<a href='pacientes.php?Id=".$row['Id']."&acao=faturar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Faturar'>
			        <i class='glyph-icon icon-money'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='pacientes.php'>
	    <a title='Novo Paciente' href='pacientes.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_paciente' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Novo Paciente
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>


	    <script type="text/javascript">
			function changetextbox()
			{
			    if (document.getElementById("tipo_id").value != "Não Aplicavel") {
			        document.getElementById("n_identificacao").disabled='';
				} else {
				    document.getElementById("n_identificacao").disabled='true';
				}
			}
		</script>