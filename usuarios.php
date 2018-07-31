<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
//Forms posted
if(!empty($_POST['submit']))
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
        <h3>Usuários do Sistema</h3>
    </div>
    <div id='g10' class='small-gauge float-left hidden'></div>
    <div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
    <div id='page-content' style='margin-top:-18px;'>"; 
if(isset($_GET['Id']))
		{
		$acao = sanitize($_GET['acao']);
		$Id = sanitize($_GET['Id']);
		$con=connection();
		
		if ($Id != 1) {
			if ($acao == 'apagar') {
				$query="DELETE FROM tbl_users WHERE id = '$Id'";
				$a=mysqli_query($con,$query) ? true : false ;
				if($a)
                        echo "<script>swal('Utilizador Removido Com Sucesso','','success');</script>";
            	else echo "
                        <script>swal('Ocorreu um erro','O utilizador não foi removido','error');</script>
                    ";
			}
			if ($acao == 'editar') {
				$query="SELECT * FROM tbl_users WHERE id = '$Id'";

				$result=mysqli_query($con,$query);
				while($row=mysqli_fetch_array($result)) {
				
				$selecioneAdmin = '';
				$selecioneCataloga = '';
				$selecioneCaixa = '';
				$selecioneEnfermeiro = '';
				$selecioneDoctor = '';
                $selecioneTesoreiro = '';
                $selecioneFarmaceutico = '';
                $selecioneGestorEstoque = '';
                $selecioneRH = '';
                $selecioneGrafico = '';

				if ($row['title'] == 'admin') 
					$selecioneAdmin = 'selected'; 
				elseif ($row['title'] == 'catalogador') 
					$selecioneCataloga = 'selected'; 
				elseif ($row['title'] == 'caixa') 
					$selecioneCaixa = 'selected';
				elseif ($row['title'] == 'enfermeiro') 
					$selecioneEnfermeiro = 'selected'; 
				elseif ($row['title'] == 'doctor') 
					$selecioneDoctor = 'selected'; 
                elseif ($row['title'] == 'tesoreiro') 
                    $selecioneTesoreiro = 'selected'; 
                elseif ($row['title'] == 'farmaceutico') 
                    $selecioneFarmaceutico = 'selected'; 
                elseif ($row['title'] == 'gestorEstoque') 
                    $selecioneGestorEstoque = 'selected'; 
                elseif ($row['title'] == 'grafico') 
                    $selecioneGrafico = 'selected'; 
				
				echo "
				<h2>Informações Iniciais</h2><br>
							<a href='usuarios.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
				<form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
							<input type='hidden' name='Id' value='$Id'>
				            <div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='username'>
				                        Nome do utilizador:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <input required='required' type='text' value='".$row['user_name']."' name='username' id='username'>
				                </div>
				            </div>

							<div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='displayname'>
				                        Nome de exibição:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <input required='required' type='text' value='".$row['display_name']."' name='displayname' id='displayname'>
				                </div>
				            </div>

							<div class='form-row'>
				                <div class='form-label col-md-2'>
				                    <label for='password'>
				                        Nova Senha:
				                    </label>
				                </div>
				                <div class='form-input col-md-6'>
				                    <input required='required' type='password' name='password' id='password'>
				                </div>
				            </div>
				            <div class='form-row'>
			                    <div class='form-label col-md-2'>
			                        <label for='categoria'>
			                            Categoria:
			                        </label>
			                    </div>
			                    <div class='form-input col-md-6'>
			                        <select required='required' id='categoria' name='categoria'class='form-control'>                 
											<option ".$selecioneAdmin." value='administrador'>Administrador</option>' 
			                                <option ".$selecioneCaixa." value='caixa'>Caixa</option>'                            
											<option ".$selecioneCataloga." value='catalogador'>Catalogador</option>'   
			                                <option ".$selecioneDoctor." value='doctor'>Doctor</option>'                            
			                                <option ".$selecioneEnfermeiro." value='enfermeiro'>Enfermeiro</option>'                            
                                            <option ".$selecioneTesoreiro." value='tesoreiro'>Tesoreiro</option>'                            
                                            <option ".$selecioneFarmaceutico." value='farmaceutico'>Farmaceutico</option>'                            
                                            <option ".$selecioneGestorEstoque." value='gestorEstoque'>Gestor de Estoque</option>'                            
                                            <option ".$selecioneRH." value='rh'>Recursos Humanos</option>'                            
                                            <option ".$selecioneGrafico." value='grafico'>Gráfico</option>'                            
			                        </select>
			                    </div>
			                </div>

							<br>
							<button style='background-color: #149900; color: #fff;' class='btn medium' name='editar'>
							    <span class='button-content'>Editar</span>
							    <i class='glyph-icon icon-save'></i>
							</button>
							</form>         
							";
						}
				die();
			    }
		}		
}	   
echo resultBlock($errors,$successes);
	if (isset($_POST['editar'])) {
			$id = $_POST['Id'];
			$email = '';
			$username = trim($_POST["username"]);
			$displayname = trim($_POST["displayname"]);
			$password = trim(generateHash($_POST["password"]));
			$categoria = trim($_POST["categoria"]);

		    $con=connection();

		    $query = "	UPDATE 	tbl_users SET 
		    					user_name	=	'$username', 
							    display_name=	'$displayname', 
							    password	=	'$password',
							    email		=	'$email', 							     
							    title	=	'$categoria' 
							    WHERE 
							    id 			= 	'$id'
		    ";

		    $a=mysqli_query($con,$query) ? true : false ;

		    if($a)
                echo "<script>swal('Utilizador Atualizado Com Sucesso','','success');</script>";
            else echo "
                        <script>swal('Ocorreu um erro','O utilizador não foi atualizado','error');</script>
                    ";
		}	

    if (isset($_POST['add_novo_usuario'])) {
    echo "

    <h2>Cadastro de Usuários</h2><br>
    <form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='nome'>
                            Nome:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input required='required' type='text' name='nome' id='nome' onfocus='searchVendor()'>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='categoria'>
                            Categoria:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <select required='required' id='categoria' name='categoria'class='form-control'>
                                <option value='' selected='selected'>-- Selecione --</option>                          
                                <option value='administrador'>Administrador</option>'                            
                                <option value='catalogador'>Catalogador</option>'                            
                                <option value='caixa'>Caixa</option>'                            
                                <option value='enfermeiro'>Enfermeiro</option>'                            
                                <option value='doctor'>Doctor</option>'                            
                                <option value='grafico'>Gráfico</option>'                            
                        </select>
                    </div>
                </div>

                <h3>  Dados para Acesso:</h3>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='login'>
                            Login:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input required='required' type='text' name='login' id='login' onfocus='searchVendor()'>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='senha'>
                            Senha:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input required='required' type='password' name='senha' id='senha' onfocus='searchVendor()'>
                    </div>
                </div>

    <br>

    <button style='background-color: #149900; color: #fff;' class='btn medium' name='add'>
        <span class='button-content'>Cadastrar</span>
        <i class='glyph-icon icon-save'></i>
    </button>
    </form>         
    "; die();
}
echo "
    <form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
        <table class='table' id='example1'> 
            <thead>
                <tr>
                    <th>Nome do Usuário</th>
                    <th>Nome a mostrar</th>
                    <th>Categoria</th>
                    <th>Última vez que logou</th>
                    <th>Opções</th>
                </tr>
            </thead>";

            //Cycle through users
            foreach ($userData as $v1) {
                echo "
                    <tr>
                        <td>".utf8_decode($v1['user_name'])."</td>
                        <td>".utf8_encode($v1['display_name'])."</td>
                        <td>".$v1['title']."</td>
                        <td>
                    ";
                
                        //Interprety last login
                        if ($v1['last_sign_in_stamp'] == '0'){
                            echo "Nunca";   
                        }
                        else {
                            echo date("d-m-Y", $v1['last_sign_in_stamp']);
                        }
                        echo "
                        </td>
                        <td>";
                        	if ($v1['id'] != 1) {
                        	echo"
                        	<a href='usuarios.php?Id=".$v1['id']."&acao=editar ' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
						        <i class='glyph-icon icon-edit'></i>
						    </a>
						    <a href='usuarios.php?Id=".$v1['id']."&acao=apagar ' class='btn small bg-red tooltip-button' data-placement='top' title='Apagar'>
						        <i class='glyph-icon icon-remove'></i>
						    </a>";
						}
						echo"
                        </td>
                    </tr>";
    }

echo "
        </table>
        
        <a href='novo_usuario.php' style='background-color: #149900; color: #fff;' class='btn medium tooltip-button col-md-1' name='add_novo_usuario' name='add_novo_usuario' />
            <i class='glyph-icon icon-plus'></i>
            Novo
        </a>
        <a style='background-color: #149900; color: #fff; margin-left:5px; font-size:15px; padding:3px;' title='Imprimir' target='_blank' href='imprimir/imprimir_usuarios.php' class='print small btn primary-bg'>
            <i class='glyph-icon icon-print'></i>
        </a>
    </form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
