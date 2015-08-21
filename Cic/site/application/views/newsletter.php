<? include "inicio.inc.php" ?>
<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO > TIRA DA ESQUERDA -->
	<div>
		<h1>Newsletter </h1>
		<h2><b>Receba nossos Informativos</b></h2>
		<?php if (validation_errors()) { ?>
		<div class="msgErro"><?=validation_errors(); ?></div><br>
			<form action="<?= base_url()?>newsletter/cadastrar" method="post">
				<label class="esq" for="nome">Nome</label><br>
				<div id="input" class="camposNewsletter"><span><input name="nome" value="<?=$_POST['nome']?>" type="text" style="width: 250px" /></span></div>
				<label class="esq" for="email">E-mail</label><br>
				<div id="input" class="camposNewsletter"><span><input name="email" value="<?=$_POST['email']?>" type="text" style="width: 250px" /></span></div>
				<label class="esq info">Informe seu nome e e-mail e receba periodicamente informações do CIC</label><br><br>
				<input class="dir" style="margin: -18px 50px" type="image" src="<?= base_url() ?>site/img/enviar.gif" />
			</form>
		<?php } else { ?>
			<div class="msgOk"><?=$msg?></div>
		<?php } ?>
	</div>
</div>

<? include "final.inc.php" ?>