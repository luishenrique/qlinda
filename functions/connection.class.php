<?php
class Connection{

	private $connection;
	
	//Local DB
	private $parameters = array("host"=>"localhost","user"=>"root","password"=>"senha","database"=>"qlinda");

	public function openConnection(){
		
		$this->connection = mysql_connect($this->parameters["host"], $this->parameters["user"], $this->parameters["password"]);

		if (!$this->connection) {
			die ("Erro ao estabelecer conexão com a base de dados");
		} else{
			//echo "Abriu conexão";
			$this->selectDatabase();
		}
	}

	private function selectDatabase(){

		$database = mysql_select_db($this->parameters["database"], $this->connection);

		if (!$database) {
			die ("Base de dados não encontrada");
		}else{
			//echo "Selecionou DB";
		}
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');

	}
	
	public function getConnection(){
		return $this->connection;
	}
	

	public function closeConnection(){
		mysql_close($this->connection);
		//echo "Fechou conexão";
	}

}

?>