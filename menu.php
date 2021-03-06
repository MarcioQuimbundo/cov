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
<h3>MENU
	<small>Seja benvindo ao sistema de gestão hospitalar</small>
</h3>
</div>
<div id='page-content' style='margin-top:-30px;'>
 <div class='row mrg20B'>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='agenda.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Pacientes e Serviços
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-book'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            AGENDA
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Detalhes
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>            

            <div class='col-lg-3' style='margin-top:30px;'>

                <a href='facturacao.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Facturar
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-money'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            FACTURAÇÃO 
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

                <a href='procedimentos.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       PROCEDIMENTOS
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-th-list'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            PROCEDIMENTOS 
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

                <a href='laboratorio.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       LABORATÓRIO
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-dashboard'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            LABORATÓRIO 
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

                <a href='farmacia.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       FARMÁCIA
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-heart'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            FARMÁCIA 
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

                <a href='administracao.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       ADMINISTRAÇÃO
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-gear'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            ADMINISTRAÇÃO 
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

                <a href='relatorioo.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       RELATÓRIOS
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-bar-chart-o'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            RELATÓRIOS 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Detalhes
                        <i class='glyph-icon icon-arrow-right'></i>
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
