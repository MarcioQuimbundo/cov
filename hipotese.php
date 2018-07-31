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
<h3>Hipótese</h3>
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
			$query="DELETE FROM tbl_hipotese WHERE id_hipotese='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
		           	echo "<script>alert('Hipótese removida com sucesso');</script>";
		           	echo "<script>document.location.href = 'hipotese.php';</script>";
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
			$query="SELECT * FROM tbl_hipotese WHERE id_hipotese = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Edição da hipótese</h2>
			<a href='hipotese.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_hipotese']."'>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='codigo'>
			                        Código:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' value='".$row['codigo']."' type='text' name='codigo' id='codigo'>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                        Descrição:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' value='".$row['descricao']."' type='text' name='descricao' id='descricao'>
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
			$query="SELECT * FROM tbl_hipotese WHERE id_hipotese = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<h2>Informações da hipótese</h2>
			<a href='hipotese.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
					<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='codigo'>
			                        Código:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                       Descrição :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
					</form>
			"; die();
		    		}		
		}

		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'hipotese.php';</script>";
		}


		if (isset($_POST['add'])) {
			$codigo=$_POST['codigo']; 
			$descricao=$_POST['descricao']; 
			$data_criacao = date('d')."-" . date('m') . "-" .date('Y');
		    if (empty($codigo) || empty($descricao)) {
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

		    $query = "INSERT INTO tbl_hipotese VALUES (Null, '$codigo','$descricao','$data_criacao')";

		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		               	echo "<script>alert('Hipótese adicionada com sucesso');</script>";
		               	echo "<script>document.location.href = 'hipotese.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, a hipótese não foi inserida na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }
		}	

		if (isset($_POST['editar'])) {
			
			$id = $_POST['id_hipotese'];
			$codigo=$_POST['codigo']; 
			$descricao=$_POST['descricao']; 

		    if (empty($codigo) || empty($descricao)) {
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

		    $query = "UPDATE tbl_hipotese SET codigo='$codigo', descricao='$descricao' WHERE id_hipotese = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		           	echo "<script>alert('Hipótese actualizada com sucesso');</script>";
		           	echo "<script>document.location.href = 'hipotese.php';</script>";
		            }
		    else echo "
		                <div class='row'>
		                    <div class='col-md-6'>

		                        <div class='infobox error-bg mrg0A'>
		                            <p>Ocorreu um erro, a hipótese não foi actualizada na base de dados.</p>
		                        </div>
		                    </div>
		                </div>
		            ";

		    }

		}	


	if (isset($_POST['add_novo_produto'])) {
	echo "
	<h2>Nova hipótese</h2><br>
			<a href='hipotese.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='codigo'>
			                        Código:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' min='0' name='codigo' id='codigo'>
			                </div>
						</div>
						
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='descricao'>
			                        Descrição:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' min='0' name='descricao' id='descricao'>
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
			<th>Código</th>
			<th>Descrição</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_hipotese";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['codigo']."</td>
			<td>
				<a href='hipotese.php?Id=".$row['id_hipotese']."&acao=ver '>".$row['descricao']."</a>
			</td>
			<td>
			<form method='get' action='hipotese.php'>
				<a href='hipotese.php?Id=".$row['id_hipotese']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='hipotese.php?Id=".$row['id_hipotese']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
                <a href='hipotese.php?Id=".$row['id_hipotese']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='hipotese.php'>
	    <a title='Novo produto' href='hipotese.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_produto' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-save'></i>
		        Nova Hipótese
	        </button>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
