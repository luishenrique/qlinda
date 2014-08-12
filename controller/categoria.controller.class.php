<?php

/*
 *  Descrição do Arquivo
 *  @author Luis Henrique Rodrigues
 *  @data de criação - 16/04/2014
 *  @arquivo - categoria.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class CategoriaController extends Crud {

    //Método construtor

    public function __construct() {
        
        //Passa como parâmetro a tabela
        parent::__construct("categoria");
    }
}

?>