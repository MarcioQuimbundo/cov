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
<h3>Seguro de Saúde</h3>
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
			$query="DELETE FROM tbl_seguro_saude WHERE id_seguro_saude='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
		           	echo "<script>swal('Seguro removido com sucesso','','success');</script>";
		        }
			else echo "<script>swal('Oops! Ocorreu um erro ao remover o seguro','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_seguro_saude WHERE id_seguro_saude = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2>
							<a href='seguro_saude.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='$Id'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='empresa'>
			                        Empresa:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['empresa']."' name='empresa' id='empresa'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='registro_ans'>
			                        NIF:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' value='".$row['registo_ANS']."' min='0' name='registro_ans' id='registro_ans'>
			                </div>
			            </div>
			<br>
			<button style='background-color: #149900; color: #fff;' class='btn medium' name='editar'>
			    <span class='button-content'>Editar</span>
			    <i class='glyph-icon icon-save'></i>
			</button>
			</form>         
			";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_seguro_saude WHERE id_seguro_saude = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'>
			<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
					<div class='form-row'>
			       	    <div class='form-label col-md-2'>
			                <label for='Empresa'>
			                    Empresa:
			                </label>
			            </div>
			            <div class='form-input col-md-6'>
			                <h4>$row[1]</h4>
			            </div>
		            </div>
					<div class='form-row'>
		                <div class='form-label col-md-2'>
			                <label for='registro_ans'>
			                    NIF :
			                </label>
			            </div>
			            <div class='form-input col-md-6'>
			                <h4>$row[2]</h4>
			            </div>
			        </div><br>
		            <button style='background-color: #149900; color: #fff;' class='btn medium' name='voltar'>
					    <span class='button-content'>Voltar</span>
					    <i class='glyph-icon icon-arrow-left'></i>
				
					</button>
			</form>
			"; die();
		    		}		
		}
		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'seguro_saude.php';</script>";
		}

		if (isset($_POST['editar'])) {
			$id = $_POST['Id'];
			$empresa=$_POST['empresa']; 
		    $registro_ans=$_POST['registro_ans']; 
		    if (empty($empresa) || empty($registro_ans)) {
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

		    $query = "UPDATE tbl_seguro_saude SET empresa='$empresa', registo_ans='$registro_ans' WHERE id_seguro_saude = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		           	echo "<script>swal('Seguro actualizado com sucesso');</script>";
		           	//echo "<script>document.location.href = 'seguro_saude.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, seguro não foi actualizado na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }

		}	


		if (isset($_POST['add'])) {
			$empresa=$_POST['empresa']; 
		    $registro_ans=$_POST['registro_ans']; 
		    if (empty($empresa) || empty($registro_ans)) {
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

		    $query = "INSERT INTO tbl_seguro_saude VALUES ('', '$empresa','$registro_ans')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		               	echo "<script>swal('Seguro de Saúde adicionado com sucesso', '', 'success');</script>";
		               	//echo "<script>document.location.href = 'seguro_saude.php';</script>";
		            }
		    else echo "<script>swal('Oops! Ocorreu um erro ao adicionar o seguro','','error');</script>";
		    }
		}	
if (isset($_POST['add_novo_seguro'])) {
echo "
<h2>Cadastro de Seguro de Saúde</h2>
							<a href='seguro_saude.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='empresa'>
                        Empresa:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='empresa' id='empresa'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='registro_ans'>
                        Registro ANS:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='number' min='0' name='registro_ans' id='registro_ans'>
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
			<th>Empresa</th>
			<th>NIF</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con = connection();
	$query="SELECT * FROM tbl_seguro_saude";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['id_seguro_saude']."</td>
			<td><a href='seguro_saude.php?Id=".$row['id_seguro_saude']."&acao=ver '>".$row['empresa']."</a></td>
			<td>".$row['registo_ANS']."</td>
            <td>
            <form method='get' action='seguro_saude.php'>
                <a href='seguro_saude.php?Id=".$row['id_seguro_saude']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
                    <i class='glyph-icon icon-edit'></i>
                </a>
                <a href='seguro_saude.php?Id=".$row['id_seguro_saude']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
                    <i class='glyph-icon icon-eye'></i>
                </a>
                <a href='seguro_saude.php?Id=".$row['id_seguro_saude']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
            </form>
            </td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='seguro_saude.php'>
	    <a title='Voltar' href='seguro_saude.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_seguro' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Novo Seguro
	        </button>
	    </a>
	    <a style='font-size:15px; padding:6px; background-color: #149900; color: #fff;' title='Imprimir' target='_blank' href='imprimir/imprimir_seguros.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
        </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}
		
?>
