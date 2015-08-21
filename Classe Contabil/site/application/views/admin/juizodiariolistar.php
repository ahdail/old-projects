<?php 
checkSessao("ART");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/juizodiario/deletar/"+id;
		}
	}
</script>
<body>
<?php if($_POST['acao'] == "edit"){?>
<div class="msgOk">Edição realizada com sucesso!</div>
<?php }
if ($_POST['acao'] == "add"){?>
<div class="msgOk">Cadastro realizada com sucesso!</div>
<?php }?>
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%;">
<tr class="titulo">
		<td  align="center" colspan="7">TODOS OS JUÍZOS DIÁRIO</td>
	</tr>
	<tr class="titulo">
		<td>Pergunta</td>
		<td>Resposta</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<? foreach ($juizodiario as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['pergunta']?></td>
		<td style="font-size: 11px"><?=$row['resposta']?></td>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/juizodiario/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
		</td>
	</tr>
 	<? } ?>
</table>
<br>
<div align="center"><input type="button" value="Novo Juízo Diário" onclick="window.location.href='<?= base_url()?>admin/juizodiario/detalhar'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>