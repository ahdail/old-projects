<?php
header("Content-type: text/html; charset=ISO-8859-1");

echo "<div class=\"msgOk\">$mensagem</div>";

if (validation_errors()) { ?>
<div id="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<ul>
	<li><label>Título do Artigo</label><input type="text" style="color: rgb(136, 136, 136); font-size: 10pt;width: 430px" name="titulo" value="<?=$titulo?>"></li>
	<li>Resumo<br>
		<textarea style="color: rgb(136, 136, 136); font-size: 10pt;height: 150px; width: 530px" name="resumo"><?=$resumo?></textarea>
	</li>
	<li>Artigo<br>
		<textarea style="color: rgb(136, 136, 136); font-size: 10pt;height: 150px; width: 530px" name="conteudo"><?=$conteudo?></textarea>
	</li>
	<li style="padding-left: 325px"><label>&nbsp;</label><input type="submit" value="Enviar para avaliação" class=""></li>
</ul>
