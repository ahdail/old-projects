<?php 
checkSessao("TAG");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/tag/deletar/"+id;
		}
	}
</script>

<body>
<table class="listar" cellspacing="1" cellpadding="1">
  <tr class="titulo">
    <td>Tag</td>
    <td align="center" class="acoes">Ações</td>
  </tr>
  <? foreach ($tag as $row) {
  	$i++;
	if ($i%2)$cor = "#F9FAFC";
	else $cor = "#FFFFFF";
  ?>
  <tr style="background-color: <?=$cor?>">
    <td style="font-size: 11px"><?=$row['tag']?></td>
    <td style="font-size: 11px" align="center" class="acoes">
    	<a href="<?= base_url()?>admin/tag/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
    	<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
    </td>
  </tr>
  <? } ?>
</table>
<br>
<div align="center"><input type="button" value="Nova Tag" onclick="window.location.href='<?= base_url()?>admin/tag/detalhar/0'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>