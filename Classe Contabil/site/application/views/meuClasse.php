<?php 
/*if (!$session_idUsuario || !$session_consultor){
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
}*/
?>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.textCounting.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?= base_url()?>site/js/jquery.limitTextarea.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/meuclasse.css" />

<script language='javascript'>
$(document).ready(function() {
	$('#nome').focus();
	$("#curriculo").textCounting();
});

var baseurl = '<?= base_url()?>';

function montaCidades(estado) {
	$('#divCidades').html("Carregando...");

	$.post(baseurl+'login/montarCidades/'+estado, '', function (retorno) {
		$('#divCidades').html(retorno);
	});
}

</script>
<script>
function abrirAba(qual) {
	// Esconde todos conteudos das abas
	document.getElementById('A').style.display='none';
	document.getElementById('B').style.display='none';
	document.getElementById('C').style.display='none';
	document.getElementById('D').style.display='none';
	document.getElementById('E').style.display='none';
	// Muda a cor de fundo das abas para cinza
	document.getElementById('abaA').style.background='#F0F0F0';
	document.getElementById('abaB').style.background='#F0F0F0';
	document.getElementById('abaC').style.background='#F0F0F0';
	document.getElementById('abaD').style.background='#F0F0F0';
	document.getElementById('abaE').style.background='#F0F0F0';
	// Coloca borda em baixo de todas as abas
	document.getElementById('abaA').style.borderBottom='1px solid #AAAAAA';
	document.getElementById('abaB').style.borderBottom='1px solid #AAAAAA';
	document.getElementById('abaC').style.borderBottom='1px solid #AAAAAA';
	document.getElementById('abaD').style.borderBottom='1px solid #AAAAAA';
	document.getElementById('abaE').style.borderBottom='1px solid #AAAAAA';
	
	// Cria o objeto a partir do ID
	aba = document.getElementById(qual);
	abaQual = 'aba'+qual;
	nomeAba = document.getElementById(abaQual);
	
	// Aplica as alterações
	aba.style.display='block';
	nomeAba.style.background='#FFFFFF';
	nomeAba.style.borderBottom='1px solid #FFFFFF';
}
</script>

<!-- CONTEï¿½DO -->
<div id="divConteudo">
<h1 class="titulo">Meu Classe</h1>
<div class="divisa"></div>

