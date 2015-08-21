<?php 
checkSessao("ADM.SEN");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<form method="post" id="form1"  action="<?= base_url()?>admin/usuarioDados/manter">
	<div>
		<h1>CADASTRO DE USUÁRIOS</h1>
		<ul>
			<li>
			<font style="font-size: 10px;font-style: ">
				<label>Nome<span>*</span></label>
				<input type="text" class="campo" name="nome" value="<?=$row['nome']?>" />
			</li>
			<li>
				<label>Senha <span>*</span></label>
				<input type="password" class="campoPeq" name="senha"  />&nbsp;&nbsp;<?php echo "<font size=1px>Deixe em branco se não deseja alterar</font>";?>
			</li>
			<li>
				<label>Repita senha <span>*</span></label>
				<input type="password" name="rsenha" class="campoPeq" />&nbsp;&nbsp;<?php echo "<font size=1px>Deixe em branco se não deseja alterar</font>";?>
			</li>
			<li><label>&nbsp;</label> 
				<input type=submit value=Gravar class="botao" /> 
				<input type=reset value=Limpar class="botao" />
			</li>
		</ul>
	</div>
</form>
</body>
</html>