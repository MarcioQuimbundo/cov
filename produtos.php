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
<h3>Produtos</h3>
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
			$query="DELETE FROM tbl_produto WHERE id_produto='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
					$query="DELETE FROM tbl_estoque WHERE id_produto='$Id'";
                    $a=mysqli_query($con,$query) ? true : false ;
					echo "<script>swal('Produto removido com sucesso','','success');</script>";
		        }
			else echo "<script>swal('Oops! Ocorreu um erro ao remover o produto','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_produto WHERE id_produto = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Edição do produto</h2>
							<a href='produtos.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_produto']."'>
					    <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='status'>
			                        Status:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
								<select required='required' id='estado' name='status'class='form-control'>
										<option value=''selected='selected'>-- Selecione --</option>                          
										<option value='Activo'>Activo</option>'                            
										<option value='Inactivo'>Inactivo</option>'                            
								</select>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                        Produto:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' min='0' name='produto' id='produto'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='estoque_minimo'>
			                       	Estoque Mínimo
			                    </label>
			                </div>
			                
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' name='estoque_minimo' id='estoque_minimo'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='estoque_maximo'>
			                       	Estoque Máximo
			                    </label>
			                </div>
			                
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' name='estoque_maximo' id='estoque_maximo'>
			                </div>
			            </div>
						<br>
			<button style='background-color: #149900; color: #fff;' class='btn medium' name='editar'>
			    <span class='button-content'>Actualizar</span>
			    <i class='glyph-icon icon-refresh'></i>
			</button>
			</form>         
			";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_produto WHERE id_produto = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<h2>Informações do produto</h2>
							<a href='produtos.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
					<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Status'>
			                        Status:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Produto'>
			                       Produto :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Estoque Mínimo :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Estoque Máximo :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
			                </div>
			            </div>
					</form>
			"; die();
		    		}		
		}

		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'produtos.php';</script>";
		}


		if (isset($_POST['add'])) {
			$status=$_POST['status']; 
			$descricao=$_POST['descricao'];
			$preco_u=$_POST['preco_u'];
			$estoque_minimo=$_POST['estoque_minimo']; 
			$estoque_maximo=$_POST['estoque_maximo']; 
			
		    if (empty($status) || empty($descricao) || empty($estoque_minimo)|| empty($estoque_maximo)||empty($preco_u)) {
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
			$id_user=$loggedInUser->user_id;
		    $query = "INSERT INTO tbl_produto VALUES (Null, '$status','$descricao','$estoque_minimo','$estoque_maximo','$id_user',now())";
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
				mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
						$a = mysqli_query($con,"INSERT INTO tbl_estoque VALUES (Null,LAST_INSERT_ID(), 0,'$preco_u')");
		               	echo "<script>swal('Produto adicionado com sucesso', '', 'success');</script>";

		            }
		    else echo "<script>swal('Oops! Ocorreu um erro ao adicionar o produto','','error');</script>";

		    }
		}	

		if (isset($_POST['editar'])) {
			
			$id = $_POST['id_produto'];
			$status=$_POST['status']; 
			$descricao=$_POST['descricao'];
		    $estoque_minimo=$_POST['estoque_minimo']; 
		    $estoque_maximo=$_POST["estoque_maximo"];

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
		    $query = "UPDATE tbl_produto SET status='$status', descricao='$descricao', estoque_minimo='$estoque_minimo', estoque_minimo='$estoque_maximo' WHERE id_produto = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		           	echo "<script>swal('Produto actualizado com sucesso', '', 'success');</script>";
		            }
		    else echo "<script>swal('Oops! Ocorreu um erro ao actualizar o produto','','error');</script>";
		    }
		}	


	if (isset($_POST['add_novo_produto'])) {
	$data_cadastro = date('d-m-Y / H:i:s'); 
	echo "
	<h2>Novo produto</h2><br>
							<a href='produtos.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='status'>
			                        Data à cadastrar:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
								<input required='required' style='font-size:20px;' type='text' disabled value='$data_cadastro' name='descricao' id='descricao'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='status'>
			                        Status:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
								<select required='required' id='estado' name='status'class='form-control'>
										<option value=''selected='selected'>-- Selecione --</option>                          
										<option value='Ativo'>Ativo</option>'                            
										<option value='Inativo'>Inativo</option>'                            
								</select>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                        Produto:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' min='0' name='descricao' id='descricao'>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='preco_u'>
			                        Preço Unitario:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' min='0' name='preco_u' id='preco_u'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='estoque_minimo'>
			                       	Estoque Mínimo
			                    </label>
			                </div>
			                
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' name='estoque_minimo' id='estoque_minimo'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='estoque_maximo'>
			                       	Estoque Máximo
			                    </label>
			                </div>
			                
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' name='estoque_maximo' id='estoque_maximo'>
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
			<th>Status</th>
			<th>Produto</th>
			<th>Estoque Mínimo</th>
			<th>Estoque Máximo</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$id_user=$loggedInUser->user_id;

	//echo $loggedInUser->title;

	if ($loggedInUser->title == 'admin') {
		$query="SELECT * FROM tbl_produto";
	} else {
		$query="SELECT * FROM tbl_produto where id_user='$id_user'";
	}
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>
				<a href='produtos.php?Id=".$row['id_produto']."&acao=ver '>".$row['status']."</a>
			</td>
			<td>
				<a href='produtos.php?Id=".$row['id_produto']."&acao=ver '>".$row['descricao']."</a>
			</td>
			<td>
				<a href='produtos.php?Id=".$row['id_produto']."&acao=ver '>".$row['estoque_minimo']."</a>
			</td>
			<td>
				<a href='produtos.php?Id=".$row['id_produto']."&acao=ver '>".$row['estoque_maximo']."</a>
			</td>
			<td>
			<form method='get' action='produtos.php'>
				<a href='produtos.php?Id=".$row['id_produto']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='produtos.php?Id=".$row['id_produto']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
                <a href='produtos.php?Id=".$row['id_produto']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='produtos.php'>
	    <a title='Novo produto' href='produtos.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_produto' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-plus'></i>
		        Novo Produto
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
