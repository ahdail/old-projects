<!-- CONTEÚDO -->
<div id="divConteudo">
	<h1 class="titulo">Anuncie no Classe</h1>
	<div class="divisa"></div><br />
	<form action="<?php echo base_url()?>anuncie/enviar" method="post">
	<?php if (validation_errors()) { ?>
	<div class="msgErro"><?php echo validation_errors(); ?></div>
	<?php }?>
	<?php if ($msg) { ?>
	<div class="msgOk"><?php echo $msg ?></div>
	<?php }?>
	<p>Entre em contato conosco e confira as vantagens e os benefícios de anunciar no Portal da Classe Contábil.</p>
	<p>Escolha uma das formas de contato abaixo:</p>
	<fieldset>
		<label style="width: 50px">Nome</label><input style="width: 300px" name="nome" value="<?php echo $row['nome']?>" type="text"><br />
		<label style="width: 50px">E-mail</label><input style="width: 300px" name="email" value="<?php echo $row['email']?>" type="text"><br />
		<label>Observação </label><br /><br />
		<textarea name="observacao" style="width: 100%; height: 80px"><?php echo $row['observacao']?></textarea><br /><br />
		<input type="submit" value="Enviar">
	</fieldset>
	
	</form>	
	<h3>Veja nossa proposta comercial</h3>
	<?php
	if ($modelo) {
		foreach ($modelo as $row){	
	?>
	<p><a href="<?php echo base_url()?>site/documentos/<?php echo $row['arquivo']?>" target="_blank"><?php echo $row['titulo']?></a>
	&nbsp;<img src="<?php echo base_url()?>site/img/down.png" border="0"></p>
	<?php 
		}
	}	
	?>
	<h3>Contato</h3>
	<address>
		Telefone: (85) 4005-1150 &nbsp;<img src="<?php echo base_url()?>site/img/icone_telefone.gif" border="0" /><br />
		E-mail: <a>comercial<img src="<?= base_url()?>site/img/arroba.gif" alt="@" border="0" />grupofortes.com.br</a> &nbsp;<img src="<?php echo base_url()?>site/img/icone_email.gif" border="0" /><br />
		Informações via <a href="skype:daysenialcantara?call">Skype</a> &nbsp;<img src="<?php echo base_url()?>site/img/skype.gif" border="0" />
	</address>
</div>
