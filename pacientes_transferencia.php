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
		<h3>Tranferências</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

if (isset($_POST['pacientes_transferencia'])){
					$con = connection();
					$id_paciente = sanitize($_POST['id_paciente']);
					$id_medico = sanitize($_POST['profissional']);
					
					if (empty($id_medico) || empty($id_medico)  ) {
				        echo "
				                            <script>swal('Paciente não foi Transferido, preencha todos os campos!');</script>
				            ";
					}else{
						$query="
							UPDATE 
							tbl_agenda SET 
							id_medico = '$id_medico'
							WHERE id_paciente = '$id_paciente'";
							//var_dump($query);
						$result=mysqli_query($con,$query);

						//var_dump($result);
						if($result){

							mysqli_query($con,"UPDATE tbl_paciente SET agendado=1 WHERE Id = '$id_paciente'");
					    	echo "<script>swal('Paciente Transferido com sucesso!','','success');</script>";
						}
					}
				
				}			
	if(isset($_GET['Id']))
	{
						$acao = sanitize($_GET['acao']);
						$Id = sanitize($_GET['Id']);
						$con=connection();
						if ($acao == 'transferir') {
								
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
			
							$queryPaciAgenda = mysqli_query($con, "SELECT hora, data, id_medico, tipo_servicos FROM tbl_agenda WHERE id_paciente = '$Id'");
							$linhaPA = mysqli_fetch_array($queryPaciAgenda);
			?>	
							<form name='newHospital' class='form-bordered' action='pacientes_transferencia.php' method='post'>
								<div class='form-row'>
									<a href='pacientes_cadastrados.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
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
			
								<script type="text/javascript">
			
									/*	-	-	-	-	-	Mudança de preços	-	-	*/
								
										function mudaMedico() {
			
											var xmlhttp = new XMLHttpRequest();
												xmlhttp.open("GET", "ajaxMedicoT.php?especialidade=" + document.getElementById('especialidade').value, false);
			
											xmlhttp.send(null);
											//document.getElementById("medico").value = '';
			
											document.getElementById("medico").innerHTML = xmlhttp.responseText;
										}
								</script>
								<br/>
								<br/>
								<br/>
								<br/>
								<br/>
								<div style="margin-left:300px;">
									<button name="pacientes_transferencia" style="background-color: #149900; color: white" class="medium btn float-left popover-button-header hidden-mobile mrg15R tooltip-button'">
										<span>Transferir</span>
									</button>
								</div>  <br><br><br>			
							</form>    	
				
	<?php
		}				
	}else	{
				$query="SELECT * FROM tbl_paciente WHERE Id = '$Id'";
				$result=mysqli_query($con,$query);
				$row=mysqli_fetch_row($result);
			
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
								(agendado AND tbl_paciente.atendido_medico=0) ";


					$result=mysqli_query($con,$query);
					while($row=mysqli_fetch_array($result)) 
					{
						echo "<tr>
								<td>".$row['nome']."</td>
								<td>".$row['servicos']."</td>
								<td>".$row['idade']."</td>
								<td>
								<form method='get' action='pacientes_tranferencia.php'>
								";
									echo "
									<a href='pacientes_transferencia.php?Id=".$row['Id']."&acao=transferir' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='transferir'>
										<i class='glyph-icon icon-arrow-right'></i>
									</a>
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

}						
?>
	
	