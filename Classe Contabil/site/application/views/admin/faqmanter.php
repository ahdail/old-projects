<?php checkSessao("DIC");?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
function finalForm() {
	$("input:disabled").attr('disabled', false);
}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<?php if ($erro) { ?>
<div class="msgErro"><?=$erro; ?></div>
<?php } ?>
<form method="post" action="<?= base_url()?>admin/faq/manter" onsubmit="finalForm();">
	<h1>FAQ - Perguntas Frequentes</h1>
	<ul>
		<li>
			<label>Pergunta</label>
			<input class="campo" type="text" name="pergunta" value="<?=$row['pergunta']?>">
		</li>
		<li>
			<label>Dica<span>*</span></label><br />
			<textarea style="margin-left: 10px;" rows="10" cols="82" name="resposta" ><?=$row['resposta']?></textarea>
		</li>
		
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
</form>

</body>
</html>