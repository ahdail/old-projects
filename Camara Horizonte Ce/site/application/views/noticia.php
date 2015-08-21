<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">Notícias</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			
			<?php if($noticia['id']){?>
			
				<div class="entry">
				
				
					<div id="box_esquerda">
						<a href="<?php echo base_url();?>noticia/ver/<?php echo $noticia['id']?>">
							<?php echo $noticia['data']?><h2><?php echo $noticia['titulo']?></h2>
						</a>
						&#8220;<?php echo $noticia['resumo']?>&#8221;<br /><br />
						<?php if($noticia['imagem']){?>
						<div id="box_direita" style="width:100px; height:100px; padding:10px">
							<img src="<? echo base_url()?>site/img/<?php echo $noticia['imagem']?>" width="100px" height="100px" />
						</div>
						<?php } ?>
						<?php echo nl2br($noticia['noticia'])?>
						<br />
					</div>
					
					
					<br clear="all" />
				<p><br /><a href="<? echo base_url()?>noticia"> todas as notícias &raquo;</a></p>
				</div>
			
			<?php } else{ ?>
			<div class="post">
				<div class="entry">
				
					<?php foreach ($noticia as $row) {?>
						<p>
							<b><?php echo sqlToDate($row['data'])?> - <a href="<?php echo base_url();?>noticia/ver/<?php echo $row['id'];?>"><?php echo $row['titulo']?></a><br /></b>						
						<?php echo $row['resumo']?>&nbsp;&nbsp; <a href="<?php echo base_url();?>noticia/ver/<?php echo $row['id'];?>">[leia +]</a>
						</p>
					<?php }
					echo $pag
					?>			
				</div>
			</div>
			<?php }?>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>