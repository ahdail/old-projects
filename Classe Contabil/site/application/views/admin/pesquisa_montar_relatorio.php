<?php 
checkSessao("PES");
?>
<html>
<head>
<title>Administração</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />

</head>

<body>

<?php 
foreach($relatorio as $pergunta) {
	?>
	<form>
	<h1>Pergunta: <?=$pergunta['Pergunta']?></h1>
	<center><span>Total de votos: <?=$pergunta['TotalVotos']?></span></center>
	<? if ($pergunta['TotalVotos'] > 0) { ?>
		<ul>
		<?
		foreach ($pergunta['Respostas'] as $chave => $valor) {
			?>
			<li>
				<? if ($valor){ ?>
					<? if (isset($valor['Porcentagem'])): ?>
						<div style="position: relative; float: right; width: 300px; border: 1px solid #00AA00"><span style="position: absolute; left: -40px"><?=$valor['Porcentagem']?>%</span> <span style="display: block; width: <?=$valor['Porcentagem']?>%; background: #00AA00; border: 1px solid #00A400">&nbsp;</span></div>
					<? endif; ?>
					<span style="margin-left: 10px;"><b><?=$chave?>:</b> <?=$valor['Valor']?></span><br />
				<? } else { ?>
					<span style="margin-left: 10px;"><b><?=$chave?></b></span>
				<? } ?>
			</li>
			<?
		} ?>
		</ul>
	<?
	}
	?> </form><br /> <?
}
?>
</div>
</body>
</html>