<?php header("Content-type: text/html; charset=ISO-8859-1"); ?>
<select type="text" name="cidade" style="width: 250px">
	<option value="">Selecione uma cidade</option>
	<?php foreach ($cidades as $rowCidades) {?>
		<option value="<?php echo $rowCidades['CODIGO']?>" <?php if ($rowCidades['CODIGO'] == $cidade) { echo " selected=\"selected\" "; }?> > <?php echo $rowCidades['NOME']?> </option>
	<?php }?>
</select>