<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>
<script language="javascript">
$(function(){
	$('#nome').focus();
});
</script>
</head>
<body>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } ?>
<div>
<form method="post" id="form1" action="<?php echo base_url()?>admin/faleConosco/manter">
<input type="hidden" name="id" value="<?php echo $row['id']?>">
	<h1>CADASTRO DE FUNÇÕES</h1>
	<ul>
		<li>
			<label>Nome<span>*</span></label>
			<input class="campo" type="nome" name="nome" id="nome" value="<?php echo $row['nome']?>" maxlength="40">
		</li>
		<li>
			<label>Email<span>*</span></label>
			<input class="campo" type="text" name="email" id="email" value="<?php echo $row['email']?>" maxlength="80">
		</li>
		<li>
			<label>Ordem<span>*</span></label>
			<input class="campoPeq" type="text" name="ordem" id="ordem" value="<?php echo $row['ordem']?>" maxlength="3"><br>&nbsp;&nbsp;<font size="1" style="font-style: italic">Apenas Números (Este campo é usado para ordenar as opções de email disponiveis para contato no site)</font>
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="" type="submit" value="Gravar" />
			<input class="" type="reset" value="Limpar" />
		</li>
	</ul>
</form>

</body>
</html>