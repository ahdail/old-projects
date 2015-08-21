<?php
header("Content-type: text/html; charset=ISO-8859-1");

if ($mensagem) {
	echo "<div class=\"msgOk\">$mensagem</div>";
} ?>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<span>Comentário</span><br />
<textarea name="comentario" style="width: 400px;height: 100px; "><?= $comentario?></textarea><br />
<input type="submit" value="Enviar" />
