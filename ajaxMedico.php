<?php
		$link = mysqli_connect("localhost", "root", "ANGO_covdb157016");
		mysqli_select_db($link, "cov");

		$especialidade = '';
		
		if (isset($_GET['especialidade'])) {
			$especialidade = $_GET['especialidade'];
		}
		if (isset($_GET['diaDaSemana'])) {
			$diaDaSemana = $_GET['diaDaSemana'];
		}

		$res = mysqli_query($link,
		 "SELECT id, display_name FROM tbl_users 
		 INNER JOIN tbl_agenda_medico ON(tbl_agenda_medico.id_medico = tbl_users.id) 
		 INNER JOIN tbl_consultorio ON (tbl_agenda_medico.consultorio = tbl_consultorio.id_consultorio)
		 WHERE tbl_agenda_medico.dia_da_semana = '$diaDaSemana' 
		 AND tbl_consultorio.id_especialidade = '$especialidade'");
		echo "<select id='profissional' name='profissional'>
				<option value=''>-- Selecione o profissional --</option>";
			while ($row = mysqli_fetch_array($res)) {
				echo "<option value ='".$row['id']."'>".$row['display_name']."</option>";
			}
		echo "</select>";
		var_dump($res);
?>
