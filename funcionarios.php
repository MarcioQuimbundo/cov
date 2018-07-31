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
		<h3>Funcionários</h3>
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
			$query="DELETE FROM tbl_funcionario WHERE Id='$Id'";
			$a=mysqli_query($con,$query) ? true : false ;
			if($a) echo "<script>swal('Funcionário Rempvido Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao remover o funcionário','','error');</script>";
		}

		if ($acao == 'editar') {
			$query="SELECT * FROM tbl_funcionario WHERE Id = '$Id'";
			$result=mysqli_query($con,$query);
			while($row=mysqli_fetch_array($result))
			echo "
			<h2>Informações Iniciais</h2><br>
			<a href='funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<input type='hidden' name='Id' value='$Id'>
						<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='nome'>
								*Nome Completo:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='text' value=".$row['nome']." name='nome' id='nome' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='data_nasc'>
								*Data de Nascimento:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='date' value=".$row['data_nasc']." name='data_nasc' id='data_nasc' onfocus='searchVendor()'>
						</div>
					</div>
		
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='estado_civil'>
								*Estado Civil:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<select required='required' name='estado_civil' class='form-control'>
									<option value='".$row['estado_civil']."' selected='selected'>".$row['estado_civil']."</option>
									<option value='Solteiro(a)'>Solteiro(a)</option>'                            
									<option value='Casado(a)'>Casado(a)</option>'                            
									<option value='Viuvo(a)'>Viuvo(a)</option>'                            
									<option value='Divorciado(a)'>Divorciado(a)</option>'                            
							</select>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='genero'>
								*Gênero:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<select required='required' id='genero' name='genero'class='form-control'>
									<option value='".$row['genero']."' selected='selected'>".$row['genero']."</option>
									<option value='Masculino'>Masculino</option>'                            
									<option value='Femenino'>Femenino</option>'                            
							</select>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='profissao'>
								*Profissão:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<select required='required' id='profissao' name='profissao'class='form-control'>
									<option value='".$row['profissao']."' selected='selected'>".$row['profissao']."</option>
									<option value='Não Aplicavel'>Não Aplicavel</option>'                            
									<option value='Adminstrativo'>Adminstrativo</option>'                            
									<option value='Analista'>Analista</option>'                            
									<option value='Analista Clínico(a)'>Analista Clínico(a)</option>'                            
									<option value='Aux. da Limpeza'>Aux. da Limpeza</option>'                            
									<option value='Barbeiro'>Barbeiro</option>'                            
									<option value='Catalogador(a)'>Catalogador(a)</option>'                            
									<option value='Contablista'>Contablista</option>'                            
									<option value='Copeiro(a)'>Copeiro(a)</option>'                            
									<option value='Cortador'>Cortador</option>'                            
									<option value='Costureira'>Costureira</option>'                            
									<option value='Cozinheiro(a)'>Cozinheiro(a)</option>'                            
									<option value='Defectólogo'>Defectólogo</option>'                            
									<option value='Diversos'>Diversos</option>'                            
									<option value='Decente Universitária'>Decente Universitária</option>'                            
									<option value='Economista'>Economista</option>'                            
									<option value='Electrecista'>Electrecista</option>'                            
									<option value='Encarregado Não Qualificado'>Encarregado Não Qualificado</option>'                            
									<option value='Enfermeiro(a)'>Enfermeiro(a)</option>'                            
									<option value='Estudante'>Estudante</option>'                            
									<option value='Farmacêutico'>Farmacêutico</option>'                            
									<option value='Fiel de Armazem'>Fiel de Armazem</option>'                            
									<option value='Fisioterapeuta'>Fisioterapeuta</option>'                            
									<option value='Maqueiro(a)'>Maqueiro(a)</option>'                            
									<option value='Medico(a)'>Medico(a)</option>'                            
									<option value='Motorista'>Motorista</option>'                            
									<option value='Operador Lavandaria'>Operador Lavandaria</option>'                            
									<option value='Operário Não Qualificado'>Operário Não Qualificado</option>'                            
									<option value='Operário Qualificado'>Operário Qualificado</option>'                            
									<option value='Ortopretésico'>Ortopretésico</option>'                            
									<option value='Porteiro(a)'>Porteiro(a)</option>'                            
									<option value='Professor(a)'>Professor(a)</option>'                            
									<option value='Programador'>Programador</option>'                            
									<option value='Psicólogo(a)'>Psicólogo(a)</option>'                            
									<option value='Radiológista'>Radiológista</option>'                            
									<option value='Roupeira'>Roupeira</option>'                            
									<option value='Telefonista'>Telefonista</option>'                            
									<option value='Vigilante'>Vigilante</option>'                            
							</select>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='funcao'>
								*Função:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<select required='required' id='funcao' name='funcao'class='form-control'>
									<option value='".$row['funcao']."' selected='selected'>".$row['funcao']."</option>
									<option value='2º Oficial'>2º Oficial</option>'                            
									<option value='Adminstrador'>Adminstrador</option>'                            
									<option value='Aspirante'>Aspirante</option>'                            
									<option value='Aux. Téc. Diag. Terap. de 1ª Classe'>Aux. Téc. Diag. Terap. de 1ª Classe</option>'                            
									<option value='Aux. Téc. Diag. Terap. de 2ª Classe'>Aux. Téc. Diag. Terap. de 2ª Classe</option>'                            
									<option value='Aux. Téc. Diag. Terap. de 3ª Classe'>Aux. Téc. Diag. Terap. de 3ª Classe</option>'      
									<option value='Auxiliar de Limpeza Principal'>Auxiliar de Limpeza Principal</option>'                            
									<option value='Barbeiro de 2ª Classe'>Barbeiro de 2ª Classe</option>'                            
									<option value='Caixa'>Caixa</option>'                            
									<option value='Catalogador(a)'>Catalogador(a)</option>'                            
									<option value='Catalogador(a) de 1ª Classe'>Catalogador(a) de 1ª Classe</option>'                            
									<option value='Catalogador(a) de 2ª Classe'>Catalogador(a) de 2ª Classe</option>'                            
									<option value='Catalogador(a) de 3ª Classe'>Catalogador(a) de 3ª Classe</option>'                            
									<option value='Chefe Deptº. Contabilidade'>Chefe Deptº. Contabilidade</option>'                            
									<option value='Chefe Deptº. Recursos Humanos'>Chefe Deptº. Recursos Humanos</option>'                            
									<option value='Chefe Deptº. Técnico'>Chefe Deptº. Técnico</option>'                            
									<option value='Adminstrador'>Adminstrador</option>'                            
							</select>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='telefone'>
								Telefone:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input type='text' value=".$row['telefone']." name='telefone' id='telefone' onfocus='searchVendor()'>
						</div>
					</div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Especialidade'>
			                        Especialidade:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <select name='especialidade' class='form-control'>
			                            <option value=".$row['especialidade']." selected='selected'>".$row['especialidade']."</option>
			                            <option value='Não aplicavel'>Não aplicavel</option>'                            
			                            <option value='Análise Clínica'>Análise Clínica</option>'                            
			                            <option value='Cardiologia'>Cardiologia</option>'                            
			                            <option value='Clínica Geral'>Clínica Geral</option>'                            
			                            <option value='Defectólogia'>Defectólogia</option>'                            
			                            <option value='Ecónoma'>Ecónoma</option>'                            
			                            <option value='Emangiologia'>Emangiologia</option>'                            
			                            <option value='Estomatologia'>Estomatologia</option>'                            
			                            <option value='Farmácia'>Farmácia</option>'                                  
			                            <option value='Fisioterapia'>Fisioterapia</option>'                                  
			                            <option value='Logista'>Logista</option>'                                  
			                            <option value='Medicina'>Medicina</option>'                                  
			                            <option value='Medicina Interna'>Medicina Interna</option>'                                  
			                            <option value='Neorologia'>Neorologia</option>'                                  
			                            <option value='Oncologia'>Oncologia</option>'                                  
			                            <option value='Ortopedia'>Ortopedia</option>'                                  
			                            <option value='Ortopedia & Traumatologia'>Ortopedia & Traumatologia</option>'                                  
			                            <option value='Ortoprotesia'>Ortoprotesia</option>'                                  
			                            <option value='Psicóloga'>Psicóloga</option>'                                  
			                            <option value='Psicoterapia'>Psicoterapia</option>'                                  
			                            <option value='Radiologia'>Radiologia</option>'                                  
			                            <option value='Urologia'>Urologia</option>'                                  
			                    </select>
			                </div>
			            </div>

		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='estado'>
								*Estado:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<select required='required' id='estado' name='estado'class='form-control'>
									<option value=".$row['estado']." selected='selected'>".$row['estado']."</option>
									<option value='Activo'>Activo</option>'                            
									<option value='Inactivo'>Inactivo</option>'                            
							</select>
						</div>
					</div>
					<h2>Informações Complementares</h2><br>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='email'>
								Email:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input type='text' value=".$row['email']." name='email' id='email' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='tipo_id'>
								*Tipo de ID:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<select required='required' id='tipo_id' name='tipo_id'class='form-control'>
									<option value=".$row['tipo_id']." selected='selected'>".$row['tipo_id']."</option>
									<option value='Não Aplicavel'>Não Aplicavel</option>'                            
									<option value='Bilhete'>Bilhete</option>'                            
									<option value='Cédula'>Cédula</option>'                            
									<option value='Passaporte'>Passaporte</option>'    
							</select>                        
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='n_identificacao'>
								*Nº de Identificação:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input  type='text' value=".$row['n_identificacao']." name='n_identificacao' id='n_identificacao' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='endereco'>
								*Endereço:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='text' value=".$row['endereco']." name='endereco' id='endereco' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='pais'>
								*País:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='text' value=".$row['pais']." name='pais' id='pais' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='provincia'>
								*Naturalidade:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='text' value=".$row['provincia']." name='provincia' id='provincia' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='n_seguranca_social'>
								*Nº de Segurança Social:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='text' value=".$row['n_seguranca_social']." name='n_seguranca_social' id='n_seguranca_social' onfocus='searchVendor()'>
						</div>
					</div>
		
					<div class='form-row'>
						<div class='form-label col-md-2'>
							<label for='n_identificacao_fiscal'>
								*Nº de Identificação Fiscal:
							</label>
						</div>
						<div class='form-input col-md-6'>
							<input required='required' type='text' value=".$row['n_identificacao_fiscal']." name='n_identificacao_fiscal' id='n_identificacao_fiscal' onfocus='searchVendor()'>
						</div>
					</div>
		
				
		
			<br>
				<button style='font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='editarr'>
			    <span class='button-content'>Editar</span>
			    <i class='glyph-icon icon-plus'></i>
			</button>
			</form>         
			";
			die();
		    }
		    if ($acao == 'ver') {
			$query="SELECT * FROM tbl_funcionario WHERE Id = '$Id'";
			$result=mysqli_query($con,$query);
			$row=mysqli_fetch_row($result);
			echo "
			<div id='regbox'><br>
			<h2>Informações Pessoais</h2>
			<a href='funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
			<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='processo'>
			                        Nº de processo:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>000$row[0]</h4>
			                </div>
			            </div>
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
			                    <label for='Data de Nascimento'>
			                       Data de Nascimento :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[2]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Estado Civil'>
			                       Estado Civil :
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[3]</h4>
			                </div>
			            </div>
						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Gênero'>
			                       Gênero:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[4]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Profissão:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[5]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Telefone'>
			                       Função:
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[6]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='E-mail'>
			                      Telefone
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[7]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='E-mail'>
			                      Especialidade
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[8]</h4>
			                </div>
			            </div>

					<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Tipo de Id'>
			                      Estado
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[9]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Nº de Id'>
			                      E-mail
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[10]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Endereço'>
			                      Tipo de Id
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[11]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Pais'>
			                      Nº de Identificação
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[12]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Província'>
			                		Endereço
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[13]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='pais'>
			                      País
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[14]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='provincia'>
			                      Naturalidade
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[15]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='n_seguranca_social'>
			                      Nº de Segurança Social
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[16]</h4>
			                </div>
			            </div>

						<div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='n_identificacao_fiscal'>
			                      Nº de Identificação Fiscal
			                    </label>
			                </div>
			                <div class='form-input col-md-6'>
			                    <h4>$row[17]</h4>
			                </div>
			            </div>


			            <br>
			            <button style='float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='voltar'>
						    <span class='button-content'>Voltar</span>
						    <i class='glyph-icon icon-arrow-left'></i>
						</button>
			</form>
			"; die();
		    		}		
		}

		if (isset($_POST['voltar'])) {
          	echo "<script>document.location.href = 'funcionarios.php';</script>";
		}

		if (isset($_POST['add'])) 
		{
			$nome=$_POST['nome']; 
			$data_nasc=$_POST['data_nasc']; 
			$estado_civil=$_POST['estado_civil'];
			$genero=$_POST["genero"];
			$profissao=$_POST['profissao'];
			$funcao=$_POST['funcao'];
			$telefone=$_POST['telefone'];
			$especialidade=$_POST['especialidade'];
			$estado=$_POST['estado'];
			$email=$_POST['email'];
			$tipo_id=$_POST['tipo_id'];
			$n_identificacao=$_POST['n_identificacao'];
			$endereco=$_POST['endereco'];
			$pais=$_POST['pais'];
			$provincia=$_POST['provincia'];
			$n_seguranca_social=$_POST['n_seguranca_social'];
			$n_identificacao_fiscal=$_POST['n_identificacao_fiscal'];
			$data = date('d-m-Y H:i:s');
			
		    	$con=connection();				    
					$query="INSERT INTO tbl_funcionario VALUES (Null, '$nome','$data_nasc','$estado_civil','$genero','$profissao','$funcao','$telefone','$especialidade','$estado','$email','$tipo_id','$n_identificacao','$endereco','$pais','$provincia','$n_seguranca_social','$n_identificacao_fiscal','$data')";
					mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
					$a = mysqli_query($con,$query) ? true : false ;
					if($a) echo "<script>swal('Funcionário Cadastrado Com Sucesso','','success');</script>";
		    		else echo "<script>swal('Ops! Ocorreu um erro ao cadastrar o funcionário','','error');</script>";
			}	

	if (isset($_POST['editarr'])) {
			$id = $_POST['Id'];
			$nome=$_POST['nome']; 
			$data_nasc=$_POST['data_nasc']; 
			$estado_civil=$_POST['estado_civil'];
			$genero=$_POST["genero"];
			$profissao=$_POST['profissao'];
			$funcao=$_POST['funcao'];
			$telefone=$_POST['telefone'];
			$estado=$_POST['estado'];
			$especialidade=$_POST['especialidade'];
			$email=$_POST['email'];
			$tipo_id=$_POST['tipo_id'];
			$n_identificacao=$_POST['n_identificacao'];
			$endereco=$_POST['endereco'];
			$pais=$_POST['pais'];
			$provincia=$_POST['provincia'];
			$n_seguranca_social=$_POST['n_seguranca_social'];
			$n_identificacao_fiscal=$_POST['n_identificacao_fiscal'];
			$data = date('Y-m-d H:i:s');

			if (empty($nome) || empty($data_nasc) || empty($estado_civil) || empty($genero) || empty($profissao) || empty($funcao) || empty($telefone) || empty($estado) || empty($tipo_id) || empty($n_identificacao) || empty($endereco) || empty($pais) || empty($provincia) || empty($n_seguranca_social) || empty($n_identificacao_fiscal) ) {
		        echo "
		                <div class='row'>
		                    <div class='col-md-6'>
		                        <div class='infobox error-bg mrg0A'>
		                            <p>Preencha todos os campos obrigatórios (*).</p>
		                        </div>
		                    </div>
		                </div>
		            ";
		    }else{
		    $con=connection();

		    $query = "	UPDATE tbl_funcionario SET 
						nome=						'$nome', 
						data_nasc=					'$data_nasc',
						estado_civil=				'$estado_civil',
						genero=						'$genero',
						profissao=					'$profissao',
						funcao=						'$funcao',
						telefone=					'$telefone',
						especialidade=				'$especialidade',
						estado=						'$estado',
						email=						'$email',
						tipo_id=					'$tipo_id',
						n_identificacao=			'$n_identificacao',
						endereco=					'$endereco',
						pais=						'$pais',
						provincia=					'$provincia',
						n_seguranca_social=			'$n_seguranca_social',
						n_identificacao_fiscal=		'$n_identificacao_fiscal'
						WHERE Id = 					'$id'";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a) echo "<script>swal('Funcionário Atualizado Com Sucesso','','success');</script>";
		    else echo "<script>swal('Ops! Ocorreu um erro ao atualizar o funcionário','','error');</script>";
		    }
	}

	if (isset($_POST['add_novo_funcionario'])) {
	echo "
	<h2>Informações Iniciais</h2>
			<a href='funcionarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
	<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='nome'>
							*Nome Completo:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input required='required' type='text' name='nome' id='nome' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='data_nasc'>
							*Data de Nascimento:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input required='required' max='2003-01-01' type='date' name='data_nasc' id='data_nasc' onfocus='searchVendor()'>
					</div>
				</div>
	
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='estado_civil'>
							*Estado Civil:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<select required='required' name='estado_civil' class='form-control'>
								<option value=''selected='selected'>-- Selecione --</option>
								<option value='Solteiro(a)'>Solteiro(a)</option>'                            
								<option value='Casado(a)'>Casado(a)</option>'                            
								<option value='Viuvo(a)'>Viuvo(a)</option>'                            
								<option value='Divorciado(a)'>Divorciado(a)</option>'                            
						</select>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='genero'>
							*Gênero:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<select required='required' id='genero' name='genero'class='form-control'>
								<option value=''selected='selected'>-- Selecione --</option>                          
								<option value='Masculino'>Masculino</option>'                            
								<option value='Femenino'>Femenino</option>'                            
						</select>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='profissao'>
							*Profissão:
						</label>
					</div>



					<div class='form-input col-md-6'>
						<select required='required' id='profissao' name='profissao' class='form-control' onChange='changetextbox();'>
								<option value=''selected='selected'>-- Selecione --</option>                          
								<option value='Não Aplicavel'>Não Aplicavel</option>'                            
								<option value='Adminstrativo'>Adminstrativo</option>'                            
								<option value='Analista'>Analista</option>'                            
								<option value='Analista Clínico(a)'>Analista Clínico(a)</option>'                            
								<option value='Aux. da Limpeza'>Aux. da Limpeza</option>'                            
								<option value='Barbeiro'>Barbeiro</option>'                            
								<option value='Catalogador(a)'>Catalogador(a)</option>'                            
								<option value='Contablista'>Contablista</option>'                            
								<option value='Copeiro(a)'>Copeiro(a)</option>'                            
								<option value='Cortador'>Cortador</option>'                            
								<option value='Costureira'>Costureira</option>'                            
								<option value='Cozinheiro(a)'>Cozinheiro(a)</option>'                            
								<option value='Defectólogo'>Defectólogo</option>'                            
								<option value='Diversos'>Diversos</option>'                            
								<option value='Decente Universitária'>Decente Universitária</option>'                            
								<option value='Economista'>Economista</option>'                            
								<option value='Electrecista'>Electrecista</option>'                            
								<option value='Encarregado Não Qualificado'>Encarregado Não Qualificado</option>'                            
								<option value='Enfermeiro(a)'>Enfermeiro(a)</option>'                            
								<option value='Estudante'>Estudante</option>'                            
								<option value='Farmacêutico'>Farmacêutico</option>'                            
								<option value='Fiel de Armazem'>Fiel de Armazem</option>'                            
								<option value='Fisioterapeuta'>Fisioterapeuta</option>'                            
								<option value='Maqueiro(a)'>Maqueiro(a)</option>'                            
								<option value='Medico(a)'>Medico(a)</option>'                            
								<option value='Motorista'>Motorista</option>'                            
								<option value='Operador Lavandaria'>Operador Lavandaria</option>'                            
								<option value='Operário Não Qualificado'>Operário Não Qualificado</option>'                            
								<option value='Operário Qualificado'>Operário Qualificado</option>'                            
								<option value='Ortopretésico'>Ortopretésico</option>'                            
								<option value='Porteiro(a)'>Porteiro(a)</option>'                            
								<option value='Professor(a)'>Professor(a)</option>'                            
								<option value='Programador'>Programador</option>'                            
								<option value='Psicólogo(a)'>Psicólogo(a)</option>'                            
								<option value='Radiológista'>Radiológista</option>'                            
								<option value='Roupeira'>Roupeira</option>'                            
								<option value='Telefonista'>Telefonista</option>'                            
								<option value='Vigilante'>Vigilante</option>'                            
						</select>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='funcao'>
							*Função:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<select required='required' id='funcao' name='funcao'class='form-control'>
								<option value=''selected='selected'>-- Selecione --</option>                          
								<option value='2º Oficial'>2º Oficial</option>'                            
								<option value='Adminstrador'>Adminstrador</option>'                            
								<option value='Aspirante'>Aspirante</option>'                            
								<option value='Aux. Téc. Diag. Terap. de 1ª Classe'>Aux. Téc. Diag. Terap. de 1ª Classe</option>'                            
								<option value='Aux. Téc. Diag. Terap. de 2ª Classe'>Aux. Téc. Diag. Terap. de 2ª Classe</option>'                            
								<option value='Aux. Téc. Diag. Terap. de 3ª Classe'>Aux. Téc. Diag. Terap. de 3ª Classe</option>'      
								<option value='Auxiliar de Limpeza Principal'>Auxiliar de Limpeza Principal</option>'                            
								<option value='Barbeiro de 2ª Classe'>Barbeiro de 2ª Classe</option>'                            
								<option value='Caixa'>Caixa</option>'                            
								<option value='Catalogador(a)'>Catalogador(a)</option>'                            
								<option value='Catalogador(a) de 1ª Classe'>Catalogador(a) de 1ª Classe</option>'                            
								<option value='Catalogador(a) de 2ª Classe'>Catalogador(a) de 2ª Classe</option>'                            
								<option value='Catalogador(a) de 3ª Classe'>Catalogador(a) de 3ª Classe</option>'                            
								<option value='Chefe Deptº. Contabilidade'>Chefe Deptº. Contabilidade</option>'                            
								<option value='Chefe Deptº. Recursos Humanos'>Chefe Deptº. Recursos Humanos</option>'                            
								<option value='Chefe Deptº. Técnico'>Chefe Deptº. Técnico</option>'                            
								<option value='Adminstrador'>Adminstrador</option>'                            
						</select>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='telefone'>
							Telefone:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='telefone' id='telefone' onfocus='searchVendor()'>
					</div>
				</div>



			            <div class='form-row'>
			                <div class='form-label col-md-2'>
			                    <label for='Especialidade'>
			                        Especialidade:
			                    </label>
							</div>
							
							
			                <div class='form-input col-md-6'>
			                    <select name='especialidade' class='form-control'>
			                            <option value=''>-- Selecione --</option>
			                            <option value='Não aplicavel'>Não aplicavel</option>'                            
			                            <option value='Análise Clínica'>Análise Clínica</option>'                            
			                            <option value='Cardiologia'>Cardiologia</option>'                            
			                            <option value='Clínica Geral'>Clínica Geral</option>'                            
			                            <option value='Defectólogia'>Defectólogia</option>'                            
			                            <option value='Ecónoma'>Ecónoma</option>'                            
			                            <option value='Emangiologia'>Emangiologia</option>'                            
			                            <option value='Estomatologia'>Estomatologia</option>'                            
			                            <option value='Farmácia'>Farmácia</option>'                                  
			                            <option value='Fisioterapia'>Fisioterapia</option>'                                  
			                            <option value='Logista'>Logista</option>'                                  
			                            <option value='Medicina'>Medicina</option>'                                  
			                            <option value='Medicina Interna'>Medicina Interna</option>'                                  
			                            <option value='Neorologia'>Neorologia</option>'                                  
			                            <option value='Oncologia'>Oncologia</option>'                                  
			                            <option value='Ortopedia'>Ortopedia</option>'                                  
			                            <option value='Ortopedia & Traumatologia'>Ortopedia & Traumatologia</option>'                                  
			                            <option value='Ortoprotesia'>Ortoprotesia</option>'                                  
			                            <option value='Psicóloga'>Psicóloga</option>'                                  
			                            <option value='Psicoterapia'>Psicoterapia</option>'                                  
			                            <option value='Radiologia'>Radiologia</option>'                                  
			                            <option value='Urologia'>Urologia</option>'                                  
			                    </select>
							</div> 
			            </div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='estado'>
							*Estado:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<select required='required' id='estado' name='estado'class='form-control'>
								<option value=''selected='selected'>-- Selecione --</option>                          
								<option value='Activo'>Activo</option>'                            
								<option value='Inactivo'>Inactivo</option>'                            
						</select>
					</div>
				</div>
				<h2>Informações Complementares</h2><br>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='email'>
							Email:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='email' id='email' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='tipo_id'>
							*Tipo de ID:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<select id='tipo_id' name='tipo_id'class='form-control'>
								<option value=''selected='selected'>-- Selecione --</option>                          
								<option value='Não Aplicavel'>Não Aplicavel</option>'                            
								<option value='Bilhete'>Bilhete</option>'                            
								<option value='Cédula'>Cédula</option>'                            
								<option value='Passaporte'>Passaporte</option>'    
						</select>                        
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='n_identificacao'>
							*Nº de Identificação:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='n_identificacao' id='n_identificacao' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='endereco'>
							*Endereço:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='endereco' id='endereco' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='pais'>
							*País:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='pais' id='pais' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='provincia'>
							*Naturalidade:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='provincia' id='provincia' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='n_seguranca_social'>
							*Nº de Segurança Social:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='n_seguranca_social' id='n_seguranca_social' onfocus='searchVendor()'>
					</div>
				</div>
	
				<div class='form-row'>
					<div class='form-label col-md-2'>
						<label for='n_identificacao_fiscal'>
							*Nº de Identificação Fiscal:
						</label>
					</div>
					<div class='form-input col-md-6'>
						<input type='text' name='n_identificacao_fiscal' id='n_identificacao_fiscal' onfocus='searchVendor()'>
					</div>
				</div>

		<br>

	<button style='float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn medium' name='add'>
	    <span class='button-content'>Salvar</span>
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
			<th>Nº Processo</th>
			<th>&nbsp;&nbsp;&nbsp;Nome Completo</th>
			<th>Funcao</th>
			<th>&nbsp;&nbsp;&nbsp;Gênero</th>
			<th>&nbsp;&nbsp;&nbsp;Telefone</th>
			<th>&nbsp;&nbsp;&nbsp;Endereço</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_funcionario";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>".$row['Id']."</td>
			<td>
				<a href='funcionarios.php?Id=".$row['Id']."&acao=ver '>".$row['nome']."</a>
			</td>
			<td>".$row['funcao']."</td>
			<td>".$row['genero']."</td>
			<td>".$row['telefone']."</td>
			<td><a href='#'>".$row['endereco']."</a></td>
			<td>
			<form method='get' action='funcionarios.php'>
				<a href='funcionarios.php?Id=".$row['Id']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
			        <i class='glyph-icon icon-edit'></i>
			    </a>
			    <a href='funcionarios.php?Id=".$row['Id']."&acao=ver ' class='btn small bg-gray tooltip-button' data-placement='top' title='Ver'>
			        <i class='glyph-icon icon-eye'></i>
			    </a>
			</form>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
	<form method='post' action='funcionarios.php'>
	    <a title='Novo funcionario' href='funcionarios.php'>
	       <button style='font-size:20px; font-size:20px; background-color: #149900; color: #fff;' name='add_novo_funcionario' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button'>
		        <i class='glyph-icon icon-plus'></i>
		        Novo funcionario
	        </button>
	    </a>
	    <a style='font-size:15px; padding:6px; font-size:16px; background-color: #149900; color: #fff;' title='Imprimir' target='_blank' href='imprimir/imprimir_funcionarios.php' class='print small btn primary-bg'>
		        <i class='glyph-icon icon-print'></i>
	    </a><br><br>
	</form>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
