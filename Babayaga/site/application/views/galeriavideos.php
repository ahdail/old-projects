<?php include("inicio.inc.php"); ?>


<div id="galeriadevideos">
    <span class="TitulosGrandes">Galeria de Videos</span><br>
   <?php foreach ($videos as $row) {?>

   <div id="foto_galeria_videos">
      <p>
		<a href="<?php echo base_url();?>video/ver/<?php echo $row['id']?>">
			<img src="<?php echo base_url();?>site/video_fotos/<?php echo $row['fotoVideoThumb']?>" width="100" height="60"  style="border:5px solid #FFFFFF;" align="left" class="foto_noticias" /></a>
			<span class="textonormal">
		<a href="<?php echo base_url();?>video/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a></span></p>
    </div>
	
	<?php } ?>
    
    <p>&nbsp;</p>
<p class="textonormal">&nbsp;</p>
    <p class="textonormal"><br />
    </p>
	<!--
    <div id="paginacao_">
      <p class="textonormal">1 2 3 4 5 6</p>
    </div>
	-->
  </div>
	<div id="fotos_">
	
	<?php if($videoUltimo['id']){?>
		<span class="Titulos_colecoes"><?php echo $videoUltimo['titulo']?> </span><br /><br />			
			<?php echo $videoUltimo['linkvideo']?>
			<br />
	<? } else { ?>		
		<span class="Titulos_colecoes"><?php echo $video['titulo']?></span><br /><br />		
			<?php echo $video['linkvideo'];?>	
			<br />			
	<? }  ?>		
	</div>


<?php include("final.inc.php");?>