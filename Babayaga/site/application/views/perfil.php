<?php include("inicio.inc.php"); ?>

<div id="areadefoto">
    <p><img src="<?php echo base_url()?>site/images/boneca_pefil.png" width="240" height="249" /></p>
    <p class="texto_bold_italic"> Outros Perfis</p>
	 <?php foreach ($todosPerfis as $row){?>
	<table width="100%" border="0">
		<tr>
		<td width="25%"><img src="<?php echo base_url()?>site/perfilbabayaga/<?php echo $row['fotoThumb']?>" width="60" height="70" style="border:3px solid #FFFFFF;" /></td>
		<td width="75%" valign="top"><span class="textonormal"><?php echo sqlToDate($row['data']);?><br /><a href="<?php echo base_url()?>perfil/ver/<?php echo $row['id']?>"><?php echo $row['cliente']?></a></span></td>		
	</tr>
	</table>
	<?php }?>    
    <!--<p>1 2 3 4 5 6 7 </p>-->
	<p>&nbsp;</p>
</div>
<div id="areanoticias">
	<span class="TitulosGrandes">Perfil Babayaga</span><br /><br />
	<?php echo sqlToDate($babayaga['data']) ?><br />
	<span class="texto_bold_italic"><?php echo $babayaga['cliente']?></span></p>
	<p class="textonormal"><i><?php echo $babayaga['resumo']?></i><br />
	<p class="textonormal">
		<img src="<?php echo base_url()?>site/perfilbabayaga/<?php echo $babayaga['foto']?>" width="217" height="290" align="left" style="border:5px solid #FFFFFF;" class="foto_noticias" />
		<?php echo $babayaga['descricao'] ?>
	</p>
</div>
<?php include("final.inc.php");?>