<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		

	<div id="content">
		<?php if($vereador['id']){?>
			<h1 class="title"><a href="#">Vereador(a)</a></h1>
			<p class="byline"><small>&nbsp;</small></p>
			<div class="entry" style="float:left;" >
				<div id="box_esquerda" style="width:290px; height:230px; margin-left:15px">
					<b>Nome:</b> <?php echo $vereador['nome']?><br />
					<b>Partido:</b> <?php echo $vereador['nome_partido']?><br /><br />
					
					<?php echo nl2br($vereador['informacao'])?>
					<br />
				</div>
				
				
				<div id="box_direita" style="width:195px; height:230px">
					<img src="<? echo base_url()?>site/foto_vereadores/<?php echo $vereador['imagem_gd']?>" style="width:195px; height:230px"/>
				<?php if($vereador['mesa_diretora'] == "S"){  ?>
				<br /><br /><br /><br /><br /><br /><a href="<?php echo base_url();?>vereadores/mesadiretora"> &laquo; todos os membros &raquo;</a>
				<?php } else { ?>
				
					<br /><br /><br /><br /><br /><br /><a href="<?php echo base_url();?>vereadores"> &laquo; todos os vereadores &raquo;</a>
				<?php } ?>
				</div>
				
				<br clear="all" />

			</div>
		<?php } else {?>
			<h1 class="title"><a href="#">Vereadores(as)</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			<div class="entry" style="float:left;" >
					<?php foreach ($vereadores as $row) {?>
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
			
		<?php }?>

		<br clear="all" />
		
	</div>
		<!-- end content -->
<?php include("final.inc.php");?>