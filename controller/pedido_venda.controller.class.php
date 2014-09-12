<?php

/*
 * 	Descrição do Arquivo
 * 	@author Luis Henrique Rodrigues
 * 	@data de criação - 29/08/2014
 * 	@arquivo - pedido_venda.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class PedidoVendaController extends Crud {

	//Método construtor

    public function __construct() {
		
		//Passa como parâmetro a tabela
        parent::__construct("pedido_venda");
    }
	
	public function recuperaUltimoId(){		
		 $registro = $this->execute_query("SELECT id FROM pedido_venda ORDER BY id desc LIMIT 1" );
		 $reg = mysql_fetch_row($registro);
		 return $reg[0];
	}
	
	public function listaOrdemDesc(){		
		 return $this->execute_query("SELECT * FROM pedido_venda ORDER BY id desc" );
	}
	
	
}

?>