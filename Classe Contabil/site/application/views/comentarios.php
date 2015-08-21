<!-- CONTEÚDO -->
<div id="divConteudo">
<!-- Listagem de todos os Comentarios -->	
	<?php if ($titulo){?>
	<h1 class="titulo">Todos os Comentários</h1>
	<div class="divisa"></div>
		<?php foreach ($titulo as $row){
		$novaData = sqlToDate($row['data']);
		?>
			<h1><?=$row[titulo]?></h1>
			<h2><?=inserirTags($row[resumo])?></h2>
		<?php }
	}?>
	<ul class="listagem">
		<?php foreach ($comentarios as $row){?>
			<li>
				<h1>Comentário de <?= $row[nome]?></h1>
				<p><?=$row[comentario]?></p>
			</li>
		<?php }?>	
	</ul>
</div>
