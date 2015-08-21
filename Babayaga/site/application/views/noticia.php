<?php include("inicio.inc.php"); ?>


<div id="areadefoto">
	<p><img src="<?php echo base_url()?>site/images/layout_site_NOTICIAS_05.png" width="254" height="266" /></p>
	<p class="texto_bold_italic"> notícias anteriores</p>
	
	<?php foreach ($noticias as $row) { ?>
	<span class="textonormal"><?php echo sqlToDate($row['data']) ?> -  
	<a href="<?php echo base_url();?>noticia/ver/<?php echo $row['id']?>"><?php echo $row['titulo'] ?> </a></span><br />
	<?php } ?>
	<p>&nbsp;</p>
</div>
<?php if ($ultima['id']){?>
<div id="areanoticias">
    <span class="TitulosGrandes">Noticías</span>
    <p class="textonormal"><?php echo sqlToDate($ultima['data'])?><br />
    <span class="texto_bold_italic"><?php echo $ultima['titulo']?></span></p>
    <p class="textonormal">
	<img src="<?php echo base_url()?>site/images/layout_site_NOTICIAS_10.jpg" width="251" height="188" align="left" class="foto_noticias" /><?php echo $ultima['descricao']?> </p>

</div>
<?php } else {?>

<div id="areanoticias">
    <span class="TitulosGrandes">Noticías</span>
    <p class="textonormal"><?php echo sqlToDate($atual['data'])?><br />
    <span class="texto_bold_italic"><?php echo $atual['titulo']?></span></p>
    <p class="textonormal">
	<img src="<?php echo base_url()?>site/images/layout_site_NOTICIAS_10.jpg" width="251" height="188" align="left" class="foto_noticias" /><?php echo $atual['descricao']?> </p>
</div>
<?php } ?>

<?php include("final.inc.php");?>