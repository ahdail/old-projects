function loadTxt()
    {
    var txtLang = document.getElementsByName("txtLang");
    txtLang[0].innerHTML = "Palheta WEB";
    txtLang[1].innerHTML = "Cores Nomeadas";
    txtLang[2].innerHTML = "216 Web Safe";
    txtLang[3].innerHTML = "Novo";
    txtLang[4].innerHTML = "Atual";
    txtLang[5].innerHTML = "Cores customizadas";
    
    document.getElementById("btnAddToCustom").value = "Adicionar nova cor";
    document.getElementById("btnCancel").value = " cancelar ";
    document.getElementById("btnRemove").value = " remover cor ";
    document.getElementById("btnApply").value = " aplicar ";
    document.getElementById("btnOk").value = " ok ";
    }
function writeTitle()
    {
    document.write("<title>Cores</title>")
    }
