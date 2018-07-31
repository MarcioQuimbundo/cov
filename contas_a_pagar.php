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
<h3>Contas a pagar</h3>
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
			$query="DELETE FROM tbl_contas_a_pagar WHERE id_contas='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Conta Removida Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao remover a conta','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_contas_a_pagar WHERE id_contas = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_contas']."'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='vencimento'>
			                        Vencimento:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='date' value='".$row['vencimento']."' name='vencimento' id='vencimento'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='tipo'>
			                        Tipo:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['tipo']."' name='tipo' id='tipo'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                        Descrição:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' value='".$row['descricao']."' name='descricao' id='descricao'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='valor'>
			                        valor:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='number' min='0' value='".$row['valor']."' name='valor' id='valor'>
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
			$query="SELECT * FROM tbl_contas_a_pagar WHERE id_contas = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<h2>Informações Pessoais</h2>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='vencimento'>
			                        vencimento:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Tipo'>
			                       Tipo :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Descrição'>
			                       Descrição :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='valor'>
			                       valor:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
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
          	echo "<script>document.location.href = 'contas_a_pagar.php';</script>";
		}


		if (isset($_POST['add'])) {
			$vencimento=$_POST['vencimento']; 
		    $tipo=$_POST['tipo']; 
		    $descricao=$_POST["descricao"];
		    $valor=$_POST['valor'];
		    if (empty($vencimento) || empty($tipo) || empty($descricao) || empty($valor)) {
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
		    $con = connection();
			mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $query = "INSERT INTO tbl_contas_a_pagar VALUES ('', '$vencimento','$tipo','$descricao','$valor')";

		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a) echo "<script>swal('Conta Adicionada Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao adicionar a conta','','error');</script>";
		}	

		if (isset($_POST['editar'])) {
			
			$id = $_POST['Id'];
			$vencimento=$_POST['vencimento']; 
		    $tipo=$_POST['tipo']; 
		    $descricao=$_POST["descricao"];
		    $valor=$_POST['valor'];

		    if (empty($vencimento) || empty($tipo) || empty($descricao) || empty($valor)) {
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

		    $query = "UPDATE tbl_contas_a_pagar SET vencimento='$vencimento', tipo='$tipo',descricao='$descricao',valor='$valor' WHERE id_contas = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a) echo "<script>swal('Conta Actualizada Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao actualizar a conta','','error');</script>";
		    }

		}	


	if (isset($_POST['add_nova_conta'])) {
	echo "

	<h2>Informações Iniciais</h2><br>
	<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='vencimento'>
			                        Vencimento:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='date' name='vencimento' id='vencimento'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='tipo'>
			                        Tipo:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' name='tipo' id='tipo'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                       	Descrição
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='text' name='descricao' id='descricao'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='valor'>
			                        valor:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input type='number' min='0' name='valor' id='valor'>
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
			<th>Vencimento</th>
			<th>Tipo</th>
			<th>Descrição</th>
			<th>Valor</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_contas_a_pagar";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['id_contas_a_pagar']."</td>
			<td>
				<a href='contas_a_pagar.php?Id=".$row['id_contas_a_pagar']."&acao=ver '>".$row['vencimento']."</a>
			</td>
			<td>
				<a href='contas_a_pagar.php?Id=".$row['id_contas_a_pagar']."&acao=ver '>".$row['tipo']."</a>
			</td>
			<td>".$row['descricao']."</td>
			<td>".$row['valor']."</td>
			<td>
			<form method='get' action='contas_a_pagar.php'>
				<a href='contas_a_pagar.php?Id=".$row['id_contas_a_pagar']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='contas_a_pagar.php?Id=".$row['id_contas_a_pagar']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
                <a href='contas_a_pagar.php?Id=".$row['id_contas_a_pagar']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='contas_a_pagar.php'>
	    <a title='Nova Conta' href='contas_a_pagar.php'>
	       <button style='font-size:20px;' name='add_nova_conta' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-save'></i>
		        Nova Conta
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
