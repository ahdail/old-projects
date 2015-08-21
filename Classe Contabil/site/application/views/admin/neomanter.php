<?php 
checkSessao("ART");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?= base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias pré configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');
var oEdit2 = new preparaEditor('oEdit2');
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php }  ?>
<form method="post" action="<?= base_url() ?>admin/neo/manter">
		<h1>CADASTRO DE NEOPATRIMONIALISMO</h1>
		<ul>
			<li>
				<label>Autor <span>*</span></label>
				<select name="idAutor">
					<? 
						foreach ($autor as $autor){
						if ($autor['id'] == $row['idAutor']){
							$selecionado = "selected=selected";
						} else {
							$selecionado = "";
						}
					?>
						<option value="<?=$autor['id']?>" <?=$selecionado ?>  ><?=$autor['nome']?></option>
					<?		
						}
					?>
				</select>
			</li>
			<li>
				<label>Título <span>*</span></label>
				<input type="text" class="campoGd" name="titulo" value="<?=$row['titulo']?>" />
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
				<label>Resumo <span>*</span></label>
				<textarea id="resumo" name="resumo" class="campo"><?=$row['resumo']?></textarea>
				<script language="javascript1.2">oEdit1.REPLACE("resumo");</script>
			</li>
			<li>
				<label>Conteúdo <span>*</span></label>
				<textarea id="conteudo" name="conteudo" class="campo"><?=$row['conteudo']?></textarea>
				<script language="javascript1.2">oEdit2.REPLACE("conteudo");</script>
			</li>
			<li>
				<label>Opções:</label>
				<?php 
					if ($row['exibirPrincipal'] == "S") {
						$marcadoExibirPrincipal = "checked=checked";
					} else {
						$marcadoExibirPrincipal= "";
					}
				?>
				<input type="checkbox" name="exibirPrincipal"  value="S" <?=$marcadoExibirPrincipal ?> ><span style="font-size:12px;"> Exibir na Pág. Principal</span></br>
			</li>
			<li>
				<label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
				<input type=reset value=Limpar class="" />
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