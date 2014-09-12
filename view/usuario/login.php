<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

if (isset($_POST["login"]) || isset($_POST["senha"])) {

	require_once ("../../controller/usuario.controller.class.php");

	$usuarioController = new UsuarioController;

	$result = $usuarioController -> autentica($_POST['login'], $_POST['senha']);
	$quantidadeDeDados = mysql_num_rows($result);

	if ($quantidadeDeDados == '1') {

		$usuario = mysql_fetch_array($result);

		//Declara as variáveis de sessão que serão utilizadas no sistema
		session_start();
		$_SESSION["usuario_id"] = $usuario["id"];
		$_SESSION["usuario_login"] = $usuario["login"];

		//Sucesso, redireciona para a tela principal
		header("Location: home.php");
		//arrumar location
	} else {
		//Erro, redireciona para a tela de login novamente
		header("Location: login.php?erro=1");
	}

}
?>

<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<title>Q'Linda! - Moda Feminina</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Estilos -->
		<link href="../../css/bootstrap.css" rel="stylesheet">
		<link href="../../css/login.css" rel="stylesheet">
		<link href="../../css/validation.css" rel="stylesheet">
		<link href="../../css/bootstrap-responsive.css" rel="stylesheet">

	</head>

	<body>

		<div class="container">

			<form class="form-signin" id="login-form" action="login.php" method="POST">
				<fieldset>

					<div class="control-group">
						<div class="controls">
							<img src="../../img/logo_qlinda.png" alt="" style="width:280px;">
							<p>
								&nbsp;
							</p>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="text" class="input-block-level" name="login" id="login" placeholder="Login" style="width:85%;">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="password" class="input-block-level" name="senha" id="senha" placeholder="Senha" style="width:85%;">
						</div>
					</div>
					<?php if (isset($_GET["erro"]) == 1){ ?>
					<div class="alert alert-error">
						Usuário ou senha inválido.
					</div>
					<?php } ?>
					<div>

						<button type="submit" class="btn btn-success btn-large">Entrar</button>
					</div>
				</fieldset>
			</form>

		</div>

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

		<script>
			$(document).ready(function() {

				$('#login-form').validate({
					rules : {
						login : {
							minlength : 2,
							required : true,
							email : false
						},
						senha : {
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
