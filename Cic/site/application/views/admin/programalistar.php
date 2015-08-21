<?php 
	function converte_data($data){
	    if (strstr($data, "/")){//verifica se tem a barra /
			  $d = explode ("/", $data);//tira a barra
			  $invert_data = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mï¿½s etc...
			  return $invert_data;
	    }
	    elseif(strstr($data, "-")){
			  $d = explode ("-", $data);
			  $invert_data = "$d[2]/$d[1]/$d[0]";    
			  return $invert_data;
	    }
	    else{
	  		return "";
	  }
	}	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/cicloDebate/deletar/"+id;
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
	<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">
		<tr class="titulo">
			<td bgcolor="#CCCCCC">Título</td>
			<td bgcolor="#CCCCCC">Resumo</td>
			<td bgcolor="#CCCCCC">Exibir</td>
			<td bgcolor="#CCCCCC" width="100px">Data Exibição</td>
			<td align="center" bgcolor="#CCCCCC">Ações</td>
		</tr>
	  	
		<?php foreach ($programa as $row) {
	  		$i++;
	  		if ($i%2)$cor = "#F9FAFC";
	  		else $cor = "#FFFFFF";
	  	?>
		<tr style="background-color: <?php echo $cor?>">
			<td style="font-size: 10px"><?php echo $row['titulo']?></td>
			<td style="font-size: 10px"><?php echo $row['resumo']?></td>
			<?php if ($row['exibir'] == "S"){ ?>
			<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/cicloDebate/opcao/<?php echo $row['id']?>/N"><img border="0" src="<?php echo base_url()?>site/img/admin/check.gif" ></a></td>
			<?php } else { ?>
			<td style="font-size: 11px" align="center"><a href="<?php echo base_url()?>admin/cicloDebate/opcao/<?php echo $row['id']?>/S"><img border="0" src="<?php echo base_url()?>site/img/admin/checkNo.gif" ></a></td>
			<?php }?>
			<td style="font-size: 10px" align="center"><?= converte_data($row['data']);?></td>
			<td align="center" width="50px">
				<a href="<?php echo base_url()?>admin/cicloDebate/programaDetalhar/<?php echo $row['id']?>"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_edit.png" alt="Editar" border="0"></a>
				<a href="#" onclick="deletar(<?php echo $row['id']?>)"><img id="logo" src="<?php echo base_url()?>site/img/admin/b_drop.png" alt="Deletar" border="0"></a>
			</td>
		</tr>
	  	<?php } ?>
	</table>
	<br>
	<div align="center"><input type="button" value="Novo Programa" onclick="window.location.href='<?php echo base_url()?>admin/cicloDebate/programaDetalhar'"; /></div>
</body>
</html>
<?php
echo $pag;
echo "<BR><BR>";
?>