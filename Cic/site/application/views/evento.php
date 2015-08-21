<?php include "inicio.inc.php" ?>
<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO > TIRA DA ESQUERDA -->
	
	<div>
	<h1>Evento </h1>
		<h2><b><?php echo $titulo?></b></h2>
			<p style="padding-left: 15px"><?php echo sqlToDate($data);?> &#8211; <?php echo $titulo ?></p>
			<p style="padding-left: 15px"><?php echo $descricao ?></p>
			<p class="dir"><a class="mais" href="<?php echo base_url().$url?>">ver todos os eventos &raquo;</a></p>
	</div>
</div>

<?php include "final.inc.php" ?>