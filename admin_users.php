<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
//Forms posted
if(!empty($_POST))
{
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteUsers($deletions)){
		$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$userData = fetchAllUsers(); //Fetch information for all users

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
		<h3>utilizadors do Sistema</h3>
	</div>
	<div id='g10' class='small-gauge float-left hidden'></div>
	<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

echo resultBlock($errors,$successes);

echo "
	<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
		<table class='table' id='example1'> 
			<thead>
				<tr>
					<th>Apagar</th>
					<th>Nome do utilizador</th>
					<th>Nome a mostrar</th>
					<th>Categoria</th>
					<th>Última vez que logou</th>
				</tr>
			</thead>";

			//Cycle through users
			foreach ($userData as $v1) {
				echo "
					<tr>
						<td>
							<input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'>
						</td>
						<td>".utf8_encode($v1['user_name'])."</td>
						<td>".utf8_encode($v1['display_name'])."</td>
						<td>".$v1['title']."</td>
						<td>
					";
				
						//Interprety last login
						if ($v1['last_sign_in_stamp'] == '0'){
							echo "Never";	
						}
						else {
							echo date("j M, Y", $v1['last_sign_in_stamp']);
						}
						echo "
						</td>
						</tr>";
	}

echo "
		</table>
		<input class='btn medium bg-blue-alt tooltip-button' type='submit' name='Submit' value='Apagar' />
	</form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
