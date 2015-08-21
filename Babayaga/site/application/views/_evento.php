<?php include("inicio.inc.php"); ?>


  <div id="areadefoto">
    <span class="texto_bold_italic">Agenda de eventos</span>
    <p>&nbsp;</p>
    <p class="texto_bold_italic">Eventos anteriores</p>
	<?php foreach ($eventos as $row) { ?>
    <span class="textonormal"><a href="<?php echo base_url();?>evento/ver/<?echo $row['id'] ?>"><?php echo sqlToDate($row['data']) ?> - <?php echo $row['titulo'] ?></a></span><br /><br />
	<?php } ?>
    <p>&nbsp;</p>
  </div>
  
  <?php if ($ultimo['id']){?>
  <div id="menu_colecoes">
    <span class="TitulosGrandes">Evento</span>
	
    <p><span class="textonormal"><a href="#"><?php echo $ultimo['data']?><br />
    <span class="texto_bold_italic"><?php echo $ultimo['titulo']?></span></a></span></p>
    <p class="textonormal"><?php echo $ultimo['descricao']?></p>
	
	
    <p class="textonormal">&nbsp;</p>
    <p class="textonormal"><br />
    </p>
    
</div>
<?php } else {?>

 <div id="menu_colecoes">
    <span class="TitulosGrandes">Evento</span>
	
    <p><span class="textonormal"><a href="#"><?php echo $atual['data']?><br />
    <span class="texto_bold_italic"><?php echo $atual['titulo']?></span></a></span></p>
    <p class="textonormal"><?php echo $atual['descricao']?></p>
	
	
    <p class="textonormal">&nbsp;</p>
    <p class="textonormal"><br />
    </p>
    
</div>

<?php } ?>


<?php if ($ultimo['id']){?>
<div id="fotos_">
  <span class="Titulos_colecoes">Fotos do evento</span>
 
  <p class="foto">
  <?php foreach ($fotosultimoevento as $row) { ?>
	<a href="<?php echo base_url();?>site/eventos_fotos/<?php echo $row['fotoEvento']?>"  >
		<img src="<?php echo base_url()?>site/eventos_fotos/<?php echo $row['fotoEventoThumb']?>" class="foto" border="0" />
	</a>
  <?php } ?>
  
  
  </p>
</div>
<?php } else { ?>

<div id="fotos_">
  <span class="Titulos_colecoes">Fotos do evento</span>
 
  <p class="foto">
  <?php foreach ($fotosevento as $row) { ?>
	<a href="<?php echo base_url();?>site/eventos_fotos/<?php echo $row['fotoEvento']?>"  >
	<img src="<?php echo base_url()?>site/eventos_fotos/<?php echo $row['fotoEventoThumb']?>" class="foto" border="0" />
	</a>
  <?php } ?>
  
  
  </p>
</div>

<?php } ?>

<?php include("final.inc.php");?>