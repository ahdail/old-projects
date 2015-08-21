function loadTxt()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Caminho da Imagem";
    txtLang[1].innerHTML = "Repetir";
    txtLang[2].innerHTML = "Alinhamento Horizontal";
    txtLang[3].innerHTML = "Alinhamento Vertical";

    var optLang = document.getElementsByName("optLang");
    optLang[0].text = "Repetir"
    optLang[1].text = "Não Repetir"
    optLang[2].text = "Repetir Horizontalmente"
    optLang[3].text = "Repetir Verticalmente"
    optLang[4].text = "Esquerda"
    optLang[5].text = "Centro"
    optLang[6].text = "Direita"
    optLang[7].text = "Pixels"
    optLang[8].text = "Porcentagem"
    optLang[9].text = "Topo"
    optLang[10].text = "Centro"
    optLang[11].text = "Baixo"
    optLang[12].text = "Pixels"
    optLang[13].text = "Porcentagem"
    
    document.getElementById("btnCancel").value = "cancelar";
    document.getElementById("btnOk").value = " ok ";
    }
function writeTitle()
    {
    document.write("<title>Imagem de Fundo</title>")
    }

