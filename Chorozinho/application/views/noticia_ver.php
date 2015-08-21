<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h2><?php echo $noticia['titulo']?></h2>
	<p class="subtitle">em <?php echo sqlToDate($noticia['data']);?></p>
	
	<?php if($noticia['imagem']){?>
	<img class="img-right" src="<?php echo base_url();?>img/g_Igreja local.jpg"/>
	<?php } ?>
	
	<p><?php echo nl2br($noticia['conteudo']);?></p>
	
	<?php if($noticia['fonte']){?>	
	<p class="fonte">Fonte: <?php echo $noticia['fonte'];?></p>
	<?php } ?>
	<div id="nav-news">
		<!--<a href="#">Voltar</a>-->
		<a id="all" href="<?php echo base_url();?>noticia#cont">&laquo;  Ver todas &raquo;</a>
	</div>
</div>


</div> <!-- container -->

<?php include_once "final.inc.php" ?>