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
<div id='page-content-wrapper'>
<div id='page-title'>
                                <a title='Voltar' href='recursos_humanos.php'>
                                   <button name='add_servico_facturacao' class='print small btn primary-bg popover-button-header hidden-mobile mrg15R tooltip-button''>
                                    <i class='glyph-icon icon-arrow-left'></i>
                                    Voltar
                                    </button>
                                </a><br><br>

<h3>Pesquisar Funcionários
    <small>
        Pesquisar Funcionários pelo nome
    </small>
</h3>
</div>
<div id='g10' class='small-gauge float-left hidden'></div>
<div id='g11' class='small-gauge float-right hidden'></div>
<div id='page-content'>
<table class='table' id='example1'>
	<thead>
		<tr>
			<th>Nº Funcionário</th>
			<th>Nome Completo</th>
			<th>Função</th>
			<th>Opções</th>
		</tr>
	</thead>
	<tbody>";
	$con=connection();
	$query="SELECT * FROM tbl_funcionario";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
	echo "<tr>
			<td>
				<a href='#'>".$row['id_funcionario']."</a>
			</td>
			<td>
				<a href='#'>".$row['nome']."</a>
			</td>
			<td>
				<a href='#'>".$row['funcao']."</a>
			</td>
			<td>
				<a href='#'class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Editar'>
                    <i class='glyph-icon icon-edit'></i>
                </a>
			</td>
		</tr>";
	}
	echo "	
	</tbody>
</table>
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
";


?>
