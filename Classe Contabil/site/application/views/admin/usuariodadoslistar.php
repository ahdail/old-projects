<?php 
checkSessao("ADM.USR");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/internas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/usuarioDados/deletar/"+id;
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
    <td><?=$row['usuarioNome']?></td>
    <td><?=$row['perfilNome']?></td>
    <td align="center" class="acoes">
    	<a href="<?= base_url()?>admin/usuarioDados/detalhar/"+id;<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
    	<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
    </td>
  </tr>
  <? } ?>
</table>
<br><div align="center"><input type="button" value="Novo Usuário" onclick="window.location.href='<?= base_url()?>admin/usuarioDados/detalhar/0'; /></div>
</body>
</html>