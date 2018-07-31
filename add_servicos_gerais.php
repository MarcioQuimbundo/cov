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

<h3>Adicionar Serviços Gerais
</h3>
</div>
<div id='page-content'>
";
if(!empty($_POST))
{	
$servico=$_POST['servico'];	
$especialidade=$_POST['especialidade'];
$tipo_servico=$_POST["tipo_servico"];
$taxa=$_POST['taxa'];
$preco=$_POST['preco'];
$categoria=$_POST['categoria'];
$descricao=$_POST['descricao'];
$descricao=implode(" ",$descricao);
if (empty($servico) || empty($especialidade) || empty($tipo_servico) || empty($taxa) || empty($preco) || empty($categoria) || empty($descricao) ) {
        echo "
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='infobox error-bg mrg0A'>
                            <p>Por favor, preencha todos os campos.</p>
                        </div>
                    </div>
                </div>
            ";
    }else{
    $con=connection();
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $query="INSERT INTO tbl_servico VALUES ('', '$servico','$especialidade','$tipo_servico','$taxa','$preco','$categoria','$descricao','1')";

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
}
echo "
<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='servico'>
                        Serviço:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='servico' id='servico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='especialidade'>
                        Especialidade :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='especialidade' class='form-control'>
                            <option value=''selected='selected'>Selecione Uma Especialidade</option>
                            <option value='Não aplicavel'>Não aplicavel</option>'                            
                            <option value='Acupuntura'>Acupuntura</option>'                            
                            <option value='Administrativo'>Administrativo</option>'                            
                            <option value='Análise Clínica'>Análise Clínica</option>'                            
                            <option value='Barbeiro'>Barbeiro</option>'                            
                            <option value='Cardiologia'>Cardiologia</option>'                            
                            <option value='Clínica Geral'>Clínica Geral</option>'                            
                            <option value='Copeiro(a)'>Copeiro(a)</option>'                            
                            <option value='Cortador(a)'>Cortador(a)</option>'                            
                            <option value='Cozinheiro(a)'>Cozinheiro(a)</option>'                            
                            <option value='Defectólogia'>Defectólogia</option>'                            
                            <option value='Ecónoma'>Ecónoma</option>'                            
                            <option value='Eléctrecista'>Eléctrecista</option>'                            
                            <option value='Emangiologia'>Emangiologia</option>'                            
                            <option value='Estomatologia'>Estomatologia</option>'                            
                            <option value='Farmácia'>Farmácia</option>'                                  
                            <option value='Fisioterapia'>Fisioterapia</option>'                                  
                            <option value='Logista'>Logista</option>'                                  
                            <option value='Medicina'>Medicina</option>'                                  
                            <option value='Medicina'>Medicina Interna</option>'                                  
                            <option value='Neorologia'>Neorologia</option>'                                  
                            <option value='Oncologia'>Oncologia</option>'                                  
                            <option value='Operador Lavandaria'>Operador Lavandaria</option>'                                  
                            <option value='Ortopedia'>Ortopedia</option>'                                  
                            <option value='Ortopedia & Traumatologia'>Ortopedia & Traumatologia</option>'                                  
                            <option value='Ortoprotesia'>Ortoprotesia</option>'                                  
                            <option value='Porteiro'>Porteiro</option>'                                  
                            <option value='Psicóloga'>Psicóloga</option>'                                  
                            <option value='Psicoterapia'>Psicoterapia</option>'                                  
                            <option value='Radiologia'>Radiologia</option>'                                  
                            <option value='Roupeira'>Roupeira</option>'                                  
                            <option value='Telefonista'>Telefonista</option>'                                  
                            <option value='Urologia'>Urologia</option>'                                  
                            <option value='Vigilante'>Vigilante</option>'                                  
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='tipo_servico'>
                        Tipo de Serviço :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='tipo_servico' name='tipo_servico'class='form-control'>
                            <option value=''selected='selected'>Selecione Um Tipo de Serviço</option>                          
                            <option value='Acupuntura'>Acupuntura</option>'                            
                            <option value='Atestado Médico Para Carta de Condução'>Atestado Médico Para Carta de Condução</option>'                            
                            <option value='Cardiovascular'>Cardiovascular</option>'                            
                            <option value='Cardiologia'>Cardiologia</option>'                            
                            <option value='Clínica Geral'>Clínica Geral</option>'                              
                            <option value='Defectólogia'>Defectólogia</option>'                             
                            <option value='Emangiologia'>Emangiologia</option>'                            
                            <option value='Estomatologia'>Estomatologia</option>'                            
                            <option value='Fisiatria'>Fisiatria</option>'                                  
                            <option value='Fisioterapia'>Fisioterapia</option>'                               
                            <option value='Medicina Interna'>Medicina Interna</option>'                                  
                            <option value='Neorologia'>Neorologia</option>'                                             
                            <option value='Oncologia'>Oncologia</option>'                                  
                            <option value='Ortopedia & Traumatologia'>Ortopedia & Traumatologia</option>'                                
                            <option value='Psiocologa'>Psiocologa</option>'                                       
                            <option value='Urologia'>Urologia</option>'                                    
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
                    <label for='categoria'>
                        Categoria :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='categoria'class='form-control'>
                            <option value=''selected='selected'>Selecione Uma Categoria</option>                          
                            <option value='Consultas'>Consultas</option>'                            
                            <option value='Outros Serviços'>Outros Serviços</option>'                            
                    </select>
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
