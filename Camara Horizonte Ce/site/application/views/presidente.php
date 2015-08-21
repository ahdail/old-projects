<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">Presidente da Câmara Municipal Horizonte</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			
			<div class="flower" style="float:left;" >
				<div id="box_esquerda" style="width:290px; height:230px; margin-left:20px">
					<a href="<?php echo base_url();?>vereadores/ver/<?php echo $presidente['id']?>">
						<b>Nome:</b> <?php echo $presidente['nome']?><br />
						<b>Partido:</b> <?php echo $presidente['nome_partido']?><br /><br />
					</a>					
					<?php echo nl2br($presidente['informacao'])?>
					<br />
				</div>
				<div id="box_direita" style="width:195px; height:230px">
					<img src="<? echo base_url()?>site/foto_vereadores/<?php echo $presidente['imagem_gd']?>" width="195px" height="230px" />
					<br /><br /><br /><br /><br /><br /><a href="<?php echo base_url();?>vereadores"> &laquo; todos os vereadores &raquo;</a>
				</div>
				
				<br clear="all" />

		</div>

			
			
		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>