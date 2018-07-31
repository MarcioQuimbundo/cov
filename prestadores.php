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
<h3>Prestadores</h3>
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
			$query="DELETE FROM tbl_prestadores WHERE id_prestador='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
		           	echo "<script>swal('prestador removido com sucesso','','success');</script>";
		        }
			else echo "<script>swal('Oops! Ocorreu um erro ao remover um prestador','','success');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_prestadores WHERE id_prestador = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2>
							<a href='prestadores.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='$Id'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['nome']."' name='nome' id='nome' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nif'>
			                        NIF:	
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' value='".$row['nif']."' min='0' name='nif' id='nif' onfocus='searchVendor()'>
			                </div>
			            </div> 
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='endereco'>
			                        Endereço:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['endereco']."' min='0' name='endereco' id='endereco' onfocus='searchVendor()'>
			                </div>
			            </div>
			             <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='area_actuacao'>
			                        Area de Actuação:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' value='".$row['area_actuacao']."' min='0' name='area_actuacao' id='area_actuacao' onfocus='searchVendor()'>
			                </div>
			            </div>
			             <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' value='".$row['telefone']."' min='0' name='telefone' id='telefone' onfocus='searchVendor()'>
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
			                    <label for='descricao'>
			                        Descrição:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                	<textarea rows='4' cols='8'name='descricao' id='descricao'>
										".$row['obs']."
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
			$query="SELECT * FROM tbl_prestadores WHERE id_prestador = '$Id'";
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
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº Conselho'>
			                       NIF :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div><br>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº Conselho'>
			                       Endereço :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div><br>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº Conselho'>
			                       Area de Actuação :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
			                </div>
			            </div><br>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº Conselho'>
			                       Telefone :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[5]</h4>
			                </div>
			            </div><br>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº Conselho'>
			                       E-Mail :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[6]</h4>
			                </div>
			            </div><br>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº Conselho'>
			                       Descrisão :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[7]</h4>
			                </div>
			            </div><br>
			            <button style='float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='voltar'>
						    <span class='button-content'>Voltar</span>
						    <i class='glyph-icon icon-arrow-left'></i>
						</button>
			</form>
			"; die();
		    		}		
		}
		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'prestadores.php';</script>";
		}

		if (isset($_POST['editar'])) {
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
		    $nif=$_POST['nif']; 
		    $endereco = $_POST['endereco'];
		    $area_actuacao=$_POST['area_actuacao'];
		    $telefone=$_POST['telefone'];
		    $email=$_POST['email'];
		    $obs=$_POST['descricao'];

		    if (empty($nome) || empty($nif)|| empty($endereco)|| empty($area_actuacao)|| empty($telefone)|| empty($nif)|| empty($email)|| empty($obs)) {
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
		    $query = "UPDATE tbl_prestadores SET nome='$nome', nif='$nif',endereco='$endereco',area_actuacao='$area_actuacao',telefone='$telefone',email='$email',obs='$obs' WHERE id_prestador = '$id'";
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		           	echo "<script>swal('Prestador actualizado com sucesso', '', 'success');</script>";
		           	//echo "<script>document.location.href = 'prestadores.php';</script>";
		            }
		    else echo "<script>swal('Oops! Ocorreu um erro ao atualizar o prestador de serviço','','error');</script>";
		    }
		}	
		if (isset($_POST['add_novo'])) {
			$nome=$_POST['nome']; 
		    $nif=$_POST['nif']; 
		    $endereco = $_POST['endereco'];
		    $area_actuacao=$_POST['area_actuacao'];
		    $telefone=$_POST['telefone'];
		    $email=$_POST['email'];
		    $obs=$_POST['descricao'];

		    if (empty($nome) || empty($nif)|| empty($endereco)|| empty($area_actuacao)|| empty($telefone)|| empty($nif)|| empty($email)|| empty($obs)) {
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

		    $query = "INSERT INTO tbl_prestadores VALUES (NULL, '$nome','$nif','$endereco','$area_actuacao','$telefone','$email','$obs')";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
				echo "<script>swal('Prestador adicionado com sucesso','','success');</script>";
		               	//echo "<script>document.location.href = 'prestadores.php';</script>";
		            }
		    else echo "<script>swal('Ocorreu um erro ao adicionar o prestador de serviço'','error');</script>";
		    }
		}	
	if (isset($_POST['add_novo_prestador'])) {
echo "
<h2>Cadastro de Prestadores</h2>
							<a href='prestadores.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
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
			                    <input required='required' type='text'  name='nome' id='nome' onfocus='searchVendor()'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nif'>
			                        NIF:	
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number'  min='0' name='nif' id='nif' onfocus='searchVendor()'>
			                </div>
			            </div> 
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='endereco'>
			                        Endereço:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text'  min='0' name='endereco' id='endereco' onfocus='searchVendor()'>
			                </div>
			            </div>
			             <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='area_actuacao'>
			                        Area de Actuação:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text'  min='0' name='area_actuacao' id='area_actuacao' onfocus='searchVendor()'>
			                </div>
			            </div>
			             <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='telefone'>
			                        Telefone:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' min='0' name='telefone' id='telefone' onfocus='searchVendor()'>
			                </div>
			            </div>
			            
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='email'>
			                        E-mail:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='email'  min='0' name='email' id='email'>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                        Descrição:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                	<textarea rows='4' cols='8'name='descricao' id='descricao'>
										
		    					</textarea>
			                </div>
			            </div>
<br>

<button style='background-color: #149900; color: #fff;' class='btn medium' name='add_novo'>
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
			<th>NIF</th>
			<th>Endereço</th>
			<th>Area de Actuação</th>
			<th>Telefone</th>
			<th>Email</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_prestadores";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td><a href='prestadores.php?Id=".$row['id_prestador']."&acao=ver '>".$row['nome']."</a></td>
			<td>".$row['nif']."</td>
			<td>".$row['endereco']."</td>
			<td>".$row['area_actuacao']."</td>
			<td>".$row['telefone']."</td>
			<td>".$row['email']."</td>
			<td>
			<form method='get' action='prestadores.php'>
				<a href='prestadores.php?Id=".$row['id_prestador']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='prestadores.php?Id=".$row['id_prestador']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
			    <a href='prestadores.php?Id=".$row['id_prestador']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
			        <i class='glyph-icon icon-remove'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='prestadores.php'>
	    <a title='Voltar' href='prestadores.php'>
	       <button style='float:center; font-size:20px; background-color: #149900; color: #fff;' name='add_novo_prestador' class='print large btn popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Novo Prestador
	        </button>
	    </a>
	    <a style='font-size:16px; padding:6px; background-color: #149900; color: #fff;' title='Imprimir' target='_blank' href='imprimir/imprimir_prestadoes.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
        </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
