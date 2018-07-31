<?php
/*
Centro Ortopédico de Viana V.1
C.O.V
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
include('library.php');
echo "
<body> 
<div id='loading' class='ui-front loader ui-widget-overlay bg-white opacity-100'>
<img src='assets/images/loader-dark.gif' alt=''>
</div>
<div id='page-wrapper' class='demo-example'>";
include('models/topbar.php');
include("models/sidebar.php");
echo "
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>";
echo "
<div id='page-content-wrapper'>
<div id='page-title'>
                                <a title='Voltar' href='tesouraria.php'>
                                   <button name='add_servico_facturacao' class='print small btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                    <i class='glyph-icon icon-arrow-left'></i>
                                    Voltar
                                    </button>
                                </a><br><br>
<h3>Adicionar Serviços Exames
</h3>
</div>
<div id='page-content'>
";
if(!empty($_POST))
{	
$grupo_exame=$_POST['grupo_exame'];	
$servico_exame=$_POST['servico_exame'];
$genero=$_POST["genero"];
$taxa=$_POST['taxa'];
$preco=$_POST['preco'];
$descricao=$_POST['descricao'];
$descricao=implode(" ",$descricao);
$con=connection();
mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$query="INSERT INTO tbl_servico_exame VALUES ('', '$grupo_exame','$servico_exame','$genero','$taxa','$preco','$descricao','1')";

$a=mysqli_query($con,$query) ? true : false ;
if($a)
echo "
            <div class='row'>
                <div class='col-md-4'>
                    <div class='infobox success-bg'>
                        <p>1 Serviço adicionado.</p>
                    </div>
                </div>
			</div>
			";
else echo "
            <div class='row'>
                <div class='col-md-6'>

                    <div class='infobox error-bg mrg0A'>
                        <p>Ocorreu um erro</p>
                    </div>
                </div>
            </div>
		";

}
echo "
<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='grupo_exame'>
                        Grupo Exames:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='grupo_exame'class='form-control'>
                            <option value=''selected='selected'>Selecione Uma Categoria</option>                          
                            <option value='Anatomopatologia'>Anatomopatologia</option>'                            
                            <option value='Bioquímica'>Bioquímica</option>'                            
                            <option value='Citológia'>Citológia</option>'                            
                            <option value='Colesterol'>Colesterol</option>'                            
                            <option value='Coprológicos'>Coprológicos</option>'                            
                            <option value='Expermográma'>Expermográma</option>'                            
                            <option value='Gilcemia'>Gilcemia</option>'                            
                            <option value='Gotas Espécies'>Gotas Espécies</option>'                            
                            <option value='Hermatologia'>Hermatologia</option>'                            
                            <option value='Hermatológicos'>Hermatológicos</option>'                            
                            <option value='Hormonais'>Hormonais</option>'                            
                            <option value='Imagologia'>Imagologia</option>'                            
                            <option value='Imunológicos'>Imunológicos</option>'                            
                            <option value='Microbiologia'>Microbiologia</option>'                            
                            <option value='Microbiológicos'>Microbiológicos</option>'                            
                            <option value='Parastológicos'>Parastológicos</option>'                            
                            <option value='Raio X07'>Raio X07</option>'                            
                            <option value='Serologia'>Serologia</option>'                            
                            <option value='Serológicos'>Serológicos</option>'                            
                            <option value='Taso'>Taso</option>'                            
                            <option value='Unianálsie'>Unianálsie</option>'                            
                            <option value='Urinologia'>Urinologia</option>'                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='servico_exame'>
                        Serviço de Exame :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='servico_exame' id='servico_exame' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='genero'>
                        Gênero :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='genero' name='genero'class='form-control'>
                            <option value='genero'selected='selected'>Selecione Um Gênero</option>                          
                            <option value='Masculino'>Masculino</option>'                            
                            <option value='Femenino'>Femenino</option>'                            
                            <option value='Ambos'>Ambos</option>'                            
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='taxa'>
                        Taxa :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='taxa'class='form-control'>
                            <option value=''selected='selected'>Selecione Uma Taxa</option>                          
                            <option value='Imposto Não Aplicavel'>Imposto Não Aplicavel</option>'                            
                            <option value='Imposto de Consumo'>Imposto de Consumo</option>'                            
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='preco'>
                        Preço :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='preco' id='preco' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
                     Descrição :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
               
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='descricao[]' id='descricao'>
                </div>
            </div>												
<br>
<button class='btn primary-bg medium'>
    <span class='button-content'>Adicionar</span>
</button>
</form>			
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
