<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - Luis Henrique Rodrigues
 * 	@data de criação - 15/04/2014
 * 	@arquivo - categoria.class.php
 */

class categoria {

	//Atributos

    private $id;    
    private $descricao;

	//Getters

    public function getId() {
        return $this->id;
    }

    public function getDescricao(){
        return $this->descricao;
    }


	//Setters

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}

?>
