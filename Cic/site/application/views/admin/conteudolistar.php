<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?php echo base_url()?>admin/conteudo/deletar/"+id;
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
			<td bgcolor="#CCCCCC">T�tulo</td>
			<td bgcolor="#CCCCCC">Conte�do</td>
			<!--  <td align="center">Qtd Acessos</td>-->
			<td align="center">Exibir</td>
			<td align="center" bgcolor="#CCCCCC" width="50px">A��es</td>
		</tr>
	  	
		<? foreach ($conteudo as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F4F4F4";
	  		else $cor = "#FFFFFF";
	  		
	  		if ($row['exibir'] == "EP"){
	  			$exibir = "P�g. Principal "; 
	  		}
	  		if ($row['exibir'] == "OP"){
	  			$exibir = "Palavra do Presidente";
	  		}
	  		if ($row['exibir'] == "CE") {
	  			$exibir = "CIC na Imprensa";
	  		}
	  	?>
		<tr style="background-color: <?=$cor?>">
			<td style="font-size: 10px"><?=$row['titulo']?></td>
			<td style="font-size: 10px"><?=$row['resumo']?></td>
			<!--  <td style="font-size: 11px" align="center"><?=$row['acesso']?></td>-->
			<td style="font-size: 11px" align="center"><?=$exibir?></td>
			
			<td align="center" width="50px">
				<a href="<?php echo base_url()?>admin/conteudo/detalhar/<?=$row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" title="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?php $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" title="Deletar" border="0"></a>
			</td>
		</tr>
	  	<? } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Conte�do" onclick="window.location.href='<?php echo base_url()?>admin/conteudo/detalhar'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>