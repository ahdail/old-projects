<?php
function converte_data($data){
	if (strstr($data, "/")){//verifica se tem a barra /
		$d = explode ("/", $data);//tira a barra
		$invert_data = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mï¿½s etc...
		return $invert_data;
	}
	elseif(strstr($data, "-")){
		$d = explode ("-", $data);
		$invert_data = "$d[2]/$d[1]/$d[0]";    
		return $invert_data;
	}
	else {
		return "";
	}
}	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?php echo base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.form.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias prï¿½ configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');

var oEdit2 = new preparaEditor('oEdit2');

// Carrega Formulï¿½rio dos Videos
function detalharVideo(idPrograma, idVideo) {
	var div = $('#divVideos'); // Div de manipulaï¿½ï¿½o

	$(div).html('Carregando...'); // Exibe mensagem de aguardo
	
	$.post("<?=base_url()?>admin/cicloDebate/programaDetalharVideo/", "idPrograma="+idPrograma+"&idVideo="+idVideo, function (retorno){
		$(div).html(retorno); // Retorna o conteï¿½do processado
	});
}

// Deleta um vï¿½deo
function deletarVideo(idPrograma, idVideo,nomeArquivo) {
	var div = $('#divVideos'); // Div de manipulaï¿½ï¿½o

	$(div).html('Carregando...'); // Exibe mensagem de aguardo
	
	$.post("<?php echo base_url()?>admin/cicloDebate/programaVideoDeletar/"+idPrograma+"/"+idVideo, "", function (retorno){
		$(div).html(retorno); // Retorna o conteï¿½do processado
	});
}

$(document).ready(function() {
	$('#titulo').focus();
			
	var div = $('#divVideos'); // Div de manipulaï¿½ï¿½o

	var opcoes = {
		iframe: true,
		beforeSubmit: function () {
			$(div).html('Carregando...'); // Exibe mensagem de aguardo
		},
		success: function (retorno) {
			$(div).html(retorno); // Retorna o conteï¿½do processado
		}
	} 
	
	//$('#formVideos').ajaxForm(opcoes);
});

function iframeCarregaDiv(iframe) {
	// Pega o conteudo do iframe
	var conteudo = iframe.contentWindow ? iframe.contentWindow.document : iframe.contentDocument ? iframe.contentDocument : iframe.document;
	var conteudo = conteudo.body ? conteudo.body.innerHTML : null;
	// Se exitstir conteudo, coloca na div
	if (conteudo) {
		$('#divVideosTemp').remove();
		$('#divVideos').html(conteudo).show();
	}
}

function carregandoDiv() {
	$('#divVideos').hide();
	$('#divVideos').after("<div id='divVideosTemp'>Carregando...</div>");
}
</script>
</head>
<body>


<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } ?>
<form method="post" action="<?php echo base_url() ?>admin/cicloDebate/programaManter" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $row['id']?>">
	<h1>CADASTRO DE PROGRAMA</h1>
	<ul>
		<li>
			<label>Título <span>*</span></label>
			<input type="text" class="campoGd" name="titulo" id="titulo" value="<?php echo $row['titulo']?>" />
		</li>
		<li>
			<label>Data<span>*</span></label>
			
			<input type="text" class="campoPeq" name="data" value="<?php echo converte_data($row['data']);?>" onFocus="setYears(<?php echo date("Y")?>, <?php echo date("Y+1")?>); showCalender(this, 'data');" onKeyDown="return false;" />
		</li>
		<li>
			<?php 
				if ($row['exibir'] == "S") {
					$selecionado = "checked=\"checked\" "; 
				} else {
					$selecionado = "";
				}
			?>
			<label>Exibir<span>*</span></label>
			<input type="checkbox"  name="exibir" value="S" <?php echo $selecionado?> />
		</li>
		<li>
			<label>Resumo <span>*</span></label>
			<textarea id="resumo" name="resumo" style="height: 100px;" class="campo"><?php echo $row['resumo']?></textarea>
			<script>oEdit1.REPLACE("resumo");</script>
		</li>
		<li>
			<label>&nbsp;</label> 
			<input type=submit value="Cadastrar..." class="" /> 
			<?php if($row['id']){?>
			<input type="hidden" name="acao" value="edit">
			<?php } else {?>
			<input type="hidden" name="acao" value="add">
			<?php }?>
		</li>
	</ul>
</form>
<form method="post" id="formVideos" name="formVideos" target="iframeAjax" onsubmit="carregandoDiv();" action="<?php echo base_url()?>index.php/admin/cicloDebate/programaManterVideo" enctype="multipart/form-data">
<div id='divVideos'>
<?php echo $videos?>
</div>
</form>

<iframe id='iframeAjax' name="iframeAjax" onload="iframeCarregaDiv(this);" style="position: absolute; top: 0px; left: 0px; visibility: hidden;"></iframe>


<table id="calenderTable" border="0" cellspacing="0" cellpadding="0">
<tbody id="calenderTableHead">
<tr>
 <td colspan="7" align="left" background="<?php echo base_url()?>site/js/calendario/images/repliBarra.gif">
 
 <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
        <select name="select" id="selectMonth" onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value, this.selectedIndex, false));">
          <option value="0">Jan</option>
          <option value="1">Fev</option>
          <option value="2">Mar</option>
          <option value="3">Abr</option>
          <option value="4">Mai</option>
          <option value="5">Jun</option>
          <option value="6">Jul</option>
          <option value="7">Ago</option>
          <option value="8">Set</option>
          <option value="9">Out</option>
          <option value="10">Nov</option>
          <option value="11">Dez</option>
        </select></td>
        <td>
        <select name="select2" id="selectYear" onChange="showCalenderBody(createCalender(this.value, document.getElementById('selectMonth').selectedIndex, false));">
        </select>        </td>
        <td width="25" align="right"><a href="#" onClick="closeCalender();"><img src="<?php echo base_url()?>site/js/calendario/images/x.gif" border="0"></a></td>
      </tr>
    </table>    </td>
 </tr>
</tbody>
<tbody id="calenderTableDays">
<tr style="font-family: Verdana, Arial, Helvetica, sans-serif; size:10px; font-weight:bold;">
 <td>D</td><td>S</td><td>T</td><td>Q</td><td>Q</td><td>S</td><td>S</td>
</tr>
</tbody>
<tbody id="calender"></tbody>
</table>



</body>
</html>