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
<h3>Consultórios</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
<div id='page-content' style='margin-top:-18px;'>"; 
		
		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();

		if ($acao == 'apagar_agenda') {
			$id_agenda = $_GET['id_agenda'];
			$query="DELETE FROM tbl_agenda_medico WHERE id_agenda_medico='$id_agenda'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a) {
				echo "<script>swal('Agenda Removida Com Sucesso','','success');</script>";
				?>
					<script type="text/javascript">
			        	setTimeout("location.href = 'lista_funcionarios.php'", 1500);
			        </script>
				<?php
			} 
		    else echo "<script>swal('Ops! Ocorreu um erro ao remover a agenda','','error');</script>";
		}
		
		if ($acao == 'agendar') {
			$con = connection();		
			$query="SELECT id, display_name FROM tbl_users WHERE title = 'doctor' and id = '$Id' ";
			$result=mysqli_query($con,$query);
			$linha = mysqli_fetch_row($result);

			$query="SELECT id_especialidade FROM tbl_consultorio WHERE id_medico = '$Id'";
			$result=mysqli_query($con,$query);
			$linhaEsp = mysqli_fetch_row($result);
			$id_especialidade = $linhaEsp[0];

			$query="SELECT nome FROM tbl_especialidade WHERE id_especialidade = '$id_especialidade'";
			$result=mysqli_query($con,$query);
			$linhaEspNome = mysqli_fetch_row($result);
			$nomeEspecialidade = $linhaEspNome[0];

			$queryEsp="SELECT * FROM tbl_especialidade";
			$resultEsp=mysqli_query($con,$queryEsp);

		echo "
			<h2>Agendar Funcionário</h2>
			<a href='lista_funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
				<input type='hidden' name='id_medico' value='$Id'>
				<input type='hidden' name='especialidade' value='$nomeEspecialidade'>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='funcionario'>
	                        Funcionário:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input style='font-size: 20px;' type='text' value='$linha[1]' disabled required='required' name='funcionario' id='funcionario' onfocus='searchVendor()'>
	                </div>
	            </div>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='diaDaSemana'>
	                        Dia da semana:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <select id='diaDaSemana' name='diaDaSemana' required='required' class='form-control'>
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
	                    <label for='consultorio'>
	                        Consultório:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <select id='consultorio' name='consultorio' required='required' class='form-control'>
							 <option value='' >-- Selecione --</option>";
							 
							 $query="SELECT id_consultorio, nome FROM tbl_consultorio";
							 $cons=mysqli_query($con,$query);

								while ($row = mysqli_fetch_array($cons)) {
									echo "<option value ='".$row['id_consultorio']."'>".utf8_encode($row['nome'])."</option>";
								}
							 echo "
		             	</select>
	                </div>
				</div>				
				";
				echo"
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='HoraDoInicio'>
	                        Hora do Início:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='time' required='required' name='HoraDoInicio' id='HoraDoInicio' onfocus='searchVendor()'>
	                </div>
	            </div>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='HoraDoFim'>
	                        Hora do Fim:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input type='time' required='required' name='HoraDoFim' id='HoraDoFim' onfocus='searchVendor()'>
	                </div>
	            </div>	            
				<br>
				<button style='background-color: #149900; color: #fff;' class='btn medium' name='agendar'>
				    <span class='button-content'>Agendar</span>
				    <i class='glyph-icon icon-save'></i>
				</button>
			</form>         
			";
			die();
		}

		if ($acao == 'gerir') {
			$con = connection();		
			$query="SELECT id, display_name FROM tbl_users WHERE title = 'doctor' and id = '$Id' ";
			$result=mysqli_query($con,$query);
			$linha = mysqli_fetch_row($result);

			$query="SELECT id_especialidade FROM tbl_consultorio WHERE id_medico = '$Id'";
			$result=mysqli_query($con,$query);
			$linhaEsp = mysqli_fetch_row($result);
			$id_especialidade = $linhaEsp[0];

			$query="SELECT nome FROM tbl_especialidade WHERE id_especialidade = '$id_especialidade'";
			$result=mysqli_query($con,$query);
			$linhaEspNome = mysqli_fetch_row($result);
			$nomeEspecialidade = $linhaEspNome[0];

			$queryEsp="SELECT * FROM tbl_especialidade";
			$resultEsp=mysqli_query($con,$queryEsp);

		echo "
			<h2>Gerir Funcionário</h2>
			<a href='lista_funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			";
		echo "
			<table class='table' id='example1'>
				<thead>
					<tr>
						<th>Dia de Semana</th>
						<th>Consultório</th>
						<th>Hora de Inicio</th>
						<th>Hora do Fim</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>";
				$con=connection();
				$query="SELECT id_agenda_medico, dia_da_semana, hora_do_inicio, hora_do_fim, tbl_consultorio.nome as consultorio FROM tbl_agenda_medico INNER JOIN tbl_consultorio ON (tbl_agenda_medico.consultorio = tbl_consultorio.id_consultorio) WHERE tbl_agenda_medico.id_medico = '$Id'";
				//var_dump($query);
				$result=mysqli_query($con,$query);
				while($row=mysqli_fetch_array($result))
				{
				echo "<tr>
						<td>
							".$row['dia_da_semana']."
						</td>
						<td>
							".$row['consultorio']."
						</td>
						<td>
							".$row['hora_do_inicio']."
						</td>
						<td>
							".$row['hora_do_fim']."
						</td>
						<td>
							<form method='get' action='lista_funcionarios.php'>
								<a href='lista_funcionarios.php?Id=".$Id."&id_agenda=".$row['id_agenda_medico']."&acao=editar_gestao ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
							        <i class='glyph-icon icon-edit'></i>
							    </a>
								<a href='lista_funcionarios.php?Id=".$Id."&id_agenda=".$row['id_agenda_medico']."&acao=apagar_agenda ' class='btn small bg-red tooltip-button' data-placement='top' title='Editar'>
							        <i class='glyph-icon icon-remove'></i>
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
			die();
		}

		if ($acao == 'editar_gestao') {
			$con = connection();		
			$query="SELECT id, display_name FROM tbl_users WHERE title = 'doctor' and id = '$Id' ";
			$result=mysqli_query($con,$query);
			$linha = mysqli_fetch_row($result);

			$query="SELECT id_especialidade FROM tbl_consultorio WHERE id_medico = '$Id'";
			$result=mysqli_query($con,$query);
			$linhaEsp = mysqli_fetch_row($result);
			$id_especialidade = $linhaEsp[0];

			$query="SELECT nome FROM tbl_especialidade WHERE id_especialidade = '$id_especialidade'";
			$result=mysqli_query($con,$query);
			$linhaEspNome = mysqli_fetch_row($result);
			$nomeEspecialidade = $linhaEspNome[0];

			$id_agenda = $_GET['id_agenda'];

			$query="SELECT dia_da_semana, hora_do_inicio, hora_do_fim FROM tbl_agenda_medico WHERE id_agenda_medico = '$id_agenda' and id_medico = '$Id'";
			$result=mysqli_query($con,$query);
			$linhaAgenda = mysqli_fetch_row($result);

		echo "
			<h2>Editar agenda do funcionário</h2>
			<a href='lista_funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
				<input type='hidden' name='id_medico' value='$Id'>
				<input type='hidden' name='id_agenda_medico' value='$id_agenda'>
				<input type='hidden' name='especialidade' value='$nomeEspecialidade'>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='funcionario'>
	                        Funcionário:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input style='font-size: 20px;' type='text' value='$linha[1]' disabled required='required' name='funcionario' id='funcionario' onfocus='searchVendor()'>
	                </div>
	            </div>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='diaDaSemana'>
	                        Dia da semana:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <select id='diaDaSemana' name='diaDaSemana' required='required' class='form-control'>
	    	         		<option value='$linhaAgenda[0]' >$linhaAgenda[0]</option>
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
	                    <label for='consultorio'>
	                        Consultório:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <select id='consultorio' name='consultorio' required='required' class='form-control'>
							 <option value='' >-- Selecione --</option>";
							 
							 $query="SELECT id_consultorio, nome FROM tbl_consultorio";
							 $cons=mysqli_query($con,$query);

								while ($row = mysqli_fetch_array($cons)) {
									echo "<option value ='".$row['id_consultorio']."'>".utf8_encode($row['nome'])."</option>";
								}
							 echo "
		             	</select>
	                </div>
				</div>

	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='HoraDoInicio'>
	                        Hora do Início:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input value='$linhaAgenda[1]' type='time' required='required' name='HoraDoInicio' id='HoraDoInicio' onfocus='searchVendor()'>
	                </div>
	            </div>
	            <div class='form-row'>
	                <div class='form-label col-md-2'>
	                    <label for='HoraDoFim'>
	                        Hora do Fim:
	                    </label>
	                </div>
	                <div class='form-input col-md-6'>
	                    <input value ='$linhaAgenda[2]' type='time' required='required' name='HoraDoFim' id='HoraDoFim' onfocus='searchVendor()'>
	                </div>
	            </div>	            
				<br>
				<button style='background-color: #149900; color: #fff;' class='btn medium' name='edicao_da_agenda'>
				    <span class='button-content'>Editar</span>
				    <i class='glyph-icon icon-save'></i>
				</button>
			</form>         
			";
			die();
		}


		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_consultorio WHERE id_consultorio = '$Id'";
			$result=mysqli_query($con,$query);
			$resultMM=mysqli_query($con,$query);
			$rowMMM=mysqli_fetch_row($resultMM);
			$id_medico = $rowMMM[2];

			$queryMMM="SELECT * FROM tbl_users WHERE title = 'doctor'";
			$resultMMM=mysqli_query($con,$queryMMM);

			$queryEsp="SELECT * FROM tbl_especialidade";
			$resultEsp=mysqli_query($con,$queryEsp);

			while($row=mysqli_fetch_array($result)){
			echo "
			<h2>Editar consultório</h2>
			<a href='lista_funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
				<input type='hidden' name='Id' value='$Id'>
			          <div class='form-row'>
			              <div class='form-label col-md-2'>
			                  <label for='nome'>
			                      Nome:
			                  </label>
			              </div>
			              <div class='form-input col-md-6'>
			                  <input required='required' type='text' value='".$row['nome']."' name='nome' id='nome'>
			              </div>
			          </div>
			          <div class='form-row'>
		                <div class='form-label col-md-2'>
		                    <label for='nome'>
		                        Médico:
		                    </label>
		                </div>
		                <div class='form-input col-md-6'>
	    	         		<select id='medico' name='medico' required='required' class='form-control'>
	        	        	     ";  
									while($rowMM=mysqli_fetch_array($resultMMM)){
										echo"<option value='".$rowMM['id']."' >".$rowMM['display_name']."</option>";
	    	            	 }                          
		                    	 echo"
		             		</select>
                		</div>

		              </div>

		              <div class='form-row'>
		                <div class='form-label col-md-2'>
		                    <label for='nome'>
		                        Especialidade:
		                    </label>
		                </div>
		                <div class='form-input col-md-6'>
	    	         		<select id='especialidade' name='especialidade' required='required' class='form-control'>
	    	         			<option value='' >-- Selecione --</option>
	        	        	     ";  
									while($rowEsp=mysqli_fetch_array($resultEsp)){
										echo"<option value='".$rowEsp['id_especialidade']."' >".$rowEsp['nome']."</option>";
	    	            	 }                          
		                    	 echo"
		             		</select>
                		</div>
		              </div>
				<br>
				<button style='background-color: #149900; color: #fff;' class='btn medium' name='editar'>
				    <span class='button-content'>Agendar</span>
					   <i class='glyph-icon icon-save'></i>
				</button>
			</form>         
				";
			die();
			}
		}
		if ($acao == 'ver') {
			$query="SELECT * FROM tbl_consultorio WHERE id_consultorio = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			$id_medico = $row[2];

				$queryM="SELECT * FROM tbl_medico WHERE id_medico ='$id_medico'";
				$resultM=mysqli_query($con,$queryM);
				$rowM = mysqli_fetch_row($resultM);

			echo "
			<div id='regbox'>
			<a href='lista_funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
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
			                    <label for='Nome'>
			                        Médico:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$rowM[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nome'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>
			</form>
			"; die();
		    		}		
		}
		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'consultorios.php';</script>";
		}

		if (isset($_POST['editar'])) {
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
			$medico=$_POST['medico']; 
			$especialidade=$_POST['especialidade']; 
		    if (empty($nome)) {
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

		    $query = "UPDATE tbl_consultorio SET nome='$nome', id_medico='$medico', id_especialidade=$especialidade WHERE id_consultorio = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		    	echo "<script>swal('Consulório Actualizado Com Sucesso','','success');</script>";
		    	?>
					<script type="text/javascript">
			        	setTimeout("location.href = 'lista_funcionarios.php'", 1500);
			        </script>
				<?php	
		    } 
		    else echo "<script>swal('Ops! Ocorreu um erro ao actualizar o consultório','','error');</script>";
		    }

		}	

		if (isset($_POST['edicao_da_agenda'])) {
			$id_medico = $_POST['id_medico'];
			$funcionario=$_POST['funcionario']; 
			$especialidade=$_POST['especialidade']; 
			$diaDaSemana=$_POST['diaDaSemana']; 
			$consultorio=$_POST['consultorio'];
			$HoraDoInicio=$_POST['HoraDoInicio']; 
			$HoraDoFim=$_POST['HoraDoFim']; 
			$agendadoPor = $loggedInUser->displayname;
			$data = date('Y-m-d H:i:s');
			$idAgendaMedico = $_POST['id_agenda_medico'];

		    $con=connection();

		    $query = "
				    UPDATE 
				    	`tbl_agenda_medico` 
				    SET 
				    	`agendado_por` = '$agendadoPor',
				    	`dia_da_semana` = '$diaDaSemana',
				    	`hora_do_inicio` = '$HoraDoInicio',
				    	`hora_do_fim`	= '$HoraDoFim'
				    WHERE `tbl_agenda_medico`.`id_agenda_medico` = $idAgendaMedico";

			//var_dump($query);

		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a) echo "<script>swal('Agenda editada com sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao agendar o médico','','error');</script>";
		}	

		if (isset($_POST['agendar'])) {
			$id_medico = $_POST['id_medico'];
			$funcionario=$_POST['funcionario']; 
			$especialidade=$_POST['especialidade']; 
			$diaDaSemana=$_POST['diaDaSemana']; 
			$HoraDoInicio=$_POST['HoraDoInicio']; 
			$HoraDoFim=$_POST['HoraDoFim']; 
			$consultorio = $_POST['consultorio'];
			$agendadoPor = $loggedInUser->displayname;
			$data = date('Y-m-d H:i:s');

		    $con=connection();

		    $query = "INSERT INTO tbl_agenda_medico 
		    VALUES (
		    null, 
		    '$id_medico', 
		    '$funcionario', 
		    '$especialidade', 
		    '$diaDaSemana', 
			'$consultorio',
		    '$HoraDoInicio', 
		    '$HoraDoFim', 
		    '$agendadoPor',
		    '',
		    '$data'
			)";

			//var_dump($query);
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a) echo "<script>swal('Médico agendado com sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao agendar o médico','','error');</script>";
		}	

	if (isset($_POST['agendar'])) {
		
	}else{

?>



<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Médico</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT id, display_name FROM tbl_users WHERE title='doctor'";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>	
				<a href='#'>";
					echo utf8_encode($row['display_name']);
				echo "
				</a>
			<td>
			<form method='get' action='lista_funcionarios.php'>
				<a href='lista_funcionarios.php?Id=".$row['id']."&acao=agendar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Agendar Funcionário'>
			        <i class='glyph-icon icon-arrow-right'></i>
			    </a>
				<a href='lista_funcionarios.php?Id=".$row['id']."&acao=gerir ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Gerir Funcionário'>
			        <i class='glyph-icon icon-cog'></i>
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
