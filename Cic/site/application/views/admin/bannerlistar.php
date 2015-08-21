<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/banner/deletar/"+id;
		}
	}
</script>
</head>
<body>
<?php
if($_POST['acao'] == "edit"){
	$msg = "Edição realizada com sucesso!";
	$class = "class=msgOk";
}else if ($_POST['acao'] == "add"){
	$msg = "Cadastro realizado com sucesso";
	$class = "class=msgOk";
}else{
	$class = "";
}
if ($class){?>
<div <?php echo $class?> style="padding-left: 200px"><?php echo $msg?><br><br>
<?php 
	if ($mostra) {
		foreach ($mostra as $row2) {
			$largura = $row2['largura'];
			$altura = $row2['altura'];
			if ($row2['tipo'] == 1) {
				echo "
					<embed
						src=".base_url()."site/banners/$row2[arquivo]
						width=\"$largura\"
						height=\"$altura\"
						allowscriptaccess=\"always\"
						allowfullscreen=\"true\"
					</embed>";		
			} else {
				echo "
					<img src=".base_url()."site/banners/$row2[arquivo] width=\"$largura\" height=\"$altura\">
				";
			}
		}
	}
?>
</div>
<?php }?>
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%;">
		<tr class="titulo">
			<td align="center">Título</td>
			<td align="center" width="10px;">Posição</td>
			<td align="center">Banner</td>
			<td align="center" width="10px;">Exibir</td>
			<td align="center" width="10px;">Altura</td>
			<td align="center" width="10px;">Largura</td>
			<td align="center" width="25px;">Nova<br> Janela</td>
			<td>Observação</td>
			<td align="center" class="acoes">Ações</td>
		</tr>
		<?php foreach ($banner as $row) { 
			$i++;
			if ($i%2)$cor = "#F4F4F4";
			else $cor = "#FFFFFF";
		?>
		<tr style="background-color: <?php echo$cor?>" class="acoes">
			<td style="font-size: 11px" align="center"><?php echo$row['titulo']?></td>
			<td style="font-size: 11px" align="center"><?php echo$row['posicao']?></td>
			<td style="font-size: 11px" align="center">
			<?php if ($row['tipo'] == 1){?>
				<embed src="<?php echo base_url()?>site/banners/<?php echo $row['arquivo']?>" width="150" height="150" allowscriptaccess="always" allowfullscreen="true">
			<?php } else {?>
				<img src="<?php echo base_url()?>site/banners/<?php echo $row['arquivo']?>" width="150" height="90">
			<?php }?>
			</td style="font-size: 11px" align="center">
			<?php if ($row['exibir'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/N/1"><img border="0" src="<?php echo base_url()?>site/img/admin/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/S/1"><img border="0" src="<?php echo base_url()?>site/img/admin/checkNo.gif" ></a></td>
			<?php }?>
			<td style="font-size: 11px" align="center"><?php echo $row['altura']?></td>
			<td style="font-size: 11px" align="center"><?php echo$row['largura']?></td>
			<?php if ($row['novaJanela'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/N/2"><img border="0" src="<?php echo base_url()?>site/img/admin/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/banner/opcao/<?php echo $row['id']?>/S/2"><img border="0" src="<?php echo base_url()?>site/img/admin/checkNo.gif" ></a></td>
			<?php }?>
			<td style="font-size: 11px"><?=$row['obs']?></td>
			<td align="center" class="acoes">
				<a href="<?php echo base_url()?>admin/banner/detalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a> 
				<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Banner" onclick="window.location.href='<?php echo base_url()?>admin/banner/detalhar/0';"  class="botao" /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>