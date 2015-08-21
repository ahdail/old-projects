<script language='javascript'>
$(document).ready(function() {
	$('#email').focus();
});
</script>

<!-- Formulário para Acesso -->
<div id="divConteudo">

<h1 class="titulo">Meu Classe</h1>
<div class="divisa"></div>
<h3>Acesso Restrito</h3>

<!-- Logar como Usuário -->

<div class="esq" style="width: 100%">
	<?php //if ($row['consultor'] == "S"){?>
	<!--  <form action="<?php echo base_url()?>login/validarConsultor" method="post">-->
	<?php //} else {?>
	<form action="<?php echo base_url()?>login/validar" method="post">
	<?php //}?>
	<?php if (validation_errors()) { ?>
	<div class="msgErro"><?php echo validation_errors(); ?></div>
	<?php } else if ($erro){?>
		<div class="msgErro"><?= $erro?></div>
	<?php } 
	if ($msg){?>
		<div class="msgOk"><?php echo $msg?></div>	
	<?php }?>
	
		<fieldset>
			<label style="width: 50px">E-mail</label><input style="width: 200px;" type="text" name="email" id="email" value="<?php echo $email?>"><br />
			<label style="width: 50px">Senha</label><input style="width: 200px;"type="password" name="senha">
			<!--  
			<label style="width: 50px">Consultor?</label>&nbsp;&nbsp;
				<input type="radio" name="consultor" value="S"  <?php if ($row['consultor'] == "S") {echo "checked=\"checked\""; } ?>>Sim
				<input type="radio" name="consultor" value="N"  <?php if ($row['consultor'] == "N") {echo "checked=\"checked\""; } ?>>Não <br /><br />
			-->	
			<input type="submit" value="Acessar" class=""><br />
					<label style="width: 50px">&nbsp;</label><a href="<?php echo base_url()?>login/esqueciMinhaSenha" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Esqueci minha senha</a>
					<a href="<?php echo base_url()?>login/cadastrar/" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Ainda não sou cadastrado</a>
		</fieldset>
	</form>
</div>	
<!-- 
<div class="dir" style="width: 50%">
	<form action="<?= base_url()?>login/validarConsultor" method="post">
	<?php if (validation_errors()) { ?>
	<div class="msgErro" style="padding-left: 10px"><?=validation_errors(); ?></div>
	<?php } else if ($erro){?>
		<div class="msgErro" style="padding-left: 10px"><?= $erro?></div>
		<div class="msgErro" style="padding-left: 10px"><?= $email?></div>
	<?php } 
	if ($msg){?>
		<div class="msgErro" style="padding-left: 10px"><?= $msg?></div>	
	<?php }?>
	
		<fieldset>
			<label style="padding-left:60px; font-weight: bold">Sou Consultor</label><br /><br /><br />
			<label style="width: 50px">E-mail</label><input style="width: 200px;" type="text" name="email" value="<?=$email?>"><br />
			<label style="width: 50px">Senha</label><input style="width: 200px;" type="password" name="senha"> <br />
			<input type="submit" value="Acessar" class=""><br />
			<label style="width: 50px">&nbsp;</label><a href="<?= base_url()?>login/esqueciMinhaSenha">Esqueci minha senha</a><br />
			<a href="<?= base_url()?>login/cadastrar/">Quero ser Consultor</a>
		</fieldset>
	</form>
</div>	
-->
<p align="center">Ainda não fez seu cadastro?<br><a href="<?php echo base_url()?>login/cadastrar/">Clique aqui e cadastre-se gratuitamente no Classe Contábil.</a></p>
</div>
