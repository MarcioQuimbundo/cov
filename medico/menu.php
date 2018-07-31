<?php
		    		
		    		$Id = sanitize($_GET['Id']);
					
					$con=connection();
		    		
		    		$queryP="SELECT DISTINCT nome FROM tbl_paciente WHERE Id = '$Id'";
					
					$resultP=mysqli_query($con,$queryP);
					
					$rowP=mysqli_fetch_row($resultP);

					echo '<br><h2 style="text-align: center; margin-left: 12%;">'.utf8_encode($rowP[0]).'</h2>';
		    				    		echo "
						<div id='regbox' style='margin-top:-10px;'><br>
						<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'>
							<button style='float:right' class='btn bg-red small' name='finalizar_consulta'>
								<span class='button-content'>FINALIZAR ATENDIMENTO</span>
							</button>
						</form>
						<br>			
						<form name='#' class='form-bordered' action='pacientes_consulta.php?Id=$Id&acao=consultar' method='post'><br>
									
									<div class='col-md-2 text-center' style='width:242px;'>
										<div class='text-left'>
											<a href='pacientes_consulta.php?Id=$Id&acao=consultar&menu=sinais_e_dados' class='btn medium primary-bg small' name='sinais_e_dados' style='background-color: #149900; color: #fff; width:230px; margin-top:10px;'>
												<span class='button-content text-center' style='margin-left:22%;'>SINAIS E DADOS</span>
											</a>
										</div>
										
										<div class='text-left'>
											<a href='pacientes_consulta.php?Id=$Id&acao=consultar&menu=diario_clinico' class='btn medium primary-bg small' name='diario_clinico' style='background-color: #149900; color: #fff; width:230px; margin-top:10px;'>
												<span class='button-content text-center' style='margin-left:22%;'>DIÁRIO CLÍNICO</span>
											</a>
										</div>
										<div class='text-left'>
											<a href='pacientes_consulta.php?Id=$Id&acao=consultar&menu=receituario' class='btn medium primary-bg small' name='receituario' style='background-color: #149900; color: #fff; width:230px; margin-top:10px;'>
												<span class='button-content text-center' style='margin-left:26%;'>RECEITUÁRIO</span>
											</a>
										</div>
										<div class='text-left'>
											<a href='pacientes_consulta.php?Id=$Id&acao=consultar&menu=transferencia_justificativo' class='btn medium primary-bg small' name='transferencia_justificativo' style='background-color: #149900; color: #fff; width:230px; margin-top:10px;'>
												<span class='button-content text-center' style='margin-left:12%;'>JUSTIFICATIVO MÉDICO</span>
											</a>
										</div>
										<div class='text-left'>
											<a href='pacientes_consulta.php?Id=$Id&acao=consultar&menu=exame_clinico' class='btn medium primary-bg small' name='exame_clinico' style='background-color: #149900; color: #fff;width:230px; margin-top:10px;'>
												<span class='button-content text-center' style='margin-left:13%;'>REQUISIÇÃO DE EXAME</span>
											</a>
										</div><div class='text-left'>
											<a href='pacientes_consulta.php?Id=$Id&acao=consultar&menu=tratamentos_e_recomendacoes' class='btn medium primary-bg small' name='tratamentos_e_recomendacoes' style='background-color: #149900; color: #fff;width:230px; margin-top:10px;'>
												<span class='button-content text-center' style='margin-left:22%;'>TRATAMENTOS</span>
											</a>
										</div>									
									</div>	<br>";
?>