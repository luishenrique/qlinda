<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 08/09/2014
 * 	@arquivo  - lista.php
 */

require_once ("../../controller/pedido_venda.controller.class.php");
require_once ("../../model/pedido_venda.class.php");

require_once ("../../controller/cliente.controller.class.php");
require_once ("../../model/cliente.class.php");

include_once ("../../functions/functions.class.php");

$pedido_venda = new PedidoVendaController();

$cliente_controller = new ClienteController();
$cliente = new cliente();

if (isset($_GET['busca'])){
    $registros = $pedido_venda -> busca($_GET["busca"]);	    
} else {
    $registros = $pedido_venda -> listaOrdemDesc();
}

$functions = new Functions;

$id = ( isset($_GET['id'])) ? $_GET['id'] : 0;

if ($id > 0) {
	$load = $cliente->remove($id, 'id');
	header('Location: lista.php?acao=3&tipo=1');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

  	<head>
    
        <meta charset="utf-8">
        <title>Q'Linda!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Estilos -->
        <link href="../../css/bootstrap.css" rel="stylesheet">
        <link href="../../css/geral.css" rel="stylesheet">
        <link href="../../css/validation.css" rel="stylesheet">
        <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
        

  	</head>


	<body>
		<div class="navbar navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img class="brand" src="../../img/assinatura_qlinda.png" alt="" style="width:200px;">
					<div class="nav-collapse collapse">
						<?php
						$functions -> geraMenu();
						?>
					</div>
					<!--/.nav-collapse -->
				</div>
			</div>
		</div>
    
    
    <div class="container">

		<!-- Título -->
        <blockquote>
          <h2>Pedidos</h2>
        </blockquote>


        <!-- Mensagem de Retorno -->
        <?php
        if(!empty($_GET["tipo"])){
		?>
		<section id="aviso">
        <?php
		$functions -> mensagemDeRetorno($_GET["tipo"], $_GET["acao"]);
		?>
        </section> 
		<?php
		}
        ?>



<hr>


        <form class="form-search" id="busca" action="lista.php" method="get">            
            <input type="text" placeholder="Digite o nome do Cliente" class="input-xxlarge" id="busca" name="busca">
            <input type="submit" class="btn" value="Buscar">
        
        </form>
		
		<?php         
        if($registros){
        if(mysql_num_rows($registros) > 0){        	
		?>
        <!-- Lista -->
        <table class="table table-hover">
			<thead>
            	<tr>
                    <th>N° Pedido</th>
                    <th>Nome</th>                    
                    <th style="text-align:center">Data - Hora</th>
                    <th style="text-align:center">Forma de Pgto</th>
                    <th style="text-align:center">Status Pagamento</th>
                    <th style="text-align:center">Data de Pagamento</th>
                    <th style="text-align:center">Obs</th>
                    <th style="text-align:center"><i class="icon-remove"></i></th>
                </tr>
            </thead>
                
            <tbody>
            
				<?php
                	while($reg = mysql_fetch_array($registros)){
                		$status_pagamento = 'Pago';
                		if ($reg['status_pagamento'] == "1"){
                			$status_pagamento = 'Aberto';							
                		}  
						
						$cliente = $cliente_controller->loadObject($reg['cliente_id'], 'id');          				
                			
                		
				?>
            
            	<tr>
                    <td><?php echo $reg["id"]; ?></td>
                    <td><?php echo $cliente->getNome(); ?></td>
					<td style="text-align:center"><?php echo $functions -> converterDataHoraPadrao($reg["data"]); ?></td>
					<td style="text-align:center"><?php echo $reg["forma_pagamento"]; ?></td>
                    <td style="text-align:center"><?php echo $status_pagamento ?></td>
                    <td style="text-align:center"><?php echo substr($functions -> converterDataHoraPadrao($reg["data_pagamento"]), 0, -11); ?></td>
                    <td style="text-align:center"><?php echo $reg["obs"]; ?></td>
                    <td style="text-align:center"><a class="btn btn-small" type="button" onClick="return confirm('Deseja excluir mesmo o Cliente?')" href="lista.php?id=<?php echo $reg["id"]; ?>"><i class="icon-remove"></i></a></td>
                </tr>
            
            	<?php
				}
				?>
            
            </tbody>
		</table>
        
      	<?php
		}else{
		?>
        	<div class="text-center">
                <h2>Ops.. =(</h2>
                <p>Sua pesquisa não retornou nenhum resultado válido.</p>
            </div>
        
        <?php
		}} else {
            echo "Nenhum Cliente cadastrado";
        }   
		?>

      <hr>

        <div class="control-group">
            <div class="controls">
              <a href="edita.php" class="btn btn-success btn-large">Cadastrar um novo Cliente</a>
            </div>
        </div>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>

    </div> <!-- /container -->

    	<!-- Javascript -->
		<script src="../../js/jquery.js"></script>
        <script src="../../js/jquery.validate.min.js"></script>
        <script src="../../js/bootstrap-transition.js"></script>
        <script src="../../js/bootstrap-alert.js"></script>
        <script src="../../js/bootstrap-modal.js"></script>
        <script src="../../js/bootstrap-dropdown.js"></script>
        <script src="../../js/bootstrap-scrollspy.js"></script>
        <script src="../../js/bootstrap-tab.js"></script>
        <script src="../../js/bootstrap-tooltip.js"></script>
        <script src="../../js/bootstrap-popover.js"></script>
        <script src="../../js/bootstrap-button.js"></script>
        <script src="../../js/bootstrap-collapse.js"></script>
        <script src="../../js/bootstrap-carousel.js"></script>
        <script src="../../js/bootstrap-typeahead.js"></script>
    
	</body>


</html>