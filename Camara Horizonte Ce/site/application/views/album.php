<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="<? echo base_url()?>album">Álbuns de fotos</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			
			<?php if($fotos){?>
			
				<div class="entry" id="fotos_">
					<h2><?php echo $nomealbum['nome']?></h2>
					<?php foreach ($imagem as $row) {?>				
						
						<a href="<? echo base_url()?>site/galeria_fotos/<?php echo $row['imagem']?>"><img src="<? echo base_url()?>site/galeria_fotos/<?php echo $row['imagem']?>" class="foto"/></a>						
					<?php }
					echo $pag
					?>			
				</div>
			<p style="font-size:10px;"><a href="<? echo base_url()?>album"> &laquo; todos os álbuns &raquo;</a></p>
			<?php } else{ ?>

				<div class="entry">
					<?php foreach ($album as $row) {?>					
						<p>
							<?php echo $row['nome']?>
							<?php echo $row['resumo']?>&nbsp;&nbsp; <a href="<?php echo base_url();?>album/ver/<?php echo $row['id'];?>">[ver fotos]</a>
						</p>
					<?php }
					echo $pag
					?>			
				</div>
				
			<?php }?>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>