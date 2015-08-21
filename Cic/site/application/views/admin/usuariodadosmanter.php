<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } else if($_POST['acao'] == "edit"){?>
<div class="msgOk">Dados atualizados com sucesso!</div>
<?php }?>
<form method="post" action="<?php echo base_url()?>admin/usuariodados/manter" style="width: 400px">
	<div>
		<h1>ATUALIZAR SENHA</h1>
		<ul>
			<li>
				<label>Senha <span>*</span></label>
				<input type="password" class="campoMed" name="senha"/><br>&nbsp;&nbsp;<?php echo "<font size=1px>Deixe em branco se não deseja alterar</font>";?>
			</li>
			<li>
				<label>Repita senha <span>*</span></label>
				<input type="password" class="campoMed" name="rsenha"/><br>&nbsp;&nbsp;<?php echo "<font size=1px>Deixe em branco se não deseja alterar</font>";?>
			</li>
			<li><label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
				<input type="hidden" name="nome" value="<?php echo $row['nome']?>">
				<input type="hidden" name="id" value="<?php echo $row['id']?>">
				<?php if($row['id']){?>
				<input type="hidden" name="acao" value="edit">
				<?php }?>
			</li>
		</ul>
	</div>
</form>
</body>