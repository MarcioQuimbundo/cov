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
	<h3>Produtos da Farmácia</h3>
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
			$query="DELETE FROM tbl_produto_farmacia WHERE id_produto='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a){
                    $query="DELETE FROM tbl_estoque_farmacia WHERE id_produto='$Id'";
                    $a=mysqli_query($con,$query) ? true : false ;
		           	
                    echo "<script>swal('Produto removido com sucesso', '', 'success');</script>";
		        }
			else echo "<script>swal('Oops! Ocorreu um erro ao remover o produto','','error');</script>";
		}
		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_produto_farmacia WHERE id_produto = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Edição do produto</h2>
							<a href='produtos_farmacia.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
			<input type='hidden' name='Id' value='".$row['id_produto']."'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome_comercial'>
                        Nome Comercial:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input value='".$row['nome_comercial']."' required='required' type='text' name='nome_comercial' id='nome_comercial' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome_quimico'>
                        Nome Químico:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input value='".$row['nome_quimico']."' required='required' type='text' name='nome_quimico' id='nome_quimico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_fabrico'>
                        Data de Fabrico:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input value='".$row['data_fabrico']."' type='date' min='2005-01-01' max='".date('Y-m-d')."' name='data_fabrico' id='data_fabrico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_expiracao'>
                        Data de expiração:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input value='".$row['data_expiracao']."' type='date'  min='".date('Y-m-d')."' name='data_expiracao' id='data_expiracao' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='forma_farmaceutica'>
                        Forma Farmacéutica:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select required='required' name='forma_farmaceutica' class='form-control'>
                            <option value='".$row['id_produto']."'selected='selected'>".$row['id_produto']."</option>
                            <option value='Não aplicavel'>Não aplicavel</option>'                            
                            <option value='Ampola'>Ampola</option>'                            
                            <option value='Balão'>Balão</option>'                            
                            <option value='Bisnaga'>Bisnaga</option>'                            
                            <option value='Bister'>Bister</option>'                            
                            <option value='Bujão'>Bujão</option>'                            
                            <option value='Capsulas'>Capsulas</option>'                            
                            <option value='Comprimidos'>Comprimidos</option>'                            
                            <option value='Drageas'>Drageas</option>'                            
                            <option value='Emulsão'>Emulsão</option>'                            
                            <option value='Frasco'>Frasco</option>'                            
                            <option value='Linimentos'>Linimentos</option>'                            
                            <option value='Óvulos'>Óvulos</option>'                            
                            <option value='Pílulas'>Pílulas</option>'                            
                            <option value='Pomadas'>Pomadas</option>'                            
                            <option value='Saquetas'>Saquetas</option>'                                  
                            <option value='Soluções'>Soluções</option>'                                  
                            <option value='Supositórios'>Supositórios</option>'                                  
                            <option value='Suspenção'>Suspenção</option>'                                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='apresentacao'>
                        Apresentação :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='apresentacao' required='required' name='apresentacao'class='form-control'>
                    <option value='".$row['id_produto']."' selected>".$row['id_produto']."</option>										 
                    <option value='Não aplicavel' > Não Aplicável </option>
                    <option value='0,25mg' > 0,25mg 	</option>
                    <option value='0,25mg/2' > 0,25mg/2ml </option>                
                    <option value='0,5g' > 0,5g </option>                
                    <option value='0.5mg'> 0.5mg 	</option>                
                    <option value='0.5mg/ml'> 0.5mg/ml </option>                
                    <option value='1 mg/ml'> 1 mg/ml 	</option>                
                    <option value='100g' > 100g </option>                
                    <option value='100g ' > 100g </option>                
                    <option value='100mg ' > 100mg 	</option>                
                    <option value='100mg G.' > 100mg G.R </option>                
                    <option value='100mg in' > 100mg inf. </option>                
                    <option value='100mg/2m' > 100mg/2ml </option>                
                    <option value='10mg' > 10mg </option>               
                    <option value='10mg/2ml' > 10mg/2ml </option>                
                    <option value='10ml' > 10ml </option>                
                    <option value='120/5ml' > 120/5ml </option>                
                    <option value='120/5ml' > 120/5ml </option>                
                    <option value='1200mg' > 1200mg </option>                
                    <option value='1200mg' > 1200mg </option>                
                    <option value='125mg/5m' > 125mg/5ml </option>                
                    <option value='150mg' > 150mg 	</option>                
                    <option value='150mg' > 150mg 	</option>                
                    <option value='1g' > 1g </option>                
                    <option value='1g/2mg' > 1g/2mg </option>                
                    <option value='1g/5ml' > 1g/5ml </option>                
                    <option value='1mg/ml' > 1mg/ml </option>                
                    <option value='2000 ml' > 2000 ml </option>                
                    <option value='200mg' > 200mg </option>               
                    <option value='200mg/10' > 200mg/100ml</option>                
                    <option value='200mg/5m' > 200mg/5ml </option>                
                    <option value='20g' > 20g </option>                
                    <option value='20mg' > 20mg </option>                
                    <option value='20mg/ml' > 20mg/ml </option>                
                    <option value='20ml' > 20ml </option>                
                    <option value='240mg' > 240mg 	</option>                
                    <option value='250mg' > 250mg 	</option>                
                    <option value='250mg/5m' > 250mg/5ml </option>                
                    <option value='250ml'>  250ml 	</option>                
                    <option value='25mg' > 25mg </option>                
                    <option value='2mg' > 2mg </option>                
                    <option value='300mg' > 300mg 	</option>
                    <option value='300mg' > 300mg 	</option>                
                    <option value='30g' > 30g </option>                
                    <option value='400mg' > 400mg 	</option>                
                    <option value='40mg' > 40mg </option>                
                    <option value='40mg/2ml' > 40mg/2ml </option>
                    <option value='480mg' > 480mg 	</option>                
                    <option value='4mg' > 4mg </option>                
                    <option value='4mg/2ml' > 4mg/2ml </option>                
                    <option value='4mg/5ml' > 4mg/5ml </option>                
                    <option value='5000 UI' > 5000 UI </option>                
                    <option value='500mg' > 500mg 	</option>                
                    <option value='500ml' > 500ml 	</option>                
                    <option value='50mg' > 50mg </option>                
                    <option value='50mg/2ml' > 50mg/2ml </option>                
                    <option value='525mg' > 525mg 	</option>                
                    <option value='5mg' > 5mg </option>                
                    <option value='5mg/5ml' > 5mg/5ml </option>                
                    <option value='5mg/ml' > 5mg/ml </option>                
                    <option value='5ml' > 5ml </option>                
                    <option value='60g' > 60g </option>                
                    <option value='75/3ml' > 75/3ml </option>                
                    <option value='750mg' > 750mg </option>                
                    <option value='800mg' > 800mg </option>                
                    <option value='80mg/2ml' > 80mg/2ml</option>                
                    <option value='850mg' > 850mg 	</option>                                 
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='embalagem'>
                        Embalagem :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select required='required' id='embalagem' name='embalagem'class='form-control'>
                            <option value='".$row['embalagem']."'selected='selected'>".$row['embalagem']."</option>                          
                            <option value='Po Pacote'>Po Pacote</option>'                            
                            <option value='Por Unidade'>Por Unidade</option>'                                   
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='custo_compra'>
                        Custo de compra :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input value='".$row['custo_compra']."' required='required' type='number' name='custo_compra' id='custo_compra' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='preco_venda'>
                        Preço de venda:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='number' value='".$row['preco_venda']."' name='preco_venda' id='preco_venda' onfocus='searchVendor()'>
                </div>
            </div>          
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='taxa'>
                        Taxa :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='taxa'class='form-control'>
                            <option value='".$row['taxa']."' selected='selected'>".$row['taxa']."</option>                          
                            <option value='Imposto Não Aplicavel'>Imposto Não Aplicavel</option>'                            
                            <option value='Imposto de Consumo'>Imposto de Consumo</option>'                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='receita'>
                        Requer Receita :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select required='required' name='receita'class='form-control'>
                            <option value='".$row['receita']."' selected='selected'>".$row['receita']."</option>                          
                            <option value='Sim'>Sim</option>'                            
                            <option value='Não'>Não</option>'                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
                     Descrição :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input value='".$row['descricao']."' type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>   

			<div class='form-row'>
			    <div class='form-label col-md-2'>
			        <label for='estoque_minimo'>
			           	Estoque Mínimo
			        </label>
			    </div>
			    
			    <div class='form-input col-md-6'>
			        <input value='".$row['estoque_minimo']."' required='required' required='required' type='number' name='estoque_minimo' id='estoque_minimo'>
			    </div>
			</div>

			<div class='form-row'>
			    <div class='form-label col-md-2'>
			        <label for='estoque_maximo'>
			           	Estoque Máximo
			        </label>
			    </div>
			    
			    <div class='form-input col-md-6'>
			        <input value='".$row['estoque_maximo']."' required='required' type='number' name='estoque_maximo' id='estoque_maximo'>
			    </div>
			</div><br>
			<button style='background-color: #149900; color: #fff;' class='btn medium' name='editar'>
			    <span class='button-content'>Actualizar</span>
			    <i class='glyph-icon icon-save'></i>
			</button>
			</form>         
			";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_produto_farmacia WHERE id_produto = '$Id'";
			$result=mysqli_query($con,$query);
            $row=mysqli_fetch_row($result);
            $user_id=$loggedInUser->user_id;
			echo "
			<div id='regbox'>
			<h2>Informações do produto</h2><br>
							<a href='produtos_farmacia.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Status'>
			                        Nome Comercial:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[1]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Produto'>
			                       Nome Químico :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Data de Fabrico:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Data de expiração:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Forma Farmacéutica:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[5]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Apresentação :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[6]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Embalagem :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[7]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Custo de compra:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[8]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Preço de Venda:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[9]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Taxa :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[10]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Requer Receita :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[11]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Descrição :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[12]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Mínimo'>
			                       Estoque Mínimo :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[13]</h4>
			                </div>
			            </div>
			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estoque Máximo'>
			                       Estoque Máximo :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[14]</h4>
			                </div>
			            </div>
			</form>
			"; die();
		    		}		
		}

		if (isset($_POST['add'])) {
			$nome_comercial=$_POST['nome_comercial']; 
			$nome_quimico=$_POST['nome_quimico'];
			$data_fabrico=$_POST['data_fabrico'];
			$data_expiracao=$_POST['data_expiracao'];
			$forma_farmaceutica=$_POST['forma_farmaceutica'];
			$apresentacao=$_POST['apresentacao'];
			$embalagem=$_POST["embalagem"];
			$custo_compra=$_POST['custo_compra'];
			$preco_venda=$_POST['preco_venda'];
			$taxa=$_POST['taxa'];
			$receita=$_POST['receita'];
			$descricao=$_POST['descricao'];
			$descricao=implode(" ",$descricao);
			$estoque_minimo=$_POST['estoque_minimo']; 
			$estoque_maximo=$_POST['estoque_maximo'];
			$data_cadastro = date('Y-m-d H:i:s');
		    $con=connection();

		    
		    $query = "INSERT INTO tbl_produto_farmacia VALUES (
		    Null, 
		    '$nome_comercial',
		    '$nome_quimico',
		    '$data_fabrico',
		    '$data_expiracao',
		    '$forma_farmaceutica',
		    '$apresentacao',
		    '$embalagem',
		    '$custo_compra',
		    '$preco_venda',
		    '$taxa', 
		    '$receita', 
		    '$descricao', 
		    '$estoque_minimo', 
		    '$estoque_maximo', 
		    '$data_cadastro')";

		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
						$a = mysqli_query($con,"INSERT INTO tbl_estoque_farmacia VALUES (Null,LAST_INSERT_ID(), 0, $preco_venda)");
		               	echo "<script>swal('Produto adicionado com sucesso', '', 'success');</script>";
		               	//echo "<script>document.location.href = 'produtos_farmacia.php';</script>";
		            }
		    else echo "<script>swal('Oops! Ocorreu um erro ao adicionar um produto','','error');</script>";
		}	

		if (isset($_POST['editar'])) {
			
			$id = $_POST['Id'];
			$nome_comercial=$_POST['nome_comercial']; 
			$nome_quimico=$_POST['nome_quimico'];
			$data_fabrico=$_POST['data_fabrico'];
			$data_expiracao=$_POST['data_expiracao'];
			$forma_farmaceutica=$_POST['forma_farmaceutica'];
			$apresentacao=$_POST['apresentacao'];
			$embalagem=$_POST["embalagem"];
			$custo_compra=$_POST['custo_compra'];
			$preco_venda=$_POST['preco_venda'];
			$taxa=$_POST['taxa'];
			$receita=$_POST['receita'];
			$descricao=$_POST['descricao'];
			$descricao=implode(" ",$descricao);
			$estoque_minimo=$_POST['estoque_minimo']; 
			$estoque_maximo=$_POST['estoque_maximo'];
			$data_cadastro = date('Y-m-d'); 

		    $con=connection();

		    $query = "UPDATE tbl_produto_farmacia SET 
		    nome_comercial='$nome_comercial', 
		    nome_quimico='$nome_quimico', 
		    data_fabrico='$data_fabrico', 
		    data_expiracao='$data_expiracao', 
		    forma_farmaceutica='$forma_farmaceutica', 
		    apresentacao='$apresentacao', 
		    embalagem='$embalagem', 
		    custo_compra='$custo_compra', 
		    preco_venda='$preco_venda', 
		    taxa='$taxa', 
		    receita='$receita', 
		    descricao='$descricao', 
		    estoque_minimo='$estoque_minimo', 
		    estoque_maximo='$estoque_maximo' WHERE id_produto = '$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a){
		           	echo "<script>swal('Produto actualizado com sucesso', '', 'success');</script>";
		           	//echo "<script>document.location.href = 'produtos_farmacia.php';</script>";
		            }
		    else echo "<script>swal('Oops! ocorreu um erro ao actualizar o produto','','error');</script>";
		}	

	if (isset($_POST['add_novo_produto'])) {
	$data_cadastro = date('d-m-Y / H:i:s'); 
	echo "
	<h2>Novo produto</h2>
							<a href='produtos_farmacia.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
        <form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
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
                    <label for='nome_comercial'>
                        Nome Comercial:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='nome_comercial' id='nome_comercial' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome_quimico'>
                        Nome Químico:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='nome_quimico' id='nome_quimico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_fabrico'>
                        Data de Fabrico:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='date' min='2005-01-01' max='".date('Y-m-d')."' name='data_fabrico' id='data_fabrico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_expiracao'>
                        Data de expiração:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='date'  min='".date('Y-m-d')."' name='data_expiracao' id='data_expiracao' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='forma_farmaceutica'>
                        Forma Farmacéutica:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select required='required' name='forma_farmaceutica' class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>
                            <option value='Não aplicavel'>Não aplicavel</option>'                            
                            <option value='Ampola'>Ampola</option>'                            
                            <option value='Balão'>Balão</option>'                            
                            <option value='Bisnaga'>Bisnaga</option>'                            
                            <option value='Bister'>Bister</option>'                            
                            <option value='Bujão'>Bujão</option>'                            
                            <option value='Capsulas'>Capsulas</option>'                            
                            <option value='Comprimidos'>Comprimidos</option>'                            
                            <option value='Drageas'>Drageas</option>'                            
                            <option value='Emulsão'>Emulsão</option>'                            
                            <option value='Frasco'>Frasco</option>'                            
                            <option value='Linimentos'>Linimentos</option>'                            
                            <option value='Óvulos'>Óvulos</option>'                            
                            <option value='Pílulas'>Pílulas</option>'                            
                            <option value='Pomadas'>Pomadas</option>'                            
                            <option value='Saquetas'>Saquetas</option>'                                  
                            <option value='Soluções'>Soluções</option>'                                  
                            <option value='Supositórios'>Supositórios</option>'                                  
                            <option value='Suspenção'>Suspenção</option>'                                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='apresentacao'>
                        Apresentação :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='apresentacao' required='required' name='apresentacao'class='form-control'>
                    <option value='' selected> -- Selecione -- </option>										 
                    <option value='Não aplicavel' > Não Aplicável </option>
                    <option value='0,25mg' > 0,25mg 	</option>
                    <option value='0,25mg/2' > 0,25mg/2ml </option>                
                    <option value='0,5g' > 0,5g </option>                
                    <option value='0.5mg'> 0.5mg 	</option>                
                    <option value='0.5mg/ml'> 0.5mg/ml </option>                
                    <option value='1 mg/ml'> 1 mg/ml 	</option>                
                    <option value='100g' > 100g </option>                
                    <option value='100g ' > 100g </option>                
                    <option value='100mg ' > 100mg 	</option>                
                    <option value='100mg G.' > 100mg G.R </option>                
                    <option value='100mg in' > 100mg inf. </option>                
                    <option value='100mg/2m' > 100mg/2ml </option>                
                    <option value='10mg' > 10mg </option>               
                    <option value='10mg/2ml' > 10mg/2ml </option>                
                    <option value='10ml' > 10ml </option>                
                    <option value='120/5ml' > 120/5ml </option>                
                    <option value='120/5ml' > 120/5ml </option>                
                    <option value='1200mg' > 1200mg </option>                
                    <option value='1200mg' > 1200mg </option>                
                    <option value='125mg/5m' > 125mg/5ml </option>                
                    <option value='150mg' > 150mg 	</option>                
                    <option value='150mg' > 150mg 	</option>                
                    <option value='1g' > 1g </option>                
                    <option value='1g/2mg' > 1g/2mg </option>                
                    <option value='1g/5ml' > 1g/5ml </option>                
                    <option value='1mg/ml' > 1mg/ml </option>                
                    <option value='2000 ml' > 2000 ml </option>                
                    <option value='200mg' > 200mg </option>               
                    <option value='200mg/10' > 200mg/100ml</option>                
                    <option value='200mg/5m' > 200mg/5ml </option>                
                    <option value='20g' > 20g </option>                
                    <option value='20mg' > 20mg </option>                
                    <option value='20mg/ml' > 20mg/ml </option>                
                    <option value='20ml' > 20ml </option>                
                    <option value='240mg' > 240mg 	</option>                
                    <option value='250mg' > 250mg 	</option>                
                    <option value='250mg/5m' > 250mg/5ml </option>                
                    <option value='250ml'>  250ml 	</option>                
                    <option value='25mg' > 25mg </option>                
                    <option value='2mg' > 2mg </option>                
                    <option value='300mg' > 300mg 	</option>
                    <option value='300mg' > 300mg 	</option>                
                    <option value='30g' > 30g </option>                
                    <option value='400mg' > 400mg 	</option>                
                    <option value='40mg' > 40mg </option>                
                    <option value='40mg/2ml' > 40mg/2ml </option>
                    <option value='480mg' > 480mg 	</option>                
                    <option value='4mg' > 4mg </option>                
                    <option value='4mg/2ml' > 4mg/2ml </option>                
                    <option value='4mg/5ml' > 4mg/5ml </option>                
                    <option value='5000 UI' > 5000 UI </option>                
                    <option value='500mg' > 500mg 	</option>                
                    <option value='500ml' > 500ml 	</option>                
                    <option value='50mg' > 50mg </option>                
                    <option value='50mg/2ml' > 50mg/2ml </option>                
                    <option value='525mg' > 525mg 	</option>                
                    <option value='5mg' > 5mg </option>                
                    <option value='5mg/5ml' > 5mg/5ml </option>                
                    <option value='5mg/ml' > 5mg/ml </option>                
                    <option value='5ml' > 5ml </option>                
                    <option value='60g' > 60g </option>                
                    <option value='75/3ml' > 75/3ml </option>                
                    <option value='750mg' > 750mg </option>                
                    <option value='800mg' > 800mg </option>                
                    <option value='80mg/2ml' > 80mg/2ml</option>                
                    <option value='850mg' > 850mg 	</option>                                 
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='embalagem'>
                        Embalagem :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select required='required' id='embalagem' name='embalagem'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Po Pacote'>Po Pacote</option>'                            
                            <option value='Por Unidade'>Por Unidade</option>'                                   
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='custo_compra'>
                        Custo de compra :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='number' name='custo_compra' id='custo_compra' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='preco_venda'>
                        Preço de venda:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='number' name='preco_venda' id='preco_venda' onfocus='searchVendor()'>
                </div>
            </div>          
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='taxa'>
                        Taxa :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='taxa'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Imposto Não Aplicavel'>Imposto Não Aplicavel</option>'                            
                            <option value='Imposto de Consumo'>Imposto de Consumo</option>'                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='receita'>
                        Requer Receita :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select required='required' name='receita'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Sim'>Sim</option>'                            
                            <option value='Não'>Não</option>'                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
                     Descrição :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            
			<div class='form-row'>
			    <div class='form-label col-md-2'>
			        <label for='estoque_minimo'>
			           	Estoque Mínimo
			        </label>
			    </div>
			    
			    <div class='form-input col-md-6'>
			        <input required='required' required='required' type='number' name='estoque_minimo' id='estoque_minimo'>
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
                                           
            <br />
            <button style='background-color: #149900; color: #fff;' class='btn medium' name='add'>
                <span class='button-content'>Adicionar</span>
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
			<td>
				<a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=ver '>".$row['nome_comercial']."</a>
			</td>
			<td>
				<a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=ver '>".$row['estoque_minimo']."</a>
			</td>
			<td>
				<a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=ver '>".$row['estoque_maximo']."</a>
			</td>
			<td>
			<form method='get' action='produtos_farmacia.php'>
				<a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
                <a href='produtos_farmacia.php?Id=".$row['id_produto']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
                    <i class='glyph-icon icon-remove'></i>
                </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='produtos_farmacia.php'>
	    <a title='Novo produto' href='produtos_farmacia.php'>
	       <button style='font-size:20px; background-color: #149900; color: #fff;' name='add_novo_produto' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
		        <i class='glyph-icon icon-save'></i>
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
