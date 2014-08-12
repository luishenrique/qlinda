<?php

/*
 * 	Descrição do Arquivo
 * 	@author Luis Henrique Rodrigues
 * 	@data de criação - 01/04/2014
 * 	@arquivo - produto.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once ("../../functions/crud.class.php");

class ProdutoController extends Crud {

	//Método construtor

	public function __construct() {

		//Passa como parâmetro a tabela
		parent::__construct("produto");
	}

	public function ultimoId() {
		return $this -> execute_query("SELECT MAX(id) FROM " . $this -> getTabela() . ";");
	}

	public function busca($descricao) {
		return $this -> execute_query("SELECT * FROM " . $this -> getTabela() . " WHERE descricao LIKE '%" . $descricao . "%' ;");
	}

}
?>