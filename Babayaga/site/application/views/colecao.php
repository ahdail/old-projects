<?php include("inicio.inc.php"); ?>

<div id="areadefoto">
    <p><img src="<?php echo base_url()?>site/images/marquina_foto_ant.png" width="260" height="405" /></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
	<div id="menu_colecoes">
    <span class="TitulosGrandes">Coleções</span><br /><br />
	
	
	
	
	
	<?php foreach ($colecoes as $row) { ?>
	<p class="textonormal" style="margin: 5px">	
	<a href="<?php echo base_url();?>colecao/ver/<?php echo $row['id']?>" ><?php echo $row['nomecolecao']?></a>
	</p>
	<?php } ?>
	

    <p class="textonormal">&nbsp;</p>
    <p class="textonormal"><br />
    </p>
    
	</div>
	<?php if ($colecoesatual['id']){?>
	<div id="fotos_">
		<span class="Titulos_colecoes"><?php echo $colecoesatual['nomecolecao']?>  </span>
		<p class="foto">

			<?php foreach ($fotoscolecaoatual as $row) { ?>
			<a href="<?php echo base_url();?>site/colecao_fotos/<?php echo $row['fotoColecao']?>"  title="<?php echo $row['descricao']?>"  >
				<img src="<?php echo base_url();?>site/colecao_fotos/<?php echo $row['fotoColecaoThumb']?>" class="foto" border="0" />	
			</a>				
			<?php } ?>	
			<!--
			<div id="paginacao_">
				<p class="textonormal">1 2 3 4 5 6</p>
			</div>
			-->
		</p>
	</div>
	 <?php } else {?>
	 
		<div id="fotos_">
		<span class="Titulos_colecoes"><?php echo $colecao['nomecolecao']?>  </span>
		<p class="foto">

			<?php foreach ($fotoscolecao as $row) { ?>
			<a href="<?php echo base_url();?>site/colecao_fotos/<?php echo $row['fotoColecao']?>" title="<?php echo $row['descricao']?>" >
				<img src="<?php echo base_url();?>site/colecao_fotos/<?php echo $row['fotoColecaoThumb']?>" class="foto"  border="0"  />
			</a>				
			<?php } ?>	
			<!--
			<div id="paginacao_">
				<p class="textonormal">1 2 3 4 5 6</p>
			</div>
			-->
		</p>
	</div>
	 
	  <?php }?>
<?php include("final.inc.php");?>