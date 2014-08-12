<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - João Ricardo Gomes dos Reis
 * 	@data de criação - 01/04/2014
 * 	@arquivo - modelo.class.php
 */

class modelo {

	//Atributos

    private $id;
    private $nome;
    private $descricao;

	//Getters

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

	//Setters

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}

?>
