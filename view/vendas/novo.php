<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

/*
 * 	Descrição do Arquivo
 * 	@author - Luis Henrique Rodrigues
 * 	@data de criação - 28/04/2014
 * 	@arquivo  - novo.php
 */

require_once ("../../controller/usuario.controller.class.php");
require_once ("../../model/usuario.class.php");

include_once ("../../functions/functions.class.php");

session_start();

$usuario_controller = new UsuarioController();
$usuario = new usuario();
$functions = new Functions;

if (isset($_POST['submit'])) {

	header('Location: home.php');

}
?>

<!DOCTYPE html>
<html>
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

				<h2>Venda</h2>
				<small>Utilize o formulário abaixo efetuar uma venda</small>
			</blockquote>

			<!-- Mensagem de Retorno -->
			<?php
			if(!empty($_GET["tipo"])){
			?>
			
			<?php
			}
			?>
			<form autocomplete="off" class="form-horizontal" id="contact-form" action="" method="post" enctype="multipart/form-data">

				<div class="control-group">
					<label class="control-label" for="cliente">Cliente</label>
					<div class="controls">
						<input class="input-mini" type="text" name="cliente_id"  id="cliente_id" required value="" disabled="disabled">
						<input class="input-xlarge" type="text" name="cliente_nome"  id="cliente_nome" required value="" disabled="disabled">
						<a href="#myModal" role="button" class="btn" data-toggle="modal"> Pesquisar</a>
					</div>
				</div>

				<div class="control-group">
					<div class="controls" style="background: #FFF;">
						<table class="table table-striped" id="pedido" name="pedido" style="background-color: #EEE">
							<tr>
								<td width="150px">Código</td>
								<td width="300px">Produto</td>
								<td width="30px">Quantidade</td>
								<td width="90px" style="text-align:center">Valor Unit.</td>
								<td width="150px" style="text-align:center">Valor Total</td>
								<td style="text-align:center"><i class="icon-remove"></i> </td>
							</tr>

							<tr>

								<td>
								<input class="input-block-level" type="text" name="produto_id1" onkeypress="procurarProduto(this.id, this.value, event);" id="produto_id1" value="">
								</td>
								<td>
								<input class="input-block-level" type="text" name="produto_descricao1"  id="produto_descricao1" disabled="disabled">
								</td>
								<td>
								<select class="input-block-level" id="produto_quantidade1" name="produto_quantidade1" onchange="atualizarTotal(this.value, this.id);">
									<option value="1" selected="selected" >1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>									
								</select>
								</td>
								<td><div class="input-prepend"> <span class="add-on">R$</span><input class="input-mini" type="text" name="produto_valor1"  id="produto_valor1" disabled="disabled"></td></div>
								<td><div class="input-prepend"> <span class="add-on">R$</span><input class="input-medium" type="text" name="produto_valortotal1"  id="produto_valortotal1" disabled="disabled"></td></div>
								<td style="text-align:center"><a class="btn btn-medium btn-danger" onclick="removerLinha(this);"><i class="icon-remove"> </i></a></td>
							</tr>							
						</table>
					
						<input type="button" class="btn btn btn" id="botaoadd" value="Adicionar Produto (F2)" style="margin: 10px">
					
						
						<table width="100%" style="background-color:#EEE;">
							
							<tr><td style="padding-left: 10px; width: 20%" align="right">Observação: </td>  <td><input type="text" class="input-block-level" id="obs" name="obs"/></td>
								<td align="right"><div class="input-prepend alert-info" style="padding: 5px"> <span class="add-on" style="padding: 10px; width: 100px">Desconto R$</span><input class="input-medium" type="text" onkeyup="calculaTotal();" name="desconto" value="0" id="desconto" style="padding: 10px"></td>
								</tr>
							<tr>
									<td style="padding-left: 10px" align="right">Forma de Pagamento:</td>  <td><select id="forma_pagamento" name="forma_pagamento" class="input-block-level">
									<option value="avista">à vista</option>
									<option value="cartao">Cartão de Crédito</option>
									<option value="aprazo">à prazo</option>
								</select></td>		
																																						
								<td align="right"><div class="input-prepend alert-danger" style="padding: 5px;"> <span class="add-on" style="padding: 10px; width: 100px">TOTAL R$</span><input class="input-medium" type="text" name="somartudo"  value="0" id="somartudo" style="font-size: 20px; padding: 10px; disabled='disabled'"></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="!display: none" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							×
						</button>
						<h3 id="myModalLabel">Pesquisar Cliente</h3>
					</div>
					<div class="modal-body">
						<input class="input-xlarge" type="text" name="busca" placeholder="Digite o nome do Cliente" id="busca"/>
						<a class="btn btn-medium" onclick="buscaCliente();" type="button"><i class="icon-search"></i></a>
						<p id="lista_cliente">

						</p>
					</div>

				</div>
				<div class="control-group">
					<div class="controls">
						<input type="button" class="btn btn-success btn-large" value="Salvar" name="submit">
						<a href="lista.php">
						<input type="button" class="btn btn btn-large" value="Cancelar">
						</a>
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
		<script src="../../js/carrega_clientes.js"></script>
		<script src="../../js/jquery-ui.js"></script>
		<link rel="Stylesheet" href="../../css/jquery-ui.css" />

		<script type="text/javascript" charset="utf-8">
			var linha = 1;
			var total = 0;
		
			$(document).ready(function() {
				$('input').keypress(function(e) {
					var code = null;
					code = (e.keyCode ? e.keyCode : e.which);
					return (code == 13) ? false : true;
				});
			});


			$(document).ready(function() {
				$('body').keypress(function(e) {					
					if (e.keyCode === 113){
						addlinha();
					};
				});
			});
			
			function calculaTotal() {
				total = 0;			
				$("input[id^='produto_valortotal']").each(function(index, value){					
					var valor = Number($(this).val());
      				if (!isNaN(valor)) total += valor;		
      		   });
      		   total -= Number($('#desconto').val().replace(",","."));
      		   $('#somartudo').val(total.toFixed(2));
			 }
			
			
			function BuscarProduto(id, campo) {
				idcampo = apenasNumeros(campo);
				$.ajax({
					url : "busca_produtos.php?id=" + id,
					cache : false,
					type : "GET",
					dataType : "json",
					beforeSend : function() {
						$("#produto_descricao" + idcampo).val("Aguarde");
					},
					success : function(data) {
						if (data.id === undefined){
							alert('Código inválido');
							$("#produto_id" + idcampo).val(data.id);
							$("#produto_descricao" + idcampo).val(data.descricao);
							$("#produto_valor"+ idcampo).val(data.valor_venda);
							$("#produto_valortotal"+ idcampo).val(data.valor_venda);	
							$("#produto_quantidade"+ idcampo).val(1);	
							calculaTotal();							
						} else {
							$("#produto_descricao" + idcampo).val(data.descricao);
							$("#produto_valor"+ idcampo).val(data.valor_venda);
							$("#produto_valortotal"+ idcampo).val(data.valor_venda);
							$("#produto_quantidade"+ idcampo).val(1);
							calculaTotal();
							addlinha();
							$("#produto_id" + idcampo).attr('disabled', 'true');							
						}
					},
					error : function() {
						$("#produto_descricao" + idcampo).val("Erro ao enviar");
					},
				})
			}
			
			
			function removerLinha(obj){				
                var objTR = obj.parentNode.parentNode;
                var objTable = objTR.parentNode;
                var indexTR = objTR.rowIndex;
                if (confirm("Tem certeza que deseja remover esse produto?")){
                	objTable.deleteRow(indexTR);	
                }     
                calculaTotal();       
			}		
			
			
			function atualizarTotal(unidade, id){
				idnum = apenasNumeros(id);				
				var valor = ($('#produto_valor'+ idnum).val());
				var total = valor * unidade;						
				$('#produto_valortotal' + idnum).val(total.toFixed(2));
				calculaTotal();
			}		


			$(document).ready(function() {
			$('#botaoadd').on('click', addlinha); 
			});
			
			
			function addlinha(){										
				linha++;
				var texto = "<tr><td><input class=\"input-block-level\" type=\"text\" name=\"produto_id" 
				+ linha	+ "\"id=\"produto_id" 
				+ linha + "\"  onkeypress=\"procurarProduto(this.id, this.value, event);\" value=\"\"></td><td><input class=\"input-block-level\" type=\"text\" name=\"produto_descricao" 
				+ linha + "\" id=\"produto_descricao" 
				+ linha + "\"disabled=\"disabled\"></td><td><select class=\"input-block-level\" id=\"produto_quantidade"
				+ linha + "\" name=\"produto_quantidade" + linha + "\" onchange=\"atualizarTotal(this.value, this.id);\"><option value=\"1\" selected=\"selected\">1</option><option value=\"2\">2</option><option value=\"3\">3</option><option value=\"4\">4</option><option value=\"5\">5</option><option value=\"6\">6</option><option value=\"7\">7</option><option value=\"8\">8</option><option value=\"9\">9</option><option value=\"10\">10</option></select></td><td><div class=\"input-prepend\"> <span class=\"add-on\">R$</span><input class=\"input-mini\" type=\"text\" name=\"produto_valor" 
				+ linha + "\" id=\"produto_valor" 
				+ linha + "\" disabled=\"disabled\"></td></div><td><div class=\"input-prepend\"><span class=\"add-on\">R$</span><input class=\"input-medium\" type=\"text\" name=\"produto_valortotal"
				+ linha + "\"  id=\"produto_valortotal"
				+ linha + "\" disabled=\"disabled\"></td></div><td style=\"text-align:center\"><a class=\"btn btn-medium btn-danger\" onclick=\"removerLinha(this);\"><i class=\"icon-remove\"></i></a></td></tr>";
				$("#pedido").append(texto);						
			};
			

			function procurarProduto(campo, valor, event){				
				if (event.keyCode === 13) {					
					BuscarProduto(valor, campo);
				}
			};

			function apenasNumeros(string) {
				var numsStr = string.replace(/[^0-9]/g, '');
				return parseInt(numsStr);
			}

		</script>

		<script>
			$('#myModal').modal({
				show : false
			});
		</script>
	</body>
</html>
