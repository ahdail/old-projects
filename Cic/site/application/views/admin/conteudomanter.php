<?php $id = ($row['id']) ? $row['id'] : 0 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?php echo base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias pré configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');

var oEdit2 = new preparaEditor('oEdit2');

function mostraEscondeCampos() {
	if (document.getElementById('cic').checked==true) {
		document.getElementById('ico').style.display='block';
	} else {
		document.getElementById('ico').style.display='none';
	}
}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php }?>  

<form method="post" action="<?php echo base_url() ?>admin/conteudo/manter" style="width: 98%;">
		<h1>CADASTRO DE CONTEÚDO</h1>
		<ul>
			<li>
				<label>Título <span>*</span></label>
				<input type="text" class="campoGd" name="titulo" value="<?php $row['titulo']?>" />
			</li>
			<li>
				<label>Data</label>
				
				<input type="text" class="campoPeq" name="data" value="<?php $row['data']?>" onFocus="setYears(<?php date("Y")?>, <?php date("Y+1")?>); showCalender(this, 'data');" onKeyDown="return false;" />
			</li>
			<li>
				<label>Conteúdo<span>*</span></label>
				<textarea id="resumo" name="resumo" style="height: 100px;" class="campo"><?php $row['resumo']?></textarea>
				<script>oEdit1.REPLACE("resumo");</script>
			</li>
			<li>
				<label>Conteúdo completo<span>*</span></label>
				<textarea id="conteudo" name="conteudo" class="campo"><?php $row['conteudo']?></textarea>
				<script>oEdit2.REPLACE("conteudo");</script>
			</li>
			<li><label>Opção para exibição</label>
			<select type="text" style="color: rgb(136, 136, 136); font-size: 10pt;" name="exibir">
				<option value="">Selecione...</option>
				<option value="EP" <?php if ($row['exibir'] == "EP") {echo " selected=\"selected\" ";}?> >Exibir na Pág. Principal (Blog)</option>
				<option value="OP" <?php if ($row['exibir'] == "OP") {echo " selected=\"selected\" ";}?>>Palavra do Presidente</option>
				<option value="CE" <?php if ($row['exibir'] == "CE") {echo " selected=\"selected\" ";}?>>CIC na Imprensa</option>
			</select>
		</li>
		<li id="ico">
			<label title="Nome/Descrição da Fonte">Fonte</label>
			<input type="text" class="campo" name="fonte" value="<?php $row['fonte']?>" title="Nome/Descrição da Fonte"/><br><br>
			<label title="Site da Fonte">Site (http://...)</label>
			<input type="text" class="campo" name="siteFonte" value="<?php $row['siteFonte']?>" title="Site da Fonte"/>
		</li>
			<li>
				<label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
			</li>
		</ul>
		<input type="hidden" name="id" value="<?php echo $row['id']?>">
		<?php if($row['id']){?>
		<input type="hidden" name="acao" value="edit">
		<?php } else {?>
		<input type="hidden" name="acao" value="add">
		<?php }?>
</form>



<table id="calenderTable" border="0" cellspacing="0" cellpadding="0">
<tbody id="calenderTableHead">
<tr>
 <td colspan="7" align="left" background="<?= base_url()?>site/js/calendario/images/repliBarra.gif">
 
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