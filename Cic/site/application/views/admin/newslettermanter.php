<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } ?>
<form method="post" id="form1" action="<?php echo base_url()?>admin/newsletter/manter">
	<h1>CADASTRO DE EMAIL</h1>
	<ul>
		<li>
			<label>Nome<span>*</span></label>
			<input class="campoGd" type="text" name="nome" value="<?php $row['nome']?>">
		</li>
		<li>
			<label>E-mail<span>*</span></label>
			<input class="campoGd" type="text" name="email" value="<?php $row['email']?>">
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="" type="submit" value="Gravar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?php echo $row['id']?>">
	<?php if($row['id']){?>
	<input type="hidden" name="acao" value="edit">
	<?php } else {?>
	<input type="hidden" name="acao" value="add">
	<?php }?>
</form>

</body>
</html>