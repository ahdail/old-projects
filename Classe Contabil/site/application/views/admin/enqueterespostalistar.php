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
	<select style="margin-left: 250px;"  name="perguntaAtual" onChange="if(this.form.perguntaAtual.options[this.form.perguntaAtual.selectedIndex].value!=-1) document.location='<?=base_url()?>admin/enquete/respostaListar/' + this.form.perguntaAtual.options[this.form.perguntaAtual.selectedIndex].value;">
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
	<?php 
		if ($idPergunta) { ?>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 50%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Resposta</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
		<? foreach ($enqueteResposta as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?=$cor?>">
			<td align="left"><?= $row['resposta']?></td>
			<td align="center" width="50px">
				<a href="<?= base_url()?>admin/enquete/respostaDetalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?=$row['id']?>,<?=$idPergunta?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Nova Resposta" onclick="window.location.href='<?= base_url()?>admin/enquete/respostaDetalhar/0/<?=$idPergunta ?>'"; /></div>
	<?php }?>
</body>
</html>
