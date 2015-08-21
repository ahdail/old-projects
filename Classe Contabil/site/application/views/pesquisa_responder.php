
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/internas.css" />
<!-- CONTEÚDO -->
<div id="divConteudo">
	<h1 class="titulo">Pesquisas</h1>
	<div class="divisa"></div>
	<?php if ($perguntas) { ?>
		<ul class="listagem">
		<form action="<?=base_url()?>pesquisas/responder/<?=$idPesquisa?>/<?=$qtdPerguntas?>" method="post">
		<?php
		foreach ($perguntas as $row){
			$idPerguntas .= $row['id'].",";
			?>
			<li>
				<h1><?=$row['pergunta']?></h1>
				<p>
				<?php 
				switch($row['tipo']) {
					case 1: // Aberta
						?>
						<textarea rows="4" style="width: 98%" name="texto_<?=$row['id']?>"></textarea>
						<?	
					break;
					
					case 2: // Sim/Não
						?>
						<input type="radio" name="op1_<?=$row['id']?>" value="1">Sim
						<input type="radio" name="op1_<?=$row['id']?>" value="2">Não
						 
						<?
						if ($row['comentario'] == "S") {
							?>
							Comentário: <br>
							<textarea rows="4" style="width: 98%" name="texto_<?=$row['id']?>"></textarea>
							<? 	
						}
					break;
					
					case 3: // Multipla escolha
						?>
						<input type="checkbox" name="op1_<?=$row['id']?>" value="1"><?=$row['op1']?><br>
						<input type="checkbox" name="op2_<?=$row['id']?>" value="1"><?=$row['op2']?><br>
						<input type="checkbox" name="op3_<?=$row['id']?>" value="1"><?=$row['op3']?><br>
						<input type="checkbox" name="op4_<?=$row['id']?>" value="1"><?=$row['op4']?><br>
						<input type="checkbox" name="op5_<?=$row['id']?>" value="1"><?=$row['op5']?><br>
						<?
						if ($row['comentario'] == "S") {
							?>
							Comentário: <br>
							<textarea rows="4" style="width: 98%" name="texto_<?=$row['id']?>"></textarea>
							<? 	
						}
					break;
					
					case 4: // Nota
						?>
						<input type="text" class="campo" name="op1_<?=$row['id']?>">
						<?
						if ($row['comentario'] == "S") {
							?>
							Comentário: <br>
							<textarea rows="4" style="width: 98%" name="texto_<?=$row['id']?>"></textarea>
							<? 	
						}
					break;
				}				
				?>
				</p>
			</li>
			<?
		}
		?>
		<input type="submit" value="Enviar">
		<input type="hidden" name="idPerguntas" value="<?=substr($idPerguntas, 0, -1)?>">	
		</form>
		</ul>
	<? } else { ?>
		<p>Você respondeu todas as perguntas. Obrigado por participar.<br />
		<a href="<?=base_url()?>pesquisas">Clique aqui</a> para voltar as pesquisas disponíveis.</p>
	<? } ?>
</div>
