<!-- CONTEUDO -->
<div id="divConteudo">
	<h1 class="titulo">Evento</h1>
	<div class="divisa"></div>
		<ul class="listagem">
			<li>
				<h1><?php echo $titulo?></h1>
				<p style="padding-left: 15px;line-height: 20px;"><?php echo sqlToDate($data);?> &#8211; <?php echo $local ?></p>
				<p style="padding-left: 15px;line-height: 20px;"><?php echo $descricao ?></p>
				<p class="dir" style="line-height: 50px;"><a href="<?php echo base_url().$url?>">ver todos os eventos &raquo;</a></p>
			</li>
		</ul>	
</div>

