<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/perfil/deletar/"+id;
		}
	}
</script>
</head>
<body>
<?php if($_POST['acao'] == "edit"){?>
<div class="msgOk">Edi��o realizada com sucesso!</div>
<?php }
if ($_POST['acao'] == "add"){?>
<div class="msgOk">Cadastro realizada com sucesso!</div>
<?php }?>
	<table class="listar" cellspacing="1" cellpadding="1">
		<tr class="titulo">
			<td>Perfil</td>
			<td align="center" class="acoes">A��es</td>
		</tr>
		<?php foreach ($perfil as $row) { 
			$i++;
	  		if ($i%2)$cor = "#F4F4F4";
	  		else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?php echo $cor?>" class="acoes">
			<td style="font-size: 11px"><?php echo $row['perfil']?></td>
			<td style="font-size: 11px" align="center" class="acoes">
				<a href="<?php echo base_url()?>admin/perfil/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?php echo$row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Nova Perfil" onclick="window.location.href='<?php echo base_url()?>admin/perfil/detalhar/0'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>