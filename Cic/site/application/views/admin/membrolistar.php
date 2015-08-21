<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/faleConosco/membroDeletar/"+id;
		}
	}
</script>

<body>
<table class="listar" cellspacing="1" cellpadding="1">
  <tr class="titulo">
    <td>Funções</td>
    <td>Nome</td>
    <td>Email</td>
    <td align="center" class="acoes">Ações</td>
  </tr>
  <? foreach ($rows as $row) {
  	$i++;
	if ($i%2)$cor = "#F9FAFC";
	else $cor = "#FFFFFF";
  ?>
  <tr style="background-color: <?=$cor?>">
    <td style="font-size: 11px"><?=$row['nomeFuncao']?></td>
    <td style="font-size: 11px"><?=$row['nomeMembro']?></td>
    <td style="font-size: 11px"><?=$row['email']?></td>
    <td style="font-size: 11px" align="center" class="acoes">
    	<a href="<?= base_url()?>admin/faleConosco/membroDetalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
    	<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
    </td>
  </tr>
  <? } ?>
</table>
<br>
<div align="center"><input type="button" value="Nova Funções" onclick="window.location.href='<?= base_url()?>admin/faleConosco/membroDetalhar/'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>