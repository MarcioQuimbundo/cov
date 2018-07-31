<?php
if(isUserLoggedIn() && ($loggedInUser->title == 'admin')) {
echo "
<div id='page-sidebar' class='scrollable-content'>
        <div id='sidebar-menu'>
            <ul>
                <li>
                    <a href='painel.php' title='Painel'>
                        <i class='glyph-icon icon-th'></i>
                        PAINEL
                    </a>
                </li>
				<li>
                    <a href='javascript:;' title='Cadastros' style='font-size:11px;'>
                        <i class='glyph-icon icon-folder-open'></i>
                        AGENDA DE TRABALHO
                    </a>
                    <ul>
                        <li>
                            <a href='lista_funcionarios.php' title='Lista de funcionários' style='font-size:11px;'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                LISTA DE FUNCIONÁRIOS
                            </a>
                        </li>                            
                    </ul>
                </li>
                <li>
                    <a href='javascript:;' title='Cadastros'>
                        <i class='glyph-icon icon-folder-open'></i>
                        CADASTROS
                    </a>
                    <ul>
                        <li>
                            <a href='funcionarios.php' title='Pacientes'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                FUNCIONÁRIOS
                            </a>
                        </li>
                        <li>
                            <a href='especialidades.php' title='Especialidades'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                ESPECIALIDADES
                            </a>
                        </li>                                  
                        <li>
                            <a href='consultorios.php' title='Consulórios'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                CONSULTÓRIOS
                            </a>
                        </li>                                
                        <li>
                            <a href='prestadores.php' title='Prestadores'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                PRESTADORES
                            </a>
                        </li>                                  
                        <li>
                            <a href='seguro_saude.php' title='Seguro de Saúde'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                SEGURO DE SAÚDE
                            </a>
                        </li>                                
                        <li>
                            <a href='fornecedores.php' title='Fornecedores'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                FORNECEDORES
                            </a>
                        </li>                                
                        <li>
                            <a href='usuarios.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                UTILIZADORES
                            </a>
                        </li>                                
                    </ul>
                </li>
                <li>
                    <a href='javascript:;' title='Pages'>
                        <i class='glyph-icon icon-folder-open'></i>
                        ESTOQUE
                    </a>
                    <ul>
                        <li>
                            <a href='produtos.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                PRODUTOS
                            </a>
                        </li>
                        <li>
                            <a href='entrada.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                ENTRADA
                            </a>
                        </li>
                        <li>
                            <a href='saida_produtos.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                SAÍDA
                            </a>
                        </li> 
                        <li>
                            <a href='relatorio_entrada_produtos.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                RELATÓRIO ENTRADA
                            </a>
                        </li>    
                        <li>
                            <a href='relatorio_saida_produtos.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                RELATÓRIO DE SAÍDA
                            </a>
                        </li>                                                
                        <li>
                            <a href='estoque.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                ESTOQUE
                            </a>
                        </li>                                
                    </ul>
                </li>                 
                <li>
                    <a href='javascript:;' title='Pages'>
                        <i class='glyph-icon icon-folder-open'></i>
                        FARMÁCIA
                    </a>
                    <ul>
                        <li>
                            <a href='produtos_farmacia.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                PRODUTOS
                            </a>
                        </li>
                        <li>
                            <a href='entrada_farmacia.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                ENTRADA
                            </a>
                        </li>
                        <li>
                            <a href='saida_produtos_farmacia.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                SAÍDA
                            </a>
                        </li>    
                         <li>
                            <a href='relatorio_entrada_produtos_farmacia.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                RELATÓRIO ENTRADA
                            </a>
                        </li>    
                        <li>
                            <a href='relatorio_saida_produtos_farmacia.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                RELATÓRIO DE SAÍDA
                            </a>
                        </li>                            
                        <li>
                            <a href='estoque_farmacia.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                ESTOQUE
                            </a>
                        </li>                                
                    </ul>
                </li>
                <li>
                    <a href='javascript:;' title='Pages'>
                        <i class='glyph-icon icon-folder-open'></i>
                        RELATÓRIOS
                    </a>
                    <ul>
                        <li>
                            <a href='relatorio_agendamento.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                AGENDAMENTOS
                            </a>
                        </li>
                        <li>
                            <a href='relatorio_triagem.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                TRIAGENS
                            </a>
                        </li>
                        <li>
                            <a href='relatorio_pagamento.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                PAGAMENTOS
                            </a>
                        </li>                                     
                    </ul>
                </li>
                <div class='divider mrg5T mobile-hidden'></div>  
                <li>
                    <a href='#' title='Painel' style='color: green;'>
                        <i class='glyph-icon icon-user'></i>
                        CATALOGADOR
                    </a>
                </li>
                <li>
                    <a href='javascript:;' title='Cadastros'>
                        <i class='glyph-icon icon-folder-open'></i>
                        AGENDA
                    </a>
                    <ul>
                        <li>
                            <a href='pacientes.php' title='Pacientes'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                PACIENTES
                            </a>
                        </li> 
                        <li>
                            <a href='pacientes_agendados.php' title='Pacientes'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                AGENDADOS
                            </a>
                        </li>                                
                    </ul>
                </li>
                <li>
                    <a href='javascript:;' title='Cadastros'>
                        <i class='glyph-icon icon-folder-open'></i>
                        TRANSFERÊNCIA
                    </a>
                    <ul>                               
                        <li>
                            <a href='pacientes_transferencia.php' title='Pacientes'>
                                <i class='glyph-icon icon-chevron-right'></i>
                                PACIENTES
                            </a>
                        </li>                                
                    </ul>
                </li>
                <li>
                    <a href='javascript:;' title='Pages'>
                        <i class='glyph-icon icon-folder-open'></i>
                        PACIENTES
                    </a>
                    <ul>
                        <li>
                            <a href='pacientes_cadastrados.php' title=' '>
                                <i class='glyph-icon icon-chevron-right'></i>
                                CADASTRADOS
                            </a>
                        </li>                                                                         
                    </ul>
                </li>
            </ul>  
            <div class='divider mrg5T mobile-hidden'></div>   
            <li>
                <a href='#' title='Painel' style='color: green;'>
                    <i class='glyph-icon icon-user'></i>
                    CAIXA
                </a>
            </li>    
            <li>
                <a href='javascript:;' title='Cadastros'>
                    <i class='glyph-icon icon-folder-open'></i>
                    FACTURACAO
                </a>
                <ul>
                    <li>
                        <a href='faturar_consultas.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            CONSULTAS
                        </a>
                    </li>                                
                    <li>
                        <a href='faturar_estomatologia.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            ESTOMATOLOGIA
                        </a>
                    </li>                                
                    <li>
                        <a href='faturar_exames.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            EXAMES
                        </a>
                    </li>                                
                    <li>
                        <a href='faturar_servicos_gerais.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            S. GERAIS
                        </a>
                    </li>                                
                </ul>
            </li>
            <div class='divider mrg5T mobile-hidden'></div>   
            <li>
                <a href='#' title='Painel' style='color: green;'>
                    <i class='glyph-icon icon-user'></i>
                    ENFERMEIRO
                </a>
            </li>        
            <li>
                <a href='javascript:;' title='Cadastros'>
                    <i class='glyph-icon icon-folder-open'></i>
                    TRIAGEM
                </a>
                <ul>
                    <li>
                        <a href='pacientes_triagem.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            PACIENTES
                        </a>
                    </li>                                
                    <li>
                        <a href='pacientes_triados.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            PACIENTES TRIADOS
                        </a>
                    </li>                                
                </ul>
            </li>
             <li>
                <a href='javascript:;' title='Cadastros'>
                    <i class='glyph-icon icon-folder-open'></i>
                    TRANSFERÊNCIA
                </a>
                <ul>                               
                    <li>
                        <a href='pacientes_transferencia.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            PACIENTES
                        </a>
                    </li>                                
                </ul>
            </li>
            <div class='divider mrg5T mobile-hidden'></div>   
            <li>
                <a href='#' title='Painel' style='color: green;'>
                    <i class='glyph-icon icon-user'></i>
                    MÉDICO
                </a>
            </li>
            <li>
                <a href='javascript:;' title='Cadastros'>
                    <i class='glyph-icon icon-folder-open'></i>
                    TRIAGEM
                </a>
                <ul>                               
                    <li>
                        <a href='pacientes_triados.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            PACIENTES TRIADOS
                        </a>
                    </li>                                
                </ul>
            </li>
            <li>
                <a href='javascript:;' title='Cadastros'>
                    <i class='glyph-icon icon-folder-open'></i>
                    CONSULTAS
                </a>
                <ul>                               
                    <li>
                        <a href='pacientes_consulta.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            PACIENTES
                        </a>
                    </li>                                
                </ul>
            </li>
            <!--<li>
                <a href='javascript:;' title='Cadastros'>
                    <i class='glyph-icon icon-folder-open'></i>
                    CID
                </a>
                <ul>                               
                    <li>
                        <a href='hipotese.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            HIPÓTESE
                        </a>
                    </li> 
                    <li>
                        <a href='exame_clinico.php' title='Pacientes'>
                            <i class='glyph-icon icon-chevron-right'></i>
                            EXAME
                        </a>
                    </li>                                
                </ul>
            </li>-->
        </ul>
        </div>
    </div><!-- #page-sidebar -->
    ";
    }else if(isUserLoggedIn() && ($loggedInUser->title == 'catalogador')) {
        echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                    <li>
                                        <a href='painel.php' title='Painel'>
                                            <i class='glyph-icon icon-th'></i>
                                            PAINEL
                                        </a>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            AGENDA
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='pacientes.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES
                                                </a>
                                            </li> 
                                            <li>
                                                <a href='pacientes_agendados.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    AGENDADOS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            TRANSFERÊNCIA
                                        </a>
                                        <ul>                               
                                            <li>
                                                <a href='pacientes_transferencia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Pages'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            PACIENTES
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='pacientes_cadastrados.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CADASTRADOS
                                                </a>
                                            </li>                                                                         
                                        </ul>
                                    </li>
                                </ul>                                     
                                <div class='divider mrg5T mobile-hidden'></div>                    
                            </div>
                        </div><!-- #page-sidebar -->
                        ";
                    }
        else if(isUserLoggedIn() && ($loggedInUser->title == 'caixa')) {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                    <li>
                                        <a href='painel.php' title='Painel'>
                                            <i class='glyph-icon icon-th'></i>
                                            PAINEL
                                        </a>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            FACTURACAO
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='faturar_consultas.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CONSULTAS
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='faturar_estomatologia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ESTOMATOLOGIA
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='faturar_exames.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAMES
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='faturar_servicos_gerais.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    S. GERAIS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href='caixa_fechar.php' title='Painel'>
                                            <i class='glyph-icon icon-lock'></i>
                                            FECHAR CAIXA
                                        </a>
                                    </li>
                                                                        
                                </ul>                                     
                                <div class='divider mrg5T mobile-hidden'></div>                    
                            </div>
                        </div><!-- #page-sidebar -->
                        ";
                    }
        else if(isUserLoggedIn() && ($loggedInUser->title == 'tesoreiro')) {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                    <li>
                                        <a href='painel.php' title='Painel'>
                                            <i class='glyph-icon icon-th'></i>
                                            PAINEL
                                        </a>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            CAIXA
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='tesoreiro_caixa_abrir.php' title=' ABRIR/FECHAR'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ABRIR/FECHAR
                                                </a>
                                            </li> 
                                            <li>
                                                <a href='tesoreiro_caixa_relatorio.php' title='RELATÓRIO DE HOJE'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    RELATÓRIO DE HOJE
                                                </a>
                                            </li>                                                         
                                            <!--
                                            <li>
                                                <a href='tesoreiro_caixa_relatorio_total.php' title='TOTAL ABERTO'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    TOTAL ABERTO
                                                </a>
                                            </li>                                                         
                                            <li>
                                                <a href='tesoreiro_caixa_relatorio_total_fecho.php' title='TOTAL FECHO'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    TOTAL FECHO
                                                </a>
                                            </li>   
                                            <li>
                                                <a href='tesoreiro_caixa_relatorio_total_consultas.php' title='TOTAL CONSULTAS'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    TOTAL CONSULTAS
                                                </a>
                                            </li>      
                                             <li>
                                                <a href='tesoreiro_caixa_relatorio_total_gerais.php' title='TOTAL SERVIÇOS GERAIS'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    TOTAL SERVIÇOS GERAIS
                                                </a>
                                            </li>                                                             
                                            <li>
                                                <a href='tesoreiro_caixa_relatorio_total_exames.php' title='TOTAL S. EXAMES'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    TOTAL S. EXAMES
                                                </a>
                                            </li> 
                                            <li>
                                                <a href='tesoreiro_caixa_relatorio_total_estomatologia.php' title='TOTAL ESTOMATOLOGIA'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    TOTAL ESTOMATOLOGIA
                                                </a>
                                            </li> -->                                                              
                                                                                                                       
                                        </ul>
                                    </li>
                                    <li>
	                                    <a href='javascript:;' title='Cadastros'>
	                                        <i class='glyph-icon icon-folder-open'></i>
	                                        ISENÇÃO
	                                    </a>
	                                    <ul>
	                                        <li>
	                                            <a href='insesao_servicos_gerais.php' title='SERVIÇOS GERAIS'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                SERVIÇOS GERAIS
	                                            </a>
	                                        </li>                                                                           
	                                        <li>
	                                            <a href='insesao_servicos_exames.php' title='Pacientes'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                EXAMES
	                                            </a>
	                                        </li>                                                                          
	                                        <li>
	                                            <a href='insesao_servicos_consultas.php' title='Pacientes'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                CONSULTAS
	                                            </a>
	                                        </li>
	                                        <li>
	                                            <a href='insesao_servicos_estomatologia.php' title='Pacientes'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                ESTOMATOLOGIA
	                                            </a>
	                                        </li>                                                                          
	                                    </ul>
                                	</li>
                                	<li>
	                                    <a href='javascript:;' title='Cadastros'>
	                                        <i class='glyph-icon icon-folder-open'></i>
	                                        HISTÓRICOS INSESÃO
	                                    </a>
	                                    <ul>
	                                        <li>
	                                            <a href='h_insesao_servicos_gerais.php' title='SERVIÇOS GERAIS'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                SERVIÇOS GERAIS
	                                            </a>
	                                        </li>                                                                           
	                                        <li>
	                                            <a href='h_insesao_servicos_exames.php' title='Pacientes'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                EXAMES
	                                            </a>
	                                        </li>                                                                          
	                                        <li>
	                                            <a href='h_insesao_servicos_consultas.php' title='Pacientes'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                CONSULTAS
	                                            </a>
	                                        </li>
	                                        <li>
	                                            <a href='h_insesao_servicos_estomatologia.php' title='Pacientes'>
	                                                <i class='glyph-icon icon-chevron-right'></i>
	                                                ESTOMATOLOGIA
	                                            </a>
	                                        </li>                                                                          
	                                    </ul>
                                	</li>
                                	<li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            DEVOLUÇÕES
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='devolucao_servicos_gerais.php' title='SERVIÇOS GERAIS'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    SERVIÇOS GERAIS
                                                </a>
                                            </li>                                                                           
                                            <li>
                                                <a href='devolucao_servicos_exames.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAMES
                                                </a>
                                            </li>                                                                          
                                            <li>
                                                <a href='devolucao_servicos_consultas.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CONSULTAS
                                                </a>
                                            </li>
                                            <li>
                                                <a href='devolucao_servicos_estomatologia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ESTOMATOLOGIA
                                                </a>
                                            </li>                                                                          
                                        </ul>
                                    </li> 
                                    <li>
                                        <a style='font-size:11px;' href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            HISTÓRICOS DEVOLUÇÕES
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='h_devolucao_servicos_gerais.php' title='SERVIÇOS GERAIS'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    SERVIÇOS GERAIS
                                                </a>
                                            </li>                                                                           
                                            <li>
                                                <a href='h_devolucao_servicos_exames.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAMES
                                                </a>
                                            </li>                                                                          
                                            <li>
                                                <a href='h_devolucao_servicos_consultas.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CONSULTAS
                                                </a>
                                            </li>
                                            <li>
                                                <a href='h_devolucao_servicos_estomatologia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ESTOMATOLOGIA
                                                </a>
                                            </li>                                                                          
                                        </ul>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            FACTURACAO
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='faturar_consultas.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CONSULTAS
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='faturar_estomatologia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ESTOMATOLOGIA
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='faturar_exames.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAMES
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='faturar_servicos_gerais.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    S. GERAIS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>  
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            CADASTROS
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='servicos_gerais.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    SERVIÇOS GERAIS
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='servicos_estomatologia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    S. DE ESTOMATOLOGIA
                                                </a>
                                            </li>            
                                            <li>
                                                <a href='servicos_exames.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAMES
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='servicos_consultas.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CONSULTAS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li> 
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            AGENDA
                                        </a>
                                        <ul> 
                                            <li>
                                                <a href='pacientes_agendados.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    AGENDADOS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                                                       
                                
                                    <li>
                                        <a style='font-size:12px;' href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            HISTÓRICOS DE VENDAS
                                        </a>
                                        <ul>
                                                                                                                     
                                            <li>
                                                <a href='historico_vendas_servicos_consultas.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    CONSULTAS
                                                </a>
                                            </li>
                                            <li>
                                                <a href='historico_vendas_servicos_gerais.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    SERVIÇOS GERAIS
                                                </a>
                                            </li>                                                                           
                                            <li>
                                                <a href='historico_vendas_servicos_exames.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAMES
                                                </a>
                                            </li> 
                                            <li>
                                                <a href='historico_vendas_servicos_estomatologia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ESTOMATOLOGIA
                                                </a>
                                            </li>                                                                          
                                        </ul>
                                    </li>                                 
                                </ul>                                     
                                <div class='divider mrg5T mobile-hidden'></div>                    
                            </div>
                        </div><!-- #page-sidebar -->
                        ";
                    }
        else if(isUserLoggedIn() && ($loggedInUser->title == 'enfermeiro')) {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                    <li>
                                        <a href='painel.php' title='Painel'>
                                            <i class='glyph-icon icon-th'></i>
                                            PAINEL
                                        </a>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            TRIAGEM
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='pacientes_triagem.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES
                                                </a>
                                            </li>                                
                                            <li>
                                                <a href='pacientes_triados.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES TRIADOS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                     <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            TRANSFERÊNCIA
                                        </a>
                                        <ul>                               
                                            <li>
                                                <a href='pacientes_transferencia.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                </ul>                                     
                                <div class='divider mrg5T mobile-hidden'></div>                    
                            </div>
                        </div><!-- #page-sidebar -->
                        ";
                    }
        else if(isUserLoggedIn() && ($loggedInUser->title == 'doctor')) {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                    <li>
                                        <a href='painel.php' title='Painel'>
                                            <i class='glyph-icon icon-th'></i>
                                            PAINEL
                                        </a>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            ATENDIMENTO
                                        </a>
                                        <ul>                               
                                            <li>
                                                <a href='pacientes_consulta.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            TRIAGEM
                                        </a>
                                        <ul>                               
                                            <li>
                                                <a href='pacientes_triados.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES TRIADOS
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>                                    
                                    <li>
                                    <a href='javascript:;' title='Cadastros'>
                                        <i class='glyph-icon icon-folder-open'></i>
                                        TRANSFERÊNCIA
                                    </a>
                                    <ul>                               
                                        <li>
                                            <a href='pacientes_transferencia.php' title='Pacientes'>
                                                <i class='glyph-icon icon-chevron-right'></i>
                                                PACIENTES
                                            </a>
                                        </li>                                
                                    </ul>
                                </li>
                                    <li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            HISTÓRICO
                                        </a>
                                        <ul>                               
                                            <li>
                                                <a href='pacientes_historico.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PACIENTES
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>
                                    <!--<li>
                                        <a href='javascript:;' title='Cadastros'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            CID
                                        </a>
                                        <ul>                               
                                            <li>
                                                <a href='hipotese.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    HIPÓTESE
                                                </a>
                                            </li> 
                                            <li>
                                                <a href='exame_clinico.php' title='Pacientes'>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    EXAME
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>  -->                                  
                                </ul>                                     
                                <div class='divider mrg5T mobile-hidden'></div>                    
                            </div>
                        </div><!-- #page-sidebar -->
                        ";
                    }else if(isUserLoggedIn() && ($loggedInUser->title == 'farmaceutico')) {
            echo "
            <div id='page-sidebar' class='scrollable-content'>
                            <div id='sidebar-menu'>
                                <ul>
                                    <li>
                                        <a href='javascript:;' title='Pages'>
                                            <i class='glyph-icon icon-folder-open'></i>
                                            FARMÁCIA
                                        </a>
                                        <ul>
                                            <li>
                                                <a href='produtos_farmacia.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    PRODUTOS
                                                </a>
                                            </li>
                                            <li>
                                                <a href='entrada_farmacia.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ENTRADA
                                                </a>
                                            </li>
                                            <li>
                                                <a href='saida_produtos_farmacia.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    SAÍDA
                                                </a>
                                            </li>    
                                             <li>
                                                <a href='relatorio_entrada_produtos_farmacia.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    RELATÓRIO ENTRADA
                                                </a>
                                            </li>    
                                            <li>
                                                <a href='relatorio_saida_produtos_farmacia.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    RELATÓRIO DE SAÍDA
                                                </a>
                                            </li>                            
                                            <li>
                                                <a href='estoque_farmacia.php' title=' '>
                                                    <i class='glyph-icon icon-chevron-right'></i>
                                                    ESTOQUE
                                                </a>
                                            </li>                                
                                        </ul>
                                    </li>                                   
                                </ul>                                     
                                <div class='divider mrg5T mobile-hidden'></div>                    
                            </div>
                        </div><!-- #page-sidebar -->
                        ";
                    }else if(isUserLoggedIn() && ($loggedInUser->title == 'gestorestoque')) {
                echo "
                <div id='page-sidebar' class='scrollable-content'>
                                <div id='sidebar-menu'>
                                    <ul>
                                        <li>
                                            <a href='javascript:;' title='Pages'>
                                                <i class='glyph-icon icon-folder-open'></i>
                                                ESTOQUE
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href='produtos.php' title=' '>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        PRODUTOS
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='entrada.php' title=' '>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        ENTRADA
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='saida_produtos.php' title=' '>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        SAÍDA
                                                    </a>
                                                </li> 
                                                <li>
                                                    <a href='relatorio_entrada_produtos.php' title=' '>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        RELATÓRIO ENTRADA
                                                    </a>
                                                </li>    
                                                <li>
                                                    <a href='relatorio_saida_produtos.php' title=' '>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        RELATÓRIO DE SAÍDA
                                                    </a>
                                                </li>                                                
                                                <li>
                                                    <a href='estoque.php' title=' '>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        ESTOQUE
                                                    </a>
                                                </li>                                
                                            </ul>
                                        </li>                 
                                    </ul>                                     
                                    <div class='divider mrg5T mobile-hidden'></div>                    
                                </div>
                            </div><!-- #page-sidebar -->
                            ";
                        } else if(isUserLoggedIn() && ($loggedInUser->title == 'rh')) {
                echo "
                <div id='page-sidebar' class='scrollable-content'>
                                <div id='sidebar-menu'>
                                    <ul>
                                        <li>
                                            <a href='javascript:;' title='Cadastros'>
                                                <i class='glyph-icon icon-folder-open'></i>
                                                CADASTROS
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href='funcionarios.php' title='Pacientes'>
                                                        <i class='glyph-icon icon-chevron-right'></i>
                                                        FUNCIONÁRIOS
                                                    </a>
                                                </li>                                
                                            </ul>
                                        </li>
                                                             </ul>                                     
                                    <div class='divider mrg5T mobile-hidden'></div>                    
                                </div>
                            </div><!-- #page-sidebar -->
                            ";
                        }
			?>