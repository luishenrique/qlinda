<?php

/*
 * 	Descrição do Arquivo
 * 	@autor - Luis Henrique Rodrigues
 * 	@data de criação - 12/04/2014
 * 	@arquivo - cliente.class.php
 */

class cliente {

	//Atributos

    private $id;
    private $nome;
	private $data_nascimento;
	private $endereco;
	private $bairro;
	private $cidade;
	private $uf;
	private $cep;
	private $cpf;
	private $rg;
	private $data_cadastro;
	private $telefone;
	private $celular;
	private $email;
	private $obs;
	
	//Getters

    public function getId() {
        return $this->id;
    }
	
	public function getNome() {
        return $this->nome;
    }
	
	public function getDataNascimento() {
        return $this->data_nascimento;
    }

	public function getEndereco() {
        return $this->endereco;
    }
	
	public function getBairro() {
        return $this->bairro;
    }
	
	public function getCidade() {
        return $this->cidade;
    }
	
	public function getUf() {
        return $this->uf;
    }
	
	public function getCep() {
        return $this->cep;
    }
	
	public function getCpf() {
        return $this->cpf;
    }
	
	public function getRg() {
        return $this->rg;
    }
	
	public function getDataCadastro() {
        return $this->id;
    }
	
	public function getTelefone() {
        return $this->telefone;
    }
	
	public function getCelular() {
        return $this->celular;
    }
	
	public function getEmail() {
        return $this->email;
    }
	
	public function getObs() {
        return $this->obs;
    }
	
	//Setters

    public function setId($id) {
        $this->id = $id;
    }
	
	public function setNome($nome) {
        $this->nome = $nome;
    }
	
	public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }
	
	public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }
	
	public function setBairro($bairro) {
        $this->bairro = $bairro;
    }
	
	public function setCidade($cidade) {
        $this->cidade = $cidade;
    }
	
	public function setUf($uf) {
        $this->uf = $uf;
    }
	
	public function setCep($cep) {
        $this->cep = $cep;
    }

	public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
	
	public function setRg($rg) {
        $this->rg = $rg;
    }

	public function setDataCadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }
	
	public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
	
	public function setCelular($celular) {
        $this->celular = $celular;
    }
	
	public function setEmail($email) {
        $this->email = $email;
    }
	
	public function setObs($obs) {
        $this->obs = $obs;
    }
	
}


?>
