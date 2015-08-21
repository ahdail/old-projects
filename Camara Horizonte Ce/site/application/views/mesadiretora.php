<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		

	<div id="content">
		
			<h1 class="title"><a href="#">Mesa Diretora</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			<div class="entry" style="float:left;" >
					<?php foreach ($mesadiretora as $row) {?>
						<div id="box_esquerda" style="width:440px;">
							<a href="<?php echo base_url();?>vereadores/ver/<?php echo $row['id']?>">
								<b>Nome:</b> <?php echo $row['nome']?>
								
								<?php echo $row['presidente'] == "S" ? " - <b>[Presidente da Câmara]</b>": ""?>
								<br /> <b>Partido:</b> <?php echo $row['nome_partido']?><br />
							</a>
						</div>
						<div id="box_direita">
							<img src="<? echo base_url()?>site/foto_vereadores/<?php echo $row['imagem']?>" />
						</div>
						<br clear="all" />					
					<? } ?>
			</div>
			
		

		<br clear="all" />
		
	</div>
		<!-- end content -->
<?php include("final.inc.php");?>