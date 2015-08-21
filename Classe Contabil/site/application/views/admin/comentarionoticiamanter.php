<?php 
checkSessao("NOT");
?>
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
<form method="post" action="<?= base_url()?>admin/comentarionoticia/manter" onsubmit="finalForm();">
	<h1>CADASTRO DE COMENTÁRIO</h1>
	<ul>
		<li>
			<label>Nome</label>
			<input class="campo" disabled="disabled" type="text" name="nome" value="<?=$row['nome']?>" maxlength="30">
		</li>
		<li>
			<label>Comentário<span>*</span></label>
			<textarea rows="9" cols="35" name="comentario" ><?=$row['comentario']?></textarea>
		</li>
		<li>
			<label>Email</label>
			<input class="campo" type="text" disabled="disabled" name="email" value="<?=$row['email']?>">
		</li>
		<li>
			<label>Autorizado</label>
			<?php 
				if ($row['autorizado'] == "S") {
					$marcado = " checked=\"checked\" ";
				}
			?>
			<input type="checkbox"  <?=$marcado ?> name="autorizado" value="S" >
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
			<input class="botao" type="reset" value="Limpar" />
		</li>
	</ul>
	<input type="hidden" name="idComentario" value="<?=$row['idComentario']?>">
</form>
</body>
</html>