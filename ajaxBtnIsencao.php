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
		$query="SELECT id_paciente FROM tbl_isencao_servicos_gerais WHERE data = 'data_simples'";
				//var_dump($query);
		$result=mysqli_query($con,$query);
		
		echo "	<button class='btn bg-blue-alt large' name='isencao'>
					<span class='button-content'>Isenção</span>
					<i class='glyph-icon icon-money'></i>
				</button>";
?>
