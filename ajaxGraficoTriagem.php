<?php
		$con = mysqli_connect("localhost", "root", "ANGO_covdb157016");
		mysqli_select_db($con, "cov");
		$data = date('Y-m-d');
		//Our YYYY-MM-DD date string.
		$date = $data;

		//echo $data;
		//Convert the date string into a unix timestamp.
		$unixTimestamp = strtotime($date);
		//Get the day of the week using PHP's date function.
		$dayOfWeek = date("l", $unixTimestamp);
		//Print out the day that our date fell on.

		if($dayOfWeek == 'Saturday'){
			$diaDaSemana = 'Sabado';
		} else if($dayOfWeek == 'Sunday'){
			$diaDaSemana = 'Domingo';
		} else if($dayOfWeek == 'Monday'){
			$diaDaSemana = 'Segunda-Feira';
		} else if($dayOfWeek == 'Tuesday'){
			$diaDaSemana = 'Terca-Feira';
		} else if($dayOfWeek == 'Wednesday'){
			$diaDaSemana = 'Quarta-Feira';
		} else if($dayOfWeek == 'Wednesday'){
			$diaDaSemana = 'Quarta-Feira';
		} else if($dayOfWeek == 'Thursday'){
			$diaDaSemana = 'Quinta-Feira';
		} else if($dayOfWeek == 'Friday'){
			$diaDaSemana = 'Sexta-Feira';
		}             
		$query="SELECT tbl_consultorio.nome as consultorio, tbl_users.display_name, tbl_users.id FROM tbl_users 
		INNER JOIN tbl_agenda_medico ON (tbl_users.id = tbl_agenda_medico.id_medico)
		INNER JOIN tbl_consultorio ON (tbl_consultorio.id_consultorio = tbl_agenda_medico.consultorio)        
		WHERE tbl_agenda_medico.dia_da_semana = '$diaDaSemana'";
				//var_dump($query);
		$result=mysqli_query($con,$query);
		
		while($row=mysqli_fetch_array($result))
		{
		echo"<div class='col-lg-6'style='margin-top:30px;'>
			<a href='#' class='tile-button btn'style='background-color: #149900; color: #fff;' title=''>
				<div class='tile-header'>
				</div>
				<div class='tile-content-wrapper'>
					<div class='tile-content'>
						<center>
						".utf8_encode($row['consultorio'])."
						</center>
						<hr style='color: gray;'>
					</div>
					<div class='tile-content'>
					<center>";
						echo $row['display_name'];    
						echo"
					</center>
					</div>
				</div>
				<div class='tile-footer'>";
						$id_medico = $row['id'];
						$data = date('Y-m-d');
						$n = 1;
						$queryA="SELECT id_paciente FROM tbl_agenda WHERE id_medico ='$id_medico' AND data ='$data'ORDER BY data DESC";
						$resultA=mysqli_query($con,$queryA);
						while ($rowA = mysqli_fetch_array($resultA)) {
							$id_paciente = $rowA['id_paciente'];
							$queryP="SELECT nome FROM tbl_paciente WHERE Id ='$id_paciente' AND triado = 1 AND atendido_medico = 0";
							$resultP=mysqli_query($con,$queryP);
							while ($rowP = mysqli_fetch_array($resultP)) {
								echo "<h4>".utf8_encode($rowP['nome'])." "." <span style='display: inline; position: relative; bottom: 18px; float: right;'>".$n."</span></h4>";
								$n++;
							}
						}                            
					echo "
				</div>
			</a>
		</div>";
		}
?>
