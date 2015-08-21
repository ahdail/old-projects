<?php 
checkSessao("MODEL");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/modelo/deletar/"+id;
		}
	}
</script>
<body>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Título</td>
			<td bgcolor="#CCCCCC" align="center">Autorizado</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
	  	
		<? foreach ($modelo as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?=$cor?>">
			<td style="font-size: 10px"><?=$row['titulo']?></td>
			<?php if ($row['autorizado'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif"  title="Sim"></td>
			<?php } else if ($row['autorizado'] == "N"){ ?>
			<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></td>
			<?php } else {?>
			<td style="font-size: 11px" align="center">Aguardando Autorização</td>
			<?php }?>
			<td align="center" width="50px">
				<a href="<?= base_url()?>admin/modelo/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Modelo" onclick="window.location.href='<?= base_url()?>admin/modelo/detalhar'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>