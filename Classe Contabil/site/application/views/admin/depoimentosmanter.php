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
<form method="post" action="<?= base_url()?>admin/depoimentos/manter" onsubmit="finalForm();">
	<h1>CADASTRO - Depoimentos</h1>
	<ul>
		<li>
			<label>Nome</label>
			<input class="campo" type="text" name="nome" value="<?=$row['nome']?>">
		</li>
		<li>
			<label>E-mail</label>
			<input class="campo" type="text" name="email" value="<?=$row['email']?>">
		</li>
		<li>
			<label>Depoimento<span>*</span></label>
			<textarea rows="9" cols="35" name="depoimento" ><?=$row['depoimento']?></textarea>
		</li>
		<li>
			<label>Autorizar publicação?</label>
			<input type="radio" name="aut" id="aut" value="S" <?php if ($row['autorizado'] == "S" || $row['tipo'] == "") {echo "checked=\"checked\""; } ?>>Sim
			<input type="radio" name="aut" id="aut" value="N" <?php if ($row['autorizado'] == "N") {echo "checked=\"checked\""; } ?>>Não
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