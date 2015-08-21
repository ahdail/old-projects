<?php checkSessao("CON.GRA")?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/consultoresclasse/deletar/"+id;
		}
	}
</script>
<body>
<form method="post" action="<?= base_url() ?>admin/consultoresclasse/buscar">
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
	<tr>
		<td colspan="7" align="center">Filtrar Consultor:&nbsp;&nbsp;&nbsp;
		<select style="color: #666666; width: 430px" type="text" name="filtro" id="filtro" onchange="document.location='<?= base_url()?>admin/consultoresclasse/index/' + getElementById('filtro').value+'';">
				<option value="1" <?php if($filtro==1) echo "selected";?>>Aguardando Autorização</option>
				<option value="2" <?php if($filtro==2) echo "selected";?>>Autorizado</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="7" align="center">Pesquisar Consultor
			<input type="text" size="15" name="search" value="<?= $_POST['search']?>" style="width:135px;">&nbsp;&nbsp;
			<input type="submit" value="Ok" style="cursor:pointer;">
		</td>
	</tr>
</table>
</form>

<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
  <tr class="titulo">
    <td>Nome</td>
    <td>E-mail</td>
    <td align="center">Estado</td>
    <td>Ocupação</td>
    <!-- <td>Currículo</td>-->
   	<!-- <td>Consultor</td>--> 
    <td align="center">Autorizado</td>
    <td align="center">Último Acesso</td>
    <td align="center" class="acoes">Ações</td>
  </tr>
  <? foreach ($consultores as $row) { 
  	$i++;
	if ($i%2)$cor = "#F9FAFC";
	else $cor = "#FFFFFF";
  ?>
  <tr style="background-color: <?=$cor?>">
    <td style="font-size: 11px"><?=$row['nome']?></td>
    <td style="font-size: 11px"><?=$row['email']?></td>
    <td align="center" style="font-size: 11px"><?=$row['estado']?></td>
    <td style="font-size: 11px"><?=$row['idOcupacao']?></td>
<!--   <td style="font-size: 11px"><?=$row['curriculo']?></td>-->
    <?php if ($row['consultor'] == "0"){ ?>
	<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></td>
	<?php } else if ($row['consultor'] == "1"){ ?>
	<td style="font-size: 11px" align="center">Aguardando<br> Autorização</td>
	<?php } else {?>
	<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif" title="Sim"></td>
	<?php }?>
    <td align="center" style="font-size: 11px"><?=sqlToDataHora($row['ultimoAcesso'])?></td>
    <td align="center" class="acoes">
    	<a href="<?= base_url() ?>admin/consultoresclasse/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
    	<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
    </td>
  </tr>
  <? } ?>
</table>
<br><div align="center"><input type="button" value="Novo Consultor" onclick="window.location.href='<?= base_url()?>admin/consultoresclasse/detalhar'" /></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>