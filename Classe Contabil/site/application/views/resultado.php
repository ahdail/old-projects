<?php 
	function percent($valor,$total)
	{
		$parcial =  $valor/$total;
		$resultado = $parcial * 100;
		return round($resultado,2);
	}
	$pergunta = $total['pergunta'];
	$total = $total['total'];
?>
<html>
<head>
<style type="text/css">
<!--

-->
</style>

</head>
<title>Resultado da Enquete</title>
<body style="font-family: Arial; margin: 0">
<center><h4 style="background-color: #7CB0A0; margin: 0; padding: 5px"><?=$pergunta?></h4></center>
<table cellpadding="10" width="100%" height="250px" style="background-color: #E1F4FF;color: #A40000; border-color:#7CB0A0;font-size: 13px; font: " border="0">
	<?php foreach ($respostas as $row2) {?>
	<tr align="left" style="font-weight: bold" height="15%">
		<td><?=$row2['resposta'] ?></td>
		<td><?=percent($row2['total'],$total)?> %</td>
	</tr>
	<?php }?>	
	<tr style="background-color: #FFFFFF;" height="15%">
		<td colspan="2" align="center">Total de <b><?=$total?></b> pessoas</td>
	</tr>
</table>

</body>
</html>

