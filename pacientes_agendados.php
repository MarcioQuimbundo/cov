	<?php
	require_once("models/config.php");
	if (!securePage($_SERVER['PHP_SELF'])){die();}
	require_once("models/header.php");
	include('library.php');
	echo "
	<body> 
		<div id='loading' class='ui-front loader ui-widget-overlay bg-white opacity-100'>
			<img src='assets/images/loader-dark.gif' alt='' >
		</div>
		<div id='page-wrapper' class='demo-example'>";
	include('models/topbar.php');
	include("models/sidebar.php");
	echo "
		<div id='page-content-wrapper'>
			<div id='page-title' style='margin-bottom:18px;'>
			<h3>Pacientes agendados</h3>
		</div>
		<div id='g10' class='small-gauge float-left hidden'></div>
		<div id='g11' class='small-gauge float-right hidden'></div>
		<div id='page-content' style='margin-top:-18px;'>"; 
		
	if (isset($_POST['reagendar_servico'])){
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
					
					if (empty($id_medico) || empty($n_consulta) || empty($data) || empty($id_medico) || empty($tipo_servicos)) {
				        echo "
				                            <script>swal('Paciente não foi reagendado, preencha todos os campos!');</script>
				            ";
					}else{
						$query="
							UPDATE 
							tbl_agenda SET 
							id_medico = '$id_medico',
							user_id = '$user_id',
							n_consulta = '$n_consulta',
							hora = '$hora',
							data = '$data',
							servicos = '$servicos',
							tipo_servicos = '$tipo_servicos',
							data_agenda = '$data_agenda'
							WHERE id_paciente = '$id_paciente'";
							//var_dump($query);
						$result=mysqli_query($con,$query);

						//var_dump($result);
						if($result){

							mysqli_query($con,"UPDATE tbl_paciente SET agendado=1 WHERE Id = '$id_paciente'");
					    	echo "<script>swal('Paciente reagendado com sucesso!','','success');</script>";
						}
					}
					//echo "<script>alert('Agenda');</script>";
				}

	if(isset($_GET['Id']))
	{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();

		if ($acao == 'reagendar') {
				
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
				<a href='lista_funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
					<span class='button-content'>Voltar</span>
					<i class='glyph-icon icon-arrow-left'></i>
				</a><br>			<br>

				<a href='pacientes_agendados.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
					<span class='button-content'>Voltar</span>
					<i class='glyph-icon icon-arrow-left'></i>
				</a><br>			<br>
	           		<input type='hidden' value='<?=$patient_id; ?>' name='id_paciente' id='id_paciente' onfocus='searchVendor()'>

	                <div class='form-label col-md-2'>
	                    <label for='nome'> 
	                        Nome:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input disabled type='text' value='<?=$pn; ?>' name='nome' id='nome' onfocus='searchVendor()'>
	                    <input type='hidden' value='<?=$pn; ?>' name='nome' id='nome' onfocus='searchVendor()'>
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
	    	         		<option value='Terça-Feira' >Terça-Feira</option>
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
	                    <input min='<?=date('Y-m-d');?>' required='required' type='date' name='data' id='data' onfocus='searchVendor()'>
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
							<option value="exames">Exames</option>
							<option value="gerais">Gerais</option>
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
								+'<option value="exames">Exames</option>'
								+'<option value="gerais">Gerais</option>'
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
								+'<p id="add_field">'
								+'<a style="background-color:#ff8080; color: #fff;"class="medium btn small" href="#">'
								+'<span class="button-content" style="font-size: 30px;">-</span>'
								+'</a>'
								+'</p>'
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

		if ($acao == 'cancelar') {
			$query="DELETE FROM tbl_agenda WHERE id_paciente='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
		           	echo "<script>swal('Agenda cancelada com sucesso','','success');</script>";
		        }
			else echo "<script>swal('Ocorreu um erro ao cancelar a agenda','','error');</script>";
		}



		if ($acao == 'ver') {
			$query="
			SELECT 
				tbl_paciente.Id, 
				tbl_paciente.nome, 
				tbl_paciente.genero,
				tbl_paciente.endereco,
				tbl_paciente.telefone,
				tbl_agenda.id_medico,
				tbl_agenda.hora,
				tbl_agenda.data,
				tbl_agenda.servicos,
				tbl_agenda.tipo_servicos 
			FROM tbl_paciente 
			INNER JOIN tbl_agenda 
			ON (tbl_paciente.Id = tbl_agenda.id_paciente) 
			WHERE Id = '$Id'";
			$queryIdade="SELECT (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade FROM tbl_paciente WHERE Id = '$Id'";
			$result=mysqli_query($con,$query);
			$resultIdade=mysqli_query($con,$queryIdade);
			$row=mysqli_fetch_row($result);
			$rowIdade=mysqli_fetch_row($resultIdade);

			$resultado_nome_medico = mysqli_query($con, "SELECT display_name FROM tbl_users WHERE id = '$row[5]'");
			$linha_medico = mysqli_fetch_row($resultado_nome_medico);
			//var_dump($query); 
			echo "
			<div id='regbox'>
				<h2>Informações da agenda</h2><br>
				<a href='pacientes_agendados.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
					<span class='button-content'>Voltar</span>
					<i class='glyph-icon icon-arrow-left'></i>
				</a><br>			<br>
				
				";
					if ($loggedInUser->title == 'catalogador') {					
						echo "<a href='pacientes_agendados.php?Id=".$_GET['Id']."&acao=reagendar ' style='float:center, font-size:20px; background-color: #149900; color: #fff;' class='btn small'  title='Reagendar'>
							<span class='button-content'>Reagendar</span>
							<i class='glyph-icon icon-edit'></i>&nbsp;
						</a>";
					}
					echo"
					<a href='pacientes_agendados.php?Id=".$_GET['Id']."&acao=cancelar ' style='float:center, font-size:20px; background-color: red; color: #fff;' class='btn small'  title='Cancelar agenda'>
						<span class='button-content'>Cancelar</span>
						<i class='glyph-icon icon-remove'></i>&nbsp;
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
				                       Idade :
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$rowIdade[0]</h4>
				                </div>
				            </div>
							<div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Gênero'>
				                       Gênero:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[2]</h4>
				                </div>
				            </div>

				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Endereço'>
				                      Endereço
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[3]</h4>
				                </div>
				            </div>

							<div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Telefone'>
				                       Telefone:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[4]</h4>
				                </div>
				            </div>
				            <hr>
				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Telefone'>
				                       Médico:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$linha_medico[0]</h4>
				                </div>
				            </div>

				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Telefone'>
				                       Hora:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[6]</h4>
				                </div>
				            </div>

				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Telefone'>
				                       Data:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[7]</h4>
				                </div>
				            </div>

				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Telefone'>
				                       Serviço(os):
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[8]</h4>
				                </div>
				            </div>

				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='Telefone'>
				                       Tipo de Serviço(os):
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <h4>$row[9]</h4>
				                </div>
				            </div>
						</form>
			"; die();
		}
	}		

	echo "
	<table class='table' id='example1'>
		<thead>
			<tr>
				<th>&nbsp;&nbsp;Nome Completo</th>
				<th>Data agendada</th>
				<th>&nbsp;&nbsp;&nbsp;Hora</th>
				<th>Médico</th>
				<th>Estado</th>				
			</tr>
		</thead>
		<tbody>";
		$con=connection();
		$query="SELECT 
					tbl_paciente.Id, 
					tbl_paciente.nome, 
					tbl_agenda.data, 
					tbl_agenda.hora, 
					tbl_users.display_name, 
					(TIMESTAMPDIFF(YEAR, tbl_paciente.data_nasc, CURDATE())) AS idade,
					tbl_paciente.triado,
					tbl_paciente.atendido_medico,
					tbl_paciente.pagou FROM tbl_paciente INNER JOIN tbl_agenda ON (tbl_paciente.Id = tbl_agenda.id_paciente) INNER JOIN tbl_users ON (tbl_agenda.id_medico = tbl_users.id) WHERE agendado=1 AND atendido_medico = 0";
		$result=mysqli_query($con,$query);
		while($row=mysqli_fetch_array($result))
		{			
		echo "<tr>
				<td>
					<a href='pacientes_agendados.php?Id=".$row['Id']."&acao=ver '>".$row['nome']."</a>
				</td>
				<td>".$row['data']."</td>
				<td>".$row['hora']."</td>
				<td>".$row['display_name']."</td>
				<td>";
				
				if (($row['triado'] == 0 && ($row['idade'] < 6 || $row['idade'] > 60)))
					echo "Triagem";				
				elseif($row['pagou'] == 1 && $row['triado'] == 0 && ($row['idade'] > 6 && $row['idade'] < 60))
					echo "Triagem";
				elseif ($row['triado'] == 1 && ($row['idade'] < 6 || $row['idade'] > 60))
					echo "Médico";
				elseif ($row['pagou'] == 1 && $row['triado'] == 1 && ($row['idade'] > 6 && $row['idade'] < 60))
					echo "Médico";
				elseif ($row['pagou'] == 0 && $row['triado'] == 0 && ($row['idade'] > 6 && $row['idade'] < 60))
					echo "Caixa";
				echo "</td>
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
