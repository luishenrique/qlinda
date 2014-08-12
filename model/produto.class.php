<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - Luis Henrique Rodrigues
 * 	@data de criação - 16/04/2014
 * 	@arquivo - produto.class.php
 */

class produto {

	//Atributos

    private $id;
    private $codigo_barras;
    private $descricao;
    private $valor_custo;
    private $valor_venda;
    private $margem_lucro;
    private $categoria_id;

	//Getters

    public function getId() {
        return $this->id;
    }

    public function getCodigoBarras() {
        return $this->codigo_barras;
    }

    public function getDescricao() {
        return $this->descricao;
    }
   
    public function getValorCusto() {
        return $this->valor_custo;
    }

    public function getValorVenda() {
        return $this->valor_venda;
    }

    public function getMargemLucro() {
        return $this->margem_lucro;
    }

    public function getCategoriaId() {
        return $this->categoria_id;
    }

	//Setters

    public function setId($id) {
        $this->id = $id;
    }

    public function setCodigoBarras($codigo_barras) {
        $this->codigo_barras = $codigo_barras;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setValorCusto($valor_custo) {
        $this->valor_custo = $valor_custo;
    }

    public function setValorVenda($valor_venda) {
        $this->valor_venda = $valor_venda;
    }

    public function setMargemLucro($margem_lucro) {
        $this->margem_lucro = $margem_lucro;
    }

    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
    }
   
}

?>
