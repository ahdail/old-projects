<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<?php foreach ($pagina as $row){?>
		<h1><?php echo $row['titulo'] ?></h1>
		<p style="padding-left: 15px;"><i><?php echo $row['conteudo'] ?></i></p>
		<?php }	?>
	</div>
</div>

<?php include "final.inc.php" ?>