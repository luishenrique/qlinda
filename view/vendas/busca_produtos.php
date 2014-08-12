<?php

require_once ("../../controller/produto.controller.class.php");
require_once ("../../model/produto.class.php");

include_once ("../../functions/functions.class.php");

$produto = new ProdutoController;

$registro = $produto -> load($_GET['id'], "id");

echo json_encode($registro);
	
?>