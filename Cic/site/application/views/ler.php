<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO CENTRAL -->
	<div>
		<h1><?php echo $secao?></h1>
		<?php foreach ($conteudo as $row){?>
		<h2><b><?php echo $row['titulo'] ?></b></h2>
		<p> <?php echo $row['resumo'] ?></p>
		<p> <?php echo $row['conteudo'] ?></p>
		<?php if ($row['fonte']){?>
			<p>Fonte: <a href="<?php echo $row['siteFonte'] ?>" target="_blank"> <?php echo $row['fonte'] ?></a></p>
		<?php }
		 }
		if (!$utimas5){?>
			<p class="dir"><a class="mais" href="<?php echo base_url().$url?>">ver todas as matérias &raquo;</a></p>
		<?php }?>
	</div>
<?php if ($utimas5){?>
<div style="padding: 15px;">
<h2>ÚLTIMAS NOTÍCIAS</h2>	
	<?php foreach ($utimas5 as $row){?>
		<p>&raquo;&nbsp;<a class="mais" style="font-weight: normal;color: #000000" href="<?php echo base_url() ?>noticia/ler/<?php echo $row['id']?>"><i><?php echo sqlToDate($row['data'])?> - <?php echo $row['titulo']?></i></a></p>
	<?php }?>
	<p class="dir"><a class="mais" href="<?php echo base_url().$url?>">ver todas as notícias &raquo;</a></p>
</div>
<?php }?>
</div>

<?php include "final.inc.php" ?>