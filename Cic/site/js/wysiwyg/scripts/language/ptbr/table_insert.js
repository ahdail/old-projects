function loadTxt()
    {
    var txtLang =  document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Linhas";
    txtLang[1].innerHTML = "Espaçamento";
    txtLang[2].innerHTML = "Colunas";
    txtLang[3].innerHTML = "Padding";
    txtLang[4].innerHTML = "Bordas";
    txtLang[5].innerHTML = "Collapse";
    
	var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Sem Borda";
    optLang[1].text = "Sim";
    optLang[2].text = "Não";
    
    document.getElementById("btnCancel").value = "cancelar";
    document.getElementById("btnInsert").value = "inserir";

    document.getElementById("btnSpan1").value = "Span v";
    document.getElementById("btnSpan2").value = "Span >";
    }
function writeTitle()
    {
    document.write("<title>Inserir Tabela</title>")
    }