<?php 
checkSessao("BAN");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
<script type="text/javascript" language="JavaScript">
		function mostraEscondeCamposPod() {
			if (document.getElementById('tipo2').checked==true) {
				document.getElementById('novaJanela').style.display='block';
				document.getElementById('url').style.display='block';
				
			} else {
				document.getElementById('novaJanela').style.display='none';
				document.getElementById('url').style.display='none';
			}
		}
		function setLargAlt(larg,alt) {
			document.form1.largura.value=larg;
			document.form1.altura.value=alt;
		}

		function verificaValor(valor){
			if (valor == 2){
				document.getElementById('posicao').style.display='block';
			} else {
				document.getElementById('posicao').style.display='none';
			}
		}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<?php if ($error) { ?>
<div class="msgErro"><?=$error; ?></div>
<?php } ?>
<form method="post" id="form1" name="form1" action="<?= base_url()?>index.php/admin/banner/manter" enctype="multipart/form-data">
	<h1>CADASTRO DE BANNER</h1>
	<ul>
		<li>
			<label>Titulo<span >*</span></label>
				<input type="text" name="titulo" class="campoGd" value="<?=$row['titulo']?>">
		</li>
		<li>
			<label>Selecione arquivo<span>*</span></label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
		</li>
		<li>
			<label>Tipo<span>*</span></label>
			<input type="radio" name="tipo" id="tipo2" value="2"  <?php if ($row['tipo'] == 2) {echo "checked=\"checked\""; } ?> onclick="mostraEscondeCamposPod();verificaValor(this.value);" >Imagem
			<input type="radio" name="tipo" id="tipo1"  value="1" <?php if ($row['tipo'] != 2) {echo "checked=\"checked\""; } ?> onclick="mostraEscondeCamposPod();verificaValor(this.value);">Flash
		</li>
		<?php 
				if ($row['tipo'] == 2) {
					$display = " style=\"display:block;\" ";
				} else {
					$display =  " style=\"display:none;\" ";
				}
				
			?>
		<li <?=$display ?> id="novaJanela">
		<?php 
		if ($row['novaJanela'] == "S") {
			$marcadoJanela = "checked=checked";
		} else {
			$marcadoJanela = "";
		}
		?>
		<label>Abrir em nova janela </label>
		<input type="checkbox" name="novaJanela"<?=$marcadoJanela?> value="S"> 
		</li>
		<li id="url" <?=$display ?>>
				<label>URL (http://...)</label>
				<input type="text" class="campo" name="url" size="35" value="<?=$row['url']?>">
		</li>
		<li>
			<label>Posição do banner<span>*</span></label>
			<img src="<?= base_url()?>site/img/admin/bannersEscolher.gif" width="190" height="114" border="0" usemap="#inicial" />
			<map name="inicial" id="inicial">
				<area shape="rect" coords="1,0,79,23" href="#" alt="Inicial" onclick="document.form1.posicao.value=1;setLargAlt(770,94)" />
				<area shape="rect" coords="150,1,189,23" href="#" alt="Loja" onclick="document.form1.posicao.value=2;setLargAlt(192,95)" />
				<area shape="rect" coords="158,92,184,113" href="#" alt="Direita inferior" onclick="document.form1.posicao.value=3;setLargAlt(150,165)" />
				<area shape="rect" coords="78,2,148,23" href="#" alt="Interno" onclick="document.form1.posicao.value=4;setLargAlt(770,94)" />
			</map>
			<br />
			<label></label>
			<select name="posicao">
				<option value="1" <?php if($row['posicao'] == 1 ){ echo "selected=selected"; }?> onclick="setLargAlt(770,94)">1 - Inicial (770 x 94)</option>
				<option value="2" <?php if($row['posicao'] == 2 ){ echo "selected=selected"; }?> onclick="setLargAlt(192,95)">2 - Loja (192 x 95)</option>
				<option value="3" <?php if($row['posicao'] == 3 ){ echo "selected=selected"; }?> onclick="setLargAlt(150,165)">3 - Direita inferior (150 x 165)</option>
				<option value="4" <?php if($row['posicao'] == 4 ){ echo "selected=selected"; }?> onclick="setLargAlt(770,94)">4 - Interno (770 x 94)</option>
				<option value="5"  id="posicao" style="display: none;" <?php if($row['posicao'] == 5 ){ echo "selected=selected"; }?> onclick="setLargAlt(500,60)">5 - Boletim (500 x 60)</option>
			</select>
		</li>
		<li>
			<label>Largura<span >*</span></label>
				<input type="text" class="campoPeq" name="largura" maxlength="3" value="<?=$row['largura']?>"> pixels
		</li>
		<li>
				<label>Altura<span>*</span></label>
				<input type="text" class="campoPeq" name="altura" maxlength="3" value="<?=$row['altura']?>"> pixels
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
				<input type="checkbox" name="exibir"  <?=$marcadoExibir?> value="S" checked> 
			</li>
			<li>
				<label>Observação<span>*</span></label>

				<div style="clear:both; padding-left:10px; padding-top:10px;">
					<textarea id="obs" name="obs"  style="height: 80px; width: 570px;"><?=$row['obs']?></textarea>
				</div>
			</li>
		
		
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
			<input class="botao" type="reset" value="Limpar" />
		</li>
	</ul>
	<input type="hidden" name="id" value="<?=$row['id']?>">
</form>

</body>
</html>

