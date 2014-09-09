<?php

/*
 * 	Descrição do Arquivo
 * 	@author Luis Henrique Rodrigues
 * 	@data de criação - 29/08/2014
 * 	@arquivo - itens_venda.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class ItensVendaController extends Crud {

	//Método construtor

    public function __construct() {
		
		//Passa como parâmetro a tabela
        parent::__construct("itens_venda");
    }
}

?>