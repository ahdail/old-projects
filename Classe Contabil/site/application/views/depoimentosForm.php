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
<span>Escreva aqui seu depoimento</span><br>
<textarea rows="5" cols="35" name="depoimento"><?= $depoimento?></textarea><br/ >
<input type="submit" value="Enviar" class="">