<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h3>&raquo; Nossos Vídeos</h3>
	
	<?php if($video_ver['id_video']){?>
		
		<p><strong>Você está assistindo:</strong> <?php echo $video_ver['titulo']?><br />
		- <?php echo $video_ver['descricao'];?></p>
		<?php echo $video_ver['link']?>
	
	
	<?php } else { ?>
	
		<p><strong>Você está assistindo:</strong> <?php echo $video_destaque['titulo']?>
		<br />- <?php echo $video_destaque['descricao'];?></p>
		<p style="padding-left:25px;"><?php echo $video_destaque['link']?></p>
	
	<?php }?>

	<div class="line">
	<?php foreach ($videos_gerais as $row) {?>
		<a href="<?php echo base_url();?>videos/ver/<?php echo $row['id_video'];?>#cont">
		<div class="vid" style="background-color:#f2f2f2; margin:3px;border:2px solid #DADADA;">
		<h4><?php echo $row['titulo'];?></h4>
		<img src="<?php echo base_url();?>uploads/pasta_vid/<?php echo $row['capa_video_thumb'];?>"/>
			
			
			
			
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