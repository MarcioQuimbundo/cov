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
		<h3>Triagem</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

if (isset($_POST['ed'])) {
			$Id = $_POST['id_triagem'];
			$id_paciente = $_POST['id_paciente'];
			$temperatura =$_POST['temperatura']; 
			$respiracao=$_POST['respiracao']; 
			$pulso=$_POST['pulso'];
			$tensao=$_POST["tensao"];
			$tensao2=$_POST['tensao2'];
			$peso=$_POST['peso'];
		    $altura = $_POST['altura'];
		    $imc = $_POST['imc'];
		    $estado = $_POST['estado'];
			$observacao = $_POST['observacao'];
			$data = date('d-m-Y h:i:sa');
			$funcionario = $loggedInUser->displayname;
			
			$con=connection();
			$query="UPDATE tbl_triagem SET id_paciente='$id_paciente',funcionario='$funcionario',temperatura='$temperatura',respiracao='$respiracao',pulso='$pulso',tensao='$tensao',tensao2='$tensao2',peso='$peso',altura='$altura',imc='$imc',estado='$estado',observacao='$observacao',data='$data' WHERE id_triagem='$Id'";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
			    echo "<script>swal('Triagem alterada com sucesso','','success');</script>";
			}         
			else echo "<script>swal('Ocorreu um erro a efetuar actualização da  triagem','','error');</script>";	
	}
	if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();

	

	if ($acao == 'ver') {
		$query="SELECT DISTINCT * FROM tbl_triagem WHERE id_triagem = '$Id'";
					
					$result=mysqli_query($con,$query);
					
					$row=mysqli_fetch_row($result);

					echo"	<br><br>
						
						<a href='pacientes_triados.php'style='padding: 5px; font-size:14px; background-color: #149900; color: #fff;' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Voltar'>
				     		  <span class='glyph-icon icon-arrow-left'></span>
				     		  Voltar
				   		 </a>
						<br>
						<br>
						<br>

					<input type='hidden' value='$rowP[0]' name = 'id_paciente'>
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
							                <div class='form-label col-md-3'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       Tensão Sistólica: $row[6]
							                    </label>
							                </div>
							            </div>
							            <br><br>
							            <div class='row'>
							                
							                <div class='form-label col-md-3'>
							                    <label for='Nome' style='font-size:1.4em; width:145%;'>
							                        Tensão Diastólica: $row[7]
							                    </label>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Nome' style='font-size:1.4em; width:145%;'>
							                        Peso: $row[8]
							                    </label>
							                </div>   
							                <div class='form-label col-md-3'>
							                    <label for='Nome' style='font-size:1.4em; width:145%;'>
							                        Altura: $row[9]
							                    </label>
							                </div>
							                <div class='form-label col-md-3'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       IMC: $row[10]
							                    </label>
							                </div>
							            </div>
							            <br><br>
							             <div class='form-label col-md-3'>
							                    <label for='Data de Nascimento' style='font-size:1.4em; position: relative; left: -10px;'>
							                       Estado: ".utf8_decode($row[11])."
							                    </label>
							                </div
							            </div>
							            <div class='row'>
							                <div class='form-label col-md-12'>
							                    <label for='Data de Nascimento'style='font-size:1.4em;'>
							                       Observação: ".utf8_encode($row[12])."
							                    </label>
							                </div>
							            </div>
						        </div>
						</form>
						</div>
						";
		    		die();
				

	}elseif ($acao='editar') {
		$Id = sanitize($_GET['Id']);
		$con=connection();
		$query = "SELECT * FROM tbl_triagem  WHERE id_triagem = '$Id' ";

					$result=mysqli_query($con,$query);
					
					$row=mysqli_fetch_row($result);

		echo "
		<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
							<a href='pacientes_triados.php'style='padding: 5px; font-size:14px; background-color: #149900; color: #fff;' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Voltar'>
									     		  <span class='glyph-icon icon-arrow-left'></span>
									     		  Voltar
				   		 	</a>
				 <h2 class='text-center'>Dados Iniciais</h2><br><hr>
						<input type='hidden' value='$row[0]' name = 'id_triagem'>
						<input type='hidden' value='$row[1]' name = 'id_paciente'>

			            <div class='row'>
			                <div class='form-label col-md-1'>
			                    <label for='temperatura'>
			                        Temperatura:
			                    </label>
			                </div>
			                <div class='form-input col-md-2' style='border-right:1px solid gray;'>
								<select  name='temperatura' id='temperatura' required='required'>
									<option value='$row[3]'>$row[3]</option>												
										<option value='30'>30º </option>												
										<option value='30,5'>30,5º </option>												
										<option value='31'>31º </option>												
										<option value='31,5'>31,5º </option>												
										<option value='32'>32º </option>												
										<option value='32,5'>32,5º </option>												
										<option value='33'>33º </option>												
										<option value='33,5'>33,5º </option>												
										<option value='34'>34º </option>												
										<option value='34,5º'>34,5º </option>												
										<option value='35'>35º </option>												
										<option value='35,5'>35,5º </option>												
										<option value='36'>36º </option>												
										<option value='36,5'>36,5º </option>												
										<option value='37'>37º </option>												
										<option value='37,'>37,5º </option>												
										<option value='38'>38º </option>												
										<option value='38,5'>38,5º </option>												
										<option value='39'>39º </option>												
										<option value='39,5'>39,5º </option>												
										<option value='40'>40º </option>												
										<option value='40,5'>40,5º </option>												
										<option value='41'>41º </option>												
										<option value='41,5'>41,5º </option>												
										<option value='42'>42º </option>												
										<option value='42,5'>42,5º </option>											
									</select>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='respiracao'>
			                       Respiração:
			                    </label>
			                </div>
			                <div class='form-input col-md-3' style='border-right:1px solid gray;'>
								<select required='required' name='respiracao' id='respiracao' >
									<option value ='$row[4]' >$row[4]</option>													";
								for ($i=0; $i < 50; $i++) { 
										echo"<option value='$i'>$i</option>";
									}		
									echo "											
								</select>
			                </div>

			                <div class='form-label col-md-1'>
			                    <label for='pulso'>
			                       Pulso:
			                    </label>
			                </div>
			                <div class='form-input col-md-2'>
								<select required='required' name='pulso' id='pulso' >
									<option value ='$row[5]' >$row[5]</option>
									";
									for ($i=20; $i < 91; $i++) { 
										echo"<option value='$i'>$i</option>";
									}
							echo"													
							</select>
			                </div>

			            </div>
			            <div class='row'>
			                <div class='form-label col-md-1'>
			                    <label for='tensao'>
			                        T.A Sistólica:
			                    </label>
			                </div>
			                <div class='form-input col-md-2' style='border-right:1px solid gray;'>
								<select  name='tensao' id='tensao' required='required'>
									<option value='$row[6]'>$row[6]</option>		
									";
									for ($i=40; $i < 301; $i++) { 
										echo"<option value='$i'>$i</option>";
									}
							echo"													
									</select>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='tensao2'>
			                        T.A Diastólica:
			                    </label>
			                </div>
			                <div class='form-input col-md-3' style='border-right:1px solid gray;'>
								<select required='required' name='tensao2' id='tensao2' >
									<option value ='$row[7]' >$row[7]</option>
									";
									for ($i=10; $i < 301; $i++) { 
										echo"<option value='$i'>$i</option>";
									}
							echo"
								</select>
			                </div>

			                <div class='form-label col-md-1'>
			                    <label for='peso'>
			                       Peso (kg):
			                    </label>
			                </div>
			                <div class='form-input col-md-2'>
								<input type='number' name='peso' id='peso' class='form-control' value='$row[8]' required='required' onkeyup='calcularIMC()'/>
			                </div>

			            </div>

			            <div class='row'>

			            	 <div class='form-label col-md-1'>
			                    <label for='altura'>
			                        Altura:
			                    </label>
			                </div>
			                <div class='form-input col-md-2' style='border-right:1px solid gray;'>
								<input type='text' name='altura' id='altura'  class='form-control' value='$row[9]' required='required' autocomplete='off'  onkeyup='calcularIMC()'/>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='imc'>
			                        I.M.C:
			                    </label>
			                </div>
			                <div class='form-input col-md-3' style='border-right:1px solid gray;'>
								<input type='text' name='imc' id='imc' class='form-control' value='$row[10]' required='required' readonly='readonly'/>
			                </div>		
			                ";?>
			                <script type="text/javascript">
							function calcularIMC()
							{
								var camp1 = document.getElementById("peso");
								var camp2 = document.getElementById("altura");
								var camp3 = document.getElementById("imc");
							
								if(camp1.value != "" && camp2.value !="")
								{
									var x = camp1.value/(camp2.value*camp2.value);
									camp3.value = Math.round(x);
								}
								else
									{
									camp3.value = 0.0;
									}
							}
							</script>
							<?php
							echo "
			                <div class='form-label col-md-1'>
			                    <label for='estado'>
			                        Estado:
			                    </label>
			                </div>
			                 <div class='form-input col-md-2'>
								<select required='required' name='estado' id='estado'>
									<option value ='$row[11]' >$row[11]</option>
									<option value ='Emergência'> Emergência</option>							
									<option value ='Muito Urgente'> Muito Urgente</option>							
									<option value ='Urgente'> Urgente</option>							
									<option value ='Pouco Urgente'> Pouco Urgente</option>							
									<option value ='Não Urgente'> Não Urgente</option>
								</select>
			                </div>
			            </div><br>
			            <div class='row'>
			                <div class='form-input col-md-8'>
			                	<textarea placeholder='OBSERVAÇÃO' name='observacao' class='form-control' rows='6' required='required' >$row[12]</textarea>
			                </div><br>
			                <button class='btn large bg-green medium' name='ed'>
							    <span class='button-content'>Editar</span>
							    <i class='glyph-icon icon-save'></i>
							</button><br><br>
			                <button type='reset' class='btn large primary-bg medium' name='Limpar'>
							    <span class='button-content'>Limpar</span>
							    <i class='glyph-icon icon-eraser'></i>
							</button><br><br>
			                							
			            </div>
			</form>
			";		die();
	}

}
 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>&nbsp;&nbsp;&nbsp;Nome Completo</th>
			<th>Idade</th>
			<th>&nbsp;&nbsp;&nbsp;Gênero</th>
			<th>&nbsp;&nbsp;&nbsp;Telefone</th>
			<th>&nbsp;&nbsp;&nbsp;Endereço</th>
			<th>&nbsp;&nbsp;&nbsp;Acções</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	//SELECT * FROM tbl_triagem INNER JOIN tbl_paciente on tbl_triagem.id_paciente=tbl_paciente.Id
	$query="SELECT id_triagem, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS data_nasc, genero, telefone, endereco FROM tbl_triagem INNER JOIN tbl_paciente on tbl_triagem.id_paciente=tbl_paciente.Id";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['nome']."</a></td>
			<td>".$row['data_nasc']."</td>
			<td>".$row['genero']."</td>
			<td>".$row['telefone']."</td>
			<td>".$row['endereco']."</td>
			<td>
				<form method='get' action='pacientes_triados.php'>
					<a href='pacientes_triados.php?Id=".$row['id_triagem']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
				        <i class='glyph-icon icon-edit'></i>
				    </a>
				    <a href='pacientes_triados.php?Id=".$row['id_triagem']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
				        <i class='glyph-icon icon-eye'></i>
				    </a>
	              				</form>
			</td>

		</tr>";
	}	echo "	
	</tbody>
</table>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";

?>


