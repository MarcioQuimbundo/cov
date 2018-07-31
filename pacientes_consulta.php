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
		<h3>Atendimento</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

		if (isset($_POST['finalizar_consulta'])){
			$id_paciente = $_GET['Id'];		
			$id_medico = $loggedInUser->user_id; 
		    $data = date('Y-m-d H:i:s');
			$con=connection();
			$query="INSERT INTO tbl_atendimento_medico VALUES (Null, '$id_paciente','$id_medico','consulta','$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET atendido_medico=1 WHERE Id = '$id_paciente'");
				   echo "<script>swal('Atendimento finalizado com sucesso','','success');</script>";    
				   ?>
					    <script type="text/javascript">
		           			setTimeout("location.href = 'pacientes_consulta.php';", 2500);
		                </script>
					    <?php	   
			            die();
			}         
			else echo "<script>swal('Ocorreu um erro ao finalizar a consulta','','success');</script>";
		} 

		if (isset($_POST['editar_exame_clinico'])) {
			$id_paciente = $_GET['Id'];
			$id_medico = $loggedInUser->user_id;
			$exame_clinico = $_POST['exame_clinico']; 
			$data = date('d-m-Y h:i:sa');
			$exame_clinico_total = '';
			$n = count($exame_clinico);
			for($i=0; $i < $n; $i++)
			{
				$exame_clinico_total .= ( $exame_clinico[$i] . ", ");
			}
			$con = connection();	
				$query = "UPDATE tbl_exame_clinico_consultado SET 
				id_medico	='$id_medico',
				exame_clinico	='$exame_clinico_total'
				WHERE id_paciente = '$id_paciente'";							
				$a=mysqli_query($con,$query) ? true : false ;
				if($a) echo "<script>swal('Exame clínico atualizado Com Sucesso','','success');</script>";
		    	else echo "<script>swal('Ops! Ocorreu um erro ao atualizar o exame clínico','','error');</script>";
			}
		if (isset($_POST['add_exame_clinico'])) {

			$id_paciente = $_GET['Id'];
			$id_medico = $loggedInUser->user_id;
			$exame_clinico = $_POST['exame_clinico']; 
			$data = date('d-m-Y h:i:sa');
			$exame_clinico_total = '';

			$con = connection();
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$query = "INSERT INTO tbl_exame_clinico_consultado VALUES (Null, '$id_paciente','$id_medico','$exame_clinico','$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
			    echo "<script>swal('Exame clínico adicionado com sucesso','','success');</script>";
			    		?>
					    <script type="text/javascript">
		           			setTimeout("location.href = 'pacientes_consulta.php?Id=<?=$id_paciente;?>&acao=consultar&menu=exame_clinico';", 1500);
		                </script>
					    <?php
			}              
			else { 
			echo "<script>swal('Ocorreu um erro ao adicionar o exame clínico','','error');</script>";
			} 
		}

		if (isset($_POST['add_atendimento'])) {
			$id_paciente = $_GET['Id'];
			$id_medico = $loggedInUser->user_id;
			$resumo_atendimento = $_POST['resumo_atendimento']; 
			$data = date('d-m-Y h:i:sa');
			$data_atual = date('Y')."-" . date('m') . "-" .date('d');
			$con = connection();
			$queryServico = "SELECT tbl_paciente.Id, tbl_paciente.nome, tbl_agenda.servicos FROM `tbl_agenda` 
							inner join tbl_paciente on(tbl_paciente.Id=tbl_agenda.id_paciente) 
							WHERE id_medico=$id_medico AND 
							tbl_paciente.agendado=1 AND 
							(pagou = 1 || pagou_estomatologia = 1 || pagou_exames = 1 || pagou_sgerais = 1 )  AND 
							triado=1 AND 
							tbl_agenda.data='$data_atual' AND 
							tbl_paciente.atendido_medico=0";

			$resultado = mysqli_query($con, $queryServico);

			$servico = mysqli_fetch_row($resultado);
			$servico = $servico[2];

			$query = "INSERT INTO tbl_diario_clinico VALUES (Null, '$id_paciente','$id_medico','$resumo_atendimento','$servico','$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){				
			    echo "<script>swal('Resumo do atendimento adicionado com sucesso', '', 'success');</script>";
			    ?>
			    <script type="text/javascript">
           			setTimeout("location.href = 'pacientes_consulta.php?Id=<?=$id_paciente;?>&acao=consultar&menu=diario_clinico';", 1500);
                </script>
			    <?php
			} else { 
				echo "<script>swal('Ocorreu um erro ao adicionar o resumo do atendimento.', '', 'error');</script>";
				?>
			    <script type="text/javascript">
           			setTimeout("location.href = 'pacientes_consulta.php?Id=<?=$id_paciente;?>&acao=consultar&menu=diario_clinico';", 1500);
                </script>
			    <?php
			}
		}

		if (isset($_POST['salvar_justificativo_medico'])) {
			$id_paciente 	= 	$_GET['Id'];
			$id_medico 		= 	$loggedInUser->user_id;
			$qtd_dias 		= 	$_POST['qtd_dias'];
			$cid_doenca 	= 	$_POST['cid_doenca'];  
			$data 			= 	date('Y-m-d');
			$con = connection();
			$query = "
			INSERT INTO tbl_justificativo_medico 
			VALUES (
				Null, 
				'$id_paciente',
				'$id_medico',
				'$qtd_dias',
				'$cid_doenca',
				'$data'
				)";
				mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
			    echo "<script>swal('Justificativo salvo com sucesso', '', 'success');</script>";	
			    		?>
					    <script type="text/javascript">
		           			setTimeout("location.href = 'pacientes_consulta.php?Id=<?=$id_paciente;?>&acao=consultar&menu=transferencia_justificativo';", 1500);
		                </script>
					    <?php
			}         
			else {
				echo "<script>swal('Ocorreu um erro ao salvar o Justificativo', '', 'error');</script>";      
			}
		}

		if (isset($_POST['salvar_antecedentes'])) {
			$id_paciente = $_GET['Id'];
			$id_medico = $loggedInUser->user_id;
			$transfusoes = $_POST['transfusoes']; 
			$endocrinas_metabolicas = $_POST['endocrinas_metabolicas']; 
			$acidentes = $_POST['acidentes']; 
			$tuberculose = $_POST['tuberculose']; 
			$doencas_renais_cronicas = $_POST['doencas_renais_cronicas']; 
			$alergia = $_POST['alergia']; 
			$anemia = $_POST['anemia']; 
			$cardiopatias = $_POST['cardiopatias']; 
			$diabetes = $_POST['diabetes']; 
			$etilismo = $_POST['etilismo']; 
			$tabagismo = $_POST['tabagismo']; 
			$drogas = $_POST['drogas']; 
			$dts = $_POST['dts']; 
			$cancro = $_POST['cancro']; 
			$hta = $_POST['hta']; 
			$cirurgias = $_POST['cirurgias']; 
			$osteoporose = $_POST['osteoporose']; 
			$avc = $_POST['avc']; 
			$viroses = $_POST['viroses']; 
			$data = date('Y-m-d');
			
			$con = connection();
			$query = "INSERT INTO 
					tbl_antecedentes VALUES 
					(
					Null, 
					'$id_paciente',
					'$id_medico',
					'$transfusoes',
					'$endocrinas_metabolicas',
					'$acidentes',
					'$tuberculose',
					'$doencas_renais_cronicas',
					'$alergia',
					'$anemia',
					'$cardiopatias',
					'$diabetes',
					'$etilismo',
					'$tabagismo',
					'$drogas',
					'$dts',
					'$cancro',
					'$hta',
					'$cirurgias',
					'$osteoporose',
					'$avc',
					'$viroses',
					'$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Antecedente Adicionado Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao adicionar antecedente','','error');</script>";
		}
		
		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
			$Id = sanitize($_GET['Id']);
			$con=connection();
		    if ($acao == 'consultar') {			    
		    	if(isset($_GET['menu']) AND $_GET['menu'] == 'sinais_e_dados') {
		    		$query="SELECT DISTINCT * FROM tbl_triagem WHERE id_paciente = '$Id'";
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$result=mysqli_query($con,$query);
					$resultP=mysqli_query($con,$queryP);
					
					$row=mysqli_fetch_row($result);
					$rowP=mysqli_fetch_row($resultP);
					include('medico/menu.php');
					echo"		<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
							            <h2 class='text-center'>Sinais e Dados</h2><br><hr>
						                <div class='row'>
							                <div class='form-label col-md-3'>
							                    <label style='font-size:1.4em;'>
							                        Temperatura: $row[3]ºc
							                    </label>
							                </div>

							                <div class='form-label col-md-3'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       Respiração: $row[4]
							                    </label>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Nome' style='font-size:1.4em;'>
							                        Pulso: $row[5]
							                    </label>
							                </div>
							            </div>
							            <div class='row'>
							                <div class='form-label col-md-3'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       Tensão Sistólica: $row[6]
							                    </label>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Nome' style='font-size:1.4em; width:145%;'>
							                        Tensão Diastólica: $row[7]
							                    </label>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       IMC: $row[10]
							                    </label>
							                </div>
							            </div>
							            <div class='row'>
							                <div class='form-label col-md-12'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       Observação: $row[12]
							                    </label>
							                </div>
							            </div>
						        </div>
						</form>
						</div>
						";
		    		die();
				}

				// quando clicarem no botão novas queixas e historial
				if (isset($_POST['nova_queixas_e_historial'])) {
					include('medico/menu.php');
					echo"<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Queixas e Historial</h2><br><hr>										
						</form>
							            <div class='row'>
								            <div class='form-input col-md-7' style='margin-left: 20%' >
							                	<textarea placeholder='QUEIXAS PRINCIPAIS' name='queixas_principais' class='form-control' rows='10' >
							                	</textarea>
							                </div>
						                </div>
						                <div class='row'>
								            <div class='form-input col-md-7' style='margin-left: 20%' >
							                	<textarea placeholder='HISTORIAL DA DOENÇA ACTUAL' name='historial_da_doenca_actual' class='form-control' rows='10' >
							                	</textarea>
							                </div>
						                </div>
						                <div class='row text-center'>
							                <button class='btn medium bg-blue small' name='salvar_queixas_historial' style='margin-top:10px;'>
											    <span class='button-content'>SALVAR</span>
											</button>
							                <input type='reset' value'LIMPAR TUDO' class='btn medium bg-red small' name='#' style='width: 85px; margin-top:10px;'/>
										</div>
									</div>
									";
					die();
				}

				if(isset($_GET['queixas_historial'])) {
					$queixas_historial = $_GET['queixas_historial'];
					if ($queixas_historial == 1) {
											
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Queixas e Historial</h2><br><hr>										
						</form>";
						$query = "	SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_queixas_historial.queixas as trat,
						tbl_queixas_historial.historial as rec,
						tbl_queixas_historial.data_criada as data
						FROM `tbl_queixas_historial` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_queixas_historial.id_paciente) 
						inner join tbl_medico 
						on(tbl_queixas_historial.id_medico=tbl_medico.id_medico) WHERE tbl_queixas_historial.id_paciente = ".$_GET['Id']."";
							
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);

						echo "
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[0]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Queixas :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Historial :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
									<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='Data de Nascimento'>
											Data :
										</label>
									</div>
									<div class='form-input col-md-6'>
										<h4>$rowP[4]</h4>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}elseif ($queixas_historial == 2) {
						
						
					include('medico/menu.php');
		    		echo"
						<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
							<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
								<h2 class='text-center'>Queixas e Historial</h2><br><hr>										
						</form>";
						$query = "	SELECT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_queixas_historial.queixas as trat,
						tbl_queixas_historial.historial as rec,
						tbl_queixas_historial.data_criada as data
						FROM `tbl_queixas_historial` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_queixas_historial.id_paciente) 
						inner join tbl_medico 
						on(tbl_queixas_historial.id_medico=tbl_medico.id_medico) WHERE tbl_queixas_historial.id_paciente = $Id";
							
					$resultP=mysqli_query($con,$query);

					$rowP=mysqli_fetch_row($resultP);

					
						echo"
						<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>
								<input type='hidden' name='Id' value='$Id'>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='paciente'>
											Paciente:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input type='text' required='required' readonly value='".$rowP[0]."' name='paciente' id='nome' onfocus='searchVendor()'>
									</div>
								</div>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='medico'>
											Médico:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input required='required' type='text' readonly value='".$rowP[1]."' name='medico' id='medico' onfocus='searchVendor()'>
									</div>
								</div>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='tipo_id'>
											Queixas:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input type='tipo_id' value='".$rowP[2]."' name='queixas' id='queixas' onfocus='searchVendor()'>
									</div>
								</div>
									
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='Historial'>
										Historial:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input type='text' value='".$rowP[3]."' name='historial' id='historial' onfocus='searchVendor()'>
									</div>
								</div>
						<br>
						<button class='btn primary-bg medium' name='editar_queixas_historial'>
							<span class='button-content'>Editar</span>
							<i class='glyph-icon icon-save'></i>
						</button>
						</form>         
						</div>
						";
		    		die();
					}
					die();
				}
				if (isset($_POST['editar_queixas_historial'])) {
					$id = $_GET['Id'];
					$id_medico = $loggedInUser->user_id;
					$queixas = $_POST['queixas'];
					$historial = $_POST['historial'];

					if (empty($queixas)|| empty($historial)) {
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
						$query = "UPDATE tbl_queixas_historial SET 
						id_medico='$id_medico',
						queixas='$queixas',
						historial='$historial'
						WHERE id_paciente = '$id'";							
						$a=mysqli_query($con,$query) ? true : false ;
						if($a){
								echo "<script>alert('Queixas e historial actualizado com sucesso');</script>";
						}
						else echo "	
									<div class='row'>
										<div class='col-md-6'>
											<div class='infobox error-bg mrg0A'>
												<p>Ocorreu um erro, o queixas e historial não foi actualizado na base de dados.</p>
											</div>
										</div>
									</div>
								";
						}
				}
				if (isset($_POST['editar_transferencia_justificativo'])) {
					$id_paciente 	= 	$_GET['Id'];
					$id_medico 		= 	$loggedInUser->user_id;
					$qtd_dias 		= 	$_POST['qtd_dias'];
					$cid_doenca 	= 	$_POST['cid_doenca'];  
					$data 			= 	date('Y-m-d');
					
						$con = connection();

						$con=connection();				    
						$query = "UPDATE tbl_justificativo_medico SET 
						id_medico	='$id_medico',
						qtd_dias 		= 	'$qtd_dias',
						cid_doenca 	= 	'$cid_doenca'
						WHERE id_paciente = '$id_paciente'";

						$a=mysqli_query($con,$query) ? true : false ;
						if($a) echo "<script>swal('Justificativo Atualizado Com Sucesso','','success');</script>";
		    			else echo "<script>swal('Ops! Ocorreu um erro ao atualizar o justificativo','','error');</script>";
				}	if (isset($_POST['editar_trat_rec'])) {
					$id_paciente 	= 	$_GET['Id'];
					$id_medico 		= 	$loggedInUser->user_id;
					$tratamentos=$_POST['tratamentos'];
					$recomendacoes=$_POST['recomendacoes'];
					$data 			= 	date('Y-m-d');
					$con=connection();				    
						$query = "UPDATE tbl_tratamentos_recomendacoes SET 
						id_medico	='$id_medico',
						tratamentos 		= 	'$tratamentos',
						recomendacoes 	= 	'$recomendacoes'
						WHERE id_paciente = '$id_paciente'";

						$a=mysqli_query($con,$query) ? true : false ;
						if($a) echo "<script>swal('Tratamentos e Recomendações Atualizado Com Sucesso','','success');</script>";
		    			else echo "<script>swal('Ops! Ocorreu um erro ao atualizar o tratamentos','','error');</script>";
				}
		    	if(isset($_POST['queixas_e_historial'])) {
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
							            <h2 class='text-center'>Queixas e Historial</h2><br><hr>";
							            $queryT = "SELECT id_paciente FROM tbl_queixas_historial WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0) 
								            	echo "	";
											else
							            echo"
							            <div class='row'>
								            <div class='form-input col-md-7' style='margin-left: 20%' >
							                	<textarea placeholder='QUEIXAS PRINCIPAIS' name='queixas_principais' class='form-control' rows='10' ></textarea>
							                </div>
						                </div>
						                <div class='row'>
								            <div class='form-input col-md-7' style='margin-left: 20%' >
							                	<textarea placeholder='HISTORIAL DA DOENÇA ACTUAL' name='historial_da_doenca_actual' class='form-control' rows='10' ></textarea>
							                </div>
						                </div>
						                <div class='row text-center'>
							                <button class='btn medium bg-blue small' name='salvar_queixas_historial' style='margin-top:10px;'>
											    <span class='button-content'>SALVAR</span>
											</button>
							                <input type='reset' value'LIMPAR TUDO' class='btn medium bg-red small' name='#' style='width: 85px; margin-top:10px;'/>
										</div>
									</div>
									";

									$queryT = "SELECT DISTINCT id_paciente FROM tbl_queixas_historial WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0){
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Paciente</th>
												<th>Médico</th>
												<th>Queixas</th>
												<th>Historial</th>
												<th>Data</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT DISTINCT
													tbl_paciente.Id as id_paciente, 
													tbl_paciente.nome as nome_paciente, 
													tbl_medico.nome as nome_medico,
													tbl_queixas_historial.queixas as trat,
													tbl_queixas_historial.historial as rec,
													tbl_queixas_historial.data_criada as data
													FROM `tbl_queixas_historial` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_queixas_historial.id_paciente) 
													inner join tbl_medico 
													on(tbl_queixas_historial.id_medico=tbl_medico.id_medico) WHERE tbl_queixas_historial.id_paciente = $Id";
										
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>".$row['nome_paciente']."</td>
												<td>".$row['nome_medico']."</td>
												<td>".$row['trat']."</td>
												<td>".$row['rec']."</td>
												<td>".$row['data']."</td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&queixas_historial=1' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
												        <i class='glyph-icon icon-eye'></i>
												    </a>
													<!--<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&queixas_historial=2' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
												        <i class='glyph-icon icon-edit'></i>
												    </a>-->
												</form>
												</td>
											</tr>";}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='nova_queixas_e_historial'>
									    <span class='button-content'>
									    	Cadastrar
									    </span>
									    <i class='glyph-icon icon-save'></i>
									</button>";
								}

									echo"
						</form>							
						</div>
						";
		    		die();
				}
				if (isset($_POST['novos_antecedentes'])) {
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Antecedentes</h2><br><hr>										
						</form>";
					echo"						            
								      	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Transfusões :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='transfusoes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='transfusoes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Endócrinas Metabólicas :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='endocrinas_metabolicas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='endocrinas_metabolicas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Acidentes :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='acidentes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='acidentes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Tuberculose:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tuberculose' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tuberculose' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Doenças Renais Crónicas:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='doencas_renais_cronicas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='doencas_renais_cronicas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Alergia :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='alergia' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='alergia' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Anemia:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='anemia' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='anemia' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Cardiopatias:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cardiopatias' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cardiopatias' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Diabetes :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='diabetes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='diabetes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Etilismo:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='etilismo' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='etilismo' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Tabagismo:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tabagismo' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tabagismo' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Drogas :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='drogas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='drogas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       DTS:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='dts' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='dts' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Cancro:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cancro' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cancro' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       H.T.A :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='hta' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='hta' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Cirurgias:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cirurgias' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cirurgias' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Osteoporose:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='osteoporose' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='osteoporose' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       AVC :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='avc' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='avc' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Viroses:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='viroses' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='viroses' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>              					             
								        </div>
								        <div class='row text-center'>
							                <button class='btn medium bg-blue small' name='salvar_antecedentes' style='margin-top:10px;'>
											    <span class='button-content'>SALVAR</span>
											</button>
										</div>

					                </div>";
					                die();
				}
				if(isset($_GET['antecedentes'])) {
					$antecedentes = $_GET['antecedentes'];
					if ($antecedentes == 1) {

						include('medico/menu.php');
			    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
											<h2 class='text-center'>Antecedentes</h2><br><hr>										
							</form>";						
						
						$query = "	SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_antecedentes.transfusoes as trans,
						tbl_antecedentes.endocrinas_metabolicas as endoc,
						tbl_antecedentes.acidentes as ac,
						tbl_antecedentes.tuberculose as tb,
						tbl_antecedentes.doencas_renais_cronicas as drc,
						tbl_antecedentes.alergia as alerg,
						tbl_antecedentes.anemia as an,
						tbl_antecedentes.cardiopatias as cardpt,
						tbl_antecedentes.diabetes as dbt,
						tbl_antecedentes.etilismo as etl,
						tbl_antecedentes.tabagismo as tbg,
						tbl_antecedentes.drogas as dg,
						tbl_antecedentes.dts as dts,
						tbl_antecedentes.cancro as cancro,
						tbl_antecedentes.hta as hta,
						tbl_antecedentes.cirurgias as crg,
						tbl_antecedentes.osteoporose as ots,
						tbl_antecedentes.avc as avc,
						tbl_antecedentes.viroses as vrs,
						tbl_antecedentes.data_criada as data
						FROM `tbl_antecedentes` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_antecedentes.id_paciente) 
						inner join tbl_medico 
						on(tbl_antecedentes.id_medico=tbl_medico.id_medico) WHERE tbl_antecedentes.id_paciente = $Id";
							
					$resultP=mysqli_query($con,$query);
					$rowP=mysqli_fetch_row($resultP);

					
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[0]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Transfusoes :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Endocrinas Metabólicas :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Acidentes:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[4]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Tuberculose:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[5]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Doenças Renais Crônicas:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[6]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Alergia :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[7]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Anemia:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[8]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Cardiopatias:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[9]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Diabetes :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[10]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Etilismo:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[11]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Tabagismo:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[12]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Drogas:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[13]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Dts:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[14]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Cancro:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[15]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												HTA:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[16]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Cirurgias :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[17]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Osteoporose:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[18]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												AVC:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[19]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Viroses :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[20]</h4>
										</div>
									</div>
									
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data'>
												Data :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[21]</h4>
										</div>
									</div>
						</form>

						</div>
						";
		    		die();
					} elseif ($antecedentes == 2) {
						include('medico/menu.php');
						
						$query = "	SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_antecedentes.transfusoes as trans,
						tbl_antecedentes.endocrinas_metabolicas as endoc,
						tbl_antecedentes.acidentes as ac,
						tbl_antecedentes.tuberculose as tb,
						tbl_antecedentes.doencas_renais_cronicas as drc,
						tbl_antecedentes.alergia as alerg,
						tbl_antecedentes.anemia as an,
						tbl_antecedentes.cardiopatias as cardpt,
						tbl_antecedentes.diabetes as dbt,
						tbl_antecedentes.etilismo as etl,
						tbl_antecedentes.tabagismo as tbg,
						tbl_antecedentes.drogas as dg,
						tbl_antecedentes.dts as dts,
						tbl_antecedentes.cancro as cancro,
						tbl_antecedentes.hta as hta,
						tbl_antecedentes.cirurgias as crg,
						tbl_antecedentes.osteoporose as ots,
						tbl_antecedentes.avc as avc,
						tbl_antecedentes.viroses as vrs,
						tbl_antecedentes.data_criada as data
						FROM `tbl_antecedentes` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_antecedentes.id_paciente) 
						inner join tbl_medico 
						on(tbl_antecedentes.id_medico=tbl_medico.id_medico) WHERE tbl_antecedentes.id_paciente = $Id";
							
					$resultP=mysqli_query($con,$query);
					$rowP=mysqli_fetch_row($resultP);

		    		echo"
		    			<h2 style='margin-top: -32px; margin-right: 75px;' class='text-center'>Editar Antecedentes</h2>
		    			<br><br><br><br>
						<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>
								<input type='hidden' name='Id' value='$Id'>
								<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
							           	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Transfusões:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='transfusoes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='transfusoes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Endócrinas Metabólicas :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='endocrinas_metabolicas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='endocrinas_metabolicas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Acidentes :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='acidentes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='acidentes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Tuberculose:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tuberculose' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tuberculose' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Doenças Renais Crónicas:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='doencas_renais_cronicas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='doencas_renais_cronicas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Alergia :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='alergia' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='alergia' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Anemia:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='anemia' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='anemia' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Cardiopatias:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cardiopatias' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cardiopatias' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Diabetes :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='diabetes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='diabetes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Etilismo:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='etilismo' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='etilismo' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Tabagismo:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tabagismo' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tabagismo' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Drogas :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='drogas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='drogas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       DTS:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='dts' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='dts' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Cancro:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cancro' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cancro' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       H.T.A :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='hta' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='hta' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Cirurgias:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cirurgias' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cirurgias' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Osteoporose:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='osteoporose' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='osteoporose' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       AVC :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='avc' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='avc' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Viroses:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='viroses' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='viroses' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>              					             
								        </div>
								        <div class='row text-center'>
							                <button class='btn primary-bg medium' name='editar_antecedentes'>
												<span class='button-content'>Editar</span>
												<i class='glyph-icon icon-save'></i>
											</button>
										</div>
					                </div>							
						</form>         
						</div>
						";
		    		die();					}					die();
				}

				if (isset($_POST['editar_antecedentes'])) {
						$id_paciente = $_GET['Id'];
						$id_medico = $loggedInUser->user_id;
						$transfusoes = $_POST['transfusoes']; 
						$endocrinas_metabolicas = $_POST['endocrinas_metabolicas']; 
						$acidentes = $_POST['acidentes']; 
						$tuberculose = $_POST['tuberculose']; 
						$doencas_renais_cronicas = $_POST['doencas_renais_cronicas']; 
						$alergia = $_POST['alergia']; 
						$anemia = $_POST['anemia']; 
						$cardiopatias = $_POST['cardiopatias']; 
						$diabetes = $_POST['diabetes']; 
						$etilismo = $_POST['etilismo']; 
						$tabagismo = $_POST['tabagismo']; 
						$drogas = $_POST['drogas']; 
						$dts = $_POST['dts']; 
						$cancro = $_POST['cancro']; 
						$hta = $_POST['hta']; 
						$cirurgias = $_POST['cirurgias']; 
						$osteoporose = $_POST['osteoporose']; 
						$avc = $_POST['avc']; 
						$viroses = $_POST['viroses']; 
						$data = date('Y-m-d');					
						

						$con=connection();				    
						$query = "UPDATE tbl_antecedentes SET 
						id_medico = 				'$id_medico',
						transfusoes = 				'$transfusoes',						
						endocrinas_metabolicas = 	'$endocrinas_metabolicas', 
						acidentes = 				'$acidentes', 
						tuberculose = 				'$tuberculose', 
						doencas_renais_cronicas = 	'$doencas_renais_cronicas', 
						alergia = 					'$alergia', 
						anemia = 					'$anemia', 
						cardiopatias = 				'$cardiopatias', 
						diabetes = 					'$diabetes', 
						etilismo = 					'$etilismo', 
						tabagismo = 				'$tabagismo', 
						drogas = 					'$drogas', 
						dts = 						'$dts', 
						cancro = 					'$cancro', 
						hta = 						'$hta', 
						cirurgias = 				'$cirurgias', 
						osteoporose = 				'$osteoporose', 
						avc = 						'$avc', 
						viroses = 					'$viroses'
						WHERE id_paciente = '$id_paciente'";						
						$a=mysqli_query($con,$query) ? true : false ;
						if($a) echo "<script>swal('Antecedentes atualizado Com Sucesso','','success');</script>";
		    			else echo "<script>swal('Ops! Ocorreu um erro ao atualizar antecedentes','','error');</script>";
				}
				if(isset($_POST['antecedentes'])) {
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
							            <h2 class='text-center'>Antecedentes</h2><br><hr>";
							            $queryT = "SELECT id_paciente FROM tbl_antecedentes WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0) 
								            	echo "";
											else 
							            echo"						            
								      	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Transfusões :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='transfusoes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='transfusoes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Endócrinas Metabólicas :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='endocrinas_metabolicas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='endocrinas_metabolicas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Acidentes :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='acidentes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='acidentes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Tuberculose:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tuberculose' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tuberculose' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Doenças Renais Crónicas:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='doencas_renais_cronicas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='doencas_renais_cronicas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Alergia :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='alergia' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='alergia' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Anemia:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='anemia' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='anemia' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Cardiopatias:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cardiopatias' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cardiopatias' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Diabetes :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='diabetes' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='diabetes' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Etilismo:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='etilismo' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='etilismo' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Tabagismo:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tabagismo' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='tabagismo' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Drogas :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='drogas' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='drogas' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       DTS:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='dts' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='dts' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Cancro:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cancro' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cancro' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       H.T.A :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='hta' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='hta' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Cirurgias:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cirurgias' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='cirurgias' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Patients'>
							                       Osteoporose:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='osteoporose' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='osteoporose' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>

							                <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       AVC :
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-2' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='avc' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='avc' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>			                					             
								        </div>

								        <br><br>
								        
								       	<div class='row'>
										   <div class='form-label col-md-2'>
							                    <label for='Patients'>
							                       Viroses:
							                    </label>
							                </div>
							              	<div class='form-checkbox-radio col-md-1' style='font-size: 10px;'>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='viroses' value='Sim'>
							                        <label for=''>Sim</label>
							                    </div>
							                    <div class='checkbox-radio'>
							                        <input type='radio' name='viroses' value='Não'>
						                            <label for=''>Não</label>
						                        </div>
							                </div>              					             
								        </div>
								        <div class='row text-center'>
							                <button class='btn medium bg-blue small' name='salvar_antecedentes' style='margin-top:10px;'>
											    <span class='button-content'>SALVAR</span>
											</button>
										</div>

					                </div>";
					                $queryT = "SELECT id_paciente FROM tbl_antecedentes WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0){
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Paciente</th>
												<th>Médico</th>
												<th>Data</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT 
													tbl_paciente.Id as id_paciente, 
													tbl_paciente.nome as nome_paciente,
													tbl_medico.nome as nome_medico,
													tbl_antecedentes.data_criada as data
													FROM `tbl_antecedentes` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_antecedentes.id_paciente) 
													inner join tbl_medico 
													on(tbl_antecedentes.id_medico=tbl_medico.id_medico) WHERE tbl_antecedentes.id_paciente = $Id";
										
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>".$row['nome_paciente']."</td>
												<td>".$row['nome_medico']."</td>
												<td>".$row['data']."</td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&antecedentes=1' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
												        <i class='glyph-icon icon-eye'></i>
												    </a>
													<!--<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&antecedentes=2' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
												        <i class='glyph-icon icon-edit'></i>
												    </a>-->
												</form>
												</td>
											</tr>";}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novos_antecedentes'>
									    <span class='button-content'>
									    	Cadastrar
									    </span>
									    <i class='glyph-icon icon-save'></i>
									</button>";
								}

					                echo"					                 
					                </div>
					               
						</form>							
						</div>
						";
		    		die();
		    	}
		    	if(isset($_POST['exame_fisico'])) {
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>

									<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
							            <h2 class='text-center'>Exame Físico</h2><br><hr>";
							            $queryT = "SELECT id_paciente FROM tbl_exame_fisico WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0) 
								            	echo "";
											else
							            echo"
							            <div class='row'>
								            <div class='form-input col-md-4'>
							                	<textarea placeholder='OBJECTIVO PRINCIPAL' name='objectivo_principal' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='GÉNITO URINÁRIO' name='genito_unitario' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='CABEÇA' name='cabeca' class='form-control' rows='5' ></textarea>
							                </div>
						                </div>
						                <div class='row'>
								            <div class='form-input col-md-4'>
							                	<textarea placeholder='MEMBROS SUPERIORES' name='membros_superiores' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='MEMBROS INFERIORES' name='membros_inferiores' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='PESCOÇO' name='pescoco' class='form-control' rows='5' ></textarea>
							                </div>
						                </div>
						                <div class='row'>
								            <div class='form-input col-md-4'>
							                	<textarea placeholder='TORAX' name='torax' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='SISTEMA NERVOSO' name='sistema_nervoso' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='ABDOMÊN' name='abdomen' class='form-control' rows='5' ></textarea>
							                </div>
						                </div>
						                <div class='row text-center'>
							                <button class='btn medium bg-blue small' name='salvar_exame_fisico' style='margin-top:10px;'>
											    <span class='button-content'>SALVAR</span>
											</button>
							                <input type='reset' value'LIMPAR TUDO' class='btn medium bg-red small' name='#' style='width: 85px; margin-top:10px;'/>
										</div>
					                </div>";
					                $queryT = "SELECT id_paciente FROM tbl_exame_fisico WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0){
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Paciente</th>
												<th>Médico</th>
												<th>Data</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT 
													tbl_paciente.Id as id_paciente,
													tbl_paciente.nome as nome_paciente, 
													tbl_medico.nome as nome_medico,
													tbl_exame_fisico.data_criada as data
													FROM `tbl_exame_fisico` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_exame_fisico.id_paciente) 
													inner join tbl_medico 
													on(tbl_exame_fisico.id_medico=tbl_medico.id_medico) WHERE tbl_exame_fisico.id_paciente = $Id";
										
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>".$row['nome_paciente']."</td>
												<td>".$row['nome_medico']."</td>
												<td>".$row['data']."</td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&exame_fisico=1' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
												        <i class='glyph-icon icon-eye'></i>
												    </a>
													<!--<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&exame_fisico=2' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
												        <i class='glyph-icon icon-edit'></i>
												    </a>-->
												</form>
												</td>
											</tr>";}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novo_exame_fisico'>
									    <span class='button-content'>
									    	Cadastrar
									    </span>
									    <i class='glyph-icon icon-save'></i>
									</button>";
								}
					                echo"					                				
					            </form>
						</div>
						";
		    		die();
				}
				if (isset($_POST['novo_exame_fisico'])) {
					include('medico/menu.php');
									echo"<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
													<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
														<h2 class='text-center'>Exame Físico</h2><br><hr>										
										</form>
							            <div class='row'>
								            <div class='form-input col-md-4'>
							                	<textarea placeholder='OBJECTIVO PRINCIPAL' name='objectivo_principal' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='GÉNITO URINÁRIO' name='genito_unitario' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='CABEÇA' name='cabeca' class='form-control' rows='5' ></textarea>
							                </div>
						                </div>
						                <div class='row'>
								            <div class='form-input col-md-4'>
							                	<textarea placeholder='MEMBROS SUPERIORES' name='membros_superiores' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='MEMBROS INFERIORES' name='membros_inferiores' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='PESCOÇO' name='pescoco' class='form-control' rows='5' ></textarea>
							                </div>
						                </div>
						                <div class='row'>
								            <div class='form-input col-md-4'>
							                	<textarea placeholder='TORAX' name='torax' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='SISTEMA NERVOSO' name='sistema_nervoso' class='form-control' rows='5' ></textarea>
							                </div>
							                <div class='form-input col-md-4'>
							                	<textarea placeholder='ABDOMÊN' name='abdomen' class='form-control' rows='5' ></textarea>
							                </div>
						                </div>
						                <div class='row text-center'>
							                <button class='btn medium bg-blue small' name='salvar_exame_fisico' style='margin-top:10px;'>
											    <span class='button-content'>SALVAR</span>
											</button>
							                <input type='reset' value'LIMPAR TUDO' class='btn medium bg-red small' name='#' style='width: 85px; margin-top:10px;'/>
										</div>
					                </div>";
					                die();
				}
				if(isset($_GET['exame_fisico'])) {
					$exame_fisico = $_GET['exame_fisico'];
					if ($exame_fisico == 1) {
						
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Exame Físico</h2><br><hr>										
						</form>";
						$query = "	SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_exame_fisico.objectivo_principal as op,
						tbl_exame_fisico.genito_unitario as gu,
						tbl_exame_fisico.cabeca as c,
						tbl_exame_fisico.membros_superiores as ms,
						tbl_exame_fisico.membros_inferiores as mi,
						tbl_exame_fisico.pescoco as p,
						tbl_exame_fisico.torax as t,
						tbl_exame_fisico.sistema_nervoso as sn,
						tbl_exame_fisico.abdomen as ab,
						tbl_exame_fisico.data_criada as data
						FROM `tbl_exame_fisico` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_exame_fisico.id_paciente) 
						inner join tbl_medico 
						on(tbl_exame_fisico.id_medico=tbl_medico.id_medico) WHERE tbl_exame_fisico.id_paciente = $Id";
							
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[0]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Objectivo Principal :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Génito Unitário :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Cabeça :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[4]</h4>
										</div>
									</div>
									
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Membros Superiores :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[5]</h4>
										</div>
									</div>
									
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Membros Inferiores :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[6]</h4>
										</div>
									</div>
									
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Pescoço :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[7]</h4>
										</div>
									</div>
									
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Torax :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[8]</h4>
										</div>
									</div>
															
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Sistema Nervoso :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[9]</h4>
										</div>
									</div>

									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Abdomên :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[10]</h4>
										</div>
									</div>

									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Data :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[11]</h4>
										</div>
									</div>
									</form>

						</div>
						";
		    		die();
					}elseif ($exame_fisico == 2) {											
					
					include('medico/menu.php');
		    		echo"
						<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
							<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
								<h2 class='text-center'>Exame Físico</h2><br><hr>										
						</form>";
						$query = "	SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_exame_fisico.objectivo_principal as op,
						tbl_exame_fisico.genito_unitario as gu,
						tbl_exame_fisico.cabeca as c,
						tbl_exame_fisico.membros_superiores as ms,
						tbl_exame_fisico.membros_inferiores as mi,
						tbl_exame_fisico.pescoco as p,
						tbl_exame_fisico.torax as t,
						tbl_exame_fisico.sistema_nervoso as sn,
						tbl_exame_fisico.abdomen as ab,
						tbl_exame_fisico.data_criada as data
						FROM `tbl_exame_fisico` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_exame_fisico.id_paciente) 
						inner join tbl_medico 
						on(tbl_exame_fisico.id_medico=tbl_medico.id_medico) WHERE tbl_exame_fisico.id_paciente = $Id";
							
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);

						echo"
						<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>
								<input type='hidden' name='Id' value='$Id'>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='paciente'>
											Paciente:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input type='text' required='required' readonly value='".$rowP[0]."' name='paciente' id='nome' onfocus='searchVendor()'>
									</div>
								</div>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='medico'>
											Médico:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input required='required' type='text' readonly value='".$rowP[1]."' name='medico' id='medico' onfocus='searchVendor()'>
									</div>
								</div>

								<div class='row'>
								<div class='form-input col-md-4'>
									<textarea placeholder='OBJECTIVO PRINCIPAL' name='objectivo_principal' class='form-control' rows='5' >".$rowP[2]."</textarea>
								</div>
								<div class='form-input col-md-4'>
									<textarea placeholder='GÉNITO URINÁRIO' name='genito_unitario' class='form-control' rows='5' >".$rowP[3]."</textarea>
								</div>
								<div class='form-input col-md-4'>
									<textarea placeholder='CABEÇA' name='cabeca' class='form-control' rows='5' >".$rowP[4]."</textarea>
								</div>
							</div>
							<div class='row'>
								<div class='form-input col-md-4'>
									<textarea placeholder='MEMBROS SUPERIORES' name='membros_superiores' class='form-control' rows='5' >".$rowP[5]."</textarea>
								</div>
								<div class='form-input col-md-4'>
									<textarea placeholder='MEMBROS INFERIORES' name='membros_inferiores' class='form-control' rows='5' >".$rowP[6]."</textarea>
								</div>
								<div class='form-input col-md-4'>
									<textarea placeholder='PESCOÇO' name='pescoco' class='form-control' rows='5' >".$rowP[7]."</textarea>
								</div>
							</div>
							<div class='row'>
								<div class='form-input col-md-4'>
									<textarea placeholder='TORAX' name='torax' class='form-control' rows='5' >".$rowP[8]."</textarea>
								</div>
								<div class='form-input col-md-4'>
									<textarea placeholder='SISTEMA NERVOSO' name='sistema_nervoso' class='form-control' rows='5' >".$rowP[9]."</textarea>
								</div>
								<div class='form-input col-md-4'>
									<textarea placeholder='ABDOMÊN' name='abdomen' class='form-control' rows='5' >".$rowP[10]."</textarea>
								</div>
							</div>
			<br>
						<button class='btn primary-bg medium' name='editar_exame_fisico'>
							<span class='button-content'>Editar</span>
							<i class='glyph-icon icon-save'></i>
						</button>
						</form>         
						</div>
						";
		    		die();
					}
					die();
				}
				if (isset($_POST['editar_exame_fisico'])) {
					$id = $_GET['Id'];
					$id_medico = $loggedInUser->user_id;
					$objectivo_principal = $_POST['objectivo_principal']; 
					$genito_unitario = $_POST['genito_unitario']; 
					$cabeca = $_POST['cabeca']; 
					$membros_superiores = $_POST['membros_superiores']; 
					$membros_inferiores = $_POST['membros_inferiores']; 
					$pescoco = $_POST['pescoco']; 
					$torax = $_POST['torax']; 
					$sistema_nervoso = $_POST['sistema_nervoso']; 
					$abdomen = $_POST['abdomen'];  

					if (empty($torax)||empty($abdomen)||empty($sistema_nervoso)||empty($membros_inferiores)||empty($pescoco)||empty($objectivo_principal)|| empty($genito_unitario)|| empty($genito_unitario)|| empty($cabeca)|| empty($membros_superiores)) {
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
						$query = "UPDATE tbl_exame_fisico SET 
						id_medico='$id_medico',
						objectivo_principal='$objectivo_principal',
						genito_unitario='$genito_unitario',
						cabeca='$cabeca',
						membros_superiores='$membros_superiores',
						membros_inferiores='$membros_inferiores',
						pescoco='$pescoco',
						torax='$torax',
						sistema_nervoso='$sistema_nervoso',
						abdomen='$abdomen'
						WHERE id_paciente = '$id'";							
						$a=mysqli_query($con,$query) ? true : false ; 	
						if($a){
								echo "<script>alert('Exame físico actualizado com sucesso');</script>";
						}
						else echo "	
									<div class='row'>
										<div class='col-md-6'>
											<div class='infobox error-bg mrg0A'>
												<p>Ocorreu um erro, o exame físico não foi actualizado na base de dados.</p>
											</div>
										</div>
									</div>
								";
						}
				}
		    	if(isset($_POST['hipotese'])) {
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>

									<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Hipótese</h2><br><hr>";
										$queryT = "SELECT id_paciente FROM tbl_hipotese_consultado WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0) {								            	
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Paciente</th>
												<th>Médico</th>
												<th>Data</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT 
													tbl_paciente.Id as id_paciente,
													tbl_paciente.nome as nome_paciente, 
													tbl_medico.nome as nome_medico,
													tbl_hipotese_consultado.data_cadastro as data
													FROM `tbl_hipotese_consultado` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_hipotese_consultado.id_paciente) 
													inner join tbl_medico 
													on(tbl_hipotese_consultado.id_medico=tbl_medico.id_medico) WHERE tbl_hipotese_consultado.id_paciente = $Id";
										
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>".$row['nome_paciente']."</td>
												<td>".$row['nome_medico']."</td>
												<td>".$row['data']."</td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_hip=1' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
												        <i class='glyph-icon icon-eye'></i>
												    </a>													
												    <a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&hipotese=2' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
												        <i class='glyph-icon icon-edit'></i>
												    </a>	
												</form>
												</td>
											</tr>";
										}
										echo "	
										</tbody>
									</table>";
								            }								            	
											else { echo "							            
													<table class='table' id='example1'>
														<thead>
															<tr>
																<th>Código</th>
																<th>Descrição</th>
																<th>Selecionar</th>
															</tr>
														</thead>
														<tbody>";
														$con=connection();
														$query="SELECT * FROM tbl_hipotese";
														$result=mysqli_query($con,$query);
														while($row=mysqli_fetch_array($result))
														{
														echo "<tr>
																<td>".$row['codigo']."</td>
																<td>".$row['descricao']."</td>
																<td>
																	<div class='form-checkbox-radio'>
																		<div class='checkbox-radio'>
																			<input type='checkbox' id='' name='hipotese[]' value='".$row['descricao']."' />
																		</div>
																	</div>
																</td>
															</tr>";
														}	
														echo"
														</tbody>
													</table>
														<form method='post' action='pacientes_consulta.php'>
															<a title='Novo Paciente' href='pacientes_consulta.php'>
															<button style='font-size:20px; background-color: #149900; color: #fff;' name='add_hipotese' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
																	<i class='glyph-icon icon-save'></i>
																	Salvar
																</button>
															</a><br><br>
														</form>
															</div>							
														</form>
												</div>
												";}
		    		die();
		    	}
				if(isset($_GET['hipotese'])) {
					$hipotese = $_GET['hipotese'];
						if ($hipotese == 2) {
																
					include('medico/menu.php');
		    		echo"
						<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
							<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
								<h2 class='text-center'>Hipótese</h2><br><hr>						            
								<table class='table' id='example1'>
									<thead>
										<tr>
											<th>Código</th>
											<th>Descrição</th>
											<th>Selecionar</th>
										</tr>
									</thead>
									<tbody>";
									$con=connection();
									$query="SELECT * FROM tbl_hipotese";
									$result=mysqli_query($con,$query);
									while($row=mysqli_fetch_array($result))
									{
									echo "<tr>
											<td>".$row['codigo']."</td>
											<td>".$row['descricao']."</td>
											<td>
												<div class='form-checkbox-radio'>
													<div class='checkbox-radio'>
														<input type='checkbox' id='' name='hipotese[]' value='".$row['descricao']."' />
													</div>
												</div>
											</td>
										</tr>";
									}	
									echo"
									</tbody>
								</table>
								<button type='submit' style='font-size:20px; background-color: #149900; color: #fff;' name='editar_hipotese' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
									<i class='glyph-icon icon-save'></i>
									Salvar
								</button><br><br>
							</div>
						</div>
						</form>
									";
		    		die();
					}
					die();
				}

				

		    	if(isset($_GET['ver_hip'])) {
					$ver_hip = $_GET['ver_hip'];
					if ($ver_hip == 1) {
											
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Hipótese</h2><br><hr>										
						</form>";
						$query = "	SELECT 
									tbl_paciente.Id as id_paciente,
									tbl_paciente.nome as nome_paciente, 
									tbl_medico.nome as nome_medico,
									tbl_hipotese_consultado.hipotese as hipotese
									FROM `tbl_hipotese_consultado` 
									inner join tbl_paciente 
									on(tbl_paciente.Id=tbl_hipotese_consultado.id_paciente) 
									inner join tbl_medico 
									on(tbl_hipotese_consultado.id_medico=tbl_medico.id_medico) WHERE tbl_hipotese_consultado.id_paciente = $Id";																
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Hipóteses :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}
				}

		    	if(isset($_POST['diagnostico'])) {
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
								            <h2 class='text-center'>Diagnóstico</h2><br><hr>
								        </div>					                
							</form>
						</div>
						";
		    		die();
		    	}
		    	if(isset($_GET['menu']) AND $_GET['menu'] == 'exame_clinico') {
		    		$query="SELECT DISTINCT * FROM tbl_triagem WHERE id_paciente = '$Id'";
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$result=mysqli_query($con,$query);
					$resultP=mysqli_query($con,$queryP);
					
					$row=mysqli_fetch_row($result);
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
					
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
											<h2 class='text-center'>Exame Clínico</h2><br><hr>";
											$queryT = "SELECT id_paciente FROM tbl_exame_clinico_consultado WHERE id_paciente = '$Id'";
											$resultado = mysqli_query($con, $queryT);
											$totLinhas = mysqli_num_rows($resultado);
												if($totLinhas > 0) {																			            	
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Médico</th>
												<th>Data</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT 
													tbl_paciente.Id as id_paciente,
													tbl_paciente.nome as nome_paciente, 
													tbl_users.display_name as nome_medico,
													tbl_exame_clinico_consultado.data_cadastro as data,
													tbl_exame_clinico_consultado.exame_clinico_id as exame_clinico_id,
													tbl_exame_clinico_consultado.exame_clinico_id as id_exame
													FROM `tbl_exame_clinico_consultado` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_exame_clinico_consultado.id_paciente) 
													inner join tbl_users 
													on(tbl_exame_clinico_consultado.id_medico=tbl_users.id) WHERE tbl_exame_clinico_consultado.id_paciente = $Id";
										
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_ex=1&exame_clinico_id=".$row['exame_clinico_id']."' class='tooltip-button' data-placement='top' title='Ver'>".$row['nome_medico']."</a>
												</td>
												<td>
												<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_ex=1&exame_clinico_id=".$row['exame_clinico_id']."' class='tooltip-button' data-placement='top' title='Ver'>".$row['data']."</a></td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='imprimir/imprimir_exame_clinico.php?id=".$row['exame_clinico_id']."' target='_blank' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Imprimir'>
												        <i class='glyph-icon icon-print'></i>
												    </a>
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_ex=1&exame_clinico_id=".$row['exame_clinico_id']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
														<i class='glyph-icon icon-eye'></i>
													</a>										
												</form>
												</td>
											</tr>";
										}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novo_exame_clinico'>
									    <span class='button-content'>
									    	Novo Exame Clínico
									    </span>
									    <i class='glyph-icon icon-plus'></i>
									</button><br><br>";
												} else { 
													echo "	
													<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
																					<div class='row'>
																						<div class='form-input col-md-12'>
																							<textarea rows='8' placeholder='Escreva os exames clínicos para o paciente...' name='exame_clinico' class=' form-control'></textarea>
																						</div>
																					</div>
																					<div class='row text-center'>
																						<button class='btn medium bg-blue small' name='add_exame_clinico' style='margin-top:10px;'>
																							<span class='button-content'>SALVAR</span>
																						</button><br>
																					</div>		
																				</div>			                
																	</form>
																</div>";
																?>
																
																<?php
																die();
																
																echo"
															<form method='post' action='pacientes_consulta.php'>
																<a title='Novo Paciente' href='pacientes_consulta.php'>
																<button style='font-size:20px; background-color: #149900; color: #fff;' name='add_exame_clinico' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
																		<i class='glyph-icon icon-save'></i>
																		Salvar
																	</button>
																</a><br><br>
															</form>
																	</div>		
													</div>
												"; }
		    		die();
		    	}

				if (isset($_GET['exame_clinico'])){ 
						include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Exame Clínico</h2><br><hr>										
						";
					if ($_GET['exame_clinico'] == 2) {
					echo "					    
													<table class='table' id='example1'>
														<thead>
															<tr>
																<th>Descrição</th>
																<th>Grupo</th>
																<th>Selecionar</th>
															</tr>
														</thead>
														<tbody>";
														$con=connection();
														$query="SELECT * FROM tbl_exame_clinico";
														$result=mysqli_query($con,$query);
														while($row=mysqli_fetch_array($result))
														{
														echo "
														
															<tr>
																<td>".$row['descricao']."</td>
																<td>".$row['grupo']."</td>
																<td>
																	<div class='form-checkbox-radio'>
																		<div class='checkbox-radio'>
																			<input type='checkbox' id='' name='exame_clinico[]' value='".$row['descricao']."' />
																		</div>
																	</div>
																</td>
															</tr>";
															}	
															echo "
															</tbody>
														</table>
																<button type='submit' style='font-size:20px; background-color: #149900; color: #fff;' name='editar_exame_clinico' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
																		<i class='glyph-icon icon-save'></i>
																		Editar
																</button>
																	<br><br>
																	</div>
														</form>		
													</div>
												"; die();
											}
				}

				if (isset($_POST['novo_exame_clinico'])){ 
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Exame Clínico</h2><br><hr>										
						";
											echo "	
													<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
																					<div class='row'>
																						<div class='form-input col-md-12' style='margin-left: 20%' >
																							<textarea placeholder='Escreva o resumo do Atendimento...' name='exame_clinico' class=' form-control' rows='13'></textarea>
																						</div>
																					</div>
																					<div class='row text-center'>
																						<button class='btn medium bg-blue small' name='add_exame_clinico' style='margin-top:10px;'>
																							<span class='button-content'>SALVAR</span>
																						</button><br>
																					</div>		
																				</div>			                
																	</form>
																</div>";
																?>
																<script src='models//.js'></script>
																<?php
																die();
																echo "
															<form method='post' action='pacientes_consulta.php'>
																<a title='Novo Paciente' href='pacientes_consulta.php'>
																<button style='font-size:20px; background-color: #149900; color: #fff;' name='add_exame_clinico' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
																		<i class='glyph-icon icon-save'></i>
																		Salvar
																	</button>
																</a><br><br>
															</form>
																	</div>		
													</div>
												"; die();
				}
				

		    	if(isset($_GET['ver_ex'])) {
					$ver_ex = $_GET['ver_ex'];
					if ($ver_ex == 1) {
						
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Exame Clínico</h2><br><hr>										
						</form>";
						$query = "	SELECT 
									tbl_paciente.Id as id_paciente,
									tbl_paciente.nome as nome_paciente, 
									tbl_users.display_name as nome_medico,
									tbl_exame_clinico_consultado.exame_clinico as hipotese
									FROM `tbl_exame_clinico_consultado` 
									inner join tbl_paciente 
									on(tbl_paciente.Id=tbl_exame_clinico_consultado.id_paciente) 
									inner join tbl_users 
									on(tbl_exame_clinico_consultado.id_medico=tbl_users.id) WHERE tbl_exame_clinico_consultado.id_paciente = $Id";																
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Exames :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}
				}

				if(isset($_GET['ver_diario'])) {
					$ver_diario = $_GET['ver_diario'];
					if ($ver_diario == 1) {
					$id_diario = $_GET['id_diario'];
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Diário Clínico</h2><br><hr>										
						</form>";
						$query = "	SELECT 
									tbl_paciente.Id as id_paciente,
									tbl_paciente.nome as nome_paciente, 
									tbl_users.display_name as nome_medico,
									tbl_diario_clinico.resumo_atendimento as resumo,
									tbl_diario_clinico.servico as servico,
									tbl_diario_clinico.data as data
									FROM `tbl_diario_clinico` 
									inner join tbl_paciente 
									on(tbl_paciente.Id=tbl_diario_clinico.id_paciente) 
									inner join tbl_users 
									on(tbl_diario_clinico.medico=tbl_users.id) WHERE tbl_diario_clinico.id_paciente = $Id AND tbl_diario_clinico.id_atendimento = $id_diario";			
						//var_dump($query);													
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Serviço:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[4]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Descrição :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}
				}

				if(isset($_GET['ver_justificativo'])) {
					$ver_justificativo = $_GET['ver_justificativo'];
					if ($ver_justificativo == 1) {
					$id_justificativo = $_GET['id_justificativo'];
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Justificativo Médico</h2><br><hr>										
						</form>";
						$query = "SELECT 
									tbl_paciente.Id as id_paciente,
									tbl_paciente.nome as nome_paciente, 
									tbl_users.display_name as nome_medico,
									tbl_justificativo_medico.qtd_dias as qtd,
									tbl_justificativo_medico.cid_doenca as doenca,
									tbl_justificativo_medico.data_cadastro as data
									FROM `tbl_justificativo_medico` 
									inner join tbl_paciente 
									on(tbl_paciente.Id=tbl_justificativo_medico.id_paciente) 
									inner join tbl_users 
									on(tbl_justificativo_medico.id_medico=tbl_users.id) WHERE tbl_justificativo_medico.id_justificativo_medico = $id_justificativo";			
						//var_dump($query);													
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Quantidade de dias:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Doença:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[4]</h4>
										</div>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}
				}

				if(isset($_GET['ver_receita'])) {
					$ver_receita = $_GET['ver_receita'];
					if ($ver_receita == 1) {
					$id_receita = $_GET['id_receita'];
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Receituário</h2><br><hr>										
						</form>";
						$query = "	SELECT 
									tbl_paciente.Id as id_paciente,
									tbl_paciente.nome as nome_paciente, 
									tbl_users.display_name as nome_medico,
									tbl_receitas.quantidade as qtd,
									tbl_receitas.medicamento as medicamento,
									tbl_receitas.observacao as observacao,
									tbl_receitas.data_receita as data
									FROM `tbl_receitas` 
									inner join tbl_paciente 
									on(tbl_paciente.Id=tbl_receitas.id_paciente) 
									inner join tbl_users 
									on(tbl_receitas.medico=tbl_users.id) WHERE tbl_receitas.id_paciente = $Id AND tbl_receitas.id_receita = $id_receita";			
						//var_dump($query);													
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						echo"
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Quantidade:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Medicamento :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[4]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Obs :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[5]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Data:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[6]</h4>
										</div>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}
				}

		    	if(isset($_GET['menu']) AND $_GET['menu'] == 'diario_clinico') {
		    		$query="SELECT DISTINCT * FROM tbl_triagem WHERE id_paciente = '$Id'";
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$result=mysqli_query($con,$query);
					$resultP=mysqli_query($con,$queryP);
					
					$row=mysqli_fetch_row($result);
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo 	"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
								            <h2 class='text-center'>Diário Clínico</h2><br><hr>";
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Data/Hora</th>
												<th>Descrição</th>
												<th>Médico</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "SELECT tbl_diario_clinico.id_atendimento as id_atendimento, tbl_paciente.Id as id_paciente, tbl_paciente.nome as nome_paciente, tbl_users.display_name as nome_medico, tbl_diario_clinico.data as data, tbl_diario_clinico.servico as servicos, tbl_diario_clinico.resumo_atendimento as resumo_atendimento FROM `tbl_diario_clinico` inner join tbl_paciente on(tbl_paciente.Id=tbl_diario_clinico.id_paciente) inner join tbl_users on(tbl_diario_clinico.medico=tbl_users.id) WHERE tbl_diario_clinico.id_paciente = $Id ORDER BY tbl_diario_clinico.data ASC";
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td><a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_diario=1&id_diario=".$row['id_atendimento']."'>".$row['data']."</a></td>
												<td><a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_diario=1&id_diario=".$row['id_atendimento']."'>".$row['servicos']."</a></td>
												<td><a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_diario=1&id_diario=".$row['id_atendimento']."'>".$row['nome_medico']."</a></td>
												<td>
													<a target='_blank' href='imprimir/imprimir_diario_clinico.php?id=".$row['id_atendimento']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Imprimir'>
														<i class='glyph-icon icon-print'></i>
													</a>
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_diario=1&id_diario=".$row['id_atendimento']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
														<i class='glyph-icon icon-eye'></i>
													</a>
												</td>
											</tr>";
										}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novo_atendimento'>
									    <span class='button-content'>
									    	Novo Diário
									    </span>
									    <i class='glyph-icon icon-plus'></i>
									</button><br><br><br>";
		    		die();
				}
				
				if (isset($_POST['novo_atendimento'])) {
						include('medico/menu.php');
						echo "	<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9'>
										<h2 class='text-center'>Resumo do atendimento</h2><br><hr>		
								</form>
											            <div class='row'>
												            <div class='form-input col-md-12' style='margin-left: 20%, margin-top: -100px;' >
											                	<textarea rows='8' placeholder='Escreva o resumo do Atendimento...' name='resumo_atendimento' class=' form-control'></textarea>
											                </div>
										                </div>
										                <div class='row text-center'>
											                <button class='btn medium bg-blue small' name='add_atendimento' style='margin-top:10px;'>
															    <span class='button-content'>SALVAR</span>
															</button>
														</div>		
													</div>			                
										</form>
									</div>";?>
									<script src='models//.js'></script>
									<?php
									die();
				}	
				if(isset($_GET['menu']) AND $_GET['menu'] == 'tratamentos_e_recomendacoes') {
		    		$query="SELECT DISTINCT * FROM tbl_triagem WHERE id_paciente = '$Id'";
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$result=mysqli_query($con,$query);
					$resultP=mysqli_query($con,$queryP);
					
					$row=mysqli_fetch_row($result);
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
								            <h2 class='text-center'>Tratamentos e Recomendações</h2><br><hr>";
										$queryT = "SELECT id_paciente FROM tbl_tratamentos_recomendacoes WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0) 
								            	echo "";
											else
									            echo "
											            <div class='row'>
												            <div class='form-input col-md-7' style='margin-left: 20%' >
											                	<textarea placeholder='TRATAMENTOS' name='tratamentos' class='form-control' rows='13' ></textarea>
											                </div>
										                </div>
										                <div class='row'>
												            <div class='form-input col-md-7' style='margin-left: 20%' >
											                	<textarea placeholder='RECOMENDAÇÕES' name='recomendacoes' class='form-control' rows='13' ></textarea>
											                </div>
										                </div>
										                <div class='row text-center'>
											                <button class='btn medium bg-blue small' name='add_tratamento_recomendacoes' style='margin-top:10px;'>
															    <span class='button-content'>SALVAR</span>
															</button><br>
														</div>		<br>
													</div>			                
										</form>
									</div>";
									$queryT = "SELECT id_paciente FROM tbl_tratamentos_recomendacoes WHERE id_paciente = '$Id'";
							            $resultado = mysqli_query($con, $queryT);
							            $totLinhas = mysqli_num_rows($resultado);
								            if($totLinhas > 0){
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Médico</th>
												<th>Data</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT DISTINCT
											id_tratamento_rec,
											tbl_paciente.id as id_paciente,
											tbl_paciente.nome as nome_paciente, 
											tbl_users.display_name as nome_medico,
											tbl_tratamentos_recomendacoes.tratamentos as trat,
											tbl_tratamentos_recomendacoes.recomendacoes as rec,
											tbl_tratamentos_recomendacoes.data_criada as data
											FROM `tbl_tratamentos_recomendacoes` 
											inner join tbl_paciente 
											on(tbl_paciente.Id=tbl_tratamentos_recomendacoes.id_paciente) 
											inner join tbl_users 
											on(tbl_tratamentos_recomendacoes.id_medico=tbl_users.id) WHERE tbl_tratamentos_recomendacoes.id_paciente = $Id";
															
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>".$row['nome_medico']."</td>
												<td>".$row['data']."</td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&trat_rec=1' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
												        <i class='glyph-icon icon-eye'></i>
												    </a>
													<!--<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&trat_rec=2' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
												        <i class='glyph-icon icon-edit'></i>
												    </a>-->
													<a target='_blank' href='imprimir/imprimir_tratamentos_recomendacoes.php?id=".$row['id_tratamento_rec']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Imprimir'>
												        <i class='glyph-icon icon-print'></i>
												    </a>
												</form>
												</td>
											</tr>";}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novo_tratamento_recomendacao'>
									    <span class='button-content'>
									    	Novo Tratamento
									    </span>
									    <i class='glyph-icon icon-plus'></i>
									</button>";
								}
		    		die();
				}

				if (isset($_POST['novo_tratamento_recomendacao'])) {
						include('medico/menu.php');
						echo "	<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Tratamentos e Recomendações</h2><br><hr>										
								</form>
											            <div class='row'>
												            <div class='form-input col-md-7' style='margin-left: 20%' >
											                	<textarea placeholder='TRATAMENTOS' name='tratamentos' class='form-control' rows='13' ></textarea>
											                </div>
										                </div>
										                <div class='row'>
												            <div class='form-input col-md-7' style='margin-left: 20%' >
											                	<textarea placeholder='RECOMENDAÇÕES' name='recomendacoes' class='form-control' rows='13' ></textarea>
											                </div>
										                </div>
										                <div class='row text-center'>
											                <button class='btn medium bg-blue small' name='add_tratamento_recomendacoes' style='margin-top:10px;'>
															    <span class='button-content'>SALVAR</span>
															</button><br>
														</div>		<br>
													</div>			                
										</form>
									</div>";
									die();
				}
				if(isset($_GET['trat_rec'])) {
					$trat_rec = $_GET['trat_rec'];
					if ($trat_rec == 1) {
						
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Tratamentos e Recomendações</h2><br><hr>										
						</form>";
						$query = "	SELECT DISTINCT	
						tbl_paciente.nome as nome_paciente, 
						tbl_users.display_name as nome_medico,
						tbl_tratamentos_recomendacoes.tratamentos as trat,
						tbl_tratamentos_recomendacoes.recomendacoes as rec,
						tbl_tratamentos_recomendacoes.data_criada as data
						FROM `tbl_tratamentos_recomendacoes` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_tratamentos_recomendacoes.id_paciente) 
						inner join tbl_users 
						on(tbl_tratamentos_recomendacoes.id_medico=tbl_users.id) WHERE tbl_tratamentos_recomendacoes.id_paciente = $Id";
							
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);

						
						echo "
						<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='processo'>
												Paciente:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[0]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Nome'>
												Médico:
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[1]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Tratamentos :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[2]</h4>
										</div>
									</div>
									<div class='form-row'>
										<div class='form-label col-md-2'>
											<label for='Data de Nascimento'>
												Recomendações :
											</label>
										</div>
										<div class='form-input col-md-6'>
											<h4>$rowP[3]</h4>
										</div>
									</div>
									<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='Data de Nascimento'>
											Data :
										</label>
									</div>
									<div class='form-input col-md-6'>
										<h4>$rowP[4]</h4>
									</div>
								</div>
						</form>

						</div>
						";
		    		die();
					}elseif ($trat_rec == 2) {
																
					include('medico/menu.php');
		    		echo"
						<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
							<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
								<h2 class='text-center'>Tratamentos e Recomendações</h2><br><hr>										
						</form>
						";
						$query = "	SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_users.display_name as nome_medico,
						tbl_tratamentos_recomendacoes.tratamentos as trat,
						tbl_tratamentos_recomendacoes.recomendacoes as rec,
						tbl_tratamentos_recomendacoes.data_criada as data
						FROM `tbl_tratamentos_recomendacoes` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_tratamentos_recomendacoes.id_paciente) 
						inner join tbl_users 
						on(tbl_tratamentos_recomendacoes.id_medico=tbl_users.id) WHERE tbl_tratamentos_recomendacoes.id_paciente = $Id";
							
						$resultP=mysqli_query($con,$query);

						$rowP=mysqli_fetch_row($resultP);
						
						echo "
						<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>
								<input type='hidden' name='Id' value='$Id'>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='paciente'>
											Paciente:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input type='text' required='required' readonly value='".$rowP[0]."' name='paciente' id='nome' onfocus='searchVendor()'>
									</div>
								</div>
								<div class='form-row'>
									<div class='form-label col-md-2'>
										<label for='medico'>
											Médico:
										</label>
									</div>
									<div class='form-input col-md-6'>
										<input required='required' type='text' readonly value='".$rowP[1]."' name='medico' id='medico' onfocus='searchVendor()'>
									</div>
								</div>
								<div class='form-row'>
									<div class='form-input col-md-4'>
										<textarea placeholder='TRATAMENTOS' name='tratamentos' class='form-control' rows='13' >".$rowP[2]."</textarea>
									</div>
									<div class='form-input col-md-4'>
										<textarea placeholder='RECOMENDAÇÕES' name='recomendacoes' class='form-control' rows='13' >".$rowP[3]."</textarea>
									</div>
								</div>
						<br>
						<button class='btn primary-bg medium' name='editar_trat_rec'>
							<span class='button-content'>Editar</span>
						</button>
						</form>         
						</div>
						";
		    		die();
					}
					die();
				}
					if (isset($_POST['add_tratamento_recomendacoes'])) {
					$id_paciente = $_GET['Id'];
					$id_medico = $loggedInUser->user_id;
					$tratamentos=$_POST['tratamentos'];
					$recomendacoes=$_POST['recomendacoes'];
					$data = date('Y-m-d H:i:s');
									
					$con = connection();
					$query = "INSERT INTO tbl_tratamentos_recomendacoes VALUES (Null, '$id_paciente','$id_medico','$tratamentos','$recomendacoes', '$data')";
					mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
					$a = mysqli_query($con,$query) ? true : false ;
					if($a){
						echo "<script>swal('Tratamentos e recomendações salvos com sucesso', '', 'success');</script>";
						?>
					    <script type="text/javascript">
		           			setTimeout("location.href = 'pacientes_consulta.php?Id=<?=$id_paciente;?>&acao=consultar&menu=tratamentos_e_recomendacoes';", 1500);
		                </script>
					    <?php					
					}         
					else echo "<script>swal('Ocorreu um erro a gerar a receita', '', 'error');</script>";
				}


				if (isset($_POST['add_receita'])) {
					$id_paciente = $_GET['Id'];
					$id_medico = $loggedInUser->user_id;

					$quantidade = $_POST['quantidade'];	
					$quantidade = implode(",", $quantidade);
					
					$medicameto = $_POST['medicameto'];	
					$medicameto = implode(",", $medicameto);

					$obs = $_POST['obs'];	
					$obs = implode(",", $obs);

					$data = date('Y-m-d H:i:s');
									
					$con = connection();
					$query = "INSERT INTO tbl_receitas VALUES (Null, '$id_paciente','$id_medico','$quantidade','$medicameto','$obs', '$data')";
					mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
					$a = mysqli_query($con,$query) ? true : false ;
					if($a){
						echo "<script>swal('Receita gerada com sucesso', '', 'success');</script>";
						?>
					    <script type="text/javascript">
		           			setTimeout("location.href = 'pacientes_consulta.php?Id=<?=$id_paciente;?>&acao=consultar&menu=receituario';", 1500);
		                </script>
					    <?php					
					}         
					else echo "<script>swal('Ocorreu um erro a gerar a receita', '', 'error');</script>";
				}

				if(isset($_GET['menu']) AND $_GET['menu'] == 'receituario') {
					?>
					<script type="text/javascript">
						var counter = 1;
						$(function(){
							$('p#add_field').click(function(){
								counter += 1;
								$('#container').append(
								'<div class="form-row">'
								+ '<div class="form-label col-md-1"><label for="quantidade">Qtd.</label></div>'
								+ '<div class="form-input col-md-1"><input style="width:60px;" min="0" type="number" name="quantidade[]" id="quantidade_' + counter + '" /></div>'
								+ '<div class="form-label col-md-2"><label for="medicameto">Medicamento:</label></div>'
								+ '<div class="form-input col-md-3"><input type="text" name="medicameto[]" id="medicamento_' + counter + '" /></div>'
								+ '<div class="form-label col-md-1"><label for="obs">Obs.</label></div>'
								+ '<div class="form-input col-md-4"><input type="text" name="obs[]" id="obs_' + counter + '" /></div>'
								+'</div>'
								);
							});
						});
					</script>
					<?php
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
											<h2 class='text-center'>Receituário</h2><br><hr>";
								            $queryR  = 'SELECT * FROM tbl_receitas WHERE id_paciente = '.$Id.'';
								            $resultR = mysqli_query($con, $queryR);
								            $fetchR  = mysqli_fetch_row($resultR);

								            if( $fetchR[1] == $Id ) 
								            	echo "	<div class='row'>
											                    ";
																				else
																					echo "
																					<div class='row'>
																		            	<div>
																		            		<div class='form-label col-md-1'>
																		            			<label for='quantidade'>
																		            				Qtd.
																		            			</label>
																		            		</div>
																		            		<div class='form-input col-md-1'>
																		            			<input style='width:60px;' min='0' type='number' name='quantidade[]' id='quantidade_1' />
																		            		</div>
																		            		<div class='form-label col-md-2'>
																		            			<label for='medicameto'>
																		            				Medicamento:
																		            			</label>
																		            		</div>
																		            		<div class='form-input col-md-3'>
																		            			<input type='text' name='medicameto[]' id='medicameto_1' />
																		            		</div>
																		            		<div class='form-label col-md-1'>
																		            			<label for='obs'>
																		            				Obs.
																		            			</label>
																		            		</div>
																		            		<div class='form-input col-md-4'>
																		            			<input type='text' name='obs[]' id='obs_1' />
																		            		</div>
																		            	</div>						            		
																					</div>
																		            <div class='row'>
																		            	<div id='container'>
																		            		
																		            	</div>						            		
																					</div><br>
																					<div>
																						<p id='add_field' style='width:8%;'>
																							<a style='background-color:#149900; color: #fff;' class='medium btn small' href='#'>
																								<span class='button-content'>+ itens</span>
																							</a></p>
																					</div>		   

																					<br><br><br>	
																		            <div class='row text-center'>
																		                <button class='btn medium bg-blue small' name='add_receita' style='margin-top:10px;'>
																						    <span class='button-content'>GERAR RECEITA</span>
																						</button>
																		                <input type='reset' value'LIMPAR TUDO' class='btn medium bg-red small' name='#' style='width: 85px; margin-top:10px;'/>
																					</div>		
																				</div>		                
																			</form>
																</div>";
									$queryT = "SELECT id_paciente FROM tbl_receitas WHERE id_paciente = '$Id'";
							        $resultado = mysqli_query($con, $queryT);
							        $totLinhas = mysqli_num_rows($resultado);
								        if($totLinhas > 0){
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Médico</th>
												<th>Data Receitada</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT 
													tbl_receitas.id_receita as id_receita,
													tbl_paciente.Id as id_paciente, 
													tbl_paciente.nome as nome_paciente,
													tbl_users.display_name as nome_medico,
													tbl_receitas.data_receita as data
													FROM `tbl_receitas` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_receitas.id_paciente) 
													inner join tbl_users 
													on(tbl_receitas.medico=tbl_users.id) WHERE tbl_receitas.id_paciente = '$Id'";
										
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_receita=1&id_receita=".$row['id_receita']."' class='tooltip-button' data-placement='top' title='Ver'>".$row['nome_medico']."</a>
												</td>
												<td>
													<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_receita=1&id_receita=".$row['id_receita']."' class='tooltip-button' data-placement='top' title='Ver'>".$row['data']."</a></td>
												<td>
													<form method='get' action='pacientes_consulta.php'>
													";
													echo "
														<a target='_blank' href='imprimir/imprimir_receita.php?id=".$row['id_receita']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Imprimir'>
															<i class='glyph-icon icon-print'></i>
														</a>
														<!--<a href='pacientes_consulta.php?Id=".$row['id_paciente']."&acao=consultar&ver_receita=1&id_receita=".$row['id_receita']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
															<i class='glyph-icon icon-eye'></i>
														</a>-->
													</form>
												</td>
											</tr>";}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novo_receituario'>
									    <span class='button-content'>
									    	Novo Receituário
									    </span>
									    <i class='glyph-icon icon-plus'></i>
									</button><br><br><br>
									";
								}
											    		die();
				}
				if(isset($_GET['receituario'])) {
					$receituario = $_GET['receituario'];
					if ($receituario == 2) {
					?>

					<script type="text/javascript">
						var counter = 1;
						$(function(){
							$('p#add_field').click(function(){
								counter += 1;
								$('#container').append(
								'<div class="form-row">'
								+ '<div class="form-label col-md-1"><label for="quantidade">Qtd.</label></div>'
								+ '<div class="form-input col-md-1"><input min="0" type="number" name="quantidade[]" id="quantidade_' + counter + '" /></div>'
								+ '<div class="form-label col-md-2"><label for="medicameto">Medicamento:</label></div>'
								+ '<div class="form-input col-md-3"><input type="text" name="medicameto[]" id="medicamento_' + counter + '" /></div>'
								+ '<div class="form-label col-md-1"><label for="obs">Obs.</label></div>'
								+ '<div class="form-input col-md-4"><input type="text" name="obs[]" id="obs_' + counter + '" /></div>'
								+'</div>'
								);
							});
						});
					</script>

					<?php
					include('medico/menu.php');
		    		echo"
								<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
									<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
										<h2 class='text-center'>Editar Receituário</h2><br><hr>										
						</form>";
						$query = "SELECT DISTINCT
						tbl_paciente.nome as nome_paciente, 
						tbl_medico.nome as nome_medico,
						tbl_tratamentos_recomendacoes.tratamentos as trat,
						tbl_tratamentos_recomendacoes.recomendacoes as rec,
						tbl_tratamentos_recomendacoes.data_criada as data
						FROM `tbl_tratamentos_recomendacoes` 
						inner join tbl_paciente 
						on(tbl_paciente.Id=tbl_tratamentos_recomendacoes.id_paciente) 
						inner join tbl_medico 
						on(tbl_tratamentos_recomendacoes.id_medico=tbl_medico.id_medico) WHERE tbl_tratamentos_recomendacoes.id_paciente = $Id";
							
						$resultP=mysqli_query($con,$query);
						$rowP=mysqli_fetch_row($resultP);
						
						echo "
							<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>							
								<div class='row'>
									<div>
										<div class='form-label col-md-1'>
											<label for='quantidade'>
												Qtd.
											</label>
										</div>
										<div class='form-input col-md-1'>
											<input min='0' type='number' name='quantidade[]' id='quantidade_1' />
										</div>
										<div class='form-label col-md-2'>
											<label for='medicameto'>
												Medicamento:
											</label>
										</div>
										<div class='form-input col-md-3'>
											<input type='text' name='medicameto[]' id='medicameto_1' />
										</div>
										<div class='form-label col-md-1'>
											<label for='obs'>
												Obs.
											</label>
										</div>
										<div class='form-input col-md-4'>
											<input type='text' name='obs[]' id='obs_1' />
										</div>
									</div>						            		
								</div>
								<div class='row'>
									<div id='container'>
										
									</div>						            		
								</div><br>
								<div>
									<p id='add_field'>
										<a style='background-color:#149900; color: #fff;' class='medium btn small' href='#'>
											<span class='button-content'>+ itens</span>
										</a></p>
								</div>		   

								<br><br><br>	
								<div class='row text-center'>
									<button class='btn medium bg-blue small' name='edicao_da_receita' style='margin-top:10px;'>
										<span class='button-content'>EDITAR RECEITA</span>
									</button>
								</div>		
							</div>	
							</form>
						</div>
						";
		    		die();
					}
					die();
				}

				if (isset($_POST['edicao_da_receita'])){
					$id_paciente = $_GET['Id'];
					$id_medico = $loggedInUser->user_id;

					$quantidade = $_POST['quantidade'];	
					$quantidade = implode(",", $quantidade);
					
					$medicameto = $_POST['medicameto'];	
					$medicameto = implode(",", $medicameto);

					$obs = $_POST['obs'];	
					$obs = implode(",", $obs);
					
						$con=connection();				    
						$query = "UPDATE tbl_receitas SET 
						medico='$id_medico',
						quantidade='$quantidade',
						medicamento='$medicameto',
						observacao='$obs'
						WHERE id_paciente = '$id_paciente'";						
						$a=mysqli_query($con,$query) ? true : false ;
						if($a){
								echo "<script>swal('Receita atualizada com sucesso', '', 'success');</script>";
								//echo "<script>document.location.href = 'pacientes_consulta.php?Id=$Id&acao=consultar&menu=receituario';</script>";	     
						}
						else { 
						echo "<script>swal('Ocorreu um erro ao atualizar a receita', '', 'error');</script>";
						//echo "<script>document.location.href = 'pacientes_consulta.php?Id=$Id&acao=consultar&menu=receituario';</script>";					
					}         

				}
		    	if (isset($_POST['novo_receituario'])) {
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
											<h2 class='text-center'>Receituário</h2><br><hr>";
											echo "
																					<div class='row'>
																		            	<div>
																		            		<div class='form-label col-md-1'>
																		            			<label for='quantidade'>
																		            				Qtd.
																		            			</label>
																		            		</div>
																		            		<div class='form-input col-md-1'>
																		            			<input min='0' type='number' name='quantidade[]' id='quantidade_1' />
																		            		</div>
																		            		<div class='form-label col-md-2'>
																		            			<label for='medicameto'>
																		            				Medicamento:
																		            			</label>
																		            		</div>
																		            		<div class='form-input col-md-3'>
																		            			<input type='text' name='medicameto[]' id='medicameto_1' />
																		            		</div>
																		            		<div class='form-label col-md-1'>
																		            			<label for='obs'>
																		            				Obs.
																		            			</label>
																		            		</div>
																		            		<div class='form-input col-md-4'>
																		            			<input type='text' name='obs[]' id='obs_1' />
																		            		</div>
																		            	</div>						            		
																					</div>
																		            <div class='row'>
																		            	<div id='container'>
																		            		
																		            	</div>						            		
																					</div><br>
																					<div>
																						<p id='add_field'>
																							<a style='background-color:#149900; color: #fff;' class='medium btn small' href='#'>
																								<span class='button-content'>+ itens</span>
																							</a></p>
																					</div>		   

																					<br><br><br>	
																		            <div class='row text-center'>
																		                <button class='btn medium bg-blue small' name='add_receita' style='margin-top:10px;'>
																						    <span class='button-content'>GERAR RECEITA</span>
																						</button>
																		                <input type='reset' value'LIMPAR TUDO' class='btn medium bg-red small' name='#' style='width: 85px; margin-top:10px;'/>
																					</div>		
																				</div>		                
																			</form>
																</div>";
																?>
																<script type="text/javascript">
																	var counter = 1;
																	$(function(){
																		$('p#add_field').click(function(){
																			counter += 1;
																			$('#container').append(
																			'<div class="form-row">'
																			+ '<div class="form-label col-md-1"><label for="quantidade">Qtd.</label></div>'
																			+ '<div class="form-input col-md-1"><input min="0" type="number" name="quantidade[]" id="quantidade_' + counter + '" /></div>'
																			+ '<div class="form-label col-md-2"><label for="medicameto">Medicamento:</label></div>'
																			+ '<div class="form-input col-md-3"><input type="text" name="medicameto[]" id="medicamento_' + counter + '" /></div>'
																			+ '<div class="form-label col-md-1"><label for="obs">Obs.</label></div>'
																			+ '<div class="form-input col-md-4"><input type="text" name="obs[]" id="obs_' + counter + '" /></div>'
																			+'</div>'
																			);
																		});
																	});
																</script>
																<?php
																die();
		    	}
				if(isset($_GET['menu']) AND $_GET['menu'] == 'transferencia_justificativo') {
		    		$query="SELECT DISTINCT * FROM tbl_triagem WHERE id_paciente = '$Id'";
		    		$queryP="SELECT DISTINCT * FROM tbl_paciente WHERE Id = '$Id'";
					
					$result=mysqli_query($con,$query);
					$resultP=mysqli_query($con,$queryP);
					
					$row=mysqli_fetch_row($result);
					$rowP=mysqli_fetch_row($resultP);
		    		include('medico/menu.php');
		    		echo"
									<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
										<div class='col-md-9' style='margin:1px solid red;margin-left:10px; margin-top:-40px;'>
								            <h2 class='text-center'>Justificativo</h2><br><hr>";
								            $queryT = "SELECT id_paciente FROM tbl_justificativo_medico WHERE id_paciente = '$Id'";
								            $resultado = mysqli_query($con, $queryT);
								            $totLinhas = mysqli_num_rows($resultado);
									            if($totLinhas > 0) {
									            																	            	
									echo "
									<table class='table' id='example1'>
										<thead>
											<tr>
												<th>Médico</th>
												<th>Data do Justificativo</th>
												<th>Ações</th>
											</tr>
										</thead>
										<tbody>";
										$con=connection();
										$id_usuario=$loggedInUser->user_id;
										$data = date("m.d.Y");
										$query = "	SELECT 
													tbl_justificativo_medico.id_justificativo_medico as id_justificativo,
													tbl_paciente.Id as id_paciente,
													tbl_paciente.nome as nome_paciente, 
													tbl_users.display_name as nome_medico,
													tbl_justificativo_medico.data_cadastro as data
													FROM `tbl_justificativo_medico` 
													inner join tbl_paciente 
													on(tbl_paciente.Id=tbl_justificativo_medico.id_paciente) 
													inner join tbl_users 
													on(tbl_justificativo_medico.id_medico=tbl_users.id) WHERE tbl_justificativo_medico.id_paciente = $Id";
										//var_dump($query);
										$result=mysqli_query($con,$query);
										while($row=mysqli_fetch_array($result)) 
										{
										echo "<tr>
												<td>
													<a href='pacientes_consulta.php?Id=".$row['id_justificativo']."&acao=consultar&ver_justificativo=1&id_justificativo=".$row['id_justificativo']."' class='tooltip-button' data-placement='top' title='Ver'>".$row['nome_medico']."</a>
												</td>
												<td>
												<a href='pacientes_consulta.php?Id=".$row['id_justificativo']."&acao=consultar&ver_justificativo=1&id_justificativo=".$row['id_justificativo']."' class='tooltip-button' data-placement='top' title='Ver'>".$row['data']."</a></td>
												<td>
												<form method='get' action='pacientes_consulta.php'>
												";
													echo "
													<a href='imprimir/imprimir_justificativo_medico.php?id=".$row['id_justificativo']."' target='_blank' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Imprimir'>
												        <i class='glyph-icon icon-print'></i>
													</a>	
													<a href='pacientes_consulta.php?Id=$Id&acao=consultar&ver_justificativo=1&id_justificativo=".$row['id_justificativo']."' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Ver'>
														<i class='glyph-icon icon-eye'></i>
													</a>										
												</form>
												</td>
											</tr>";
										}
										echo "	
										</tbody>
									</table>
									<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='novo_justificativo'>
									    <span class='button-content'>
									    	Novo Justificativo
									    </span>
									    <i class='glyph-icon icon-plus'></i>
									</button><br><br>";
									            }
												else
										echo"
											</div>		
											<div class='row'>
												<div class='form-label col-md-2'>
													<label for='qtd_dias'>
														Quantidade de dias:
													</label>
												</div>
												<div class='form-input col-md-1'>
													<input min='1' type='number' name='qtd_dias' id='nome' onfocus='searchVendor()'>
												</div>
												<div class='form-label col-md-1'>
													<label for='cid_doenca'>
														CID:
													</label>
												</div>
												<div class='form-input col-md-3'>
													<input type='text' name='cid_doenca' id='nome' onfocus='searchVendor()'>
												</div>
											</div>										

											<div class='row text-center'>
												<button class='btn medium bg-blue small' name='salvar_justificativo_medico' style='margin-top:10px;'>
													<span class='button-content'>SALVAR</span>
												</button>
											</div>
								
										</form>
									</div>
									";
		    		die();
				}
				
				if(isset($_GET['transferecencia_justificativo'])) {
					$transferecencia_justificativo = $_GET['transferecencia_justificativo'];
												
					if ($transferecencia_justificativo == 2) {
							
							
						include('medico/menu.php');
			    		echo"
							<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
								<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
									<h2 class='text-center'>Justificativo</h2><br><hr>										
							</form>";
							$query = "SELECT 
										tbl_paciente.nome as nome_paciente, 
										tbl_medico.nome as nome_medico, 
										tbl_justificativo_medico.qtd_dias as qtd_dias, 
										tbl_justificativo_medico.cid_doenca as cid_doenca 
										FROM `tbl_justificativo_medico` 
										inner join 
										tbl_paciente on(tbl_paciente.Id=tbl_justificativo_medico.id_paciente) 
										inner join 
										tbl_medico on(tbl_justificativo_medico.id_medico=tbl_medico.id_medico) 
										WHERE tbl_justificativo_medico.id_paciente = $Id";
						$resultP=mysqli_query($con,$query);

						$rowP=mysqli_fetch_row($resultP);

						
							echo"
							<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>
								<input type='hidden' name='Id' value='$Id'>
								<div class='row'>
									<div class='form-label col-md-2'>
										<label for='qtd_dias'>
											Quantidade de dias:
										</label>
									</div>
									<div class='form-input col-md-1'>
										<input min='1' type='number' value='".$rowP[2]."' name='qtd_dias' id='nome' onfocus='searchVendor()'>
									</div>
									<div class='form-label col-md-1'>
										<label for='cid_doenca'>
											CID:
										</label>
									</div>
									<div class='form-input col-md-3'>
										<input type='text' name='cid_doenca' value='".$rowP[3]."' id='nome' onfocus='searchVendor()'>
									</div>
								</div>	
								<br>
								<button class='btn primary-bg medium' name='editar_transferencia_justificativo'>
									<span class='button-content'>Editar</span>
									<i class='glyph-icon icon-save'></i>
								</button>
							</form>         
							</div>
							";
			    		die();
						}
						die();
				}

				if(isset($_POST['novo_justificativo'])) {

						include('medico/menu.php');
			    		echo"
							<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
								<div class='col-md-9' style='margin-left:10px; margin-top:-40px;'>
									<h2 class='text-center'>Justificativo</h2><br><hr>	";
							echo"
											</div>		
											<div class='row'>
												<div class='form-label col-md-2'>
													<label for='qtd_dias'>
														Quantidade de dias:
													</label>
												</div>
												<div class='form-input col-md-1'>
													<input min='1' type='number' name='qtd_dias' id='nome' onfocus='searchVendor()'>
												</div>
												<div class='form-label col-md-1'>
													<label for='cid_doenca'>
														CID:
													</label>
												</div>
												<div class='form-input col-md-3'>
													<input type='text' name='cid_doenca' id='nome' onfocus='searchVendor()'>
												</div>
											</div>										

											<div class='row text-center'>
												<button class='btn medium bg-blue small' name='salvar_justificativo_medico' style='margin-top:10px;'>
													<span class='button-content'>SALVAR</span>
												</button>
											</div>
								
										</form>
									</div>
									";
			    		die();
				}
				
				$query="SELECT * FROM tbl_paciente WHERE Id = '$Id'";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_row($result);
				include('medico/menu.php');
									echo"
						</div>
							</form>
							"; die();
							}		
						}

				echo "
				<table class='table' id='example1'>
					<thead>
						<tr>
							<th>&nbsp;&nbsp;Nome do Paciente</th>
							<th>Serviço</th>
							<th>idade</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>";
					$con=connection();
					$id_usuario=$loggedInUser->user_id;
					$data = date("m.d.Y");
					$data_atual = date('Y')."-" . date('m') . "-" .date('d');

					$query = "	SELECT 
									tbl_paciente.Id, 
									tbl_paciente.nome, 
									tbl_agenda.servicos,
									(TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade  
								FROM `tbl_agenda` 
								inner join tbl_paciente on(tbl_paciente.Id=tbl_agenda.id_paciente) 
								WHERE 
								(
									id_medico=$id_usuario AND 
									agendado= 1 AND 
									(
										(pagou = 1 || pagou_sgerais = 1) AND triado = 1 
										OR 
										( pagou_estomatologia = 1 || pagou_exames = 1  AND triado = 1)
									) 
									AND tbl_agenda.data='$data_atual' AND tbl_paciente.atendido_medico = 0
								) 
								OR
								(
									id_medico=$id_usuario AND 
									agendado= 1 AND 
									(
										((TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) >= 0) AND ((TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) <= 9) 
										OR
										((TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) >= 60)
									)
									AND
									(
										(pagou = 0) AND triado = 1 
									) 
									AND tbl_agenda.data='$data_atual' AND tbl_paciente.atendido_medico = 0
								)
								";

					

					/*$query = "	SELECT 
									tbl_paciente.Id, 
									tbl_paciente.nome, 
									tbl_agenda.servicos,
									(TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade  
								FROM `tbl_agenda` 
								inner join tbl_paciente on(tbl_paciente.Id=tbl_agenda.id_paciente) 
								WHERE 
								(
									id_medico=$id_usuario AND 
									agendado = 1 AND 
									((pagou = 1 || pagou_sgerais = 1) AND triado = 1 OR ( pagou_estomatologia = 1 || pagou_exames = 1  AND triado = 1)) 
									AND tbl_agenda.data='$data_atual' AND tbl_paciente.atendido_medico = 0
								) ) ";*/


					$result=mysqli_query($con,$query);
					while($row=mysqli_fetch_array($result)) 
					{
						echo "<tr>
								<td>".utf8_encode($row['nome'])."</td>
								<td>".utf8_encode($row['servicos'])."</td>
								<td>".utf8_encode($row['idade'])."</td>
								<td>
								<form method='get' action='pacientes_consulta.php'>
								";
									echo "
									<a href='pacientes_consulta.php?Id=".$row['Id']."&acao=consultar' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Consultar'>
										<i class='glyph-icon icon-arrow-right'></i>
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