<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/quemsomos/deletar/"+id;
		}
	}
</script>
<body>
<?php if($_POST['acao'] == "edit"){?>
<div class="msgOk">Edi��o realizada com sucesso!</div>
<?php }
if ($_POST['acao'] == "add"){?>
<div class="msgOk">Cadastro realizada com sucesso!</div>
<?php }?>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Quem Somos</td>
			<td align="center">Nome do Presidente</td>
			<td align="center">Apresenta��o do Presidente</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">A��es</td>
		</tr>
	  	
		<?php foreach ($quemsomos as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F4F4F4";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?php echo $cor?>">
			<td style="font-size: 10px"><?php echo $row['quemSomos']?></td>
			<td style="font-size: 11px" align="center"><?php echo $row['nomePresidente']?></td>
			<td style="font-size: 11px" align="center"><?php echo $row['descricaoPresidente']?></td>
			
			<td align="center" width="50px">
				<a href="<?php echo base_url()?>admin/quemsomos/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
			</td>
		</tr>
	  	<?php } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo" onclick="window.location.href='<?php echo base_url()?>admin/quemsomos/detalhar'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>