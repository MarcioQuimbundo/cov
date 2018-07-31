<?php
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
<h3>Adicionar Produto
</h3>
</div>
<div id='page-content'>
";
if(!empty($_POST))
{   
$nome=$_POST['nome']; 
$forma_farmaceutica=$_POST['forma_farmaceutica'];
$embalagem=$_POST["embalagem"];
$custo_compra=$_POST['custo_compra'];
$preco_venda=$_POST['preco_venda'];
$taxa=$_POST['taxa'];
$receita=$_POST['receita'];
$descricao=$_POST['descricao'];
$descricao=implode(" ",$descricao);

    if (empty($nome) || empty($forma_farmaceutica) || empty($embalagem) || empty($custo_compra) || empty($preco_venda) || empty($taxa) || empty($receita) || empty($descricao) ) {
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
    $query="INSERT INTO tbl_produto VALUES ('', '$nome','$forma_farmaceutica','$embalagem','$custo_compra','$preco_venda','$taxa','$receita','$descricao')";

    $a=mysqli_query($con,$query) ? true : false ;
    if($a)
    echo "
                <div class='row'>
                    <div class='col-md-4'>
                        <div class='infobox success-bg'>
                            <p>1 Produto adicionado.</p>
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
                    <label for='nome_quimico'>
                        Nome Comercial:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='nome' id='nome' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome_quimico'>
                        Nome Químico:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='nome_quimico' id='nome_quimico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_fabrico'>
                        Data de Fabrico:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='date' name='data_fabrico' id='data_fabrico' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_expiracao'>
                        Data de expiração:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='date' name='data_expiracao' id='data_expiracao' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='forma_farmaceutica'>
                        Forma Farmacéutica:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='forma_farmaceutica' class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>
                            <option value='Não aplicavel'>Não aplicavel</option>'                            
                            <option value='Ampola'>Ampola</option>'                            
                            <option value='Balão'>Balão</option>'                            
                            <option value='Bisnaga'>Bisnaga</option>'                            
                            <option value='Bister'>Bister</option>'                            
                            <option value='Bujão'>Bujão</option>'                            
                            <option value='Capsulas'>Capsulas</option>'                            
                            <option value='Comprimidos'>Comprimidos</option>'                            
                            <option value='Drageas'>Drageas</option>'                            
                            <option value='Emulsão'>Emulsão</option>'                            
                            <option value='Frasco'>Frasco</option>'                            
                            <option value='Linimentos'>Linimentos</option>'                            
                            <option value='Óvulos'>Óvulos</option>'                            
                            <option value='Pílulas'>Pílulas</option>'                            
                            <option value='Pomadas'>Pomadas</option>'                            
                            <option value='Saquetas'>Saquetas</option>'                                  
                            <option value='Soluções'>Soluções</option>'                                  
                            <option value='Supositórios'>Supositórios</option>'                                  
                            <option value='Suspenção'>Suspenção</option>'                                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='apresentacao'>
                        Apresentação :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='apresentacao' name='apresentacao'class='form-control'>
                    <option value='' selected> -- Selecione -- </option>
										 
                    <option value='0' > Não Aplicável </option>
                    <option value='32' > 0,25mg </option>
                    <option value='33' > 0,25mg/2ml </option>                
                    <option value='70' > 0,5g </option>                
                    <option value='20' > 0.5mg </option>                
                    <option value='68' > 0.5mg/ml </option>                
                    <option value='16' > 1 mg/ml </option>                
                    <option value='77' > 100g </option>                
                    <option value='56' > 100g </option>                
                    <option value='47' > 100mg </option>                
                    <option value='13' > 100mg G.R </option>                
                    <option value='12' > 100mg inf. </option>                
                    <option value='27' > 100mg/2ml </option>                
                    <option value='23' > 10mg </option>                
                    <option value='66' > 10mg/2ml </option>                
                    <option value='53' > 10ml </option>                
                    <option value='42' > 120/5ml </option>                
                    <option value='44' > 120/5ml </option>                
                    <option value='72' > 1200mg </option>                
                    <option value='45' > 1200mg </option>                
                    <option value='67' > 125mg/5ml </option>                
                    <option value='63' > 150mg </option>                
                    <option value='75' > 150mg </option>                
                    <option value='28' > 1g </option>                
                    <option value='34' > 1g/2mg </option>                
                    <option value='71' > 1g/5ml </option>                
                    <option value='26' > 1mg/ml </option>                
                    <option value='46' > 2000 ml </option>                
                    <option value='51' > 200mg </option>                
                    <option value='52' > 200mg/100ml </option>                
                    <option value='35' > 200mg/5ml </option>                
                    <option value='62' > 20g </option>                
                    <option value='61' > 20mg </option>                
                    <option value='50' > 20mg/ml </option>                
                    <option value='48' > 20ml </option>                
                    <option value='55' > 240mg </option>                
                    <option value='24' > 250mg </option>                
                    <option value='21' > 250mg/5ml </option>                
                    <option value='9'> 250ml </option>                
                    <option value='22' > 25mg </option>                
                    <option value='65' > 2mg </option>                
                    <option value='10' > 300mg </option>
                    <option value='74' > 300mg </option>                
                    <option value='57' > 30g </option>                
                    <option value='19' > 400mg </option>                
                    <option value='64' > 40mg </option>                
                    <option value='37' > 40mg/2ml </option>
                    <option value='54' > 480mg </option>                
                    <option value='30' > 4mg </option>                
                    <option value='69' > 4mg/2ml </option>                
                    <option value='49' > 4mg/5ml </option>                
                    <option value='39' > 5000 UI </option>                
                    <option value='15' > 500mg </option>                
                    <option value='11' > 500ml </option>                
                    <option value='29' > 50mg </option>                
                    <option value='76' > 50mg/2ml </option>                
                    <option value='36' > 525mg </option>                
                    <option value='14' > 5mg </option>                
                    <option value='38' > 5mg/5ml </option>                
                    <option value='43' > 5mg/ml </option>                
                    <option value='18' > 5ml </option>                
                    <option value='58' > 60g </option>                
                    <option value='31' > 75/3ml </option>                
                    <option value='41' > 750mg </option>                
                    <option value='73' > 800mg </option>                
                    <option value='25' > 80mg/2ml </option>                
                    <option value='40' > 850mg </option>                                 
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='embalagem'>
                        Embalagem :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='embalagem' name='embalagem'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Po Pacote'>Po Pacote</option>'                            
                            <option value='Por Unidade'>Por Unidade</option>'                                   
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='custo_compra'>
                        Custo de compra :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='number' name='custo_compra' id='custo_compra' onfocus='searchVendor()'>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='preco_venda'>
                        Preço de venda:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='number' name='preco_venda' id='preco_venda' onfocus='searchVendor()'>
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
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Imposto Não Aplicavel'>Imposto Não Aplicavel</option>'                            
                            <option value='Imposto de Consumo'>Imposto de Consumo</option>'                            
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='receita'>
                        Requer Receita :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='receita'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Sim'>Sim</option>'                            
                            <option value='Não'>Não</option>'                            
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
            <br />
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
