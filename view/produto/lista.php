<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 12/04/2014
 * 	@arquivo  - lista.php - 
 */

require_once ("../../controller/produto.controller.class.php");
require_once ("../../model/produto.class.php");

require_once ("../../controller/estoque.controller.class.php");
require_once ("../../model/estoque.class.php");

require_once ("../../controller/categoria.controller.class.php");
require_once ("../../model/categoria.class.php");

include_once ("../../functions/functions.class.php");

$produto = new ProdutoController;
$estoque = new EstoqueController;
$categoria = new CategoriaController;

$est = new estoque; 
$cat = new categoria;

if (isset($_GET['busca'])){
    $registros = $produto -> busca($_GET["busca"]);	    
} else {
    $registros = $produto -> listObjects();
}

$functions = new Functions;

$id = (isset($_GET['id'])) ? $_GET['id'] : 0;

if ($id > 0) {
	$estoque->remove($id, 'produto_id');
	$load = $produto->remove($id, 'id');
	header('Location: lista.php?acao=3&tipo=1');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

  	<head>
    
        <meta charset="utf-8">
        <title>Q'Linda!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Estilos -->
        <link href="../../css/bootstrap.css" rel="stylesheet">
        <link href="../../css/geral.css" rel="stylesheet">
        <link href="../../css/validation.css" rel="stylesheet">
        <link href="../../css/bootstrap-responsive.css" rel="stylesheet">
        

  	</head>


	<body>
		<div class="navbar navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img class="brand" src="../../img/assinatura_qlinda.png" alt="" style="width:200px;">
					<div class="nav-collapse collapse">
						<?php
						$functions -> geraMenu();
						?>
					</div>
					<!--/.nav-collapse -->
				</div>
			</div>
		</div>
    
    
    <div class="container">

		<!-- Título -->
        <blockquote>
          <h2>Lista de Produtos</h2>
        </blockquote>


        <!-- Mensagem de Retorno -->
        <?php
        if(!empty($_GET["tipo"])){
		?>
		<section id="aviso">
            <?php
    		$functions -> mensagemDeRetorno($_GET["tipo"], $_GET["acao"]);
    		?>
        </section> 
		<?php
		}
        ?>



<hr>


        <form class="form-search" id="busca" action="lista.php" method="get">            
            <input type="text" placeholder="Digite o nome do produto" class="input-xxlarge" id="busca" name="busca">
            <input type="submit" class="btn" value="Buscar">
        
        </form>
		
		<?php			
        if($registros){
        if(mysql_num_rows($registros) > 0){           	
		?>
        <!-- Lista -->
        <table class="table table-hover">
			<thead>
            	<tr>


                    <th>ID</th>
                    <th>Descrição</th>                    
                    <th style="text-align:center">Código de Barras</th>
                    <th style="text-align:center">Preço</th>
                    <th style="text-align:center">Categoria</th>
                    <th style="text-align:center">Quantidade</th>
                    
                    <th style="text-align:center"><i class="icon-edit"></i></th>
                    <th style="text-align:center"><i class="icon-remove"></i></th>
                </tr>
            </thead>
                
            <tbody>
            
				<?php
                                      
                	while($reg = mysql_fetch_array($registros)){
                        $est = $estoque->ultimoEstoque($reg["id"], "produto_id");    
                        $cat = $categoria->loadObject($reg["categoria_id"], "id");                 
				?>
            
            	<tr>
                    <td><?php echo $reg["id"]; ?></td>
                    <td><?php echo $reg["descricao"]; ?></td>
					<td style="text-align:center"><?php echo $reg["codigo_barras"]; ?></td>
                    <td style="text-align:center">R$ <?php echo $reg["valor_venda"]; ?></td>                    
                    <td style="text-align:center"><?php echo $cat->getDescricao(); ?></td>
                    <td style="text-align:center"><?php echo $est->getQuantidade(); ?></td>
                                      
                    <td style="text-align:center"><a class="btn btn-small" type="button" href="edita.php?id=<?php echo $reg["id"]; ?>"><i class="icon-edit"></i></a></td>
                    <td style="text-align:center"><a class="btn btn-small" type="button" onClick="return confirm('Deseja excluir mesmo o Produto?')" href="lista.php?id=<?php echo $reg["id"]; ?>"><i class="icon-remove"></i></a></td>
                </tr>
            
            	<?php
				}
				?>
            
            </tbody>
		</table>
        
      	<?php
		}else{
		?>
        	<div class="text-center">
                <h2>Ops.. =(</h2>
                <p>Sua pesquisa não retornou nenhum resultado válido.</p>
            </div>
        
        <?php
		}} else {
            echo "Nenhum Produto cadastrado";
        }  
		?>

      <hr>

        <div class="control-group">
            <div class="controls">
              <a href="edita.php" class="btn btn-success btn-large">Cadastrar um novo Produto</a>
            </div>
        </div>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>

    </div> <!-- /container -->

    	<!-- Javascript -->
		<script src="../../js/jquery.js"></script>
        <script src="../../js/jquery.validate.min.js"></script>
        <script src="../../js/bootstrap-transition.js"></script>
        <script src="../../js/bootstrap-alert.js"></script>
        <script src="../../js/bootstrap-modal.js"></script>
        <script src="../../js/bootstrap-dropdown.js"></script>
        <script src="../../js/bootstrap-scrollspy.js"></script>
        <script src="../../js/bootstrap-tab.js"></script>
        <script src="../../js/bootstrap-tooltip.js"></script>
        <script src="../../js/bootstrap-popover.js"></script>
        <script src="../../js/bootstrap-button.js"></script>
        <script src="../../js/bootstrap-collapse.js"></script>
        <script src="../../js/bootstrap-carousel.js"></script>
        <script src="../../js/bootstrap-typeahead.js"></script>
    
	</body>


</html>