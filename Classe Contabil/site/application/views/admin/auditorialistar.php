<?php 
checkSessao("ADM.AUD");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<body>
	<table class="listar" cellspacing="1" cellpadding="1">
		<tr class="titulo">
			<td>Log</td>
			<td width="25%" align="center">Data / Hora</td>
		</tr>
		<? foreach ($log as $row) { 
			$i++;
			if ($i%2)$cor = "#F9FAFC"; else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?=$cor?>">
			<td style="font-size: 11px"><?=$row['log']?></td>
			<td style="font-size: 11px" width="25%" align="center"><?=$row['dataHora']?></td>
		</tr>
		<? } ?>
		<tr>
			<td colspan="2" align="center"></td>
		</tr>
	</table>
	<?php 
		foreach ($log as $row2){
			echo $row2['pag'];
		}
	?>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>