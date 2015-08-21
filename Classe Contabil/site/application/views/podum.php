
<!-- CONTEUDO -->
<div id="divConteudo">
	<!-- CONTEUDO CENTRAL -->
	<h1 class="titulo">PodClasse</h1>
	<div class="divisa"></div>
	<h3 style="padding-left: 15px;"><?=$row['titulo'] ?></h3>
	<div>
		<p class="meio" style="padding-left: 15px;">
	<embed
		src="<?= base_url()?>site/podclasse/podcast.swf"
		width="230"
		height="24"
		flashvars="playerID=1&amp;bg=0xD0EBEA&amp;leftbg=0x01B8C0&amp;lefticon=0xFFFFFF&amp;rightbg=0x00CCC8&amp;righticon=0xFFFFFF&amp;soundFile=<?=base_url()?>site/podclasse/<?=$row['arquivo']?>"/>
	</embed>
		<p class="dir" style="padding-right: 20px"><a class="mais" href="<?= base_url()?>pod/">ver todos &raquo;</a></p>
	</div>
</div>

