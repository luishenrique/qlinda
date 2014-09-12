<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 12/04/2014
 * 	@arquivo  - edita.php
 */

require_once ("../../controller/cliente.controller.class.php");
require_once ("../../model/cliente.class.php");
require ("../../view/usuario/verifica.php");

include_once ("../../functions/functions.class.php");

$controller = new ClienteController();
$cliente = new cliente();
$functions = new Functions;

if (isset($_POST['submit'])) {

	$cliente -> setId($_POST['id']);
	$cliente -> setNome($_POST['nome']);
	$cliente -> setDataNascimento($_POST['data_nascimento']);
	$cliente -> setEndereco($_POST['endereco']);
	$cliente -> setBairro($_POST['bairro']);
	$cliente -> setCidade($_POST['cidade']);
	$cliente -> setUf($_POST['uf']);
	$cliente -> setCep($_POST['cep']);
	$cliente -> setCpf($_POST['cpf']);
	$cliente -> setRg($_POST['rg']);
	$cliente -> setDataNascimento($functions->converterData($_POST['data_nascimento']));
	$cliente -> setTelefone($_POST['telefone']);
	$cliente -> setCelular($_POST['celular']);
	$cliente -> setEmail($_POST['email']);
	$cliente -> setObs($_POST['obs']);

	if ($cliente -> getId() > 0) {
		$controller -> update($cliente, 'id');
	} else {
		$dataHoje = date("y-m-d");
		$cliente->setDataCadastro($dataHoje);
		$controller -> save($cliente, 'id');
	}

	header('Location: lista.php');

}

if (isset($_GET["id"])) {
	$cliente = $controller -> loadObject($_GET["id"], "id");
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

				<h2>Gerenciamento de Cliente</h2>
				<small>Utilize o formulário abaixo para atualizar a conta do Cliente</small>
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
				<input type="hidden" name="id" id="id" value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getId() : ''; ?>">

				<div class="control-group">
					<label class="control-label" for="nome">Nome</label>
					<div class="controls">
						<input class="input-xlarge" type="text" name="nome" id="nome" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getNome() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="data_nascimento">Data Nascimento</label>
					<div class="controls">
						<input class="input-large" type="text" name="data_nascimento" id="data_nascimento" required value="<?php echo ($cliente->getId() > 0 ) ? $functions->converterDataPadrao($cliente->getDataNascimento()) : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="endereco">Endereço</label>
					<div class="controls">
						<input class="input-xxlarge" type="text" name="endereco" id="endereco" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getEndereco() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="bairro">Bairro</label>
					<div class="controls">
						<input class="input-xlarge" type="text" name="bairro" id="bairro" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getBairro() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="cidade">Cidade</label>
					<div class="controls">
						<input class="input-xlarge" type="text" name="cidade" id="cidade" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getCidade() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="uf">UF</label>
					<div class="controls">
						<select id="uf" name="uf" class="input-medium">
							<option value="">Selecione</option>							
							<option value="AC" <?php echo $controller -> selected('AC', $cliente -> getUf()); ?>>AC</option>
							<option value="AL" <?php echo $controller -> selected('AL', $cliente -> getUf()); ?>>AL</option>
							<option value="AM" <?php echo $controller -> selected('AM', $cliente -> getUf()); ?>>AM</option>
							<option value="AP" <?php echo $controller -> selected('AP', $cliente -> getUf()); ?>>AP</option>
							<option value="BA" <?php echo $controller -> selected('BA', $cliente -> getUf()); ?>>BA</option>
							<option value="CE" <?php echo $controller -> selected('CE', $cliente -> getUf()); ?>>CE</option>
							<option value="DF" <?php echo $controller -> selected('DF', $cliente -> getUf()); ?>>DF</option>
							<option value="ES" <?php echo $controller -> selected('ES', $cliente -> getUf()); ?>>ES</option>
							<option value="GO" <?php echo $controller -> selected('GO', $cliente -> getUf()); ?>>GO</option>
							<option value="MA" <?php echo $controller -> selected('MA', $cliente -> getUf()); ?>>MA</option>
							<option value="MG" <?php echo $controller -> selected('MG', $cliente -> getUf()); ?>>MG</option>
							<option value="MS" <?php echo $controller -> selected('MS', $cliente -> getUf()); ?>>MS</option>
							<option value="MT" <?php echo $controller -> selected('MT', $cliente -> getUf()); ?>>MT</option>
							<option value="PA" <?php echo $controller -> selected('PA', $cliente -> getUf()); ?>>PA</option>
							<option value="PB" <?php echo $controller -> selected('PB', $cliente -> getUf()); ?>>PB</option>
							<option value="PE" <?php echo $controller -> selected('PE', $cliente -> getUf()); ?>>PE</option>
							<option value="PI" <?php echo $controller -> selected('PI', $cliente -> getUf()); ?>>PI</option>
							<option value="PR" <?php echo $controller -> selected('PI', $cliente -> getUf()); ?>>PR</option>
							<option value="RJ" <?php echo $controller -> selected('RJ', $cliente -> getUf()); ?>>RJ</option>
							<option value="RN" <?php echo $controller -> selected('RN', $cliente -> getUf()); ?>>RN</option>
							<option value="RO" <?php echo $controller -> selected('RO', $cliente -> getUf()); ?>>RO</option>
							<option value="RR" <?php echo $controller -> selected('RR', $cliente -> getUf()); ?>>RR</option>
							<option value="RS" <?php echo $controller -> selected('RS', $cliente -> getUf()); ?>>RS</option>
							<option value="SC" <?php echo $controller -> selected('SC', $cliente -> getUf()); ?>>SC</option>
							<option value="SE" <?php echo $controller -> selected('SE', $cliente -> getUf()); ?>>SE</option>
							<option value="SP" <?php echo $controller -> selected('SP', $cliente -> getUf()); ?>>SP</option>
							<option value="TO" <?php echo $controller -> selected('TO', $cliente -> getUf()); ?>>TO</option>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="cep">CEP</label>
					<div class="controls">
						<input class="input-large" type="text" name="cep" id="cep" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getCep() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="cpf">CPF</label>
					<div class="controls">
						<input class="input-large" type="text" name="cpf" id="cpf" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getCpf() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="rg">RG</label>
					<div class="controls">
						<input class="input-large" type="text" name="rg" id="rg" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getRg() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="telefone">Telefone Fixo</label>
					<div class="controls">
						<input class="input-large" type="text" name="telefone" id="telefone" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getTelefone() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="celular">Celular</label>
					<div class="controls">
						<input class="input-large" type="text" name="celular" id="celular" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getCelular() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="email">E-mail</label>
					<div class="controls">
						<input class="input-large" type="email" name="email" id="email" required value="<?php echo ($cliente->getId() > 0 ) ? $cliente->getEmail() : ''; ?>">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="obs">Observações</label>
					<div class="controls">
						<textarea name="obs" rows="7" cols="10" class="field span6"><?php echo ($cliente->getId() > 0 ) ? $cliente->getObs() : ''; ?></textarea> 
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
						uf : {
							required : true
						},
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