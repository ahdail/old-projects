var sStyleWeight1;
var sStyleWeight2;
var sStyleWeight3;
var sStyleWeight4; 

function loadTxt()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Fonte";
    txtLang[1].innerHTML = "Estilo";
    txtLang[2].innerHTML = "Tamanho";
    txtLang[3].innerHTML = "Cor da Fonte";
    txtLang[4].innerHTML = "Cor de Funto";
    
    txtLang[5].innerHTML = "Decoração";
    txtLang[6].innerHTML = "Maiúsculo/Minúsculo";
    txtLang[7].innerHTML = "Minicaps";
    txtLang[8].innerHTML = "Vertical";

    txtLang[9].innerHTML = "Não Definido";
    txtLang[10].innerHTML = "Sublinhado";
    txtLang[11].innerHTML = "Sobrelinhado";
    txtLang[12].innerHTML = "Tachado";
    txtLang[13].innerHTML = "Nenhum";

    txtLang[14].innerHTML = "Não Definido";
    txtLang[15].innerHTML = "1º Letra";
    txtLang[16].innerHTML = "Maiúsculo";
    txtLang[17].innerHTML = "Minúsculo";
    txtLang[18].innerHTML = "Nenhum";

    txtLang[19].innerHTML = "Não Definido";
    txtLang[20].innerHTML = "Small-Caps";
    txtLang[21].innerHTML = "Normal";

    txtLang[22].innerHTML = "Não Definido";
    txtLang[23].innerHTML = "Texto Alto";
    txtLang[24].innerHTML = "Texto Baixo";
    txtLang[25].innerHTML = "Relativo";
    txtLang[26].innerHTML = "Base da Linha";
    
    txtLang[27].innerHTML = "Caractere de espaçamento";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Regular"
    optLang[1].text = "Italico"
    optLang[2].text = "Negrito"
    optLang[3].text = "Negrito/Italico"
    
    optLang[0].value = "Regular"
    optLang[1].value = "Italico"
    optLang[2].value = "Negrito"
    optLang[3].value = "Negrito/Italico"
    
    sStyleWeight1 = "Regular"
    sStyleWeight2 = "Italico"
    sStyleWeight3 = "Negrito"
    sStyleWeight4 = "Negrito/Italico"
    
    optLang[4].text = "Topo"
    optLang[5].text = "Meio"
    optLang[6].text = "Baixo"
    optLang[7].text = "Texto-Topo"
    optLang[8].text = "Texto-Baixo"
    
    document.getElementById("btnPick1").value = "Selecionar";
    document.getElementById("btnPick2").value = "Selecionar";

    document.getElementById("btnCancel").value = "cancelar";
    document.getElementById("btnApply").value = "aplicar";
    document.getElementById("btnOk").value = " ok ";
    }
function getTxt(s)
    {
    switch(s)
        {
        case "Custom Colors": return "Cores customizadas";
        case "More Colors...": return "Mais Cores...";
        default: return "";
        }
    }    
function writeTitle()
    {
    document.write("<title>Formatação de Texto</title>")
    }