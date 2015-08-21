function preparaEditor(nome) {
	var oEdit1 = new InnovaEditor(nome);
	oEdit1.width="100%";//You can also use %, for example: oEdit1.width="100%"
	oEdit1.height=180;

	oEdit1.btnPrint=true;
	oEdit1.btnPasteText=true;
	oEdit1.btnFlash=true;
	oEdit1.btnMedia=true;
	oEdit1.btnLTR=true;
	oEdit1.btnRTL=true;
	oEdit1.btnSpellCheck=true;
	oEdit1.btnStrikethrough=true;
	oEdit1.btnSuperscript=true;
	oEdit1.btnSubscript=true;
	oEdit1.btnClearAll=true;
	oEdit1.btnSave=true;
	oEdit1.btnStyles=true; //Show "Styles/Style Selection" button
	
	oEdit1.features=[
	"Preview","Print","Search","Cut","Copy","Paste","PasteWord","PasteText","|","Undo","Redo","|", "ForeColor","BackColor","|","Hyperlink","XHTMLSource","Image","|","Table","Guidelines","|","Characters","Line","RemoveFormat","ClearAll","BRK",
	"StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","Numbering","Bullets","|","Indent","Outdent","|"
	];

	oEdit1.css="style/test.css"; //Specify external css file here

	oEdit1.cmdAssetManager = "modalDialogShow('/site/js/wysiwyg/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
	oEdit1.cmdInternalLink = "modelessDialogShow('links.htm',365,270)"; //Command to open your custom link lookup page.
	oEdit1.cmdCustomObject = "modelessDialogShow('objects.htm',365,270)"; //Command to open your custom content lookup page.

	oEdit1.mode="XHTMLBody";
	
	return oEdit1;
}