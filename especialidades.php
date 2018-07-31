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
<h3>Especialidades</h3>
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
			$query="DELETE FROM tbl_especialidade WHERE id_especialidade='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Especialidade Removida Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao remover a especialidade','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_especialidade WHERE id_especialidade = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='$Id'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['nome']."' name='nome' id='nome'>
			                </div>
			            </div>

						<br>
						<button style='background-color: #149900;' class='btn primary-bg medium' name='editar'>
						    <span class='button-content'>Actualizar</span>
						    <i class='glyph-icon icon-save'></i>
						</button>
						</form>         
						";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_especialidade WHERE id_especialidade = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'>
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
			            <button style='background-color: #149900;' class='btn primary-bg medium' name='voltar'>
						    <span class='button-content'>Voltar</span>
						    <i class='glyph-icon icon-arrow-left'></i>
						</button>
			</form>
			"; die();
		    		}		
		}
		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'especialidades.php';</script>";
		}

		if (isset($_POST['editar'])) {
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
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

		    $query = "UPDATE tbl_especialidade SET nome='$nome' WHERE id_especialidade = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a) echo "<script>swal('Especialidade Atualizada Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao atualizar a especialidade','','error');</script>";

		    }

		}	


		if (isset($_POST['add'])) {
			$nome=$_POST['nome']; 
		    if (empty($nome)) {
		        echo "<script>swal('Preencha todos os campos','','error');</script>";
		    }else{
		    $con=connection();
		    $data = date('Y-m-d H:i:s');
		    $query = "INSERT INTO tbl_especialidade VALUES (null, '$nome','$data')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Especialidade Adicionada Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao adicionar a especialidade','','error');</script>";

		    }
		}	



	if (isset($_POST['add_novo_Especialidade'])) {
echo "

<h2>Cadastro de especialidades</h2><br>
<a href='especialidades.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
    <span class='button-content'>Voltar</span>
    <i class='glyph-icon icon-arrow-left'></i>
</a><br>
<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome'>
                        Nome:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='nome' id='nome' onfocus='searchVendor()'>
                </div>
            </div>
<br>

<button style='background-color: #149900;' class='btn primary-bg medium' name='add'>
    <span class='button-content'>Salvar</span>
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
			<th>Nome</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_especialidade";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['id_especialidade']."</td>
			<td><a href='especialidades.php?Id=".$row['id_especialidade']."&acao=ver '>".$row['nome']."</a></td>
			<td>
			<form method='get' action='especialidades.php'>
				<a href='especialidades.php?Id=".$row['id_especialidade']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='especialidades.php?Id=".$row['id_especialidade']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
			    <a href='especialidades.php?Id=".$row['id_especialidade']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
			        <i class='glyph-icon icon-remove'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='especialidades.php'>
	    <a title='Voltar' href='especialidades.php'>
	       <button style='background-color: #149900; font-size:20px;' name='add_novo_Especialidade' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Nova Especialidade
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
