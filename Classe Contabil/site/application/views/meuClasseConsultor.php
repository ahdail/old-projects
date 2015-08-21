<script language="javascript">
var baseurl = '<?= base_url()?>';

function montaCidades(estado) {
	$('#divCidades').html("Carregando...");
	
	$.post(baseurl+'consultores/montarCidades/'+estado, '', function (retorno) {
		$('#divCidades').html(retorno);
	});
}
</script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/internas.css" />
<!-- CONTEï¿½DO -->
<div id="divConteudo">
<h1 class="titulo">Meu Classe - Área dos Consultores</h1>
<div class="divisa"></div>

<h3>Bem-vindo Consultor(a) <?= $row['nome']?></h3>
<?php if ($session_consultor_autorizado == "S"){?>
<form action="<?= base_url()?>consultores/atualizarDados/<?=$session_idConsultor?>" method="post" enctype="multipart/form-data">
<?php } else {?>
<form action="<?= base_url()?>usuarios/atualizarDados/<?=$row['id']?>" method="post" enctype="multipart/form-data">
<?php } ?>
<?php if (validation_errors()) { ?>
<div class="msgErro" ><?=validation_errors(); ?></div>
<?php 
} if ($ok){
	echo "<div class=\"msgOk\" align=\"center\" >".$ok."</div>";
}
if ($msg){
	echo "<div class=\"msgOk\" align=\"center\" >".$msg."</div>";
}
?>	
  


	<input type="hidden" name="id" value="<?=$row['id']?>">
	<input type="hidden" name="emailCheck" value="<?=$row['email']?>">
	<fieldset>
		<?
		// Verifica se o usuário possui imagem
		if ($row['avatar'] and file_exists("site/avatar/{$row['avatar']}")) {
			$imagemSrc = base_url()."site/avatar/{$row['avatar']}";
		} else {
			$imagemSrc = base_url()."site/avatar/avatar.gif";
		}
		
		?>
		<img border="1" id="logo" class="dir" src="<?=$imagemSrc?>" width="80px" height="80px" alt="Portal da Classe Contábil" />

		<label style="width: 100px">Nome</label><input type="text" style="width: 400px;" name="nome" value="<?=$row['nome']?>"><br />
		<label style="width: 100px">E-mail</label><input type="text" style="width: 300px;" name="email" disabled="disabled" value="<?=$row['email']?>" /><br />
		<label for="fone" style="width: 100px">Telefone</label><input type="text" name="fone" id="fone" maxlength="14" onkeypress="mascara(this,telefone)" value="<?=$row['fone']?>" /><br />
		<label style="width: 100px">Foto</label><input  type="file" name="userfile"><br />
		<label style="width: 100px">Senha</label><input type="password" name="senha"><font style="font-size: 9px;font-style: italic"><?php if($row['senha']){echo" Se deseja manter a mesma senha, deixe o campo em branco";}?></font><br />
		<label style="width: 100px">Repita a senha</label><input type="password" name="rsenha"  value=""><br />
		<label style="width: 100px">Estado</label>
		<select type="text" name="estado" onchange='montaCidades(this.value);'>
			<option value="">Selecione um estado..</option>
			<?php foreach ($estados as $rowEstados) {?>
			<option value="<?=$rowEstados['sigla']?>" <?php if ($rowEstados['sigla'] == $row['estado']) { echo " selected=\"selected\" "; }?> > <?=$rowEstados['nome']?> </option>
			<?php }?>
		</select><br />
		<label style="width: 100px">Cidade</label>
		<div id="divCidades"><?=$cidades?></div>
		<br />
		<label style="width: 100px">Ocupação</label>
		<select type="text" name="ocupacao"">
			<option value="">Selecione uma ocupação...</option>
			<?php foreach ($cargos as $rowCargos) {?>
			<option value="<?=$rowCargos['id'] ?>" <?php if($rowCargos['id'] == $row['idOcupacao']) { echo " selected=\"selected\" "; }?> ><?=$rowCargos['nome'] ?></option>
			<?php }?>
		</select><br />
		<?php if ($row['consultor'] == "N"){?>
		<label>Consultor</label>
			<input type="radio" name="consultor" value="S"  <?php if ($row['consultor'] == "S") {echo "checked=\"checked\""; } ?>> Sim
			<input type="radio" name="consultor" value="N" <?php if ($row['consultor'] == "N"  || $row['consultor'] == "") {echo "checked=\"checked\""; } ?>> Não
		<br /><br />
		<?php } ?>
		<span>Curriculo resumido</span><br />
		<textarea name="curriculo" style="width: 100%; height: 200px"><?=$row['curriculo'] ?></textarea>
		<input type="submit" value="Atualizar meus dados" class="dir">
	</fieldset>
</form>
  
	<!-- Cadastro de artigo pelo Usuï¿½rio -->
	<div>
		<!-- SCRIPT AJAX PARA OS CADASTRO DE ARTIGOS-->
		<script language="javascript" type="text/javascript">
		$(document).ready(function() { 
			var opcoes = {
				beforeSubmit: function () {
					$("#artigoForm").html("<p>Enviando...</p>");
				},
				success: function (retorno) {
					$("#artigoForm").html(retorno);
				}
			} 
			$('#formArtigo').ajaxForm(opcoes);
		});
		</script>
		<script>
		function mostrar() 
		{
			obj1 = document.getElementById("artigoForm");
			if (obj1.style.display=='block') {
				obj1.style.display='none';
			} else {
				obj1.style.display='block';
			}
		}
		</script>
<!--		
		<h2 style="padding-left: 10px;background: #00A38C; margin: 10px;color: #FFFFFF; cursor: pointer" onclick="javascript:mostrar();" >Meus Artigos</h2>
		<form action="<?= base_url()?>usuarios/enviarArtigo/<?=$row['id']?>" method="post" id="formArtigo">
		<input type="hidden" name="id" value="<?=$row['id']?>">
		<div id="artigoForm" style="background: #DDDDDD;" >
			<?php 
				echo $artigo;
			?>
		</div>
		<h1>Meus ï¿½ltimos artigos</h1>
		<div style="background: #EEEEEE">
			<ul>
				<li><label>10/10/2009 - A crise mudial - Aguardando liberaï¿½ï¿½o</label></li>
				<li><label>01/10/2009 - bla bla bla - Liberada</label></li>
				<li><label>25/12/2008 - A crise mudial - Aguardando liberaï¿½ï¿½o</label></li>
				<li><label>040/6/2008 - bla bla bla- Aguardando liberaï¿½ï¿½o</label></li>
			</ul>
		</div>
		</form>
-->	
	</div>	
</div>
