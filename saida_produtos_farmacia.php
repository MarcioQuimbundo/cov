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
<h3>Saida de produtos da farmácia</h3>
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
          	echo "<script>document.location.href = 'saida_produtos_farmacia.php';</script>";
		}
		if ($acao == 'tirar_produto') {
			$data_cadastro = date('d-m-Y / H:i:s');
			$query="SELECT * FROM tbl_produto_farmacia WHERE id_produto = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
							<a href='saida_produtos_farmacia.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['id_produto']."'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='status'>
			                        Data à sair:
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
			                    <input readonly type='text' value='".$row['nome_comercial']."' name='nome' id='nome'>
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
			                        local:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' type='text' min='0' name='local' id='local'>
			                </div>
			            </div>
			<br>
			<button class='btn primary-bg medium' name='tirar_produtoa'>
			    <span class='button-content'>Confirmar</span>
			    <i class='glyph-icon icon-save'></i>
			</button>
			</form>         
			";
			die();
		    }
	}
	if (isset($_POST['tirar_produtoa'])) {
		$id_produto=$_POST['Id']; 
		$quantidade=$_POST['quantidade']; 
		$local=$_POST['local']; 
		//$preco_unitario=$_POST['preco_unitario'];
		$data = date('Y-m-d H:i:s');
		$user_id=$loggedInUser->user_id;

		$con=connection();
		$query="SELECT qtde FROM tbl_estoque_farmacia WHERE id_produto = '$id_produto'";
		$result=mysqli_query($con,$query);
		$row=mysqli_fetch_row($result);

		$atual_qtd = $row[0];
		$total = (int)$atual_qtd - (int)$quantidade;

		if ($total < 0){
			echo "<script>swal('Estoque baixo.','','warning');</script>";
			echo "<script>swal('A quantidade que pretendes tirar é maior que a quantidade atual.','','error');</script>";
		}else{
		$con=connection();

		$query = "INSERT INTO tbl_saida_de_produto_farmacia VALUES (Null, '$id_produto','$quantidade','$local','$data','$user_id')";
		mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$a=mysqli_query($con,$query) ? true : false ;
		if($a){
			$e = mysqli_query($con,"UPDATE tbl_estoque_farmacia SET qtde='$total' WHERE id_produto = '$id_produto'");
					   echo "<script>swal('Saida de produto efetuada com sucesso', '', 'success');</script>";
				}
		else echo "<script>swal('Opps! Ocorreu um erro ao efetuar a saida de produtos','','error');</script>";
		}
	}	

?><br>
<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Produto</th>
			<th>Estoque Mínimo</th>
			<th>Estoque Máximo</th>
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
			<form method='get' action='saida_produtos_farmacia.php'>
				<a href='saida_produtos_farmacia.php?Id=".$row['id_produto']."&acao=tirar_produto ' class='btn small bg-red tooltip-button' data-placement='top' title='Tirar Produto'>
			        <i class='glyph-icon icon-minus'></i>
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
