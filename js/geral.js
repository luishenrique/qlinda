// JavaScript Document

try{
    xmlhttp = new XMLHttpRequest();
}catch(ee){
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }
}


function mostraConteudo(cod,tipo){

	if(document.getElementById('btn_'+tipo+'_'+cod).title=="+"){
		document.getElementById('btn_'+tipo+'_'+cod).title="-";
		document.getElementById('btn_'+tipo+'_'+cod).innerHTML="<i class=\"icon-chevron-down\"></i>";
		document.getElementById('conteudo_'+tipo+'_'+cod).style.display="";
		if(tipo=="A"){
			carregaCapitulos(cod);
		}else{
			carregaCategorias(cod);
		}
	}else{
		document.getElementById('btn_'+tipo+'_'+cod).title="+";
		document.getElementById('conteudo_'+tipo+'_'+cod).style.display="none";
		if(tipo=="A"){
			document.getElementById('btn_'+tipo+'_'+cod).innerHTML="<i class=\"icon-list-alt\"></i>";
		}else{
			document.getElementById('btn_'+tipo+'_'+cod).innerHTML="<i class=\"icon-tags\"></i>";
		}
	}

}


function carregaCategorias(codigo){

	document.getElementById('conteudo_B_'+codigo).style.display = "";
	document.getElementById('conteudo_B_'+codigo).innerHTML = "Aguarde, pesquisando...!!!";	
	
	dadosDoFormulario = "id="+escape(codigo);
	xmlhttp.open("POST", "../historiacategoria/lista.php?"+dadosDoFormulario, true);
	xmlhttp.setRequestHeader('Content-Type','text/html');
	xmlhttp.setRequestHeader('encoding','utf-8');
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader('Content-length', dadosDoFormulario.lenght ); 
	xmlhttp.send(dadosDoFormulario);
	xmlhttp.onreadystatechange=function() {

		/*
		Verifica o estado do sistema
		0: Requisição não inicializada
		1: Conexão estabelecida com o servidor
		2: Requisição recebida
		3: Processando requisição 
		4: Requisição finalizada e resposta lida
		*/

        if (xmlhttp.readyState==4){
			//Recebe o código de retorno (100 a 500)
			if (xmlhttp.status == 200){
				//Resposta da Requisição
				var aResposta = (xmlhttp.responseText);
				//Insere a resposta da requisição dentro da tag com o ID selecionado
				document.getElementById('conteudo_B_'+codigo).innerHTML = aResposta;	
			}else{
				//Erro na resposta da requisição
				document.getElementById('conteudo_B_'+codigo).innerHTML = "Sua requisição não retornou um resultado válido.\nErro: "+xmlhttp.status;
			}
        }else{
			//Carregando resposta da requisição
			//alert("Carregando conteúdo");
		}
    }
}

function carregaCapitulos(codigo){

	document.getElementById('conteudo_A_'+codigo).style.display = "";
	document.getElementById('conteudo_A_'+codigo).innerHTML = "Aguarde, pesquisando...!!!";	
	
	dadosDoFormulario = "id="+escape(codigo);
	xmlhttp.open("POST", "../capitulo/lista.php?"+dadosDoFormulario, true);
	xmlhttp.setRequestHeader('Content-Type','text/html');
	xmlhttp.setRequestHeader('encoding','utf-8');
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader('Content-length', dadosDoFormulario.lenght ); 
	xmlhttp.send(dadosDoFormulario);
	xmlhttp.onreadystatechange=function() {

		/*
		Verifica o estado do sistema
		0: Requisição não inicializada
		1: Conexão estabelecida com o servidor
		2: Requisição recebida
		3: Processando requisição 
		4: Requisição finalizada e resposta lida
		*/

        if (xmlhttp.readyState==4){
			//Recebe o código de retorno (100 a 500)
			if (xmlhttp.status == 200){
				//Resposta da Requisição
				var aResposta = (xmlhttp.responseText);
				//Insere a resposta da requisição dentro da tag com o ID selecionado
				document.getElementById('conteudo_A_'+codigo).innerHTML = aResposta;	
			}else{
				//Erro na resposta da requisição
				document.getElementById('conteudo_A_'+codigo).innerHTML = "Sua requisição não retornou um resultado válido.\nErro: "+xmlhttp.status;
			}
        }else{
			//Carregando resposta da requisição
			//alert("Carregando conteúdo");
		}
    }
}


