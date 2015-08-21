<?php 
checkSessao("NOT");
?>
<div >
	
	<?php
		if ($linha['linha'] == "S") {
	?>
		<div class="msgErro">Tag já cadastrada.</div>
	<?php } if (validation_errors()) { ?>

			<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
</div>
<li>
	<label>Outras:</label>
</li><br>
<div style="overflow:scroll; height:200px;">
<li>	
	<? foreach($row as $row): ?>
	<input type="checkbox" name="tags_<?=$row['id']?>" <? if ($row['marcado'] or ($row['id'] == $idTag)) echo 'checked'; ?> value="<?=$row['id']?>">
	<span style="font-size:12px;"><?=$row['tag']?></span><br>
	<? endforeach; ?>
</li>
</div>
<li>
	<label>Nova Tag</label>
	<input type="text" class="campo" id="tag" name="tag" value="" />&nbsp;<input type="button" value="Gravar" onclick="cadastraTag();" /> 
</li>