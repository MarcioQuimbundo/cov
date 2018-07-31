<?php
if (!isUserLoggedIn()) {
	header("Location: index.php");
}
echo "
            <div id='page-header' class='clearfix'>
                <div id='header-logo'>
                    <a href='javascript:;' class='tooltip-button' data-placement='bottom' title='Close sidebar' id='close-sidebar'>
                        <i class='glyph-icon icon-caret-left'></i>
                    </a>
                    <a href='javascript:;' class='tooltip-button hidden' data-placement='bottom' title='Open sidebar' id='rm-close-sidebar'>
                        <i class='glyph-icon icon-caret-right'></i>
                    </a>
                    <a href='javascript:;' class='tooltip-button hidden' title='Navigation Menu' id='responsive-open-menu'>
                        <i class='glyph-icon icon-align-justify'></i>
                    </a>
                     Centro Ortopédico<small><i class='opacity-80'></i></small>
                </div>
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
                    <a style='color: #fff;' href='javascript:;' title='' class='user-ico clearfix' data-toggle='dropdown'>
                        <span>".$loggedInUser->displayname."</span>
                        <i class='glyph-icon icon-chevron-down'></i>
                    </a>
                    <ul class='dropdown-menu float-right'>
                        <li>
                            <a href='editar_perfil.php' title='Editar Perfil'>
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
                <!--<div class='dropdown dash-menu'>
                    <a style='color: #fff;' href='javascript:;' data-toggle='dropdown' data-placement='left' class='medium btn float-right popover-button-header hidden-mobile mrg15R tooltip-button' title='Menu'>
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
                </div>-->
                <div class='top-icon-bar'>
                   
                     </div>

            </div><!-- #page-header -->
"; 
?>