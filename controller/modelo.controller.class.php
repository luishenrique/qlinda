<?php

/*
 * 	Descrição do Arquivo
 * 	@author João Ricardo Gomes dos Reis
 * 	@data de criação - 01/04/2014
 * 	@arquivo - modelo.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class ModeloController extends Crud {

	//Método construtor

    public function __construct() {
		
		//Passa como parâmetro a tabela
        parent::__construct("modelo");
    }
}

?>