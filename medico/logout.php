<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/

require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Log the user out
if(isUserLoggedIn())
{
	$loggedInUser->userLogOut();
	header('Location: index.php');
}


?>

