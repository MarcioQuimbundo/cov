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
<h3>Estatísticas
</h3>
</div>
<div id='page-content' style='margin-top:-30px;'>
 <div class='row mrg20B'>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='#' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Atendimentos
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-heart'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            Consultas Externas
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Estatística
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>            

            <div class='col-lg-3' style='margin-top:30px;'>

                <a href='#' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Serviços Atendidos no Laboratório
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-tag'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            Laboratório
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Estatística
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='#' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Ver Histórico de Pacientes Internados
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-bar-chart-o'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            Internamento 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Estatística
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='#' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Ver Histórico de Pagamentos
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-money'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            Pagamentos 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ver Estatística
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
