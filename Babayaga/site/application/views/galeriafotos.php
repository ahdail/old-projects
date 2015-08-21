<?php include("inicio.inc.php"); ?>


<div id="areadefoto">
    <p><img src="<?php echo base_url();?>site/images/marquina_foto_ant.png" width="260" height="405" /></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
  <div id="menu_colecoes">
    <span class="TitulosGrandes">Galeria <br />
    de Fotos</span><br /><br />
    <?php foreach ($galerias as $row) { ?>
	<p class="textonormal" style="margin: 5px">	
		<a href="<?php echo base_url();?>galeriafotos/ver/<?php echo $row['id']?>" >
		<?php echo $row['nomegaleria']?></a>		
	</p>
	<?php } ?>
    <p class="textonormal">&nbsp;</p>
    <p class="textonormal"><br />
    </p>
    
</div>

<?php if ($galeriasatual['id']){?>
<div id="fotos_">
	<span class="Titulos_colecoes"><?php echo $galeriasatual['nomegaleria']?>  </span>

		<p class="foto">
			<?php foreach ($fotosgaleriaatual as $row) { ?>
			<a href="<?php echo base_url();?>site/galeria_fotos/<?php echo $row['fotoGaleria']?>" title="<?php echo $row['descricao']?>"  >
				<img src="<?php echo base_url();?>site/galeria_fotos/<?php echo $row['fotoGaleriaThumb']?>" class="foto" border="0" />
			</a>
			<?php } ?>	
		</p>
</div>
<?php } else {?>


<div id="fotos_">
	<span class="Titulos_colecoes"><?php echo $galeria['nomegaleria']?>  </span>
		<p class="foto">
			<?php foreach ($fotosgaleria as $row) { 
			//print_r($fotosgaleria);
			?>
			<a href="<?php echo base_url();?>site/galeria_fotos/<?php echo $row['fotoGaleria']?>"  title="<?php echo $row['descricao']?>" >
				<img src="<?php echo base_url();?>site/galeria_fotos/<?php echo $row['fotoGaleriaThumb']?>" border="0" class="foto" />
			</a>
			<?php } ?>	
		</p>
</div>
<div style='display:none'>
			<div id='inline_example1' style='padding:10px; background:#fff;'>
			<p><strong>This content comes from a hidden element on this page.</strong></p>
			<p>The inline option preserves bound JavaScript events and changes, and it puts the content back where it came from when it is closed.<br />
			<a id="click" href="#" style='padding:5px; background:#ccc;'>Click me, it will be preserved!</a></p>
			
			<p><strong>If you try to open a new ColorBox while it is already open, it will update itself with the new content.</strong></p>
			<p>Updating Content Example:<br />
			<a class="example5" href="../content/flash.html">Click here to load new content</a></p>
			</div>
		</div>
  <?php }?>

<?php include("final.inc.php");?>