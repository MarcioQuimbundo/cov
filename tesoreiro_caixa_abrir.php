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
        <h3>Abertura/Fecho do Caixa.</h3>
    </div>
    <div id='g10' class='small-gauge float-left hidden'></div>
    <div id='g11' class='small-gauge float-right hidden' style='border: 1px solid red;'></div>
	<div id='page-content' style='margin-top:-18px;'>"; 

		if(isset($_GET['Id']))
		{
			$Id = sanitize($_GET['Id']);
			$acao = sanitize($_GET['acao']);
			$con=connection();

			if ($acao == 'abrir_caixa') {
				$sqls = mysqli_query($con,"UPDATE tbl_users SET active = '1' WHERE tbl_users.id = '$Id'");
				if ($sqls) {
					echo "<script>swal('Caixa Aberto com Sucesso!','','success');</script>";
					?>
					    <script type="text/javascript">
			       			setTimeout("location.href = 'tesoreiro_caixa_abrir.php';", 2500);
			            </script>
					<?php	
				}
			} else if ($acao == 'fechar_caixa') {
				$sqls = mysqli_query($con,"UPDATE tbl_users SET active = '0' WHERE tbl_users.id = '$Id'");
				if ($sqls) {
					echo "<script>swal('Caixa Fechado com Sucesso!','','success');</script>";
					?>
					    <script type="text/javascript">
			       			setTimeout("location.href = 'tesoreiro_caixa_abrir.php';", 2500);
			            </script>
					<?php	
				}
			}
			
		}
	
	
		
echo "
    <form name='#' action='#' method='get'>
        <table class='table' id='example1'> 
            <thead>
                <tr>
                    <th>Funcionário</th>
                    <th>Função</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>";
            $con = connection();
            $data_hoje = date("d-m-Y");
            $sql = "SELECT * FROM `tbl_users` where title='caixa' and id != 4";
				$resultado = mysqli_query($con, $sql);
            	while($v1=mysqli_fetch_array($resultado)){

		            echo "
		                <tr>
						<td>".utf8_encode($v1['display_name'])."</td>
						<td>".utf8_encode($v1['title'])."</td>
						";
						$act = $v1['active'];
						if ($act==1) {
						echo"	
							<td>
								Aberto
						 	</td>";
						} else {							
							echo"
							<td>
								Fechado
						 	</td>
							";
						}
						if ($act==1) {
							echo "
							<td>
								<a href='tesoreiro_caixa_abrir.php?Id=".$v1['id']."&acao=fechar_caixa' class='btn small bg-red tooltip-button' data-placement='top' title='Fechar Caixa'>
									<i class='glyph-icon icon-arrow-left'></i>
								</a>	
			                </td>
							";
						} else {
							echo "
							<td>
								<a href='tesoreiro_caixa_abrir.php?Id=".$v1['id']."&acao=abrir_caixa' class='btn small bg-blue-alt tooltip-button' data-placement='top' title='Abrir Caixa'>
									<i class='glyph-icon icon-arrow-right'></i>
								</a>	
			                </td>
							";
						}
						
						
					echo"
		                </tr>";
    			}
echo "
        </table>
    </form>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
