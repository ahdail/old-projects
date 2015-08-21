<?php checkSessao("CON.GRA")?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/dialog_box.css" />
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>site/js/dialog_box.js"></script>
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

function exibirDiv(id) {
	$("div[id^='div_']").hide();
	$("#div_"+id).show();
}
</script>
</head>
<body onload='document.forms[0].elements[0].focus();' >
<?php if (validation_errors()) {?>
<div class="msgErro"><?=validation_errors(); ?></div>
<?php } ?>
<form method="post" id="form1"  action="<?= base_url() ?>admin/consultoresclasse/manter">
	<div >
		<h1>CONSULTORIA - Cadastro de consultores</h1>
		<ul>
			<li>
				<label>Nome<span>*</span></label>
				<input type="text" class="campo" name="nome" value="<?=$row['nome']?>" /> 
			</li>
			<li>
				<label>Login (e-mail) <span>*</span></label>
				<input type="text" class="campo" name="email" value="<?=$row['email']?>" />
			</li>
			<li>
				<label>Senha<span>*</span></label>
				<input type="password" class="campo" name="senha"/>
			</li>
			<li>
				<label>Confirmar senha<span>*</span></label>
				<input type="password" class="campo" name="rsenha" />
			</li>
			<li>
				<label>Telefone</label>
				<input type="text" class="campo" name="fone" value="<?=$row['fone']?>" />
			</li>
			<li>
				<label style="width: 150px">Estado</label>
				<select type="text" name="estado" onchange='montaCidades(this.value);'>
					<option value="">Selecione um estado...</option>
					<?php foreach ($estados as $rowEstados) {?>
						<option value="<?=$rowEstados['sigla']?>" <?php if ($rowEstados['sigla'] == $row['estado']) echo "selected"; ?> > <?=$rowEstados['nome']?> </option>
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
				<label style="width: 150px">Cargo</label>
				<select type="text" name="idOcupacao">
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
			<li>
			<label>Autorizado</label>
					<input type="radio" name="consultor" value="2"  <?php if ($row['consultor'] == "2") {echo "checked=\"checked\""; } ?>> Sim
					<input type="radio" name="consultor" value="1" <?php if ($row['consultor'] == "1"  || $row['consultor'] == "") {echo "checked=\"checked\""; } ?>> Não
				</select>
			</li>
			<li>
			<label>Áreas de Interresse</label>
				<?php foreach ($temas as $rowTemas) {?>
					<label style="width: 100px"></label>
					<input type="checkbox" name="tema[]" value="<?=$rowTemas['id']?>" <?php //if()echo"checked=checked";?>><?= $rowTemas['tema']?><br />
				<?php }?>
			</li>
			<li><label>&nbsp;</label> 
				<input type="submit" value="Gravar" /> 
			</li>
		</ul>
	</div>
<input type="hidden" name="id" value="<?=$row['id']?>">
</form>
</body>
</html>