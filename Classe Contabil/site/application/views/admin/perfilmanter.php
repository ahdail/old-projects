<?php 
checkSessao("ADM.PER");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
	function transfereItem(idList, idList2){
		$("#"+idList2).append($("#"+idList+" option:selected"));
	}
	
	function marcaItens() {
		$("#idSecao2 option").attr('selected', true);
	}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<form method="post" onsubmit="marcaItens();" action="<?= base_url() ?>admin/perfil/manter">
	<h1>CADASTRO DE PERFIS</h1>
	<ul>
		<li>
			<label>Nome <span>*</span></label>
			<input type="text" name="nome" value="<?=$row['nome']?>" class="campo" value="" style="width:300px;" maxlength="30" />
		</li>
		<li>
			<label >Seção <span>*</span></label>
				<select name="idSecao" id="idSecao" size="10" multiple="multiple" style="min-width: 50px; vertical-align: middle" class="campo" />
				<? foreach ($not as $row2) { ?>
					<option value='<?=$row2['id']?>'><?=$row2['nome']?></option>
				<? } ?>
				</select>
				<input type="button" value=">>" onClick="transfereItem('idSecao', 'idSecao2');" class="" />
				<input type="button" value="<<" onClick="transfereItem('idSecao2', 'idSecao');" class="" />
				<select name="idSecao2[]" id="idSecao2" size="10" multiple="multiple" style="min-width:50px; vertical-align: middle" class="campo" />
				<?
				if($join){
					foreach ($join as $row3) { ?>
						<option value='<?=$row3['id']?>'><?=$row3['nome']?></option>
					<?
					}
				}
				?>
				</select>
		</li>
		<li>
			<label >&nbsp;</label> 
			<input type="submit" value="Gravar" class="" /> 
			<input type="reset" value="Limpar" class="" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
</form>
</body>
</html>