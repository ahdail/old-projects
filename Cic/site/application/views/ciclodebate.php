<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<h1>Programas</h1>
		<?php foreach ($ciclodebate as $row){?>
		<h2><b><a class="preto" href="<?php echo base_url() ?>ciclodebate/ler/<?php echo$row['id']?>"><?php echo sqlToDate($row['data']);?> - <?php echo $row['titulo'] ?></a></b></h2>
		 <p><i><?php echo $row['resumo'] ?></i></p>
		<!-- <p> <?php echo $row['conteudo'] ?></p>-->
	<?php }?>
	</div>
</div>

<?php include "final.inc.php" ?>