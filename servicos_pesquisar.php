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
<div id='page-content-wrapper'>
<div id='page-title' style='margin-bottom:18px;'>
<h3>Pesquisar Serviços</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden' style='border:1px solid red;'></div>
<div id='page-content' style='margin-top:-18px;'>"; 
        
        if(isset($_GET['Id']))
        {
        $acao = sanitize($_GET['acao']);
        $Id = sanitize($_GET['Id']);
        $con=connection();

        if ($acao == 'apagar') {
            $query="DELETE FROM tbl_servicos_gerais WHERE id_servicos_gerais='$Id'";
            $a=mysqli_query($con,$query) ? true : false ;
            if($a){
                    echo "<script>alert('Serviço geral removido com sucesso');</script>";
                    echo "<script>document.location.href = 'servicos_gerais.php';</script>";
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
        if ($acao == 'editar') {
            $query="SELECT * FROM tbl_servicos_gerais WHERE id_servicos_gerais = '$Id'";
            $result=mysqli_query($con,$query);
            while($row=mysqli_fetch_array($result))
            echo "
            <h2>Informações Iniciais</h2>
							<a href='servicos_pesquisar.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
            <form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
                <input type='hidden' name='Id' value='".$row['id_servicos_gerais']."'>
                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='servico'>
                            Serviço:
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input required='required' value='".$row['nome']."' type='text' name='servico' id='servico' onfocus=''>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='preco'>
                            Preço :
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input required='required' value='".$row['preco']."' type='text' name='preco' id='preco' onfocus=''>
                    </div>
                </div>

                <div class='form-row'>
                    <div class='form-label col-md-2'>
                        <label for='descricao'>
                         Descrição :
                        </label>
                    </div>
                    <div class='form-input col-md-6'>
                        <input required='required' value='".$row['descricao']."' type='text' name='descricao[]' id='descricao'>
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
                <button style='background-color: #149900; color: #fff;' class='btn primary-bg medium' name='editar' >
                    <span class='button-content'>Actualizar</span>
                </button>

            </form>";            
die();
            }
            if ($acao == 'ver') {
            $query="SELECT * FROM tbl_servicos_gerais WHERE id_servicos_gerais = '$Id'";
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_row($result);
            echo "
            <div id='regbox'>
							<a href='servicos_pesquisar.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
            <form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='processo'>
                                    Código:
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
                                <label for='Preço'>
                                   Preço:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>".dinheiro($row[2])."</h4>
                            </div>
                        </div>

                        <div class='form-row'>
                            <div class='form-label col-md-2'>
                                <label for='Descrição'>
                                   Descrição:
                                </label>
                            </div>
                            <div class='form-input col-md-6'>
                                <h4>$row[3]</h4>
                            </div>
                        </div>
            </form>
            ";
             die();
                    }       
        }
        if (isset($_POST['voltar'])) {
            echo "<script>document.location.href = 'servicos_gerais.php';</script>";
        }

        if (isset($_POST['editar'])) {
            $id = $_POST['Id'];
            $servico=$_POST['servico']; 
            $preco=$_POST['preco'];
            $descricao=$_POST['descricao'];
            $descricao=implode(" ",$descricao);
            if (empty($servico) || empty($preco) || empty($descricao) ) {
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

            $query = "UPDATE tbl_servicos_gerais SET nome='$servico', preco='$preco', descricao='$descricao' WHERE id_servicos_gerais = '$id'";
            var_dump($query);
            $a=mysqli_query($con,$query) ? true : false ;
            if($a){
                    echo "<script>alert('Serviço actualizado com sucesso');</script>";
                    echo "<script>document.location.href = 'servicos_gerais.php';</script>";
                    }
            else echo "
                        <div class='row'>
                            <div class='col-md-6'>

                                <div class='infobox error-bg mrg0A'>
                                    <p>Ocorreu um erro, o pacinete não foi actualizado na base de dados.</p>
                                </div>
                            </div>
                        </div>
                    ";

            }

        }   


		if (isset($_POST['add'])) {
			$servico=$_POST['servico'];	
			$preco=$_POST['preco'];
			$descricao=$_POST['descricao'];
			$descricao=implode(" ",$descricao);
            $data_criada = date('Y-m-d');
			if (empty($servico) || empty($preco) || empty($descricao) ) {
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

    		$query="INSERT INTO tbl_servicos_gerais VALUES ('', '$servico','$preco','$descricao','1','$data_criada')";
            mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		    $a=mysqli_query($con,$query) ? true : false ;
		    if($a){
		    echo "
		                <div class='row'>
		                    <div class='col-md-4'>
		                        <div class='infobox success-bg'>
		                            <p>Serviço adicionado com sucesso.</p>
		                        </div>
		                    </div>
		                </div>
		                ";
		               	echo "<script>alert('Serviço adicionado com sucesso');</script>";
		               	echo "<script>document.location.href = 'servicos_gerais.php';</script>";
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



	if (isset($_POST['add_novo_servico'])) {
echo "

            <h2>Cadastro de Serviços Gerias</h2>
							<a href='servicos_pesquisar.php' style='padding-right: 10px; float:center; font-size:20px; background-color: #149900; color: #fff;' class='btn small'>
								<span class='button-content'>Voltar</span>
								<i class='glyph-icon icon-arrow-left'></i>
							</a><br>			<br>
            <br>
        <form name='newHospital' class='form-bordered' action='".$_SERVER['PHP_SELF']."' method='post'>
            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='servico'>
                        Serviço:
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='servico' id='servico' onfocus=''>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='preco'>
                        Preço :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='preco' id='preco' onfocus=''>
                </div>
            </div>

            <div class='form-row'>
                <div class='form-label col-md-2'>
                    <label for='descricao'>
                     Descrição :
                    </label>
                </div>
                <div class='form-input col-md-6'>
                    <input required='required' type='text' name='descricao[]' id='descricao'>
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
<button style='background-color: #149900; color: #fff;' class='btn medium' name='add'>
    <span class='button-content'>Adicionar</span>
</button>

</form>         
";
	}else{

?>



<?php 
echo "
<table class='table' id='example1'>
	<thead>
		<tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Descrição</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
    $query=
    "SELECT * from tbl_servicos_consultas
    UNION ALL
    SELECT * from tbl_servicos_gerais
    UNION ALL
    SELECT * from tbl_servicos_exames
    UNION ALL
    SELECT * from tbl_servicos_estomatologia";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
            <td>".$row['nome']."</td>
            <td>".dinheiro($row['preco'])."</td>
            <td>".$row['descricao']."</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";
}

?>
