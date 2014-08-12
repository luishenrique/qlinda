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

require_once ("../../controller/categoria.controller.class.php");
require_once ("../../model/categoria.class.php");

include_once ("../../functions/functions.class.php");

$controller = new CategoriaController();
$categoria = new categoria();
$functions = new Functions;

if (isset($_POST['submit'])) {

	$categoria -> setId($_POST['id']);
	$categoria -> setDescricao($_POST['descricao']);
	
	if ($categoria -> getId() > 0) {
		$controller -> update($categoria, 'id');
	} else {		
		$controller -> save($categoria, 'id');
	}

	header('Location: lista.php');

}

if (isset($_GET["id"])) {
	$categoria = $controller -> loadObject($_GET["id"], "id");
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

				<h2>Gerenciamento de Categorias</h2>
				<small>Utilize o formulário abaixo para atualizar/criar uma Categoria</small>
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
				<input type="hidden" name="id" id="id" value="<?php echo ($categoria->getId() > 0 ) ? $categoria->getId() : ''; ?>">

				<div class="control-group">
					<label class="control-label" for="descricao">Descrição</label>
					<div class="controls">
						<input class="input-xlarge" type="text" name="descricao" id="descricao" required value="<?php echo ($categoria->getId() > 0 ) ? $categoria->getDescricao() : ''; ?>">
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
			$(document).ready(function() {
				$('#cpf').mask("999.999.999-99");
				$('#cep').mask("99.999-999");
				$('#telefone').mask("(99) 9999-9999");
				$('#celular').mask("(99) 99999-9999");
				$('#data_nascimento').mask("99/99/9999");

			});
		</script>

		<script>
			$(document).ready(function() {

				$('#contact-form').validate({
					rules : {
						nome : {
							required : true
						},
						endereco : {
							required : true,
						},						
						email : {
							required : false,
						},
						obs : {
							required : false,
						},
						cpf : {
							required : true,
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