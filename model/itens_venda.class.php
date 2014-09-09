<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - Luis Henrique Rodrigues
 * 	@data de criação - 29/08/2014
 * 	@arquivo - itens_venda.class.php
 */

class itens_venda {

	//Atributos

    private $id;
	private $quantidade;
	private $valor;
	private $pedido_venda_id;
	private $produto_id;

	//Getters

    public function getId() {
        return $this->id;
    }
	
	public function getQuantidade() {
        return $this->quantidade;
    }
	
	public function getValor() {
        return $this->valor;
    }
	
	public function getPedidoVendaId() {
        return $this->pedido_venda_id;
    }
	
	public function getProdutoId() {
        return $this->produto_id;
    }

	//Setters

    public function setId($id) {
        $this->id = $id;
    }
	
	public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
	
	public function setValor($valor) {
        $this->valor = $valor;
    }
	
	public function setPedidoVendaId($pedido_venda_id) {
        $this->pedido_venda_id = $pedido_venda_id;
    }
	
	public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }
}

?>
