<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!--
 ____________________________________________________________________
|                                                                    |
|      NAME : Nice Login and Signup Panel using Mootools 1.2         |
|    AUTHOR : Jeeremie { http://web-kreation.com }                   |
|      DATE : August 3, 2008                                         |
|   LICENSE : Creative Common License 2.5                            |
|     EMAIL : info@web-kreation.com                                  |
|____________________________________________________________________|
-->

<head>
  	<title>PDV Lazer - SESC Iparana/Ceará</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<!-- The main style sheet -->
  	<link rel="stylesheet" href="<?php echo base_url()?>site/css/login.css" type="text/css" media="screen" />

	<!-- START Fx.Slide -->
	<!-- The CSS -->
  	<link rel="stylesheet" href="<?php echo base_url()?>site/css/fx.slide.css" type="text/css" media="screen" />
    <!-- Mootools - the core -->
	<script type="text/javascript" src="<?= base_url()?>site/js/login/mootools-1.2-core-yc.js"></script>
    <!--Toggle effect (show/hide login form) -->
	<script type="text/javascript" src="<?= base_url()?>site/js/login/mootools-1.2-more.js"></script>
	<script type="text/javascript" src="<?= base_url()?>site/js/login/fx.slide.js"></script>
	<!-- END Fx.Slide -->

</head>

<body>
	<!-- Login -->
	<div id="login">
	
		<div class="loginContent">
			<?php if ($erro== "S"){?>
				<p align="center" style="color:red"><b>Login e/ou Senha inválidos</b></p>
			<?php }?>
			<form action="<?= base_url()?>pdv/login/validar" method="post">
				<label for="log"><b>Login: </b></label>
					<input class="field" type="text" name="login" id="log" value="" size="23" />
				<label for="pwd"><b>Senha:</b></label>
					<input class="field" type="password" name="senha" id="pwd" size="23" />
					<input type="submit" name="submit" value="" class="button_login" />
				
			</form>
			
			<div class="right"><a href="#">Esqueci a minha senha?</a></div>
		</div>
		<div class="loginClose"><a href="#" id="closeLogin">Fechar</a></div>
	</div> <!-- /login -->

    <div id="container">
		<div id="top">
		<!-- login -->
			<ul class="login">
		    	<li class="left">&nbsp;</li>
		        <li>Bem-vindo!</li>
				<li>|</li>
				<li><a id="toggleLogin" href="#">Acessar</a></li>
			</ul> <!-- / login -->
		</div> <!-- / top -->

        <div class="clearfix"></div>
		<?php if ($erro== "S"){?>
			<p align="center" style="color:red"><b>Login e/ou Senha inválidos<br/> Tente novamente!</b></p>
		<?php }?>

		<div id="content">
		<p align="center">
			<a href="#" title="PDVLazer">Bem-vindo ao PDV Lazer - SESC IPARANA/Ce</a>
			<!-- If javascript is disabled, display message below: -->
			<p align="center"><img src="<?php echo base_url();?>site/img/login/logosesciparana.jpg"></p>
        	<p style="margin-top: 30px;">Para ter acesso ao sitema, clique <strong>"Acessar"</strong><br />
			<small>(<b>OBS:</b> Este sistema é para uso interno do SESC Iparana/Ce! Somentes usuários previamente cadastrados terãoo acesso. Em caso de dúvida procure o responsável.</small>
			</p>
		</p>	
		</div><!-- / content -->
        <div class="clearfix"></div>
	</div><!-- / container -->

</body>

</html>
