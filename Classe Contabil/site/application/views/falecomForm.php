<!-- CONTEï¿½DO -->
<div id="divConteudo">
	<h1 class="titulo">Fale Conosco</h1>
	<div class="divisa"></div><br />
		<form action="<?php echo base_url()?>falecom/enviar" method="post">
		<?php if (validation_errors()) { ?>
		<div class="msgErro"><?php echo validation_errors(); ?></div>
		<?php }?>
		<?php if ($msg) { ?>
		<div class="msgOk"><?php echo $msg ?></div>
		<?php }?>
		<p>Para enviar sugestões ou críticas para o Portal da Classe Contábil, preencha o formulário abaixo:</p>
			<fieldset>
				<label style="width: 100px">Nome</label><input style="width: 270px" name="nome" value="<?php echo $row['nome']?>" type="text">
				<label style="width: 100px">E-mail</label><input style="width: 270px" name="email" value="<?php echo $row['email']?>" type="text">
				<label style="width: 100px">Mensagem</label><br /><br />
				<textarea name="mensagem" rows="7" cols="50" ><?php echo $row['mensagem']?></textarea><br /><br />
				<label style="width: 100px">&nbsp;</label><input type="submit" value="Enviar">
			</fieldset>
		</form>	
</div>
