function getTxt(s)
	{
	switch(s)
		{
		case "Folder already exists.": return "Essa pasta já existe.";
		case "Folder created.": return "Pasta criada.";
		case "Invalid input.": return "Input inválido.";
		}
	}	
function loadTxt()
	{
    document.getElementById("txtLang").innerHTML = "Nome da nova pasta";
    document.getElementById("btnCloseAndRefresh").value = "Fechar e Atualizar";
    document.getElementById("btnCreate").value = "Criar";
	}
function writeTitle()
	{
	document.write("<title>Criar Pasta</title>")
	}
