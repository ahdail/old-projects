<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h3><a href="<?php echo base_url();?>galeria#cont">Galeria de Fotos</a> &raquo; <?php echo $nome_album['titulo'];?></h3>

	<div class="line">
	<?php foreach ($fotos_album as $row) {?>
		
		<div class="vid" id="gallery">
			
	<a href="<?php echo base_url();?>uploads/pasta_fot/<?php echo $row['foto'];?>" title="<?php echo $row['titulo'];?>">
	<img src="<?php echo base_url();?>uploads/pasta_fot/<?php echo $row['foto_thumb'];?>"/>
			</a>
			
			<h4><?php echo $row['titulo'];?></h4>
			<!--<p>Publicado em <?php //echo $row['data'];?></p>-->
		</div>
		
	<?php } ?>
		
		
	</div>
	
	<div class="clear"></div>
	
	
	<!--
	<div id="nav-news">
		<a class="block" href="#">Proximo</a>
	</div>
	--->
</div>


</div> <!-- container -->

<?php include_once "final.inc.php" ?>