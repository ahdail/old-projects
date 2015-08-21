<?php checkSessao("TRAB")?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/anuncie/deletar/"+id;
		}
	}
</script>
</head>
<body>
<div>
</div><br>
	<table class="listar" cellspacing="1" cellpadding="1">
		<tr class="titulo">
			<td align="center">Título</td>
			<td align="center">Descrição</td>
			<td align="center">Tipo</td>
			<td align="center" class="acoes">Ações</td>
		</tr>
		<?php if ($anuncie) {?>
		<? foreach ($anuncie as $row) { 
			$i++;
			if ($i%2)$cor = "#F9FAFC";
			else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?=$cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?=$row['titulo']?></td>
			<td style="font-size: 11px" align="center"><?=$row['descricao']?></td>
			<td style="font-size: 11px" align="center">
			<?php if ($row['tipo'] == 1){?>
				<a href="<?= base_url()?>site/trabalhos/<?=$row['arquivo']?>" target="_BLANK">
					<img border="0" src="<?= base_url()?>site/trabalhos/icon/doc.gif" >
				</a>
			<?php } else {?>
				<a href="<?= base_url()?>site/trabalhos/<?=$row['arquivo']?>" target="_BLANK">
					<img border="0" src="<?= base_url()?>site/trabalhos/icon/pdf.gif" >
				</a>
			<?php }?>
			<td align="center" class="acoes">
				<a href="<?= base_url()?>admin/trabalho/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<? } }?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Trabalho" onclick="window.location.href='<?= base_url()?>admin/trabalho/detalhar/0';"  class="botao" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>