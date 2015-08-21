<?php 
checkSessao("MUL");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
<link rel="stylesheet" href="<?= base_url()?>site/js/calendario/calender.css" type="text/css">
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<?php if ($error) { ?>
<div class="msgErro"><?=$error; ?></div>
<?php } ?>
<form method="post" id="form1" name="form1" action="<?= base_url()?>admin/podClasse/manter" enctype="multipart/form-data">
	<h1>CADASTRO DE PODCLASSE (PodCasting)</h1>
	<ul>
		<li>
			<label>Titulo<span >*</span></label>
				<input type="text" name="titulo" class="campoGd" value="<?=$row['titulo']?>">
		</li>
		<li>
			<?php 
					if ($row['data']) {
						$data = $row['data']; 
					} else {
						$data = date("d/m/Y");
					}
				?>
			<label>Data</label>
			
			<input type="text" class="campoPeq" value="<?=$data ?>" name="data" value="<?=$row['data']?>" onFocus="setYears(<?=date("Y")?>, <?=date("Y+1")?>); showCalender(this, 'data');" onKeyDown="return false;" />
		</li>
		<li>
			<label>Selecione arquivo<span>*</span></label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
		</li>
		<li>
			<label>&nbsp;</label>
			<?php 
				if ($row['exibir'] == "S") {
					$exibir = "checked=checked";
				} else {
					$exibir= "";
				}
			?>
			<input type="checkbox" name="exibir"  value="S" <?=$exibir?>><span style="font-size:12px;"> Exibir PodClasse</span></br>
		</li>
		<li>
			<label>Descrição<span>*</span></label>
			<textarea name="descricao" style="width: 300px;height: 120px" ><?=$row['descricao']?></textarea>
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
			<input class="botao" type="reset" value="Limpar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
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
        <td width="25" align="right"><a href="#" onClick="closeCalender();"><img src="<?= base_url()?>site/js/calendario/images/x.gif" border="0"></a></td>
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

