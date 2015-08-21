<?php include_once "inicio.inc.php" ?>
<div id="content" class="grid_6">
	<div id="slideshow" class="pics">
			
			<?php foreach ($banner_home as $row) {?>
            <div>
				 <img src="<?php echo base_url();?>banners/<?php echo $row['imagem']?>" width="560" height="300" />
				<p><?php echo $row['titulo']?></p>
			</div>
			<?php } ?>			           
    </div>
		
	<!--- Destaque --->
	
	<?php if (!empty($noticia_destaque['titulo'])){?>
	<div class="news special">
		<h2><?php echo $noticia_destaque['titulo']; ?></h2>
		<p class="subtitle" >em <?php echo sqlToDate($noticia_destaque['data']); ?></p>
		<?php if (!empty($noticia_destaque['imagem_thumb'])){?> 
		<div style="float:left; padding:5px;"><img class="img-right" src="<? echo base_url()?>uploads/pasta_not/<?php echo $noticia_destaque['imagem_thumb']?>" /></div>		
		<?php }?>
		<p>
			
			<?php echo $noticia_destaque['conteudo']; ?>			
		</p>

		<a class="leia" href="<?php echo base_url();?>noticia/ver/<?php echo $noticia_destaque['id_noticia'];?>#cont">Leia mais</a>
	</div>
	<?php } ?>
	<!-- fim --->
	
	<?php foreach ($noticias as $row) {?>
	<div class="news">
		<h2><?php echo $row['titulo']?></h2> 
		<p class="subtitle" ><?php echo sqlToDate($row['data'])?></p>
		<p><?php echo $row['resumo']?></p>
		<a class="leia" href="<?php echo base_url();?>noticia/ver/<?php echo $row['id_noticia'];?>#cont">Leia mais</a>
	</div>
	<?php } ?>
	
	
	<div class="box">
		<div class="h-box">
			<h2 id="prog">Programação Municipal</h2>
		</div>
		<div class="all-box">
		
			<?php foreach ($agenda_geral as $row) {?>
			<div class="e-box clearfix">
				<div class="d-box">
					<p><?php echo sqlToDate($row['data']);?></p>
				</div>
				<div class="info-box">
					<h3><?php echo $row['titulo'];?></h3>
					<p><strong>Local: </strong><?php echo $row['local'];?></p>
					<p>	
						<?php echo nl2br($row['descricao']);?>
					</p>
				</div>
			</div>
			<?php } ?>

			
			
		</div>
	</div>
</div>

<div id="sidebar2" class="grid_3 omega">
	<div class="box">
		<div class="h-box">
			<h2 id="fotos">Acervo de Imagens</h2>
		</div>
		<div class="b-box">
		<h3><?php echo $album_destaque['titulo']?></h3>
		<!--<p>em 08/02/2012</p>-->
		<a href="<? echo base_url()?>galeria/ver_album/<?php echo $album_destaque['id_album']?>"><img src="<? echo base_url()?>uploads/pasta_alb/<?php echo $album_destaque['capa_album_thumb']?>"/></a>
		</br><a href="<?php echo base_url();?>galeria#cont">Ver todos</a>
		</div>
	</div>
	<?php if(!empty($video_destaque['id_video'])){?>
	<div class="box">
		<div class="h-box">
			<h2 id="video">Nossos Videos</h2>
		</div>
		<div class="b-box">
			
				<h3><?php echo $video_destaque['titulo']?></h3>
				<!--<p>em <?php //echo $video_destaque['data']?></p>-->
			<a href="<?php echo base_url();?>videos/ver/<?php echo $video_destaque['id_video'];?>#cont">	
				<img src="<? echo base_url()?>uploads/pasta_vid/<?php echo $video_destaque['capa_video_thumb']?>"/>
			</a>
			</br><a href="<?php echo base_url();?>videos#cont">Ver todos</a>
		</div>
	</div>
	<?php } ?>
	<div id="links">
		<a href="http://www.ce.portaldatransparencia.com.br/prefeitura/chorozinho/doe/" target="_blank"><img src="<?php echo base_url();?>img/banner_portaltransparencia.jpg"/></a>
		<a href="http://http://www.bb.com.br/" target="_blank"><img src="<?php echo base_url();?>img/contracheque.png"/></a>
		<a href="http://www.projovem.gov.br/" target="_blank"><img src="<?php echo base_url();?>img/projovem.jpg"/></a>
		<a href="http://www.mds.gov.br/bolsafamilia" target="_blank"><img src="<?php echo base_url();?>img/bolsa.jpg"/></a>
		<a href="http://www.brasil.gov.br/" target="_blank"><img src="<?php echo base_url();?>img/LogoBrasilDilma.jpg"/></a>
		<a href="http://www.ceara.gov.br/" target="_blank"><img src="<?php echo base_url();?>img/apoiador_GEC.jpg"/></a>
	</div>
</div>

</div> <!-- container -->
<?php include_once "final.inc.php" ?>