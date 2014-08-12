/**
 * @author Luis Henrique
 */

try {
	xmlhttp = new XMLHttpRequest();
} catch (ee) {
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
}

function buscaCliente() {
	document.getElementById('lista_cliente').innerHTML = "Aguarde, pesquisando...!!!";
	busca = document.getElementById('busca').value;
	
	xmlhttp.open("POST", "busca.php?busca=" + escape(busca), true);
	xmlhttp.setRequestHeader('Content-Type', 'text/html');
	xmlhttp.setRequestHeader('encoding', 'utf-8');
	xmlhttp.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader('Content-length', busca.lenght);
	xmlhttp.send(busca);
	xmlhttp.onreadystatechange = function() {

		/*
		 * Verifica o estado do sistema 0: Requisição não inicializada 1:
		 * Conexão estabelecida com o servidor 2: Requisição recebida 3:
		 * Processando requisição 4: Requisição finalizada e resposta lida
		 */

		if (xmlhttp.readyState == 4) {
			// Recebe o código de retorno (100 a 500)
			if (xmlhttp.status == 200) {
				// Resposta da Requisição
				var aResposta = (xmlhttp.responseText);
				// Insere a resposta da requisição dentro da tag com o ID
				// selecionado
				document.getElementById('lista_cliente').innerHTML = aResposta;
			} else {
				// Erro na resposta da requisição
				document.getElementById('lista_cliente').innerHTML = "Sua requisição não retornou um resultado válido.\nErro: "
						+ xmlhttp.status;
			}
		} else {
			// Carregando resposta da requisição
			// alert("Carregando conteúdo");
		}
	}

}

function selecionaCliente(cod, nome){
	document.getElementById('cliente_id').value = cod;
	document.getElementById('cliente_nome').value = nome;
	
}

