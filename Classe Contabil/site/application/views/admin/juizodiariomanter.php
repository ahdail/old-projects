<?php 
checkSessao("ART");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?= base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<form method="post" id="form1" action="<?= base_url()?>admin/juizodiario/manter">
	<h1>CADASTRO JUÍZO DIÁRIO (Peguntas/Respostas)</h1>
	<ul>
		<li>
			<label>Pergunta<span>*</span></label>
			<textarea name="pergunta" style="width: 500px;height: 120px" ><?=$row['pergunta']?></textarea>
		</li>
		<li>
			<label>Resposta<span>*</span></label>
			<textarea name="resposta" style="width: 500px;height: 120px" ><?=$row['resposta']?></textarea>
		</li>
		
		<li>
			<label>&nbsp;</label>
			<input class="" type="submit" value="Gravar" />
			<input class="" type="reset" value="Limpar" />
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