<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">A Câmara</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			<div class="entry">
				<?php echo nl2br($camara['descricao'])?><br />
				<img src="<? echo base_url()?>site/img/<?php echo $camara['imagem']?>" width="508px" />
			</div>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>