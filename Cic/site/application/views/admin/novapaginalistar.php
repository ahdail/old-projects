<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/novapagina/deletar/"+id;
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
<table class="listar" cellspacing="1" cellpadding="1">
	<tr class="titulo">
		<td>Menu</td>
		<td>Titulo</td>
		<!--  <td>Conteúdo</td>-->
		<td align="center" class="acoes">Ações</td>
	</tr>
	<?php foreach ($novapagina as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?php echo $cor?>">
		<td style="font-size: 11px"><?php echo $row['menu']?></td>
		<td style="font-size: 11px"><?php echo $row['titulo']?></td>
		<!--<td style="font-size: 11px"><?php echo $row['conteudo']?></td>-->
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?php echo base_url()?>admin/novapagina/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
		</td>
	</tr>
 	<?php } ?>
</table>
<br>
<div align="center"><input type="button" value="Nova Página" onclick="window.location.href='<?php echo base_url()?>admin/novapagina/detalhar'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>