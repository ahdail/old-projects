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
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php }?>  

<form method="post" action="<?php echo base_url() ?>admin/quemsomos/manter" enctype="multipart/form-data" style="width: 98%;">
		<h1>Quem Somos</h1>
		<ul>
			<li>
				<label>Definição</label>
				<textarea id="definicao" name="definicao" class="campo"><?php echo $row['quemSomos']?></textarea>
			</li>
			<h1>Diretoria</h1>
			<li>
				<label>Membros da Diretoria</label>
				<textarea id="diretoria" name="diretoria" class="campo"><?php echo $row['diretoria']?></textarea>
				<script>oEdit2.REPLACE("diretoria");</script>
			</li>
			<h1>Nosso Presidente</h1>
			<li>
				<label title="Nome/Descrição da Fonte">Nome do Presidente</label>
				<input type="text" class="campo" name="nomePresidente" value="<?php echo $row['nomePresidente']?>" title="Nome do Presidente"/><br><br>
				<label title="Nome/Descrição da Fonte">Foto do Presidente</label>
				<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
			</li>
			<li>
				<label>Apresentação do Presidente<span>*</span></label>
				<textarea name="descricaoPresidente" class="campo"><?php echo $row['descricaoPresidente']?></textarea>
			</li>
			<li>
				<label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
			</li>
		</ul>
		<input type="hidden" name="id" value="<?php echo$row['id']?>">
		<?php if($row['id']){?>
		<input type="hidden" name="acao" value="edit">
		<?php } else {?>
		<input type="hidden" name="acao" value="add">
		<?php }?>
</form>



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