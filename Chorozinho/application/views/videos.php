<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h3>&raquo; Nossos Vídeos</h3>
	
	<?php if($video_ver['id_video']){?>
		
		<p><strong>Você está assistindo:</strong> <?php echo $video_ver['titulo']?></p>
		<?php echo $video_ver['link']?>
	
	
	<?php } else { ?>
	
		<p><strong>Você está assistindo:</strong> <?php echo $video_destaque['titulo']?></p>
		<?php echo $video_destaque['link']?>
	
	<?php }?>

	<div class="line">
	<?php foreach ($videos_gerais as $row) {?>
		<a href="<?php echo base_url();?>videos/ver/<?php echo $row['id_video'];?>#cont">
		<div class="vid">
			<img src="<?php echo base_url();?>img/<?php echo $row['capa_video'];?>"/>
			<h4><?php echo $row['titulo'];?></h4>
			<p>Publicado em <?php //echo $row['data'];?></p>
		</div>
		</a>
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
