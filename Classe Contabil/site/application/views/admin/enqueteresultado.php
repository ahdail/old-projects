<?php 
checkSessao("ENQ");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id,idPergunta) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/enquete/respostaDeletar/"+id+"/"+idPergunta;
		}
	}
</script>
<body>
<form style="border: none">
	<select style="margin-left: 250px;"  name="perguntaAtual" onChange="if(this.form.perguntaAtual.options[this.form.perguntaAtual.selectedIndex].value!=-1) document.location='<?=base_url()?>admin/enquete/enqueteResultado/' + this.form.perguntaAtual.options[this.form.perguntaAtual.selectedIndex].value;">
		<option value=-1>Selecione a pergunta</option>
		<?php foreach ($pergunta as $rowPergunta) {
		if ($rowPergunta['id'] == $idPergunta){
				$selecionado = " selected=\"selected\" ";
			} else {
				$selecionado = "";
			}
		?>
			<option value="<?=$rowPergunta['id']?>" <?=$selecionado ?>><?=$rowPergunta['pergunta']?></option>
		<?php }?>
	</select>
</form>	
<br/>
<table cellpadding="10" width="100%" height="250px" style="background-color: #E1F4FF;color: #A40000; border-color:#7CB0A0;font-size: 13px; font: " border="0">
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
	<?php if ($respostas) {?>
	<?php foreach ($respostas as $row2) {?>
	<tr align="left" style="font-weight: bold" height="15%">
		<td><?=$row2['resposta'] ?></td>
		<td><?=percent($row2['total'],$total)?> %</td>
	</tr>
	<?php }?>	
	<tr style="background-color: #FFFFFF;" height="15%">
		<td colspan="2" align="center">Total de <b><?=$total?></b> pessoas</td>
	</tr>
	<?php }?>
</table>
</body>
</html>
