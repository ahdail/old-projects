<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<body>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%;">
		<tr class="titulo">
			<td>Log</td>
			<td width="25%" align="center">Data / Hora</td>
		</tr>
		<?php foreach ($log as $row) { 
			$i++;
			if ($i%2)$cor = "#F4F4F4"; else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?php echo $cor?>">
			<td style="font-size: 11px"><?php echo $row['log']?></td>
			<td style="font-size: 11px" width="25%" align="center"> 
				<?php
				echo  sqlToDate(substr($row['dataHora'], 0, 10)) ." ".substr($row['dataHora'], -8, 8);
				?>
			</td>
		</tr>
		<?php } ?>
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
<?php
echo $pag;
echo "<BR><BR>";
?>