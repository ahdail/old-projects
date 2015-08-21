<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h3>Município &raquo; Notícias</h3>
	
	
	<?php foreach ($noticias_gerais as $row) {?>
	<div class="news">
		<h2><?php echo $row['titulo']?></h2>
		<p class="subtitle" >Em <?php echo sqlToDate($row['data'])?></p>
		<p><?php echo $row['conteudo']?></p>		
		<a class="leia" href="<?php echo base_url();?>noticia/ver/<?php echo $row['id_noticia'];?>#cont">Leia mais</a>
	</div>
	<?php } ?>

	<div id="nav-news">
		<a class="block" href="#">Primeira</a>
		<a class="block" href="#">Anterior</a>
		<a class="block" href="#">1</a>
		<a class="block" href="#">2</a>
		<a class="block" href="#">3</a>
		<a class="block" href="#">4</a>
		<a class="block" href="#">Proxima</a>
		<a class="block" href="#">Ultima</a>
	</div>
</div>


</div> <!-- container -->

<?php include_once "final.inc.php" ?>