function editaHistoriaCategoria(campo,historia,categoria){

	if(campo.checked==true){
		tipo = "S";
	}else{
		tipo = "R";
	}

	dadosDoFormulario = "historia="+escape(historia)+"&categoria="+escape(categoria)+"&tipo="+escape(tipo);
	xmlhttp.open("POST", "../historiacategoria/edita.php?"+dadosDoFormulario, true);
	xmlhttp.setRequestHeader('Content-Type','text/html');
	xmlhttp.setRequestHeader('encoding','utf-8');
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader('Content-length', dadosDoFormulario.lenght ); 
	xmlhttp.send(dadosDoFormulario);
	xmlhttp.onreadystatechange=function() {

		/*
		Verifica o estado do sistema
		0: Requisição não inicializada
		1: Conexão estabelecida com o servidor
		2: Requisição recebida
		3: Processando requisição 
		4: Requisição finalizada e resposta lida
		*/

        if (xmlhttp.readyState==4){
			//Recebe o código de retorno (100 a 500)
			if (xmlhttp.status == 200){
				//Resposta da Requisição
				var aResposta = (xmlhttp.responseText);
				//Insere a resposta da requisição dentro da tag com o ID selecionado
				//alert("Salvo");
			}else{
				//Erro na resposta da requisição
				alert("Erro");
			}
        }else{
			//Carregando resposta da requisição
			//alert("Carregando conteúdo");
		}
    }
}



function salvaCapitulo(texto,ordem,tangram,historia){

	dadosDoFormulario = "historia="+escape(historia)+"&tangram="+escape(tangram)+"&ordem="+escape(ordem)+"&texto="+escape(texto);
	xmlhttp.open("POST", "../capitulo/edita.php?"+dadosDoFormulario, true);
	xmlhttp.setRequestHeader('Content-Type','text/html');
	xmlhttp.setRequestHeader('encoding','utf-8');
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader('Content-length', dadosDoFormulario.lenght ); 
	xmlhttp.send(dadosDoFormulario);
	xmlhttp.onreadystatechange=function() {

		/*
		Verifica o estado do sistema
		0: Requisição não inicializada
		1: Conexão estabelecida com o servidor
		2: Requisição recebida
		3: Processando requisição 
		4: Requisição finalizada e resposta lida
		*/

        if (xmlhttp.readyState==4){
			//Recebe o código de retorno (100 a 500)
			if (xmlhttp.status == 200){
				//Resposta da Requisição
				var aResposta = (xmlhttp.responseText);
				//Insere a resposta da requisição dentro da tag com o ID selecionado
				//alert(aResposta);
				carregaCapitulos(historia);
			}else{
				//Erro na resposta da requisição
				alert("Erro");
			}
        }else{
			//Carregando resposta da requisição
			//alert("Carregando conteúdo");
		}
    }
}


function compartilharHistoria(historia,campo){
	
	if(campo.checked == true){
		valor = 1;
	}else{
		valor = 0;
	}

	dadosDoFormulario = "historia="+escape(historia)+"&valor="+escape(valor);
	xmlhttp.open("POST", "compartilha.php?"+dadosDoFormulario, true);
	xmlhttp.setRequestHeader('Content-Type','text/html');
	xmlhttp.setRequestHeader('encoding','utf-8');
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.setRequestHeader('Content-length', dadosDoFormulario.lenght ); 
	xmlhttp.send(dadosDoFormulario);
	xmlhttp.onreadystatechange=function() {

		/*
		Verifica o estado do sistema
		0: Requisição não inicializada
		1: Conexão estabelecida com o servidor
		2: Requisição recebida
		3: Processando requisição 
		4: Requisição finalizada e resposta lida
		*/

        if (xmlhttp.readyState==4){
			//Recebe o código de retorno (100 a 500)
			if (xmlhttp.status == 200){
				//Resposta da Requisição
				var aResposta = (xmlhttp.responseText);
				//Insere a resposta da requisição dentro da tag com o ID selecionado
				//alert(aResposta);
			}else{
				//Erro na resposta da requisição
				alert("Erro");
			}
        }else{
			//Carregando resposta da requisição
			//alert("Carregando conteúdo");
		}
    }
}
