<?php 
checkSessao("BAN");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/banner/deletar/"+id;
		}
	}
</script>
</head>
<body>
<div>
<?php 
	if ($mostra) {
		foreach ($mostra as $row2) {
			$largura = $row2['largura'];
			$altura = $row2['altura'];
			if ($row2['tipo'] == 1) {
			echo "
				<embed
					src=".base_url()."site/banners/$row2[arquivo]
					width=\"$largura\"
					height=\"$altura\"
					allowscriptaccess=\"always\"
					allowfullscreen=\"true\"
				</embed>";		
			} else {
				echo "
					<img src=".base_url()."site/banners/$row2[arquivo] width=\"$largura\" height=\"$altura\">
				";
		}
	}
	}
?>
</div><br>
	<table class="listar" cellspacing="1" cellpadding="1">
		<tr class="titulo">
			<td align="center">Título</td>
			<td align="center">Posição</td>
			<td align="center">Banner</td>
			<td align="center">Qtd Acessos</td>
			<td align="center">Exibir</td>
			<td align="center">Altura</td>
			<td align="center">Largura</td>
			<td align="center">Nova Janela</td>
			<td>Observação</td>
			<td align="center" class="acoes">Ações</td>
		</tr>
		<? foreach ($banner as $row) { 
			$i++;
			if ($i%2)$cor = "#F9FAFC";
			else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?=$cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?=$row['titulo']?></td>
			<td style="font-size: 11px" align="center"><?=$row['posicao']?></td>
			<td style="font-size: 11px" align="center">
			<?php if ($row['tipo'] == 1){?>
				<embed
					src="<?= base_url()?>site/banners/<?=$row['arquivo']?>"
					width="150"
					height="150"
					allowscriptaccess="always"
					allowfullscreen="true" >
				</embed>
			<?php } else {?>
				<img src="<?= base_url()?>site/banners/<?=$row['arquivo']?>" width="150" height="90">
			<?php }?>
			</td style="font-size: 11px" align="center">
			<td style="font-size: 11px" align="center"><?=$row['click']?></td>
			<?php if ($row['exibir'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/banner/opcao/<?=$row['id']?>/N/1"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/banner/opcao/<?=$row['id']?>/S/1"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			<td style="font-size: 11px" align="center"><?=$row['altura']?></td>
			<td style="font-size: 11px" align="center"><?=$row['largura']?></td>
			<?php if ($row['novaJanela'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/banner/opcao/<?=$row['id']?>/N/2"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?= base_url()?>admin/banner/opcao/<?=$row['id']?>/S/2"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			<td style="font-size: 11px"><?=$row['obs']?></td>
			<td align="center" class="acoes">
				<a href="<?= base_url()?>admin/banner/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Banner" onclick="window.location.href='<?= base_url()?>admin/banner/detalhar/0';"  class="botao" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>