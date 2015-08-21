<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">Comissão - <?php echo $comissao['nome']?></a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			<div class="entry" >
				<?php echo nl2br($comissao['descricao'])?>
			</div>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>