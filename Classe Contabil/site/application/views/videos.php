<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Cont�bil" href="<?php echo base_url()?>videos/rss" />
<!-- CONTE�DO -->
<div id="divConteudo">
		<h1 class="titulo">Todos os V�deos</h1>
		<div class="divisa"></div>
		<ul class="listagem">

		<?php
		foreach ($videos as $row){
		?>
			<li>
					<p class="data">
					<?php echo $row['acesso']?> acessos
					<?php if ($row['comentarios']){?>
						<br /><?=$row['comentarios']?> coment�rios
					<?php }?>
					</p>
					<h1><a href="<?php echo base_url()?>video/ver/<?php echo $row[id]?>"><?php echo $row['titulo']?></a></h1>
					<br><p><a href="<?php echo base_url()?>video/ver/<?php echo $row[id]?>"><?php echo substr($row['resumo'], 0, 100); ?>(..)</a></p>
			</li>
		<?php }	?>
		</ul>
	<br /><br /><?php echo $pag?><br /><br />	
</div>
	