<script language='javascript'>
$(document).ready(function() {
	$('#email').focus();
});
</script>
<div id="divConteudo">
	<h1 class="titulo">Meu Classe</h1>
	<div class="divisa"></div>
	<h3>Acesso Restrito - Esqueci minha senha</h3>
	<form action="<?php echo base_url()?>login/enviarSenha" method="post" id="formComentario">
	<?php if ($msg){?>
		<div class="msgErro"> <?php echo $msg?></div><br />
	<?php }?>
		<fieldset>
			<label>E-mail</label><input style="width: 250px" type="text" name="email" id="email">
			<input type="submit" value="Recuperar senha" class="">
		</fieldset>
	</form>
</div>
