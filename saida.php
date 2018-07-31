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
<h3>Itens/Produtos</h3>
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
				echo "<script>swal('Item removido com sucesso','','success');</script>";
		        }
			else echo "<script>swal('Oops! Ocorreu um erro ao remover o item','','error');</script>";
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
			<button style='background-color: #149900; color: #fff;' class='btn medium' name='editar'>
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
			            <button style='background-color: #149900; color: #fff;' class='btn medium' name='voltar'>
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
		               	echo "<script>swal('Item adicionado com sucesso','','success');</script>";
		               //	echo "<script>document.location.href = 'itens.php';</script>";
		            }
		    else echo "<script>swal('Opps! Ocorreu um erro ao adicionar o item','','error');</script>";
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
		           	echo "<script>swal('Item actualizado com sucesso','','success');</script>";
		           	//echo "<script>document.location.href = 'itens.php';</script>";
		            }
		    else echo "<script>swal('Oops! Ocorreu um erro ao atualizar o item','','error');</script>";
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
	<button style='background-color: #149900; color: #fff;' class='btn medium' name='add'>
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
				<a href='itens.php?Id=".$row['id_itens']."&acao=editar ' class='btn small bg-red tooltip-button' data-placement='top' title='Tirar'>
			        <i class='glyph-icon icon-minus'></i>
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
