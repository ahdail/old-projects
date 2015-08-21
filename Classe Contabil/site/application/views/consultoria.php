<?
// Se o usuario estiver logado ele poderá fazer pergunta,
// senão, será redirecionado para fazer o login no sistema e depois retornará para perguntar.
if (!$session_idUsuario){
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
}

/*if (!$session_email){
	$backTo = array('backTo' => uri_string());
	$this->session->set_userdata($backTo);
	$linkComentarTopo = "#ancoraComentar";
	//redirect('login', 'location');
}*/

?>
<!-- CONTEUDO -->
<script type="text/javascript" language="javascript">
	function mostrar() {
		obj1 = document.getElementById("fild1");
		if (obj1.style.display=='none') {
			obj1.style.display='block';
		} else {
			obj1.style.display='none';
		}
	}

	function validaFrm(frm) {
        if(frm.idTema.value==''){
            alert('Selecione um Tema');
            frm.idTema.focus();
            return(false);
        }

        if(frm.pergunta.value=='') {
            alert('Escreva a sua pergunta');
            frm.pergunta.focus();
            return(false);
        }
        alert('Obrigado! Sua pergunta foi enviada com sucesso.\n\nEm breve nossos Consultores estarão respondendo');
        return(true);
    }
</script>
<div id="divConteudo">
	<h1 class="titulo">Consultoria Gratuita</h1>
	<div class="divisa"></div><br />
	<form method="post" >
		<?php if (validation_errors()) { ?>
		<div class="msgErro"><?=validation_errors(); ?></div>
		<?php }?>
		<?php if ($msg) { ?>
		<div class="msgOk"><?= $msg ?></div>
		<?php }?>
		<input type="button" onclick="mostrar()" value="Faça sua Pergunta" /><br /><br />
	</form>
	<?php if (!$session_idUsuario){?>
	<div id="fild1" style="display: none">
		<form action="<?= base_url()?>login/validar" method="post">
			<fieldset>
				<span>Para perguntar, informe seus dados.</span><br /><br />
				<label style="width: 50px">E-mail</label><input type="text" name="email" value="<?=$email?>"><br />
				<label style="width: 50px">Senha</label><input type="password" name="senha">
				<input type="submit" value="Acessar" class=""><br />
				<label style="width: 50px">&nbsp;</label><a href="<?= base_url()?>login/esqueciMinhaSenha" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Esqueci minha senha</a>
				<a href="<?= base_url()?>login/cadastrar/" style="display: block; padding: 2px 0; font-size: 9px; color: #008C79">Ainda não sou cadastrado</a>
			</fieldset><br />
		</form>
	</div>
	<?php } else {?>
		<div id="fild1" style="display: none">
		<form name="form1" action="<?= base_url()?>consultoria/perguntar" method="post"  onSubmit="return validaFrm(this);">
			<input type="hidden" name="idUsuario" value="<?=$session_idUsuario?>">
			<input type="hidden" name="nome" value="<?=$session_login?>">
			<input type="hidden" name="email" value="<?=$session_email?>">
			<fieldset>
				<label>Tema </label>
				<select name="idTema">
					<option value="">Selecione um tema</option>
					<?php foreach ($temas as $row){?>
					<option value="<?= $row['id']?>"><?= $row['tema']?></option>
					<?php }?>
				</select>
				<br />
				<span>Escreva a sua pergunta <i>(Perguntas objetivas e curtas serão melhor respondidas)</i></span><br />
				<textarea name="pergunta" style="width: 100%" rows="5" ></textarea><br />
				<input type="submit" value="Perguntar" />
			</fieldset><br />
		</form>
	</div>
	<?php } ?>
	<div>
		<fieldset>
			<label style="width: 100px">Pesquisa por área</label>
			<select style="color: #666666; width: 430px" type="text" name="tema" id="tema" onchange="top.document.location='<?= base_url()?>consultoria/index/' + getElementById('tema').value+'';">
					<option value="-1">Selecione uma área</option>
				<?php foreach ($temas as $rowTemas) {
						$selected = "";
						if($id == $rowTemas['id']){
							$selected = "selected";
						}
				?>
					<option value="<?=$rowTemas['id'] ?>" <?=$selected?>> <?=$rowTemas['tema']?></option>
				<?php }?>
			</select><br />
		</fieldset>
	</div>
	<br />
	<div>
		<fieldset>
			<form action="<?= base_url()?>consultoria/" method="post">
				<label style="width: 250px">Localizar pergunta por palavra-chave:</label><input type="text" style="width: 230px" name="chave" value="<?=$chave?>"> <input type="submit" value="Buscar" /><br />
			</form>
			<form action="<?= base_url()?>consultoria/" method="post">
				<label style="width: 250px">Localizar pergunta pelo N&deg;:</label><input type="text" style="width: 230px" name="num" value="<?=$num?>"> <input type="submit" value="Buscar" />
			</form>
		</fieldset>
	</div>
	<ul class="listagem">
			<?php
			foreach ($perguntas as $row) {
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
					<p><a href="<?= base_url()?>consultoria/ver/<?= $row['id']?>/" ><?= inserirTags(highlight($row['pergunta'], $chave))?></a></p>
					<?php
						$imagem = base_url()."site/img/arroba.gif";
						$img = "<img src=\"$imagem\" alt=\"@\" />"
					?>
					<p class="assinatura"><?=$row['nomeUsuario']?> - <?= str_replace('@', $img, $row['emailUsuario']); ?> - <?=$row['cidade']?> (<?=$row['estado']?>)</p>
					<!-- ADAIL, TIBIRA OU ERIC, O "RESPONDER" DEVE SER MOSTRADO APENAS PARA OS CONSULTORES -->
					<p>
						<a href="<?= base_url()?>consultoria/ver/<?= $row['id']?>/"><span class="verde">Ver resposta</span></a> |
						<?php
						if (($session_consultor == 2) || ($session_idUsuario == $row['idUsuario'])) {?>
							<a href="<?= base_url()?>consultoria/ver/<?=$row['id']?>/"><span class="verde">Responder</span></a>
						<?php } else if (!$session_idUsuario){ ?>
							<a href="<?= base_url()?>login/"><span class="verde">Responder</span></a>
						<?php } else if ($session_consultor == 0) { ?>
							<a href="<?= base_url()?>login/cadastrarConsultor/"><span class="verde">Responder</span></a>
						<?php } ?>
					</p>
				</li>
				<?
				$temaAnterior = $row['tema'];
			}
	 	 ?>
	</ul>
	<? echo "<br /><br />$pag
	 <p align=center>$qtd de $total</p>";
	?>
</div>

