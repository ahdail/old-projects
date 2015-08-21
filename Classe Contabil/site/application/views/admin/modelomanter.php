<?php checkSessao("MODEL");?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" href="<?= base_url()?>site/js/calendario/calender.css" type="text/css">
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/calendario/calender_date_picker.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/innovaeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?= base_url()?>site/js/wysiwyg/scripts/preconfigs.js"></script>
<script language="javascript" type="text/javascript">
// Cria as instancias pré configuradas para o editor
var oEdit1 = new preparaEditor('oEdit1');
var oEdit2 = new preparaEditor('oEdit2');
</script>
</head>
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php }  ?>
	<form method="post" action="<?= base_url() ?>admin/modelo/manter" enctype="multipart/form-data">
			<h1>CADASTRO DE MODELO CONTRATO</h1>
			<ul>
				<li>
					<label>Título <span>*</span></label>
					<input type="text" name="titulo" id="titulo" value="<?=$row['titulo']?>" class="campo">
				</li>
				<li>
					<label>Modelo <span>*</span></label>
					<textarea id="conteudo" name="modelo" class="campo"><?=$row['modelo']?></textarea>
					<script language="javascript1.2">oEdit2.REPLACE("conteudo");</script>
				</li>
				<li>
					<label>Exibir na seção:</label>
					<input type="radio" name="exibir" id="exibir" value="1" <?php if ($row['exibir'] == 1) {echo "checked=\"checked\""; } ?>> Modelos de Contratos<br/>
					<label>&nbsp;</label>
					<input type="radio" name="exibir" id="exibir" value="2" <?php if ($row['exibir'] == 2) {echo "checked=\"checked\""; } ?>> Anuncie no Classe
				</li>
				<li>
					<label>Selecione o arquivo</label>
					<input type="file" name="userfile" size="20"  class="campo" />&nbsp;&nbsp;<?php if ($row['id']){?><font size="1px">Deixe em branco se não deseja alterar</font><?php }?>
				</li>
				<?php if ($row['arquivo']) {
					$arquivo = base_url()."site/documentos/".$row['arquivo'];
				?>
				<li>
					<label>&nbsp;</label>[<a href="<?=$arquivo?>">ver arquivo</a>]<br />
				</li>
				<?php }?>
				<li>
					<label>Autorizar publicação?</label>
					<input type="radio" name="aut" id="aut" value="S" <?php if ($row['autorizado'] == "S" || $row['autorizado'] == "") {echo "checked=\"checked\""; } ?>>Sim
					<input type="radio" name="aut" id="aut" value="N" <?php if ($row['autorizado'] == "N") {echo "checked=\"checked\""; } ?>>Não
					<?php 
						if($row['autorizado'] == "A"){
							echo "&nbsp;&nbsp;&nbsp;[Aguardando Autorização]";
						}
					?>
				</li>
				<li>
					<label>&nbsp;</label> 
					<input type="submit" value="Gravar" /> 
				</li>
			</ul>
		<input type="hidden" name="id" value="<?=$row['id']?>">
		<input type="hidden" name="email" value="<?=$row['emailrem']?>">
		<input type="hidden" name="nome" value="<?=$row['nomerem']?>">
	</form>
</body>
</html>