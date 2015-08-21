<?php checkSessao("DIC");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/faq/deletar/"+id;
		}
	}
</script>
<body>
<table class="listar" cellspacing="1" cellpadding="1" style="width: 98%;" >
	<tr class="titulo">
		<td  align="center" colspan="7">FAQ (Frequently Asked Questions)</td>
	</tr>
	<tr class="titulo">
		<td>Pergunta</td>
		<td>Resposta</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<? foreach ($faq as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['pergunta']?></td>
		<td style="font-size: 11px"><?=nl2br($row['resposta'])?></td>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/faq/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?= $row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
	  	</td>
	</tr>
  	<? } ?>
</table>
<br>
	<div align="center"><input type="button" value="Nova Dica" onclick="window.location.href='<?= base_url()?>admin/faq/detalhar';"/></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>