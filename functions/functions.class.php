<?php

class Functions {

	public function converterData($strData) {
		// Converte a data de dd/mm/aaaa para o formato: aaaa-mm-dd
		$strDataFinal = implode('-', array_reverse(explode('/', $strData)));
		return $strDataFinal;
	}

	public function converterDataPadrao($strData) {
		// Converte a data de aaaa-mm-dd para o formato: dd/mm/aaaa
		$strDataFinal = implode('/', array_reverse(explode('-', $strData)));
		return $strDataFinal;
	}

	public function converterDataHoraPadrao($strData) {
		// Converte datetime do banco para 00/00/0000 - 00:00:00
		$strDataFinal = explode(" ", $strData);
		return implode("/", array_reverse(explode("-", $strDataFinal[0]))) . " - " . $strDataFinal[1];

	}

	public function geraMenu($tipoDeUsuario = 0) {

		$contextoDeMenu = "http://localhost/qlinda";

		if ($tipoDeUsuario == 1) {

			$menu = "
			
					<ul class=\"nav\" style=\"bottom:15px;\">
					  <li><a href=\"" . $contextoDeMenu . "/view/historia/home.php\">Home</a></li>
					  <li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">RangoMap<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
						  <li><a href=\"" . $contextoDeMenu . "/view/login/edita.php\"><i class=\"icon-user\"></i> Gerenciar Conta</a></li>
						  <li><a href=\"" . $contextoDeMenu . "/view/login/logoff.php?confirma=NAO\"><i class=\"icon-share\"></i> Efetuar Logoff</a></li>
						</ul>
					  </li>
					  <li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Usuários<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
						  <li><a href=\"" . $contextoDeMenu . "/view/grupodeusuario/lista.php\">Gerenciar Grupos de Usuários</a></li>
						  <li><a href=\"" . $contextoDeMenu . "/view/usuario/lista.php\">Gerenciar Usuários</a></li>
						  <li><a href=\"" . $contextoDeMenu . "/view/logdeacesso/lista.php\">Gerenciar Log de Acesso</a></li>
						  <li><a href=\"" . $contextoDeMenu . "/view/tipodeusuario/lista.php\">Gerenciar Tipos de Usuários</a></li>
						</ul>
					  </li>
					  <li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Sistema<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
						  <li><a href=\"" . $contextoDeMenu . "/view/categoria/lista.php\">Gerenciar Categorias</a></li>
						  <li><a href=\"" . $contextoDeMenu . "/view/tangram/lista.php\">Gerenciar Tangram</a></li>
						  <li><a href=\"" . $contextoDeMenu . "/view/background/lista.php\">Gerenciar Backgrounds</a></li>
						</ul>
					  </li>
					  <li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Histórias<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
						  <li><a href=\"" . $contextoDeMenu . "/view/historia/lista.php\">Gerenciar Histórias</a></li>
						</ul>
					  </li>
					  <li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Pesquisas<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
						  <li><a href=\"" . $contextoDeMenu . "/view/pesquisadesatisfacao/lista.php\">Gerenciar Pesquisa de Satisfação</a></li>
						</ul>
					  </li>
					  <li><a href=\"" . $contextoDeMenu . "/sobre.php\">Sobre</a></li>
					</ul>
			
					";

		} else {
			$menu = "
				
				
						
						
						<ul class=\"nav\" style=\"bottom:15px;\">
						
						  
						  <li><a href=\"" . $contextoDeMenu . "/view/usuario/home.php\">Home</a></li>
						  
						  <li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Vendas<b class=\"caret\"></b></a>
							<ul class=\"dropdown-menu\">
							  <li><a href=\"" . $contextoDeMenu . "/view/vendas/novo.php\"><i class=\"icon-user\"></i> Nova Venda</a></li>
							  
							</ul>
						  </li>
						  
						  <li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Usuário<b class=\"caret\"></b></a>
							<ul class=\"dropdown-menu\">
							  <li><a href=\"" . $contextoDeMenu . "/view/usuario/edita.php\"><i class=\"icon-user\"></i> Gerenciar Conta</a></li>
							  <li><a href=\"" . $contextoDeMenu . "/view/usuario/logoff.php?confirma=NAO\"><i class=\"icon-share\"></i> Sair</a></li>
							</ul>
						  </li>
						  
						   <li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Clientes<b class=\"caret\"></b></a>
							<ul class=\"dropdown-menu\">
							  <li><a href=\"" . $contextoDeMenu . "/view/cliente/lista.php\"><i class=\"icon-user\"></i> Lista de Clientes</a></li>
							  <li><a href=\"" . $contextoDeMenu . "/view/cliente/edita.php\"><i class=\"icon-share\"></i> Cadastrar Novo</a></li>
							</ul>
						  </li>
						  
						

						    <li class=\"dropdown\">
							<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Produtos<b class=\"caret\"></b></a>
							<ul class=\"dropdown-menu\">
							 <li><a href=\"" . $contextoDeMenu . "/view/categoria/lista.php\"><i class=\"icon-user\"></i> Lista de Categorias</a></li>
							  <li><a href=\"" . $contextoDeMenu . "/view/categoria/edita.php\"><i class=\"icon-share\"></i> Cadastrar Categoria</a></li>
							  <li><a href=\"" . $contextoDeMenu . "/view/produto/lista.php\"><i class=\"icon-user\"></i> Lista de Produtos</a></li>
							  <li><a href=\"" . $contextoDeMenu . "/view/produto/edita.php\"><i class=\"icon-share\"></i> Cadastrar Novo</a></li>							  
							</ul>
						  </li>
						  
						  
						   <li><a href=\"" . $contextoDeMenu . "/view/usuario/sobre.php\">Sobre</a></li>
						</ul>				
						";

		}

		echo $menu;

	}

	public function statusDaHistoria($status) {

		switch($status) {

			case "E" :
				$tipo = "Editando";
				break;

			case "I" :
				$tipo = "Inativa";
				break;

			case "P" :
				$tipo = "Publicada";
				break;
		}

		return $tipo;

	}

	public function mensagemDeRetorno($tipo, $acao) {

		//Definir o tipo de erro, o ícone e a classe de estilo utilizada para a tela de alerta
		switch($tipo) {
			case 1 :
				$msgA = "SUCESSO";
				$icnA = "icone_sucesso.png";
				$classe = "alert-success";
				break;

			case 2 :
				$msgA = "ERRO";
				$icnA = "icone-erro.png";
				$classe = "alert-error";
				break;

			case 3 :
				$msgA = "FALHA";
				$icnA = "icone-aviso.png";
				$classe = "alert-block";
				break;

			case 4 :
				$msgA = "AVISO";
				$icnA = "icone-aviso.png";
				$classe = "alert-info";
				break;
		}

		switch($acao) {
			case 1 :
				$msgB = "cadastro";
				break;

			case 2 :
				$msgB = "alteração";
				break;

			case 3 :
				$msgB = "exclusão";
				break;

			case 4 :
				$msgB = "logon";
				break;

			case 5 :
				$msgB = "autenticação";
				break;

			case 6 :
				$msgB = "pesquisa";
				break;

			case 7 :
				$msgB = "upload de arquivo";
				break;
		}

		$mensagem = "
					<p>&nbsp;</p>
					<div class=\"alert alert-block " . $classe . " fade in\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<h4 class=\"alert-heading\">" . $msgA . "</h4>
						<p>Ao realizar a operação de " . $msgB . ".</p>
					</div>
					<p>&nbsp;</p>
					";

		echo $mensagem;
	}

}
?>