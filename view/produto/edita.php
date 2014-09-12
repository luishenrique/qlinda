<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 18/04/2014
 * 	@arquivo  - edita.php
 */
require ("../../view/usuario/verifica.php");


require_once ("../../controller/produto.controller.class.php");
require_once ("../../model/produto.class.php");

require_once ("../../controller/categoria.controller.class.php");

require_once ("../../controller/estoque.controller.class.php");
require_once ("../../model/estoque.class.php");

include_once ("../../functions/functions.class.php");

$controllerCategoria = new CategoriaController;

$controller = new ProdutoController();
$produto = new produto();
$functions = new Functions;
$estoque = new estoque;
$controllerEstoque = new EstoqueController;

if (isset($_POST['submit'])) {

	$produto -> setId($_POST['id']);
	$produto -> setCodigoBarras($_POST['codigo_barras']);
	$produto -> setDescricao($_POST['descricao']);
	$produto -> setValorCusto(str_replace(",",".",$_POST['valor_custo']));
	$produto -> setValorVenda(str_replace(",",".",$_POST['valor_venda']));
	$produto -> setMargemLucro($_POST['margem_lucro']);
	$produto -> setCategoriaId($_POST['categoria_id']);	

	if ($produto -> getId() > 0) {
		$controller -> update($produto, 'id');
	} else {
		$controller -> save($produto, 'id');
		$result = $controller->ultimoId();	
		$id = mysql_fetch_array($result);
		$produto->setId($id[0]);
	}
	
	$dataHoje = date("y-m-d H:i:s");
	$estoque->setData($dataHoje);
	$estoque->setQuantidade($_POST['quantidade']);
	$estoque->setProdutoId($produto->getId());
	$estoque->setPedido("0");
	
	$controllerEstoque->save($estoque, 'id');
	
	header('Location: lista.php');

}

if (isset($_GET["id"])) {
	$produto = $controller -> loadObject($_GET["id"], "id");
	$estoque = $controllerEstoque -> ultimoEstoque($_GET["id"], "produto_id");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title>Q'Linda! </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Estilos -->
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<link href="../../css/geral.css" rel="stylesheet">
		<link href="../../css/validation.css" rel="stylesheet">
		<link href="../../css/bootstrap-responsive.css" rel="stylesheet">

		<!--
		<link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="../../css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../../css/book.css" />
		-->

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

				<h2>Gerenciamento de Produtos</h2>
				<small>Utilize o formulário abaixo para cadastrar/atualizar um Produto</small>
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
			<form class="form-horizontal" id="contact-form" action="edita.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" id="id" value="<?php echo ($produto->getId() > 0 ) ? $produto->getId() : ''; ?>">

				<div class="control-group">
					<label class="control-label" for="codigo_barras">Código de Barras</label>
					<div class="controls">
						<input class="input-xlarge" type="text" name="codigo_barras" id="codigo_barras" required value="<?php echo ($produto->getId() > 0 ) ? $produto->getCodigoBarras() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="descricao">Descrição</label>
					<div class="controls">
						<input class="input-xxlarge" type="text" name="descricao" id="descricao" required value="<?php echo ($produto->getId() > 0 ) ? $produto->getDescricao() : ''; ?>">					
					</div>
				</div>
				

				<div class="control-group">
					<label class="control-label" for="categoria_id">Categoria</label>
					<div class="controls">
						<select id="categoria_id" name="categoria_id" class="input-large">
							<option value="">Selecione</option>	
							<?php
							$registros = $controllerCategoria -> listObjects();	
								while($reg = mysql_fetch_array($registros)){
									if ($reg["id"] == $produto->getCategoriaId()){?>
																		
							<option value="<?php echo $reg["id"]; ?>" selected="selected"><?php echo $reg["descricao"]; ?></option>				
							<?php										
									} else {
							?>
							<option value="<?php echo $reg["id"]; ?>"><?php echo $reg["descricao"]; ?></option>
							<?php
							}}
							?>
						</select>
					</div>
				</div>				
				
				<div class="control-group">
					<label class="control-label" for="valor_custo">Valor Custo R$</label>
					<div class="controls">
						<input class="input-medium" type="text" name="valor_custo" id="valor_custo"  onkeyup="CalculaMargemLucro();"  required value="<?php echo ($produto->getId() > 0 ) ? $produto->getValorCusto() : ''; ?>">					
					</div>
				</div>		
				
				<div class="control-group">
					<label class="control-label" for="valor_venda">Valor Venda R$</label>
					<div class="controls">
						<input class="input-medium" type="text" name="valor_venda" onkeyup="CalculaMargemLucro();" id="valor_venda" required value="<?php echo ($produto->getId() > 0 ) ? $produto->getValorVenda() : ''; ?>">					
					</div>
				</div>		
				
				<div class="control-group">
					<label class="control-label" for="margem_lucro">Margem de Lucro (%)</label>
					<div class="controls">
						<input class="input-medium" type="text" name="margem_lucro" disabled="disabled" id="margem_lucro" required value="<?php echo ($produto->getId() > 0 ) ? $produto->getMargemLucro() : ''; ?>">					
					</div>
				</div>	
				
				<div class="control-group">
					<label class="control-label" for="quantidade">Quantidade</label>
					<div class="controls">
						<input class="input-small" type="text" name="quantidade" id="quantidade" required value="<?php echo ($produto->getId() > 0 ) ? $estoque->getQuantidade() : ''; ?>">					
					</div>
				</div>	
				
				<div class="control-group">
					<div class="controls">
						<input type="submit" class="btn btn-success btn-large" value="Salvar" name="submit">
						<a href="lista.php"><input type="button" class="btn btn btn-large" value="Cancelar"></a>
					</div>
				</div>

			</form>
			<hr>
			<footer>
				<p>
					&copy; Company 2014
				</p>
			</footer>
		</div>
		<!-- /container -->

		<!-- Javascript -->
		<script src="../../js/geral.js"></script>
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
		<script src="../../js/jquery.maskedinput.js"/></script>

		<script type="text/javascript">
			function CalculaMargemLucro() {
				valor_venda = document.getElementById("valor_venda").value.replace(",",".");
				valor_custo = document.getElementById("valor_custo").value.replace(",",".");
				
				if (!valor_venda == "" && !isNaN(valor_venda) && !valor_custo == "" && !isNaN(valor_custo)){				
					margem = ((parseFloat(valor_venda)*100) / parseFloat(valor_custo)-100);
					document.getElementById("margem_lucro").value = Math.round(margem);
				}
			
			}
		</script>



		<script>
				$(document).ready(function() {

				$('#contact-form').validate({
					rules : {						
						categoria_id : {
							required : true
						}					
						
					},
					highlight : function(element) {
						$(element).closest('.control-group').removeClass('success').addClass('error');
					},
					success : function(element) {
						element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
					}
				});
			});
		</script>

	</body>
</html>