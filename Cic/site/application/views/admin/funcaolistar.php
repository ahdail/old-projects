<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/faleConosco/deletar/"+id;
		}
	}
</script>

<body>
<table class="listar" cellspacing="1" cellpadding="1">
  <tr class="titulo">
    <td>Ordem</td>
    <td>Nome</td>
    <td>Email</td>
    <td align="center" class="acoes">Ações</td>
  </tr>
  <?php foreach ($rows as $row) {
  	$i++;
	if ($i%2)$cor = "#F9FAFC";
	else $cor = "#FFFFFF";
  ?>
  <tr style="background-color: <?php echo $cor?>">
    <td style="font-size: 11px"><?php echo $row['ordem']?></td>
    <td style="font-size: 11px"><?php echo $row['nome']?></td>
    <td style="font-size: 11px"><?php echo $row['email']?></td>
    <td style="font-size: 11px" align="center" class="acoes">
    	<a href="<?php echo base_url()?>admin/faleConosco/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
    	<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
    </td>
  </tr>
  <?php } ?>
</table>
<br>
<div align="center"><input type="button" value="Nova Função" onclick="window.location.href='<?php echo base_url()?>admin/faleConosco/detalhar/'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>