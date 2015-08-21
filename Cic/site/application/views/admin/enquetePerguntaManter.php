<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?php echo validation_errors(); ?></div>
<?php }  ?>
<form method="post" action="<?php echo base_url() ?>admin/enquete/perguntaManter">
		<h1>CADASTRO DE PERGUNTA</h1>
		<ul>
			<li>
				<label>Pergunta <span>*</span></label>
				<input type="text" class="campoGd" name="pergunta" value="<?php echo $row['pergunta']?>" />
			</li>
				<label>Exibir Pág Principal</label>
				<?php 
					if ($row['exibir'] == "S") {
						$marcadoExibir = "checked=checked";
					} else {
						$marcadoExibir = "";
					}
				?>
				
				<input type="checkbox" name="exibir"  value="S" <?php echo $marcadoExibir?>></br>
			</li>
			<li>
				<label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
				<input type=reset value=Limpar class="" />
			</li>
		</ul>
<input type="hidden" name="id" value="<?php echo $row['id']?>">
</form>
</body>
</html>