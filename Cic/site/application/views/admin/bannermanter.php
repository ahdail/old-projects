<?php 
// Exibir div nova janela e url
if ($row['tipo'] == 2 or !$row['tipo']) {
	$displayUrl = 'style="display:block;"';
} else {
	$displayUrl = 'style="display:none;"';
}

// Exibir div de ordenacao
if ($row['posicao'] == 1 or !$row['posicao']) {
	$displayUrl = 'style="display:block;"';
} else {
	$displayUrl = 'style="display:none;"';
}
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<script language="javascript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.min.js"></script>

<script type="text/javascript" language="JavaScript">
function mostraEscondeCamposPod() {
	if (document.getElementById('tipo').checked==true) {
		document.getElementById('novaJanela').style.display='block';
		document.getElementById('url').style.display='block';
		
	} else {
		document.getElementById('novaJanela').style.display='none';
		document.getElementById('url').style.display='none';
	}
}

function alternarOrdenacao(posicao) {
	if (posicao == 1) {
		$('#liOrdem').show();
	} else {
		$('#liOrdem').hide();
	}
}

function setLargAlt(larg,alt) {
	document.form1.largura.value=larg;
	document.form1.altura.value=alt;
}

function preencheTamanho(posicao) {
	// Exibe ou esconde a a ordenacao
	alternarOrdenacao(posicao);

	// Seta a largura e altura de acordo com a selecao
	switch(posicao) {
		case '1': //Lateral
			setLargAlt(130,130);
		break;

		case '2': // Rodapï¿½
			setLargAlt(100,70);
		break;

		case '3': // Exclusivo
			setLargAlt(240,80);
		break;
	}
}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php } ?>
<?php if ($erro) { ?>
<div class="msgErro"><?php echo $erro; ?></div>
<?php } ?>
<form method="post" id="form1" name="form1" action="<?php echo base_url()?>index.php/admin/banner/manter" enctype="multipart/form-data">
	<h1>CADASTRO DE BANNER</h1>
	<ul>
		<li>
			<label>Título<span >*</span></label>
				<input type="text" name="titulo" class="campoGd" value="<?php echo $row['titulo']?>">
		</li>
		<li>
			<label>Selecione arquivo<span>*</span></label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
		</li>
		<li>
			<label>Tipo<span>*</span></label>
				<input type="radio" name="tipo" id="tipo" value="2" <?php if ($row['tipo'] == 2 or !$row['tipo']) {echo "checked=\"checked\""; } ?> onclick="mostraEscondeCamposPod();">Imagem
				<input type="radio" name="tipo" id="tipo" value="1" <?php if ($row['tipo'] == 1) {echo "checked=\"checked\""; } ?> onclick="mostraEscondeCamposPod();">Flash
		</li>
		<li <?php echo $display ?> id="novaJanela">
			<?php 
			if ($row['novaJanela'] == "S") {
				$marcadoJanela = "checked=checked";
			} else {
				$marcadoJanela = "";
			}
			?>
			<label>Abrir em nova janela </label>
			<input type="checkbox" name="novaJanela"<?php echo $marcadoJanela?> value="S"> 
		</li>
		<li id="url" <?php echo $display ?>>
				<label>URL (http://...)</label>
				<input type="text" class="campo" name="url" size="35" value="<?php echo $row['url']?>">
		</li>
		<li>
			<label>Posição do banner<span>*</span></label>
			<select name="posicao" onchange="preencheTamanho(this.value)">
				<option value="1" <?php if($row['posicao'] == 1) echo "selected=selected"; ?>>1 - Lateral esquerda (130 x 130)</option>
				<option value="2" <?php if($row['posicao'] == 2) echo "selected=selected"; ?>>2 - Rodapé (100 x 70)</option>
				<option value="3" <?php if($row['posicao'] == 3) echo "selected=selected"; ?>>3 - Exclusivo (240 x 80)</option>
			</select>
		</li>
		<li id="liOrdem">
			<label>Ordem do banner<span>*</span></label>
			<select name="ordem">
				<option value="1" <?php if($row['ordem'] == 1) echo "selected=selected"; ?>>1</option>
				<option value="2" <?php if($row['ordem'] == 2) echo "selected=selected"; ?>>2</option>
				<option value="3" <?php if($row['ordem'] == 3) echo "selected=selected"; ?>>3</option>
			</select>
		</li>
		<li>
			<label>Largura<span >*</span></label>
				<input type="text" class="campoPeq" name="largura" maxlength="3" value="<?php echo ($row['largura']) ? $row['largura'] : "130"; ?>"> pixels
		</li>
		<li>
				<label>Altura<span>*</span></label>
				<input type="text" class="campoPeq" name="altura" maxlength="3" value="<?php echo ($row['altura']) ? $row['altura'] : "130"; ?>"> pixels
		</li>
			<li>
				<label>Exibir banner</label>
				<?php 
					if ($row['exibir'] == "S") {
						$marcadoExibir = "checked=checked";
					} else {
						$marcadoExibir = "";
					}
				?>
				<input type="checkbox" name="exibir"  <?php echo $marcadoExibir?> value="S" checked> 
			</li>
			<li>
				<label>Observação<span>*</span></label>

				<div style="clear:both; padding-left:10px; padding-top:10px;">
					<textarea id="obs" name="obs"  style="height: 80px; width: 570px;"><?php echo $row['obs']?></textarea>
				</div>
			</li>
		
		
		<li>
			<label>&nbsp;</label>
			<input type="submit" value="Gravar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?php echo $row['id']?>">
	<?php if($row['id']){?>
	<input type="hidden" name="acao" value="edit">
	<?php } else {?>
	<input type="hidden" name="acao" value="add">
	<?php }?>
</form>

</body>
</html>

