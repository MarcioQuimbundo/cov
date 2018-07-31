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
		<h3>Isenção dos Serviços de Consultas</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

	if (isset($_POST['dar_entradaa'])) {

		$idPaciente = $_POST['idproc'];
		$tipo_servicos = $_POST['tipo_servicos'];
		$preco = $_POST['preco'];
		$quantidade = $_POST['quantidade'];
		$descricao = $_POST['descricao'];
		$total = $quantidade*$preco;
		$tipo_servicos = explode(":", $tipo_servicos);
		$tipo_servicos = $tipo_servicos[1];
		$user_id  = $loggedInUser->user_id;
		$data_isentada = date('Y-m-d H:i:s');
		$con = connection();
		
		$query = "INSERT INTO tbl_isencao_servicos_consultas VALUES(NULL,'$idPaciente','$tipo_servicos','$preco','$quantidade','$total','$descricao','$user_id', '$data_isentada')";	
		$result = mysqli_query($con,$query);
		$q = "SELECT * FROM tbl_isencao_servicos_consultas";	
		$resu = mysqli_query($con,$q);
		$dado = count($resu);
		foreach ($resu as $resus => $contador) {
			$count = $resus;
		}
		$count=$count+1;

		if ($result) {
			echo "<script>swal('Paciente Isentado com sucesso','','success');</script>";
			 echo "	<div class='row'>
			                <div class='col-md-6'  style='margin-top:15%;margin-left:25%;'>
			                    <div class='infobox success-bg mrg0A text-center'>
			                        <h2>Paciente Insentado com sucesso</h2><br>
			                        <a href='imprimir/imprimir_isencao_servicos_consultas.php?Id=".$idPaciente."&uid=".$count."' target='_blank' class='btn primary-bg large' name='isencao'>
									    <span style='color:white;'class='button-content'>Gerar Comprovativo</span>
									</a>
			                       
			                    </div>
			                </div>
			            </div>";
			            die();
		}else echo "<script>swal('Ops! Ocorreu um erro ao Insentar','','error');</script>";

	}
 	if(isset($_GET['Id']))
        {
	        $acao = sanitize($_GET['acao']);
	        $Id = sanitize($_GET['Id']);
	        $con=connection();
			
			$query="SELECT *FROM tbl_paciente WHERE id='$Id'";
			$a = mysqli_query($con,$query);
			$row = mysqli_fetch_array($a);

	        if ($acao == 'insencao') {

				echo "
			<a href='insesao_servicos_consultas.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='".$row['Id']."'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='status'>
			                        Nº do Processo:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
								<input required='required' style='font-size:20px;' type='text'  value='$Id' name='idproc' id='id'>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                        Nome do Paciente:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <input required='required' readonly type='text'  value='".$row['nome']."' name='nome' id='nome'>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='nome'>
			                       Serviços:
			                    </label>
			                </div>
			              ";?>

		              			<div class='form-input col-md-6'>
									<select required='required' id='tipo_servicos' onchange="mudaPreco();" name='tipo_servicos' class='form-control' style="font-size: 14px;">
										<option value='' selected='selected'>-- Escolha um Serviço Geral --</option>  
										<?php  
											$query="SELECT id, nome FROM tbl_servicos_consultas";
											$result=mysqli_query($con,$query);
											while($row=mysqli_fetch_array($result))
											{
										?>
										<option value=<?="consultas:".$row['id']; ?> ><?=$row['nome']; ?></option>        
										<?php } ?>                           
									</select>
								</div>
							</div>
							<div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='nome'>
				                        Preço:
				                    </label>
				                </div>
				             	<div class='form-input col-md-2'  >
									<input readonly="readonly" style="font-size: 28px;" name="preco" id='preco' type='text'>
								</div>	
			            	</div>
							
			          
			            <script type="text/javascript">
							function mudaPreco () {
								var xmlhttp = new XMLHttpRequest();
								xmlhttp.open(
									"GET", 
									"ajaxPrecoIsencao.php?tipo_servicos=" + 
									document.getElementById('tipo_servicos').value + 
									"&servicos="+ 
									document.getElementById('tipo_servicos').value, false);
								xmlhttp.send(null);
								document.getElementById("preco").value = xmlhttp.responseText;
							}
							</script>
			            <?php
			            echo "
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
			                    <label for='descricao'>
			                     Motivo da Isenção :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <textarea rows='4' cols='8'name='descricao' id='descricao'>
										
		    					</textarea>
			                </div>
			            </div>

			           <br>
					<button  style='background-color: #149900; color: #fff;' class='btn medium' name='dar_entradaa'>
					    <span class='button-content'>Dar Entrada</span>
					    
					</button>
			</form>         
			";
	        }
	        			die();

        }
    



echo "
<div id='resposta'></div>
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Processo</th>
			<th>Nome do Paciente</th>
			<th>Genero</th>
			<th>Idade</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";

	$con=connection();
	$query="SELECT Id, nome, (TIMESTAMPDIFF(YEAR, data_nasc, CURDATE())) AS idade, genero, telefone FROM tbl_paciente inner join tbl_agenda ON tbl_paciente.Id = tbl_agenda.id_paciente WHERE tbl_agenda.servicos='consultas' LIMIT 0, 200";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['Id']."</td>
			<td>".$row['nome']."</td>
			<td>".$row['genero']."</td>
			<td>".$row['idade']."</td>

			<td>
	            <form method='post' action='insesao_servicos_consultas.php'>
	                <a href='insesao_servicos_consultas.php?Id=".$row['Id']."&acao=insencao' name ='insesao' id='insesaoBtn' data-id='".$row['Id']."' href='javascript:void(0)' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='isenção'>
						<i class='glyph-icon icon-arrow-right'></i>
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
?>
