
<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn() && ($loggedInUser->title == 'admin')) { header("Location: painel.php"); die();}
    else if(isUserLoggedIn() && ($loggedInUser->title == 'doctor')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'catalogador')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'caixa')) { header("Location: painel_caixa.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'enfermeiro')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'tesoreiro')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'farmaceutico')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'gestorEstoque')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'rh')) { header("Location: painel.php"); die(); }
    else if(isUserLoggedIn() && ($loggedInUser->title == 'grafico')) { header("Location: painelGrafico.php"); die(); }


//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
                echo"<script>alert('Não pode Aceder o caixa!!!','','success');</script>";
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;
					
					//Redirect to user account page
                    if($loggedInUser->title == 'admin') { header("Location: painel.php"); die(); 
                    }else if($loggedInUser->title == 'doctor') { header("Location: painel.php"); die(); }
                    else if($loggedInUser->title == 'catalogador') { header("Location: painel.php"); die(); }
                    else if($loggedInUser->title == 'caixa') { header("Location: painel_caixa.php"); die(); }
                    else if($loggedInUser->title == 'enfermeiro') { header("Location: painel.php"); die(); }
                    else if($loggedInUser->title == 'tesoreiro') { header("Location: painel.php"); die(); }
                    else if($loggedInUser->title == 'farmaceutico') { header("Location: painel.php"); die(); }
                    else if($loggedInUser->title == 'gestorEstoque') { header("Location: painel.php"); die(); }
                    else if($loggedInUser->title == 'grafico') { header("Location: painelGrafico.php"); die(); }
					die();
				}
			}
		}
	}
}

require_once("models/header.php");
echo "
<img src='assets/images/login-bg.jpg' class='login-img' alt=''>
<div class='ui-widget-overlay bg-black opacity-60'></div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>
<div id='login-page'>
    <form action='".$_SERVER['PHP_SELF']."' method='post' style='font-size:25px;'>

        <div class='ui-dialog col-md-3 center-margin form-vertical modal-dialog' id='login-form'>
            <div class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix' style='background-color:white; font-size:30px; padding:20px; color:black; border-bottom:1px solid gray;'>
                <center><span class='ui-dialog-title'>Iniciar sessão</span></center>
            </div>
            <div class='pad20A ui-dialog-content ui-widget-content'>
               ";
			   if(count($errors)!=0)
			   {
			   echo " 
				<div style='font-size:15px; display: none;' class='infobox clearfix infobox-close-wrapper error-bg mrg20B'>
                    <a href='#' title='Close Message' class='glyph-icon infobox-close icon-remove'></a>
                    <p>";
					echo resultBlock($errors,$successes);
					echo "
					</p>
                </div>";
			   }
				echo "
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                       
                    </div>
                    <div class='form-input col-md-10'>
                        <div class='form-input-icon'>
                            <i style='height:0px;' class='glyph-icon icon-user ui-state-default'></i>
                            <input style='font-size:17px;height:30px;' placeholder='Nome de utilizador' type='text' name='username' id=''>
                        </div>
                    </div>
                </div>

                <div class='form-row' style='margin-bottom:-20px;'>
                    <div class='form-label col-md-2'>                        
                    </div>
                    <div class='form-input col-md-10'>
                        <div class='form-input-icon'>
                            <i style='height:0px;' class='glyph-icon icon-unlock-alt ui-state-default'></i>
                            <input style='font-size:17px;height:30px;' placeholder='Senha' type='password' name='password' id=''>
                        </div>
                    </div>
                </div>
            </div>
            <div class='ui-dialog-buttonpane text-center' col-md-6 >
                <button style=' background-image:-webkit-linear-gradient(top,#337ab7 0,#265a88 100%); width:100%;' type='submit' class='btn large primary-bg text-transform-upr font-bold font-size-11 ' id='demo-form-valid' title='Validate!'>
                    <span class='text-center button-content' style='text-align:center; width:92%;'>
                        Logar
                    </span>
                </button>
            </div>
        </div>

        <div class='ui-dialog col-md-4 center-margin form-vertical modal-dialog mrg15T hide' id='login-forgot'>
            <div class='ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix'>
                <span class='ui-dialog-title'>Recover password</span>
            </div>
            <div class='pad20A ui-dialog-content ui-widget-content'>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for=''>
                            Username :
                        </label>
                    </div>
                    <div class='form-input col-md-10'>
                        <div class='form-input-icon'>
                            <i class='glyph-icon icon-envelope-o ui-state-default'></i>
                            <input placeholder='Email address' type='text' name='' id=''>
                        </div>
                    </div>
                </div>


            </div>
            <div class='ui-dialog-buttonpane text-center'>
                <button type='submit' class='btn large primary-bg radius-all-4' id='demo-form-valid' onclick='javascript:$(&apos;#demo-form&apos;).parsley( &apos;validate&apos; );' title='Validate!'>
                    <span class='button-content'>
                        Recover Password
                    </span>
                </button>
                <a href='javascript:;' switch-target='#login-form' switch-parent='#login-forgot' class='btn large transparent no-shadow toggle-switch font-bold font-size-11 radius-all-4' id='demo-form-valid' onclick='javascript:$(&apos;#demo-form&apos;).parsley( &apos;validate&apos; );' title='Validate!'>
                    <span class='button-content'>
                        Cancel
                    </span>
                </a>
            </div>
        </div>

    </form>

</div>";


echo "
</body>
</html>";

?>
