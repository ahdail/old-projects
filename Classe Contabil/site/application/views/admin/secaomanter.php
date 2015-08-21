<?php 
checkSessao("ADM.SEC");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<?php if ($erro) { ?>
<div class="msgErro"><?=$erro; ?></div>
<?php } ?>
<form method="post" id="form1" action="<?= base_url()?>admin/secao/manter">

<?php
if ($row['secao']){
	echo "ok";
}else {
	echo "vazio";
}


?>


	<h1>CADASTRO DE SEÇÕES</h1>
	<ul>
		<li>
			<label>Nome<span>*</span></label>
			<input class="campo" type="text" name="nome" value="<?=$row['nome']?>" maxlength="30">
		</li>
		<li>
			<label>Código<span>*</span></label>
			<input class="campoPeq" type="text" name="codigo" value="<?=$row['codigo']?>" maxlength="10">
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="" type="submit" value="Gravar" />
			<input class="" type="reset" value="Limpar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
</form>

</body>
</html>