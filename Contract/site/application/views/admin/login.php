<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CP Login</title>
<link href="<?php echo base_url();?>css/admin/login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
	<div id="logincontainer">
    	<h1>CP<span>access</span></h1>
		
		<?php if ($erro== "S"){?>
		
		
		<div class="status error">
			<p class="closestatus"></p>
			<p><img src="<?= base_url()?>images/admin/icons/icon_error.png" alt="Error" /><span><b> Login e/ou Senha inválidos</b></span></p>
		</div>
		
		
            
		<?php } ?>
		
        <div id="loginbox">
        	<!--<form action="<?php echo base_url();?>admin/pagina" />-->
			  <form action="<?= base_url()?>admin/login/validar" method="post" class="form login">
                <div class="inputcontainer">
                    <img src="<?php echo base_url();?>images/admin/icons/icon_username.png" alt="Username" />
                    <label for="username">Usuário:</label>
                    <input type="text" id="username" name="login" />
                </div>
                <div class="inputcontainer">
                    <img src="<?php echo base_url();?>/images/admin/icons/icon_locked.png" alt="Password" />
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="senha" />
                </div>
                <input type="submit" value="Entrar" class="loginsubmit" />
                <!--<p><a href="#">Forgotten password</a></p>-->
            </form>
        </div>
    </div>
</body>
</html>
