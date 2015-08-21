<!-- CONTEÚDO -->
<div id="divConteudo">
	<h1 class="titulo">Todos os Depoimentos</h1>
		<div class="divisa"></div>
			<?php foreach ($depoimentos as $row){?>
				<ul class="listagem">
					<li>
						<p><?=$row['depoimento']?></p>
						<p class="assinatura"><?= str_replace("<br>",". ", $row['nome'])?>. <?= arrobaImg($row['email'])?></p>
					</li>
				</ul>
			<?php }?>
<style>
	#maisNum {
		font-size: 12px;
		text-decoration: none;
		color: #515151;
	}
	#maisNum a {
		text-decoration: none;
		color: inherit;
	}
	#maisNum a:hover {
		font-weight: bold;
		text-decoration: underline;
		color: #000000;
	}
</style>
<? 
echo "<br />".$pag;
?>	
<script>
	function mostrar() {
		obj1 = document.getElementById("indicacao");
		if (obj1.style.display=='block') {
			obj1.style.display='none';
		} else {
			obj1.style.display='block';
		}
	}
</script>
<script language="javascript">
$(document).ready(function() { 
	var opcoes = {
		beforeSubmit: function () {
			$("#indicacao").html("<p>Enviando...</p>");
		},
		success: function (retorno) {
			$("#indicacao").html(retorno);
		}
	} 
	$('#formIndicacao').ajaxForm(opcoes);
});
</script>
<p><a href="#deixarDepoimento" onclick="mostrar();"><span class="verde">Quero deixar o meu depoimento</span></a></p>
<a name="#deixarDepoimento"></a>
<?php if($session_idUsuario || $session_idConsultor){?>
	<!-- Exibir o Formulário de indicacao de notícia -->
	<form action="<?= base_url()?>inicio/enviarDepoimento" method="post" id="formIndicacao">
		<?php if($session_idUsuario){?>
		<input type="hidden" name="nome" value="<?=$session_login?>">
		<input type="hidden" name="email" value="<?=$session_email?>">
		<input type="hidden" name="id" value="<?=$session_idUsuario?>">
		<?php } else {?>
		<input type="hidden" name="nome" value="<?=$session_login_consultor?>">
		<input type="hidden" name="email" value="<?=$session_email_consultor?>">
		<input type="hidden" name="id" value="<?=$session_idConsultor?>">
		<?php }?>
		<div id="indicacao" style="display: none">
			<?= $depoimentoForm; ?>
		</div>
	</form>
	<?php } else {?>
		<div id="indicacao" style="display: none">
			<form action="<?= base_url()?>login/validar" method="post">	
				<fieldset>
					<span>Para deixar um depoimento, informe seus dados.</span><br /><br />
					<label style="width: 50px">E-mail</label><input type="text" name="email" value="<?=$email?>"><br />
					<label style="width: 50px">Senha</label><input type="password" name="senha"><br />
					<label style="width: 50px">&nbsp;</label><input type="submit" value="Acessar" class=""><br />
					<label style="width: 50px">&nbsp;</label><a href="<?= base_url()?>login/esqueciMinhaSenha" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Esqueci minha senha</a>
					<a href="<?= base_url()?>login/cadastrar/" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Ainda não sou cadastrado</a>
				</fieldset><br />
			</form>
		</div>
<?php }?>
</div>
