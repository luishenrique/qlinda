<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - Luis Henrique Rodrigues
 * 	@data de criação - 29/08/2014
 * 	@arquivo - pedido_venda.class.php
 */

class pedido_venda {

	//Atributos

    private $id;
    private $data;
    private $cliente_id;
	private $desconto;
	private $valor_total;
	private $forma_pagamento;
	private $data_pagamento;
	private $status_pagamento;
	private $obs;	

	//Getters

    public function getId() {
        return $this->id;
    }
	
	public function getData() {
        return $this->data;
    }
	
	public function getClienteId() {
        return $this->cliente_id;
    }
	
	public function getDesconto() {
        return $this->desconto;
    }
	
	public function getValorTotal() {
        return $this->valor_total;
    }
	
	public function getFormaPagamento() {
        return $this->forma_pagamento;
    }
	
	public function getDataPagamento() {
        return $this->data_pagamento;
    }
	
	public function getStatusPagamento() {
        return $this->status_pagamento;
    }
	
	public function getObs() {
        return $this->obs;
    }

	//Setters

    public function setId($id) {
        $this->id = $id;
    }
	
	public function setData($data) {
        $this->data = $data;
    }
	
	public function setClienteId($cliente_id) {
        $this->cliente_id = $cliente_id;
    }
	
	public function setDesconto($desconto) {
        $this->desconto = $desconto;
    }
	
	public function setValorTotal($valor_total) {
        $this->valor_total = $valor_total;
    }

	public function setFormaPagamento($forma_pagamento) {
        $this->forma_pagamento = $forma_pagamento;
    }
	
	public function setDataPagamento($data_pagamento) {
        $this->data_pagamento = $data_pagamento;
    }
	
	public function setStatusPagamento($status_pagamento) {
        $this->status_pagamento = $status_pagamento;
    }
	
	public function setObs($obs) {
        $this->obs = $obs;
    }
}

?>
