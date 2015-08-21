<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/artigo/deletar/"+id;
		}
	}
</script>
<body>
<form method="post" action="<?= base_url() ?>admin/artigo/listar">
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%; border: 0">
	<tr>
		<td colspan="7" align="center">Autor:&nbsp;&nbsp;&nbsp;
		<select name="idAutor" style="width: 500px">
			<option value="0">Todos os Autores</option>
			<?php 
				foreach ($autor as $autor){
				if ($autor['id'] == $idAutor){
					$selecionado = "selected=selected";
				}else {
					$selecionado = "false";
				}
			?>
				<option value="<?=$autor['id']?>" <?=$selecionado ?>><?=$autor['nome']?></option>
			<?php
				}
			?>
		</select>
		<input type="submit" value="Ok" style="cursor:pointer;">
		</td>
	</tr>
</table>
</form>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
	<tr class="titulo">
		<td  align="center" colspan="7">TODOS OS ARTIGOS</td>
	</tr>
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Tipo</td>
			<td bgcolor="#CCCCCC">Título</td>
			<td bgcolor="#CCCCCC">Resumo</td>
			<td align="center">Qtd Acessos</td>
			<td bgcolor="#CCCCCC" align="center" width="50px">Exibir Destaque</td>
			<td bgcolor="#CCCCCC" align="center" width="50px">Exibir Principal</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">Acões</td>
		</tr>
	  	
		<? foreach ($artigo as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?=$cor?>">
		<?php if ($row['tipo'] == "A"){ ?>
			<td  style="font-size: 10px" align="center"> Artigo </td>
			<?php } else if ($row['tipo'] == "J") { ?>
			<td style="font-size: 10px" align="center">Juizo</td>
		<?php } else {?>
			<td style="font-size: 10px" align="center">Direito</td>
		<?php }?>
			<td style="font-size: 10px"><?=$row['titulo']?></td>
			<td style="font-size: 10px"><?=$row['resumo']?></td>
			<td style="font-size: 11px" align="center"><?=$row['acesso']?></td>
	  		<?php if ($row['exibirDestaque'] == "S"){ ?>
			<td align="center"><a href="<?= base_url()?>admin/artigo/exibirDestaque/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td align="center"><a href="<?= base_url()?>admin/artigo/exibirDestaque/<?=$row['id']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			
			<?php if ($row['exibirPrincipal'] == "S"){ ?>
			<td align="center"><a href="<?= base_url()?>admin/artigo/exibirPrincipal/<?=$row['id']?>/N"><img border="0" src="<?= base_url()?>site/img/check.gif" ></a></td>
			<?php } else { ?>
			<td align="center"><a href="<?= base_url()?>admin/artigo/exibirPrincipal/<?=$row['id']?>/S"><img border="0" src="<?= base_url()?>site/img/checkNo.gif" ></a></td>
			<?php }?>
			
			<td align="center" width="50px">
				<a href="<?= base_url()?>admin/artigo/detalhar/<?=$row['id']?>"><img id="logo" src="<?= base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?=$row['id']?>)"><img id="logo" src="<?= base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Artigo" onclick="window.location.href='<?= base_url()?>admin/artigo/detalhar/0'"; /></div>
</body>
</html>
<?
if(!$idAutor){
	echo $pag;
	echo "<BR><BR>";
}
?>