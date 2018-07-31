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
                                <a title='Voltar' href='recursos_humanos.php'>
                                   <button name='add_servico_facturacao' class='print small btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                    <i class='glyph-icon icon-arrow-left'></i>
                                    Voltar
                                    </button>
                                </a><br><br>
<h3>Adicionar Funcionário
</h3>
</div>
<div id='page-content'>
";
if(!empty($_POST))
{   
$nome=$_POST['nome']; 
$data_nasc=$_POST['data_nasc']; 
$estado_civil=$_POST['estado_civil'];
$genero=$_POST["genero"];
$profissao=$_POST['profissao'];
$funcao=$_POST['funcao'];
$telefone=$_POST['telefone'];
$estado=$_POST['estado'];
$email=$_POST['email'];
$tipo_id=$_POST['tipo_id'];
$n_identificacao=$_POST['n_identificacao'];
$endereco=$_POST['endereco'];
$pais=$_POST['pais'];
$provincia=$_POST['provincia'];
$n_seguranca_social=$_POST['n_seguranca_social'];
$n_identificacao_fiscal=$_POST['n_identificacao_fiscal'];
$salario=$_POST['salario'];
$nome_parente=$_POST['nome_parente'];
$telefone_parente=$_POST['telefone_parente'];

    if (empty($nome) || empty($data_nasc) || empty($estado_civil) || empty($genero) || empty($profissao) || empty($funcao) || empty($telefone) || empty($estado) || empty($tipo_id) || empty($n_identificacao) || empty($endereco) || empty($pais) || empty($provincia) || empty($n_seguranca_social) || empty($n_identificacao_fiscal) || empty($salario) ) {
        echo "
                <div class='row'>
                    <div class='col-md-6'>
                        <div class='infobox error-bg mrg0A'>
                            <p>Preencha todos os campos marcados com *</p>
                        </div>
                    </div>
                </div>
            ";
    }else{
    $con=connection();
    mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    $query="INSERT INTO tbl_funcionario VALUES ('', '$nome','$data_nasc','$estado_civil','$genero','$profissao','$funcao','$telefone','$estado','$email','$tipo_id','$n_identificacao','$endereco','$pais','$provincia','$n_seguranca_social','$n_identificacao_fiscal','$salario','$nome_parente','$telefone_parente')";

    $a = mysqli_query($con,$query) ? true : false ;
    if($a) echo "<script>swal('Funcionário Adicionado Com Sucesso','','success');</script>";
    else echo "<script>swal('Ocorreu um erro','O funcionário não foi adicionado','error');</script>";
    }
}
echo "
<h2>Informações Iniciais</h2><br>
<form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome'>
                        *Nome Completo:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='nome' id='nome' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='data_nasc'>
                        *Data de Nascimento:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='date' name='data_nasc' id='data_nasc' onfocus='searchVendor()'>
                </div>
            </div>


            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='estado_civil'>
                        *Estado Civil:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select name='estado_civil' class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>
                            <option value='Solteiro(a)'>Solteiro(a)</option>'                            
                            <option value='Casado(a)'>Casado(a)</option>'                            
                            <option value='Viuvo(a)'>Viuvo(a)</option>'                            
                            <option value='Divorciado(a)'>Divorciado(a)</option>'                            
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='genero'>
                        *Gênero:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='genero' name='genero'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Masculino'>Masculino</option>'                            
                            <option value='Femenino'>Femenino</option>'                            
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='profissao'>
                        *Profissão:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='profissao' name='profissao'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Não Aplicavel'>Não Aplicavel</option>'                            
                            <option value='Adminstrativo'>Adminstrativo</option>'                            
                            <option value='Analista'>Analista</option>'                            
                            <option value='Analista Clínico(a)'>Analista Clínico(a)</option>'                            
                            <option value='Aux. da Limpeza'>Aux. da Limpeza</option>'                            
                            <option value='Barbeiro'>Barbeiro</option>'                            
                            <option value='Catalogador(a)'>Catalogador(a)</option>'                            
                            <option value='Contablista'>Contablista</option>'                            
                            <option value='Copeiro(a)'>Copeiro(a)</option>'                            
                            <option value='Cortador'>Cortador</option>'                            
                            <option value='Costureira'>Costureira</option>'                            
                            <option value='Cozinheiro(a)'>Cozinheiro(a)</option>'                            
                            <option value='Defectólogo'>Defectólogo</option>'                            
                            <option value='Diversos'>Diversos</option>'                            
                            <option value='Decente Universitária'>Decente Universitária</option>'                            
                            <option value='Economista'>Economista</option>'                            
                            <option value='Electrecista'>Electrecista</option>'                            
                            <option value='Encarregado Não Qualificado'>Encarregado Não Qualificado</option>'                            
                            <option value='Enfermeiro(a)'>Enfermeiro(a)</option>'                            
                            <option value='Estudante'>Estudante</option>'                            
                            <option value='Farmacêutico'>Farmacêutico</option>'                            
                            <option value='Fiel de Armazem'>Fiel de Armazem</option>'                            
                            <option value='Fisioterapeuta'>Fisioterapeuta</option>'                            
                            <option value='Maqueiro(a)'>Maqueiro(a)</option>'                            
                            <option value='Medico(a)'>Medico(a)</option>'                            
                            <option value='Motorista'>Motorista</option>'                            
                            <option value='Operador Lavandaria'>Operador Lavandaria</option>'                            
                            <option value='Operário Não Qualificado'>Operário Não Qualificado</option>'                            
                            <option value='Operário Qualificado'>Operário Qualificado</option>'                            
                            <option value='Ortopretésico'>Ortopretésico</option>'                            
                            <option value='Porteiro(a)'>Porteiro(a)</option>'                            
                            <option value='Professor(a)'>Professor(a)</option>'                            
                            <option value='Programador'>Programador</option>'                            
                            <option value='Psicólogo(a)'>Psicólogo(a)</option>'                            
                            <option value='Radiológista'>Radiológista</option>'                            
                            <option value='Roupeira'>Roupeira</option>'                            
                            <option value='Telefonista'>Telefonista</option>'                            
                            <option value='Vigilante'>Vigilante</option>'                            
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='funcao'>
                        *Função:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='funcao' name='funcao'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='2º Oficial'>2º Oficial</option>'                            
                            <option value='Adminstrador'>Adminstrador</option>'                            
                            <option value='Aspirante'>Aspirante</option>'                            
                            <option value='Aux. Téc. Diag. Terap. de 1ª Classe'>Aux. Téc. Diag. Terap. de 1ª Classe</option>'                            
                            <option value='Aux. Téc. Diag. Terap. de 2ª Classe'>Aux. Téc. Diag. Terap. de 2ª Classe</option>'                            
                            <option value='Aux. Téc. Diag. Terap. de 3ª Classe'>Aux. Téc. Diag. Terap. de 3ª Classe</option>'      
                            <option value='Auxiliar de Limpeza Principal'>Auxiliar de Limpeza Principal</option>'                            
                            <option value='Barbeiro de 2ª Classe'>Barbeiro de 2ª Classe</option>'                            
                            <option value='Caixa'>Caixa</option>'                            
                            <option value='Catalogador(a)'>Catalogador(a)</option>'                            
                            <option value='Catalogador(a) de 1ª Classe'>Catalogador(a) de 1ª Classe</option>'                            
                            <option value='Catalogador(a) de 2ª Classe'>Catalogador(a) de 2ª Classe</option>'                            
                            <option value='Catalogador(a) de 3ª Classe'>Catalogador(a) de 3ª Classe</option>'                            
                            <option value='Chefe Deptº. Contabilidade'>Chefe Deptº. Contabilidade</option>'                            
                            <option value='Chefe Deptº. Recursos Humanos'>Chefe Deptº. Recursos Humanos</option>'                            
                            <option value='Chefe Deptº. Técnico'>Chefe Deptº. Técnico</option>'                            
                            <option value='Adminstrador'>Adminstrador</option>'                            
                    </select>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='telefone'>
                        *Telefone:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='telefone' id='telefone' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='estado'>
                        *Estado:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='estado' name='estado'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Activo'>Activo</option>'                            
                            <option value='Inactivo'>Inactivo</option>'                            
                    </select>
                </div>
            </div>
            <h2>Informações Complementares</h2><br>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='email'>
                        *Email:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='email' id='email' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='tipo_id'>
                        *Tipo de ID:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <select id='tipo_id' name='tipo_id'class='form-control'>
                            <option value=''selected='selected'>-- Selecione --</option>                          
                            <option value='Não Aplicavel'>Não Aplicavel</option>'                            
                            <option value='Bilhete'>Bilhete</option>'                            
                            <option value='Cédula'>Cédula</option>'                            
                            <option value='Passaporte'>Passaporte</option>'    
                    </select>                        
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='n_identificacao'>
                        *Nº de Identificação:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='n_identificacao' id='n_identificacao' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='endereco'>
                        *Endereço:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='endereco' id='endereco' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='pais'>
                        *País:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='pais' id='pais' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='provincia'>
                        *Província / Estado:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='provincia' id='provincia' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='n_seguranca_social'>
                        *Nº de Segurança Social:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='n_seguranca_social' id='n_seguranca_social' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='n_identificacao_fiscal'>
                        *Nº de Identificação Fiscal:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='n_identificacao_fiscal' id='n_identificacao_fiscal' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='salario'>
                        *Salário:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='salario' id='salario' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='nome_parente'>
                        Nome do Parente:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='nome_parente' id='nome_parente' onfocus='searchVendor()'>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='telefone_parente'>
                        Telefone do Parente:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='telefone_parente' id='telefone_parente' onfocus='searchVendor()'>
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
