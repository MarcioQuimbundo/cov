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
		
		if ($acao == 'apagar') {
			$query="DELETE FROM tbl_consultorio WHERE id_consultorio='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Consultório Removido Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao remover o consultório','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_consultorio WHERE id_consultorio = '$Id'";
			$result=mysqli_query($con,$query);
			$resultMM=mysqli_query($con,$query);
			$rowMMM=mysqli_fetch_row($resultMM);

			$queryMMM="SELECT * FROM tbl_users WHERE title = 'doctor'";
			$resultMMM=mysqli_query($con,$queryMMM);

			$queryEsp="SELECT * FROM tbl_especialidade";
			$resultEsp=mysqli_query($con,$queryEsp);

			while($row=mysqli_fetch_array($result)){
			echo "
			<h2>Editar consultório</h2>
			<a href='consultorios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
			    <span class='button-content'>Voltar</span>
			    <i class='glyph-icon icon-arrow-left'></i>
			</a><br>
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
				    <span class='button-content'>Actualizar</span>
					   <i class='glyph-icon icon-save'></i>
				</button>
			</form>         
				";
			die();
			}
		}
		if ($acao == 'ver') {
			$query="SELECT nome, id_especialidade FROM tbl_consultorio WHERE id_consultorio = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			$id_especialidade = $row[1];

			$queryEsp="SELECT nome FROM tbl_especialidade WHERE id_especialidade = '$id_especialidade'";
			$resultEsp=mysqli_query($con,$queryEsp);
			$rowEsp=mysqli_fetch_row($resultEsp);
			echo "
			<div id='regbox'>
			<a href='consultorios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>
			<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[0]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nome'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$rowEsp[0]</h4>
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

		    $query = "UPDATE tbl_consultorio SET nome='$nome', id_especialidade=$especialidade WHERE id_consultorio = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a) echo "<script>swal('Consulório Actualizado Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao actualizar o consultório','','error');</script>";
		    }

		}	


		if (isset($_POST['add'])) {
			$nome=$_POST['nome']; 
			$especialidade=$_POST['especialidade']; 
			$data = date('Y-m-d H:i:s');
		    if (empty($nome)) {
		        echo "<script>swal('Preencha Todos Os Campos','','error');</script>";
		    }else{

		    $con=connection();

		    $query = "INSERT INTO tbl_consultorio VALUES (null, '$nome', $especialidade, '$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a) echo "<script>swal('Consultório Adicionado Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao adicionar o consultório','','error');</script>";
		    }
		}	



	if (isset($_POST['add_novo_consultorio'])) {
		$con = connection();		
		$query="SELECT * FROM tbl_users WHERE title = 'doctor' and id != 2";
		$result=mysqli_query($con,$query);

		$queryEsp="SELECT * FROM tbl_especialidade";
		$resultEsp=mysqli_query($con,$queryEsp);
echo "

<h2>Cadastro de consultório</h2>
<a href='consultorios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
    <span class='button-content'>Voltar</span>
    <i class='glyph-icon icon-arrow-left'></i>
</a><br>
<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome'>
                        Nome:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' required='required' name='nome' id='nome' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Especialidade'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select required='required' name='especialidade' class='form-control'>
			                            <option value='' selected='selected'>-- Selecione --</option>
			                            ";  
										while($rowEsp=mysqli_fetch_array($resultEsp)){
											echo"<option value='".$rowEsp['id_especialidade']."' >".$rowEsp['nome']."</option>";
				                 		}                          
	                     			echo"                                  
			                    </select>
			                </div>
			            </div>
<br>

<button style='background-color: #149900; color: #fff;' class='btn medium' name='add'>
    <span class='button-content'>Cadastrar</span>
    <i class='glyph-icon icon-save'></i>
</button>
</form>         
";
	}else{

?>



<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Código</th>
			<th>Consultório</th>
			<th>Especialidade</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_consultorio";
	$result=mysqli_query($con,$query);



	while($row=mysqli_fetch_array($result))
	{

	echo "<tr>
			<td>".$row['id_consultorio']."</td>
			<td><a href='consultorios.php?Id=".$row['id_consultorio']."&acao=ver '>".utf8_encode($row['nome'])."</a></td>
			<td>	
				<a href='consultorios.php?Id=".$row['id_consultorio']."&acao=ver '>";
				$id_especialidade = $row['id_especialidade'];
				$queryM="SELECT nome FROM tbl_especialidade WHERE id_especialidade = '$id_especialidade' ";
				//var_dump($queryM);
				$resultM=mysqli_query($con,$queryM);

				while ($rowM = mysqli_fetch_array($resultM)) {
					echo utf8_encode($rowM['nome']);
				}

				echo "
				</a>
			<td>
			<form method='get' action='consultorios.php'>
				<a href='consultorios.php?Id=".$row['id_consultorio']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='consultorios.php?Id=".$row['id_consultorio']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
			    <a href='consultorios.php?Id=".$row['id_consultorio']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
			        <i class='glyph-icon icon-remove'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='consultorios.php'>
	    <a title='Voltar' href='consultorios.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_consultorio' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Novo consultório
	        </button>
	    </a>
        <!--<a style='font-size:15px; padding:6px; background-color: #149900; color: #fff;' title='Imprimir' target='_blank' href='imprimir/imprimir_consultorios.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
            Imprimir
        </a>--><br><br>
<br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
