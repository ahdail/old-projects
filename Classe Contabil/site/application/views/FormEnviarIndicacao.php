<?php
header("Content-type: text/html; charset=ISO-8859-1");

if ($mensagem) {
	echo "<div class=\"msgOk\">$mensagem</div>";
}

if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } 
if ($erro) { ?>
<div><?=$erro; ?></div>
<?php } ?>

<label style="width: 140px">Nome do Destinatário</label><input style="width: 200px" type="text" name="nome" value="<?= $nome?>"><br />
<label style="width: 140px">E-mail do Destinatário</label><input style="width: 200px" type="text" name="email" value="<?= $email?>"><br />
<span>Mensagem</span><br>
<textarea style="width: 350px" name="msg"><?= $msg?></textarea><br/ >
<input type="submit" value="Enviar" class="">