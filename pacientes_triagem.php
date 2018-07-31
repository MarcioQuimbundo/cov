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

		if (isset($_POST['salvar'])) {
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

			$query="INSERT INTO tbl_triagem VALUES (Null, '$id_paciente','$funcionario','$temperatura','$respiracao','$pulso','$tensao','$tensao2','$peso','$altura','$imc','$estado','$observacao','$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$a = mysqli_query($con,$query) ? true : false ;
			if($a){
				mysqli_query($con,"UPDATE tbl_paciente SET triado=1 WHERE Id = '$id_paciente'");
			    echo "<script>swal('Triagem feita com sucesso','','success');</script>";
			}         
			else echo "<script>swal('Ocorreu um erro a efetuar a triagem','','error');</script>";
		}
		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();
		    if ($acao == 'triar') {
			$query="SELECT 
			Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade, genero, endereco, telefone, nome_parente, telefone_parente,
			id_medico 
			FROM tbl_paciente INNER JOIN tbl_agenda ON (tbl_agenda.id_paciente = tbl_paciente.Id) WHERE Id = '$Id' ORDER BY `tbl_agenda`.`data_agenda` DESC";
			
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);

			$id_medico = $row[8];
			$queryM="SELECT display_name
			FROM tbl_users WHERE id = '$id_medico'";
			$resultM=mysqli_query($con,$queryM);
			$rowM=mysqli_fetch_row($resultM);


			echo "
			<div id='regbox'><br>
			<h2 class='text-center'>Perfil do Paciente</h2><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' value='$row[0]' name = 'id_paciente'>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nome'>
			                        Nome Completo:
			                    </label>
			                </div>
			                <div class='form-input col-md-4' style='border-right:1px solid gray;'>
			                    <h4>".utf8_encode($row[1])."</h4>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='Data de Nascimento'>
			                       Idade :
			                    </label>
			                </div>
			                <div class='form-input col-md-2'>
			                    <h4>$row[2]</h4>
			                </div>

			            </div>
						<div class='form-row'>

			                <div class='form-label col-md-2'>
			                    <label for='Data de Nascimento'>
			                       Gênero:
			                    </label>
			                </div>
			                <div class='form-input col-md-4' style='border-right:1px solid gray;'>
			                    <h4>$row[3]</h4>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='Data de Nascimento'>
			                       Endereço:
			                    </label>
			                </div>
			                <div class='form-input col-md-4'>
			                    <h4>".utf8_encode($row[4])."</h4>
			                </div>


			            </div>
						<div class='form-row'>

			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-4' style='border-right:1px solid gray;'>
			                    <h4>$row[5]</h4>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Nome do Parente:
			                    </label>
			                </div>
			                <div class='form-input col-md-2'>
			                    <h4>".utf8_encode($row[6])."</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Telefone do Parente:
			                    </label>
			                </div>
			                <div class='form-input col-md-4' style='border-right:1px solid gray;'>
			                    <h4>$row[7]</h4>
							</div>
							
							<div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Médico:
			                    </label>
			                </div>
			                <div class='form-input col-md-4' style='border-right:1px solid gray;'>
			                    <h4>".utf8_encode($rowM[0])."</h4>
			                </div>
			            </div>
			            <br>

			            <h2 class='text-center'>Dados Iniciais</h2><br><hr>

			            <div class='row'>
			                <div class='form-label col-md-1'>
			                    <label for='temperatura'>
			                        Temperatura:
			                    </label>
			                </div>
			                <div class='form-input col-md-2' style='border-right:1px solid gray;'>
								<select  name='temperatura' id='temperatura' required='required'>
									<option value=''>-- Selecione --</option>												
										<option value='1'>30º </option>												
										<option value='2'>30,5º </option>												
										<option value='3'>31º </option>												
										<option value='4'>31,5º </option>												
										<option value='5'>32º </option>												
										<option value='6'>32,5º </option>												
										<option value='7'>33º </option>												
										<option value='8'>33,5º </option>												
										<option value='9'>34º </option>												
										<option value='10'>34,5º </option>												
										<option value='11'>35º </option>												
										<option value='12'>35,5º </option>												
										<option value='13'>36º </option>												
										<option value='14'>36,5º </option>												
										<option value='15'>37º </option>												
										<option value='16'>37,5º </option>												
										<option value='17'>38º </option>												
										<option value='18'>38,5º </option>												
										<option value='19'>39º </option>												
										<option value='20'>39,5º </option>												
										<option value='21'>40º </option>												
										<option value='22'>40,5º </option>												
										<option value='23'>41º </option>												
										<option value='24'>41,5º </option>												
										<option value='25'>42º </option>												
										<option value='26'>42,5º </option>											
									</select>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='respiracao'>
			                       Respiração:
			                    </label>
			                </div>
			                <div class='form-input col-md-3' style='border-right:1px solid gray;'>
								<select required='required' name='respiracao' id='respiracao' >
									<option value ='' >-- Selecione --</option>													
									<option value='1'> 5 </option>												
									<option value='2'> 6 </option>												
									<option value='3'> 7 </option>												
									<option value='4'> 8 </option>												
									<option value='5'> 9 </option>												
									<option value='6'> 10 </option>												
									<option value='7'> 11 </option>												
									<option value='8'> 12 </option>												
									<option value='9'> 13 </option>												
									<option value='1'> 14 </option>												
									<option value='1'> 15 </option>												
									<option value='12'> 16 </option>												
									<option value='13'> 17 </option>												
									<option value='14'> 18 </option>												
									<option value='15'> 19 </option>												
									<option value='16'> 20 </option>												
									<option value='17'> 21 </option>												
									<option value='18'> 22 </option>												
									<option value='19'> 23 </option>												
									<option value='20'> 24 </option>												
									<option value='21'> 25 </option>												
									<option value='22'> 26 </option>												
									<option value='23'> 27 </option>												
									<option value='24'> 28 </option>												
									<option value='25'> 29 </option>												
									<option value='26'> 30 </option>												
									<option value='27'> 31 </option>												
									<option value='28'> 32 </option>												
									<option value='29'> 33 </option>												
									<option value='30'> 34 </option>												
									<option value='31'> 35 </option>												
									<option value='32'> 36 </option>												
									<option value='33'> 37 </option>												
									<option value='34'> 38 </option>												
									<option value='35'> 39 </option>												
									<option value='36'> 40 </option>												
									<option value='37'> 41 </option>												
									<option value='38'> 42 </option>												
									<option value='39'> 43 </option>												
									<option value='40'> 44 </option>												
									<option value='41'> 45 </option>												
									<option value='42'> 46 </option>												
									<option value='43'> 47 </option>												
									<option value='44'> 48 </option>												
									<option value='45'> 49 </option>												
									<option value='46'> 50 </option>													
								</select>
			                </div>

			                <div class='form-label col-md-1'>
			                    <label for='pulso'>
			                       Pulso:
			                    </label>
			                </div>
			                <div class='form-input col-md-2'>
								<select required='required' name='pulso' id='pulso' >
									<option value ='' >-- Selecione --</option>
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
									<option value=''>-- Selecione --</option>		
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
									<option value ='' >-- Selecione --</option>
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
								<input type='number' name='peso' id='peso' class='form-control' value='' required='required' onkeyup='calcularIMC()'/>
			                </div>

			            </div>

			            <div class='row'>

			            	 <div class='form-label col-md-1'>
			                    <label for='altura'>
			                        Altura:
			                    </label>
			                </div>
			                <div class='form-input col-md-2' style='border-right:1px solid gray;'>
								<input type='text' name='altura' id='altura'  class='form-control' value='' required='required' autocomplete='off'  onkeyup='calcularIMC()'/>
			                </div>

			                <div class='form-label col-md-2'>
			                    <label for='imc'>
			                        I.M.C:
			                    </label>
			                </div>
			                <div class='form-input col-md-3' style='border-right:1px solid gray;'>
								<input type='text' name='imc' id='imc' class='form-control' value='' required='required' readonly='readonly'/>
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
									<option value ='' >-- Selecione --</option>
									<option value ='1'> Emergência</option>							
									<option value ='2'> Muito Urgente</option>							
									<option value ='3'> Urgente</option>							
									<option value ='4'> Pouco Urgente</option>							
									<option value ='5'> Não Urgente</option>
								</select>
			                </div>
			            </div><br>
			            <div class='row'>
			                <div class='form-input col-md-8'>
			                	<textarea placeholder='OBSERVAÇÃO' name='observacao' class='form-control' rows='6' required='required' ></textarea>
			                </div><br>
			                <button class='btn large bg-green medium' name='salvar'>
							    <span class='button-content'>Salvar</span>
							    <i class='glyph-icon icon-save'></i>
							</button><br><br>
			                <button type='reset' class='btn large primary-bg medium' name='Limpar'>
							    <span class='button-content'>Limpar</span>
							    <i class='glyph-icon icon-eraser'></i>
							</button><br><br>
							<a href='pacientes_triagem.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
							";?>
						<?php	echo"
			            </div>
			</form>
			"; die();
		    }		
		}

		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'pacientes_faturacao.php';</script>";
		}
 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>&nbsp;&nbsp;&nbsp;Nº processo</th>
			<th>&nbsp;&nbsp;&nbsp;Nome do Paciente</th>
			<th>Idade</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT 
				DISTINCT
				Id, 
				nome, 
				tbl_paciente.data,
				(TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) 
				AS 
				idade 
				FROM 
				tbl_paciente 
				INNER JOIN 
				tbl_agenda 
				on(tbl_agenda.id_paciente = tbl_paciente.Id) 
				WHERE (agendado = 1 AND (pagou = 1 || pagou_sgerais = 1 ) AND triado = 0) 
				OR ( (((TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) >= 0) AND ((TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) <= 9)) OR ((TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) >= 60) AND pagou = 0 AND agendado = 1 AND triado = 0 ) AND (tbl_agenda.servicos != 'exames' OR tbl_agenda.servicos != 'gerais') ORDER BY tbl_paciente.data DESC";

	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".utf8_encode($row['Id'])."</td>
			<td>".utf8_encode($row['nome'])."</td>
			<td>".$row['idade']."</td>
			<td>
			<form method='get' action='pacientes_triagem.php'>
			";
				echo "
				<a href='pacientes_triagem.php?Id=".$row['Id']."&acao=triar' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Triar'>
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


