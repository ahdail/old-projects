<!-- CONTEÚDO -->
<script>
function validaFrm(frm) {
        if(frm.resposta.value=='') {
            alert('Escreva a sua Resposta');
            frm.resposta.focus();
            return(false);
        }
        alert('Obrigado! Resposta enviada com sucesso');
        return(true);
    }
</script>
<div id="divConteudo">
		<h1 class="titulo">Consultoria Gratuita</h1>
		<div class="divisa"></div><br />
		<?php if ($msg) { ?>
		<div class="msgOk"><?= $msg ?></div>
		<?php }?>
			<!--  Pergunta -->
			<form action="<?= base_url()?>consultoria/responder/<?=$id?>" method="post" onSubmit="return validaFrm(this);" >
				<fieldset>
				<?php foreach ($pergunta as $rowPergunta){?>
					<legend><?= sqlToDataHora($rowPergunta['data'])?></legend>
					<?php if ($avatar['avatar']) { ?>
						<label><img border="0" src="<?= base_url()?>site/avatar/<?=$avatar['avatar'] ?>" width="80" height="80" alt="Portal da Classe Contábil" /></label>
					<?php } else { ?>
						<label><img border="0" src="<?= base_url()?>site/img/avatar.gif" width="80" height="80" alt="Portal da Classe Contábil" /></label>
					<?php }?>
                                                <h2><span style="color:#008C79;"><?= $rowPergunta['nomeUsuario']?></span> perguntou:</h2>
					<p><?= inserirTags($rowPergunta['pergunta'])?></p>
					<p class="assinatura dir"><?=$rowPergunta['emailUsuario']?> - <?=$rowPergunta['cidade']?> (<?=$rowPergunta['estado']?>)</p>
					<?php if (($session_consultor == 2) || ($session_idUsuario == $rowPergunta['idUsuario'])) { ?>
						<textarea name="resposta" style="width: 100%" rows="4"></textarea><br />
						<input type="submit" value="Responder" />
						<input type="hidden" name="idUsuario" value="<?=$session_idUsuario?>">
						<input type="hidden" name="nome" value="<?=$session_login?>">
					<?php }?>
				</fieldset>
			</form><br />
		<!--  /fim Pergunta -->
		<?php }?>
		<!-- Diálogo com o consultor -->
			<?php
			if ($respostas){
				?>
				<fieldset class="branco">
				<legend>Respostas</legend>
				<?php
				foreach ($respostas as $rowRespostas){
			?>
			<ul class="listagem">
				<li>
					<p class="data">
						<?= sqlToDataHora($rowRespostas['dataResposta'])?><br>
						<?= $rowRespostas['estado'] ?><br>
						<?php
							$imagem = base_url()."site/img/arroba.gif";
							$img = "<img src=\"$imagem\" alt=\"@\" />"
						?>
						<?= str_replace('@', $img, $rowRespostas['email']); ?>
					</p>
					<!--  <div class="dir">
						Avalie
						<img class="esq" src="<?= base_url()?>site/img/estrela.gif">
						<img class="esq" src="<?= base_url()?>site/img/estrela.gif">
						<img class="esq" src="<?= base_url()?>site/img/estrela.gif">
						<img class="esq" src="<?= base_url()?>site/img/estrelaSemi.gif">
						<img class="esq" src="<?= base_url()?>site/img/estrelaSemi.gif">
						<br><br>
						Ótimo
					</div>-->
					<!-- RESPOSTA -->
					<?
					if ($rowRespostas['consultor'] == 2) {
						echo "<h2>Consultor(a) <a href='".base_url()."consultores/ver/{$rowRespostas['idConsultor']}'>".$rowRespostas['nomeConsultor']."</a> respondeu:</h2>";
					}
					else {
						echo "<h3>".$rowRespostas['nomeConsultor'].":</h3>";
					}
					?>
					<p><?= inserirTags($rowRespostas['resposta'])?></p>
					<!-- / -->
					<br />
				</li>
			</ul>
			<?php }
			?>
			</fieldset>
			<?php
			} else {?>
			<fieldset class="branco">
				<h3>Nenhuma resposta!</h3>
			</fieldset><br />
			<?php }?>
		<!-- Fim Diálogo com o Consultor -->
</div>
