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
<h3>Alocador
</h3>
</div>
<div id='page-content'>
 <div class='row mrg20B'>

            <div class='col-lg-3'>

                <a href='add_alocador.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Adicionar novo local
                    </div>
                    <div class='tile-content-wrapper'>
                        <i class='glyph-icon icon-dashboard'></i>
                        <div class='tile-content'>
                            Novo alocador
                        </div>
                        <small>
                            <i class='glyph-icon icon-caret-up'></i>
                           Adicionar um novo alocador
                        </small>
                    </div>
                    <div class='tile-footer'>
                        Adicionar
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'>

                <a href='ver_alocador.php' class='tile-button btn bg-gray-alt' title=''>
                    <div class='tile-header'>
                        Alocadores
                    </div>
                    <div class='tile-content-wrapper'>
                        <i class='glyph-icon icon-bullhorn'></i>
                        <div class='tile-content'>
                           Ver Alocadores
                        </div>
                        <small>
                            <i class='glyph-icon icon-caret-up'></i>
                            Ver todos alocadores
                        </small>
                    </div>
                    <div class='tile-footer'>
                        Ver detalhes
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
