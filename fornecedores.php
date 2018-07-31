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
<h3>Fornecedores</h3>
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
			$query="DELETE FROM tbl_fornecedores WHERE id_fornecedor='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Fornecedor Removido Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao remover o fornecedor','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_fornecedores WHERE id_fornecedor = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2><br>
			<a href='fornecedores.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
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
			                    <label for='nif'>
			                        Nif:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['nif']."' name='nif' id='nif'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='number' value='".$row['telefone']."' min='0' name='telefone' id='telefone'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                        E-mail:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='email' value='".$row['email']."' min='0' name='email' id='email'>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='endereco'>
			                        Endereço:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='endereco' value='".$row['endereco']."' min='0' name='endereco' id='endereco'>
			                </div>
			            </div>
			             <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='area_actuacao'>
			                        Area de Actuação
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='area_actuacao' value='".$row['area_actuacao']."' min='0' name='area_actuacao' id='area_actuacao'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                     Descrição :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <textarea rows='4' cols='8'name='descricao[]' id='descricao'>
										".$row['descricao']."
		    					</textarea>
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
			$query="SELECT * FROM tbl_fornecedores WHERE id_fornecedor = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<a href='fornecedores.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
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
			                    <label for='nif'>
			                        Nif:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                       E-mail:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                       Endereço
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[5]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                       Area de Actuação
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[6]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                       Descrição:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[7]</h4>
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
          	echo "<script>document.location.href = 'fornecedores.php';</script>";
		}

		if (isset($_POST['editar'])) {
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
			$nif=$_POST['nif']; 
		    $telefone=$_POST['telefone']; 
		    $email=$_POST["email"];
		    $endereco=$_POST["endereco"];
		    $area_actuacao=$_POST["area_actuacao"];
		    $descricao=$_POST['descricao'];
		    $descricao=implode(" ", $descricao);
		    if (empty($nome) || empty($nif)|| empty($telefone) || empty($email) ||  empty($descricao)||empty($endereco)||empty($area_actuacao)) {
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

		    $query = "UPDATE tbl_fornecedores SET nome='$nome',nif='nif', telefone='$telefone', email='$email',		    endereco='$endereco',area_actuacao='$area_actuacao',descricao='$descricao' WHERE id_fornecedor = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Fornecedor atualizado Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao atualizar o fornecedor','','error');</script>";
		    }

		}	


		if (isset($_POST['add'])) {
			$nome=$_POST['nome']; 
			$nif=$_POST['nif']; 
		    $telefone=$_POST['telefone']; 
		    $email=$_POST["email"];
		    $endereco=$_POST["endereco"];
		    $area_actuacao=$_POST["area_actuacao"];
		    $descricao=$_POST['descricao'];
		    $descricao=implode(" ", $descricao);
		    if (empty($nome) || empty($telefone) || empty($email) ||empty($endereco) ||empty($area_actuacao)|| empty($descricao)) {
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

		    $query = "INSERT INTO tbl_fornecedores VALUES (NULL, '$nome','$nif','$telefone','$email','$endereco','$area_actuacao','$descricao')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a) echo "<script>swal('Fornecedor Adicionado Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao adicionar o fornecedor','','error');</script>";
		    }
		}	



	if (isset($_POST['add_novo_fornecedor'])) {
echo "

			<h2>Cadastro de Fornecedores</h2><br>
			<a href='fornecedores.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
		<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome'>
                        Nome:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='nome' id='nome' onfocus='searchVendor()'>
                </div>
            </div>
             <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nif'>
                        Nif:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='number' min='0' name='nif' id='nif' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='telefone'>
                        Telefone:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='number' min='0' name='telefone' id='telefone' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='email'>
                        E-mail:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='email' id='email' onfocus='searchVendor()'>
                </div>
            </div>
			<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='endereco'>
               		Endereço
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='endereco' id='endereco'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='area_actuacao'>
               		Area de Actuação	
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='area_actuacao' id='area_actuacao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
                     Descrição :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                     <textarea rows='4' cols='8'name='descricao[]' id='descricao'>
		    		 </textarea>
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
			<th>Nome</th>
			<th>Nif</th>
			<th>Telefone</th>
			<th>E-mail</th>
			<th>Endereço</th>
			<th>Area de Actuação</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_fornecedores";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>	
			<td><a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver '>".$row['nome']."</a></td>
			<td><a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver '>".$row['nif']."</a></td>
			<td><a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver '>".$row['telefone']."</a></td>
			<td><a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver '>".$row['email']."</a></td>
			<td><a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver '>".$row['endereco']."</a></td>
			<td><a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver '>".$row['area_actuacao']."</a></td>
			<td>
			<form method='get' action='fornecedores.php'>
				<a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
			    <a href='fornecedores.php?Id=".$row['id_fornecedor']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
			        <i class='glyph-icon icon-remove'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='fornecedores.php'>
	    <a title='Novo Fornecedor' href='fornecedores.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_fornecedor' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Novo Fornecedor
	        </button>
	    </a>
	    <a style='font-size:15px; padding:6px;background-color: #149900; color: #fff;' title='Imprimir' target='_blank' href='imprimir/imprimir_fornecedores.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
        </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>

