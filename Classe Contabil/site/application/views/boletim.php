<link rel="alternate" type="application/rss+xml" title="RSS Portal da Classe Cont�bil" href="<?=base_url()?>videos/rss" />
<!-- CONTE�DO -->
<div id="divConteudo">
		<h1 class="titulo">Boletim Eletr�nico</h1>
		<div class="divisa"></div>
		<ul class="listagem">
			<li><h1><a href="http://www.classecontabil.com.br/newsletter.php" target="_BLANK" >Boletins da vers�o anterior.</a></h1></li>
		</ul>
		<ul class="listagem">
		<?php
		foreach ($boletim as $rowBoletim){
		?>
			<li>
					<p class="data"><?=sqlToDate($rowBoletim['data_criacao'])?></p>
					<h1><a href="<?= base_url()?>boletim/ver/<?=$rowBoletim[id]?>/<?= $rowBoletim['data_criacao']?>">Boletim Eletr�nico n. <?=$rowBoletim['id'] ?>�</a></h1>
			</li>
		<?php }	?>
		</ul>
<? echo "</br></br>$pag</br></br>";?>	
</div>

