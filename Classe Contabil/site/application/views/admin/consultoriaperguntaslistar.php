<?php checkSessao("CON.GRA")?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="<?= base_url()?>site/css/adminInternas.css" />
</head>
<script language="javascript">
	function deletar(id) {
		if (confirm("Deseja realmente deletar?")) {
			window.location.href="<?= base_url()?>admin/dicionario/deletar/"+id;
		}
	}
</script>
<body>
<table class="listar" cellspacing="1" cellpadding="1" style="width: 100%">

<div>
		<fieldset>
			<label style="width: 100px">Pesquisa por Temas</label>
			<select style="color: #666666;" type="text" name="tema" id="tema" onchange="if(getElementById('tema').options[getElementById('tema').selectedIndex].value!=-1) top.document.location='<?= base_url()?>admin/consultoria/filtrarTema/' + getElementById('tema').value+'';">
					<option value="-1">Selecione um tema...</option>
				<?php foreach ($temas as $rowTemas) {
						$selected = "";
						if($id == $rowTemas['id']){
							$selected = "selected";								
						}
				?>
					<option value="<?=$rowTemas['id'] ?>" <?=$selected?>> <?=$rowTemas['tema']?></option>
				<?php }?>
			</select><br />
		</fieldset>
</div>
	<tr class="listagem">
	<?php if (!$filtro == true){
			foreach ($perguntas as $row){?>
				<?php 
				if ($row['tema'] != $temaAnterior){?>
					<?= $row['tema']?><br />
				<?php }?>
				<p><a href="<?= base_url()?>consultoria/ver/<?= $row['id']?>/<?=$session_idUsuario?>" ><?= $row['pergunta']?></a></p>
		<?php 
				$temaAnterior = $row['tema']; 
			}	
		} else {
				foreach ($pergunta as $row){?>
				<td>
					<?php 
					if ($row['tema'] != $temaAnterior){?>
						<?= $row['tema']?><br />
					<?php }?>
					<p><a href="<?= base_url()?>consultoria/ver/<?= $row['id']?>/<?=$session_idUsuario?>" ><?= $row['pergunta']?></a></p>
				</td>
				<?php 
					$temaAnterior = $row['tema']; 
				}
			} 	
	 	 ?>
	</tr>
</table>
<br>
<div align="center"><input type="button" value="Nova Pergunta" onclick="window.location.href='<?= base_url()?>admin/dicionario/detalhar';" /></div>
</body>
</html>
<?
echo "<BR><BR>";
echo $pag;
echo "<BR><BR>";
?>