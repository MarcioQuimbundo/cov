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
<h3>Locais</h3>
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
			$query="DELETE FROM tbl_itens WHERE id_itens='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
		           	echo "<script>alert('Item removida com sucesso');</script>";
		           	echo "<script>document.location.href = 'itens.php';</script>";
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
			$query="SELECT * FROM tbl_itens WHERE id_itens = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_itens']."'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='date' value='".$row['nome']."' name='nome' id='nome'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='quantidade'>
			                        Quantidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='number' min='0' value='".$row['quantidade']."' name='quantidade' id='quantidade'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='local'>
			                        Local:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['local']."' name='local' id='local'>
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
			$query="SELECT * FROM tbl_itens WHERE id_itens = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<h2>Informações do item/produto</h2>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='quantidade'>
			                       Quantidade :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Local'>
			                       Local :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
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
          	echo "<script>document.location.href = 'itens.php';</script>";
		}


		if (isset($_POST['add'])) {
			$nome=$_POST['nome']; 
		    $quantidade=$_POST['quantidade']; 
		    $local=$_POST["local"];
		    if (empty($nome) || empty($quantidade) || empty($local)) {
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

		    $query = "INSERT INTO tbl_itens VALUES ('', '$nome','$quantidade','$local')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		    echo "
		                <div class='row'>
		                    <div class='col-md-4'>
		                        <div class='infobox success-bg'>
		                            <p>Item adicionado com sucesso.</p>
		                        </div>
		                    </div>
		                </div>
		                ";
		               	echo "<script>alert('Item adicionado com sucesso');</script>";
		               	echo "<script>document.location.href = 'itens.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, o item não foi inserido na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }
		}	

		if (isset($_POST['editar'])) {
			
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
		    $quantidade=$_POST['quantidade']; 
		    $local=$_POST["local"];

		    if (empty($nome) || empty($quantidade) || empty($local)) {
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

		    $query = "UPDATE tbl_itens SET nome='$nome', quantidade='$quantidade',local='$local' WHERE id_itens = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		           	echo "<script>alert('Item actualizado com sucesso');</script>";
		           	echo "<script>document.location.href = 'itens.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, o item não foi actualizado na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }

		}	


	if (isset($_POST['add_novo_item'])) {
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
			                    <label for='quantidade'>
			                        Quantidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='number' min='0' name='quantidade' id='quantidade'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='local'>
			                       	Local
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' name='local' id='local'>
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
			<th>ID</th>
			<th>Nome</th>
			<th>Quantidade</th>
			<th>Local</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_itens";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['id_itens']."</td>
			<td>
				<a href='itens.php?Id=".$row['id_itens']."&acao=ver '>".$row['nome']."</a>
			</td>
			<td>
				<a href='itens.php?Id=".$row['id_itens']."&acao=ver '>".$row['quantidade']."</a>
			</td>
			<td>".$row['local']."</td>
			<td>
			<form method='get' action='itens.php'>
				<a href='itens.php?Id=".$row['id_itens']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='itens.php?Id=".$row['id_itens']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
                <a href='itens.php?Id=".$row['id_itens']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='itens.php'>
	    <a title='Novo Local' href='itens.php'>
	       <button style='font-size:20px;' name='add_novo_item' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-save'></i>
		        Novo Local
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
