<?php header("Content-type: text/html; charset=ISO-8859-1"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } ?>
<?php if ($erro) { ?>
<div class="msgErro"><?php echo $erro; ?></div>
<?php } ?>
<input type="hidden" name="idPrograma" value="<?php echo $idPrograma?>">
<input type="hidden" name="idVideo" value="<?php echo $row['id']?>">
<h1>CADASTRO DE VIDEO</h1>
<ul>
	<li>
		<label>Arquivo FLV<span>*</span></label>
		<input type="file" name="userfile" size="20"/>&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
	</li>
	<li>
		<label>Parte<span>*</span></label>
			<select name="parte">
				<option value="1" <?php if ($row['parte'] == 1){echo "selected=\"selected\"";}?>>1ª</option>
				<option value="2" <?php if ($row['parte'] == 2){echo "selected=\"selected\"";}?>>2ª</option>
				<option value="3" <?php if ($row['parte'] == 3){echo "selected=\"selected\"";}?>>3ª</option>
				<option value="4" <?php if ($row['parte'] == 4){echo "selected=\"selected\"";}?>>4ª</option>
			</select>
	</li>
	<li>
		<label>Resumo<span>*</span></label>
		<textarea rows="5" cols="50" name="resumo"><?php echo $row['resumo'] ?></textarea>
	</li>
	<li>
		<label>&nbsp;</label>
		<input class="" type="submit" value="Gravar" />
	</li>
</ul>
