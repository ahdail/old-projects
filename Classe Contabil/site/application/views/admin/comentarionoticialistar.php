<?php 
checkSessao("NOT");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/comentarionoticia/deletar/"+id;
		}
	}
</script>
<body>
<table class="listar" cellspacing="1" cellpadding="1">
	<tr class="titulo">
		<td>T�tulo</td>
		<td>Coment�rio</td>
		<td>Autorizado</td>
		<td align="center" class="acoes">A��es</td>
	</tr>
	<? foreach ($comentarioNoticia as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['titulo']?></td>
		<td style="font-size: 11px"><?=$row['comentario']?></td>
		<?php if ($row['autorizado'] == "S") {?>
		<td style="font-size: 11px">
			<a href="<?= base_url()?>admin/comentarionoticia/opcao/<?=$row['idComentario']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a>		
		</td>
		<?php } else {?>
		<td style="font-size: 11px">
			<a href="<?= base_url()?>admin/comentarionoticia/opcao/<?=$row['idComentario']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a>		
		</td>
		<?php }?>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/comentarionoticia/detalhar/<?=$row['idComentario']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
			<a href="#" onclick="deletar('<?=$row[idComentario]?>')" ><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
	  	</td>
	</tr>
  	<? } ?>
</table>
<br>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>