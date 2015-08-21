<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/newsletter/deletar/"+id;
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
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
	<tr class="titulo">
		<td>Nome</td>
		<td>E-mail</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<?php foreach ($newsletter as $row) {
	 	$i++;
		if ($i%2)$cor = "#F4F4F4";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?php echo $cor?>">
		<td style="font-size: 11px"><?php echo $row['nome']?></td>
		<td style="font-size: 11px"><?php echo $row['email']?></td>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?php echo base_url()?>admin/newsletter/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
		</td>
	</tr>
 	<?php } ?>
</table>
<br>
<div align="center"><input type="button" value="Novo E-mail" onclick="window.location.href='<?php echo base_url()?>admin/newsletter/detalhar/0'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>