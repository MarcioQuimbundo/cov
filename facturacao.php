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
<h3>FACTURAÇÃO
</h3>
</div>
<div id='page-content' style='margin-top:-30px;'>
 <div class='row mrg20B'>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='facturar_consultas.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       FACTURAR CONSULTAS
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-money'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            CONSULTAS
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Facturar Uma Nova Consulta
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>            

            <div class='col-lg-3' style='margin-top:30px;'>

                <a href='facturar_exames.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       Facturar exames
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-money'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            EXAMES 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Facturar Um Novo Exame
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='facturar_servicos_gerais.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       FACTURAR SERVIÇOS GERAIS
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-money'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            SERVIÇOS GERAIS 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Facturar Serviços Gerais 
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='facturar_produtos.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       FACTURAR PRODUTOS
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-money'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            PRODUTOS 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Facturar Um Novo Produto
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='tesouraria.php' class='tile-button btn bg-blue-alt' title=''>
                    <div class='tile-header'>
                       ÁREA DA TESOURARIA
                    </div>
                    <div class='tile-content-wrapper'>
                        <div class='tile-content'>
                            <center>
                                <i class='glyph-icon icon-home'></i>
                            </center>
                        </div>
                        <div class='tile-content'>
                        <center>
                            TESOURARIA 
                        </center>
                        </div>
                    </div>
                    <div class='tile-footer'>
                        Ir para Tesouraria
                        <i class='glyph-icon icon-arrow-right'></i>
                    </div>
                </a>

            </div>

            <div class='col-lg-3'style='margin-top:30px;'>

                <a href='menu.php' class='tile-button btn bg-gray-alt' title=''>
                    <div class='tile-header'>
                       MENU
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
