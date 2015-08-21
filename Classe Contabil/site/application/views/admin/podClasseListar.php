<?php 
checkSessao("MUL");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/podClasse/deletar/"+id;
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
			<td align="center">Arquivo</td>
			<td align="center">Exibir</td>
			<td align="center">Acesso</td>
			<td align="center" class="acoes">Ações</td>
		</tr>
		<? foreach ($podClasse as $row) { 
			$i++;
			if ($i%2)$cor = "#F9FAFC";
			else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?=$cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?=$row['titulo']?></td>
			<td style="font-size: 11px" align="center">
			<embed 
					src="<?=base_url() ?>site/podclasse/podcast.swf"
					width="230"
					height="24"
					flashvars="playerID=1&amp;bg=0xD0EBEA&amp;leftbg=0x01B8C0&amp;lefticon=0xFFFFFF&amp;rightbg=0x00CCC8&amp;righticon=0xFFFFFF&amp;soundFile=<?=base_url()?>site/podclasse/<?=$row['arquivo']?>"
			/>
			</td style="font-size: 11px" align="center">
			<?php if ($row['exibir'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/podClasse/exibir/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/podClasse/exibir/<?=$row['id']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			<td style="font-size: 11px" align="center"><?=$row['acesso']?></td>
			<td align="center" class="acoes">
				<a href="<?= base_url()?>admin/podClasse/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo PodClasse" onclick="window.location.href='<?= base_url()?>admin/podClasse/detalhar/0';"  class="botao" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>