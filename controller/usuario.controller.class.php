<?php

/*
 * 	Descrição do Arquivo
 * 	@author Luis Henique Rodrigues	
 * 	@data de criação - 05/04/2014
 * 	@arquivo - usuario.controller.class.php
 */

//Inclui a classe genérica CRUD
require_once("../../functions/crud.class.php");

class UsuarioController extends Crud {

	//Método construtor

    public function __construct() {
		
		//Passa como parâmetro a tabela
        parent::__construct("usuario");
    }


    //Método específico da classe
	public function autentica($login,$senha){		
		return $this->execute_query("SELECT * FROM " . $this->getTabela() .  " WHERE login = '" . $login . "' AND senha = '" . $senha . "' ;" );
	}
	
	public function logoff(){
		
		session_start();
		$_SESSION["usuario_id"] 	= NULL;
		$_SESSION["usuario_login"] 	= NULL;
		$_SESSION["usuario_nome"] 	= NULL;
				
		session_unset();
		session_destroy();

		//Sucesso, redireciona para a tela principal
		header("Location: login.php");
		
	}

}

?>