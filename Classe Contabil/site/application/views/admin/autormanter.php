<?php 
checkSessao("ART");
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
<form method="post" action="<?= base_url()?>admin/autor/manter">
	<h1>CADASTRO DE AUTORES</h1>
	<ul>
		<li>
			<label>Nome<span>*</span></label>
			<input class="campo" type="text" name="nome" value="<?=$row['nome']?>" maxlength="30">
		</li>
		<li>
			<label>Currículo Resumido<span>*</span></label>
			<textarea rows="9" cols="35" name="curriculoResumido" ><?=$row['curriculoResumido'] ?></textarea>
		</li>
		<li>
			<label>Email<span>*</span></label>
			<input class="campo" type="text" name="email" value="<?=$row['email']?>">
		</li>
		<li>
			<label>DDD + Telefone</label>
			<input class="campoPeq" style="width: 30px" type="text" name="ddd" value="<?=$row['ddd']?>" maxlength="2">
			<input class="campo" style="width: 80px" type="text" name="telefone" value="<?=$row['telefone']?>">
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
			<input class="botao" type="reset" value="Limpar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
</form>

</body>
</html>