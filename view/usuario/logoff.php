<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 30/10/2013
 * 	@arquivo  - logoff.php
 */

include_once("../../functions/functions.class.php");
$functions	= new Functions;
session_start();

if($_GET["confirma"]=="SIM"){

	require_once("../../controller/usuario.controller.class.php");
	$login 	= new UsuarioController;

	$login->logoff();
	
}

?>
<!DOCTYPE html>
<html>
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
                $functions->geraMenu();
            ?>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>


    <div class="container">

		<!-- Título -->
        <blockquote>
          <h2>Logoff</h2>
          <small>Escolha a opção desejada clicando nos botões abaixo</small>
        </blockquote>
        
		<hr>
        
		<div class="text-center">
			<h2>Efetuar Logoff</h2>
			<p>Deseja confirmar sua saída do sistema Q'Linda!?</p>
		</div>
        
        <p>&nbsp;</p>
        
        <div class="control-group">
            <div class="controls" style="text-align:center">
              <a href="logoff.php?confirma=SIM" class="btn btn-success btn-large">Sim, desejo sair do sistema</a>&nbsp;&nbsp;
              <a href="../historia/home.php" class="btn btn btn-large">Não desejo sair do sistema</a>
            </div>
		</div>

		<hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div> 
    <!-- /container -->

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
        $(document).ready(function(){
         
         $('#contact-form').validate(
         {
          rules: {
            login: {
              minlength: 2,
              required: true
            },
            senha: {
              required: true,
              email: true
            }
          },
          highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
          },
          success: function(element) {
            element
            .text('OK!').addClass('valid')
            .closest('.control-group').removeClass('error').addClass('success');
          }
         });
        });
        </script>


	</body>
</html>