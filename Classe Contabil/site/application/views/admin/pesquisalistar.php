<?php 
checkSessao("PES");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/pesquisa/pesquisaDeletar/"+id;
		}
	}
</script>
<body>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 50%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Pergunta</td>
			<td bgcolor="#CCCCCC">Exibir</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
	  	
		<? foreach ($pesquisa as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?=$cor?>">
			<td style="font-size: 10px"><?=$row['pesquisa']?></td>
	  		<?php if ($row['exibir'] == "S"){ ?>
			<td ><a href="<?= base_url()?>admin/pesquisa/pesquisaExibe/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td ><a href="<?= base_url()?>admin/pesquisa/pesquisaExibe/<?=$row['id']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			<td align="center" width="50px">
				<a href="<?= base_url()?>admin/pesquisa/pesquisaDetalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Nova Pesquisa" onclick="window.location.href='<?= base_url()?>admin/pesquisa/pesquisaDetalhar'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>