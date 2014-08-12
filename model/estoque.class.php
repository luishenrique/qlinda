<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - Luis Henrique Rodrigues
 * 	@data de criação - 16/04/2014
 * 	@arquivo - estoque.class.php
 */

class estoque {

	//Atributos

    private $id;    
    private $quantidade;
    private $data;
    private $pedido;
    private $produto_id;

	//Getters

    public function getId() {
        return $this->id;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function getData(){
        return $this->data;
    }

    public function getPedido(){
        return $this->pedido;
    }

    public function getProdutoId(){
        return $this->produto_id;
    }


	//Setters

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
    }

    public function setProdutoId($produto_id) {
        $this->produto_id = $produto_id;
    }
}

?>
