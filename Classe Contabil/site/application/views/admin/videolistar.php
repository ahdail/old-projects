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
			window.location.href="<?= base_url()?>admin/video/deletar/"+id;
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
			<td align="center">Vídeo</td>
			<td align="center">Qtd Acessos</td>
			<td align="center">Exibir</td>
			<td align="center" class="acoes">Ações</td>
		</tr>
		<? foreach ($video as $row) { 
			$i++;
			if ($i%2)$cor = "#F9FAFC";
			else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?=$cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?=$row['titulo']?></td>
			<td style="font-size: 11px" align="center">
			<embed 
					src="<?=base_url() ?>site/videos/videoplayer.swf"
					width="200"
					height="180"
					allowscriptaccess="always"
					allowfullscreen="true"
					flashvars="file=<?=base_url()?>site/videos/<?=$row['arquivo']?>"/>
				</embed>
			<td style="font-size: 11px" align="center"><?=$row['acesso']?></td>
			</td style="font-size: 11px" align="center">
			<?php if ($row['exibir'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/video/exibir/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/video/exibir/<?=$row['id']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			<td align="center" class="acoes">
				<a href="<?= base_url()?>admin/video/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Vídeo" onclick="window.location.href='<?= base_url()?>admin/video/detalhar/0';"  class="botao" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>