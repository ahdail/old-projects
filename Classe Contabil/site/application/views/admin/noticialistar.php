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
			window.location.href="<?= base_url()?>admin/noticia/deletar/"+id;
		}
	}
</script>
<body>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Título</td>
			<td bgcolor="#CCCCCC" align="center" width="80px">Ícone <br>Destaque</td>
			<td bgcolor="#CCCCCC">Resumo</td>
			<td align="center">Qtd Acessos</td>
			<td bgcolor="#CCCCCC" align="center" width="50px">Exibir Destaque</td>
			<td bgcolor="#CCCCCC" align="center" width="50px">Exibir Principal</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
	  	
		<? foreach ($noticia as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?=$cor?>">
			<td style="font-size: 10px"><?=$row['titulo']?></td>
			<td style="font-size: 10px" align="center">
			<?php if ($row['inserirImagem'] == "S"){?>
				<img src="<?= base_url()?>site/banners/<?=$row['icoDestaque']?>" width="70" height="70"></td>		
			<?php } else {?>
				Not Image
			<?php }?>
			<td style="font-size: 10px"><?=$row['resumo']?></td>
			<td style="font-size: 11px" align="center"><?=$row['acesso']?></td>
	  		<?php if ($row['exibirDestaque'] == "S"){ ?>
			<td align="center"><a href="<?= base_url()?>admin/noticia/exibirDestaque/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></td>
			<?php }?>
			
			<?php if ($row['exibirPrincipal'] == "S"){ ?>
			<td align="center"><a href="<?= base_url()?>admin/noticia/exibirPrincipal/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td align="center"><a href="<?= base_url()?>admin/noticia/exibirPrincipal/<?=$row['id']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			
			<td align="center" width="50px">
				<a href="<?= base_url()?>admin/noticia/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Nova Notícia" onclick="window.location.href='<?= base_url()?>admin/noticia/detalhar'"; /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>