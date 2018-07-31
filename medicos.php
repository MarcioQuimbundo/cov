<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/
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
<h3>Médicos</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
<div id='page-content' style='margin-top:-18px;'>"; 
		
		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();
		if ($acao == 'apagar') {
			$query="DELETE FROM tbl_medico WHERE id_medico='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
		           	echo "<script>alert('Médico removido com sucesso');</script>";
		           	echo "<script>document.location.href = 'medicos.php';</script>";
		        }
			else echo "
			<div class='row'>
				<div class='col-md-6'>
		            <div class='infobox error-bg mrg0A'>
		        	    <p>Ocorreu um erro!</p>
		            </div>
		        </div>
		       </div>
			";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_medico WHERE id_medico = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_medico']."'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['nome']."' name='nome' id='nome'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='sexo'>
			                        Gênero:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select id='sexo' name='sexo'class='form-control'>
			                            <option value='".$row['sexo']."' selected='selected'>".$row['sexo']."</option>                          
			                            <option value='Masculino'>Masculino</option>'                            
			                            <option value='Femenino'>Femenino</option>'                            
			                    </select>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                        E-mail:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['email']."' name='email' id='email'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['telefone']."' name='telefone' id='telefone'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Especialidade'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select name='especialidade' class='form-control'>
			                            <option value='".$row['especialidade']."'selected='selected'>".$row['especialidade']."</option>
			                            <option value='Não aplicavel'>Não aplicavel</option>'                            
			                            <option value='Análise Clínica'>Análise Clínica</option>'                            
			                            <option value='Cardiologia'>Cardiologia</option>'                            
			                            <option value='Clínica Geral'>Clínica Geral</option>'                            
			                            <option value='Defectólogia'>Defectólogia</option>'                            
			                            <option value='Ecónoma'>Ecónoma</option>'                            
			                            <option value='Emangiologia'>Emangiologia</option>'                            
			                            <option value='Estomatologia'>Estomatologia</option>'                            
			                            <option value='Farmácia'>Farmácia</option>'                                  
			                            <option value='Fisioterapia'>Fisioterapia</option>'                                  
			                            <option value='Logista'>Logista</option>'                                  
			                            <option value='Medicina'>Medicina</option>'                                  
			                            <option value='Medicina Interna'>Medicina Interna</option>'                                  
			                            <option value='Neorologia'>Neorologia</option>'                                  
			                            <option value='Oncologia'>Oncologia</option>'                                  
			                            <option value='Ortopedia'>Ortopedia</option>'                                  
			                            <option value='Ortopedia & Traumatologia'>Ortopedia & Traumatologia</option>'                                  
			                            <option value='Ortoprotesia'>Ortoprotesia</option>'                                  
			                            <option value='Psicóloga'>Psicóloga</option>'                                  
			                            <option value='Psicoterapia'>Psicoterapia</option>'                                  
			                            <option value='Radiologia'>Radiologia</option>'                                  
			                            <option value='Urologia'>Urologia</option>'                                  
			                    </select>
			                </div>
			            </div>

			<br>

			<button class='btn primary-bg medium' name='editar'>
			    <span class='button-content'>Actualizar</span>
			    <i class='glyph-icon icon-save'></i>
			</button>
			</form>         
			";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_medico WHERE id_medico = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<h2>Informações Pessoais</h2>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='processo'>
			                        Nº :
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
			                    <label for='Gênero'>
			                       Gênero :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='E-mail'>
			                       E-mail :
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

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Especialidade'>
			                       Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[5]</h4>
			                </div>
			            </div><br>
			            <button class='btn primary-bg medium' name='voltar'>
						    <span class='button-content'>Voltar</span>
						    <i class='glyph-icon icon-arrow-left'></i>
						</button>
			</form>
			"; die();
		    		}		
		}

		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'medicos.php';</script>";
		}


		if (isset($_POST['add'])) {
			$nome=$_POST['nome']; 
		    $sexo=$_POST['sexo']; 
		    $email=$_POST["email"];
		    $telefone=$_POST['telefone'];
		    $especialidade=$_POST['especialidade'];
		    if (empty($nome) || empty($sexo) || empty($email) || empty($telefone) || empty($especialidade)) {
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

		    $query = "INSERT INTO tbl_medico VALUES ('', '$nome','$sexo','$email','$telefone','$especialidade')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		    echo "
		                <div class='row'>
		                    <div class='col-md-4'>
		                        <div class='infobox success-bg'>
		                            <p>Médico adicionado com sucesso.</p>
		                        </div>
		                    </div>
		                </div>
		                ";
		               	echo "<script>alert('Médico adicionado com sucesso');</script>";
		               	echo "<script>document.location.href = 'medicos.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, o médico não foi inserido na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }
		}	

		if (isset($_POST['editar'])) {
			
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
		    $sexo=$_POST['sexo']; 
		    $email=$_POST["email"];
		    $telefone=$_POST['telefone'];
		    $especialidade=$_POST['especialidade'];

		    if (empty($nome) || empty($sexo) || empty($email) || empty($telefone) || empty($especialidade)) {
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

		    $query = "UPDATE tbl_medico SET nome='$nome', sexo='$sexo',email='$email',telefone='$telefone',especialidade='$especialidade' WHERE id_medico = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		           	echo "<script>alert('Médico actualizado com sucesso');</script>";
		           	echo "<script>document.location.href = 'medicos.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, o médico não foi actualizado na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }

		}	


	if (isset($_POST['add_novo_medico'])) {
	echo "

	<h2>Informações Iniciais</h2><br>
	<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' name='nome' id='nome'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='sexo'>
			                        Gênero:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select id='sexo' name='sexo'class='form-control'>
			                            <option value='' selected='selected'>-- Selecione --</option>                          
			                            <option value='Masculino'>Masculino</option>'                            
			                            <option value='Femenino'>Femenino</option>'                            
			                    </select>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                        E-mail:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' name='email' id='email'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' name='telefone' id='telefone'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Especialidade'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select name='especialidade' class='form-control'>
			                            <option value=''selected='selected'>Selecione Uma Especialidade</option>
			                            <option value='Não aplicavel'>Não aplicavel</option>'                            
			                            <option value='Análise Clínica'>Análise Clínica</option>'                            
			                            <option value='Cardiologia'>Cardiologia</option>'                            
			                            <option value='Clínica Geral'>Clínica Geral</option>'                            
			                            <option value='Defectólogia'>Defectólogia</option>'                            
			                            <option value='Ecónoma'>Ecónoma</option>'                            
			                            <option value='Emangiologia'>Emangiologia</option>'                            
			                            <option value='Estomatologia'>Estomatologia</option>'                            
			                            <option value='Farmácia'>Farmácia</option>'                                  
			                            <option value='Fisioterapia'>Fisioterapia</option>'                                  
			                            <option value='Logista'>Logista</option>'                                  
			                            <option value='Medicina'>Medicina</option>'                                  
			                            <option value='Medicina Interna'>Medicina Interna</option>'                                  
			                            <option value='Neorologia'>Neorologia</option>'                                  
			                            <option value='Oncologia'>Oncologia</option>'                                  
			                            <option value='Ortopedia'>Ortopedia</option>'                                  
			                            <option value='Ortopedia & Traumatologia'>Ortopedia & Traumatologia</option>'                                  
			                            <option value='Ortoprotesia'>Ortoprotesia</option>'                                  
			                            <option value='Psicóloga'>Psicóloga</option>'                                  
			                            <option value='Psicoterapia'>Psicoterapia</option>'                                  
			                            <option value='Radiologia'>Radiologia</option>'                                  
			                            <option value='Urologia'>Urologia</option>'                                  
			                    </select>
			                </div>
			            </div>

			<br>


	<br>

	<button class='btn primary-bg medium' name='add'>
	    <span class='button-content'>Cadastrar</span>
	    <i class='glyph-icon icon-save'></i>
	</button>
	</form>         
	";
	}else{
?><br>
<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nº</th>
			<th>&nbsp;&nbsp;&nbsp;Nome</th>
			<th>Gênero</th>
			<th>E-mail</th>
			<th>&nbsp;&nbsp;&nbsp;Telefone</th>
			<th>&nbsp;&nbsp;&nbsp;Especialidade</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_medico";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['id_medico']."</td>
			<td>
				<a href='medicos.php?Id=".$row['id_medico']."&acao=ver '>".$row['nome']."</a>
			</td>
			<td>".$row['sexo']."</td>
			<td>".$row['email']."</td>
			<td>".$row['telefone']."</td>
			<td>".$row['especialidade']."</td>
			<td>
			<form method='get' action='medicos.php'>
				<a href='medicos.php?Id=".$row['id_medico']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='medicos.php?Id=".$row['id_medico']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
                <a href='medicos.php?Id=".$row['id_medico']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='medicos.php'>
	    <a title='Novo Médico' href='medicos.php'>
	       <button style='font-size:20px;' name='add_novo_medico' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-save'></i>
		        Novo Médico
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
