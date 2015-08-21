<?php 
checkSessao("AGE");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/evento/deletar/"+id;
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
		<td>Titulo</td>
		<td align="center">Data</td>
		<td>Local</td>
		<td>Descrição</td>
		<td align="center" width="50px">Autorizado?</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<? foreach ($evento as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['titulo']?></td>
		<td style="font-size: 11px" align="center"><?=$novaData = sqlToDate($row['data']);?></td>
		<td style="font-size: 11px"><?=$row['local']?></td>
		<td style="font-size: 11px"><?=$row['descricao']?></td>
		<?php if ($row['autorizado'] == "S"){ ?>
		<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif"  title="Sim"></td>
		<?php } else if ($row['autorizado'] == "N"){ ?>
		<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></td>
		<?php } else {?>
		<td style="font-size: 11px" align="center">Aguardando Autorização</td>
		<?php }?>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/evento/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
		</td>
	</tr>
 	<? } ?>
</table>
<br>
<div align="center"><input type="button" value="Novo Evento" onclick="window.location.href='<?= base_url()?>admin/evento/detalhar/0'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>