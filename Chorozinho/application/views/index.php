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
	<div class="news special">
		<h2><?php echo $noticia_destaque['titulo']; ?></h2>
		<p class="subtitle" >em <?php echo sqlToDate($noticia_destaque['data']); ?></p>
		<p>
			<?php echo $noticia_destaque['conteudo']; ?>			
		</p>
		<a class="leia" href="<?php echo base_url();?>noticia/ver/<?php echo $noticia_destaque['id_noticia'];?>#cont">Leia mais</a>
	</div>
	<!-- fim --->
	
	<?php foreach ($noticias as $row) {?>
	<div class="news">
		<h2><?php echo $row['titulo']?></h2> 
		<p class="subtitle" ><?php echo sqlToDate($row['data'])?></p>
		<p><?php echo $row['conteudo']?></p>
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
		<h3>Semana Pedagogica</h3>
		<p>em 08/02/2012</p>
		<img src="img/ft1.png"/>
		<a href=""#">Ver todos</a>
		</div>
	</div>
	
	<div class="box">
		<div class="h-box">
			<h2 id="video">Nossos Videos</h2>
		</div>
		<div class="b-box">
			
				<h3><?php echo $video_destaque['titulo']?></h3>
				<p>em <?php //echo $video_destaque['data']?></p>
			<a href="<?php echo base_url();?>videos/ver/<?php echo $video_destaque['id_video'];?>#cont">	
				<img src="<?php echo base_url();?>img/<?php echo $video_destaque['capa_video']?>" width="160"/>
			</a>
			</br><a href="<?php echo base_url();?>videos">Ver todos</a>
		</div>
	</div>
	
	<div id="links">
		<a href="http://www.ce.portaldatransparencia.com.br/prefeitura/chorozinho/doe/" target="_blank"><img src="<?php echo base_url();?>img/banner_portaltransparencia.jpg"/></a>
		<a href="http://www.selounicef.org.br/" target="_blank"><img src="<?php echo base_url();?>img/selo unicef municipio aprovado.jpg"/></a>
		<a href="http://www.projovem.gov.br/" target="_blank"><img src="<?php echo base_url();?>img/projovem.jpg"/></a>
		<a href="http://www.mds.gov.br/bolsafamilia" target="_blank"><img src="<?php echo base_url();?>img/bolsa.jpg"/></a>
		<a href="http://www.brasil.gov.br/" target="_blank"><img src="<?php echo base_url();?>img/LogoBrasilDilma.jpg"/></a>
		<a href="http://www.ceara.gov.br/" target="_blank"><img src="<?php echo base_url();?>img/apoiador_GEC.jpg"/></a>
	</div>
</div>

</div> <!-- container -->
<?php include_once "final.inc.php" ?>