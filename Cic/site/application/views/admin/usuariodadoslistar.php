<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/internas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/usuarioDados/deletar/"+id;
		}
	}
</script>
<body>
<?php $usuario_session = $this->session->userdata('login'); echo"Bem-vindo $usuario_session";?>
<table class="listar" cellspacing="1" cellpadding="1">
	<tr class="titulo">
		<td>Nome</td>
		<td>Perfil</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
  <? foreach ($usuario as $row) { ?>
  	<tr>
		<td><?php echo $row['usuarioNome']?></td>
		<td><?php echo $row['perfilNome']?></td>
		<td align="center" class="acoes">
			<a href="<?php echo base_url()?>admin/usuarioDados/detalhar/"+id;<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
			<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
		</td>
  </tr>
  <?php } ?>
</table>
<br><div align="center">
<input type="button" value="Novo Usuário" onclick="window.location.href='<?php echo base_url()?>admin/usuarioDados/detalhar/0';" />
</div>
</body>
</html>