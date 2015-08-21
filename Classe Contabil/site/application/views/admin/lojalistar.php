<?php checkSessao("DIC");?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/depoimentos/deletar/"+id;
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
		<td  align="center" colspan="5">TODOS OS PRODUTOS CADASTRADOS</td>
	</tr>
	<tr class="titulo">
		<td>Link</td>
		<td align="center">Imagem</td>
		<td>Descrição</td>
		<td>Exibir</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<? foreach ($loja as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['url']?></td>
		<td style="font-size: 11px" align="center" >
			<img src="<?= base_url()?>site/banners/<?=$row['arquivo']?>" height="50">
		</td>
		<td style="font-size: 11px"><?=$row['descricao']?></td>
		<?php if ($row['exibir'] == "S"){ ?>
		<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif"  title="Sim"></td>
		<?php } else { ?>
		<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></td>
		<?php }?>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/loja/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?= $row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
	  	</td>
	</tr>
  	<? } ?>
</table>
<br>
	<div align="center"><input type="button" value="Novo Produto" onclick="window.location.href='<?= base_url()?>admin/loja/detalhar';"/></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>