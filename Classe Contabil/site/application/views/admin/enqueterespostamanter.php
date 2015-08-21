<?php 
checkSessao("ENQ");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<body onload='document.forms[0].elements[0].focus();'>
<?php if (validation_errors()) { ?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php }  ?>
<form method="post" action="<?= base_url() ?>admin/enquete/respostaManter">
		<h1>CADASTRO DE RESPOSTA</h1>
		<ul>
			<li>
				<label>Pergunta <span>*</span></label>
				<select name="idPergunta">
				<?php foreach ($enqueteResposta as $rowPergunta) {
						if ($rowPergunta['id'] == $idPergunta){
							$selecionado = " selected=\"selected\" ";
						} else {
							$selecionado = "";
						}
				?>
					<option value="<?=$rowPergunta['id']?>" <?=$selecionado ?>><?=$rowPergunta['pergunta']?></option>
				<?php }?>
				</select>
			</li>
			<li>
				<label>Resposta <span>*</span></label>
				<textarea rows="1" cols="50" name="resposta" ><?=$row['resposta']?></textarea>
			</li>
			<li>
				<label>&nbsp;</label> 
				<input type=submit value=Gravar class="" /> 
				<input type=reset value=Limpar class="" />
			</li>
		</ul>
<input type="hidden" name="id" value="<?=$row['id']?>">
</form>
</body>
</html>