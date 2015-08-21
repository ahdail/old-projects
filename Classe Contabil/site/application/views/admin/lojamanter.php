<?php checkSessao("EXT");?>
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
<form method="post" action="<?= base_url()?>admin/loja/manter" onsubmit="finalForm();" enctype="multipart/form-data">
	<h1>Loja - Editora Fortes</h1>
	<ul>
		<li>
			<label>Nome do Produto</label>
			<input class="campoGd" type="text" name="nome" value="<?=$row['nome']?>">
		</li>
		<li>
			<label>URL (http://...)</label>
			<input class="campoGd" type="text" name="url" value="<?=$row['url']?>">
		</li>
		<li>
			<label>Imagem</label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
		</li>
		<li>
			<label>Descrição<span>*</span></label>
			<textarea rows="5" cols="35" name="descricao" ><?=$row['descricao']?></textarea>
		</li>
		<li>
			<label>Autorizar publicação?</label>
			<input type="radio" name="aut" id="aut" value="S" <?php if ($row['exibir'] == "S" || $row['exibir'] == "") {echo "checked=\"checked\""; } ?>>Sim
			<input type="radio" name="aut" id="aut" value="N" <?php if ($row['exibir'] == "N") {echo "checked=\"checked\""; } ?>>Não
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