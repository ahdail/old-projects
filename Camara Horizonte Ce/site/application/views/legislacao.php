<?php include("inicio.inc.php"); ?>
		<!-- start content -->
		<div id="content">
			<h1 class="title"><a href="#">Legislação</a></h1>
			
			<p class="byline"><small>&nbsp;</small></p>
			<div class="entry" >
				<h2><?php echo $legislacao['titulo']?></h2>
				<?php if($legislacao['arquivo']){?>
				<b>Arquivo disponível para baixar.</b>
				<a href="<? echo base_url()?>site/documentos/<?php echo $legislacao['arquivo']?>" target="_blank">Clique aqui</a><br/><br/>				
				<?php } else {?>
				<b>Arquivo não disponível.</b><br/><br/>
				<?php } ?>
				<b>Descrição:</b><br /><br/><?php echo nl2br($legislacao['descricao'])?>				
				
			</div>

		<br clear="all" />
		
		</div>
		<!-- end content -->
<?php include("final.inc.php");?>