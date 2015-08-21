<?php include 'inicio.inc.php';?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">Sejam bem-vindos cidadãos!</a></h1>
			<p class="byline">&nbsp;</small></p>
			<div class="entry">
				
				
			<div id="slidebox">
				<div class="next"></div>
				<div class="previous"></div>
				<div class="thumbs">				
					<?php
						$i=1;
						foreach ($banners as $row) { ?> 
							<a href="#" onClick="Slidebox('<?php echo $i;?>');return false" class="thumb"><?php echo $i;?></a> 						
						<?php	
							$i++;
						}
					?>
				</div>
					<div class="container">				    
						<?php foreach ($banners as $row) { ?>
				        <div class="content">
							<div style="background: url(<?php echo base_url()?>site/banners/<?php echo $row['imagem']?>) no-repeat left top;" width="510" height="250"></div>							
				        </div>
						<?php } ?>			
					</div>
				</div>

			</div>
			<!--
			<div class="post">
				<h2 class="title">Destaque - <?php echo $destaque['titulo']?></h2>
				
				<p class="byline"><small><?php echo sqlToDate($destaque['data'])?><a href="#"></a></small></p>
				<div class="entry">
						
						<div id="box_esquerda">
						
						
							<?php if($destaque['imagem']){?>
							<div id="box_direita" style="width:100px; height:100px; padding:10px">
								<img src="<? echo base_url()?>site/img/<?php echo $destaque['imagem']?>" width="100px" height="100px" />
							</div>
							<?php } ?>
							<?php echo nl2br($destaque['resumo'])?>
						
						</div>
						<br /><a href="<?php echo base_url();?>noticia/ver/<?php echo $destaque['id'];?>" class="more">&laquo;&laquo;&nbsp;&nbsp;Veja mais&nbsp;&nbsp;&raquo;&raquo;</a>
				</div>
			</div>
			-->
			<div class="post">
				<h2 class="title"><a href="#">Noticias recentes </a></h2>
				<p class="byline"><small>&nbsp;</small></p>
				<div class="entry">
					<?php foreach ($noticias as $row){ ?>
						<strong><?php echo sqlToDate($destaque['data'])?></strong> - <a href="<?php base_url();?>noticia/ver/<?php echo $row['id']?>"><?php echo $row['titulo']?></a><br/>					
						<!--<p><?php echo $destaque['resumo']?></p>-->
					<?php } ?>	
					<p><a href="<?php echo base_url();?>noticia" class="more">&laquo;&laquo;&nbsp;&nbsp;Veja Todas&nbsp;&nbsp;&raquo;&raquo;</a></p>
				</div>
			</div>
			<!--
			<div class="post">
			
				<p class="byline"></p>
				
				<div class="entry" style="width:190px;float:left;">
					<h3>Matérias Especiais</h3>
					<?php echo $especial['titulo']?><br />
					<a href="<?php echo base_url();?>noticia/ver/<?php echo $especial['id'];?>" class="more">&laquo;&laquo;&nbsp;&nbsp;Veja mais&nbsp;&nbsp;&raquo;&raquo;</a><br />
				</div>
				
			</div>
			-->
		<br clear="all" />
			
			
		</div>
		<!-- end content -->
<?php include 'final.inc.php';?>		