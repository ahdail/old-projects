<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		
	<div id="content">
		
			<h1 class="title"><a href="#">A voz do cidadão</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>

			<div class="entry">
				
					<?php foreach ($vozcidadao as $row) {?>
						<p>
							<?php echo $row['data']?> <br>
							<b>Nome:</b> <?php echo $row['nome']?><br />
							<b>Assunto:</b>  <?php echo $row['assunto']?><br /><br />
							<b>Mensagem:</b> <br />
							&#8220; <?php echo $row['mensagem']?> &#8221;
						</p>
						<p class="byline"><small>&nbsp;</small></p>
					<?php }
					echo $pag
					?>			
				</div>

		<br clear="all" />
		
		
	</div>
		<!-- end content -->
<?php include("final.inc.php");?>