<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title">Apoio & Serviço</h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			<h2 class="title"><?php echo $apoios['nome']?></h2><br />
			<div class="entry">			
				<?php echo nl2br($apoios['informacao'])?>
			</div>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>