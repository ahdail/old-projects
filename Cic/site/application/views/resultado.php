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
<title>Resultado</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>site/css/cic.css" />
<body>

<center><h1>Enquete<br><?php echo $pergunta?></h1></center>
<table cellpadding="5" bordercolor="#A40000" width="100%" height="250px" align="center" style="background-color: #FAE6E4; color: #A40000; border-color:#A40000;font-size: 12px; ">
	<?php foreach ($respostas as $row2) {?>
	<tr align="center" style="font-weight: bold">
		<td><?php echo $row2['resposta'] ?></td>
		<td><?php echo percent($row2['total'],$total)?> %</td>
	</tr>
	<?php }?>
	<tr style="background-color: #FFFFFF;height: 20px">
		<td colspan="2" align="center"><br>Total de <b><?php echo $total?></b> pessoas</td>
	</tr>
</table>

</body>
</html>