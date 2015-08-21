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
		<td  align="center" colspan="5">TODOS OS DEPOIMENTOS</td>
	</tr>
<form style="border: none"> 
	<tr>
	<td align="right" colspan="5">
			Filtro Autorização
			<select name="status"  onChange="if(this.form.status.options[this.form.status.selectedIndex].value!=-1) document.location='<?=base_url()?>admin/depoimentos/depoimentoListarFiltro/' + this.form.status.options[this.form.status.selectedIndex].value;">
				<option value="-1"   >Selecione...
				<option value="1" <?php if ($status == "1") { echo " selected=\"selected\" "; } ?>>Aguardando autorização</option>
				<option value="2" <?php if ($status == "2") { echo " selected=\"selected\" "; } ?>>Autorizado</option>
				<option value="3" <?php if ($status == "3") { echo " selected=\"selected\" "; } ?>>Não autorização</option>
			</select>
		</td>
	</tr>
</form>	
	<tr class="titulo">
		<td>Nome</td>
		<td>E-mail</td>
		<td>Depoimento</td>
		<td>Autorizado</td>
		<td align="center" class="acoes">Ações</td>
	</tr>
	<? foreach ($depoimentos as $row) {
	 	$i++;
		if ($i%2)$cor = "#F9FAFC";
		else $cor = "#FFFFFF";
	?>
	<tr style="background-color: <?=$cor?>">
		<td style="font-size: 11px"><?=$row['nome']?></td>
		<td style="font-size: 11px"><?=$row['email']?></td>
		<td style="font-size: 11px"><?=$row['depoimento']?></td>
		<?php if ($row['autorizado'] == "N"){ ?>
		<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" title="Não"></a></td>
		<?php } else if ($row['autorizado'] == "A"){ ?>
		<td style="font-size: 11px" align="center">Aguardando<br> Autorização</a></td>
		<?php } else {?>
		<td style="font-size: 11px" align="center"><img border="0" src="<?= base_url()?>site/img/check.gif" title="Sim"></a></td>
		<?php }?>
		<td style="font-size: 11px" align="center" class="acoes">
			<a href="<?= base_url()?>admin/depoimentos/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a> 
			<a href="#" onclick="deletar(<?= $row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
	  	</td>
	</tr>
  	<? } ?>
</table>
<br>
	<div align="center"><input type="button" value="Novo Depoimento" onclick="window.location.href='<?= base_url()?>admin/depoimentos/detalhar';"/></div>
</body>
</html>
<?
echo $pag;
echo "<BR><BR>";
?>