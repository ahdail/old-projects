<?php //checkSessao("CONS-TM");?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php }
if ($erro) { ?>
<div class="msgErro"><?=$erro; ?></div>
<?php } ?>
<form method="post" action="<?= base_url()?>admin/temasconsultoria/manter">
	<h1>CONSULTORIA - Temas</h1>
	<ul>
		<li>
			<label>Tema</label>
			<input class="campo" type="text" name="tema" value="<?=$row['tema']?>">
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
	<input type="hidden" name="id" value="<?=$row['id']?>">
	<?php if($row['id']){?>
	<input type="hidden" name="acao" value="edit">
	<?php } else {?>
	<input type="hidden" name="acao" value="add">
	<?php }?>
</form>
</body>
</html>