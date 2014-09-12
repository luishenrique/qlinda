<?php  
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 29/04/2014
 * 	@arquivo  - salvar_pedido.php
 */

 
require_once ("../../controller/pedido_venda.controller.class.php");
require_once ("../../model/pedido_venda.class.php");

require_once ("../../controller/itens_venda.controller.class.php");
require_once ("../../model/itens_venda.class.php");

require_once ("../../controller/estoque.controller.class.php");
require_once ("../../model/estoque.class.php");

include_once ("../../functions/functions.class.php");	


$controllerPedidoVenda = new PedidoVendaController();
$pedidoVenda = new pedido_venda();

$controllerItensVenda = new ItensVendaController();
$itensVenda = new itens_venda();

$controllerEstoque = new EstoqueController();
$estoque = new estoque();

$data = date('Y-m-d H:i:s');

$pedidoVenda->setData($data);
$pedidoVenda->setClienteId($_POST['cliente_id']);
$pedidoVenda->setDesconto($_POST['desconto']);
$pedidoVenda->setValorTotal($_POST['somartudo']);
$pedidoVenda->setFormaPagamento($_POST['forma_pagamento']);
$pedidoVenda->setObs($_POST['obs']);

// caso seja venda a prazo, prazo de 30 dias
// status pagamento, 0 - pago, 1 - devedor
if ($pedidoVenda->getFormaPagamento() == 'aprazo'){
	$prazo = date('Y-m-d H:i:s', strtotime("+30 days"));	
	$pedidoVenda->setDataPagamento($prazo);	
	$pedidoVenda->setStatusPagamento(1);	
} else {
	$pedidoVenda->setDataPagamento($data);
	$pedidoVenda->setStatusPagamento(4);
}

$controllerPedidoVenda->save($pedidoVenda);

$itensVenda->setPedidoVendaId($controllerPedidoVenda->recuperaUltimoId());

$qtdeProdutos = $_POST['produtos'];

// salva todos itens do pedido
for ($i=1; $i<=$qtdeProdutos; $i++){
	$produto_id = 'produto_id' . $i;
	$produto_quantidade = 'produto_quantidade' . $i;
	$produto_valor = 'produto_valor' . $i;
	
	// verifica se existe o post do item
	if(isset($_POST[$produto_id])){
		//verifica se o campo não está vazio
		if ($_POST[$produto_id] > 0){
			$itensVenda->setProdutoId($_POST[$produto_id]);
			$itensVenda->setQuantidade($_POST[$produto_quantidade]);
			$itensVenda->setValor($_POST[$produto_valor]);
			
			// da baixa no estoque
			$estoque = $controllerEstoque -> ultimoEstoque($itensVenda->getProdutoId(), "produto_id");			
			$estoque->setQuantidade($estoque->getQuantidade() - $itensVenda->getQuantidade());
			$estoque->setData($data);
			$estoque->setPedido($itensVenda->getPedidoVendaId());
			$estoque->setId(NULL);
			$controllerEstoque->save($estoque);			
			
			// salva o item
			$controllerItensVenda->save($itensVenda);				
		}
	}
}

echo $itensVenda->getPedidoVendaId();

?>