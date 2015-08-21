<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/enquete/perguntaDeletar/"+id;
		}
	}
</script>
<body>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 50%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Pergunta</td>
			<td bgcolor="#CCCCCC" align="center">Exibir</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
	  	
		<?php foreach ($enquetePergunta as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?php echo $cor?>">
			<td style="font-size: 10px"><?php echo $row['pergunta']?></td>
	  		<?php if ($row['exibir'] == "S"){ ?>
			<td align="center"><a href="<?php echo base_url()?>admin/enquete/perguntaExibe/<?php echo $row['id']?>/N"><img border="0" src="<?php echo base_url()?>site/img/admin/check.gif" ></a></td>
			<?php } else { ?>
			<td align="center"><a href="<?php echo base_url()?>admin/enquete/perguntaExibe/<?php echo $row['id']?>/S"><img border="0" src="<?php echo base_url()?>site/img/admin/checkNo.gif" ></a></td>
			<?php }?>
			<td align="center" width="50px">
				<a href="<?php echo base_url()?>admin/enquete/perguntaDetalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<?php } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Nova Pergunta" onclick="window.location.href='<?php echo base_url()?>admin/enquete/perguntaDetalhar/0'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>