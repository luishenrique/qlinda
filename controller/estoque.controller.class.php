<?php

/*
 * 	Descrição do Arquivo
 * 	@author Luis Henrique Rodrigues
 * 	@data de criação - 16/04/2014
 * 	@arquivo - estoque.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class EstoqueController extends Crud {

	//Método construtor

    public function __construct() {
		
		//Passa como parâmetro a tabela
        parent::__construct("estoque");
    }
	
	 public function ultimoEstoque ($value, $attr) {
        if (empty($attr)) return false;		
        $sql = "select * from " . $this->getTabela() . " where " . $attr . " = " . $value . " order by data desc limit 1;";		
        return mysql_fetch_object($this->execute_query($sql), $this->getTabela());
    }
}

?>