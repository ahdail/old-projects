<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.textCounting.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo base_url()?>site/js/jquery.limitTextarea.js"></script>

<script language='javascript'>
$(document).ready(function() {
	$('#nome').focus();
	$("#curriculo").textCounting().limitText();
});

var baseurl = '<?php echo base_url()?>';

function montaCidades(estado) {
	$('#divCidades').html("Carregando...");
	
	$.post(baseurl+'login/montarCidades/'+estado, '', function (retorno) {
		$('#divCidades').html(retorno);
	});
}

function exibirDiv(id) {
	$("div[id^='div_']").hide();
	$("#div_"+id).show();
}

</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
<!-- Foemulï¿½rio para cadastro de novos usuários -->
<div id="divConteudo">
	<h1 class="titulo">Meu Classe</h1>
	<div class="divisa"></div>
	<h3>Cadastro de Consultor</h3>
	
	<?php if (validation_errors()) { ?>
	<div class="msgErro"><?php echo validation_errors(); ?></div><br>
	<?php }?> 
	
	<?php if ($session_idUsuario) { ?>	
	<fieldset>
	<b>Sr(a). <?php echo $session_login?>,</b><br />
	<br />
    Ao preencher este cadastro, estará assumindo o compromisso de colaborar de forma voluntária e gratuita com respostas aos questionamentos e indagações dos usuários deste Portal, com artigos e matérias técnicas, bem como autorizando a publicação neste site e em todos os outros do <a href="http://www.grupofortes.com.br/" target="_blank">Grupo Fortes de Serviços</a>, sem ônus, do conteúdo de todas as suas manifestações, inclusive os dados pessoais e profissionais constantes neste cadastro.<br />
    <br />
    O Portal da Classe Contábil agradece e tem a honra de colaborar com a divulgação do seu currículo e de sua atividade profissional.<br />
    <br />
	</fieldset>
	<br />
	<form action="<?php echo base_url()?>login/inserirConsultor" method="post" id="formComentario">
		<fieldset>
			<span style="width: 150x;">Área de Interrese</span><br />
			<?php foreach ($temas as $rowTemas) {?>
				<label style="width: 100px"></label><input type="checkbox" name="tema[]" value="<?php echo $rowTemas['id'] ?>"><?php echo $rowTemas['tema']?><br />
			<?php }?>
			<br />
			<label style="width: 200px">Currículo Resumido</label>
			<textarea name="curriculo" id="curriculo" rows="10" cols="70" maxlength="300"><?php echo $row['curriculo']?></textarea><br />
			Caracteres restantes: <span id="curriculoDown"></span>
			<br /><br />
			<span id="star" style="font-size: 10px">* Todos os campos são obrigatórios</span></li>  
			<br /><br /><input type="submit" value="Cadastrar" class=""></li>
		</fieldset>
	</form>
	<?php
	} else {
	?>
	<fieldset>
	Já é um usuário cadastrado? 
	<input name="usuario" type="radio" value="1" onclick="exibirDiv('login');" /> Sim
	<input name="usuario" type="radio" value="0" onclick="exibirDiv('cadastro');" /> Não
	</fieldset>
	
	<br />
	
	<div id="div_login" style="display:none;">
		<form action="<?php echo base_url()?>login/validar/" method="post">
			<input type="hidden" value="login/cadastrarConsultor/" name="backTo">	
			<fieldset>
				<span>Por favor, digite os dados à baixo.</span><br /><br />
				<label style="width: 50px">E-mail</label><input type="text" name="email" value="<?php echo $email?>"><br />
				<label style="width: 50px">Senha</label><input type="password" name="senha"> 
				<input type="submit" value="Acessar" class=""><br />
				<label style="width: 50px">&nbsp;</label><a href="<?php echo base_url()?>login/esqueciMinhaSenha">Esqueci minha senha</a><br />
			</fieldset>
		</form>
	</div>
	
	<div id="div_cadastro" style="display:none;">
		<fieldset>
		<b>Sr. Consultor,</b><br />
		<br />
	    Ao preencher este cadastro, estará assumindo o compromisso de colaborar de forma voluntária e gratuita com respostas aos questionamentos e indagações dos usuários deste Portal, com artigos e matérias técnicas, bem como autorizando a publicação neste site e em todos os outros do <a href="http://www.grupofortes.com.br/" target="_blank">Grupo Fortes de Serviços</a>, sem ônus, do conteúdo de todas as suas manifestações, inclusive os dados pessoais e profissionais constantes neste cadastro.<br />
	    <br />
	    O Portal da Classe Contábil agradece e tem a honra de colaborar com a divulgação do seu currículo e de sua atividade profissional.<br />
	    <br />
		</fieldset>
		<br />
	
		<form action="<?php echo base_url()?>login/inserirUsuario" method="post" id="formComentario">
		<input type="hidden" value="1" name="consultor">	
		<fieldset>
		<label style="width: 100px;">Nome</label><input type="text" style="width: 450px" name="nome" id="nome" value="<?php echo $row['nome']?>"><br />
		<label style="width: 100px;">E-mail</label><input type="text" style="width: 450px" name="email" value="<?php echo $row['email']?>"><br />
		<label style="width: 100px;">Senha</label><input type="password" style="width: 150px" name="senha"><br />
		<label style="width: 100px;">Repita a senha</label><input type="password" style="width: 150px" name="rsenha"><br />
		<label style="width: 100px">Telefone</label><input type="text" name="fone" id="fone" style="width: 150px" maxlength="14" onkeypress="mascara(this,telefone)" value="<?php echo $row['fone']?>" /><br />
		<label style="width: 100px">Estado</label>
		<select type="text" name="estado" onchange='montaCidades(this.value);'>
			<option value="">Selecione um estado...</option>
			<?php foreach ($estados as $rowEstados) {?>
				<option value="<?php echo $rowEstados['sigla']?>" <?php if ($rowEstados['sigla'] == $row['estado']) { echo " selected=\"selected\" "; }?> > <?php echo $rowEstados['nome']?> </option>
			<?php }?>
		</select><br />
		<label style="width: 100px">Cidade</label>
		<div id="divCidades" style="height: 25px">
		<select type="text" >
			<option value="">Selecione um estado primeiro...</option>
		</select>
		
		</div>
		
		<label style="width: 100px">Ocupação</label>
		<select type="text" name="ocupacao">
			<option value="">Selecione uma ocupação...</option>
		<?php foreach ($cargos as $rowCargos) {?>
			<option value="<?php echo $rowCargos['id'] ?>" <?php if($rowCargos['id'] == $row['idOcupacao']) { echo " selected=\"selected\" "; }?> ><?=$rowCargos['nome'] ?></option>
		<?php }?>
		</select><br /><br />
		
		<span style="width: 150x;">Área de Interrese</span><br />
		<?php foreach ($temas as $rowTemas) {?>
			<label style="width: 100px"></label>
			<input type="checkbox" name="tema[]" value="<?php echo $rowTemas['id']?>"><?php echo $rowTemas['tema']?><br />
		<?php }?>
		<label style="width: 200px">Currículo Resumido</label>
		<textarea name="curriculo" id="curriculo" rows="10" cols="70" maxlength="300"><?php echo $row['curriculo']?></textarea><br />
		Caracteres restantes: <span id="curriculoDown"></span>  
		<br /><br />
		
		<span id="star" style="font-size: 10px">Todos os campos com * são obrigatórios</span></li>
		<br /><br /><input type="submit" value="Cadastrar" class=""></li>
		</fieldset>
		</form>
	</div>
	<?php 
	}
	?>
	
</div>
