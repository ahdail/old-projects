<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h2><?php echo $noticia['titulo']?></h2>
	<p class="subtitle">em <?php echo sqlToDate($noticia['data']);?></p>
	
	<?php if($noticia['imagem']){?>
<img class="img-right" width ="320px" height="" src="<? echo base_url()?>uploads/pasta_not/<?php echo $noticia['imagem']?>" />
	
	<?php } ?>
	
	<p><?php echo nl2br($noticia['conteudo']);?></p>
		<p><?php echo nl2br($noticia['resumo']);?></p>
	
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