<?php include("inicio.inc.php"); ?>
<div style="padding:120px 0 0 43px;float:left">
<img src="<?php echo base_url()?>site/images/maquina_fot_pq_home.png" border="0" width="107" height="159"/>	
</div>
<div id="slidebox" style="margin-right:50px; margin-top:-5px">
<div class="next"></div>
<div class="previous"></div>

	<div class="container" >
		<?php foreach ($banners as $row) { ?>
    	<div class="content" >
			
			<?php if($row['url']){ echo "<a href=".$row['url']." target=\"_blank\">";} ?>
        	<div><img src="<?php echo base_url()?>site/banners/<?php echo $row['arquivo']?>" width="749" height="267" border="0"/></div>
			<?php if($row['url']){ echo "</a>";} ?>  
			
		</div>
		 <?php } ?>
	</div>
</div>

<div id="noticias_home">
    <span class="Titulos">Notícias</span>
	
	<?php foreach ($noticias as $row) { ?>
		<p class="textonormal" style="margin: auto" >
			<a href="<?php echo base_url();?>noticia/ver/<?php echo $row['id']?>"><?php echo sqlToDate($row['data']) ?> - <?php echo $row['titulo'] ?></a><br />
		</p>
	<?php } ?>
	
	<p class="textonormal_cinza"><a href="<?php echo base_url();?>noticia">+ veja mais notícias</a></p>
    <p class="textonormal_cinza"><br /></p>
</div>
  <div id="perfil_home">
    <span class="Titulos">Perfil Babayaga</span><p><span class="textonormal_cinza">	
		<img src="<?php echo base_url()?>site/perfilbabayaga/<?php echo $babayaga['fotoThumb']?>" align="left" style="border:5px solid #FFFFFF; ">
		<a href="<?php echo base_url();?>perfil/ver/<?php echo $babayaga['id']?>"><?php echo $babayaga['cliente']?> - <?php echo reduzirStr($babayaga['descricao'], 200)?><br />{+ ler mais}</a>
	</span>
<p>
<br />
    </p>
</div>
<div id="video_home">
  <span class="Titulos">Vídeo</span></p>
  <p><span class="Titulos"><img src="<?php echo base_url()?>site/video_fotos/<?php echo $video['fotoVideoThumb']?>" style="border:5px solid #FFFFFF;"/></span></p>
  <p><span class="textonormal"><a href="<?php echo base_url();?>video/ver/<?php echo $video['id']?>"><?php echo $video['titulo']?> - <?php echo $video['descricao']?><br /> {+ ler mais}</a></span>
  </p>
  <p class="textonormal">&nbsp;</p>
    <p class="textonormal"><br />
    </p>
    
</div>
<div id="video_home"><span class="Titulos">Eventos</span>
	</p>
		<p><span class="Titulos"><img src="<?php echo base_url()?>site/eventos_fotos/<?php echo $evento['fotoEventoThumb']?>"  style="border:5px solid #FFFFFF; "/></span></p>
	<p>
		<span class="textonormal">
			<a href="<?php echo base_url();?>evento/ver/<?php echo $evento['id']?>"> 
				<?php echo sqlToDate($evento['data'])?> <br /> <?php echo $evento['titulo']?> - <?php echo $evento['descricao']?> <br />{+ ler mais}
			</a>
		</span>
	</p>
  <p>&nbsp;</p>
<p class="textonormal_cinza">&nbsp;</p>
    <p class="textonormal_cinza"><br />
    </p>
    
</div>


<?php include("final.inc.php");?>