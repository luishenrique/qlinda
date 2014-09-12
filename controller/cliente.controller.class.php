<?php

/*
 * 	Descrição do Arquivo
 * 	@author Luis Henique Rodrigues	
 * 	@data de criação - 12/04/2014
 * 	@arquivo - cliente.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class ClienteController extends Crud {

	//Método construtor

    public function __construct() {
		
		//Passa como parâmetro a tabela
        parent::__construct("cliente");
    }

	public function selected( $value, $selected=NULL){
    	return $value==$selected ? ' selected="selected"' : '';	
	}	

	public function busca($nome){
		return $this->execute_query("SELECT * FROM " . $this->getTabela() .  " WHERE nome LIKE '%" . $nome . "%' ;" );
	}
}
?>