<h3><?= $row['nome']?></h3>

	<div class="abas">
		<ul class="nomeAbas">
			<li><a href="#" id="abaA" onclick="abrirAba('A')">Meus dados</a></li>
			<li><a href="#" id="abaB" onclick="abrirAba('B')">Perguntas</a></li>
			<li><a href="#" id="abaC" onclick="abrirAba('C')">Comentários</a></li>
			<li><a href="#" id="abaD" onclick="abrirAba('D')">Artigos</a></li>
			<li><a href="#" id="abaE" onclick="abrirAba('E')">Consultoria</a></li>
			<div class="matafloat"></div>
		</ul>
		<div id="A" class="aba_conteudo">
			<?php if ($session_consultor_autorizado == "S"){?>
			<form action="<?= base_url()?>consultores/atualizarDados/<?=$session_idConsultor?>" method="post" enctype="multipart/form-data">
			<?php } else {?>
			<form action="<?= base_url()?>usuarios/atualizarDados/<?=$row['id']?>" method="post" enctype="multipart/form-data">
			<?php } ?>
			<?php if (validation_errors()) { ?>
			<div class="msgErro" ><?=validation_errors(); ?></div>
			<?php
			} if ($ok){
				echo "<div class=\"msgOk\">".$ok."</div>";
			}
			if ($msg){
				echo "<div class=\"msgOk\">".$msg."</div>";
			}
			?>
			<input type="hidden" name="id" value="<?=$row['id']?>">
			<input type="hidden" name="emailCheck" value="<?=$row['email']?>">
			
				<?
				// Verifica se o usuário possui imagem
				if ($row['avatar'] and file_exists("site/avatar/{$row['avatar']}")) {
					$imagemSrc = base_url()."site/avatar/{$row['avatar']}";
				} else {
					$imagemSrc = base_url()."site/avatar/avatar.gif";
				}
		
				?>
				<img border="1" id="logo" class="dir" src="<?=$imagemSrc?>" width="80" height="80" alt="Portal da Classe Contábil" />
		
				<label style="width: 100px">Nome</label><input type="text" name="nome" value="<?=$row['nome']?>"><br />
				<label style="width: 100px">E-mail</label><input type="text" name="email" disabled="disabled" value="<?=$row['email']?>" /><br />
				<label style="width: 100px">Foto</label><input type="file" name="userfile"><br />
				<label style="width: 100px">Senha</label><input type="password" name="senha"><font style="font-size: 9px;font-style: italic"><?php if($row['senha']){echo" Se deseja manter a mesma senha, deixe o campo em branco";}?></font><br />
				<label style="width: 100px">Repita a senha</label><input type="password" name="rsenha"  value=""><br />
				<label style="width: 100px">Estado</label>
				<select type="text" name="estado">
					<option value="">Selecione um estado..</option>
					<?php foreach ($estados as $rowEstados) {?>
					<option value="<?=$rowEstados['sigla']?>" <?php if ($rowEstados['sigla'] == $row['estado']) { echo " selected=\"selected\" "; }?> > <?=$rowEstados['nome']?> </option>
					<?php }?>
				</select><br />
				<label style="width: 100px">Cidade *</label>
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
				<label style="width: 100px">Ocupação</label>
				<select type="text" name="ocupacao">
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
				<span>Curriculo resumido --</span><br />
				<textarea name="curriculo" id="curriculo" style="width: 100%; height: 200px" maxlength="300"><?=$row['curriculo'] ?></textarea>
				Cáracteres restantes: <span id="curriculoDown"></span>
				<br /><br />
				<input type="submit" value="Atualizar meus dados" class="dir">
		</form>
		<div class="matafloat"></div>
		<!-- Cadastro de artigo pelo Usuï¿½rio -->
		
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
	<div>
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
	  	</form>
	<div>
	-->
		</div>
		<div id="B" class="aba_conteudo">
			<ul class="listagem">
			<h2>Minhas Perguntas</h2>
				<?php
				if ($minhasPerguntas){
					foreach ($minhasPerguntas as $row) {
					?>
					<li style="padding: 10px;">
						<?php if ($row['tema'] != $temaAnterior){ ?>
							<h1><?= $row['tema']?></h1>
						<?php } ?>
						<p class="data"><?=sqlToDataHora($row['data'])?><br /><span style="color: #03497A">N&deg;: <?=$row['id']?></span><br />
						<? if ($row['totalRespostas'] > 0) { ?>
							<span style="color: red">(<?=$row['totalRespostas']?> resposta(s))</span>
						<? } else { ?>
							[Nenhuma resposta]
						<? } ?>
						</p>
						<p><a href="<?= base_url()?>consultoria/ver/<?= $row['id']?>/" title="Clique para respostas"><?= $row['pergunta']?></a></p>
						<?php
							$imagem = base_url()."site/img/arroba.gif";
							$img = "<img src=\"$imagem\" alt=\"@\" />"
						?>
						<p class="assinatura"><?=$row['nomeUsuario']?> - <?= str_replace('@', $img, $row['emailUsuario']); ?> - <?=$row['cidade']?> (<?=$row['estado']?>)</p>
					</li>
				<?php 
					$temaAnterior = $row['tema'];
					}
				} else {?>
					<h3>Nenhuma pergunta.</h3>
				<?php }?>
			</ul>
		</div>
		<div id="C" class="aba_conteudo">
			<ul class="listagem">
				<h2>Artigos Comentados</h2>
				<?php
				if ($meusComentarios){
					foreach ($meusComentarios as $row) {
					?>
					<li style="padding: 10px;">
					<p><?= $row['comentario']?> <a href="<?= base_url()?>artigos/ver/<?= $row['idArtigo']?>/" title="Clique para ver artigo" ><span style="font-size: 10px;">[ler artigo comentado]</span></a></p>
				</li>
			<?php }
				}else{?>
				<h3>Nenhum comentário.</h3>
				<?}?>
			</ul>	
		</div>
<?php //if ($session_consultor == 2){?>
		<div id="D" class="aba_conteudo">
			<ul class="listagem">
				<h2>Artigos Publicados</h2>
				<?php
				if ($meusArtigos){
					foreach ($meusArtigos as $row) {
				?>
				<li style="padding: 10px;">
					<h3><?= $row['titulo']?></h3>
					<p class="data"><?=sqlToDate($row['data'])?><br /><span style="color: #03497A">Artigo N&deg;: <?=$row['id']?></span><br />
						<? if ($row['acesso'] > 0) { ?>
							<span style="color: red">(<?=$row['acesso']?> acesso(s))</span>
						<? } else { ?>
							[Nenhuma Acesso]
						<? } ?>
					</p>
					<p><a href="<?= base_url()?>artigos/ver/<?= $row['id']?>/" title="Clique para ver artigo" ><?= $row['resumo']?></a></p>
				</li>
			<?php }
				}else{?>
				<h3>Nenhum artigo publicado.</h3>
				<?}?>
			</ul>
		</div>

		<div id="E" class="aba_conteudo">
			<ul class="listagem">
				<h2>Resposta na Consultoria gratuita</h2>
				<?php
				if ($consultoria){
					foreach ($consultoria as $row) {
				?>
				<li style="padding: 10px;">
					<p class="data"><?=sqlToDataHora($row['data'])?><br /><span style="color: #03497A">Pergunta N&deg;: <?=$row['id']?></span><br /></p>
					<p style="font-size: 10px"><a href="<?= base_url()?>consutoria/ver/<?= $row['id']?>/" title="Clique para ver a pergunta" ><?= substr($row['resposta'], 0, 300)?>...</a></p>
				</li>
			<?php }
				}else{?>
				<h3>Nenhuma resposta na Consultoria Gratuita.</h3>
				<?}?>
			</ul>
		</div>
<?php //}?>			
	</div>	
</div>

