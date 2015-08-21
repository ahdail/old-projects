<?php 
checkSessao("TRAB");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="JavaScript" type="text/javascript" src="wysiwyg.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias pré configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');

var oEdit2 = new preparaEditor('oEdit2');

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
<form method="post" id="form1" name="form1" action="<?= base_url()?>index.php/admin/trabalho/manter" enctype="multipart/form-data">
	<h1>CADASTRO DE TRABALHOS ACADÊMICOS</h1>
	<ul>
		<li>
			<label>Titulo<span >*</span></label>
			<input type="text" name="titulo" id="titulo" value="<?=$row['titulo']?>" class="campo">
		</li>
		<li>
				<label>Resumo <span>*</span></label>
				<textarea id="resumo" name="resumo" class="campo"><?=$row['resumo']?></textarea>
			</li>
		<li>
			<label>Selecione arquivo<span>*</span></label>
			<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){echo "<font size=1px>Deixe em branco se não deseja alterar</font>";}?>
		</li>
		</li>
				<?php if ($row['arquivo']) {
					$arquivo = base_url()."site/trabalhos/".$row['arquivo'];
				?>
				<li>
					<label>&nbsp;</label>[<a href="<?=$arquivo?>">ver arquivo</a>]<br />
				</li>
				<?php }?>
		<li>
			<label>Tipo<span>*</span></label>
					<input type="radio" name="tipo" id="tipo" value="1"  <?php if ($row['tipo'] == 1 || $row['tipo'] == "") {echo "checked=\"checked\""; } ?>><img src="<?= base_url()?>site/trabalhos/icon/doc.gif">
					<input type="radio" name="tipo" value="2" <?php if ($row['tipo'] == 2) {echo "checked=\"checked\""; } ?>><img src="<?= base_url()?>site/trabalhos/icon/pdf.gif">
				</select>
		</li>
		<li>
			<label>Autor<span >*</span></label>
				<textarea rows="" cols="30" name="autor"><?=$row['autor']?></textarea>
		</li>
		<li>
				<label>Orientador<span>*</span></label>
				<textarea rows="" cols="30" name="orientador"><?=$row['orientador']?></textarea>
		</li>
		<li>
			<label>Autorizar publicação?</label>
			<input type="radio" name="autorizado" id="autorizado" value="S" <?php if ($row['autorizado'] == "S") {echo "checked=\"checked\""; } ?>>Sim
			<input type="radio" name="autorizado" id="autorizado" value="N" <?php if ($row['autorizado'] == "N") {echo "checked=\"checked\""; } ?>>Não
			<?php 
				if($row['autorizado'] == "A"){
					echo "&nbsp;&nbsp;&nbsp;[Agurdando Autorização]";
				}
			?>
		</li>
		<li>
			<label>&nbsp;</label>
			<input class="botao" type="submit" value="Gravar" />
			<input class="botao" type="reset" value="Limpar" />
		</li>
	</ul>
	<input type="hidden" name="email" value="<?=$row['email']?>">
	<input type="hidden" name="nome" value="<?=$row['nome']?>">
	<input type="hidden" name="id" value="<?=$row['id']?>">
</form>

</body>
</html>

