function loadTxt()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Inserir Linha";
    txtLang[1].innerHTML = "Inserir Coluna";
    txtLang[2].innerHTML = "Mesclar/Separar<br>Linha";
    txtLang[3].innerHTML = "Mesclar/Separar<br>Coluna";
    txtLang[4].innerHTML = "Deletar Linha"";
    txtLang[5].innerHTML = "Deletar Coluna";

	document.getElementById("btnInsRowAbove").title="Inserir Linha (À Cima)";
	document.getElementById("btnInsRowBelow").title="Insert Row (À Baixo)";
	document.getElementById("btnInsColLeft").title="Inserir Coluna (Esquerda)";
	document.getElementById("btnInsColRight").title="Inserir coluna (Direita)";
	document.getElementById("btnIncRowSpan").title="Mesclar Linha";
	document.getElementById("btnDecRowSpan").title="Separar Linha";
	document.getElementById("btnIncColSpan").title="Mesclar Coluna";
	document.getElementById("btnDecColSpan").title="Separar Coluna";
	document.getElementById("btnDelRow").title="Deletar Linha";
	document.getElementById("btnDelCol").title="Deletar Coluna";
	document.getElementById("btnClose").value = " Fechar ";
    }
function getTxt(s)
    {
    switch(s)
        {
        case "Cannot delete column.":
            return "Não é possível deletar a coluna. A coluna contem mesclagem com outra coluna. Por favor remova a mesclagem primeiro.";
        case "Cannot delete row.":
            return "Não é possível deletar a linha. A linha contem mesclagem com outra linha. Por favor remova a mesclagem primeiro.";
        default:return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Tamanho da Tabela</title>")
    }