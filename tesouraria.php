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
<h3>TESOURARIA
</h3>
</div>
<div id='page-content' style='margin-top:-30px;'>
 <div class='row mrg20B'>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='add_servicos_gerais.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Cadastro de Serviços Gerais
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                        </div>
                        <div class='tile-content'>
                        <center>
                            Cadastrar<br>
                            Serviços Gerais
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Serviços Gerais
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>    
                    
            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='seguro_saude.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Seguro de Saúde
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-heart'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            Seguro de Saúde
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Detalhes
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>            

                    
            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='add_servicos_exames.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Cadastro de Serviços Exames
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                        <center>
                            Cadastrar<br>
                            Serviços Exames
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Serviços Exames
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>            

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='facturacao.php' class='tile-button btn bg-gray-alt' title=''>
                    <div class='tile-header'>
                       FACTURAÇÃO
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-arrow-left'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            VOLTAR 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Voltar para menu
                        <i class='glyph-icon icon-arrow-left'></i>
                    </div>
                </a>

            </div>

			</div>		
</div><!-- #page-content -->
</div><!-- #page-main -->
</div><!-- #page-wrapper -->
</body>
</html>";

?>
