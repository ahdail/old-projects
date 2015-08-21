<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<h1>Opinião do Presidente</h1>
		<?php foreach ($conteudo as $row){?>
		<h2><?php echo $row['titulo'] ?></h2>
		<p><b><?php echo $row['resumo'] ?></b></p>
		<p><?php echo $row['conteudo'] ?></p>
	<?php }?>
	</div>
</div>

<?php include "final.inc.php" ?>