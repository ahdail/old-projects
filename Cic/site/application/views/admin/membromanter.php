<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
$(function(){
	$('#nome').focus();
});
</script>
</head>
<body>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<div>
<form method="post" id="form1" action="<?= base_url()?>admin/faleConosco/membroManter">
<input type="hidden" name="id" value="<?=$row['id']?>">
	<h1>CADASTRO DE MEMBROS</h1>
	<ul>
		<li>
			<label>Função<span>*</span></label>
			<select class="campo" name="idFuncao" id="idFuncao">
    		<? foreach ($funcao as $row2) { ?>
    			<option value='<?=$row2['id']?>' <? if($row2['id'] == $row['idFuncao']) echo "selected"; ?>> <?=$row2['nome']?></option>
			<? } ?>
		</li>
		<li>
			<label>Nome<span>*</span></label>
			<input class="campo" type="text" name="nome" id="nome" value="<?=$row['nome']?>" maxlength="40">
		</li>
		<li>
			<label>Email<span>*</span></label>
			<input class="campo" type="text" name="email" id="email" value="<?=$row['email']?>" maxlength="60">
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="" type="submit" value="Gravar" />
		</li>
	</ul>
</form>

</body>
</html>