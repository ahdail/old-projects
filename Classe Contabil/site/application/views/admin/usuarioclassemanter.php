<?php checkSessao("USER")?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/dialog_box.css" />

<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/dialog_box.js"></script>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.textCounting.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.limitTextarea.js"></script>

<script language='javascript'>
$(document).ready(function() {
	$('#nome').focus();
	$("#curriculo").textCounting();
});

var baseurl = '<?= base_url()?>';

function montaCidades(estado) {
	$('#divCidades').html("Carregando...");
	
	$.post(baseurl+'admin/consultoresclasse/montarCidades/'+estado, '', function (retorno) {
		$('#divCidades').html(retorno);
	});
}
</script>

</head>
<body>
<?php if (validation_errors()) {?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<form method="post" id="form1"  action="<?= base_url() ?>admin/usuariosClasse/manter">
	<div>
		<h1>MEU CLASSE - Cadastro de Usuários</h1>
		<ul>
			<li>
				<label>Nome<span>*</span></label>
				<input type="text" class="campo" name="nome" id="nome" value="<?=$row['nome']?>" />
			</li>
			
			<li>
				<label>Login (e-mail) <span>*</span></label>
				<input type="text" class="campo" name="email" value="<?=$row['email']?>" />
			</li>
			<li>
				<label style="width: 150px">Estado</label>
				<select type="text" name="estado">
					<option value="">Selecione um estado..</option>
					<?php foreach ($estados as $rowEstados) {?>
						<option value="<?=$rowEstados['sigla']?>" <?php if ($rowEstados['sigla'] == $row['estado']) { echo " selected=\"selected\" "; }?> > <?=$rowEstados['nome']?> </option>
					<?php }?>
				</select>
			</li>
			
			<li>
				<label style="width: 150px">Cidade</label>
				<div id="divCidades" style="height: 25px">
					<?php 
					if ($cidades) {
						echo $cidades;
					} else {
						?>
						<select type="text" >
							<option value="">Selecione um estado primeiro...</option>
						</select>
						<?
					}
					?>
				</div>
			</li>
			
			<li>
				<label style="width: 150px">Ocupação</label>
				<select type="text" name="idOcupacao"">
						<option value="">Selecione uma ocupação...</option>
					<?php foreach ($cargos as $rowCargos) {?>
						<option value="<?=$rowCargos['id'] ?>" <?php if($rowCargos['id'] == $row['idOcupacao']) { echo " selected=\"selected\" "; }?> ><?=$rowCargos['nome'] ?></option>
					<?php }?>
				</select>
			</li>
			<li>
				<label>Curriculo resumido</label><br />
				<textarea name="curriculo" id="curriculo" rows="10" cols="70" maxlength="300"><?=$row['curriculo']?></textarea><br />
				Caracteres restantes: <span id="curriculoDown"></span>  
			</li>
			<!--  
			<li>
			<label>Consultor</label>
					<input type="radio" name="consultor" value="S"  <?php if ($row['consultor'] == "S") {echo "checked=\"checked\""; } ?>> Sim
					<input type="radio" name="consultor" value="N" <?php if ($row['consultor'] == "N"  || $row['consultor'] == "") {echo "checked=\"checked\""; } ?>> Não
				</select>
			</li>
			<li>
			<label>Autorizado</label>
					<input type="radio" name="autorizado" value="S"  <?php if ($row['autorizado'] == "S") {echo "checked=\"checked\""; } ?>> Sim
					<input type="radio" name="autorizado" value="N" <?php if ($row['autorizado'] == "N"  || $row['autorizado'] == "") {echo "checked=\"checked\""; } ?>> Não
				</select>
			</li>
			-->
			<li><label>&nbsp;</label> 
				<input type="submit" value="Gravar" /> 
			</li>
		</ul>
	</div>
<input type="hidden" name="id" value="<?=$row['id']?>">
</form>
</body>
</html>