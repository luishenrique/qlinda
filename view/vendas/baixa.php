<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 12/09/2014
 * 	@arquivo  - baixa.php
 */

require_once ("../../controller/pedido_venda.controller.class.php");
require_once ("../../model/pedido_venda.class.php");

require_once ("../../controller/cliente.controller.class.php");
require_once ("../../model/cliente.class.php");

include_once("../../functions/functions.class.php");

require ("../../view/usuario/verifica.php");

$pedido_controller = new PedidoVendaController();
$pedido_venda = new pedido_venda();

$cliente_controller = new ClienteController();
$cliente = new cliente();

$functions = new Functions;

$id = ( isset($_GET['id'])) ? $_GET['id'] : 0;

if(isset($_GET['resposta']) == 'SIM') {
  $pedido_venda = $pedido_controller->loadObject($id, 'id');    
  $pedido_venda->setStatusPagamento(4);  
  $data = date('Y-m-d H:i:s');
  $pedido_venda->setDataPagamento($data);
  $pedido_controller->update($pedido_venda, 'id');  
  header('Location: visualizar.php?id=' . $pedido_venda->getId());
     
}

if ($id > 0) {
  $pedido_venda = $pedido_controller->loadObject($id, 'id');
  $cliente = $cliente_controller->loadObject($pedido_venda->getClienteId(), 'id');  
} else {
  die("Nenhum pedido selecionado");
}

?>
<!DOCTYPE html>
<html>
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
                $functions->geraMenu();
            ?>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


    <div class="container">

		<!-- Título -->
        <blockquote>
          <h2>Efetuar baixa em conta</h2>
          <small>Escolha a opção desejada clicando nos botões abaixo</small>
        </blockquote>
        
		<hr>
        
		<div class="text-center">
			


			
      <h2>Pedido Nº <?php echo $pedido_venda->getId() ?>   |    Valor: R$ <?php echo $pedido_venda->getValorTotal(); ?></h2>
      <div class="text-left">
        <table border="2" width="100%">
      <tr><td colspan="3"><?php  echo "Data: " . $functions -> converterDataHoraPadrao($pedido_venda->getData()); ?></td></tr>
      <tr><td colspan="3">Cliente: <big><?php echo $cliente->getNome() ?></big></td></tr>
      <tr><td>CPF: <?php echo $cliente->getCpf() ?></td><td colspan="2">RG: <?php echo $cliente->getRg() ?></td></tr>
      <tr><td>Endereço: <?php echo $cliente->getEndereco() ?></td><td>Bairro: <?php echo $cliente->getBairro() ?></td><td>Cidade: <?php echo $cliente->getCidade() . ' - ' . $cliente->getUf()  ?></td></tr>
      
    </table>

    <p>&nbsp;</p>
        
        <div class="text-center alert" >
        <p>Tem certeza que deseja dar baixa no Pedido acima?</p>          
        <div class="control-group">

      
            <div class="controls" style="text-align:center">                                          
              <a href="baixa.php?id=<?php echo $pedido_venda->getId();?>&resposta=SIM" class="btn btn-success btn-large">Sim </a>&nbsp;&nbsp;
              <a href="../usuario/home.php" class="btn btn btn-large">Não </a>
            </div>
      
    </div>

</div>

  </div>
    </div>

		</div>
        
        
		<hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>

    </div> 
    <!-- /container -->

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