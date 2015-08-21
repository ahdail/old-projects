<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<h1><?php echo $programa['titulo']?> - <?php echo $programa['resumo'] ?><?php echo sqlToDate($programa['data']);?> </h1><br/>
		<?php 
			if ($ciclodebate) {
				foreach ($ciclodebate as $video){ 
					?>
					<p class="meio peq"><span class="vermelho"><?php echo $programa['titulo'] ?> - Parte <?php echo $video['parte'] ?></span><br />
					Tema: <?php echo $video['resumo'] ?></p>
					<embed class="meio"
						src="<?php echo base_url() ?>site/videos/videoplayer.swf"
						width="600"
						height="500"
						allowscriptaccess="always"
						allowfullscreen="true"
						flashvars="file=<?php echo base_url()?>site/videos/<?php echo $video['arquivo']?>"/>
					</embed><br />
					<?php 
				} 
			}
		?>
		<p class="dir"><a class="mais" href="<?php echo base_url()?>ciclodebate">ver todos &raquo;</a></p>
	</div>
</div>

<?php include "final.inc.php" ?>	