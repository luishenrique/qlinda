<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 09/09/2014
 * 	@arquivo  - visualizar.php
 */

require_once ("../../controller/pedido_venda.controller.class.php");
require_once ("../../model/pedido_venda.class.php");

require_once ("../../controller/cliente.controller.class.php");
require_once ("../../model/cliente.class.php");

require_once ("../../controller/itens_venda.controller.class.php");
require_once ("../../model/itens_venda.class.php");

require_once ("../../controller/produto.controller.class.php");
require_once ("../../model/produto.class.php");


include_once ("../../functions/functions.class.php");

$pedido_controller = new PedidoVendaController();
$pedido_venda = new pedido_venda();

$cliente_controller = new ClienteController();
$cliente = new cliente();

$itens_controller = new ItensVendaController();
$itens = new itens_venda();

$produto_controller = new ProdutoController();
$produto = new produto ();

$functions = new Functions;

$id = ( isset($_GET['id'])) ? $_GET['id'] : 0;

if ($id > 0) {
	$pedido_venda = $pedido_controller->loadObject($id, 'id');
	$cliente = $cliente_controller->loadObject($pedido_venda->getClienteId(), 'id');
	$registros = $itens_controller->listObjects("pedido_venda_id = " . $pedido_venda->getId());
} else {
	die("Nenhum pedido selecionado");
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
        
          <h2>Pedido Nº <?php echo $pedido_venda->getId() ?>    
			<?php if ($pedido_venda->getStatusPagamento() > 0 ){
			?>	
          <a href="baixa.php?id=<?php echo $pedido_venda->getId();?>" class="btn btn-success btn-large">Efetuar baixa</a><?php } ?>	</h2>   

          	<h4><?php if ($pedido_venda->getStatusPagamento() == 1 ){
				echo "<div class='alert alert-block'>Status: ABERTO - "  . "Data Vencimento:" . substr($functions -> converterDataHoraPadrao($pedido_venda->getDataPagamento()), 0, -11) . "</div> ";          		
          	} else if ($pedido_venda->getStatusPagamento() == 2 ){
          		echo "<div class='alert alert-error'>Status: VENCIDO - " . "Data Vencimento:" . substr($functions -> converterDataHoraPadrao($pedido_venda->getDataPagamento()), 0, -11) . "</div>" ; 
          	} else {
          		echo "<div class='alert alert-success'>Status: PAGO - " . "Data Pagamento:" . substr($functions -> converterDataHoraPadrao($pedido_venda->getDataPagamento()), 0, -11) . "</div>" ;
          	}
 			?>  </h4>
       
	
	
		<table border="0" class="table-condensed">
			<tr><td colspan="3"><?php  echo "Data: " . $functions -> converterDataHoraPadrao($pedido_venda->getData()); ?></td></tr>
			<tr><td colspan="3">Cliente: <big><?php echo $cliente->getNome() ?></big></td></tr>
			<tr><td>CPF: <?php echo $cliente->getCpf() ?></td><td colspan="2">RG: <?php echo $cliente->getRg() ?></td></tr>
			<tr><td>Endereço: <?php echo $cliente->getEndereco() ?></td><td>Bairro: <?php echo $cliente->getBairro() ?></td><td>Cidade: <?php echo $cliente->getCidade() . ' - ' . $cliente->getUf()  ?></td></tr>
			
		</table>
		</br>
		<table border="1" class="table-condensed">
			<tr><th>Cód.</th><th>Cód. Barras</th><th>Descrição Produto</th><th>Valor Unit. R$</th><th>Quantidade</th><th>Total R$</th></tr>
			<?php         
		        if($registros){
		        if(mysql_num_rows($registros) > 0){
		        	while($reg = mysql_fetch_array($registros)){
		        		$produto = $produto_controller->loadObject($reg['produto_id'], 'id');	

				?>
				
			<tr><td><?php echo $produto->getId(); ?></td>
				<td><?php echo $produto->getCodigoBarras(); ?></td>
				<td><?php echo $produto->getDescricao(); ?></td>
				<td><?php echo 'R$ '. $reg["valor"]; ?></td>
				<td><?php echo $reg["quantidade"]; ?></td>
				<td><?php echo 'R$ '. $reg['quantidade'] * $reg['valor']; ?></td>
				
			</tr>
			<?php } ?>

			<tr><td colspan="6">Obs: <?php echo $pedido_venda->getObs(); ?></td></tr>
			<tr style="background-color: #EEE"><td>Desconto:</td>
				<td colspan="2">R$ <?php echo $pedido_venda->getDesconto(); ?></td>
				<td>Total:</td>
				<td colspan="2"><strong>R$ <?php echo $pedido_venda->getValorTotal(); ?></strong></td></tr>
			
		</table>
		
      	<?php
			}};
		?>

      <hr>

        <div class="control-group">
            <div class="controls">
              <a href="lista.php" class="btn btn btn-large">Voltar aos Pedidos</a>
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