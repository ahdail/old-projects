function getTxt(s)
	{
    switch(s)
        {
		case "Folder deleted.": return "Pasta Deletada.";
		case "Folder does not exist.": return "A pasta n�o existe.";
		case "Cannot delete Asset Base Folder.": return "N�o � poss�vel deletar a pasta base";
        }
    }
function loadTxt()
	{
	document.getElementById("btnCloseAndRefresh").value = "Fechar e Atualizar";
	}
function writeTitle()
	{
	document.write("<title>Deletar Pasta</title>")
	}