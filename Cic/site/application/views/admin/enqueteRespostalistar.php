
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id,idPergunta) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/enquete/respostaDeletar/"+id+"/"+idPergunta;
		}
	}
</script>
<body>
<form style="border: none">
	<select style="margin-left: 250px;"  name="perguntaAtual" onChange="if(this.form.perguntaAtual.options[this.form.perguntaAtual.selectedIndex].value!=-1) document.location='<?php echo base_url()?>admin/enquete/respostaListar/' + this.form.perguntaAtual.options[this.form.perguntaAtual.selectedIndex].value;">
		<option value=-1>Selecione a pergunta</option>
		<?php foreach ($pergunta as $rowPergunta) {
		if ($rowPergunta['id'] == $idPergunta){
				$selecionado = " selected=\"selected\" ";
			} else {
				$selecionado = "";
			}
		?>
			<option value="<?php echo $rowPergunta['id']?>" <?php echo $selecionado ?>><?php echo $rowPergunta['pergunta']?></option>
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
		<?php foreach ($enqueteResposta as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?php echo $cor?>">
			<td align="left"><?php echo $row['resposta']?></td>
			<td align="center" width="50px">
				<a href="<?php echo base_url()?>admin/enquete/respostaDetalhar/<?php echo $row['id']?>/<?php echo $idPergunta ?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?php echo $row['id']?>,<?php echo $idPergunta?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<?php } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Nova Resposta" onclick="window.location.href='<?php echo base_url()?>admin/enquete/respostaDetalhar/0/<?php echo $idPergunta ?>'"; /></div>
	<?php }?>
</body>
</html>
