<?php 
checkSessao("ART");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/neo/deletar/"+id;
		}
	}
</script>
<body>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
	<tr class="titulo">
		<td  align="center" colspan="3">TODOS OS NEOPATRIMONIALISMO</td>
	</tr>
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Título</td>
			<td bgcolor="#CCCCCC">Resumo</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
	  	
		<? foreach ($neo as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?=$cor?>">
		<td style="font-size: 10px"><?=$row['titulo']?></td>
		<td style="font-size: 10px"><?=$row['resumo']?></td>
		<td align="center" width="50px">
			<a href="<?= base_url()?>admin/neo/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
			<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
		</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo" onclick="window.location.href='<?= base_url()?>admin/neo/detalhar'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>