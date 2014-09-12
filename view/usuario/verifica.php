<?php

session_start();
if (empty($_SESSION["usuario_login"])){
	header("Location: ../../index.php");	
}

?>