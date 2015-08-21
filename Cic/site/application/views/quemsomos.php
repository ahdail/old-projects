<?php include "inicio.inc.php" ?>

<!-- CONTEUDO -->
<div id="conteudo">
	<!-- CONTEUDO > TIRA DA ESQUERDA -->
	<div id="tiraEsq" align="justify">
		<h1>Quem Somos</h1>
		<p><?php echo $quemsomos['quemSomos']?></p>

		<h1>Diretoria biênio 2008 - 2010</h1>
		<p><?php echo $diretoria['diretoria']?></p>
	</div>
	<!-- CONTEUDO > TIRA DA DIREITA -->
	<div id="tiraDir" align="justify">
		<p style="margin: 0; font-size: 14px">Nosso Presidente</p>
		<p style="margin: 0; font-size: 18px; color: #A40000; font-weight: bold"><?php echo $presidente['nomePresidente'];?></p><br>
		<img src="<?= base_url() ?>site/img/<?php echo $presidente['fotoPresidente'];?>" alt="Presidente" /><br />
		<p><?php echo $presidente['descricaoPresidente'];?></p>
	</div>
</div>

<?php include "final.inc.php" ?>