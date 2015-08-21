<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?= base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
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
<?php } ?>
<form method="post" id="form1" action="<?php echo base_url()?>admin/novapagina/manter">
	<h1>NOVA PÁGINA</h1>
	<ul>
		<li>
			<label>Menu</label>
			<input class="campoGd" type="text" name="menu" value="<?php $row['menu']?>">
		</li>
		<li>
			<label>Título</label>
			<input class="campoGd" type="text" name="titulo" value="<?php $row['titulo']?>">
		</li>
		<li>
			<label>Conteúdo</label><font size="1">(este será o conteudo que aparecerá na nova página)</font><br />
			<textarea id="conteudo" name="conteudo" style="width: 500px;height: 300px" ><?php $row['conteudo']?></textarea>
			<script>oEdit2.REPLACE("conteudo");</script>
		</li>
		
		<li>
			<label>&nbsp;</label>
			<input class="" type="submit" value="Gravar" />
			<input class="" type="reset" value="Limpar" />
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