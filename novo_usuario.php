<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');

if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["username"]);
    $email = $email . "@cov.co.ao";
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$categoria = trim($_POST["title"]);
	$captcha = md5($_POST["captcha"]);
        if($password != $confirm_pass)
        {
            echo "<script>alert('Corfimação de password diferente da password');</script>";
            echo "<script>document.location.href = 'novo_usuario.php';</script>";
        }else{
		//Construct a user object
		$user = new User($username,$displayname,$password,$email,$categoria);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user->userCakeAddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
                if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
                echo "<script>swal('Utilizador Adicionado Com Sucesso','','success');</script>";    
			}
        }
        
    }
}

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
        <h3>Novo utilizador do Sistema</h3>
    </div>
    <div id='g10' class='small-gauge float-left hidden'></div>
    <div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
    <div id='page-content' style='margin-top:-18px;'>"; 
echo "
<div id='regbox'><br>
			<a href='usuarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
				<span class='button-content'>Voltar</span>
				<i class='glyph-icon icon-arrow-left'></i>
			</a><br>			<br>
<form name='newUser' action='".$_SERVER['PHP_SELF']."' method='post'><br>
    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='nome'>
                Nome do utilizador:
            </label>
        </div>
        <div class='form-input col-md-6'>
            <input required='required' type='text' name='username' />
        </div>
    </div>

    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='nome'>
                Nome de exibição:
            </label>
        </div>
        <div class='form-input col-md-6'>
            <input required='required' type='text' name='displayname' />
        </div>
    </div>

    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='nome'>
                Password:
            </label>
        </div>
        <div class='form-input col-md-6'>
            <input required='required' type='password' name='password' />
        </div>
    </div>

    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='passwordc'>
                Confirmar Password:
            </label>
        </div>
        <div class='form-input col-md-6'>
            <input required='required' type='password' name='passwordc' />
        </div>
    </div>

    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='title'>
                Categoria:
            </label>
        </div>
        <div class='form-input col-md-6'>
		    <select required='required' name='title' class='form-control'>
		        <option value='' selected='selected'>-- Selecione --</option>                          
                <option value='admin'>Administrador</option>'                                              
                <option value='caixa'>Caixa</option>'      
                <option value='catalogador'>Catalogador</option>'                          
		        <option value='doctor'>Doctor</option>'            		                             
                <option value='enfermeiro'>Enfermeiro</option>'
                <option value='tesoreiro'>Tesoureiro</option>'                            
                <option value='farmaceutico'>Farmacêutico</option>'                            
                <option value='gestorEstoque'>Gestor de Estoque</option>'                            
                <option value='rh'>Recursos Humanos</option>'                            
                <option value='grafico'>Gráfico</option>'                            
		    </select>
        </div>
    </div>

    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='captcha'>
                Código de segurança:
            </label>
        </div>
        <div class='form-input col-md-6'>
            <img src='models/captcha.php'>
        </div>
    </div>

    <div class='form-row'>
        <div class='form-label col-md-2'>
            <label for='nome'>
                Insira o código de segurança:
            </label>
        </div>
        <div class='form-input col-md-6'>
            <input required='required' name='captcha' type='text'>
        </div>
    </div>
    <input style='margin-right:10px; background-color: #149900; color: #fff;' class='btn medium primary-bg col-md-1' required='required' type='submit' value='Cadastrar'/>
</form>
</div>
</div>
<div id='bottom'></div>
</div>
</body>";
?>