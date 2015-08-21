function loadTxt()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Cor";
    txtLang[1].innerHTML = "Sombreamento";   
    
    txtLang[2].innerHTML = "Margem";
    txtLang[3].innerHTML = "Esquerda";
    txtLang[4].innerHTML = "Direita";
    txtLang[5].innerHTML = "Topo";
    txtLang[6].innerHTML = "Baixo";
    
    txtLang[7].innerHTML = "Padding";
    txtLang[8].innerHTML = "Esquerda";
    txtLang[9].innerHTML = "Direita";
    txtLang[10].innerHTML = "Topo";
    txtLang[11].innerHTML = "Baixo";
    
    txtLang[12].innerHTML = "Dimensão";
    txtLang[13].innerHTML = "Largura";
    txtLang[14].innerHTML = "Altura";
    
    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "pixels";
    optLang[1].text = "porcentagem";
    optLang[2].text = "pixels";
    optLang[3].text = "porcentagem";
    
    document.getElementById("btnCancel").value = "cancelar";
    document.getElementById("btnApply").value = "aplicar";
    document.getElementById("btnOk").value = " ok ";
    }
function getTxt(s)
    {
    switch(s)
        {
        case "No Border": return "Sem Borda";
        case "Outside Border": return "Borda por Fora";
        case "Left Border": return "Borda à Esquerda";
        case "Top Border": return "Borda ao Topo";
        case "Right Border": return "Borda à Direita";
        case "Bottom Border": return "Borda em Baixo";
        case "Pick": return "Selecionar";
        case "Custom Colors": return "Cores customizadas";
        case "More Colors...": return "Mais Cores...";
        default: return "";
        }
    }
function writeTitle()
    {
    document.write("<title>Formatação de Caixas</title>")
    }