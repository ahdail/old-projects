function loadTxt()
    {
    document.getElementById("txtLang").innerHTML = "Colores";
    document.getElementById("btnCancel").value = "cancelar";
    document.getElementById("btnOk").value = " ok ";
    }
function getTxt(s)
	{
	switch(s)
		{
		case "No Border": return "Sem Borda";
		case "Outside Border": return "Borda Externa";
		case "Left Border": return "Borda Esquerda";
		case "Top Border": return "Borda Topo";
		case "Right Border": return "Borda Direita";
		case "Bottom Border": return "Borta em Baixo";
		case "Pick": return "Selecionar";
		case "Custom Colors": return "Cores Customizadas";
		case "More Colors...": return "Mais Cores...";
		default: return "";
		}
	}
function writeTitle()
	{
	document.write("<title>Bordas</title>")
	}