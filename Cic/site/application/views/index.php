<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO > TIRA DA ESQUERDA -->
	<div id="tiraEsq">
	<?php foreach ($noticia as $row){?>
		<h1><?php echo $row['titulo']?></h1><br>
		<font size="1"><i><?php echo sqlToDate($row['data'])?></i><br></font>
		<p><?php echo strip_tags($row['resumo'], '<(.*?)>');?></p>
		<?php if ($row['conteudo']){?>
		<a class="mais" style="font-size: 10px" href="<?php echo base_url() ?>noticia/ler/<?=$row['id']?>">[ leia + ]</a><br />
		<?php }
	}?>
		<p class="dir"><a class="mais" href="<?php echo base_url() ?>noticia">ver todas as notícias &raquo;</a></p>
	</div>
	<!-- CONTEUDO > TIRA DA DIREITA -->
	<div id="tiraDir">
		<?php 
		if ($bannerExclusivo){
			if ($bannerExclusivo['tipo'] == 2) {		
				$caminhoImg = base_url()."site/banners/$bannerExclusivo[arquivo]";
				if ($bannerExclusivo['novaJanela'] == "S"){
					$caminhoImg = base_url()."site/banners/$bannerExclusivo[arquivo]";
				?>			
				<a href="<?php echo $bannerExclusivo['url']?>" target ="_blank"><img id="banner" src="<?php echo $caminhoImg?>" width=<?php echo $bannerExclusivo['largura']?> height=<?php echo $bannerExclusivo['altura']?> border="0" /></a>
				<?php } else {?>
				<img id="banner" src="<?php echo $caminhoImg?>" width=<?php echo $bannerExclusivo['largura']?> height=<?php echo $bannerExclusivo['altura']?> border="0" />
				<?php }?> 
				<br/>
				<?php 		
			} else {
				?>		
				<embed
					src="<?php echo $caminho ?>"
					width="<?php echo $bannerExclusivo['largura'] ?>"
					height="<?php echo $bannerExclusivo['altura'] ?>"
					allowscriptaccess="always"
					allowfullscreen="true" >
				</embed>
				<br />	
				<?php 
			}
		}	
		?>
		
		<img src="<?php echo base_url() ?>site/img/cicloLogo.gif" />
		
		<select name="idPrograma" onchange="window.location.href='<?php echo base_url() ?>inicio/index/'+this.value;">
			<?php
			if ($programas) {
				foreach ($programas as $row) {
					?>
					<option <?php if ($row['id'] == $idPrograma) echo "selected"; ?> value="<?php echo $row[id]?>"><?php echo $row[titulo]?></option>
					<?php
				}
			}
			?>
		</select>		
		<br />
		<br />
		<!-- PLAYER WEB Vï¿½DEO -->
		<?php 
			if ($programaVideos) {
				foreach ($programaVideos as $video){ 
					?>
					<embed class="meio"
						src="<?php echo base_url() ?>site/videos/videoplayer.swf"
						width="220"
						height="170"
						allowscriptaccess="always"
						allowfullscreen="true"
						flashvars="file=<?php echo base_url()?>site/videos/<?php echo $video['arquivo']?>"/>
					</embed>
					<p class="peq"><span><?php echo $video['titulo'] ?> - Parte <?php echo $video['parte'] ?></span><br />
					Exibido em <?php echo sqlToDate($video['data']) ?><br />
					Tema: <?php echo $video['resumo'] ?></p>
					<?php 
				} 
			}
		?>
	</div>
</div>

<?php include "final.inc.php" ?>