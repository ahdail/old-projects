<?php checkSessao("ANU");?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias pré configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');

var oEdit2 = new preparaEditor('oEdit2');

function mostraEscondeCampos() {
	if (document.getElementById('dtk').checked==true) {
		document.getElementById('ico').style.display='block';
	} else {
		document.getElementById('ico').style.display='none';
	}
}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<?php if ($error) { ?>
<div class="msgErro"><?=$error; ?></div>
<?php } ?>
<form method="post" id="form1" name="form1" action="<?= base_url()?>index.php/admin/anuncie/manter" enctype="multipart/form-data">
	<h1>CADASTRO DE MODELOS DE CONTRATO</h1>
	<ul>
		<li>
			<label>Título</label>
			<input type="text" class="campo" name="titulo" value="<?=$row['titulo']?>" />
		</li>
		<li>
			<label>Descrição<span>*</span></label>
			<textarea name="descricao" style="width: 500px;height: 120px" ><?=$row['descricao']?></textarea>
		</li>
		<li>
			<label>Selecione arquivo<span>*</span></label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
		</li>
		<li>
			<label>Tipo<span>*</span></label>
				<input type="radio" name="tipo" id="tipo" value="1"  <?php if ($row['tipo'] == 1 || $row['tipo'] == "") {echo "checked=\"checked\""; } ?>><img src="<?= base_url()?>site/trabalhos/icon/doc.gif">
				<input type="radio" name="tipo" value="2" <?php if ($row['tipo'] == 2) {echo "checked=\"checked\""; } ?>><img src="<?= base_url()?>site/trabalhos/icon/pdf.gif">
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
	<?php if($row['id']){?>
	<input type="hidden" name="acao" value="edit">
	<?php } else {?>
	<input type="hidden" name="acao" value="add">
	<?php }?>
</form>

</body>
</html>

