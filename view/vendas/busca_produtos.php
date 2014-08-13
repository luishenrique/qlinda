<?php

require_once ("../../controller/produto.controller.class.php");
require_once ("../../model/produto.class.php");

include_once ("../../functions/functions.class.php");

$produto = new ProdutoController;

$registro = $produto -> load($_GET['codigo_barras'], "codigo_barras");

echo json_encode($registro);
	
?>