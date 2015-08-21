<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<h1>CIC na Imprensa</h1>
		<?php foreach ($conteudo as $row){?>
		<h2><b><a class="preto" href="<?php echo base_url() ?>imprensa/ler/<?php echo $row['id']?>"><?php echo $row['titulo'] ?></a></b></h2>
		<?php echo $row['resumo'] ?>
		<?php }	?>
	</div>
</div>

<?php include "final.inc.php" ?>