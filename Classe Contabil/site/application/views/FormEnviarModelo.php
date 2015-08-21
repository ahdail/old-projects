<?php
header("Content-type: text/html; charset=ISO-8859-1");
if($mensagem){
	echo "<div class=\"msgOk\">$mensagem</div>";
}

if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } 
if ($erro) { ?>
<div><?=$erro; ?></div>
<?php } ?>
<label>Envie seu modelo de documento (contratos, atas, pareceres, aditivos, requerimentos etc.)</label><br /><br />
<label style="width: 120px">Título <span style="color: red; ">*</span></label><input style="width: 220px" type="text" name="nome" value="<?= $row['nome']?>"><br />
<label style="width: 120px">Selecione arquivo <span style="color: red; ">*</span></label>
<input style="width: 230px" type="file" name="userfile" size="20"  class="campo" /><br />
<span>Resumo</span><br>
<textarea style="width: 350px" name="resumo"><?= $row['resumo']?></textarea><br/ >
<input type="submit" value="Enviar" class="">