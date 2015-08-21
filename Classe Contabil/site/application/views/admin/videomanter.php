<?php checkSessao("MUL");?>
<html>
<head>
<title>Administraï¿½ï¿½o</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
<script language="javascript" type="text/javascript">
function mostraEscondeCampos() {
	if (document.getElementById('dtk').checked==true) {
		document.getElementById('ico').style.display='block';
	} else {
		document.getElementById('ico').style.display='none';
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
<form method="post" id="form1" name="form1" action="<?= base_url()?>index.php/admin/video/manter" enctype="multipart/form-data">
	<h1>CADASTRO DE VÍDEO</h1>
	<ul>
		<li>
			<label>Titulo<span >*</span></label>
				<input type="text" name="titulo" class="campoGd" value="<?=$row['titulo']?>">
		</li>
		<li>
			<label>Resumo<span >*</span></label>
			<textarea name="resumo" style="width: 300px;height: 120px" ><?=$row['resumo']?></textarea>
		</li>
		<li>
			<label>Selecione arquivo<span>*</span></label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se nï¿½o deseja alterar</font>";}?>
		</li>
			<li>
				<label>Opções:</label>
				<?php 
					if ($row['destaque'] == "S") {
						$destaque = "checked=checked";
						$display = " style=\"display:block;\" ";
					} else {
						$destaque= "";
						$display =  " style=\"display:none;\" ";
					}
					if ($row['exibir'] == "S") {
						$exibir = "checked=checked";
					} else {
						$exibir= "";
					}
				?>
				
				<input type="checkbox" name="exibir"  value="S" <?=$exibirPrincipal ?>><span style="font-size:12px;"> Exibir na Pág. Principal</span></br>
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

