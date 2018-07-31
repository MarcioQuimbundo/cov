<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

if(!empty($_POST))
{
	$errors = array();
	$successes = array();
	$password = $_POST["password"];
	$password_new = $_POST["passwordc"];
	$password_confirm = $_POST["passwordcheck"];
	
	$errors = array();
	$email = $_POST["email"];
	
	//Perform some validation
	//Feel free to edit / change as required
	
	//Confirm the hashes match before updating a users password
	$entered_pass = generateHash($password,$loggedInUser->hash_pw);
	
	if (trim($password) == ""){
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}
	else if($entered_pass != $loggedInUser->hash_pw)
	{
		//No match
		$errors[] = lang("ACCOUNT_PASSWORD_INVALID");
	}	
	if($email != $loggedInUser->email)
	{
		if(trim($email) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
		}
		else if(!isValidEmail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
		else if(emailExists($email))
		{
			$errors[] = lang("ACCOUNT_EMAIL_IN_USE", array($email));	
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			$loggedInUser->updateEmail($email);
			$successes[] = 'Conta atualizada com sucesso';
		}
	}
	
	if ($password_new != "" OR $password_confirm != "")
	{
		if(trim($password_new) == "")
		{
			$errors[] = 'lang("ACCOUNT_SPECIFY_NEW_PASSWORD")';
		}
		else if(trim($password_confirm) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_CONFIRM_PASSWORD");
		}
		else if(minMaxRange(8,50,$password_new))
		{	
			$errors[] = lang("ACCOUNT_NEW_PASSWORD_LENGTH",array(8,50));
		}
		else if($password_new != $password_confirm)
		{
			$errors[] = lang("ACCOUNT_PASS_MISMATCH");
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			//Also prevent updating if someone attempts to update with the same password
			$entered_pass_new = generateHash($password_new,$loggedInUser->hash_pw);
			
			if($entered_pass_new == $loggedInUser->hash_pw)
			{
				//Don't update, this fool is trying to update with the same password Â¬Â¬
				$errors[] = lang("ACCOUNT_PASSWORD_NOTHING_TO_UPDATE");
			}
			else
			{
				//This function will create the new hash and update the hash_pw property.
				$loggedInUser->updatePassword($password_new);
				$successes[] = 'Palavra Passe actualizada';
			}
		}
	}
	if(count($errors) == 0 AND count($successes) == 0){
		$errors[] = 'Nada para actualizar';
	}
}

require_once("models/header.php");
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
<div id='page-title'>
<h3>Configurações do Utilizador
</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>
<div id='page-content'>
";
if(count($errors)!=0 || count($successes)!=0)
{
echo "	
<div class='row'>
<div class='col-md-4'>
                <div class='infobox success-bg'>
                <p>
			";
echo resultBlock($errors,$successes);
echo "
</p>
                </div>
            </div>
			</div>
";
}
echo "
<div id='regbox'>
<form name='updateAccount' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
 <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label>Senha atual:</label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='password' name='password' />
                </div>
            </div>
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label>Email:</label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='email' value='".$loggedInUser->email."' />
                </div>
            </div>
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label>Nova senha:</label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='password' name='passwordc' />
                </div>
            </div>							
<div class='form-row'>
                <div class='form-label col-md-2'>
                    <label>Confirmar senha:</label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='password' name='passwordcheck' />
                </div>
            </div>

<button class='btn primary-bg medium'>
            <span class='button-content'>Editar</span>
        </button>
</form>
</div>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
