<?php include_once "inicio.inc.php" ?>

<div id="cont" class="grid_9 omega">
	<h3>&raquo; <?php echo $sec['nome_secretaria'];?></h3>
	<div class="persona special">
		<img src="<? echo base_url()?>uploads/pasta_sec/<?php echo $sec['imagem_responsavel_thumb']?>" />
		<!--<img src="<?php echo base_url();?>img/persona.png"/>-->
		<div class="p-info">
			<!--<h3><?php echo $sec['nome_secretaria'];?></h3>-->
			<h2><?php echo $sec['nome_responsavel'];?></h2>
			
				<?php echo $sec['telefone'];?></br>
				<?php echo $sec['email'];?>
			</br>
			<p class="desc"><?php echo $sec['descricao_responsavel']?></p>
		</div>
	</div>
	
	<h3 id="s-news">Notícias da Secretaria</h3>
	
	<?php foreach ($noticias_secretaria as $row) {?>
	
	<div class="news">
		<h2> <?php echo $row['titulo']?></h2>
		<p class="subtitle" ><?php echo sqlToDate($row['data'])?></p>
		
		
<?php if (!empty($row['imagem_thumb'])){?> 
		<div style="float:left; padding:5px;"><img class="img-right" src="<? echo base_url()?>uploads/pasta_not/<?php echo $row['imagem_thumb']?>" /></div>		
		<?php }?>
		
		<p><?php echo $row['resumo']?></p>
		<a class="leia" href="<?php echo base_url()?>noticia/ver/<?php echo $row['id_noticia']?>#cont">Leia mais</a>
	</div>
	
	<?php } ?>
	
	<div id="nav-news">
		<a class="block" href="<?php echo base_url()?>noticia#cont">Ver todas</a>
	</div>
	<div class="box">
		<div class="h-box">
			<h2 id="prog">Agenda do Secretário</h2>
		</div>
		<div class="all-box">
		
		
		<?php foreach ($eventos_secretaria as $row) {?>
			<div class="e-box clearfix">
				<div class="d-box">
					<p><?php echo sqlToDate($row['data']);?></p>
				</div>
				<div class="info-box">
					<h3><?php echo $row['titulo'];?></h3>
					<p><strong>Local: </strong><?php echo $row['local'];?></p>
					<p>	
						<?php echo nl2br($row['descricao']);?>
					</p>
				</div>
			</div>
		<?php } ?>
			
			
			
		
			
			
			
		</div>
	</div>
</div>


</div> <!-- container -->

<?php include_once "final.inc.php" ?>