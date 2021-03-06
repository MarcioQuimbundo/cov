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
<h3>Entrada de Produtos na farmácia</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
<div id='page-content' style='margin-top:-18px;'>"; 
		
		if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();
		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'entrada_farmacia.php';</script>";
		}
		if ($acao == 'dar_entrada') {
			$data_cadastro = date('d-m-Y / H:i:s');
			$query="SELECT * FROM tbl_produto_farmacia WHERE id_produto = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<a href='entrada_farmacia.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_produto']."'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='status'>
			                        Data à entrar:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
								<input required='required' style='font-size:20px;' type='text' disabled value='$data_cadastro' name='descricao' id='descricao'>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Produto:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' readonly type='text' value='".$row['nome_comercial']."' name='nome' id='nome'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='quantidade'>
			                        Quantidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' min='0' name='quantidade' id='quantidade'>
			                </div>
			            </div>

			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='local'>
			                        Preço Unitário:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='number' name='preco_unitario' id='preco_unitario'>
			                </div>
			            </div>
			<br>
			<button class='btn primary-bg medium' name='dar_entradaa'>
			    <span class='button-content'>Dar Entrada</span>
			    <i class='glyph-icon icon-save'></i>
			</button>
			</form>         
			";
			die();
		    }
	}
	if (isset($_POST['dar_entradaa'])) {
		$id_produto=$_POST['Id']; 
		$quantidade=$_POST['quantidade']; 
		$preco_unitario=$_POST['preco_unitario'];
		$data = date('Y-m-d H:i:s');
		$user_id=$loggedInUser->user_id;

		$con=connection();
		$query="SELECT qtde FROM tbl_estoque_farmacia WHERE id_produto = '$id_produto'";
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_row($result);

		$atual_qtd = $row[0];
		$total = (int)$atual_qtd + (int)$quantidade;

		/*	-	-	-	-	-	- */
		$queryP="SELECT estoque_maximo FROM tbl_produto_farmacia WHERE id_produto = '$id_produto'";
		$resultP=mysqli_query($con,$queryP);
		$rowP=mysqli_fetch_row($resultP);
		$atual_estoque = $rowP[0];
		$atual_estoque = (int)$atual_estoque;

		if ($total > $atual_estoque) {
			echo "<script>swal('Estoque máximo atingido.', '', 'warning');</script>";
			echo "<script>swal('A quantidade que pretendes inserir é maior que o estoque máximo deste produto.', '', 'error');</script>";
		} else {
		if (empty($quantidade) || empty($preco_unitario)) {
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

		$query = "INSERT INTO tbl_entrada_de_produto_farmacia VALUES (Null, '$id_produto','$quantidade','$preco_unitario','$data','$user_id')";
		mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$a=mysqli_query($con,$query) ? true : false ;
		if($a){
			$e = mysqli_query($con,"UPDATE tbl_estoque_farmacia SET qtde='$total', preco_unitario='$preco_unitario' WHERE id_produto = '$id_produto'");
			echo "<script>swal('Entrada feita Com Sucesso','','success');</script>";		    
				} else echo "<script>swal('Ops! Ocorreu um erro ao adicionar o consultório','','error');</script>";
		}
	}
}	

?><br>
<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Produto</th>
			<th>Estoque mínimo</th>
			<th>Estoque máximo</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_produto_farmacia";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['nome_comercial']."</td>
			<td>".$row['estoque_minimo']."</td>
			<td>".$row['estoque_maximo']."</td>
			<td>
			<form method='get' action='entrada_farmacia.php'>
				<a href='entrada_farmacia.php?Id=".$row['id_produto']."&acao=dar_entrada ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Entrada'>
			        <i class='glyph-icon icon-plus'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
	

?>
