<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="CIC - Centro Industrial do Cear�" />
<meta name="keywords" content="cic, fiec, centro industrial do cear�, ind�strias, cear�, ciclo de debates, obec" />

<title>CIC - Acesso Restrito</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/login.css" />
</head>
<body onload='document.forms[0].elements[0].focus();'>
	<?php if ($erro== "S"){?>
	<p class="msgErro" align="center"><b>Login e/ou Senha inv�lidos</b></p>
	<?php }?>
<div id="login">
	
	<form method="post" id="formLogin"  action="<?php echo base_url() ?>admin/login/validar">
		<label>Usu�rio</label><input name="login" type="text" />
		<label>Senha</label><input name="senha" type="password" />
		<input id="entrar" type="image" src="<?php echo base_url()?>site/img/loginEntrar.jpg" />
	</form>
</div>

</body>
</html>