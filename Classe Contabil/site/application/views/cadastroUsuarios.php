<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.textCounting.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.limitTextarea.js"></script>

<script language='javascript'>
$(document).ready(function() {
	$('#nome').focus();
	$("#curriculo").textCounting();
});

var baseurl = '<?php echo base_url()?>';

function montaCidades(estado) {
	$('#divCidades').html("Carregando...");
	
	$.post(baseurl+'login/montarCidades/'+estado, '', function (retorno) {
		$('#divCidades').html(retorno);
	});
}

</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
<!-- Foemulï¿½rio para cadastro de novos usuï¿½rios -->
<div id="divConteudo">
	<h1 class="titulo">Meu Classe</h1>
	<div class="divisa"></div>
	<h3>Cadastro de Usuários</h3>
	<form action="<?php echo base_url()?>login/inserirUsuario" method="post" id="formComentario">
	<?php if (validation_errors()) { ?>
	<div class="msgErro"><?php echo validation_errors(); ?></div>
	<?php }?> 
		<fieldset>
		<label style="width: 110px;">Nome *</label><input type="text" style="width: 300px" name="nome" id="nome" value="<?php echo $row['nome']?>"><br />
		<label style="width: 110px;">E-mail *</label><input type="text" style="width: 300px" name="email" value="<?php echo $row['email']?>"><br />
		<label style="width: 110px;">Senha *</label><input type="password" style="width: 150px" name="senha"><br />
		<label style="width: 110px;">Repita a senha *</label><input type="password" style="width: 150px" name="rsenha"><br />
		<label style="width: 110px">Telefone</label><input type="text" name="telefone" id="fone" style="width: 150px" maxlength="14" onkeypress="mascara(this,telefone)" value="<?php echo $row['fone']?>" /><br />
		<label style="width: 110px">Estado *</label>
		<select type="text" name="estado" onchange='montaCidades(this.value);' style="width: 250px">
				<option value="">Selecione um estado</option>
			<?php foreach ($estados as $rowEstados) {?>
				<option value="<?php echo $rowEstados['sigla']?>" <?php if ($rowEstados['sigla'] == $row['estado']) echo "selected"; ?> > <?php echo $rowEstados['nome']?> </option>
			<?php }?>
		</select><br />
		<label style="width: 110px">Cidade *</label>
		<div id="divCidades" style="height: 25px">
		<?php 
		if ($cidades) {
			echo $cidades;
		} else {
			?>
			<select type="text" style="width: 250px">
				<option value="">Selecione um estado primeiro</option>
			</select>
			<?php
		}
		?>
		</div>
		<label style="width: 110px">Ocupação *</label>
		<select type="text" name="ocupacao" style="width: 250px">
		<option value="">Selecione uma ocupação</option>
		<?php foreach ($cargos as $rowCargos) {?>
			<option value="<?php echo $rowCargos['id'] ?>" <?php if($rowCargos['id'] == $this->input->post('ocupacao')) echo "selected"; ?> ><?php echo $rowCargos['nome'] ?></option>
		<?php }?>
		</select><br /><br />
	
			<div id="div_interesses" <?=($row['consultor'])? "style='display: block'" : "style='display: none'" ?>>
			<span style="width: 150x;">Área de Interrese</span><br />
			<?php
			$postTemas = ($row['tema']) ? $row['tema'] : array();
			
			foreach ($temas as $rowTemas) {
			?>
				<label style="width: 100px"></label>
				<input type="checkbox" name="tema[]" value="<?php echo $rowTemas['id']?>" <?php if (in_array($rowTemas['id'], $postTemas)) echo "checked"; ?>><?php echo $rowTemas['tema']?><br />
			<?php }?>
			<br />
		</div>	
		
		<?php if ($row['curriculo']) { ?>
			<label style="width: 200px">Currículo Resumido</label>
			<textarea name="curriculo" id="curriculo" rows="10" cols="70" maxlength="300"><?php echo $row['curriculo']?></textarea><br />
			Cáracteres restantes: <span id="curriculoDown"></span>  
			<br /><br />
		<?php } ?>
		
		<span id="star" style="font-size: 10px">Todos os campos com * são obrigatórios</span></li>
		<br /><br /><input type="submit" value="Cadastrar" class=""></li>
		</fieldset>
		<?php if($row['consultor']) { ?>
		<input type="hidden" name="consultor" value="1">
		<?php } ?>
		</form>
</div>
