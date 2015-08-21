<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h3>&raquo; Galeria de Fotos</h3>

	<?php foreach ($galeria_album as $row) {?>
		<a href="<?php echo base_url();?>galeria/ver_album/<?php echo $row['id_album'];?>#cont">
		<div class="persona">
			<img src="<?php echo base_url();?>img/<?php echo $row['capa_album'];?>"/>
			<div class="p-info">
				<h2><?php echo $row['titulo'];?></h2>			
				<p class="desc"><strong>Contribuiu:</strong> <?php echo $row['descricao'];?></p>
			</div>
		</div>
		</a>
	<div class="clear"></div>
	<?php } ?>

</div>


</div> <!-- container -->

<?php include_once "final.inc.php" ?>
