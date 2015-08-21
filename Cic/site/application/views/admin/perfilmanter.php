<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
	function transfereItem(idList, idList2){
		$("#"+idList2).append($("#"+idList+" option[@selected]"));
	}
	
	function marcaItens() {
		$("#idSecao2 option").attr('selected', true);
	}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } ?>
<form method="post" onsubmit="marcaItens();" action="<?php echo base_url() ?>admin/perfil/manter">
	<h1>CADASTRO DE PERFIS</h1>
	<ul>
		<li>
			<label>Perfil <span>*</span></label>
			<input type="text" name="perfil" value="<?php echo $row['perfil']?>" class="campo" value="" style="width:300px;" maxlength="30" />
		</li>
		<li>
			<label >Seção <span>*</span></label>
				<select name="idSecao" id="idSecao" size="10" multiple="multiple" style="min-width: 50px; vertical-align: middle" class="campo" />
				<?php foreach ($not as $row2) { ?>
					<option value='<?php echo $row2['id']?>'><?php echo $row2['secao']?></option>
				<?php } ?>
				</select>
				<input type="button" value=">>" onClick="transfereItem('idSecao', 'idSecao2');" class="" />
				<input type="button" value="<<" onClick="transfereItem('idSecao2', 'idSecao');" class="" />
				<select name="idSecao2[]" id="idSecao2" size="10" multiple="multiple" style="min-width:50px; vertical-align: middle" class="campo" />
				<?php
				if($join){
					foreach ($join as $row3) { ?>
						<option value='<?php echo $row3['id']?>'><?php echo $row3['secao']?></option>
					<?php
					}
				}
				?>
				</select>
		</li>
		<li>
			<label >&nbsp;</label> 
			<input type="submit" value="Gravar" class="" /> 
		</li>
	</ul>
	<input type="hidden" name="id" value="<?php echo $row['id']?>">
	<?php if($row['id']){?>
	<input type="hidden" name="acao" value="edit">
	<?php } else {?>
	<input type="hidden" name="acao" value="add">
	<?php }?>
</form>
</body>
</html>