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
        
        if (isset($_GET['acao'])) { 
            $con = connection();
            $id = $_GET['id'];
            $acao = $_GET['acao'];
            $medico = $loggedInUser->displayname;
            $data = date("d-m-Y");;
            if(isset($_GET['acao']))$acao = $_GET['acao'];
            include('models/topbar_doctor.php');

            if ($acao == 'adicionar_atendimento') {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Informações Pessoais
                                                </a>
                                            </li>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=sinais_vitais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Sinais Vitais
                                                </a>
                                            </li>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Queixas Principais
                                                </a>
                                            </li>
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=atendimentos' title='Atendimentos'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Atendimentos
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=requisicoes' title='Requisições'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Requisições
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=receitas' title='Receitas'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Receitas
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=atestados' title='Atestados'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Atestados
                                                </a>
                                            </li>    
                            </ul>
                            <div class='divider mrg5T mobile-hidden'></div>
                            
                        </div>
                    </div>        
        <div id='g10' class='small-gauge float-left hidden'></div>
        <div id='g11' class='small-gauge float-right hidden'></div>
        <div id='page-content-wrapper'>
        <div id='page-title'>";
            $servico = $_POST['servico'];
            $descricao=$_POST['descricao'];
            $descricao=implode(" ",$descricao);
            if (empty($descricao) ) {
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

            
            //$query = "INSERT INTO tbl_paciente VALUES ('', '$nome','$idade','$genero','$telefone','$endereco', '$data')";
            $query = "INSERT INTO `tbl_atendimento_medico` (`id_atendimento`, `id_paciente`, `medico`, `data`, `servico`) VALUES (NULL, '$id', '$medico', '$data', '$servico')";
            mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            //$query = "INSERT INTO tbl_atendimento_medico VALUES ('','$id','$medico','$data','$servico')";
            $a=mysqli_query($con,$query) ? true : false ;
            if($a){
                        echo "<script>swal('Atendimento adicionado com sucesso');</script>";
                        //echo "<script>document.location.href = 'painel_doctor.php?id=2&pagina=atendimentos';</script>";
                    }
            else echo "<script>swal('Ocorreu um erro ao adicionar atendimento','','error');</script>";
        }        

        if ($acao == 'adicionar_requisicao') {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Informações Pessoais
                                                </a>
                                            </li>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=sinais_vitais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Sinais Vitais
                                                </a>
                                            </li>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Queixas Principais
                                                </a>
                                            </li>
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=atendimentos' title='Atendimentos'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Atendimentos
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=requisicoes' title='Requisições'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Requisições
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=receitas' title='Receitas'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Receitas
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=atestados' title='Atestados'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Atestados
                                                </a>
                                            </li>    
                            </ul>
                            <div class='divider mrg5T mobile-hidden'></div>
                            
                        </div>
                    </div>        
        <div id='g10' class='small-gauge float-left hidden'></div>
        <div id='g11' class='small-gauge float-right hidden'></div>
        <div id='page-content-wrapper'>
        <div id='page-title'>";
            $servico = $_POST['servico'];
            $descricao=$_POST['descricao'];
            $descricao=implode(" ",$descricao);
            if (empty($descricao) ) {
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

            
            //$query = "INSERT INTO tbl_paciente VALUES ('', '$nome','$idade','$genero','$telefone','$endereco', '$data')";
            $query = "INSERT INTO `tbl_requisicao` (`id_requisicao`, `id_paciente`, `medico`, `data`, `descricao`) VALUES (NULL, '$id', '$medico', '$data', '$descricao')";
            mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            //$query = "INSERT INTO tbl_atendimento_medico VALUES ('','$id','$medico','$data','$servico')";
            $a=mysqli_query($con,$query) ? true : false ;
            if($a){
            echo "
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class='infobox success-bg'>
                                    <p>Requisição adicionada com sucesso.</p>
                                </div>
                            </div>
                        </div>
                        ";
                        echo "<script>alert('Requisição adicionada com sucesso');</script>";
                        echo "<script>document.location.href = 'painel_doctor.php?id=2&pagina=requisicoes';</script>";
                    }
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

        if ($acao == 'adicionar_receita') {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Informações Pessoais
                                                </a>
                                            </li>
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=atendimentos' title='Atendimentos'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Atendimentos
                                                </a>
                                            </li> 
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=sinais_vitais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Sinais Vitais
                                                </a>
                                            </li>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Queixas Principais
                                                </a>
                                            </li>                      
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=requisicoes' title='Requisições'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Requisições
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=receitas' title='Receitas'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Receitas
                                                </a>
                                            </li>                       
                                            <li>
                                                <a href='painel_doctor.php?id=$id&pagina=atestados' title='Atestados'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Atestados
                                                </a>
                                            </li>    
                            </ul>
                            <div class='divider mrg5T mobile-hidden'></div>
                            
                        </div>
                    </div>        
        <div id='g10' class='small-gauge float-left hidden'></div>
        <div id='g11' class='small-gauge float-right hidden'></div>
        <div id='page-content-wrapper'>
        <div id='page-title'>";
            $servico = $_POST['servico'];
            $descricao=$_POST['descricao'];
            $descricao=implode(" ",$descricao);
            if (empty($descricao) ) {
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

            
            //$query = "INSERT INTO tbl_paciente VALUES ('', '$nome','$idade','$genero','$telefone','$endereco', '$data')";
            $query = "INSERT INTO `tbl_receitas` (`id_receita`, `id_paciente`, `medico`, `data`, `quantidade`, `medicamento`, `observacap`) VALUES (NULL, '$id', '$medico', '$data', '$descricao')";
            mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
            //$query = "INSERT INTO tbl_atendimento_medico VALUES ('','$id','$medico','$data','$servico')";
            $a=mysqli_query($con,$query) ? true : false ;
            if($a){
            echo "
                        <div class='row'>
                            <div class='col-md-4'>
                                <div class='infobox success-bg'>
                                    <p>Requisição adicionada com sucesso.</p>
                                </div>
                            </div>
                        </div>
                        ";
                        echo "<script>alert('Requisição adicionada com sucesso');</script>";
                        echo "<script>document.location.href = 'painel_doctor.php?id=2&pagina=requisicoes';</script>";
                    }
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

    }   

if (isset($_GET['pagina'])) {
            $id = $_GET['id'];
            $pagina = $_GET['pagina'];
            if(isset($_GET['acao']))$acao = $_GET['acao'];
            include('models/topbar_doctor.php');
        echo "
        <div id='page-sidebar' class='scrollable-content'>

                        <div id='sidebar-menu'>
                            <ul>
                                        <li>
                                            <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                <i class='glyph-icon icon-chevron-right'></i>
                                                Informações Pessoais
                                            </a>
                                        </li>
                                        <li>
                                            <a href='painel_doctor.php?id=$id&pagina=atendimentos' title='Atendimentos'>
                                                <i class='glyph-icon icon-chevron-right'></i>
                                                Atendimentos
                                            </a>
                                        </li> 
                                        <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=sinais_vitais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Sinais Vitais
                                                </a>
                                            </li>
                                            <li>
                                                <a name='info_pessoais' name='iniciar_atendimento' href='painel_doctor.php?id=$id&pagina=info_pessoais' title='Informações Pessoais'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    Queixas Principais
                                                </a>
                                            </li>                      
                                        <li>
                                            <a href='painel_doctor.php?id=$id&pagina=requisicoes' title='Requisições'>
                                                <i class='glyph-icon icon-chevron-right'></i>
                                                Requisições
                                            </a>
                                        </li>                       
                                        <li>
                                            <a href='painel_doctor.php?id=$id&pagina=receitas' title='Receitas'>
                                                <i class='glyph-icon icon-chevron-right'></i>
                                                Receitas
                                            </a>
                                        </li>                       
                                        <li>
                                            <a href='painel_doctor.php?id=$id&pagina=atestados' title='Atestados'>
                                                <i class='glyph-icon icon-chevron-right'></i>
                                                Atestados
                                            </a>
                                        </li>    
                            </ul>
                            <div class='divider mrg5T mobile-hidden'></div>
                            
                        </div>
                    </div>        
        <div id='g10' class='small-gauge float-left hidden'></div>
        <div id='g11' class='small-gauge float-right hidden'></div>
        <div id='page-content-wrapper'>
        <div id='page-title'>";
            $con = connection();
            $query="SELECT * FROM tbl_paciente WHERE Id = '$id'";
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_row($result);
            echo"
            <form method='post' action='painel_doctor.php?id=$id&acao_medico=atendido'>
                    <a title='Novo Paciente' href=''>
                        <button style='font-size:20px; height:52px; width:25%; margin-top:0px;' name='chamar_paciente' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                FINALIZAR ATENDIMENTO
                        </button>
                    </a>
            </form>
</div>
<div id='page-content' style='margin-top:-30px;'>";       
if ($pagina == 'info_pessoais') {
    echo "
    <div id='regbox'><br>
    <form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='processo'>
                            Nº de processo:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[0]</h4>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='Nome'>
                            Nome:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[1]</h4>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='Idade'>
                           Data de Nascimento :
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[2]</h4>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='Gênero'>
                           Gênero:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[4]</h4>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='Telefone'>
                           Telefone:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[5]</h4>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='Endereço'>
                           Nome do Parente:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[12]</h4>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='Endereço'>
                           Telefone do Parente:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <h4>$row[13]</h4>
                    </div>
                </div><br>
    </form>
    ";

die();
}
if ($pagina == 'sinais_vitais') {
            echo "
            <div id='regbox'><br>
            <h1>Sinais Vitais</h1><br>   
            <form name='#' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='processo'>
                                    Nº de processo:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[0]</h4>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Nome'>
                                    Nome:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[1]</h4>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Idade'>
                                   Data de Nascimento :
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[2]</h4>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Gênero'>
                                   Gênero:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[4]</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Telefone'>
                                   Telefone:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[5]</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Endereço'>
                                   Nome do Parente:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[12]</h4>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Endereço'>
                                   Telefone do Parente:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[13]</h4>
                            </div>
                        </div><br>
            </form>
            ";

    die();
        }
if ($pagina == 'atendimentos') {
echo "
<br><br>
<table class='table' id='example1'>
    <thead>
        <tr>
            <th>Data</th>
            <th>Descrição</th>
            <th>Médico</th>
        </tr>
    </thead>
    <tbody>";
    $con=connection();
    $query="SELECT * FROM tbl_atendimento_medico";
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_array($result))
    {
    echo "<tr>
            <td>".$row['data']."</td>
            <td>
                <a href='pacientes.php?Id=".$row['id_atendimento']."&acao=ver'>".$row['servico']."</a>
            </td>
            <td>".$row['medico']."</td>
        </tr>";
    }
    echo "  
    </tbody>
</table>
        <a title='Novo Paciente' href='painel_doctor.php?id=$id&pagina=add_atendimento'>
           <button style='font-size:20px;' name='add_novo_atendimento' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                <i class='glyph-icon icon-save'></i>
                Adicionar Atendimento
            </button>
        </a><br><br>
";
    die();
        }
if ($pagina == 'add_atendimento') {
echo "
<br>
<h2>Resumo do Atendimento</h2><br>
<form class='form-bordered' action='painel_doctor.php?id=$id&pagina=atendimentos&acao=adicionar_atendimento' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
                     Resumo :
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
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='servico'>
                     Serviço:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input type='text' name='servico' id='servico'>
                </div>
            </div>
                                        
<br>
<button class='btn primary-bg medium' name='adicionar_atendimento'>
    <span class='button-content'>Cadastrar</span>
    <i class='glyph-icon icon-save'></i>
</button>
</form>         
";
die();
}

if ($pagina == 'requisicoes') {
echo "
<br><br>
<table class='table' id='example1'>
    <thead>
        <tr>
            <th>Data</th>
            <th>&nbsp;&nbsp;&nbsp;Descrição</th>
        </tr>
    </thead>
    <tbody>";
    $con=connection();
    $query="SELECT * FROM tbl_requisicao";
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_array($result))
    {
    echo "<tr>
            <td>".$row['id_requisicao']."</td>
            <td>".$row['descricao']."</td>
        </tr>";
    }
    echo "  
    </tbody>
</table>
        <a title='Novo Paciente' href='painel_doctor.php?id=$id&pagina=add_requisicao'>
           <button style='font-size:20px;' name='add_requisicao' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                <i class='glyph-icon icon-save'></i>
                Adicionar Requisição
            </button>
        </a><br><br>
";
die();
}
if ($pagina == 'add_requisicao') {
echo "
<br>
<h2>Adicionar Requisição</h2><br>
<form class='form-bordered' action='painel_doctor.php?id=$id&pagina=requisicoes&acao=adicionar_requisicao' method='post'>
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
<br>
<button class='btn primary-bg medium' name='adicionar_requisicao'>
    <span class='button-content'>Cadastrar</span>
    <i class='glyph-icon icon-save'></i>
</button>
</form>         
";
die();
}

if ($pagina == 'receitas') {
echo "
<br><br>
<table class='table' id='example1'>
    <thead>
        <tr>
            <th>Data</th>
            <th>Medicamento/os</th>
        </tr>
    </thead>
    <tbody>";
    $con=connection();
    $query="SELECT * FROM tbl_paciente";
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_array($result))
    {
    echo "<tr>
            <td>".$row['Id']."</td>
            <td>
                <a href='pacientes.php?Id=".$row['Id']."&acao=ver '>".$row['Nome']."</a>
            </td>
        </tr>";
    }
    echo "  
    </tbody>
</table>
        <a title='Novo Paciente' href='painel_doctor.php?id=$id&pagina=add_receita'>
           <button style='font-size:20px;' name='add_novo_paciente' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                <i class='glyph-icon icon-save'></i>
                Adicionar Receita
            </button>
        </a><br><br>
";
    die();
}
if ($pagina == 'add_receita') {
    echo "
    <br>
    <h2>Receita</h2><br>
    <form class='form-bordered' action='painel_doctor.php?id=$id&pagina=atendimentos' method='post'>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='descricao'>
                         Quantidade:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input type='number' min='0' name='descricao[]' id='descricao'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='cid'>
                         Medicamento/Farmaco:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input type='text' placeholder='' name='cid' id='cid'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='cid'>
                         Observação:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input type='text' placeholder='' name='cid' id='cid'>
                    </div>
                </div>
    <br>
    <button class='btn primary-bg medium' name='add'>
        <span class='button-content'>Gerar receita</span>
        <i class='glyph-icon icon-save'></i>
    </button>
    </form>         
    ";
    die();
    }

if ($pagina == 'atestados') {
echo "
<br><br>
<table class='table' id='example1'>
    <thead>
        <tr>
            <th>Data</th>
            <th>&nbsp;&nbsp;&nbsp;CID</th>
            <th>Dias</th>
        </tr>
    </thead>
    <tbody>";
    $con=connection();
    $query="SELECT * FROM tbl_paciente";
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_array($result))
    {
    echo "<tr>
            <td>".$row['Id']."</td>
            <td>
                <a href='pacientes.php?Id=".$row['Id']."&acao=ver '>".$row['Nome']."</a>
            </td>
            <td>".$row['Idade']."</td>
        </tr>";
    }
    echo "  
    </tbody>
</table>
        <a title='Adicionar Atestado' href='painel_doctor.php?id=$id&pagina=add_atestado'>
           <button style='font-size:20px;' name='add_atestado' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                <i class='glyph-icon icon-save'></i>
                Adicionar Atestado
            </button>
        </a><br><br>
";
    die();
        }
if ($pagina == 'add_atestado') {
    echo "
    <br>
    <h2>Atestado</h2><br>
    <form class='form-bordered' action='painel_doctor.php?id=$id&pagina=atendimentos' method='post'>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='descricao'>
                         Quantidade de dias :
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input type='number' min='0' name='descricao[]' id='descricao'>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='cid'>
                         CID :
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input type='text' placeholder='pesquisar CID.10' name='cid' id='cid'>
                    </div>
                </div>
    <br>
    <button class='btn primary-bg medium' name='add'>
        <span class='button-content'>Gerar atestado</span>
        <i class='glyph-icon icon-save'></i>
    </button>
    </form>         
    ";
    die();
    }
}
if (!isUserLoggedIn()) {
    header("Location: index.php");
}
echo "
            <div id='page-header' class='clearfix'>
                
                 <!----<div class='hide' id='black-modal-60' title='Modal window example'>
                    
                    <div class='pad20A'>
                        <div class='infobox notice-bg'>
                            <div class='bg-azure large btn info-icon'>
                                <i class='glyph-icon icon-bullhorn'></i>
                            </div>
                            <h4 class='infobox-title'>Modal windows</h4>
                            <p>Thanks to the solid modular Lyonzone Admin arhitecture, modal windows customizations are very flexible and easy to apply.</p>
                        </div>

                        <h4 class='heading-1 mrg20T clearfix'>
                            <div class='heading-content' style='width: auto;'>
                                Icons
                                <small>
                                    All icons across the Lyonzone Admin Framework use FontAwesome icons.
                                </small>
                            </div>
                            <div class='clear'></div>
                            <div class='divider'></div>
                        </h4>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-compass' href='../icon/compass'><i class='glyph-icon icon-compass'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-collapse' href='../icon/collapse'><i class='glyph-icon icon-collapse'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-collapse-top' href='../icon/collapse-top'><i class='glyph-icon icon-collapse-top'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-expand' href='../icon/expand'><i class='glyph-icon icon-expand'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-eur' href='../icon/eur'><i class='glyph-icon icon-eur'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-euro' href='../icon/eur'><i class='glyph-icon icon-euro'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-gbp' href='javascript:;'><i class='glyph-icon icon-gbp'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-usd' href='javascript:;'><i class='glyph-icon icon-usd'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-dollar' href='javascript:;'><i class='glyph-icon icon-dollar'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-inr' href='javascript:;'><i class='glyph-icon icon-inr'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-rupee' href='javascript:;'><i class='glyph-icon icon-rupee'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-jpy' href='javascript:;'><i class='glyph-icon icon-jpy'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-yen' href='javascript:;'><i class='glyph-icon icon-yen'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-cny' href='javascript:;'><i class='glyph-icon icon-cny'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-renminbi' href='javascript:;'><i class='glyph-icon icon-renminbi'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-krw' href='javascript:;'><i class='glyph-icon icon-krw'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-won' href='javascript:;'><i class='glyph-icon icon-won'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-btc' href='javascript:;'><i class='glyph-icon icon-btc'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-bitcoin' href='javascript:;'><i class='glyph-icon icon-bitcoin'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-file' href='javascript:;'><i class='glyph-icon icon-file'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-file-text' href='javascript:;'><i class='glyph-icon icon-file-text'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-sort-by-alphabet' href='javascript:;'><i class='glyph-icon icon-sort-by-alphabet'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-sort-by-alphabet-al' href='javascript:;'><i class='glyph-icon icon-sort-by-alphabet-alt'></i>t</a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-sort-by-attributes' href='javascript:;'><i class='glyph-icon icon-sort-by-attributes'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-sort-by-attribu' href='javascript:;'><i class='glyph-icon icon-sort-by-attributes-alt'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-sort-by-order' href='javascript:;'><i class='glyph-icon icon-sort-by-order'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-sort-by-order-alt' href='javascript:;'><i class='glyph-icon icon-sort-by-order-alt'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-thumbs-up' href='javascript:;'><i class='glyph-icon icon-thumbs-up'></i></a>

                        <a class='btn medium radius-all-4 mrg5A ui-state-default tooltip-button' title='icon-thumbs-down' href='javascript:;'><i class='glyph-icon icon-thumbs-down'></i></a>

                    </div>
                </div>--->

            <!----    <div class='hide' id='white-modal-80' title='Dialog with tabs'>
                    <div class='tabs pad15A remove-border opacity-80'>
                        <ul class='opacity-80'>
                            <li><a href='#example-tabs-1'>First</a></li>
                            <li><a href='#example-tabs-2'>Second</a></li>
                            <li><a href='#example-tabs-3'>Third</a></li>
                        </ul>
                        <div id='example-tabs-1'>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                            <p>Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.
                            </p>
                        </div>
                        <div id='example-tabs-2'>
                            <p>Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.
                            </p>
                            <p>Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.
                            </p>
                        </div>
                        <div id='example-tabs-3'>
                            <p>Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.
                            </p>
                            <p>Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.
                            </p>
                        </div>
                    </div>
                    <div class='pad10A'>
                        <div class='infobox success-bg radius-all-4'>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque</p>
                        </div>
                    </div>
                    <div class='ui-dialog-buttonpane clearfix'>

                        <a href='dropdown_menus.html' class='btn medium float-left bg-azure'>
                            <span class='button-content text-transform-upr font-size-11'>Dropdown menus</span>
                        </a>
                        <div class='button-group float-right'>
                            <a href='buttons.html' class='btn medium bg-black' title='View more buttons examples'>
                                <i class='glyph-icon icon-star'></i>
                            </a>
                            <a href='buttons.html' class='btn medium bg-black' title='View more buttons examples'>
                                <i class='glyph-icon icon-random'></i>
                            </a>
                            <a href='buttons.html' class='btn medium bg-black' title='View more buttons examples'>
                                <i class='glyph-icon icon-map-marker'></i>
                            </a>
                        </div>
                        <a href='javascript:;' class='medium btn bg-blue-alt float-right mrg10R tooltip-button' data-placement='left' title='Remove comment'>
                            <i class='glyph-icon icon-save'></i>
                        </a>

                    </div>
                </div>--->
                <!----<div class='user-profile hidden-mobile'>
                    <a href='javascript:;' title='' id='open-left-menu' class='updateEasyPieChart user-ico clearfix'>
                        <i class='glyph-icon icon-th-list'></i>
                    </a>
                </div>--->
                <div class='user-profile dropdown'>
                    <a href='javascript:;' title='' class='user-ico clearfix' data-toggle='dropdown'>
                        <span>".utf8_encode($loggedInUser->displayname)."</span>
                        <i class='glyph-icon icon-chevron-down'></i>
                    </a>
                    <ul class='dropdown-menu float-right'>
                        <li>
                            <a href='user_settings.php' title='Editar Perfil'>
                                <i class='glyph-icon icon-cog mrg5R'></i>
                                Editar Perfil
                            </a>
                        </li>
                        <li>
                            <a href='logout.php' title='Logout'>
                                <i class='glyph-icon icon-power-off font-size-13 mrg5R'></i>
                                <span class='font-bold'>Sair da Conta</span>
                            </a>
                        </li>
                        <li class='divider'></li>
                    </ul>
                </div>
                <div class='dropdown dash-menu'>
                    <a href='javascript:;' data-toggle='dropdown' data-placement='left' class='medium btn primary-bg float-right popover-button-header hidden-mobile mrg15R tooltip-button' title='Menu'>
                        <i class='glyph-icon icon-th'></i>
                    </a>
                    <div class='dropdown-menu float-right'>
                        <div class='medium-box'>
                            <div class='bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A'>Menu</div>
                            <div class='pad10A dashboard-buttons clearfix'>
                                <a href='menu.php' class='btn vertical-button remove-border bg-blue' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-dashboard opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Menu</span>
                                </a>
                                <a href='#.php' class='btn vertical-button remove-border bg-red' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-tags opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Agenda</span>
                                </a>
                                <a href='#.php' class='btn vertical-button remove-border bg-purple' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-sort-amount-asc opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Facturação</span>
                                </a>
                                <a href='#.php' class='btn vertical-button remove-border bg-azure' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-bar-chart-o opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Procedimentos</span>
                                </a>
                                <a href='#.php' class='btn vertical-button remove-border bg-yellow' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-laptop opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Laboratório</span>
                                </a>
                                <a href='#.php' class='btn vertical-button remove-border bg-orange' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-code opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Farmácia</span>
                                </a>
                                 <a href='#.php' class='btn vertical-button remove-border bg-orange' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-code opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Administração</span>
                                </a>
                                 <a href='#.php' class='btn vertical-button remove-border bg-orange' title=''>
                                    <span class='glyph-icon icon-separator-vertical pad0A medium'>
                                        <i class='glyph-icon icon-code opacity-80 font-size-20'></i>
                                    </span>
                                    <span class='button-content'>Relatórios</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='top-icon-bar'>
                   
                     </div>

            </div><!-- #page-header -->
"; //include("models/sidebar.php");

$mes = date("m");
$con = connection();
$q = $con->query("SELECT * FROM tbl_paciente");
$rowP = mysqli_fetch_row($q);
echo "
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>";
echo "
<div id='page-content-wrapper'>
<h1 class='text-center'>CONSULTÓRIO 04
</h1><br />
<div id='page-content' style='margin-top:-30px; text-align:center;'><br><br><br>";

                        $query="SELECT * FROM tbl_consultorio";
                        $result=mysqli_query($con,$query);
                        $row=mysqli_fetch_row($result);
                        $id_medico = $row[0];
                        $queryA="SELECT * FROM tbl_atendimento WHERE id_medico ='$id_medico' AND ativo = 1 ";
                        $resultA=mysqli_query($con,$queryA);
                        while ($rowAC = mysqli_fetch_array($resultA)) {
                            $id_paciente = $rowAC['id_paciente'];
                            $queryPC="SELECT * FROM tbl_paciente WHERE Id ='$id_paciente'";
                            $resultPC=mysqli_query($con,$queryPC);
                            $rowPC = mysqli_fetch_row($resultPC);
                        }

    if (isset($_POST['chamar_recepcao'])) {
        die();
    }

    if (isset($_POST['proximo'])) {
        die();
    }

    if (isset($_POST['chamar_paciente'])) {
        $acao = $_GET['acao_medico'];
        $id = $_GET['id'];
        if ($acao = 'chamar') {
            if ($rowPC[0] == $id) {

            echo "<h2>Paciente: ".$rowPC[1]."</h2>";
            echo "
                <form method='post' action='painel_doctor.php?id=".$rowPC[0]."&acao_medico=chamar&pagina=info_pessoais'>
                    <a title='Novo Paciente' href=''>
                        <button style='font-size:20px; height:52px; width:15%; margin-top:50px;' name='chamar_recepcao' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                Chamar
                        </button>
                    </a>
                    <a title='Novo Paciente' href=''>
                        <button style='font-size:20px; height:52px; width:15%; margin-top:50px;' name='iniciar_atendimento' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                Iniciar Atendimento
                        </button>
                    </a>
                    <a title='Novo Paciente' href=''>
                        <button style='font-size:20px; height:52px; width:15%; margin-top:50px;' name='proximo' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                Próximo
                        </button>
                    </a>
                </form>

            ";
            die();
            }else{}
    }   
}

echo "
 <div class='row mrg20B'>
            <form method='post' action='painel_doctor.php?id=".$rowPC[0]."&acao_medico=chamar'>
                    <a title='Novo Paciente' href=''>
                        <button style='font-size:20px; height:52px; width:25%; margin-top:50px;' name='chamar_paciente' class='print large btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                CHAMAR PACIENTE
                        </button>
                    </a>
            </form>
            <div class='col-lg-3'style='margin-top:30px; width:95%;'>
                <a href='#' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            ATENDIMENTO GERAL
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>";
                        $query="SELECT * FROM tbl_consultorio";
                        $result=mysqli_query($con,$query);
                        $row=mysqli_fetch_row($result);
                        $id_medico = $row[0];
                        $queryA="SELECT * FROM tbl_atendimento WHERE id_medico ='$id_medico' AND ativo = 1 ";
                        $resultA=mysqli_query($con,$queryA);
                        while ($rowA = mysqli_fetch_array($resultA)) {
                            $id_paciente = $rowA['id_paciente'];
                            $queryP="SELECT * FROM tbl_paciente WHERE Id ='$id_paciente'";
                            $resultP=mysqli_query($con,$queryP);
                            while ($rowP = mysqli_fetch_array($resultP)) {
                                echo "<a href='#' style='font-size:25px;'>".$rowP['nome']."</a>";
                            }
                        }
                    echo"                    
                    </div>
                </a>
            </div> ";
            echo "
		</div>		
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
