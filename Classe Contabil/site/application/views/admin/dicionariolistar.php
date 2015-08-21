<?php checkSessao("DIC");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/dicionario/deletar/"+id;
		}
	}
</script>
<body>
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
	<tr class="titulo">
		<td>Palavra</td>
		<td>Significado</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<? foreach ($dicionario as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['palavra']?></td>
		<td style="font-size: 11px"><?=$row['significado']?></td>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/dicionario/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?= $row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
	  	</td>
	</tr>
  	<? } ?>
</table>
<br>
<div align="center"><input type="button" value="Nova Palavra" onclick="window.location.href='<?= base_url()?>admin/dicionario/detalhar';" /></div>
</body>
</html>
<?
echo "<BR><BR>";
echo $pag;
echo "<BR><BR>";
?>