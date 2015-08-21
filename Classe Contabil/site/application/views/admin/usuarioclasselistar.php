<?php checkSessao("USER")?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/usuariosClasse/deletar/"+id;
		}
	}
</script>
<body>
<div align="center">
<form action="<?= base_url() ?>admin/usuariosClasse/filtroEmail" method="post">
<ul>
			<li>
				<label>Filtro<span>*</span></label>
				<input type="text" class="campo" name="email" id="email" width="50px" />
				<input type="submit" value="Pesquisar"  />
			</li>
</ul>			
</form>
</div>
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
  <tr class="titulo">
    <td>Nome</td>
    <td>E-mail</td>
    <td align="center">Estado</td>
    <td>Ocupação</td>
    <td>Currículo</td>
    <!--  <td>Consultor</td>
    <td>Autorizado</td>-->
    <td align="center">Último Acesso</td>
    <td align="center" class="acoes">Ações</td>
  </tr>
  <? foreach ($usuario as $row) { 
  	$i++;
	if ($i%2)$cor = "#F9FAFC";
	else $cor = "#FFFFFF";
  ?> 
  <tr style="background-color: <?=$cor?>">
    <td style="font-size: 11px"><?=$row['nome']?></td>
    <td style="font-size: 11px"><?=$row['email']?></td>
    <td align="center" style="font-size: 11px"><?=$row['estado']?></td>
    <td style="font-size: 11px"><?=$row['idOcupacao']?></td>
    <td style="font-size: 11px"><?=$row['curriculo']?></td>
<!--<?php if ($row['consultor'] == "S"){ ?>
	<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif" title="Sim"></a></td>
	<?php } else { ?>
	<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></a></td>
	<?php }?>
	<?php if ($row['autorizado'] == "S"){ ?>
	<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif" title="Sim"></a></td>
	<?php } else { ?>
	<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></a></td>
	<?php }?>
-->	
    <td align="center" style="font-size: 11px"><?=sqlToDataHora($row['ultimoAcesso'])?></td>
    <td align="center" class="acoes">
    	<a href="<?= base_url() ?>admin/usuariosClasse/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
    	<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
    </td>
  </tr>
  <? } ?>
</table>
<br><div align="center"><input type="button" value="Novo Usuário" onclick="window.location.href='<?= base_url()?>admin/usuariosClasse/detalhar'" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>