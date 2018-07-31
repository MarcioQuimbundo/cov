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
?>
<div id="page-content-wrapper">
	<div id='page-title'>
		<h3>Internados > Lista de pacinetes
		</h3>
	</div>
    <div id="page-content">
        <div class="container"> 
            <div class="row">
                <div class="col-md-12"> 
                        <div class="panel">
                            <div class="panel-body">
                                <div class="example-box-wrapper"> 
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                                <tr>
                                                    <th>#Processo</th>
                                                    <th>Paciente</th>
                                                    <th>Idade</th>
                                                    <th>Gênero</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="7"><center><h4>Não foram encontrados resultados.</center></h4></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>  
